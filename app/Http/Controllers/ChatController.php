<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\DetectsFallbackRoute;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    use DetectsFallbackRoute;
    /**
     * Show chat interface - redirect based on user role
     */
    public function index(Request $request)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            // Redirect to appropriate login based on fallback context
            $loginRoute = $this->isFallbackRoute($request, 'support') 
                ? 'account.fallback.login' 
                : 'login';
            return redirect()->route($loginRoute)->with('error', 'Silakan login terlebih dahulu untuk mengakses fitur chat.');
        }

        $user = Auth::user();
        
        // Redirect staff to staff chat dashboard
        if ($user->role && $user->role !== 'customer') {
            return redirect()->route('staff.chat.index');
        }
        
        // Continue with customer chat logic
        return $this->customerChat($request);
    }

    /**
     * Handle customer chat
     */
    private function customerChat(Request $request = null)
    {
        if (!$request) {
            $request = request();
        }
        $user = Auth::user();
        
        // Get existing conversation for this user (including closed ones)
        $conversation = ChatConversation::where('user_id', $user->id)
                                      ->orderBy('created_at', 'desc')
                                      ->first();

        if (!$conversation) {
            // Create new conversation only if user never had one
            $conversation = ChatConversation::create([
                'user_id' => $user->id,
                'subject' => 'Konsultasi Website Development',
                'status' => 'waiting',
                'priority' => 'normal',
                'last_message_at' => now()
            ]);

            // Auto-assign to available CS
            $availableCS = User::where('role', 'customer_service')
                              ->where('status', 'active')
                              ->first();
            
            if ($availableCS) {
                $conversation->assignStaff($availableCS);
                
                // Send welcome message from assigned CS
                ChatMessage::create([
                    'conversation_id' => $conversation->id,
                    'sender_id' => $availableCS->id,
                    'sender_type' => 'staff',
                    'message' => 'Halo! Selamat datang di layanan konsultasi Centrova. Saya ' . $availableCS->name . ' dan akan membantu Anda hari ini. Silakan ceritakan kebutuhan project Anda.',
                    'message_type' => 'text'
                ]);
            } else {
                // Send system message if no CS available
                ChatMessage::create([
                    'conversation_id' => $conversation->id,
                    'sender_id' => 1, // System
                    'sender_type' => 'staff',
                    'message' => 'Halo! Selamat datang di layanan konsultasi Centrova. Tim kami akan segera membantu Anda. Silakan ceritakan kebutuhan project Anda.',
                    'message_type' => 'text'
                ]);
            }
        } else {
            // If conversation exists but is closed, reopen it
            if ($conversation->status === 'closed') {
                $conversation->reopen();
                
                // Send system message about conversation reopening
                ChatMessage::create([
                    'conversation_id' => $conversation->id,
                    'sender_id' => 1, // System
                    'sender_type' => 'staff',
                    'message' => 'Percakapan telah dibuka kembali. Tim kami akan segera membantu Anda.',
                    'message_type' => 'text'
                ]);
            } else {
                // Update last activity
                $conversation->update(['last_message_at' => now()]);
            }
        }

        // Handle package consultation data from query parameters
        if ($request->has('package_name')) {
            // Check if there's already a package consultation message in recent messages
            $recentPackageMessage = $conversation->messages()
                ->where('sender_type', 'user')
                ->where('message', 'like', '%📦 *Paket:%')
                ->where('created_at', '>=', now()->subHours(1))
                ->first();
                
            // Only create package message if there isn't a recent one
            if (!$recentPackageMessage) {
                $this->createPackageConsultationMessage($request, $conversation);
            }
        }

        // Get messages (exclude deleted messages)
        $messages = $conversation->messages()
                                ->where(function($query) {
                                    $query->where('is_deleted', false)
                                          ->orWhereNull('is_deleted');
                                })
                                ->with(['userSender', 'staffSender', 'replyToMessage.userSender', 'replyToMessage.staffSender'])
                                ->get();
        
        // Mark messages as read by user
        $conversation->markAsReadByUser();

        return view('support.web.chat', compact('conversation', 'messages'));
    }

    /**
     * Send message from customer
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:chat_conversations,id',
            'message' => 'required|string|max:1000',
            'reply_to_message_id' => 'nullable|exists:chat_messages,id'
        ]);

        $user = Auth::user();
        $conversation = ChatConversation::findOrFail($request->conversation_id);

        // Check if user owns this conversation
        if ($conversation->user_id !== $user->id) {
            return back()->withErrors(['error' => 'Unauthorized']);
        }

        // Create message data
        $messageData = [
            'conversation_id' => $conversation->id,
            'sender_id' => $user->id,
            'sender_type' => 'user',
            'message' => $request->message,
            'message_type' => 'text'
        ];

        // Add reply_to_message_id if provided
        if ($request->reply_to_message_id) {
            $messageData['reply_to_message_id'] = $request->reply_to_message_id;
        }

        // Create message
        $message = ChatMessage::create($messageData);

        // Update conversation
        $conversation->update([
            'last_message_at' => now(),
            'status' => $conversation->status === 'waiting' ? 'waiting' : 'active'
        ]);

        // If this was an AJAX request, return JSON
        if ($request->ajax() || $request->wantsJson()) {
            // Load sender relationship and reply message
            $message->load(['userSender', 'staffSender', 'replyToMessage.userSender', 'replyToMessage.staffSender']);

            return response()->json([
                'success' => true,
                'message' => [
                    'id' => $message->id,
                    'message' => $message->message,
                    'sender_name' => $message->sender_name,
                    'sender_type' => $message->sender_type,
                    'created_at' => $message->created_at->format('Y-m-d H:i:s'),
                    'formatted_date' => $message->formatted_date,
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

        // For regular form submission, redirect back to chat
        return redirect()->route('support.web.chat')->with('success', 'Pesan berhasil dikirim!');
    }

    /**
     * Get new messages for customer
     */
    public function getNewMessages(Request $request, $conversation = null)
    {
        // Handle both route parameter and request parameter
        $conversationId = $conversation ?? $request->conversation_id;
        $lastMessageId = $request->last_message_id ?? $request->query('last_message_id', 0);

        if (!$conversationId) {
            return response()->json(['error' => 'Conversation ID required'], 400);
        }

        $user = Auth::user();
        $conversation = ChatConversation::findOrFail($conversationId);

        // Check if user owns this conversation
        if ($conversation->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Get new messages (exclude deleted messages)
        $messages = $conversation->messages()
                                ->where('id', '>', $lastMessageId)
                                ->where(function($query) {
                                    $query->where('is_deleted', false)
                                          ->orWhereNull('is_deleted');
                                })
                                ->with(['userSender', 'staffSender', 'replyToMessage.userSender', 'replyToMessage.staffSender'])
                                ->get();

        // Mark messages as read by user
        $conversation->markAsReadByUser();

        $messagesData = $messages->map(function ($message) {
            $data = [
                'id' => $message->id,
                'message' => $message->message,
                'sender_name' => $message->sender_name,
                'sender_type' => $message->sender_type,
                'created_at' => $message->created_at->format('Y-m-d H:i:s'),
                'formatted_date' => $message->formatted_date,
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
     * Close conversation
     */
    public function closeConversation(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:chat_conversations,id'
        ]);

        $user = Auth::user();
        $conversation = ChatConversation::findOrFail($request->conversation_id);

        // Check if user owns this conversation
        if ($conversation->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $conversation->close();

        return response()->json(['success' => true]);
    }

    /**
     * Create package consultation message
     */
    private function createPackageConsultationMessage(Request $request, ChatConversation $conversation)
    {
        $user = Auth::user();
        
        // Build consultation message with clean formatting
        $message = "Halo! Saya tertarik untuk konsultasi mengenai paket website berikut:\n\n";
        
        // Package details
        $message .= "PAKET: " . $request->input('package_name', 'N/A') . "\n";
        $message .= "HARGA: " . $request->input('package_price', 'N/A') . "\n";
        
        if ($request->has('package_description') && $request->input('package_description') !== 'N/A') {
            $message .= "DESKRIPSI: " . $request->input('package_description') . "\n";
        }
        $message .= "\n";
        
        // Customer info if provided
        if ($request->has('customer_name') || $request->has('business_type')) {
            $message .= "INFO CUSTOMER:\n";
            if ($request->has('customer_name')) {
                $message .= "- Nama: " . $request->input('customer_name') . "\n";
            }
            if ($request->has('business_type')) {
                $message .= "- Jenis Bisnis: " . $request->input('business_type') . "\n";
            }
            if ($request->has('special_features')) {
                $message .= "- Fitur Khusus: " . $request->input('special_features') . "\n";
            }
            $message .= "\n";
        }
        
        // Package features
        if ($request->has('package_features')) {
            $features = explode(', ', $request->input('package_features'));
            $message .= "FITUR YANG TERMASUK:\n";
            foreach ($features as $feature) {
                $message .= "- " . trim($feature) . "\n";
            }
            $message .= "\n";
        }
        
        $message .= "Mohon informasi lebih lanjut mengenai paket ini. Terima kasih!";
        
        // Create the message
        return ChatMessage::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $user->id,
            'sender_type' => 'user',
            'message' => $message,
            'message_type' => 'text'
        ]);
    }
}
