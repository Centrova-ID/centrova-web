<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StaffChatController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('staff.auth');
    }

    /**
     * Get authenticated staff user
     */
    private function getStaffUser()
    {
        return Auth::guard('staff')->user();
    }

    /**
     * Show chat dashboard for staff
     */
    public function index()
    {
        $user = $this->getStaffUser();
        
        // Check if user is staff
        if (!$user || !$user->isActive()) {
            return redirect()->route('staff.login')->with('error', 'Akses ditolak. Halaman ini hanya untuk staff.');
        }
        
        // Optimized query using subquery with proper indexing
        $conversations = ChatConversation::with(['user:id,name,email,profile_picture', 'staff:id,name'])
                                        ->whereIn('id', function($query) {
                                            $query->select(DB::raw('MAX(id)'))
                                                  ->from('chat_conversations')
                                                  ->groupBy('user_id');
                                        })
                                        ->where(function ($query) use ($user) {
                                            $query->where('staff_id', $user->id)
                                                  ->orWhere(function ($subQuery) {
                                                      $subQuery->whereNull('staff_id')
                                                               ->where('status', 'waiting');
                                                  })
                                                  ->orWhere('status', '!=', 'closed');
                                        })
                                        ->where('is_hidden_by_staff', false) // Don't show hidden conversations
                                        ->orderBy('is_pinned_by_staff', 'desc') // Pinned first
                                        ->orderBy('last_message_at', 'desc')
                                        ->limit(50) // Limit untuk performance
                                        ->get();

        // Optimized count queries
        $waitingCount = ChatConversation::whereIn('id', function($query) {
                                            $query->select(DB::raw('MAX(id)'))
                                                  ->from('chat_conversations')
                                                  ->groupBy('user_id');
                                        })
                                       ->where('status', 'waiting')
                                       ->whereNull('staff_id')
                                       ->count();

        $activeCount = ChatConversation::whereIn('id', function($query) {
                                            $query->select(DB::raw('MAX(id)'))
                                                  ->from('chat_conversations')
                                                  ->groupBy('user_id');
                                        })
                                      ->where('staff_id', $user->id)
                                      ->where('status', 'active')
                                      ->count();

        return view('staff.chat.index', compact('conversations', 'waitingCount', 'activeCount'));
    }

    /**
     * Show specific conversation (optimized)
     */
    public function showConversation($id)
    {
        $user = $this->getStaffUser();
        
        // Check if user is staff
        if (!$user->role || $user->role === 'customer') {
            return redirect()->route('home')->with('error', 'Akses ditolak.');
        }
        
        // Get the latest conversation for the user (ensuring we get the most recent one)
        $conversation = ChatConversation::with(['user:id,name,email', 'staff:id,name'])
                                       ->where('user_id', $id)
                                       ->orderBy('created_at', 'desc')
                                       ->first();
        
        if (!$conversation) {
            // If no conversation found by user_id, try by conversation id
            $conversation = ChatConversation::with(['user:id,name,email', 'staff:id,name'])->findOrFail($id);
        }

        // Check if staff can access this conversation
        if ($conversation->staff_id && $conversation->staff_id !== $user->id && $user->role !== 'admin') {
            return redirect()->route('staff.chat.index')->with('error', 'Anda tidak memiliki akses ke percakapan ini.');
        }

        // If conversation is waiting and no staff assigned, assign this staff (CS only)
        if ($conversation->status === 'waiting' && !$conversation->staff_id && ($user->role === 'customer_service' || $user->role === 'admin')) {
            $conversation->assignStaff($user);
        }

        // If conversation was closed, reopen it when staff accesses it
        if ($conversation->status === 'closed') {
            $conversation->reopen();
        }

        // Don't load messages here - they will be loaded via AJAX for better performance
        $messages = collect(); // Empty collection

        // Get all conversations for sidebar (same as index)
        $allConversations = ChatConversation::with(['user:id,name,email', 'staff:id,name'])
                                           ->whereIn('id', function($query) {
                                               $query->select(DB::raw('MAX(id)'))
                                                     ->from('chat_conversations')
                                                     ->groupBy('user_id');
                                           })
                                           ->where(function ($query) use ($user) {
                                               $query->where('staff_id', $user->id)
                                                     ->orWhere(function ($subQuery) {
                                                         $subQuery->whereNull('staff_id')
                                                                  ->where('status', 'waiting');
                                                     })
                                                     ->orWhere('status', '!=', 'closed');
                                           })
                                           ->where('is_hidden_by_staff', false) // Don't show hidden
                                           ->orderBy('is_pinned_by_staff', 'desc') // Pinned first
                                           ->orderBy('last_message_at', 'desc')
                                           ->limit(50)
                                           ->get();
        
        // Mark messages as read by staff (async to not block response)
        dispatch(function() use ($conversation) {
            $conversation->markAsReadByStaff();
        })->afterResponse();

        return view('staff.chat.conversation', compact('conversation', 'messages', 'allConversations'));
    }

    /**
     * Send message from staff
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:chat_conversations,id',
            'message' => 'required|string|max:1000',
            'reply_to_message_id' => 'nullable|exists:chat_messages,id'
        ]);

        $user = $this->getStaffUser();
        
        if (!$user->role || $user->role === 'customer') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        $conversation = ChatConversation::findOrFail($request->conversation_id);

        // Check if staff can send message to this conversation
        if ($conversation->staff_id && $conversation->staff_id !== $user->id && $user->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Prevent duplicate messages - check for identical message within last 5 seconds
        $recentMessage = ChatMessage::where('conversation_id', $conversation->id)
            ->where('sender_id', $user->id)
            ->where('sender_type', 'staff')
            ->where('message', $request->message)
            ->where('created_at', '>=', now()->subSeconds(5))
            ->first();

        if ($recentMessage) {
            return response()->json([
                'success' => true,
                'message' => [
                    'id' => $recentMessage->id,
                    'message' => $recentMessage->message,
                    'sender_type' => $recentMessage->sender_type,
                    'created_at' => $recentMessage->created_at->format('Y-m-d H:i:s'),
                    'reply_to_message_id' => $recentMessage->reply_to_message_id,
                    'reply_to_message' => $recentMessage->replyToMessage ? [
                        'id' => $recentMessage->replyToMessage->id,
                        'message' => $recentMessage->replyToMessage->message,
                        'sender_name' => $recentMessage->replyToMessage->sender_name,
                        'sender_type' => $recentMessage->replyToMessage->sender_type
                    ] : null
                ]
            ]);
        }

        // If conversation is waiting and no staff assigned, assign this staff
        if ($conversation->status === 'waiting' && !$conversation->staff_id) {
            $conversation->assignStaff($user);
        }

        // Create message
        $messageData = [
            'conversation_id' => $conversation->id,
            'sender_id' => $user->id,
            'sender_type' => 'staff',
            'message' => $request->message,
            'message_type' => 'text'
        ];

        // Add reply_to_message_id if provided
        if ($request->reply_to_message_id) {
            $messageData['reply_to_message_id'] = $request->reply_to_message_id;
        }

        $message = ChatMessage::create($messageData);

        // Load reply relationship if exists
        $message->load('replyToMessage.userSender', 'replyToMessage.staffSender');

        // Update conversation
        $conversation->update([
            'last_message_at' => now(),
            'status' => 'active'
        ]);

        return response()->json([
            'success' => true,
            'message' => [
                'id' => $message->id,
                'message' => $message->message,
                'sender_type' => $message->sender_type,
                'created_at' => $message->created_at->format('Y-m-d H:i:s'),
                'reply_to_message_id' => $message->reply_to_message_id,
                'reply_to_message' => $message->replyToMessage ? [
                    'id' => $message->replyToMessage->id,
                    'message' => $message->replyToMessage->message,
                    'sender_name' => $message->replyToMessage->sender_name,
                    'sender_type' => $message->replyToMessage->sender_type
                ] : null
            ]
        ]);
    }

    /**
     * Get new messages for real-time chat (optimized)
     */
    public function getNewMessages(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:chat_conversations,id',
            'last_message_id' => 'required|integer'
        ]);

        $user = $this->getStaffUser();
        
        if (!$user->role || $user->role === 'customer') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        $conversation = ChatConversation::findOrFail($request->conversation_id);

        // Check if staff can access this conversation
        if ($conversation->staff_id && $conversation->staff_id !== $user->id && $user->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Get new messages (exclude deleted messages)
        $messages = $conversation->messages()
                                ->where('id', '>', $request->last_message_id)
                                ->where(function($query) {
                                    $query->where('is_deleted', false)
                                          ->orWhereNull('is_deleted');
                                })
                                ->with(['userSender', 'staffSender', 'replyToMessage.userSender', 'replyToMessage.staffSender'])
                                ->orderBy('created_at', 'asc')
                                ->get();

        // Mark messages as read by staff
        $conversation->markAsReadByStaff();

        $messagesData = $messages->map(function ($message) {
            $data = [
                'id' => $message->id,
                'message' => $message->message,
                'sender_type' => $message->sender_type,
                'sender_name' => $message->sender_name,
                'created_at' => $message->created_at->format('Y-m-d H:i:s'),
                'reply_to_message_id' => $message->reply_to_message_id
            ];

            // Add reply message details if this is a reply
            if ($message->replyToMessage) {
                $data['reply_to_message'] = [
                    'id' => $message->replyToMessage->id,
                    'message' => $message->replyToMessage->message,
                    'sender_name' => $message->replyToMessage->sender_name,
                    'sender_type' => $message->replyToMessage->sender_type
                ];
            }

            return $data;
        });

        return response()->json([
            'success' => true,
            'messages' => $messagesData
        ]);
    }

    /**
     * Get messages with pagination for lazy loading
     */
    public function getMessagesPaginated(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:chat_conversations,id',
            'before_message_id' => 'nullable|integer',
            'limit' => 'integer|min:1|max:50'
        ]);

        $user = $this->getStaffUser();
        
        if (!$user->role || $user->role === 'customer') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        $conversation = ChatConversation::findOrFail($request->conversation_id);

        // Check if staff can access this conversation
        if ($conversation->staff_id && $conversation->staff_id !== $user->id && $user->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $limit = $request->input('limit', 30);
        $beforeMessageId = $request->input('before_message_id');

        // Build query for messages
        $query = $conversation->messages()
                             ->where('is_deleted', false)
                             ->with([
                                 'replyToMessage' => function($q) {
                                     $q->where('is_deleted', false)
                                       ->select(['id', 'message', 'sender_type', 'sender_id']);
                                 },
                                 'userSender:id,name', 
                                 'staffSender:id,name'
                             ])
                             ->select(['id', 'conversation_id', 'sender_id', 'sender_type', 'message', 'reply_to_message_id', 'is_starred', 'created_at']);

        // Add before_message_id filter if provided (for pagination)
        if ($beforeMessageId) {
            $query->where('id', '<', $beforeMessageId);
        }

        // For initial load (no beforeMessageId), get latest messages first
        // For pagination (with beforeMessageId), get older messages
        if (!$beforeMessageId) {
            // Initial load: Get latest messages in ascending order (oldest to newest for display)
            $messages = $query->orderBy('created_at', 'asc')
                             ->orderBy('id', 'asc')
                             ->limit($limit)
                             ->get();
        } else {
            // Pagination: Get older messages in descending order, then reverse
            $messages = $query->orderBy('created_at', 'desc')
                             ->orderBy('id', 'desc')
                             ->limit($limit + 1) // Get one extra to check if there are more
                             ->get()
                             ->reverse() // Reverse to show oldest first
                             ->values(); // Reset array keys
        }

        // Check if there are more messages (only for pagination)
        $hasMore = false;
        if ($beforeMessageId && $messages->count() > $limit) {
            $hasMore = true;
            $messages->pop(); // Remove the extra message
        } elseif (!$beforeMessageId) {
            // For initial load, check if there are older messages
            $hasMore = $conversation->messages()
                                  ->where('is_deleted', false)
                                  ->where('id', '<', $messages->first()->id ?? 0)
                                  ->exists();
        }

        // Mark messages as read by staff if this is the initial load (no before_message_id)
        if (!$beforeMessageId) {
            $conversation->markAsReadByStaff();
        }

        $messagesData = $messages->map(function ($message) {
            $data = [
                'id' => $message->id,
                'message' => $message->message,
                'sender_type' => $message->sender_type,
                'sender_name' => $message->sender_name,
                'created_at' => $message->created_at->format('Y-m-d H:i:s'),
                'reply_to_message_id' => $message->reply_to_message_id,
                'is_starred' => $message->is_starred
            ];

            // Add reply message details if this is a reply
            if ($message->replyToMessage) {
                $data['reply_to_message'] = [
                    'id' => $message->replyToMessage->id,
                    'message' => $message->replyToMessage->message,
                    'sender_name' => $message->replyToMessage->sender_name,
                    'sender_type' => $message->replyToMessage->sender_type
                ];
            }

            return $data;
        });

        return response()->json([
            'success' => true,
            'messages' => $messagesData,
            'has_more' => $hasMore
        ]);
    }

    /**
     * Take over conversation
     */
    public function takeConversation(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:chat_conversations,id'
        ]);

        $user = $this->getStaffUser();
        
        if (!$user->role || $user->role === 'customer') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        $conversation = ChatConversation::findOrFail($request->conversation_id);

        // Check if conversation is available to take
        if ($conversation->staff_id && $conversation->staff_id !== $user->id) {
            return response()->json(['error' => 'Percakapan ini sudah ditangani oleh staff lain'], 403);
        }

        $conversation->assignStaff($user);

        return response()->json(['success' => true]);
    }

    /**
     * Close conversation
     */
    public function closeConversation(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:chat_conversations,id'
        ]);

        $user = $this->getStaffUser();
        
        if (!$user->role || $user->role === 'customer') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        $conversation = ChatConversation::findOrFail($request->conversation_id);

        // Check if staff can close this conversation
        if ($conversation->staff_id !== $user->id && $user->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $conversation->close();

        return response()->json(['success' => true]);
    }

    /**
     * Get conversation preview for preloading
     */
    public function getConversationPreview($id)
    {
        $user = $this->getStaffUser();
        
        // Check if user is staff
        if (!$user->role || $user->role === 'customer') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        // Get the latest conversation for the user (lightweight)
        $conversation = ChatConversation::with(['user:id,name,email'])
                                       ->select(['id', 'user_id', 'subject', 'status', 'last_message_at'])
                                       ->where('user_id', $id)
                                       ->orderBy('created_at', 'desc')
                                       ->first();
        
        if (!$conversation) {
            return response()->json(['error' => 'Conversation not found'], 404);
        }

        // Return minimal data for preloading
        return response()->json([
            'success' => true,
            'conversation' => [
                'id' => $conversation->id,
                'user_id' => $conversation->user_id,
                'user_name' => $conversation->user->name,
                'status' => $conversation->status,
                'last_message_at' => $conversation->last_message_at->format('Y-m-d H:i:s')
            ]
        ])->header('Cache-Control', 'public, max-age=300'); // Cache for 5 minutes
    }
    public function getConversations()
    {
        $user = $this->getStaffUser();
        
        if (!$user->role || $user->role === 'customer') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        // Optimized query with selective field loading and caching headers
        $conversations = ChatConversation::with(['user:id,name,email', 'staff:id,name'])
                                        ->select(['id', 'user_id', 'staff_id', 'subject', 'status', 'last_message_at'])
                                        ->whereIn('id', function($query) {
                                            $query->select(DB::raw('MAX(id)'))
                                                  ->from('chat_conversations')
                                                  ->groupBy('user_id');
                                        })
                                        ->where(function ($query) use ($user) {
                                            $query->where('staff_id', $user->id)
                                                  ->orWhere(function ($subQuery) {
                                                      $subQuery->whereNull('staff_id')
                                                               ->where('status', 'waiting');
                                                  })
                                                  ->orWhere('status', '!=', 'closed');
                                        })
                                        ->orderBy('last_message_at', 'desc')
                                        ->limit(50)
                                        ->get();

        $conversationsData = $conversations->map(function ($conversation) {
            return [
                'id' => $conversation->id,
                'user_id' => $conversation->user_id,
                'user_name' => $conversation->user->name,
                'subject' => $conversation->subject,
                'status' => $conversation->status,
                'unread_count' => $conversation->getUnreadCountForStaff(),
                'last_message_at' => $conversation->last_message_at->format('Y-m-d H:i:s'),
                'formatted_date' => $conversation->last_message_at->format('M d, Y g:i A')
            ];
        });

        return response()->json([
            'success' => true,
            'conversations' => $conversationsData
        ])->header('Cache-Control', 'public, max-age=30'); // Cache for 30 seconds
    }

    /**
     * Pin/Unpin conversation for staff
     */
    public function togglePin(Request $request)
    {
        $user = $this->getStaffUser();
        
        if (!$user->role || $user->role === 'customer') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $conversationId = $request->input('conversation_id');
        $conversation = ChatConversation::find($conversationId);
        
        if (!$conversation) {
            return response()->json(['error' => 'Conversation not found'], 404);
        }

        // Toggle pin status
        $conversation->is_pinned_by_staff = !($conversation->is_pinned_by_staff ?? false);
        $conversation->save();

        return response()->json([
            'success' => true,
            'is_pinned' => $conversation->is_pinned_by_staff,
            'message' => $conversation->is_pinned_by_staff ? 'Chat dipinned' : 'Pin chat dihapus'
        ]);
    }

    /**
     * Remove conversation from staff list or delete entirely
     */
    public function removeConversation(Request $request)
    {
        $user = $this->getStaffUser();
        
        if (!$user->role || $user->role === 'customer') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $conversationId = $request->input('conversation_id');
        $deleteType = $request->input('delete_type'); // 'hide' or 'delete'
        
        $conversation = ChatConversation::find($conversationId);
        
        if (!$conversation) {
            return response()->json(['error' => 'Conversation not found'], 404);
        }

        if ($deleteType === 'delete') {
            // Delete conversation and all messages
            ChatMessage::where('conversation_id', $conversationId)->delete();
            $conversation->delete();
            $message = 'Percakapan berhasil dihapus';
        } else {
            // Just hide from staff list
            $conversation->is_hidden_by_staff = true;
            $conversation->save();
            $message = 'Percakapan dihapus dari daftar';
        }

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }

    /**
     * Star/unstar message
     */
    public function toggleStarMessage(Request $request)
    {
        try {
            Log::info('Toggle star message request:', $request->all());
            
            $user = $this->getStaffUser();
            
            if (!$user->role || $user->role === 'customer') {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $messageId = $request->input('message_id');
            $message = ChatMessage::find($messageId);
            
            if (!$message) {
                return response()->json(['error' => 'Message not found'], 404);
            }

            // Toggle star status
            $message->is_starred = !$message->is_starred;
            $message->save();

            Log::info('Message star toggled:', ['message_id' => $messageId, 'is_starred' => $message->is_starred]);

            return response()->json([
                'success' => true,
                'is_starred' => $message->is_starred,
                'message' => $message->is_starred ? 'Pesan diberi bintang' : 'Bintang dihapus'
            ]);
        } catch (\Exception $e) {
            Log::error('Error toggling star message:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Delete message (soft delete)
     */
    public function deleteMessage(Request $request)
    {
        try {
            Log::info('Delete message request:', $request->all());
            
            $user = $this->getStaffUser();
            
            if (!$user->role || $user->role === 'customer') {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $messageId = $request->input('message_id');
            $message = ChatMessage::find($messageId);
            
            if (!$message) {
                return response()->json(['error' => 'Message not found'], 404);
            }

            // Check if user can delete this message (only own messages or admin)
            if ($message->sender_id !== $user->id && $user->role !== 'admin') {
                return response()->json(['error' => 'Unauthorized to delete this message'], 403);
            }

            // Mark as deleted first for real-time notification
            $message->is_deleted = true;
            $message->save();

            // Hard delete immediately
            $message->delete();

            Log::info('Message deleted permanently:', ['message_id' => $messageId, 'user_id' => $user->id]);

            return response()->json([
                'success' => true,
                'message' => 'Pesan berhasil dihapus',
                'deleted_message_id' => $messageId // Add this for frontend to remove the message
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting message:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Update typing status
     */
    public function updateTypingStatus(Request $request)
    {
        $user = $this->getStaffUser();
        
        if (!$user->role || $user->role === 'customer') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $conversationId = $request->input('conversation_id');
        $isTyping = $request->input('is_typing', false);
        
        // Store typing status in cache for 10 seconds
        $cacheKey = "typing_staff_{$conversationId}_{$user->id}";
        
        if ($isTyping) {
            cache()->put($cacheKey, [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'timestamp' => now()
            ], 10); // 10 seconds
        } else {
            cache()->forget($cacheKey);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Get typing users for conversation
     */
    public function getTypingUsers(Request $request)
    {
        $conversationId = $request->input('conversation_id');
        $currentUserId = Auth::id();
        
        $typingUsers = [];
        $cachePattern = "typing_staff_{$conversationId}_*";
        
        // Get all typing users from cache
        // Note: This is a simplified version. In production, use Redis with pattern matching
        foreach (range(1, 100) as $userId) { // Simplified - normally iterate through actual user IDs
            $cacheKey = "typing_staff_{$conversationId}_{$userId}";
            $typingData = cache($cacheKey);
            
            if ($typingData && $userId !== $currentUserId) {
                // Check if typing data is not too old (more than 10 seconds)
                if ($typingData['timestamp']->diffInSeconds(now()) <= 10) {
                    $typingUsers[] = $typingData;
                }
            }
        }

        return response()->json([
            'success' => true,
            'typing_users' => $typingUsers
        ]);
    }

    /**
     * Get conversations list updates for realtime
     */
    public function getConversationsUpdate(Request $request)
    {
        $user = $this->getStaffUser();
        
        if (!$user->role || $user->role === 'customer') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $lastUpdate = $request->input('last_update', 0);
        
        // Get conversations with latest message info
        $conversations = ChatConversation::with(['user:id,name,email,profile_picture', 'staff:id,name'])
                                        ->whereIn('id', function($query) {
                                            $query->select(DB::raw('MAX(id)'))
                                                  ->from('chat_conversations')
                                                  ->groupBy('user_id');
                                        })
                                        ->where(function ($query) use ($user) {
                                            $query->where('staff_id', $user->id)
                                                  ->orWhere(function ($subQuery) {
                                                      $subQuery->whereNull('staff_id')
                                                               ->where('status', 'waiting');
                                                  })
                                                  ->orWhere('status', '!=', 'closed');
                                        })
                                        ->where('last_message_at', '>', now()->subMinutes(30)) // Only recent conversations
                                        ->orderBy('is_pinned_by_staff', 'desc')
                                        ->orderBy('last_message_at', 'desc')
                                        ->limit(50)
                                        ->get();

        $conversationsData = [];
        
        foreach ($conversations as $conversation) {
            // Get unread count for staff
            $unreadCount = $conversation->getUnreadCountForStaff();
            
            // Get last message
            $lastMessage = $conversation->messages()
                                      ->orderBy('created_at', 'desc')
                                      ->first();
            
            $conversationsData[] = [
                'id' => $conversation->id,
                'user_id' => $conversation->user_id,
                'user_name' => $conversation->user->name,
                'user_email' => $conversation->user->email,
                'profile_picture' => $conversation->user->profile_picture,
                'subject' => $conversation->subject,
                'status' => $conversation->status,
                'is_pinned_by_staff' => (bool) $conversation->is_pinned_by_staff,
                'unread_count' => $unreadCount,
                'last_message' => $lastMessage ? $lastMessage->message : '',
                'last_message_time' => $conversation->last_message_at ? $conversation->last_message_at->format('g:i A') : '',
                'updated_at' => $conversation->updated_at->timestamp
            ];
        }

        return response()->json([
            'success' => true,
            'conversations' => $conversationsData,
            'timestamp' => now()->timestamp
        ]);
    }

    /**
     * Search conversations with comprehensive criteria
     */
    public function searchConversations(Request $request)
    {
        $user = $this->getStaffUser();
        
        if (!$user->role || $user->role === 'customer') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'query' => 'required|string|min:1',
            'search_in' => 'array'
        ]);

        $query = $request->input('query');
        $searchIn = $request->input('search_in', ['name', 'email', 'subject', 'messages']);
        
        $conversationQuery = ChatConversation::with(['user:id,name,email', 'staff:id,name'])
                                            ->whereIn('id', function($subQuery) {
                                                $subQuery->select(DB::raw('MAX(id)'))
                                                        ->from('chat_conversations')
                                                        ->groupBy('user_id');
                                            })
                                            ->where(function ($q) use ($user) {
                                                $q->where('staff_id', $user->id)
                                                  ->orWhere(function ($subQuery) {
                                                      $subQuery->whereNull('staff_id')
                                                               ->where('status', 'waiting');
                                                  })
                                                  ->orWhere('status', '!=', 'closed');
                                            });

        // Build search conditions
        $conversationQuery->where(function ($q) use ($query, $searchIn) {
            if (in_array('name', $searchIn)) {
                $q->orWhereHas('user', function ($userQuery) use ($query) {
                    $userQuery->where('name', 'LIKE', "%{$query}%");
                });
            }
            
            if (in_array('email', $searchIn)) {
                $q->orWhereHas('user', function ($userQuery) use ($query) {
                    $userQuery->where('email', 'LIKE', "%{$query}%");
                });
            }
            
            if (in_array('subject', $searchIn)) {
                $q->orWhere('subject', 'LIKE', "%{$query}%");
            }
            
            if (in_array('service_type', $searchIn)) {
                $q->orWhere('subject', 'LIKE', "%web%")
                  ->orWhere('subject', 'LIKE', "%mobile%")
                  ->orWhere('subject', 'LIKE', "%desktop%")
                  ->orWhere('subject', 'LIKE', "%api%")
                  ->orWhere('subject', 'LIKE', "%design%")
                  ->orWhere('subject', 'LIKE', "%konsultasi%")
                  ->orWhere('subject', 'LIKE', "%maintenance%")
                  ->orWhere('subject', 'LIKE', "%hosting%")
                  ->orWhere('subject', 'LIKE', "%domain%")
                  ->orWhere('subject', 'LIKE', "%seo%")
                  ->orWhere('subject', 'LIKE', "%digital marketing%")
                  ->orWhere('subject', 'LIKE', "%branding%")
                  ->orWhere('subject', 'LIKE', "%graphic%")
                  ->orWhere('subject', 'LIKE', "%ui%")
                  ->orWhere('subject', 'LIKE', "%ux%");
            }
            
            if (in_array('messages', $searchIn)) {
                $q->orWhereHas('messages', function ($messageQuery) use ($query) {
                    $messageQuery->where('message', 'LIKE', "%{$query}%");
                });
            }
        });

        $conversations = $conversationQuery->limit(50)->get();
        $conversationIds = $conversations->pluck('id')->toArray();

        return response()->json([
            'success' => true,
            'conversation_ids' => $conversationIds,
            'total_found' => count($conversationIds)
        ]);
    }
}
