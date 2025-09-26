<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Account\UserLoginActivity;
use App\Models\Account\LoginAlert;
use Carbon\Carbon;

class CleanupLoginAlerts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cleanup:login-alerts 
                           {--days=90 : Hapus data lebih dari berapa hari}
                           {--dry-run : Hanya tampilkan apa yang akan dihapus}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membersihkan data login activities dan alerts yang sudah lama';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = $this->option('days');
        $dryRun = $this->option('dry-run');
        
        $cutoffDate = Carbon::now()->subDays($days);
        
        $this->info("🧹 Membersihkan data login lebih dari {$days} hari (sebelum {$cutoffDate->format('Y-m-d H:i:s')})");
        
        if ($dryRun) {
            $this->warn("🔍 Mode DRY RUN - Tidak ada data yang akan dihapus");
        }
        
        // Hitung data yang akan dihapus
        $oldActivities = UserLoginActivity::where('created_at', '<', $cutoffDate);
        $oldAlerts = LoginAlert::where('created_at', '<', $cutoffDate);
        
        $activitiesCount = $oldActivities->count();
        $alertsCount = $oldAlerts->count();
        
        $this->line("📊 Data yang akan dihapus:");
        $this->line("   - Login Activities: {$activitiesCount} records");
        $this->line("   - Login Alerts: {$alertsCount} records");
        
        if ($activitiesCount === 0 && $alertsCount === 0) {
            $this->info("✅ Tidak ada data lama yang perlu dibersihkan");
            return 0;
        }
        
        if (!$dryRun) {
            if (!$this->confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                $this->info("❌ Pembersihan dibatalkan");
                return 0;
            }
            
            $this->info("🗑️ Menghapus data lama...");
            
            // Hapus alerts terlebih dahulu (karena ada foreign key ke activities)
            $deletedAlerts = $oldAlerts->delete();
            $this->info("   ✅ Dihapus {$deletedAlerts} login alerts");
            
            // Hapus activities
            $deletedActivities = $oldActivities->delete();
            $this->info("   ✅ Dihapus {$deletedActivities} login activities");
            
            $this->info("🎉 Pembersihan selesai!");
            
            // Tampilkan statistik setelah cleanup
            $this->showStatistics();
        }
        
        return 0;
    }
    
    private function showStatistics()
    {
        $this->line("");
        $this->info("📈 Statistik setelah pembersihan:");
        
        $totalActivities = UserLoginActivity::count();
        $totalAlerts = LoginAlert::count();
        $unreadAlerts = LoginAlert::where('is_read', false)->count();
        
        $this->line("   - Total Login Activities: {$totalActivities}");
        $this->line("   - Total Login Alerts: {$totalAlerts}");
        $this->line("   - Unread Alerts: {$unreadAlerts}");
        
        // Statistik per user (top 5)
        $topUsers = UserLoginActivity::selectRaw('user_id, COUNT(*) as activity_count')
            ->with('user:id,name')
            ->groupBy('user_id')
            ->orderByDesc('activity_count')
            ->limit(5)
            ->get();
            
        if ($topUsers->count() > 0) {
            $this->line("");
            $this->info("👥 Top 5 Users dengan aktivitas terbanyak:");
            foreach ($topUsers as $user) {
                $userName = $user->user ? $user->user->name : 'Unknown User';
                $this->line("   - {$userName}: {$user->activity_count} activities");
            }
        }
    }
}
