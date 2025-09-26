<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TrustedDevice;

class CleanupExpiredTrustedDevices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'two-factor:cleanup-devices {--dry-run : Show what would be deleted without actually deleting}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleanup expired trusted devices for two-factor authentication';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dryRun = $this->option('dry-run');
        
        $expiredDevices = TrustedDevice::where('expires_at', '<', now());
        
        if ($dryRun) {
            $count = $expiredDevices->count();
            $this->info("Found {$count} expired trusted devices that would be deleted.");
            
            if ($count > 0) {
                $devices = $expiredDevices->with('user')->get();
                $this->table(
                    ['ID', 'User', 'Device', 'Expired At'],
                    $devices->map(function ($device) {
                        return [
                            $device->id,
                            $device->user->name ?? 'Unknown',
                            $device->device_name,
                            $device->expires_at->format('Y-m-d H:i:s')
                        ];
                    })
                );
            }
        } else {
            $deletedCount = $expiredDevices->delete();
            $this->info("Deleted {$deletedCount} expired trusted devices.");
        }
        
        return Command::SUCCESS;
    }
}
