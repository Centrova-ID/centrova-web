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
        Schema::connection('account')->create('user_login_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('ip_address', 45);
            $table->text('user_agent');
            $table->string('device_type')->nullable(); // mobile, desktop, tablet
            $table->string('browser')->nullable();
            $table->string('operating_system')->nullable();
            $table->string('location')->nullable(); // City, Country
            $table->string('country_code', 2)->nullable();
            $table->enum('login_status', ['success', 'failed', 'suspicious'])->default('success');
            $table->string('failure_reason')->nullable();
            $table->boolean('is_suspicious')->default(false);
            $table->timestamp('login_at');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['user_id', 'login_at']);
            $table->index(['ip_address']);
            $table->index(['is_suspicious']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('account')->dropIfExists('user_login_activities');
    }
};
