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
            // Composite index for user_id with created_at for getting latest conversation per user
            $table->index(['user_id', 'created_at'], 'idx_user_created');
            
            // Composite index for staff queries - staff_id with status and last_message_at
            $table->index(['staff_id', 'status', 'last_message_at'], 'idx_staff_status_lastmsg');
            
            // Index for status with staff_id (for waiting conversations)
            $table->index(['status', 'staff_id'], 'idx_status_staff');
        });

        Schema::table('chat_messages', function (Blueprint $table) {
            // Composite index for conversation_id with created_at for message ordering
            $table->index(['conversation_id', 'created_at'], 'idx_conv_created');
            
            // Index for sender_type with read_at for unread count queries
            $table->index(['sender_type', 'read_at'], 'idx_sender_read');
            
            // Composite index for conversation_id with sender_type and read_at for staff unread count
            $table->index(['conversation_id', 'sender_type', 'read_at'], 'idx_conv_sender_read');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chat_conversations', function (Blueprint $table) {
            $table->dropIndex('idx_user_created');
            $table->dropIndex('idx_staff_status_lastmsg');
            $table->dropIndex('idx_status_staff');
        });

        Schema::table('chat_messages', function (Blueprint $table) {
            $table->dropIndex('idx_conv_created');
            $table->dropIndex('idx_sender_read');
            $table->dropIndex('idx_conv_sender_read');
        });
    }
};
