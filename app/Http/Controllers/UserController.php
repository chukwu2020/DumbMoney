<?php

namespace App\Http\Controllers;

use App\Models\ContactUSMessage;
use App\Models\Deposit;
use App\Models\Investment;
use App\Models\Message;
use App\Models\Plan;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Withdrawal;
use App\Models\WithdrawalCard;

use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class UserController extends Controller
{
    public function signup()
    {
        return view('auth.register');
    }

    public function createUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string',
            'username'    => 'required|string|unique:users,username|max:255',
            'email'       => 'required|email|unique:users,email|max:255',
            'phone'       => 'required|string|max:20',
            'country' => 'nullable|string|max:100',

            'password'    => ['required', 'string', 'min:6', 'max:40', 'confirmed'],
            'referral_id' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $referrerInput = session('referrer') ?? $request->input('referral_id');
        $referredBy = null;

        if ($referrerInput) {
            $referrerUser = User::where('referral_link', 'LIKE', "%$referrerInput")->first();
            if ($referrerUser) {
                $referredBy = $referrerUser->id;
            }
        }

        $newOtp = rand(100000, 999999);

        $user = new User();
        $user->name = $request->name;


        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->country = $request->country;
        $user->password = Hash::make($request->password);

        $user->role_as = '0';
        $user->email_verification_otp = $newOtp;
        $user->referred_by = $referredBy;
        $user->email_verification_token = Str::random(40);

        if ($user->save()) {
            $refCode = 'BGS-' . now()->format('Y-W') . '-' . strtoupper(Str::random(4)) . '-' . $user->id;
            $user->referral_link = url('sign-up') . '?ref=' . $refCode;
            $user->save();

            session()->forget('referrer');

            $verificationUrl = URL::temporarySignedRoute(
                'verify.otp',
                now()->addMinutes(30),
                ['token' => $user->email_verification_token]
            );

            Mail::to($user->email)->send(new OtpMail($newOtp, $verificationUrl));

            return redirect()->route('verify.otp', ['token' => $user->email_verification_token]);
        }

        return back()->with('error', 'Registration failed');
    }

    public function showVerifyOtpForm(Request $request, $token)
    {
        $user = User::where('email_verification_token', $token)->firstOrFail();
        $maskedEmail = $this->maskEmail($user->email);

        return view('auth.verify', [
            'token' => $token,
            'email' => $maskedEmail
        ]);
    }

    public function submitOtp(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'otp'   => 'required|numeric|digits:6'
        ]);

        $user = User::where('email_verification_token', $request->token)->firstOrFail();

        if ($user->email_verification_otp != $request->otp) {
            return back()->withErrors(['otp' => 'Invalid verification code.']);
        }

        $user->update([
            'email_verified_at'        => now(),
            'email_verification_token' => null,
            'email_verification_otp'   => null
        ]);

        return redirect()->route('login')->with('success', 'Registration sucessful and Email verified. Please login.');
    }

    public function resendOtp(Request $request)
    {
        $request->validate([
            'token' => 'required',
        ]);

        try {
            $user = User::where('email_verification_token', $request->token)->firstOrFail();
            $newOtp = rand(100000, 999999);
            $user->email_verification_otp = $newOtp;
            $user->save();

            $verificationUrl = URL::temporarySignedRoute(
                'verify.otp',
                now()->addMinutes(30),
                ['token' => $user->email_verification_token]
            );

            Mail::to($user->email)->send(new OtpMail($newOtp, $verificationUrl));

            return back()->with('success', 'A new OTP has been sent to your email.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to resend OTP. Try again later.');
        }
    }

    private function maskEmail($email)
    {
        $parts = explode('@', $email);
        $username = $parts[0];
        $domain = $parts[1] ?? '';

        $masked = substr($username, 0, 1) . str_repeat('*', max(0, strlen($username) - 2)) . substr($username, -1);

        return $masked . '@' . $domain;
    }

    public function user_dashboard()
    {
        $user = auth()->user();

        $cardExists = WithdrawalCard::where('user_id', $user->id)->exists();
        $totalInvested = Investment::where('user_id', $user->id)->sum('amount_invested');
        $verification = $user->idverification;
        // Deposits
        $deposits = Deposit::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($deposit) {
                return [
                    'type' => 'Deposit',
                    'amount' => $deposit->amount_deposited,
                    'status' => $deposit->status ? 'Completed' : 'Pending',
                    'date' => $deposit->created_at,
                    'reference' => 'DEP-' . $deposit->id,
                    'icon' => 'bank-transfer-in',
                    'action_url' => null,
                    'action_text' => null
                ];
            });

        // Withdrawals
        $withdrawals = Withdrawal::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($withdrawal) {
                return [
                    'type' => 'Withdrawal',
                    'amount' => $withdrawal->amount,



                    'status' => match ($withdrawal->status) {
                        'pending' => 'Pending',
                        'completed' => 'Completed',
                        'rejected' => 'Rejected',
                        default => ucfirst($withdrawal->status),
                    },


                    'date' => $withdrawal->created_at,
                    'reference' => 'WD-' . $withdrawal->id,
                    'icon' => 'bank-transfer-out',
                    'action_url' => null,
                    'action_text' => null
                ];
            });

        // Active Investments
        $allInvestments = $user->investments()
            ->where('status', 'active')
            ->with('plan')
            ->get();

        $activeInvestments = $allInvestments->take(5)->map(function ($investment) {
            return [
                'type' => 'Investment Active',
                'amount' => $investment->amount_invested,
                'status' => 'Active',
                'date' => $investment->created_at,
                'reference' => 'INV-' . $investment->id,
                'icon' => 'chart-line',
                'plan_name' => $investment->plan->name ?? 'N/A',
                'action_url' => null,
                'action_text' => null
            ];
        });

        // Matured Investments (ready for withdrawal)
        $maturedInvestments = Investment::with('plan')
            ->where('user_id', $user->id)
            ->where('status', 'completed')
            ->latest()
            ->get()
            ->filter(fn($inv) => $inv->is_withdrawable)
            ->take(5)
            ->map(function ($investment) {
                return [
                    'type' => 'Investment Matured',
                    'amount' => $investment->amount_invested + $investment->total_profit,
                    'status' => 'Ready to Withdraw',
                    'date' => $investment->updated_at,
                    'reference' => 'MAT-' . $investment->id,
                    'icon' => 'cash-check',
                    'plan_name' => $investment->plan->name ?? 'N/A',
                    'action_url' => route('investments.withdraw', $investment->id),
                    'action_text' => 'Withdraw Now'
                ];
            });

        // Combine all activities
        $activities = collect();
        $recentActivities = $activities
            ->merge($deposits)
            ->merge($withdrawals)
            ->merge($activeInvestments)
            ->merge($maturedInvestments)
            ->sortByDesc('date')
            ->take(3);

        if (session('certShowAt') && session('certShowAt') < now()->timestamp) {
            session()->forget('certShowAt');
        }
        $overlayCountToday = session('overlayCountToday', 0);

        // Finally, return view with ALL variables
        return view('dashboard.index', compact(
            'user',
            'cardExists',
            'totalInvested',
            'recentActivities',
            'overlayCountToday',
            'allInvestments',
            'verification'
        ));
    }



    // lives

  // Add these methods to UserController.php

