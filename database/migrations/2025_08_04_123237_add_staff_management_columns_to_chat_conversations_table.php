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
        Schema::table('chat_conversations', function (Blueprint $table) {
            $table->boolean('is_pinned_by_staff')->default(false)->after('last_message_at');
            $table->boolean('is_hidden_by_staff')->default(false)->after('is_pinned_by_staff');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chat_conversations', function (Blueprint $table) {
            $table->dropColumn(['is_pinned_by_staff', 'is_hidden_by_staff']);
        });
    }
};
