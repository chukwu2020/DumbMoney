<?php
// app/Http/Controllers/DepositController.php

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
        $wallets = Wallet::all();
        $reinvestmentMode = $this->checkReinvestmentMode();

        return view(
            'dashboard.deposit.create-deposit',
            compact('wallets', 'reinvestmentMode')
        );
    }

    // Handle deposit input
    public function userMakeDeposit(Request $request)
    {
        $request->validate([
            'wallet_id'  => 'required|exists:wallets,id',
            'amount'     => 'required|numeric|min:0.01',     // entered amount (any currency)
            'amount_usd' => 'required|numeric|min:0.01',     // converted USD (truth)
        ]);

        $user = auth()->user();
        $wallet = Wallet::findOrFail($request->wallet_id);
        $amountUSD = round($request->amount_usd, 2);

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

            // For reinvestment, we need a plan - redirect to plans page
            return redirect()
                ->route('user.invest')
                ->with('reinvestment_amount', $amountUSD)
                ->with('reinvestment_wallet', $wallet->id)
                ->with('info', 'Please select a plan for reinvestment');
        }

        /**
         * =========================
         * NORMAL DEPOSIT FLOW
         * =========================
         * Store in session and go to confirmation page
         */
        Session::put('deposit_details', [
            'user_id'          => $user->id,
            'wallet_id'        => $request->wallet_id,
            'amount_deposited' => $amountUSD,
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

        // For confirmation page, we don't need plan details anymore
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
            ->route('user.deposit-history')
            ->with('error', 'Deposit session expired.');
    }

    $request->validate([
        'proof' => 'required|image|mimes:jpeg,png,jpg|max:5120',
    ]);

    $depositDetails = Session::get('deposit_details');

    $proofPath = $request->file('proof')->store('proofs', 'public');

    // Create deposit WITHOUT plan_id - it will now be NULL
    $deposit = Deposit::create([
        'user_id'          => $depositDetails['user_id'],
        'wallet_id'        => $depositDetails['wallet_id'],
        'amount_deposited' => $depositDetails['amount_deposited'],
        'proof'            => $proofPath,
        'status'           => 0, // Pending
        // No plan_id needed!
    ]);

    Session::forget('deposit_details');

    $user = User::find($deposit->user_id);
    try {
        $user->notify(
            new \App\Notifications\TransactionNotification(
                'Deposit Submitted',
                'Your deposit of $' . number_format($deposit->amount_deposited, 2) .
                ' USD is awaiting approval.'
            )
        );
    } catch (\Exception $e) {
        \Log::error('Notification failed: ' . $e->getMessage());
    }

    return redirect()
        ->route('user.deposit-history')
        ->with('success', 'Deposit submitted successfully. Awaiting approval.');
}

// deposit history

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