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
        Schema::connection('account')->create('multi_account_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('session_id', 255)->index();
            $table->unsignedBigInteger('user_id');
            $table->boolean('is_active')->default(false);
            $table->timestamp('last_activity')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->json('session_data')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['session_id', 'user_id']);
            $table->index(['session_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('account')->dropIfExists('multi_account_sessions');
    }
};
