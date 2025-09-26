<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CheckUserTwoFactor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:check-2fa {email : User email to check}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check 2FA status for a user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email {$email} not found");
            return 1;
        }

        $this->info("=== User 2FA Status ===");
        $this->info("Email: {$user->email}");
        $this->info("Phone: " . ($user->phone ?? 'Not set'));
        
        $twoFactorAuth = $user->twoFactorAuth;
        if (!$twoFactorAuth) {
            $this->warn("No 2FA record found");
            return 0;
        }

        $this->info("2FA Enabled: " . ($twoFactorAuth->is_enabled ? 'YES' : 'NO'));
        $this->info("WhatsApp Enabled: " . ($twoFactorAuth->whatsapp_enabled ? 'YES' : 'NO'));
        $this->info("Preferred Method: " . ($twoFactorAuth->preferred_method ?? 'pin'));
        $this->info("Require Every Login: " . ($twoFactorAuth->require_2fa_every_login ? 'YES' : 'NO'));
        $this->info("Allows Device Trust: " . ($twoFactorAuth->allowsDeviceTrust() ? 'YES' : 'NO'));
        
        $trustedDevicesCount = $user->trustedDevices()->where('is_active', true)->count();
        $this->info("Active Trusted Devices: {$trustedDevicesCount}");

        return 0;
    }
}
