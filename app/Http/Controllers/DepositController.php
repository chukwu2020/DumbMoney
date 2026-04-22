<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Deposit;
use App\Models\Plan;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DepositController extends Controller
{
    // ─────────────────────────────────────────
    // Show deposit form
    // ─────────────────────────────────────────
    public function userDeposit()
    {
        $wallets          = Wallet::all();
        $reinvestmentMode = $this->checkReinvestmentMode();

        return view('dashboard.deposit.create-deposit', compact('wallets', 'reinvestmentMode'));
    }

    // ─────────────────────────────────────────
    // Handle crypto deposit → confirm page
    // ─────────────────────────────────────────
    public function userMakeDeposit(Request $request)
    {
        $request->validate([
            'wallet_id'  => 'required|exists:wallets,id',
            'amount'     => 'required|numeric|min:0.01',
            'amount_usd' => 'required|numeric|min:0.01',
        ]);

        $user      = auth()->user();
        $wallet    = Wallet::findOrFail($request->wallet_id);
        $amountUSD = round($request->amount_usd, 2);

        // Reinvestment mode
        if ($this->checkReinvestmentMode()) {
            if ($amountUSD > $user->available_balance) {
                return back()->with('error', 'Reinvestment amount exceeds your available balance.');
            }
            return redirect()->route('user.invest')
                ->with('reinvestment_amount', $amountUSD)
                ->with('reinvestment_wallet', $wallet->id)
                ->with('info', 'Please select a plan for reinvestment.');
        }

        // Normal flow — store in session and redirect to confirm page
        Session::put('deposit_details', [
            'user_id'          => $user->id,
            'wallet_id'        => $request->wallet_id,
            'amount_deposited' => $amountUSD,
            'payment_method'   => 'crypto',
        ]);

        return redirect()->route('deposit.confirm');
    }

    // ─────────────────────────────────────────
    // Confirm deposit page (crypto)
    // ─────────────────────────────────────────
    public function confirmDeposit()
    {
        if (!Session::has('deposit_details')) {
            return redirect()->route('user.deposit')
                ->withErrors(['error' => 'No deposit session found.']);
        }

        $depositDetails = Session::get('deposit_details');
        $wallet         = Wallet::findOrFail($depositDetails['wallet_id']);

        return view('dashboard.deposit.confirm-deposit', compact('wallet', 'depositDetails'));
    }

    // ─────────────────────────────────────────
    // Submit crypto deposit proof
    // ─────────────────────────────────────────
    public function submitDeposit(Request $request)
    {
        if (!Session::has('deposit_details')) {
            return redirect()->route('user.deposit-history')
                ->with('error', 'Deposit session expired.');
        }

        $request->validate([
            'proof' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $depositDetails = Session::get('deposit_details');
        $proofPath      = $request->file('proof')->store('proofs', 'public');

        $deposit = Deposit::create([
            'user_id'          => $depositDetails['user_id'],
            'wallet_id'        => $depositDetails['wallet_id'],
            'amount_deposited' => $depositDetails['amount_deposited'],
            'payment_method'   => 'crypto',
            'proof'            => $proofPath,
            'status'           => 0,
        ]);

        Session::forget('deposit_details');

        $user = User::find($deposit->user_id);
        try {
            $user->notify(new \App\Notifications\TransactionNotification(
                'Deposit Submitted',
                'Your deposit of $' . number_format($deposit->amount_deposited, 2) . ' is awaiting approval.'
            ));
        } catch (\Exception $e) {
            \Log::error('Notification failed: ' . $e->getMessage());
        }

        return redirect()->route('user.deposit-history')
            ->with('success', 'Deposit submitted successfully. Awaiting approval.');
    }

    // ─────────────────────────────────────────
    // Submit gift card deposit
    // ─────────────────────────────────────────
    /**
     * AMOUNT FIELD EXPLAINED
     * ──────────────────────────────────────────────────────────────────
     * The blade form sends `amount_deposited` directly — it is the face
     * value of the gift card that the user typed in (e.g. $100 USD).
     *
     * This maps straight into the `amount_deposited` column, the same
     * column used by crypto deposits, so the admin approval flow,
     * deposit history, and balance credit all work identically.
     *
     * CARD TYPE LABEL EXPLAINED
     * ──────────────────────────────────────────────────────────────────
     * The blade sends three related fields:
     *   card_type        → the slug (amazon / itunes / other / etc.)
     *   card_type_label  → the human label resolved by JS
     *                      for "other" this is the custom name the user typed
     *   other_card_name  → the raw custom text when card_type = "other"
     *
     * The admin pending/approved blades use card_type + other_card_name
     * to display the correct brand, so admins always see e.g.
     * "Razer Gold Gift Card" instead of just "other".
     * ──────────────────────────────────────────────────────────────────
     */
    public function submitGiftCard(Request $request)
    {
        $request->validate([
            'card_type'        => 'required|string|in:amazon,itunes,google,steam,walmart,other',
            'card_type_label'  => 'nullable|string|max:100',
            'other_card_name'  => 'required_if:card_type,other|nullable|string|max:100',
            'card_code'        => 'required|string|max:255',
            'amount_deposited' => 'required|numeric|min:1',
            'card_image'       => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
            'notes'            => 'nullable|string|max:500',
        ]);

        $user      = auth()->user();
        $imagePath = $request->file('card_image')->store('giftcards', 'public');

        // Resolve the display label for this card
        $cardLabel = $request->card_type === 'other'
            ? ($request->other_card_name ?: 'Other Gift Card')
            : ($request->card_type_label ?: ucfirst($request->card_type));

        $deposit = Deposit::create([
            'user_id'          => $user->id,
            'wallet_id'        => null,          // No blockchain wallet for gift cards
            'amount_deposited' => round($request->amount_deposited, 2),
            'payment_method'   => 'giftcard',
            'card_type'        => $request->card_type,
            'card_type_label'  => $cardLabel,
            'other_card_name'  => $request->card_type === 'other' ? $request->other_card_name : null,
            'card_code'        => $request->card_code,
            'proof'            => $imagePath,    // card image stored as proof
            'notes'            => $request->notes,
            'status'           => 0,             // Pending — admin must approve
        ]);

        try {
            $user->notify(new \App\Notifications\TransactionNotification(
                'Gift Card Submitted',
                'Your ' . $cardLabel . ' gift card worth $' .
                number_format($deposit->amount_deposited, 2) .
                ' has been submitted and is pending verification.'
            ));
        } catch (\Exception $e) {
            \Log::error('Gift card notification failed: ' . $e->getMessage());
        }

        return redirect()->route('user.deposit-history')
            ->with('success', 'Gift card submitted successfully. Awaiting verification.');
    }

    // ─────────────────────────────────────────
    // Deposit history
    // ─────────────────────────────────────────
    public function depositHistory()
    {
        $deposits = Deposit::with(['plan', 'wallet'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('dashboard.deposit.deposit-history', compact('deposits'));
    }

    // ─────────────────────────────────────────
    // Reinvestment mode checker
    // ─────────────────────────────────────────
    protected function checkReinvestmentMode(): bool
    {
        if (session('reinvestment_mode') && session('reinvestment_expires') > now()) {
            return true;
        }
        if (session('reinvestment_expires') && session('reinvestment_expires') <= now()) {
            session()->forget(['reinvestment_mode', 'reinvestment_expires', 'reinvestment_balance']);
        }
        return false;
    }
}