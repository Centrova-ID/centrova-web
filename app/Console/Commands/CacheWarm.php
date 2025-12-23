<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CacheWarm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:warm {--force : Force cache warming}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pre-warm application cache for critical routes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔥 Warming up cache...');
        $this->newLine();

        if (!config('performance.cache.pre_warm.enabled') && !$this->option('force')) {
            $this->warn('Cache pre-warming is disabled. Use --force to override.');
            return 1;
        }

        $cacheService = app(\App\Services\CacheService::class);
        
        try {
            $cacheService->preWarmCache();
            $this->info('✅ Cache warmed successfully!');
        } catch (\Exception $e) {
            $this->error('❌ Cache warming failed: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
