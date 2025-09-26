<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MonitorDevicesPagePerformance extends Command
{
    protected $signature = 'monitor:devices-performance {--user-id=1 : User ID to test} {--iterations=5 : Number of test iterations}';
    protected $description = 'Monitor and benchmark devices page database queries performance';

    public function handle()
    {
        $userId = $this->option('user-id');
        $iterations = $this->option('iterations');
        
        $this->info("Testing devices page performance for user ID: {$userId}");
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
        
        // Test 1: Get All User Sessions (Main query)
        $start = microtime(true);
        $sessions = DB::connection('account')->table('sessions')
            ->where('user_id', $userId)
            ->orderBy('last_activity', 'desc')
            ->get();
        $results['all_sessions'] = [
            'duration' => (microtime(true) - $start) * 1000,
            'count' => $sessions->count()
        ];

        // Test 2: Get Active Sessions (with time filter)
        $start = microtime(true);
        $activeThreshold = now()->subMinutes(30)->timestamp;
        $activeSessions = DB::connection('account')->table('sessions')
            ->where('user_id', $userId)
            ->where('last_activity', '>=', $activeThreshold)
            ->orderBy('last_activity', 'desc')
            ->get();
        $results['active_sessions'] = [
            'duration' => (microtime(true) - $start) * 1000,
            'count' => $activeSessions->count()
        ];

        // Test 3: Get Session by ID (session detail query)
        $start = microtime(true);
        $sessionDetail = null;
        if ($sessions->isNotEmpty()) {
            $firstSessionId = $sessions->first()->id;
            $sessionDetail = DB::connection('account')->table('sessions')
                ->where('id', $firstSessionId)
                ->where('user_id', $userId)
                ->first();
        }
        $results['session_detail'] = [
            'duration' => (microtime(true) - $start) * 1000,
            'found' => $sessionDetail ? 1 : 0
        ];

        // Test 4: Device Stats Queries (grouped counts)
        $start = microtime(true);
        $deviceStats = DB::connection('account')->table('sessions')
            ->selectRaw('
                COUNT(*) as total_sessions,
                COUNT(CASE WHEN last_activity >= ? THEN 1 END) as active_sessions,
                COUNT(DISTINCT ip_address) as unique_ips
            ')
            ->where('user_id', $userId)
            ->addBinding($activeThreshold, 'select')
            ->first();
        $results['device_stats'] = [
            'duration' => (microtime(true) - $start) * 1000,
            'total' => $deviceStats->total_sessions ?? 0,
            'active' => $deviceStats->active_sessions ?? 0,
            'unique_ips' => $deviceStats->unique_ips ?? 0
        ];

        // Test 5: Recent Login Activities Query
        $start = microtime(true);
        try {
            $recentLoginActivities = DB::connection('account')->table('user_login_activities')
                ->select(['ip_address', 'device_type', 'browser', 'login_status', 'login_at', 'location'])
                ->where('user_id', $userId)
                ->where('login_status', 'success')
                ->orderBy('login_at', 'desc')
                ->limit(10)
                ->get();
            $results['recent_login_activities'] = [
                'duration' => (microtime(true) - $start) * 1000,
                'count' => $recentLoginActivities->count()
            ];
        } catch (\Exception $e) {
            $results['recent_login_activities'] = [
                'duration' => 0,
                'count' => 0,
                'error' => $e->getMessage()
            ];
        }

        // Test 6: Login Activity by IP (for session detail)
        $start = microtime(true);
        try {
            if ($sessions->isNotEmpty()) {
                $firstSessionIp = $sessions->first()->ip_address;
                $loginByIp = DB::connection('account')->table('user_login_activities')
                    ->where('user_id', $userId)
                    ->where('ip_address', $firstSessionIp)
                    ->where('login_status', 'success')
                    ->orderBy('login_at', 'desc')
                    ->first();
                $results['login_by_ip'] = [
                    'duration' => (microtime(true) - $start) * 1000,
                    'found' => $loginByIp ? 1 : 0
                ];
            } else {
                $results['login_by_ip'] = [
                    'duration' => 0,
                    'found' => 0
                ];
            }
        } catch (\Exception $e) {
            $results['login_by_ip'] = [
                'duration' => 0,
                'found' => 0,
                'error' => $e->getMessage()
            ];
        }

        // Test 7: Session Deletion Query (for revoke functionality)
        $start = microtime(true);
        // Simulate the query without actually deleting
        $revokeQuery = DB::connection('account')->table('sessions')
            ->where('user_id', $userId)
            ->where('id', '!=', 'current_session_id_placeholder');
        // Just get the query time without executing delete
        $revokeCount = $revokeQuery->count();
        $results['revoke_query'] = [
            'duration' => (microtime(true) - $start) * 1000,
            'count' => $revokeCount
        ];

        // Test 8: Device Filtering by Type
        $start = microtime(true);
        $devicesByType = DB::connection('account')->table('sessions')
            ->select(['user_agent', DB::raw('COUNT(*) as count')])
            ->where('user_id', $userId)
            ->groupBy('user_agent')
            ->get();
        $results['devices_by_type'] = [
            'duration' => (microtime(true) - $start) * 1000,
            'types' => $devicesByType->count()
        ];

        return $results;
    }

    private function displayIterationResults($results)
    {
        $this->table(
            ['Query', 'Duration (ms)', 'Records/Results', 'Status'],
            [
                ['All Sessions', number_format($results['all_sessions']['duration'], 2), $results['all_sessions']['count'], ''],
                ['Active Sessions', number_format($results['active_sessions']['duration'], 2), $results['active_sessions']['count'], $this->getOptimizationStatus($results['all_sessions']['duration'], $results['active_sessions']['duration'])],
                ['Session Detail', number_format($results['session_detail']['duration'], 2), $results['session_detail']['found'], ''],
                ['Device Stats', number_format($results['device_stats']['duration'], 2), "T:{$results['device_stats']['total']}, A:{$results['device_stats']['active']}", ''],
                ['Recent Login Activities', number_format($results['recent_login_activities']['duration'], 2), $results['recent_login_activities']['count'], isset($results['recent_login_activities']['error']) ? 'ERROR' : 'OK'],
                ['Login by IP', number_format($results['login_by_ip']['duration'], 2), $results['login_by_ip']['found'], isset($results['login_by_ip']['error']) ? 'ERROR' : 'OK'],
                ['Revoke Query', number_format($results['revoke_query']['duration'], 2), $results['revoke_query']['count'], ''],
                ['Devices by Type', number_format($results['devices_by_type']['duration'], 2), $results['devices_by_type']['types'], ''],
            ]
        );
    }

    private function displaySummary($results)
    {
        $this->info('=== DEVICES PAGE PERFORMANCE SUMMARY ===');
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
            ['Query Type', 'Avg (ms)', 'Min (ms)', 'Max (ms)', 'Performance Level'],
            [
                [
                    'All Sessions', 
                    number_format($avgResults['all_sessions']['avg'], 2),
                    number_format($avgResults['all_sessions']['min'], 2),
                    number_format($avgResults['all_sessions']['max'], 2),
                    $this->getPerformanceLevel($avgResults['all_sessions']['avg'])
                ],
                [
                    'Active Sessions', 
                    number_format($avgResults['active_sessions']['avg'], 2),
                    number_format($avgResults['active_sessions']['min'], 2),
                    number_format($avgResults['active_sessions']['max'], 2),
                    $this->getPerformanceLevel($avgResults['active_sessions']['avg'])
                ],
                [
                    'Session Detail', 
                    number_format($avgResults['session_detail']['avg'], 2),
                    number_format($avgResults['session_detail']['min'], 2),
                    number_format($avgResults['session_detail']['max'], 2),
                    $this->getPerformanceLevel($avgResults['session_detail']['avg'])
                ],
                [
                    'Device Stats', 
                    number_format($avgResults['device_stats']['avg'], 2),
                    number_format($avgResults['device_stats']['min'], 2),
                    number_format($avgResults['device_stats']['max'], 2),
                    $this->getPerformanceLevel($avgResults['device_stats']['avg'])
                ],
                [
                    'Recent Activities', 
                    number_format($avgResults['recent_login_activities']['avg'], 2),
                    number_format($avgResults['recent_login_activities']['min'], 2),
                    number_format($avgResults['recent_login_activities']['max'], 2),
                    $this->getPerformanceLevel($avgResults['recent_login_activities']['avg'])
                ],
                [
                    'Login by IP', 
                    number_format($avgResults['login_by_ip']['avg'], 2),
                    number_format($avgResults['login_by_ip']['min'], 2),
                    number_format($avgResults['login_by_ip']['max'], 2),
                    $this->getPerformanceLevel($avgResults['login_by_ip']['avg'])
                ],
                [
                    'Revoke Query', 
                    number_format($avgResults['revoke_query']['avg'], 2),
                    number_format($avgResults['revoke_query']['min'], 2),
                    number_format($avgResults['revoke_query']['max'], 2),
                    $this->getPerformanceLevel($avgResults['revoke_query']['avg'])
                ],
                [
                    'Devices by Type', 
                    number_format($avgResults['devices_by_type']['avg'], 2),
                    number_format($avgResults['devices_by_type']['min'], 2),
                    number_format($avgResults['devices_by_type']['max'], 2),
                    $this->getPerformanceLevel($avgResults['devices_by_type']['avg'])
                ],
            ]
        );

        // Calculate total page load time
        $totalTime = $avgResults['all_sessions']['avg'] + 
                    $avgResults['active_sessions']['avg'] + 
                    $avgResults['device_stats']['avg'] + 
                    $avgResults['recent_login_activities']['avg'];

        $this->newLine();
        $this->info("Estimated Total Page Load Time: " . number_format($totalTime, 2) . "ms");
        
        if ($totalTime < 50) {
            $this->info("✅ Excellent performance! Devices page loads very fast.");
        } elseif ($totalTime < 100) {
            $this->info("👍 Good performance! Devices page loads efficiently.");
        } elseif ($totalTime < 200) {
            $this->info("⚠️  Moderate performance. Consider optimization for better user experience.");
        } else {
            $this->warn("❌ Poor performance. Optimization strongly recommended.");
        }

        $this->newLine();
        $this->info("💡 Performance Tips:");
        $this->info("• Sessions queries should be < 10ms with proper indexing");
        $this->info("• Login activities queries should be < 20ms");
        $this->info("• Consider pagination for users with many sessions");
        $this->info("• Use caching for device statistics if they don't need real-time updates");
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

    private function getPerformanceLevel($avgTime)
    {
        if ($avgTime < 5) {
            return "🚀 Excellent";
        } elseif ($avgTime < 15) {
            return "✅ Good";
        } elseif ($avgTime < 30) {
            return "⚠️  Fair";
        } else {
            return "❌ Needs Optimization";
        }
    }
}
