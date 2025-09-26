<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MonitorAccountPagePerformance extends Command
{
    protected $signature = 'monitor:account-performance {--user-id=1 : User ID to test} {--iterations=10 : Number of test iterations}';
    protected $description = 'Monitor and benchmark account page database queries performance';

    public function handle()
    {
        $userId = $this->option('user-id');
        $iterations = $this->option('iterations');
        
        $this->info("Testing account page performance for user ID: {$userId}");
        $this->info("Running {$iterations} iterations...");
        $this->newLine();

        $results = [];
        
        for ($i = 1; $i <= $iterations; $i++) {
            $this->info("Iteration {$i}/{$iterations}");
            
            $iterationResults = $this->runPerformanceTest($userId);
            $results[] = $iterationResults;
            
            $this->displayIterationResults($iterationResults);
            $this->newLine();
        }
        
        $this->displaySummary($results);
    }

    private function runPerformanceTest($userId)
    {
        $results = [];
        
        // Test 1: Devices Query
        $start = microtime(true);
        $devices = DB::table('devices')
            ->where('user_id', $userId)
            ->orderBy('last_active_at', 'desc')
            ->get();
        $results['devices'] = [
            'duration' => (microtime(true) - $start) * 1000,
            'count' => $devices->count()
        ];

        // Test 2: Devices Query Optimized (with limit and specific columns)
        $start = microtime(true);
        $devicesOptimized = DB::table('devices')
            ->select(['id', 'device_name', 'device_type', 'ip_address', 'location', 'last_active_at'])
            ->where('user_id', $userId)
            ->orderBy('last_active_at', 'desc')
            ->limit(10)
            ->get();
        $results['devices_optimized'] = [
            'duration' => (microtime(true) - $start) * 1000,
            'count' => $devicesOptimized->count()
        ];

        // Test 3: Subscriptions Query
        $start = microtime(true);
        $subscription = DB::table('subscriptions')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->first();
        $results['subscriptions'] = [
            'duration' => (microtime(true) - $start) * 1000,
            'found' => $subscription ? 1 : 0
        ];

        // Test 4: Subscriptions Query Optimized
        $start = microtime(true);
        $subscriptionOptimized = DB::table('subscriptions')
            ->select(['plan', 'status', 'started_at', 'expires_at', 'created_at'])
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->first();
        $results['subscriptions_optimized'] = [
            'duration' => (microtime(true) - $start) * 1000,
            'found' => $subscriptionOptimized ? 1 : 0
        ];

        // Test 5: Service Orders - Original (2 separate queries)
        $start = microtime(true);
        $activeOrders = DB::table('service_orders')
            ->where('user_id', $userId)
            ->whereIn('status', ['pending', 'in_progress', 'development'])
            ->count();
        
        $totalOrders = DB::table('service_orders')
            ->where('user_id', $userId)
            ->count();
        $results['service_orders_original'] = [
            'duration' => (microtime(true) - $start) * 1000,
            'active' => $activeOrders,
            'total' => $totalOrders
        ];

        // Test 6: Service Orders - Optimized (single query)
        $start = microtime(true);
        $serviceOrderStats = DB::table('service_orders')
            ->selectRaw('
                COUNT(*) as total_orders,
                SUM(CASE WHEN status IN (?, ?, ?) THEN 1 ELSE 0 END) as active_orders
            ', ['pending', 'in_progress', 'development'])
            ->where('user_id', $userId)
            ->first();
        $results['service_orders_optimized'] = [
            'duration' => (microtime(true) - $start) * 1000,
            'active' => $serviceOrderStats->active_orders ?? 0,
            'total' => $serviceOrderStats->total_orders ?? 0
        ];

        // Test 7: Recent Activities
        $start = microtime(true);
        try {
            $recentActivities = DB::table('user_login_activities')
                ->select(['ip_address', 'device_type', 'browser', 'login_status', 'login_at', 'is_suspicious'])
                ->where('user_id', $userId)
                ->orderBy('login_at', 'desc')
                ->limit(5)
                ->get();
            $results['recent_activities'] = [
                'duration' => (microtime(true) - $start) * 1000,
                'count' => $recentActivities->count()
            ];
        } catch (\Exception $e) {
            $results['recent_activities'] = [
                'duration' => 0,
                'count' => 0,
                'error' => $e->getMessage()
            ];
        }

        return $results;
    }

    private function displayIterationResults($results)
    {
        $this->table(
            ['Query', 'Duration (ms)', 'Records', 'Status'],
            [
                ['Devices (Original)', number_format($results['devices']['duration'], 2), $results['devices']['count'], ''],
                ['Devices (Optimized)', number_format($results['devices_optimized']['duration'], 2), $results['devices_optimized']['count'], $this->getOptimizationStatus($results['devices']['duration'], $results['devices_optimized']['duration'])],
                ['Subscriptions (Original)', number_format($results['subscriptions']['duration'], 2), $results['subscriptions']['found'], ''],
                ['Subscriptions (Optimized)', number_format($results['subscriptions_optimized']['duration'], 2), $results['subscriptions_optimized']['found'], $this->getOptimizationStatus($results['subscriptions']['duration'], $results['subscriptions_optimized']['duration'])],
                ['Service Orders (Original)', number_format($results['service_orders_original']['duration'], 2), $results['service_orders_original']['total'], ''],
                ['Service Orders (Optimized)', number_format($results['service_orders_optimized']['duration'], 2), $results['service_orders_optimized']['total'], $this->getOptimizationStatus($results['service_orders_original']['duration'], $results['service_orders_optimized']['duration'])],
                ['Recent Activities', number_format($results['recent_activities']['duration'], 2), $results['recent_activities']['count'], isset($results['recent_activities']['error']) ? 'ERROR' : 'OK'],
            ]
        );
    }

    private function displaySummary($results)
    {
        $this->info('=== PERFORMANCE SUMMARY ===');
        $this->newLine();

        $avgResults = [];
        $keys = array_keys($results[0]);
        
        foreach ($keys as $key) {
            $durations = array_column($results, $key);
            $durations = array_column($durations, 'duration');
            $avgResults[$key] = [
                'avg' => array_sum($durations) / count($durations),
                'min' => min($durations),
                'max' => max($durations)
            ];
        }

        $this->table(
            ['Query Type', 'Avg (ms)', 'Min (ms)', 'Max (ms)', 'Improvement'],
            [
                [
                    'Devices', 
                    number_format($avgResults['devices']['avg'], 2),
                    number_format($avgResults['devices']['min'], 2),
                    number_format($avgResults['devices']['max'], 2),
                    $this->calculateImprovement($avgResults['devices']['avg'], $avgResults['devices_optimized']['avg'])
                ],
                [
                    'Subscriptions', 
                    number_format($avgResults['subscriptions']['avg'], 2),
                    number_format($avgResults['subscriptions']['min'], 2),
                    number_format($avgResults['subscriptions']['max'], 2),
                    $this->calculateImprovement($avgResults['subscriptions']['avg'], $avgResults['subscriptions_optimized']['avg'])
                ],
                [
                    'Service Orders', 
                    number_format($avgResults['service_orders_original']['avg'], 2),
                    number_format($avgResults['service_orders_original']['min'], 2),
                    number_format($avgResults['service_orders_original']['max'], 2),
                    $this->calculateImprovement($avgResults['service_orders_original']['avg'], $avgResults['service_orders_optimized']['avg'])
                ],
                [
                    'Recent Activities', 
                    number_format($avgResults['recent_activities']['avg'], 2),
                    number_format($avgResults['recent_activities']['min'], 2),
                    number_format($avgResults['recent_activities']['max'], 2),
                    'N/A'
                ],
            ]
        );

        // Calculate total improvement
        $originalTotal = $avgResults['devices']['avg'] + 
                        $avgResults['subscriptions']['avg'] + 
                        $avgResults['service_orders_original']['avg'] + 
                        $avgResults['recent_activities']['avg'];

        $optimizedTotal = $avgResults['devices_optimized']['avg'] + 
                         $avgResults['subscriptions_optimized']['avg'] + 
                         $avgResults['service_orders_optimized']['avg'] + 
                         $avgResults['recent_activities']['avg'];

        $totalImprovement = $this->calculateImprovement($originalTotal, $optimizedTotal);

        $this->newLine();
        $this->info("Total Original Time: " . number_format($originalTotal, 2) . "ms");
        $this->info("Total Optimized Time: " . number_format($optimizedTotal, 2) . "ms");
        $this->info("Overall Improvement: {$totalImprovement}");
        
        if (strpos($totalImprovement, '%') !== false) {
            $improvement = (float) str_replace(['%', ' faster'], '', $totalImprovement);
            if ($improvement > 30) {
                $this->info("✅ Great optimization! Performance improved significantly.");
            } elseif ($improvement > 10) {
                $this->info("👍 Good optimization! Noticeable performance improvement.");
            } else {
                $this->warn("⚠️  Minor improvement. Consider additional optimizations.");
            }
        }
    }

    private function getOptimizationStatus($original, $optimized)
    {
        $improvement = (($original - $optimized) / $original) * 100;
        
        if ($improvement > 20) {
            return "✅ " . number_format($improvement, 1) . "% faster";
        } elseif ($improvement > 0) {
            return "👍 " . number_format($improvement, 1) . "% faster";
        } elseif ($improvement < -10) {
            return "❌ " . number_format(abs($improvement), 1) . "% slower";
        } else {
            return "➖ Similar";
        }
    }

    private function calculateImprovement($original, $optimized)
    {
        if ($original == 0) return 'N/A';
        
        $improvement = (($original - $optimized) / $original) * 100;
        
        if ($improvement > 0) {
            return number_format($improvement, 1) . "% faster";
        } elseif ($improvement < 0) {
            return number_format(abs($improvement), 1) . "% slower";
        } else {
            return "No change";
        }
    }
}
