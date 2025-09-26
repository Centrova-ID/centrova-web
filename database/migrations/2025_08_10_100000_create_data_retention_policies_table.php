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
        Schema::create('data_retention_policies', function (Blueprint $table) {
            $table->id();
            $table->string('data_type'); // 'login_activities', 'chat_messages', 'user_accounts', etc.
            $table->string('table_name');
            $table->integer('retention_days'); // How many days to keep the data
            $table->string('date_column'); // Column to check for age (created_at, last_login_at, etc.)
            $table->json('conditions')->nullable(); // Additional conditions for deletion
            $table->boolean('is_active')->default(true);
            $table->string('legal_basis'); // GDPR legal basis for retention
            $table->text('description')->nullable();
            $table->timestamp('last_cleanup_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_retention_policies');
    }
};
