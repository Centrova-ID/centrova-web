<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Failed;
use App\Models\User;
use App\Services\LoginActivityService;

class TestLoginEvents extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'test:login-events {--user-id=1 : User ID to test with}';

    /**
     * The description of the console command.
     */
    protected $description = 'Test login event system for login alerts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = $this->option('user-id');
        $user = User::find($userId);
        
        if (!$user) {
            $this->error("User with ID {$userId} not found");
            return Command::FAILURE;
        }
        
        $this->info("Testing login events for user: {$user->name} (ID: {$user->id})");
        
        // Test successful login event
        $this->info("1. Testing successful login event...");
        Event::dispatch(new Login('web', $user, false));
        $this->info("✓ Successful login event dispatched");
        
        // Wait a moment
        sleep(1);
        
        // Test failed login event
        $this->info("2. Testing failed login event...");
        Event::dispatch(new Failed('web', $user, ['email' => $user->email, 'password' => 'wrong']));
        $this->info("✓ Failed login event dispatched");
        
        // Wait a moment
        sleep(1);
        
        // Check if activities were recorded
        $loginActivityService = app(LoginActivityService::class);
        $recentActivities = $loginActivityService->getRecentActivities($user->id, 5);
        
        $this->info("3. Recent login activities:");
        if ($recentActivities->count() > 0) {
            $this->table(
                ['ID', 'Status', 'IP', 'Browser', 'Device', 'Time'],
                $recentActivities->map(function ($activity) {
                    return [
                        $activity->id,
                        $activity->login_status,
                        $activity->ip_address,
                        $activity->browser,
                        $activity->device_type,
                        $activity->login_at->diffForHumans()
                    ];
                })->toArray()
            );
        } else {
            $this->warn("No recent activities found");
        }
        
        // Check alerts
        $alertStats = app(\App\Services\LoginAlertService::class)->getAlertStats($user->id);
        $this->info("4. Login Alert Statistics:");
        $this->table(
            ['Metric', 'Count'],
            [
                ['Total Alerts', $alertStats['total_alerts']],
                ['Unread Alerts', $alertStats['unread_count']],
                ['Critical Alerts', $alertStats['critical_count']],
                ['Recent Alerts (7 days)', $alertStats['recent_count']],
            ]
        );
        
        $this->info("✅ Login event testing completed!");
        
        return Command::SUCCESS;
    }
}
