<?php

namespace App\Http\Controllers;

use App\Models\ContactUSMessage;
use App\Models\Deposit;
use App\Models\Idverification;
use App\Models\Investment;
use App\Models\Message;
use App\Models\Plan;
use App\Models\User;
use App\Models\UserKyc;
use App\Models\Withdrawal;
use App\Models\WithdrawalCard;
use App\Notifications\IDVerificationSubmitted;
use App\Notifications\TransactionNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // ✅ ADDED THIS IMPORT

class AdminController extends Controller
{
    public function userIndex(Request $request)
    {
        $query = User::with(['investments', 'profile', 'withdrawalCard'])
            ->where('role_as', 0);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $status = $request->input('status');
            if ($status == 'Active') {
                $query->where('active', 1);
            } elseif ($status == 'Inactive') {
                $query->where('active', 0);
            }
        }

        $users = $query->paginate(10);

        foreach ($users as $user) {
            $user->total_invested = $user->investments->sum('amount_invested');
        }

        return view('admin.users.index', compact('users'));
    }

    public function hiddenuser(Request $request)
    {
        $query = User::with(['investments', 'profile', 'withdrawalCard'])
            ->where('role_as', 0);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $status = $request->input('status');
            if ($status == 'Active') {
                $query->where('active', 1);
            } elseif ($status == 'Inactive') {
                $query->where('active', 0);
            }
        }

        $users = $query->paginate(10);

        foreach ($users as $user) {
            $user->total_invested = $user->investments->sum('amount_invested');
        }

        return view('admin.users.indexmain', compact('users'));
    }

    public function userDestroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function pendingDeposits()
    {
        $deposits = Deposit::with('user', 'plan', 'wallet')
            ->where('status', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.deposits.pending', compact('deposits'));
    }

    public function approvedDeposits()
    {
        $deposits = Deposit::with(['user', 'plan', 'wallet'])
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.deposits.approved', compact('deposits'));
    }

   
public function rejectDeposit(Request $request, $id)
{
    $request->validate([
        'rejection_note' => 'required|string|min:5',
    ]);

    $deposit = Deposit::findOrFail($id);

    if ($deposit->status === 1) {
        return back()->with('error', 'Cannot reject approved deposit.');
    }

    $deposit->update([
        'status' => 2, // rejected
        'rejection_note' => $request->rejection_note,
    ]);

    // Optional notification
    $deposit->user->notify(new TransactionNotification(
        'Deposit Rejected',
        'Your deposit was rejected. Please check the reason in your dashboard.'
    ));

    return back()->with('success', 'Deposit rejected with reason.');
}

    public function approveDeposit($id)
    {
        $deposit = Deposit::findOrFail($id);

        if ($deposit->status === 1) {
            return redirect()->back()->with('error', 'This deposit has already been approved.');
        }

        $plan = Plan::find($deposit->plan_id);

        if (!$plan) {
            return back()->with('error', 'Investment plan not found');
        }

        $roi = $plan->interest_rate;
        $totalProfit = ($deposit->amount_deposited * $roi / 100) * $plan->duration;

        Investment::create([
            'user_id' => $deposit->user_id,
            'plan_id' => $deposit->plan_id,
            'amount_invested' => $deposit->amount_deposited,
            'roi' => $roi,
            'total_profit' => $totalProfit,
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays($plan->duration),
            'withdrawn' => 0,
        ]);

        $deposit->status = 1;
        $deposit->save();

        $user = $deposit->user;

        $user->notify(new TransactionNotification(
            'Deposit Approved',
            'Your deposit of $' . number_format($deposit->amount_deposited, 2) . ' has been approved and investment started successfully.'
        ));

        return redirect()->back()->with('success', 'Deposit approved and investment started');
    }

    public function showApprovedWithdrawals()
    {
        $approvedWithdrawals = Withdrawal::where('status', 'approved')
            ->with(['user'])
            ->latest()
            ->get();

        $withdrawalCards = WithdrawalCard::all();

        return view('admin.deposits.withdrawal_approved', compact('approvedWithdrawals', 'withdrawalCards'));
    }

    public function unapproveBalanceWithdrawal(Request $request, $id)
    {
        $withdrawal = Withdrawal::findOrFail($id);

        $withdrawal->user->available_balance += $withdrawal->amount;
        $withdrawal->user->save();

        $withdrawal->status = 'failed';
        $withdrawal->admin_note = $request->admin_note;
        $withdrawal->save();

        return redirect()->back()->with('success', 'Withdrawal has been unapproved and marked as failed.');
    }

    // ✅ FIXED: Generate Membership Code
   


// Add this to AdminController.php

public function generateMembershipCode(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id'
    ]);

    $user = User::findOrFail($request->user_id);
    
    // Check if user already has a code
    if ($user->membership_code) {
        return response()->json([
            'success' => false,
            'message' => 'User already has code: ' . $user->membership_code
        ], 400);
    }

    // Generate unique code
    do {
        $membershipCode = 'VIP' . date('Y') . strtoupper(Str::random(6));
    } while (DB::table('membership_codes')->where('code', $membershipCode)->exists());
    
    // Insert into membership_codes table
    DB::table('membership_codes')->insert([
        'code' => $membershipCode,
        'is_used' => false,
        'used_by' => null,
        'used_at' => null,
        'created_at' => now(),
        'updated_at' => now()
    ]);
    
    // Assign to user (but don't activate yet)
    $user->update([
        'membership_code' => $membershipCode,
        'has_membership' => false
    ]);
    
    return response()->json([
        'success' => true,
        'membership_code' => $membershipCode,
        'user_name' => $user->name
    ]);
}

