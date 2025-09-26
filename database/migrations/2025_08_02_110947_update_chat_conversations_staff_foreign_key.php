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
        // First, drop the existing foreign key constraint
        Schema::table('chat_conversations', function (Blueprint $table) {
            $table->dropForeign(['staff_id']);
        });

        // Now add the new foreign key constraint that references users table
        Schema::table('chat_conversations', function (Blueprint $table) {
            $table->foreign('staff_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the new foreign key constraint
        Schema::table('chat_conversations', function (Blueprint $table) {
            $table->dropForeign(['staff_id']);
        });

        // Restore the old foreign key constraint (if staff_users table still exists)
        Schema::table('chat_conversations', function (Blueprint $table) {
            $table->foreign('staff_id')->references('id')->on('staff_users')->onDelete('set null');
        });
    }
};
