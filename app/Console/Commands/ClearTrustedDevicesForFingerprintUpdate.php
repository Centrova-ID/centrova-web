<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TrustedDevice;

class ClearTrustedDevicesForFingerprintUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trusted-devices:clear-for-update {--force : Force clear without confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all trusted devices due to fingerprint algorithm update';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!$this->option('force')) {
            if (!$this->confirm('This will clear ALL trusted devices for ALL users. Continue?')) {
                $this->info('Operation cancelled.');
                return 0;
            }
        }

        $count = TrustedDevice::count();
        $deleted = TrustedDevice::query()->delete();

        $this->info("Cleared {$deleted} trusted devices out of {$count} total.");
        $this->warn('All users will need to verify 2FA again on their next login.');

        return 0;
    }
}
