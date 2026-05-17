<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\Withdrawal;
use App\Models\WithdrawalCard;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WithdrawalController extends Controller
{
    public function index()
    {
        $withdrawals = Withdrawal::with(['investment.plan', 'user.profile'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('dashboard.withdrawal.index', compact('withdrawals'));
    }

    public function generateCard(Request $request)
    {
        $user = Auth::user();

        if ($user->withdrawalCard) {
            return back()->with('error', 'Card already generated.');
        }

        WithdrawalCard::create([
            'user_id'      => $user->id,
            'card_number'  => str_pad(mt_rand(0, 9999999999999999), 16, '0', STR_PAD_LEFT),
            'pin'          => rand(1000, 9999),
            'name_on_card' => $user->name,
        ]);

        return back()->with('success', 'Withdrawal card generated!');
    }

    public function viewCard()
    {
        $card = WithdrawalCard::where('user_id', Auth::id())->first();

        if (!$card) {
            return redirect()->route('withdrawals.generateCard')
                ->with('error', 'No card found. Please generate one first and try again.');
        }

        return view('dashboard.user.card', compact('card'));
    }

    public function showWithdrawForm()
    {
        $user = Auth::user();

        if (!$user->withdrawalCard) {
            return back()->with('error', 'Please generate your withdrawal card before proceeding.');
        }

        return view('dashboard.withdrawal.withdrawer');
    }

    public function withdrawalList()
    {
        $withdrawals = auth()->user()
            ->withdrawals()
            ->with(['investment.plan', 'user.profile'])
            ->latest()
            ->get();

        return view('dashboard.withdrawal.index', compact('withdrawals'));
    }

    /**
     * AJAX: calculate fees preview for the withdrawal form.
     * Balance withdrawals only ever incur a bank transfer fee (if applicable).
     * Management & performance fees are NEVER charged on balance withdrawals.
     */
    public function calculateFees(Request $request)
    {
        $request->validate([
            'amount'         => 'required|numeric|min:0.01',
            'payment_method' => 'nullable|in:cryptocurrency,digital_wallet',
        ]);

        $grossAmount   = (float) $request->amount;
        $paymentMethod = $request->payment_method ?? 'cryptocurrency';

        // Bank fee: only applies when paying via bank transfer
        $bankFee = $paymentMethod === 'digital_wallet'
            ? round($grossAmount * 0.05, 2)
            : 0.0;

        $totalFees = $bankFee;
        $netAmount = round($grossAmount - $totalFees, 2);

        return response()->json([
            'total_management_fee'  => 0,
            'total_performance_fee' => 0,
            'bank_fee'              => $bankFee,
            'total_fees'            => $totalFees,
            'net_amount'            => $netAmount,
            'fee_breakdown'         => [],
        ]);
    }

    /**
     * Process a balance withdrawal (external — crypto or bank transfer).
     * Only a 5% bank transfer fee applies. No management or performance fees.
     */
    public function withdrawFromBalance(Request $request)
    {
        // Assemble PIN from 4 digit fields
        $cardPin = $request->digit1 . $request->digit2
                 . $request->digit3 . $request->digit4;
        $request->merge(['card_pin' => $cardPin]);

        $request->validate([
            'amount'         => 'required|numeric|min:1',
            'payment_method' => 'required|in:cryptocurrency,digital_wallet',
            'card_pin'       => 'required|string|size:4',
            'wallet_choice'  => 'required|string',
        ]);

        return DB::transaction(function () use ($request) {

            /** @var \App\Models\User $user */
            $user = User::where('id', auth()->id())->lockForUpdate()->first();
            $card = WithdrawalCard::where('user_id', $user->id)->first();

            // ── PIN check ─────────────────────────────────────────────
            if (!$card || (string) $card->pin !== (string) $request->card_pin) {
                return back()->with('error', 'Incorrect card PIN.');
            }

            $grossAmount = (float) $request->amount;

            // ── Balance check ─────────────────────────────────────────
            if ($grossAmount > $user->available_balance) {
                return back()->with('error', 'Insufficient balance.');
            }

            // ── Duplicate / spam guard ────────────────────────────────
            $recentPending = Withdrawal::where('user_id', $user->id)
                ->where('status', 'pending')
                ->where('created_at', '>=', now()->subMinute())
                ->exists();

            if ($recentPending) {
                return back()->with('error', 'Please wait a moment before submitting another request.');
            }

            // ── Fee calculation — bank fee only ───────────────────────
            // Management and performance fees are NEVER charged on balance withdrawals.
            // Those fees are already deducted when profits are moved from investments
            // into the available balance (via InvestmentController::withdraw / takeProfit).
            $bankFee   = $request->payment_method === 'digital_wallet'
                ? round($grossAmount * 0.05, 2)
                : 0.0;

            $totalFees = $bankFee;
            $netAmount = round($grossAmount - $totalFees, 2);

            // ── Net amount sanity check ───────────────────────────────
            if ($netAmount <= 0) {
                return back()->with('error',
                    'Your withdrawal amount ($' . number_format($grossAmount, 2) . ') '
                    . 'is fully consumed by the bank transfer fee ($' . number_format($totalFees, 2) . '). '
                    . 'Please withdraw a larger amount.'
                );
            }

            // ── Save withdrawal record ────────────────────────────────
            Withdrawal::create([
                'user_id'         => $user->id,
                'amount'          => $grossAmount,
                'net_amount'      => $netAmount,
                'management_fee'  => 0,
                'performance_fee' => 0,
                'bank_fee'        => $bankFee,
                'fee_breakdown'   => [],
                'payment_method'  => $request->payment_method,
                'wallet_choice'   => $request->wallet_choice,
                'status'          => 'pending',
                'investment_id'   => null,
                'type'            => Withdrawal::TYPE_BALANCE,
            ]);

            // ── Deduct gross amount from balance ──────────────────────
            $user->available_balance -= $grossAmount;
            $user->save();

            $message = $bankFee > 0
                ? sprintf(
                    'Withdrawal submitted! Amount: $%s | Bank Fee (5%%): $%s | You receive: $%s',
                    number_format($grossAmount, 2),
                    number_format($bankFee, 2),
                    number_format($netAmount, 2)
                )
                : sprintf(
                    'Withdrawal submitted! Amount: $%s — no fees applied.',
                    number_format($grossAmount, 2)
                );

            return redirect()->route('user.withdrawals.list')->with('success', $message);
        });
    }
}