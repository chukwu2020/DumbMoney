<?php

namespace App\Console\Commands;

use App\Models\Investment;
use Carbon\Carbon;
use Illuminate\Console\Command;

class FixExistingInvestments extends Command
{
    protected $signature = 'investments:fix-existing';
    protected $description = 'Fix existing investments by calculating correct values';

    public function handle()
    {
        $investments = Investment::with('plan')->where('type', 'copy_trading')->get();

        if ($investments->count() === 0) {
            $this->info('No copy trading investments found.');
            return;
        }

        $updated   = 0;
        $completed = 0;

        foreach ($investments as $investment) {
            $this->info("Processing investment ID: {$investment->id}");

            // ✅ Use the plan's actual duration_unit — no 'days' fallback override
            if (!$investment->snapshot_duration_value && $investment->plan) {
                $investment->snapshot_duration_value = $investment->plan->duration;
                $investment->snapshot_duration_unit  = $investment->plan->duration_unit; // ✅ no ?? 'days'
                $investment->snapshot_interest_rate  = $investment->plan->interest_rate;
                $investment->snapshot_plan_name      = $investment->plan->name;
                $investment->save();
                $this->info("  - Added snapshot data from plan (unit: {$investment->snapshot_duration_unit})");
            }

            $interestRate   = $investment->snapshot_interest_rate ?? ($investment->plan->interest_rate ?? 0);
            $expectedProfit = ($investment->amount_invested * $interestRate) / 100;

            $start = Carbon::parse($investment->start_date);
            $end   = Carbon::parse($investment->end_date);
            $now   = now();

            $progress = 0;
            if ($now->gte($end)) {
                $progress = 100;
            } elseif ($now->gt($start)) {
                $totalSeconds   = $start->diffInSeconds($end);
                $elapsedSeconds = $start->diffInSeconds($now);
                $progress       = $totalSeconds > 0 ? round(($elapsedSeconds / $totalSeconds) * 100, 2) : 0;
            }

            $currentProfit = ($expectedProfit * $progress) / 100;

            $investment->profit_loss    = $currentProfit;
            $investment->current_value  = $investment->amount_invested + $currentProfit;
            $investment->expected_profit = $expectedProfit;

            if ($now->gte($end) && $investment->status === 'active') {
                $investment->status = 'completed';
                $completed++;
                $this->info("  - Marked as COMPLETED");
            }

            $investment->save();
            $updated++;

            $this->info("  - Unit: {$investment->snapshot_duration_unit}, Amount: \${$investment->amount_invested}, Rate: {$interestRate}%, Profit: \${$currentProfit}, Progress: {$progress}%");
            $this->info("  - End Date: {$investment->end_date}, Status: {$investment->status}");
            $this->info("---");
        }

        $this->info("✅ Fixed {$updated} investments.");
        $this->info("✅ Completed {$completed} investments.");
    }
}