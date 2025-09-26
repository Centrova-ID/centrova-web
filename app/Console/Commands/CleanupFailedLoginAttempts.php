<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\FailedLoginAttempt;

class CleanupFailedLoginAttempts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:cleanup-failed-attempts {--days=7 : Number of days to keep failed attempts}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up old failed login attempts from the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = (int) $this->option('days');
        
        $this->info("Cleaning up failed login attempts older than {$days} days...");
        
        $deletedCount = FailedLoginAttempt::cleanupOldAttempts($days);
        
        $this->info("Successfully deleted {$deletedCount} old failed login attempts.");
        
        return 0;
    }
}
