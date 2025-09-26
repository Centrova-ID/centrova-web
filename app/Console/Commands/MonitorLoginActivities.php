<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Account\UserLoginActivity;
use App\Models\Account\LoginAlert;
use Carbon\Carbon;

class MonitorLoginActivities extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'monitor:login-activities {--tail : Follow the activities in real-time}';

    /**
     * The description of the console command.
     */
    protected $description = 'Monitor login activities and alerts in real-time';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tail = $this->option('tail');
        
        if ($tail) {
            $this->info("Monitoring login activities in real-time... (Press Ctrl+C to stop)");
            $this->monitorRealTime();
        } else {
            $this->showRecentActivities();
        }
        
        return Command::SUCCESS;
    }
    
    /**
     * Monitor activities in real-time
     */
    private function monitorRealTime()
    {
        $lastActivityId = UserLoginActivity::max('id') ?? 0;
        $lastAlertId = LoginAlert::max('id') ?? 0;
        
        while (true) {
            // Check for new activities
            $newActivities = UserLoginActivity::where('id', '>', $lastActivityId)
                ->with('user')
                ->orderBy('id')
                ->get();
                
            foreach ($newActivities as $activity) {
                $this->displayActivity($activity);
                $lastActivityId = $activity->id;
            }
            
            // Check for new alerts
            $newAlerts = LoginAlert::where('id', '>', $lastAlertId)
                ->with(['user', 'loginActivity'])
                ->orderBy('id')
                ->get();
                
            foreach ($newAlerts as $alert) {
                $this->displayAlert($alert);
                $lastAlertId = $alert->id;
            }
            
            sleep(1); // Check every second
        }
    }
    
    /**
     * Show recent activities
     */
    private function showRecentActivities()
    {
        $this->info("Recent Login Activities (Last 24 hours):");
        
        $activities = UserLoginActivity::with('user')
            ->where('login_at', '>=', now()->subDay())
            ->orderBy('login_at', 'desc')
            ->limit(20)
            ->get();
            
        if ($activities->count() > 0) {
            $this->table(
                ['Time', 'User', 'Status', 'IP', 'Location', 'Device'],
                $activities->map(function ($activity) {
                    return [
                        $activity->login_at->format('H:i:s'),
                        $activity->user->name ?? 'Unknown',
                        $this->getStatusIcon($activity->login_status) . ' ' . ucfirst($activity->login_status),
                        $activity->ip_address,
                        $activity->location ?? 'Unknown',
                        $activity->device_type . ' - ' . $activity->browser
                    ];
                })->toArray()
            );
        } else {
            $this->warn("No recent activities found");
        }
        
        $this->newLine();
        $this->info("Recent Login Alerts (Last 24 hours):");
        
        $alerts = LoginAlert::with(['user', 'loginActivity'])
            ->where('alert_time', '>=', now()->subDay())
            ->orderBy('alert_time', 'desc')
            ->limit(10)
            ->get();
            
        if ($alerts->count() > 0) {
            $this->table(
                ['Time', 'User', 'Type', 'Severity', 'Status', 'Title'],
                $alerts->map(function ($alert) {
                    return [
                        $alert->alert_time->format('H:i:s'),
                        $alert->user->name ?? 'Unknown',
                        ucfirst(str_replace('_', ' ', $alert->alert_type)),
                        $this->getSeverityIcon($alert->severity) . ' ' . ucfirst($alert->severity),
                        $this->getAlertStatusIcon($alert->status) . ' ' . ucfirst($alert->status),
                        $alert->title
                    ];
                })->toArray()
            );
        } else {
            $this->warn("No recent alerts found");
        }
    }
    
    /**
     * Display new activity
     */
    private function displayActivity($activity)
    {
        $status = $this->getStatusIcon($activity->login_status);
        $time = $activity->login_at->format('H:i:s');
        $user = $activity->user->name ?? 'Unknown';
        
        $this->line(sprintf(
            "[%s] %s <info>%s</info> %s from <comment>%s</comment> (%s)",
            $time,
            $status,
            $user,
            $activity->login_status,
            $activity->ip_address,
            $activity->device_type
        ));
    }
    
    /**
     * Display new alert
     */
    private function displayAlert($alert)
    {
        $severity = $this->getSeverityIcon($alert->severity);
        $time = $alert->alert_time->format('H:i:s');
        $user = $alert->user->name ?? 'Unknown';
        
        $this->line(sprintf(
            "[%s] %s <error>ALERT</error> for <info>%s</info>: %s (%s)",
            $time,
            $severity,
            $user,
            $alert->title,
            $alert->severity
        ));
    }
    
    /**
     * Get status icon
     */
    private function getStatusIcon($status)
    {
        return match($status) {
            'success' => '✅',
            'failed' => '❌',
            'logout' => '👋',
            default => '❓'
        };
    }
    
    /**
     * Get severity icon
     */
    private function getSeverityIcon($severity)
    {
        return match($severity) {
            'critical' => '🚨',
            'high' => '⚠️',
            'medium' => '🔶',
            'low' => 'ℹ️',
            default => '❓'
        };
    }
    
    /**
     * Get alert status icon
     */
    private function getAlertStatusIcon($status)
    {
        return match($status) {
            'unread' => '🔵',
            'read' => '👁️',
            'dismissed' => '✅',
            'reported' => '🚩',
            default => '❓'
        };
    }
}
