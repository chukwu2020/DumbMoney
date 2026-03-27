<?php
// app/Console/Commands/UpdateInvestmentValues.php

namespace App\Console\Commands;

use App\Models\Investment;
use Illuminate\Console\Command;

class UpdateInvestmentValues extends Command
{
    protected $signature = 'investments:update-values';
    protected $description = 'Update investment current values based on time elapsed and interest rate';

    public function handle()
    {
        $investments = Investment::where('status', 'active')->get();
        
        if ($investments->count() === 0) {
            $this->info('No active investments to update.');
            return;
        }

        $updated = 0;
        
        foreach ($investments as $investment) {
            // Update the value based on time elapsed and interest rate
            $investment->updateValue();
            $updated++;
        }
        
        $this->info("Updated {$updated} active investments with new values.");
    }
}