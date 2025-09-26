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
        Schema::table('chat_messages', function (Blueprint $table) {
            $table->unsignedBigInteger('reply_to_message_id')->nullable()->after('conversation_id');
            $table->boolean('is_starred')->default(false)->after('read_at');
            $table->boolean('is_deleted')->default(false)->after('is_starred');
            
            // Add foreign key for reply
            $table->foreign('reply_to_message_id')->references('id')->on('chat_messages')->onDelete('set null');
            
            // Add indexes
            $table->index('reply_to_message_id');
            $table->index('is_starred');
            $table->index('is_deleted');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chat_messages', function (Blueprint $table) {
            $table->dropForeign(['reply_to_message_id']);
            $table->dropIndex(['reply_to_message_id']);
            $table->dropIndex(['is_starred']);
            $table->dropIndex(['is_deleted']);
            $table->dropColumn(['reply_to_message_id', 'is_starred', 'is_deleted']);
        });
    }
};
