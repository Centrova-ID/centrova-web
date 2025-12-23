<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Pre-compute data every 5 minutes (so it's always fresh)
        $schedule->command('data:precompute')
            ->everyFiveMinutes()
            ->runInBackground();

        // Warm cache for critical views every hour
        $schedule->command('cache:warm')
            ->hourly()
            ->runInBackground();

        // Clear old cached responses (keep cache fresh)
        $schedule->call(function () {
            // Clear responses older than 1 hour
            \Cache::flush(); // Or implement smarter cleanup
        })->daily();

        // Optimize application (run during low traffic)
        $schedule->command('optimize')
            ->dailyAt('03:00');
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
