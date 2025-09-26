<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\RealTimeDeviceService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class TestRealTimeSystem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:realtime-system {user_id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test real-time device system performance and accuracy';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = $this->argument('user_id') ?? 1;
        $user = User::find($userId);
        
        if (!$user) {
            $this->error("User with ID {$userId} not found");
            return;
        }
        
        $this->info("Testing real-time system for user: {$user->name} (ID: {$userId})");
        $this->line('');
        
        // Test 1: Current sessions
        $sessions = DB::connection('account')->table('sessions')
            ->where('user_id', $userId)
            ->get();
        $this->info("1. Total Sessions in DB: " . $sessions->count());
        
        // Test 2: Active sessions (30 days)
        $activeSessions = DB::connection('account')->table('sessions')
            ->where('user_id', $userId)
            ->where('last_activity', '>=', now()->subDays(30)->timestamp)
            ->get();
        $this->info("2. Active Sessions (30 days): " . $activeSessions->count());
        
        // Test 3: Device service
        $deviceService = app(RealTimeDeviceService::class);
        $deviceData = $deviceService->getRealTimeDevices($user);
        $this->info("3. Device Service Count: " . count($deviceData['devices']));
        $this->info("4. Device Stats Total: " . $deviceData['stats']['total_devices']);
        $this->info("5. Active Now: " . $deviceData['stats']['active_now']);
        
        // Test 4: Cache status
        $cacheKey = "realtime_devices_user_{$userId}";
        $cached = Cache::get($cacheKey);
        $this->info("6. Cache Status: " . ($cached ? 'HIT' : 'MISS'));
        
        // Test 5: Performance test
        $this->line('');
        $this->info('Performance Test:');
        $start = microtime(true);
        for ($i = 0; $i < 10; $i++) {
            $deviceService->getRealTimeDevices($user);
        }
        $end = microtime(true);
        $avgTime = ($end - $start) / 10 * 1000;
        $this->info("Average response time: " . round($avgTime, 2) . "ms");
        
        // Test 6: Cache clearing
        $this->line('');
        $this->info('Testing cache clearing...');
        $deviceService->clearCache($userId);
        $cached = Cache::get($cacheKey);
        $this->info("Cache after clearing: " . ($cached ? 'STILL EXISTS' : 'CLEARED'));
        
        $this->line('');
        $this->info('Real-time system test completed!');
    }
}
