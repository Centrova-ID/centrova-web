<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Create login_alerts table untuk fitur pemberitahuan login
     */
    public function up(): void
    {
        Schema::connection('account')->create('login_alerts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('login_activity_id')->nullable(); // Reference ke user_login_activities
            $table->string('alert_type')->default('new_login'); // new_login, suspicious_login, failed_attempts
            $table->string('severity')->default('medium'); // low, medium, high, critical
            $table->string('title');
            $table->text('message');
            $table->json('metadata')->nullable(); // IP, device info, location, etc.
            $table->enum('status', ['unread', 'read', 'dismissed', 'reported'])->default('unread');
            $table->timestamp('alert_time');
            $table->timestamp('read_at')->nullable();
            $table->timestamp('dismissed_at')->nullable();
            $table->timestamps();

            // Indexes untuk performance
            $table->index(['user_id', 'status', 'alert_time']);
            $table->index(['user_id', 'alert_type']);
            $table->index(['severity', 'status']);
            $table->index('alert_time');
            
            // Foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('account')->dropIfExists('login_alerts');
    }
};
