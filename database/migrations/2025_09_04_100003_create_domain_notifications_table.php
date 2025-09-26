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
        Schema::connection('account')->create('domain_notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('domain_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('type', ['expiry_reminder', 'renewal_success', 'renewal_failed', 'dns_updated', 'transfer_initiated', 'general']);
            $table->string('title');
            $table->text('message');
            $table->json('data')->nullable(); // Additional notification data
            $table->boolean('is_read')->default(false);
            $table->boolean('email_sent')->default(false);
            $table->timestamp('scheduled_at')->nullable(); // For scheduled notifications
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();

            // Indexes
            $table->index(['user_id', 'is_read']);
            $table->index(['domain_id', 'type']);
            $table->index('scheduled_at');

            // Foreign keys
            $table->foreign('domain_id')->references('id')->on('domains')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('account')->dropIfExists('domain_notifications');
    }
};
