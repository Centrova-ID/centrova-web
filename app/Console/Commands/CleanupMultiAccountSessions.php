<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\MultiAccountService;

class CleanupMultiAccountSessions extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'multi-account:cleanup {--hours=24 : Number of hours old sessions to clean up}';

    /**
     * The console command description.
     */
    protected $description = 'Clean up expired multi-account sessions';

    protected MultiAccountService $multiAccountService;

    /**
     * Create a new command instance.
     */
    public function __construct(MultiAccountService $multiAccountService)
    {
        parent::__construct();
        $this->multiAccountService = $multiAccountService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $hours = $this->option('hours');
        
        $this->info("Cleaning up multi-account sessions older than {$hours} hours...");
        
        $deletedCount = $this->multiAccountService->cleanup();
        
        $this->info("Cleaned up {$deletedCount} expired multi-account sessions.");
        
        return Command::SUCCESS;
    }
}