public function user_live()
{
    $session = DB::table('live_trading_sessions')
        ->where('user_id', auth()->id())
        ->where('is_active', true)
        ->first();

    $messages = DB::table('live_trading_messages')
        ->join('users', 'live_trading_messages.user_id', '=', 'users.id')
        ->select('live_trading_messages.*', 'users.name as user_name')
        ->orderBy('live_trading_messages.created_at', 'desc')
        ->limit(50)
        ->get()
        ->reverse();

    return view('dashboard.livetrading', compact('session', 'messages'));
}

public function activateMembership(Request $request)
{
    $request->validate([
        'membership_code' => 'required|string'
    ]);

    $user = Auth::user();
    $inputCode = trim($request->membership_code);
    
    // 1. Check if already active
    if ($user->has_membership) {
        return response()->json([
            'success' => false,
            'message' => '✅ Your membership is already active!'
        ], 422);
    }
    
    // 2. Check if code matches user's assigned code
    if ($user->membership_code !== $inputCode) {
        return response()->json([
            'success' => false,
            'message' => '❌ This code does not match your account. Expected: ' . $user->membership_code
        ], 422);
    }
    
    // 3. Check if code exists in database
    $validCode = DB::table('membership_codes')
        ->where('code', $inputCode)
        ->first();
    
    if (!$validCode) {
        return response()->json([
            'success' => false,
            'message' => '❌ Code not found in database. Contact admin.'
        ], 422);
    }
    
    // 4. Check if code already used by someone else
    if ($validCode->is_used && $validCode->used_by != $user->id) {
        return response()->json([
            'success' => false,
            'message' => '❌ This code has been used by another user.'
        ], 422);
    }
    
    // 5. Activate membership
    DB::table('membership_codes')
        ->where('id', $validCode->id)
        ->update([
            'is_used' => true,
            'used_by' => $user->id,
            'used_at' => now()
        ]);

    $user->update([
        'has_membership' => true
    ]);

    return response()->json([
        'success' => true,
        'message' => '🎉 Membership activated! Welcome to Live Trading!'
    ]);
}

