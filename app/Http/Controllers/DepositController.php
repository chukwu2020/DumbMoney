<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Deposit;
use App\Models\Investment;
use App\Models\Plan;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DepositController extends Controller
{
    // Show deposit form
    public function userDeposit()
    {
        $plans = Plan::where('status', 'active')->get();
        $wallets = Wallet::all();

        $reinvestmentMode = $this->checkReinvestmentMode();

        return view(
            'dashboard.deposit.create-deposit',
            compact('plans', 'wallets', 'reinvestmentMode')
        );
    }

    // Handle deposit input
    public function userMakeDeposit(Request $request)
    {
        $request->validate([
            'plan_id'    => 'required|exists:plans,id',
            'wallet_id'  => 'required|exists:wallets,id',
            'amount'     => 'required|numeric|min:0.01',     // entered amount (any currency)
            'amount_usd' => 'required|numeric|min:0.01',     // converted USD (truth)
        ]);

        $user = auth()->user();
        $plan = Plan::findOrFail($request->plan_id);

        $amountUSD = round($request->amount_usd, 2);

        // ✅ Validate PLAN LIMITS IN USD ONLY
        if (
            $amountUSD < $plan->minimum_amount ||
            $amountUSD > $plan->maximum_amount
        ) {
            return back()->with(
                'error',
                "Deposit must be between \${$plan->minimum_amount} and \${$plan->maximum_amount} USD."
            );
        }

        /**
         * =========================
         * REINVESTMENT MODE
         * =========================
         */
        if ($this->checkReinvestmentMode()) {

            if ($amountUSD > $user->available_balance) {
                return back()->with(
                    'error',
                    'Reinvestment amount exceeds your available balance.'
                );
            }

            Investment::create([
                'user_id'           => $user->id,
                'plan_id'           => $plan->id,
                'amount_invested'   => $amountUSD,
                'expected_profit'   => ($amountUSD * $plan->interest_rate) / 100,
                'status'            => 'active',
                'start_date'        => now(),
                'end_date'          => now()->addDays($plan->duration),
                'is_reinvestment'   => true,
            ]);

            $user->decrement('available_balance', $amountUSD);

            session()->forget([
                'reinvestment_mode',
                'reinvestment_expires',
                'reinvestment_balance',
            ]);

            return redirect()
                ->route('user_dashboard')
                ->with('success', 'Reinvestment successful!');
        }

        /**
         * =========================
         * NORMAL DEPOSIT FLOW
         * =========================
         */
        Session::put('deposit_details', [
            'user_id'          => $user->id,
            'plan_id'          => $plan->id,
            'wallet_id'        => $request->wallet_id,

            // ✅ ALWAYS USD (core logic)
            'amount_deposited' => $amountUSD,

            // ✅ UI / audit only
            'original_amount' => $request->amount,
            'currency'        => $request->currency ?? 'USD',
        ]);

        return redirect()->route('deposit.confirm');
    }

    // Confirm deposit page
    public function confirmDeposit()
    {
        if (!Session::has('deposit_details')) {
            return redirect()
                ->route('user.deposit')
                ->withErrors(['error' => 'No deposit session found.']);
        }

        $depositDetails = Session::get('deposit_details');
        $wallet = Wallet::findOrFail($depositDetails['wallet_id']);

        return view(
            'dashboard.deposit.confirm-deposit',
            compact('wallet', 'depositDetails')
        );
    }

    // Submit deposit proof
    public function submitDeposit(Request $request)
    {
        if (!Session::has('deposit_details')) {
            return redirect()
                ->route('dashboard.deposit.deposit-history')
                ->with('error', 'Deposit session expired.');
        }

        $request->validate([
            'proof' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $depositDetails = Session::get('deposit_details');

        $proofPath = $request->file('proof')->store('proofs', 'public');

        $deposit = Deposit::create([
            'user_id'          => $depositDetails['user_id'],
            'plan_id'          => $depositDetails['plan_id'],
            'wallet_id'        => $depositDetails['wallet_id'],
            'amount_deposited' => $depositDetails['amount_deposited'], // USD
            'original_amount'  => $depositDetails['original_amount'] ?? null,
            'currency'         => $depositDetails['currency'] ?? 'USD',
            'proof'            => $proofPath,
            'status'           => 0,
        ]);

        Session::forget('deposit_details');

        $user = User::find($deposit->user_id);
        $user->notify(
            new \App\Notifications\TransactionNotification(
                'Deposit Submitted',
                'Your deposit of $' . number_format($deposit->amount_deposited, 2) .
                ' USD is awaiting approval.'
            )
        );

        return redirect()
            ->route('dashboard.deposit.deposit-history')
            ->with('success', 'Deposit submitted successfully.');
    }

    // Deposit history
    public function depositHistory()
    {
        $deposits = Deposit::with(['plan', 'wallet'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view(
            'dashboard.deposit.deposit-history',
            compact('deposits')
        );
    }

    // Reinvestment mode checker
    protected function checkReinvestmentMode()
    {
        if (
            session('reinvestment_mode') &&
            session('reinvestment_expires') > now()
        ) {
            return true;
        }

        if (
            session('reinvestment_expires') &&
            session('reinvestment_expires') <= now()
        ) {
            session()->forget([
                'reinvestment_mode',
                'reinvestment_expires',
                'reinvestment_balance',
            ]);
        }

        return false;
    }
}
