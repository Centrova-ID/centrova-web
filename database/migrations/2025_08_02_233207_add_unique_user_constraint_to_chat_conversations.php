<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, consolidate duplicate conversations for the same user
        $this->consolidateDuplicateConversations();
        
        // Note: We don't add unique constraint as we want to preserve history
        // but ensure only latest conversation per user is shown in UI
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to reverse as we're not adding constraints
    }

    /**
     * Consolidate duplicate conversations for the same user
     */
    private function consolidateDuplicateConversations(): void
    {
        // Get users with multiple conversations
        $duplicateUsers = DB::table('chat_conversations')
            ->select('user_id', DB::raw('COUNT(*) as conversation_count'))
            ->groupBy('user_id')
            ->having('conversation_count', '>', 1)
            ->get();

        foreach ($duplicateUsers as $user) {
            // Get all conversations for this user, ordered by created_at
            $conversations = DB::table('chat_conversations')
                ->where('user_id', $user->user_id)
                ->orderBy('created_at', 'asc')
                ->get();

            if ($conversations->count() > 1) {
                // Keep the latest conversation as the main one
                $latestConversation = $conversations->last();
                $oldConversations = $conversations->slice(0, -1);

                foreach ($oldConversations as $oldConv) {
                    // Move all messages from old conversations to the latest one
                    DB::table('chat_messages')
                        ->where('conversation_id', $oldConv->id)
                        ->update(['conversation_id' => $latestConversation->id]);
                }

                // Update the latest conversation with the earliest created_at for history
                $earliestCreatedAt = $conversations->first()->created_at;
                DB::table('chat_conversations')
                    ->where('id', $latestConversation->id)
                    ->update(['created_at' => $earliestCreatedAt]);

                // Delete old conversations after moving their messages
                foreach ($oldConversations as $oldConv) {
                    DB::table('chat_conversations')
                        ->where('id', $oldConv->id)
                        ->delete();
                }
            }
        }
    }
};
