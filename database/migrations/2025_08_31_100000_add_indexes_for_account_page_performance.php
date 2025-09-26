<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Menambahkan index untuk meningkatkan performa halaman account
     */
    public function up(): void
    {
        // Index untuk tabel devices
        Schema::table('devices', function (Blueprint $table) {
            // Composite index untuk query devices berdasarkan user_id dan sorting by last_active_at
            $table->index(['user_id', 'last_active_at'], 'idx_devices_user_last_active');
            
            // Index untuk kolom last_active_at saja (untuk global sorting jika diperlukan)
            $table->index('last_active_at', 'idx_devices_last_active');
        });

        // Index untuk tabel subscriptions  
        Schema::table('subscriptions', function (Blueprint $table) {
            // Composite index untuk query subscriptions berdasarkan user_id dan sorting by created_at
            $table->index(['user_id', 'created_at'], 'idx_subscriptions_user_created');
            
            // Index untuk status subscription untuk filtering cepat
            $table->index('status', 'idx_subscriptions_status');
        });

        // Index untuk tabel service_orders
        Schema::table('service_orders', function (Blueprint $table) {
            // Composite index untuk query active orders berdasarkan user_id dan status
            $table->index(['user_id', 'status'], 'idx_service_orders_user_status');
            
            // Index untuk payment_status jika diperlukan filtering
            $table->index('payment_status', 'idx_service_orders_payment_status');
            
            // Index untuk timestamp fields yang sering digunakan untuk sorting
            $table->index('started_at', 'idx_service_orders_started_at');
            $table->index('completed_at', 'idx_service_orders_completed_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop indexes dari devices table
        Schema::table('devices', function (Blueprint $table) {
            $table->dropIndex('idx_devices_user_last_active');
            $table->dropIndex('idx_devices_last_active');
        });

        // Drop indexes dari subscriptions table
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropIndex('idx_subscriptions_user_created');
            $table->dropIndex('idx_subscriptions_status');
        });

        // Drop indexes dari service_orders table
        Schema::table('service_orders', function (Blueprint $table) {
            $table->dropIndex('idx_service_orders_user_status');
            $table->dropIndex('idx_service_orders_payment_status');
            $table->dropIndex('idx_service_orders_started_at');
            $table->dropIndex('idx_service_orders_completed_at');
        });
    }
};
