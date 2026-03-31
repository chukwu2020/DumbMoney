<?php

namespace App\Console\Commands;

use App\Models\CopyTradingRequest;
use App\Models\Investment;
use App\Models\User;
use App\Notifications\TransactionNotification;
use Illuminate\Console\Command;

class CheckExpiredInvestments extends Command
{
    protected $signature = 'investments:check-expired';
    protected $description = 'Check for expired investments and mark them as completed';

    public function handle()
    {
        $expiredInvestments = Investment::where('status', 'active')
            ->where('end_date', '<=', now())
            ->get();

        foreach ($expiredInvestments as $investment) {
            $investment->updateValue();

            $investment->status = 'completed';
            $investment->save();

            $request = CopyTradingRequest::where('user_id', $investment->user_id)
                ->where('plan_id', $investment->plan_id)
                ->where('status', 'approved')
                ->latest()
                ->first();

            if ($request) {
                $request->update([
                    'final_profit_loss'          => $investment->profit_loss,
                    'final_return_percentage'    => $investment->profit_loss_percentage,
                    'snapshot_duration_unit'     => $investment->snapshot_duration_unit,
                    'snapshot_duration_value'    => $investment->snapshot_duration_value,
                    'snapshot_interest_rate'     => $investment->snapshot_interest_rate,
                    'completed_at'               => now(),
                ]);
            }

            try {
                $user = User::find($investment->user_id);
                $profitAmount = number_format($investment->profit_loss, 2);

                $message = $investment->profit_loss >= 0
                    ? "✅ Your investment of \${$investment->amount_invested} has completed with a profit of \${$profitAmount}!"
                    : "📉 Your investment of \${$investment->amount_invested} has completed with a loss of \${$profitAmount}.";

                $user->notify(new TransactionNotification('Investment Completed', $message));
            } catch (\Exception $e) {
                \Log::error('Notification failed: ' . $e->getMessage());
            }
        }

        $this->info("Processed " . $expiredInvestments->count() . " expired investments.");
    }
}