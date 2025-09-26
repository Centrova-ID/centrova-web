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
        DB::statement("ALTER TABLE privacy_templates MODIFY COLUMN type ENUM(
            'data_access_request',
            'data_deletion_request', 
            'data_portability_request',
            'consent_withdrawal',
            'data_correction',
            'complaint',
            'privacy_policy_update',
            'consent_confirmation',
            'data_breach_notification'
        )");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE privacy_templates MODIFY COLUMN type ENUM(
            'data_access_request',
            'data_deletion_request', 
            'data_portability_request',
            'privacy_policy_update',
            'consent_confirmation',
            'data_breach_notification'
        )");
    }
};
