<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class PerformanceBenchmark extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'performance:benchmark 
                            {--url=/ : The URL to benchmark}
                            {--runs=10 : Number of runs}
                            {--warmup=3 : Number of warmup runs}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Benchmark application performance';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔥 Starting Performance Benchmark...');
        $this->newLine();

        $url = $this->option('url');
        $runs = (int) $this->option('runs');
        $warmup = (int) $this->option('warmup');

        // Run benchmarks
        $this->benchmarkDatabase();
        $this->newLine();
        
        $this->benchmarkCache();
        $this->newLine();
        
        $this->benchmarkHTTP($url, $runs, $warmup);
        $this->newLine();
        
        $this->showRecommendations();

        return 0;
    }

    protected function benchmarkDatabase()
    {
        $this->line('📊 Database Performance:', 'comment');

        // Test simple query
        $start = microtime(true);
        DB::table('users')->count();
        $simple = (microtime(true) - $start) * 1000;
        
        $this->line("  Simple query: " . number_format($simple, 2) . "ms");

        // Test with joins (if applicable)
        try {
            $start = microtime(true);
            DB::table('users')->limit(100)->get();
            $complex = (microtime(true) - $start) * 1000;
            $this->line("  Fetch 100 rows: " . number_format($complex, 2) . "ms");
        } catch (\Exception $e) {
            $this->warn("  Complex query test skipped");
        }

        // Check for missing indexes
        $this->checkMissingIndexes();
    }

    protected function benchmarkCache()
    {
        $this->line('💾 Cache Performance:', 'comment');

        // Test cache write
        $key = 'benchmark_test_' . time();
        $data = ['test' => 'data', 'timestamp' => time()];
        
        $start = microtime(true);
        Cache::put($key, $data, 60);
        $write = (microtime(true) - $start) * 1000;
        
        $this->line("  Cache write: " . number_format($write, 2) . "ms");

        // Test cache read
        $start = microtime(true);
        Cache::get($key);
        $read = (microtime(true) - $start) * 1000;
        
        $this->line("  Cache read: " . number_format($read, 2) . "ms");

        // Cleanup
        Cache::forget($key);

        // Show cache stats if Redis
        try {
            $cacheService = app(\App\Services\CacheService::class);
            $stats = $cacheService->getStats();
            
            if (!isset($stats['error'])) {
                $this->line("  Memory used: " . ($stats['memory_used'] ?? 'N/A'));
                $hitRate = isset($stats['hits'], $stats['misses']) 
                    ? round(($stats['hits'] / ($stats['hits'] + $stats['misses'])) * 100, 2) 
                    : 'N/A';
                $this->line("  Hit rate: {$hitRate}%");
            }
        } catch (\Exception $e) {
            // Cache stats not available
        }
    }

    protected function benchmarkHTTP($url, $runs, $warmup)
    {
        $this->line('🌐 HTTP Performance:', 'comment');
        
        $baseUrl = config('app.url');
        $fullUrl = $baseUrl . $url;

        $this->line("  Testing: {$fullUrl}");
        
        // Warmup runs
        $this->line("  Warming up ({$warmup} runs)...");
        for ($i = 0; $i < $warmup; $i++) {
            try {
                Http::timeout(10)->get($fullUrl);
            } catch (\Exception $e) {
                $this->error("  Warmup failed: " . $e->getMessage());
                return;
            }
        }

        // Actual benchmark runs
        $times = [];
        $this->line("  Running benchmark ({$runs} runs)...");
        
        $progressBar = $this->output->createProgressBar($runs);
        $progressBar->start();

        for ($i = 0; $i < $runs; $i++) {
            try {
                $start = microtime(true);
                $response = Http::timeout(10)->get($fullUrl);
                $duration = (microtime(true) - $start) * 1000;
                
                if ($response->successful()) {
                    $times[] = $duration;
                }
            } catch (\Exception $e) {
                $this->warn("\n  Request failed: " . $e->getMessage());
            }
            
            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine();

        if (empty($times)) {
            $this->error('  No successful requests');
            return;
        }

        // Calculate statistics
        $avg = array_sum($times) / count($times);
        $min = min($times);
        $max = max($times);
        sort($times);
        $median = $times[floor(count($times) / 2)];
        $p95 = $times[floor(count($times) * 0.95)];

        $this->newLine();
        $this->line("  Results:");
        $this->line("    Average: " . number_format($avg, 2) . "ms", $avg < 100 ? 'info' : 'comment');
        $this->line("    Median:  " . number_format($median, 2) . "ms");
        $this->line("    Min:     " . number_format($min, 2) . "ms");
        $this->line("    Max:     " . number_format($max, 2) . "ms");
        $this->line("    P95:     " . number_format($p95, 2) . "ms");

        // Performance grade
        if ($avg < 100) {
            $this->info("  Grade: 🌟 EXCELLENT (Target achieved!)");
        } elseif ($avg < 200) {
            $this->line("  Grade: ✅ GOOD", 'info');
        } elseif ($avg < 500) {
            $this->line("  Grade: ⚠️  FAIR", 'comment');
        } else {
            $this->line("  Grade: ❌ NEEDS IMPROVEMENT", 'error');
        }
    }

    protected function checkMissingIndexes()
    {
        // This is a basic check - you should customize based on your schema
        $this->line("\n  Checking for potential optimization opportunities...");
        
        try {
            // Example: Check for tables without indexes
            $tables = DB::select('SHOW TABLES');
            // Add your custom index checking logic here
            
            $this->line("  ℹ️  Run EXPLAIN on slow queries to identify missing indexes");
        } catch (\Exception $e) {
            // Skip if not supported
        }
    }

    protected function showRecommendations()
    {
        $this->line('💡 Optimization Recommendations:', 'comment');
        $this->newLine();

        $recommendations = [
            'Enable OPcache in production (php.ini)',
            'Use Redis for cache and sessions',
            'Enable route/config/view caching: php artisan performance:optimize',
            'Consider Laravel Octane for 2-4x performance boost',
            'Optimize database indexes on frequently queried columns',
            'Use eager loading to prevent N+1 query problems',
            'Enable HTTP/2 on your web server',
            'Use CDN for static assets',
            'Enable Gzip/Brotli compression',
            'Monitor with Laravel Telescope in development',
        ];

        foreach ($recommendations as $i => $rec) {
            $this->line('  ' . ($i + 1) . '. ' . $rec, 'comment');
        }
    }
}
