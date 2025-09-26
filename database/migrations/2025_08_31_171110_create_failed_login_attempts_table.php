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
        Schema::create('failed_login_attempts', function (Blueprint $table) {
            $table->id();
            $table->string('identifier'); // email, username, or IP
            $table->enum('type', ['email', 'username', 'ip']); // Type of identifier
            $table->string('ip_address');
            $table->string('user_agent')->nullable();
            $table->enum('mode', ['login', '2fa-verify', '2fa-whatsapp', '2fa-recovery', 'confirm-password']); // Login mode
            $table->json('attempt_data')->nullable(); // Additional data about the attempt
            $table->timestamps();
            
            // Index for faster lookups
            $table->index(['identifier', 'type', 'created_at']);
            $table->index(['ip_address', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('failed_login_attempts');
    }
};
