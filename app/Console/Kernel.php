<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
   

    protected function schedule(Schedule $schedule)
{
    // Updates profit daily at midnight
    $schedule->command('app:update-investment-profit')->dailyAt('00:00');

    // Checks expired investments every 5 minutes
    $schedule->command('investments:check-expired')->everyFiveMinutes();

    // Updates current values every hour
    $schedule->command('investments:update-values')->hourly();

    // Generate sitemap weekly
    $schedule->command('app:generate-sitemap')->weekly();
}

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}