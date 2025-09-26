<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add new enum values for WhatsApp 2FA actions and other missing actions
        DB::statement("ALTER TABLE two_factor_auth_logs MODIFY COLUMN action ENUM('pin_created', 'pin_verified', 'pin_failed', 'pin_disabled', 'recovery_used', 'recovery_generated', 'recovery_failed', 'device_trusted', 'device_removed', 'whatsapp_2fa_enabled', 'whatsapp_2fa_disabled', 'whatsapp_otp_sent', 'whatsapp_otp_verified', 'whatsapp_otp_failed', 'whatsapp_otp_resent', 'whatsapp_otp_resend_failed', 'preferred_method_changed')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to original enum values
        DB::statement("ALTER TABLE two_factor_auth_logs MODIFY COLUMN action ENUM('pin_created', 'pin_verified', 'pin_failed', 'recovery_used', 'device_trusted', 'device_removed')");
    }
};
