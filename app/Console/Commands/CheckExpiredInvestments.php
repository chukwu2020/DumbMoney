<?php
// app/Console/Commands/CheckExpiredInvestments.php

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
        // Find investments that have ended but are still active
        $expiredInvestments = Investment::where('status', 'active')
            ->where('end_date', '<=', now())
            ->get();

        foreach ($expiredInvestments as $investment) {
            // First, calculate final profit
            $investment->updateValue();
            
            // Mark as completed
            $investment->status = 'completed';
            $investment->save();

            // Find and update the original request with final data (snapshot)
            $request = CopyTradingRequest::where('user_id', $investment->user_id)
                ->where('plan_id', $investment->plan_id)
                ->where('status', 'approved')
                ->latest()
                ->first();

            if ($request) {
                $request->update([
                    'final_profit_loss' => $investment->profit_loss,
                    'final_return_percentage' => $investment->profit_loss_percentage,
                    'snapshot_duration_unit' => $investment->duration_unit,
                    'snapshot_duration_value' => $investment->duration_value,
                    'snapshot_interest_rate' => $investment->investment_interest_rate,
                    'completed_at' => now(),
                ]);
            }

            // Notify user
            try {
                $user = User::find($investment->user_id);
                $profitAmount = $investment->profit_loss;
                
                $message = $profitAmount >= 0 
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