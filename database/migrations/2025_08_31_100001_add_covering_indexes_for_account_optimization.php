<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Optimasi lebih lanjut untuk query-query spesifik di halaman account
     */
    public function up(): void
    {
        // Optimasi untuk users table (jika belum ada)
        Schema::table('users', function (Blueprint $table) {
            // Index untuk email verification status
            if (!$this->indexExists('users', 'idx_users_email_verified')) {
                $table->index('email_verified_at', 'idx_users_email_verified');
            }
            
            // Index untuk phone number (digunakan dalam security score calculation)
            if (!$this->indexExists('users', 'idx_users_phone')) {
                $table->index('phone', 'idx_users_phone');
            }
        });

        // Optimasi untuk devices table - covering index (MySQL doesn't support partial indexes)
        Schema::table('devices', function (Blueprint $table) {
            if (!$this->indexExists('devices', 'idx_devices_user_coverage')) {
                $table->index(['user_id', 'last_active_at', 'device_name', 'device_type'], 'idx_devices_user_coverage');
            }
        });

        // Optimasi untuk service_orders - covering index untuk status counting
        Schema::table('service_orders', function (Blueprint $table) {
            // Covering index untuk query count berdasarkan user_id dan status
            if (!$this->indexExists('service_orders', 'idx_service_orders_user_status_coverage')) {
                $table->index(['user_id', 'status', 'created_at'], 'idx_service_orders_user_status_coverage');
            }
        });

        // Optimasi untuk subscriptions - covering index
        Schema::table('subscriptions', function (Blueprint $table) {
            // Covering index untuk query latest subscription
            if (!$this->indexExists('subscriptions', 'idx_subscriptions_user_latest_coverage')) {
                $table->index(['user_id', 'created_at', 'plan', 'status'], 'idx_subscriptions_user_latest_coverage');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop indexes dari users table
        Schema::table('users', function (Blueprint $table) {
            if ($this->indexExists('users', 'idx_users_email_verified')) {
                $table->dropIndex('idx_users_email_verified');
            }
            if ($this->indexExists('users', 'idx_users_phone')) {
                $table->dropIndex('idx_users_phone');
            }
        });

        // Drop MySQL covering index
        Schema::table('devices', function (Blueprint $table) {
            if ($this->indexExists('devices', 'idx_devices_user_coverage')) {
                $table->dropIndex('idx_devices_user_coverage');
            }
        });

        // Drop indexes dari service_orders table
        Schema::table('service_orders', function (Blueprint $table) {
            if ($this->indexExists('service_orders', 'idx_service_orders_user_status_coverage')) {
                $table->dropIndex('idx_service_orders_user_status_coverage');
            }
        });

        // Drop indexes dari subscriptions table
        Schema::table('subscriptions', function (Blueprint $table) {
            if ($this->indexExists('subscriptions', 'idx_subscriptions_user_latest_coverage')) {
                $table->dropIndex('idx_subscriptions_user_latest_coverage');
            }
        });
    }

    /**
     * Check if an index exists on a table
     */
    private function indexExists(string $table, string $index): bool
    {
        $indexes = DB::select("SHOW INDEX FROM {$table}");
        foreach ($indexes as $idx) {
            if ($idx->Key_name === $index) {
                return true;
            }
        }
        return false;
    }
};
