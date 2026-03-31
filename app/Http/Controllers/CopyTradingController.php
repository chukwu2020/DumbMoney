<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\CopyTradingRequest;
use App\Models\Investment;
use App\Models\ServerFeed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\TransactionNotification;

class CopyTradingController extends Controller
{
    // ✅ FIX 3: Single reusable method — no more duplicate logic across 3 places
    private function getPlanParticipationCounts(int $userId, int $planId): array
    {
        $allTime = Investment::where('user_id', $userId)
            ->where('plan_id', $planId)
            ->where('type', 'copy_trading')
            ->count();

        $pending = CopyTradingRequest::where('user_id', $userId)
            ->where('plan_id', $planId)
            ->where('status', 'pending')
            ->count();

        return [$allTime, $pending];
    }

    private function hasReachedPlanLimit(int $userId, int $planId, int $planLimit): bool
    {
        if ($planLimit === 0) return false; // 0 = unlimited

        [$allTime, $pending] = $this->getPlanParticipationCounts($userId, $planId);

        return ($allTime + $pending) >= $planLimit;
    }

    public function index()
    {
        $user = auth()->user();

        $copyAdmin = null;
        if ($user->copy_preference === 'specific_admin' && $user->copy_admin_id) {
            $copyAdmin = ServerFeed::find($user->copy_admin_id);
        }

        // ✅ FIX 1: 2 queries instead of N*2 queries — pulled outside the loop
        $investmentCounts = Investment::where('user_id', $user->id)
            ->where('type', 'copy_trading')
            ->selectRaw('plan_id, COUNT(*) as total')
            ->groupBy('plan_id')
            ->pluck('total', 'plan_id');

        $pendingCounts = CopyTradingRequest::where('user_id', $user->id)
            ->where('status', 'pending')
            ->selectRaw('plan_id, COUNT(*) as total')
            ->groupBy('plan_id')
            ->pluck('total', 'plan_id');

        $plans = Plan::where('status', 'active')->get()->map(function ($plan) use ($investmentCounts, $pendingCounts) {
            $allTime = $investmentCounts[$plan->id] ?? 0;
            $pending = $pendingCounts[$plan->id] ?? 0;

            $plan->active_participations  = $allTime;
            $plan->pending_participations = $pending;
            $plan->total_participations   = $allTime + $pending;
            $plan->plan_limit             = $plan->max_participations ?? 3;

            $plan->has_reached_limit =
                $plan->plan_limit != 0 &&
                $plan->total_participations >= $plan->plan_limit;

            return $plan;
        });

        $pendingRequests = CopyTradingRequest::where('user_id', $user->id)
            ->where('status', 'pending')
            ->with('plan')
            ->latest()
            ->get();

        $activeTrades = Investment::where('user_id', $user->id)
            ->where('status', 'active')
            ->where('type', 'copy_trading')
            ->with('plan')
            ->latest()
            ->get();

        $hasReachedLimit = Investment::where('user_id', $user->id)
            ->where('type', 'copy_trading')
            ->where('status', 'active')
            ->count() >= 3;

        return view('dashboard.copytrading.index', compact(
            'user',
            'plans',
            'copyAdmin',
            'pendingRequests',
            'activeTrades',
            'hasReachedLimit'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
            'amount'  => 'required|numeric|min:0.01',
        ]);

        $user   = auth()->user();
        $plan   = Plan::findOrFail($request->plan_id);
        $amount = $request->amount;

        // ✅ FIX 2: Reject inactive plans submitted directly via API
        if ($plan->status !== 'active') {
            return response()->json([
                'success' => false,
                'message' => 'This plan is no longer available.',
            ], 422);
        }

        if ($amount < $plan->minimum_amount || $amount > $plan->maximum_amount) {
            return response()->json([
                'success' => false,
                'message' => "Amount must be between \${$plan->minimum_amount} and \${$plan->maximum_amount}",
            ], 422);
        }

        if ($user->available_balance < $amount) {
            return response()->json([
                'success'  => false,
                'message'  => 'Insufficient balance. Please deposit more funds.',
                'redirect' => route('user.deposit'),
            ], 422);
        }

        DB::beginTransaction();
        try {
            $user = \App\Models\User::where('id', $user->id)->lockForUpdate()->first();

            // Re-check balance inside the lock
            if ($user->available_balance < $amount) {
                DB::rollBack();
                return response()->json([
                    'success'  => false,
                    'message'  => 'Insufficient balance. Please deposit more funds.',
                    'redirect' => route('user.deposit'),
                ], 422);
            }

            $planLimit = $plan->max_participations ?? 3;

            // ✅ FIX 3: Uses shared helper — no duplicate query logic
            [$allTimePlanCount, $pendingPlanCount] = $this->getPlanParticipationCounts($user->id, $plan->id);
            $totalPlanCount = $allTimePlanCount + $pendingPlanCount;

            if ($planLimit > 0 && $totalPlanCount >= $planLimit) {
                DB::rollBack();
                // ✅ FIX 4: Returns numbers so frontend can show "Limit reached (1/1)"
                return response()->json([
                    'success'     => false,
                    'message'     => "Limit reached ({$totalPlanCount}/{$planLimit}) — this plan cannot be joined again.",
                    'total'       => $totalPlanCount,
                    'plan_limit'  => $planLimit,
                ], 422);
            }

            // Global active trades cap — stays active-only (capacity, not history)
            $totalActiveTrades = Investment::where('user_id', $user->id)
                ->where('type', 'copy_trading')
                ->where('status', 'active')
                ->count();

            if ($totalActiveTrades >= 3) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'You have reached the maximum of 3 active copy trades.',
                ], 422);
            }

            $copyRequest = CopyTradingRequest::create([
                'user_id'          => $user->id,
                'plan_id'          => $plan->id,
                'amount'           => $amount,
                'copy_admin_id'    => $user->copy_admin_id,
                'copy_admin_name'  => $user->copy_admin_name,
                'copy_server_name' => $user->copy_server_name,
                'status'           => 'pending',
            ]);

            $user->decrement('available_balance', $amount);

            DB::commit();

            $user->notify(new TransactionNotification(
                'Copy Trading Request Submitted',
                "Your request to copy trade \${$amount} in {$plan->name} is pending admin approval."
            ));

            return response()->json([
                'success' => true,
                'message' => 'Copy trading request submitted for approval!',
                'request' => $copyRequest,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit request: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function checkPlanLimit($planId)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $plan = Plan::find($planId);

        if (!$plan) {
            return response()->json(['error' => 'Plan not found'], 404);
        }

        $planLimit = $plan->max_participations ?? 3;

        // ✅ FIX 3: Uses shared helper
        [$allTime, $pending] = $this->getPlanParticipationCounts($user->id, $planId);
        $total = $allTime + $pending;

        $hasReachedLimit = $planLimit > 0 && $total >= $planLimit;

        return response()->json([
            'has_reached_limit'       => $hasReachedLimit,
            'plan_limit'              => $planLimit,
            'current_participations'  => $total,       // ✅ FIX 4: numbers returned for frontend display
            'all_time_participations' => $allTime,
            'pending_participations'  => $pending,
        ]);
    }

    public function history()
    {
        $user = auth()->user();

        $allRequests = CopyTradingRequest::where('user_id', $user->id)
            ->with('plan')
            ->latest()
            ->get();

        $pendingReqs  = $allRequests->where('status', 'pending');
        $approvedReqs = $allRequests->where('status', 'approved');
        $rejectedReqs = $allRequests->where('status', 'rejected');

        $activeTrades = Investment::where('user_id', $user->id)
            ->where('type', 'copy_trading')
            ->where('status', 'active')
            ->with('plan')
            ->get();

        $feed = ServerFeed::find($user->copy_admin_id);

        return view('dashboard.copytrading.history', compact(
            'pendingReqs',
            'approvedReqs',
            'rejectedReqs',
            'activeTrades',
            'feed'
        ));
    }

    public function cancel($id)
    {
        $copyRequest = CopyTradingRequest::where('user_id', auth()->id())
            ->where('id', $id)
            ->where('status', 'pending')
            ->firstOrFail();

        DB::transaction(function () use ($copyRequest) {
            auth()->user()->increment('available_balance', $copyRequest->amount);
            $copyRequest->update([
                'status'           => 'rejected',
                'rejection_reason' => 'Cancelled by user',
                'rejected_at'      => now(),
            ]);
        });

        return back()->with('success', 'Request cancelled and funds refunded.');
    }

    public function changeAdmin(Request $request)
    {
        $request->validate([
            'admin_id' => 'required|exists:server_feeds,id',
        ]);

        $user   = auth()->user();
        $server = ServerFeed::findOrFail($request->admin_id);

        $user->update([
            'copy_admin_id'    => $server->id,
            'copy_admin_name'  => $server->admin_name,
            'copy_server_name' => $server->server_name,
            'copy_preference'  => 'specific_admin',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Trader switched successfully.',
        ]);
    }
}