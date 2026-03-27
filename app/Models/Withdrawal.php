<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const TYPE_BALANCE    = 'balance';
    public const TYPE_INVESTMENT = 'investment_transfer';
    public const TYPE_PROFIT     = 'profit';

    public const BANK_TRANSFER_FEE_PERCENT = 5;

    protected $casts = [
        'amount'          => 'decimal:2',
        'net_amount'      => 'decimal:2',
        'management_fee'  => 'decimal:2',
        'performance_fee' => 'decimal:2',
        'bank_fee'        => 'decimal:2',
        'fee_breakdown'   => 'array',
        'wallet_choice'   => 'string',
        'created_at'      => 'datetime',
        'updated_at'      => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function investment()
    {
        return $this->belongsTo(Investment::class);
    }

    /**
     * Calculate all fees for a given withdrawal.
     *
     * Looks at all investments that are NOT yet fully withdrawn so the user
     * can't escape fees by letting an investment complete before withdrawing
     * their balance.
     *
     * Returns:
     *   total_management_fee, total_performance_fee, bank_fee,
     *   total_fees, net_amount, fee_breakdown, has_fees
     */
    public static function calculateAllFees(
        float $grossAmount,
        string $paymentMethod,
        \App\Models\User $user
    ): array {
        $totalManagementFee  = 0.0;
        $totalPerformanceFee = 0.0;
        $feeBreakdown        = [];

        // ── Plan-based fees: active OR completed-but-not-yet-withdrawn ─
        // We include completed investments because the user may have cashed
        // them into their balance (via InvestmentController::withdraw) already
        // — but if they haven't, the fees are still outstanding.
        $investments = Investment::where('user_id', $user->id)
            ->whereIn('status', ['active', 'completed'])   // ✅ include completed too
            ->with('plan')
            ->get();

        foreach ($investments as $investment) {
            if (!$investment->plan) continue;

            // Use the live calculated profit (not stale DB value)
            $profitEarned = $investment->calculateActualProfitEarned();

            // Never double-charge — subtract already-deducted amounts
            $alreadyDeductedMgmt = floatval($investment->management_fee_deducted  ?? 0);
            $alreadyDeductedPerf = floatval($investment->performance_fee_deducted ?? 0);

            $chargeableProfitMgmt = max(0, $profitEarned - $alreadyDeductedMgmt);
            $chargeableProfitPerf = max(0, $profitEarned - $alreadyDeductedPerf);

            $managementFeePercent  = floatval($investment->plan->management_fee  ?? 0);
            $performanceFeePercent = floatval($investment->plan->performance_fee ?? 0);

            $managementFee  = $managementFeePercent  > 0
                ? ($chargeableProfitMgmt * $managementFeePercent)  / 100
                : 0;
            $performanceFee = $performanceFeePercent > 0
                ? ($chargeableProfitPerf * $performanceFeePercent) / 100
                : 0;

            $totalManagementFee  += $managementFee;
            $totalPerformanceFee += $performanceFee;

            if ($managementFee > 0 || $performanceFee > 0) {
                $feeBreakdown[] = [
                    'investment_id'              => $investment->id,
                    'plan_name'                  => $investment->plan->name,
                    'amount_invested'            => (float) $investment->amount_invested,
                    'profit_earned'              => round($profitEarned, 2),
                    'management_fee_percentage'  => $managementFeePercent,
                    'management_fee'             => round($managementFee, 2),
                    'performance_fee_percentage' => $performanceFeePercent,
                    'performance_fee'            => round($performanceFee, 2),
                ];
            }
        }

        // ── Bank transfer fee (flat %) ─────────────────────────────────
        $bankFee = 0.0;
        if ($paymentMethod === 'digital_wallet') {
            $bankFee = ($grossAmount * self::BANK_TRANSFER_FEE_PERCENT) / 100;
        }

        $totalFees = $totalManagementFee + $totalPerformanceFee + $bankFee;
        $netAmount = max(0, $grossAmount - $totalFees);

        return [
            'total_management_fee'  => round($totalManagementFee,  2),
            'total_performance_fee' => round($totalPerformanceFee, 2),
            'bank_fee'              => round($bankFee,              2),
            'total_fees'            => round($totalFees,            2),
            'net_amount'            => round($netAmount,            2),
            'fee_breakdown'         => $feeBreakdown,
            'has_fees'              => $totalFees > 0,
        ];
    }
}