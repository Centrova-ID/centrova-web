<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class OptimizePerformance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'performance:optimize {--force : Force optimization even in local environment}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run all performance optimizations for production';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (app()->environment('local') && !$this->option('force')) {
            $this->error('Performance optimization should be run in production. Use --force to override.');
            return 1;
        }

        $this->info('🚀 Starting Performance Optimization...');
        $this->newLine();

        // Step 1: Clear all caches
        $this->step('Clearing existing caches', function () {
            Artisan::call('cache:clear');
            Artisan::call('view:clear');
            Artisan::call('route:clear');
            Artisan::call('config:clear');
        });

        // Step 2: Optimize configuration
        $this->step('Caching configuration', function () {
            Artisan::call('config:cache');
        });

        // Step 3: Optimize routes
        $this->step('Caching routes', function () {
            Artisan::call('route:cache');
        });

        // Step 4: Optimize views
        $this->step('Compiling views', function () {
            Artisan::call('view:cache');
        });

        // Step 5: Optimize autoloader
        $this->step('Optimizing composer autoloader', function () {
            exec('composer dump-autoload -o', $output, $returnCode);
            if ($returnCode !== 0) {
                throw new \Exception('Composer optimization failed');
            }
        });

        // Step 6: Optimize event/listener discovery
        $this->step('Caching events', function () {
            Artisan::call('event:cache');
        });

        // Step 7: Pre-warm application cache
        $this->step('Pre-warming application cache', function () {
            $cacheService = app(\App\Services\CacheService::class);
            $cacheService->preWarmCache();
        });

        // Step 8: Build assets
        if (File::exists(base_path('package.json'))) {
            $this->step('Building production assets', function () {
                exec('npm run build', $output, $returnCode);
                if ($returnCode !== 0) {
                    $this->warn('Asset build had issues, but continuing...');
                }
            });
        }

        $this->newLine();
        $this->info('✅ Performance optimization complete!');
        $this->newLine();
        
        $this->showOptimizationTips();

        return 0;
    }

    protected function step(string $message, callable $callback)
    {
        $this->info("→ {$message}...");
        
        try {
            $callback();
            $this->line("  ✓ Done", 'info');
        } catch (\Exception $e) {
            $this->error("  ✗ Failed: {$e->getMessage()}");
            throw $e;
        }
    }

    protected function showOptimizationTips()
    {
        $this->line('📊 Performance Tips:', 'comment');
        $this->line('  • Enable OPcache in php.ini', 'comment');
        $this->line('  • Use Redis for cache and sessions', 'comment');
        $this->line('  • Consider Laravel Octane for even better performance', 'comment');
        $this->line('  • Monitor with: php artisan performance:benchmark', 'comment');
    }
}
