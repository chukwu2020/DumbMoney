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
    /**
     * Show available plans for copy trading
     */
    public function index()
    {
        $user = auth()->user();

        $copyAdmin = null;
        if ($user->copy_preference === 'specific_admin' && $user->copy_admin_id) {
            $copyAdmin = ServerFeed::find($user->copy_admin_id);
        }

        $plans = Plan::where('status', 'active')->get();

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

    /**
     * Submit a copy trading request
     */
    public function store(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
            'amount'  => 'required|numeric|min:0.01',
        ]);

        $user   = auth()->user();
        $plan   = Plan::findOrFail($request->plan_id);
        $amount = $request->amount;

        // Check active investments for this specific plan
        $userActivePlanParticipations = Investment::where('user_id', $user->id)
            ->where('plan_id', $plan->id)
            ->where('type', 'copy_trading')
            ->where('status', 'active')
            ->count();

        // Check pending requests for this specific plan
        $userPendingPlanParticipations = CopyTradingRequest::where('user_id', $user->id)
            ->where('plan_id', $plan->id)
            ->where('status', 'pending')
            ->count();

        $planLimit            = $plan->max_participations ?? 3;
        $totalPlanParticipations = $userActivePlanParticipations + $userPendingPlanParticipations;

        if ($totalPlanParticipations >= $planLimit) {
            return response()->json([
                'success' => false,
                'message' => "You have reached the maximum limit of {$planLimit} participations for this plan (including pending requests).",
            ], 422);
        }

        // Check overall active copy trades limit (max 3 across all plans)
        $totalActiveTrades = Investment::where('user_id', $user->id)
            ->where('type', 'copy_trading')
            ->where('status', 'active')
            ->count();

        if ($totalActiveTrades >= 3) {
            return response()->json([
                'success' => false,
                'message' => 'You have reached the maximum limit of 3 active copy trades. Please wait for existing trades to complete.',
            ], 422);
        }

        // Check balance
        if ($user->available_balance < $amount) {
            return response()->json([
                'success'  => false,
                'message'  => 'Insufficient balance. Please deposit more funds.',
                'redirect' => route('user.deposit'),
            ], 422);
        }

        // Check plan amount limits
        if ($amount < $plan->minimum_amount || $amount > $plan->maximum_amount) {
            return response()->json([
                'success' => false,
                'message' => "Amount must be between \${$plan->minimum_amount} and \${$plan->maximum_amount}",
            ], 422);
        }

        DB::beginTransaction();
        try {
            $copyRequest = CopyTradingRequest::create([
                'user_id'          => $user->id,
                'plan_id'          => $plan->id,
                'amount'           => $amount,
                'copy_admin_id'    => $user->copy_admin_id,
                'copy_admin_name'  => $user->copy_admin_name,
                'copy_server_name' => $user->copy_server_name,
                'status'           => 'pending',
            ]);

            // Reserve amount from available balance
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

    /**
     * Show copy trading history
     */
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

    /**
     * Cancel a pending request
     */
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

    /**
     * Check if user has reached the participation limit for a specific plan.
     * Counts both active investments AND pending requests.
     */
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

        $activeParticipations = Investment::where('user_id', $user->id)
            ->where('plan_id', $planId)
            ->where('type', 'copy_trading')
            ->where('status', 'active')
            ->count();

        $pendingParticipations = CopyTradingRequest::where('user_id', $user->id)
            ->where('plan_id', $planId)
            ->where('status', 'pending')
            ->count();

        $planLimit              = $plan->max_participations ?? 3;
        $totalParticipations    = $activeParticipations + $pendingParticipations;
        $hasReachedLimit        = $totalParticipations >= $planLimit;

        return response()->json([
            'has_reached_limit'       => $hasReachedLimit,
            'plan_limit'              => $planLimit,
            'current_participations'  => $totalParticipations,
            'active_participations'   => $activeParticipations,
            'pending_participations'  => $pendingParticipations,
        ]);
    }

    /**
     * Change the admin being copied
     */
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