public function liveTradingStart(Request $request)
{
    // Check if user has approved deposit (status = 1)
    $hasDeposit = auth()->user()->deposits()->where('status', 1)->exists();

    if (!$hasDeposit) {
        return response()->json([
            'success' => false,
            'message' => 'You need an approved deposit first.'
        ], 403);
    }

    // Check for existing active session
    $existingSession = DB::table('live_trading_sessions')
        ->where('user_id', auth()->id())
        ->where('is_active', true)
        ->first();

    if ($existingSession) {
        return response()->json([
            'success' => true,
            'message' => 'Session already active.',
            'session_id' => $existingSession->id
        ]);
    }

    // Create new session
    $sessionId = DB::table('live_trading_sessions')->insertGetId([
        'user_id' => auth()->id(),
        'started_at' => now(),
        'last_activity' => now(),
        'is_active' => true,
        'watch_time_seconds' => 0,
        'earnings' => 0,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Session started!',
        'session_id' => $sessionId
    ]);
}

public function liveTradingUpdate(Request $request)
{
    $session = DB::table('live_trading_sessions')
        ->where('user_id', auth()->id())
        ->where('is_active', true)
        ->first();

    if (!$session) {
        return response()->json([
            'success' => false,
            'message' => 'No active session.'
        ], 404);
    }

    $newWatchTime = $session->watch_time_seconds + 60;
    $newEarnings = ($newWatchTime / 60) * 0.01;

    DB::table('live_trading_sessions')
        ->where('id', $session->id)
        ->update([
            'watch_time_seconds' => $newWatchTime,
            'earnings' => $newEarnings,
            'last_activity' => now(),
            'updated_at' => now()
        ]);

    return response()->json([
        'success' => true,
        'watch_time' => $newWatchTime,
        'earnings' => number_format($newEarnings, 2)
    ]);
}

public function liveTradingClaim(Request $request)
{
    $session = DB::table('live_trading_sessions')
        ->where('user_id', auth()->id())
        ->where('is_active', true)
        ->first();

    if (!$session || $session->earnings <= 0) {
        return response()->json([
            'success' => false,
            'message' => 'No earnings to claim.'
        ], 400);
    }

    $user = auth()->user();
    $newBalance = $user->available_balance + $session->earnings;

    DB::table('users')
        ->where('id', $user->id)
        ->update([
            'available_balance' => $newBalance
        ]);

    DB::table('live_trading_sessions')
        ->where('id', $session->id)
        ->update([
            'earnings' => 0,
            'is_active' => false,
            'ended_at' => now(),
            'updated_at' => now()
        ]);

    return response()->json([
        'success' => true,
        'claimed' => number_format($session->earnings, 2),
        'new_balance' => number_format($newBalance, 2)
    ]);
}

public function liveTradingSendMessage(Request $request)
{
    $request->validate([
        'message' => 'required|string|max:500'
    ]);

    DB::table('live_trading_messages')->insert([
        'user_id' => auth()->id(),
        'message' => $request->message,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Message sent!'
    ]);
}

public function liveTradingGetMessages()
{
    $messages = DB::table('live_trading_messages')
        ->join('users', 'live_trading_messages.user_id', '=', 'users.id')
        ->select(
            'live_trading_messages.id',
            'live_trading_messages.message',
            'live_trading_messages.created_at',
            'users.name as user_name'
        )
        ->orderBy('live_trading_messages.created_at', 'desc')
        ->limit(50)
        ->get()
        ->reverse()
        ->map(function ($msg) {
            return [
                'id' => $msg->id,
                'message' => $msg->message,
                'user_name' => $msg->user_name,
                'time_ago' => Carbon::parse($msg->created_at)->diffForHumans()
            ];
        });

    return response()->json([
        'success' => true,
        'messages' => $messages
    ]);
}

public function checkMembership()
{
    $user = auth()->user();

    return response()->json([
        'locked' => $user->membership_locked || !$user->membership_code
    ]);
}


public function lockedPage()
{
    return view('dashboard.lockedpage');
}



// terms and conditions

public function terms_privacyhome()
{
    return view(' snippets.hometermsprivacy');
}








    public function plans_header()
    {
        $plans = Plan::where('status', 'active')->get();
        return view('snippets.plans_header', compact('plans'));
    }

    public function About_Us()
    {
        return view('snippets.AboutUs_header');
    }

    public function services()
    {
        return view('snippets.services_header');
    }

    public function contactus()
    {
        return view('snippets.contactus_header');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $validated['user_id'] = auth()->id();

        ContactUSMessage::create($validated);

        return back()->with('success', 'Message sent successfully!');
    }




    //reinvestmet
    public function initiateReinvestment(Request $request)
    {
        $user = auth()->user();

        // Validate user has sufficient balance
        if ($user->available_balance <= 0) {
            return redirect()->route('user_dashboard')->with('error', 'Insufficient balance for reinvestment');
        }

        // Set reinvestment session flag with expiration
        session([
            'reinvestment_mode' => true,
            'reinvestment_expires' => now()->addMinutes(30),
            'reinvestment_balance' => $user->available_balance
        ]);

        return redirect()->route('user.deposit')->with('info', 'You are in reinvestment mode. Your available balance will be used.');
    }


    public function rules_regulations()
    {

        return view('dashboard.informations.rules_guildelines');
    }
}