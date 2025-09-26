<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('two_factor_auth', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->boolean('is_enabled')->default(false);
            $table->string('pin_hash')->nullable();
            $table->timestamp('pin_created_at')->nullable();
            $table->integer('failed_attempts')->default(0);
            $table->timestamp('locked_until')->nullable();
            $table->text('recovery_codes')->nullable(); // JSON encoded
            $table->timestamp('last_used_at')->nullable();
            $table->timestamps();
            
            $table->index(['user_id', 'is_enabled']);
        });
        
        Schema::create('trusted_devices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('device_fingerprint'); // Browser fingerprint
            $table->string('device_name')->nullable();
            $table->string('device_type')->nullable(); // mobile, desktop, tablet
            $table->string('browser')->nullable();
            $table->string('os')->nullable();
            $table->ipAddress('ip_address');
            $table->string('user_agent');
            $table->timestamp('last_used_at');
            $table->timestamp('expires_at');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['user_id', 'device_fingerprint']);
            $table->index(['user_id', 'is_active']);
            $table->index('expires_at');
        });
        
        Schema::create('two_factor_auth_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('action', ['pin_created', 'pin_verified', 'pin_failed', 'recovery_used', 'device_trusted', 'device_removed']);
            $table->ipAddress('ip_address');
            $table->string('user_agent');
            $table->json('metadata')->nullable(); // Additional data
            $table->timestamp('created_at');
            
            $table->index(['user_id', 'action']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('two_factor_auth_logs');
        Schema::dropIfExists('trusted_devices');
        Schema::dropIfExists('two_factor_auth');
    }
};