// live

public function toggleMembershipLock(User $user)
{
    $user->membership_locked = !$user->membership_locked;
    $user->save();

    $status = $user->membership_locked ? 'locked' : 'unlocked';

    return back()->with('success', "Membership code has been {$status}.");
}



    public function withdrawaldestroy($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);

        if ($withdrawal->status !== 'approved') {
            return back()->with('error', 'Only approved withdrawals can be deleted.');
        }

        $withdrawal->delete();

        return back()->with('success', 'Approved withdrawal deleted successfully.');
    }

    public function updateBalance(Request $request, $id)
    {
        $request->validate([
            'available_balance' => 'required|numeric|min:0',
            'investments.*' => 'nullable|numeric|min:0',
        ]);

        $user = User::findOrFail($id);
        $user->available_balance = $request->input('available_balance');
        $user->save();

        return redirect()->route('user.index')->with('success', 'User balance updated successfully.');
    }

    public function admin_dashboard()
    {
        $totalUsers = User::count();
        $totalDeposits = User::sum('available_balance');
        $totalWithdrawals = Withdrawal::where('status', 'approved')->sum('amount');
        $amount_invested = Investment::sum('amount_invested');

        return view('admin.index', compact(
            'totalUsers',
            'totalDeposits',
            'totalWithdrawals',
            'amount_invested'
        ));
    }

    public function adminViewWithdrawals()
    {
        $withdrawals = Withdrawal::with(['user.profile', 'user.withdrawalCard'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.deposits.withdrawal_pending', compact('withdrawals'));
    }

    public function approveBalanceWithdrawal($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);

        if ($withdrawal->status === 'approved') {
            return back()->with('error', 'This withdrawal has already been approved.');
        }

        $withdrawal->status = 'approved';
        $withdrawal->admin_note = null;
        $withdrawal->save();

        $user = $withdrawal->user;

        $user->notify(new TransactionNotification(
            'Withdrawal Approved',
            'Your withdrawal request of $' . number_format($withdrawal->amount, 2) . ' has been approved.'
        ));

        return back()->with('success', 'Withdrawal approved successfully.');
    }

    public function rejectBalanceWithdrawal(Request $request, $id)
    {
        $request->validate([
            'admin_note' => 'required|string|max:500',
        ]);

        $withdrawal = Withdrawal::findOrFail($id);

        if ($withdrawal->status !== 'pending') {
            return back()->with('error', 'Only pending withdrawals can be rejected.');
        }

        $user = $withdrawal->user;
        $user->available_balance += $withdrawal->amount;
        $user->save();

        $withdrawal->status = 'rejected';
        $withdrawal->admin_note = $request->admin_note;
        $withdrawal->save();

        $user->notify(new TransactionNotification(
            'Withdrawal Rejected',
            'Your withdrawal request of $' . number_format($withdrawal->amount, 2) . ' has been rejected. Reason: ' . $request->admin_note
        ));

        return back()->with('success', 'Withdrawal rejected, amount refunded to user, and notification sent.');
    }

    public function index()
    {
        $messages = ContactUSMessage::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.contactUs.index', compact('messages'));
    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Message deleted successfully.');
    }

    public function profile()
    {
        $user = User::with('profile')->find(auth()->id());
        return view('admin.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);

            $profile = $user->profile ?? new \App\Models\UserProfile();
            $profile->user_id = $user->id;
            $profile->profile_pic = $filename;
            $profile->save();
        }

        $user->update([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
        ]);

        if ($user->profile) {
            $user->profile->update([
                'address' => $request->input('address'),
                'bitcoin_address' => $request->input('bitcoin_address'),
                'etherium_address' => $request->input('etherium_address'),
            ]);
        }

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function kycindex()
    {
        $kycs = UserKyc::with('user')->latest()->get();
        return view('admin.admin_approve_id_verification', compact('kycs'));
    }

    public function approve($id)
    {
        $kyc = UserKyc::with('user')->findOrFail($id);

        if ($kyc->status === 'approved') {
            return redirect()->back()->with('error', 'This KYC is already approved.');
        }

        if ($kyc->status === 'rejected') {
            return redirect()->back()->with('error', 'This KYC has already been rejected and cannot be approved.');
        }

        $kyc->status = 'approved';
        $kyc->admin_note = 'Approved by admin';
        $kyc->save();

        $user = $kyc->user;
        $user->notify(new TransactionNotification(
            'KYC Approved',
            'Your KYC documents have been reviewed and approved. You have unlocked additional features for your trading.'
        ));

        return redirect()->back()->with('success', 'KYC approved.');
    }

    public function reject($id)
    {
        $kyc = UserKyc::with('user')->findOrFail($id);

        if ($kyc->status === 'rejected') {
            return redirect()->back()->with('error', 'This KYC is already rejected.');
        }

        if ($kyc->status === 'approved') {
            return redirect()->back()->with('error', 'This KYC has already been approved and cannot be rejected.');
        }

        $kyc->status = 'rejected';
        $kyc->admin_note = 'Rejected by admin';
        $kyc->save();

        $user = $kyc->user;
        $user->notify(new TransactionNotification(
            'KYC Rejected',
            'Your KYC documents were reviewed and rejected. Please upload a clearer image of your ID for verification.'
        ));

        return redirect()->back()->with('success', 'KYC rejected.');
    }
}