<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Account\UserLoginActivity;
use App\Models\Account\LoginAlert;
use Carbon\Carbon;

class LoginDashboard extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'login:dashboard {--refresh=5 : Refresh interval in seconds}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dashboard real-time untuk monitoring login activities dan alerts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $refreshInterval = $this->option('refresh');
        
        $this->info("🔄 Login Security Dashboard (Refresh setiap {$refreshInterval}s)");
        $this->line("Tekan Ctrl+C untuk keluar");
        $this->line("");
        
        while (true) {
            // Clear screen
            $this->line("\033[2J\033[H");
            
            $this->showHeader();
            $this->showStatistics();
            $this->showRecentActivities();
            $this->showActiveAlerts();
            $this->showSecurityMetrics();
            
            $this->line("");
            $this->info("🔄 Refresh setiap {$refreshInterval}s - " . Carbon::now()->format('H:i:s'));
            
            sleep($refreshInterval);
        }
    }
    
    private function showHeader()
    {
        $this->line("╔═══════════════════════════════════════════════════════════════════╗");
        $this->line("║                    🔒 LOGIN SECURITY DASHBOARD                    ║");
        $this->line("║                     " . Carbon::now()->format('d M Y - H:i:s') . "                      ║");
        $this->line("╚═══════════════════════════════════════════════════════════════════╝");
        $this->line("");
    }
    
    private function showStatistics()
    {
        $this->info("📊 STATISTIK UMUM");
        $this->line("├─────────────────────────────────────────────────────────────────┤");
        
        // Total statistik
        $totalActivities = UserLoginActivity::count();
        $totalAlerts = LoginAlert::count();
        $unreadAlerts = LoginAlert::where('status', 'unread')->count();
        $criticalAlerts = LoginAlert::where('severity', 'critical')->where('status', 'unread')->count();
        
        // Hari ini
        $today = Carbon::today();
        $todayActivities = UserLoginActivity::whereDate('created_at', $today)->count();
        $todayAlerts = LoginAlert::whereDate('created_at', $today)->count();
        
        // Status breakdown hari ini
        $todaySuccess = UserLoginActivity::whereDate('created_at', $today)
            ->where('login_status', 'success')->count();
        $todayFailed = UserLoginActivity::whereDate('created_at', $today)
            ->where('login_status', 'failed')->count();
        $todayLogout = UserLoginActivity::whereDate('created_at', $today)
            ->where('login_status', 'logout')->count();
        
        $this->line("│ Total Activities: <fg=cyan>{$totalActivities}</> | Total Alerts: <fg=yellow>{$totalAlerts}</> | Unread: <fg=red>{$unreadAlerts}</> | Critical: <fg=red;options=bold>{$criticalAlerts}</> │");
        $this->line("│ Hari ini: <fg=green>{$todaySuccess} ✅</> <fg=red>{$todayFailed} ❌</> <fg=blue>{$todayLogout} 👋</> │ Alerts: <fg=yellow>{$todayAlerts}</> │");
        $this->line("└─────────────────────────────────────────────────────────────────┘");
        $this->line("");
    }
    
    private function showRecentActivities()
    {
        $this->info("🕐 AKTIVITAS TERBARU (10 terakhir)");
        $this->line("├─────────────────────────────────────────────────────────────────┤");
        
        $recentActivities = UserLoginActivity::with('user:id,name')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();
        
        if ($recentActivities->isEmpty()) {
            $this->line("│ Tidak ada aktivitas terbaru                                      │");
        } else {
            foreach ($recentActivities as $activity) {
                $time = $activity->created_at->format('H:i:s');
                $user = $activity->user ? $activity->user->name : 'Unknown';
                $status = $this->getStatusIcon($activity->login_status);
                $device = $activity->device_type ?? 'unknown';
                $ip = $activity->ip_address ?? 'unknown';
                
                $line = sprintf("│ %s %s %-15s %s %-10s %s", 
                    $time, $status, substr($user, 0, 15), 
                    substr($device, 0, 8), substr($ip, 0, 15), 
                    str_repeat(' ', max(0, 29 - strlen($user) - strlen($device) - strlen($ip)))
                );
                $this->line(substr($line, 0, 68) . " │");
            }
        }
        
        $this->line("└─────────────────────────────────────────────────────────────────┘");
        $this->line("");
    }
    
    private function showActiveAlerts()
    {
        $this->info("🚨 ALERT AKTIF (Unread)");
        $this->line("├─────────────────────────────────────────────────────────────────┤");
        
        $activeAlerts = LoginAlert::with('user:id,name')
            ->where('status', 'unread')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();
        
        if ($activeAlerts->isEmpty()) {
            $this->line("│ <fg=green>Tidak ada alert aktif - Semua aman! ✅</fg=green>                          │");
        } else {
            foreach ($activeAlerts as $alert) {
                $time = $alert->created_at->format('H:i:s');
                $user = $alert->user ? $alert->user->name : 'Unknown';
                $severity = $this->getSeverityIcon($alert->severity);
                $type = substr($alert->alert_type, 0, 15);
                
                $line = sprintf("│ %s %s %-15s %-15s", 
                    $time, $severity, substr($user, 0, 15), $type
                );
                $this->line(substr($line, 0, 67) . " │");
            }
        }
        
        $this->line("└─────────────────────────────────────────────────────────────────┘");
        $this->line("");
    }
    
    private function showSecurityMetrics()
    {
        $this->info("🛡️ METRIK KEAMANAN (24 jam terakhir)");
        $this->line("├─────────────────────────────────────────────────────────────────┤");
        
        $yesterday = Carbon::now()->subDay();
        
        // Failed login attempts
        $failedLogins = UserLoginActivity::where('created_at', '>', $yesterday)
            ->where('login_status', 'failed')->count();
        
        // Suspicious activities
        $suspiciousAlerts = LoginAlert::where('created_at', '>', $yesterday)
            ->where('alert_type', 'suspicious_login')->count();
        
        // New devices
        $newDevices = LoginAlert::where('created_at', '>', $yesterday)
            ->where('alert_type', 'new_device')->count();
        
        // Unique IPs
        $uniqueIPs = UserLoginActivity::where('created_at', '>', $yesterday)
            ->distinct('ip_address')->count();
        
        // Unique users
        $activeUsers = UserLoginActivity::where('created_at', '>', $yesterday)
            ->distinct('user_id')->count();
        
        $this->line("│ Failed Logins: <fg=red>{$failedLogins}</> | Suspicious: <fg=yellow>{$suspiciousAlerts}</> | New Devices: <fg=cyan>{$newDevices}</> │");
        $this->line("│ Unique IPs: <fg=blue>{$uniqueIPs}</> | Active Users: <fg=green>{$activeUsers}</> │");
        $this->line("└─────────────────────────────────────────────────────────────────┘");
    }
    
    private function getStatusIcon($status)
    {
        return match($status) {
            'success' => '<fg=green>✅</fg=green>',
            'failed' => '<fg=red>❌</fg=red>',
            'logout' => '<fg=blue>👋</fg=blue>',
            default => '❓'
        };
    }
    
    private function getSeverityIcon($severity)
    {
        return match($severity) {
            'critical' => '<fg=red;options=bold>🔴</fg=red;options=bold>',
            'high' => '<fg=red>🟠</fg=red>',
            'medium' => '<fg=yellow>🟡</fg=yellow>',
            'low' => '<fg=green>🟢</fg=green>',
            default => '⚪'
        };
    }
}
