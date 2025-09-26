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
        // GDPR Data Cleanup - Daily at 2 AM
        $schedule->command('data:cleanup')
            ->dailyAt('02:00')
            ->withoutOverlapping()
            ->runInBackground()
            ->emailOutputOnFailure('privacy@centrova.com');

        // Weekly cleanup with specific types
        $schedule->command('data:cleanup --type=login_activities')
            ->weekly()
            ->sundays()
            ->at('03:00');
            
        // Monthly cleanup for inactive accounts
        $schedule->command('data:cleanup --type=inactive_user_accounts')
            ->monthly()
            ->withoutOverlapping();
            
        // Daily cleanup of failed login attempts older than 7 days
        $schedule->command('auth:cleanup-failed-attempts --days=7')
            ->dailyAt('01:30')
            ->withoutOverlapping();
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
