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
     * Optimasi database untuk fitur devices/sessions management
     */
    public function up(): void
    {
        // Optimasi untuk sessions table (menggunakan connection 'account')
        Schema::connection('account')->table('sessions', function (Blueprint $table) {
            // Composite index untuk query user sessions dengan sorting
            if (!$this->indexExists('account', 'sessions', 'idx_sessions_user_activity')) {
                $table->index(['user_id', 'last_activity'], 'idx_sessions_user_activity');
            }
            
            // Composite index untuk session lookup by ID and user
            if (!$this->indexExists('account', 'sessions', 'idx_sessions_id_user')) {
                $table->index(['id', 'user_id'], 'idx_sessions_id_user');
            }
            
            // Index untuk IP address (untuk location lookup dan security analysis)
            if (!$this->indexExists('account', 'sessions', 'idx_sessions_ip_address')) {
                $table->index('ip_address', 'idx_sessions_ip_address');
            }
            
            // Index untuk active sessions filtering (last_activity range queries)
            if (!$this->indexExists('account', 'sessions', 'idx_sessions_last_activity')) {
                $table->index('last_activity', 'idx_sessions_last_activity');
            }
        });

        // Optimasi untuk user_login_activities table (sudah ada beberapa index, tambah yang kurang)
        if (Schema::connection('account')->hasTable('user_login_activities')) {
            Schema::connection('account')->table('user_login_activities', function (Blueprint $table) {
                // Composite index untuk query berdasarkan user, IP, dan status
                if (!$this->indexExists('account', 'user_login_activities', 'idx_login_user_ip_status')) {
                    $table->index(['user_id', 'ip_address', 'login_status'], 'idx_login_user_ip_status');
                }
                
                // Composite index untuk recent login lookup
                if (!$this->indexExists('account', 'user_login_activities', 'idx_login_user_ip_time')) {
                    $table->index(['user_id', 'ip_address', 'login_at'], 'idx_login_user_ip_time');
                }
                
                // Index untuk country/location analysis
                if (!$this->indexExists('account', 'user_login_activities', 'idx_login_country')) {
                    $table->index('country_code', 'idx_login_country');
                }
                
                // Index untuk browser/device type analysis
                if (!$this->indexExists('account', 'user_login_activities', 'idx_login_device_browser')) {
                    $table->index(['device_type', 'browser'], 'idx_login_device_browser');
                }
            });
        }

        // Optimasi untuk devices table (jika ada relasi dengan sessions)
        if (Schema::hasTable('devices')) {
            Schema::table('devices', function (Blueprint $table) {
                // Index untuk device filtering berdasarkan IP dan status
                if (!$this->indexExists('mysql', 'devices', 'idx_devices_ip_status')) {
                    $table->index(['ip_address', 'device_type'], 'idx_devices_ip_status');
                }
                
                // Index untuk device name search/filtering
                if (!$this->indexExists('mysql', 'devices', 'idx_devices_name_type')) {
                    $table->index(['device_name', 'device_type'], 'idx_devices_name_type');
                }
            });
        }

        // Optimasi tambahan untuk trusted_devices jika ada
        if (Schema::hasTable('trusted_devices')) {
            Schema::table('trusted_devices', function (Blueprint $table) {
                // Composite index untuk trusted device lookup
                if (!$this->indexExists('mysql', 'trusted_devices', 'idx_trusted_user_device')) {
                    $table->index(['user_id', 'device_fingerprint'], 'idx_trusted_user_device');
                }
                
                // Index untuk expiry date filtering
                if (!$this->indexExists('mysql', 'trusted_devices', 'idx_trusted_expires')) {
                    $table->index('expires_at', 'idx_trusted_expires');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop indexes dari sessions table
        Schema::connection('account')->table('sessions', function (Blueprint $table) {
            $this->dropIndexIfExists('account', 'sessions', 'idx_sessions_user_activity');
            $this->dropIndexIfExists('account', 'sessions', 'idx_sessions_id_user');
            $this->dropIndexIfExists('account', 'sessions', 'idx_sessions_ip_address');
            $this->dropIndexIfExists('account', 'sessions', 'idx_sessions_last_activity');
        });

        // Drop indexes dari user_login_activities table
        if (Schema::connection('account')->hasTable('user_login_activities')) {
            Schema::connection('account')->table('user_login_activities', function (Blueprint $table) {
                $this->dropIndexIfExists('account', 'user_login_activities', 'idx_login_user_ip_status');
                $this->dropIndexIfExists('account', 'user_login_activities', 'idx_login_user_ip_time');
                $this->dropIndexIfExists('account', 'user_login_activities', 'idx_login_country');
                $this->dropIndexIfExists('account', 'user_login_activities', 'idx_login_device_browser');
            });
        }

        // Drop indexes dari devices table
        if (Schema::hasTable('devices')) {
            Schema::table('devices', function (Blueprint $table) {
                $this->dropIndexIfExists('mysql', 'devices', 'idx_devices_ip_status');
                $this->dropIndexIfExists('mysql', 'devices', 'idx_devices_name_type');
            });
        }

        // Drop indexes dari trusted_devices table
        if (Schema::hasTable('trusted_devices')) {
            Schema::table('trusted_devices', function (Blueprint $table) {
                $this->dropIndexIfExists('mysql', 'trusted_devices', 'idx_trusted_user_device');
                $this->dropIndexIfExists('mysql', 'trusted_devices', 'idx_trusted_expires');
            });
        }
    }

    /**
     * Check if an index exists on a table
     */
    private function indexExists(string $connection, string $table, string $index): bool
    {
        try {
            $indexes = DB::connection($connection)->select("SHOW INDEX FROM {$table}");
            foreach ($indexes as $idx) {
                if ($idx->Key_name === $index) {
                    return true;
                }
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Drop index if exists
     */
    private function dropIndexIfExists(string $connection, string $table, string $index): void
    {
        if ($this->indexExists($connection, $table, $index)) {
            try {
                DB::connection($connection)->statement("DROP INDEX {$index} ON {$table}");
            } catch (\Exception $e) {
                // Index might not exist or already dropped
            }
        }
    }
};
