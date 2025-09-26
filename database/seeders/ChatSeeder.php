<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\User;
use App\Models\StaffUser;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get first user and staff for demo
        $user = User::first();
        $staff = StaffUser::first();

        if (!$user || !$staff) {
            $this->command->warn('User atau Staff tidak ditemukan. Pastikan UserSeeder dan StaffUserSeeder sudah dijalankan.');
            return;
        }

        // Create sample conversation
        $conversation = ChatConversation::create([
            'user_id' => $user->id,
            'staff_id' => $staff->id,
            'subject' => 'Konsultasi Website Development',
            'status' => 'active',
            'priority' => 'normal',
            'last_message_at' => now()
        ]);

        // Create sample messages
        $messages = [
            [
                'conversation_id' => $conversation->id,
                'sender_id' => $staff->id,
                'sender_type' => 'staff',
                'message' => 'Halo! Selamat datang di layanan konsultasi Centrova. Tim kami akan segera membantu Anda. Silakan ceritakan kebutuhan project Anda.',
                'message_type' => 'text',
                'created_at' => now()->subMinutes(10),
                'updated_at' => now()->subMinutes(10)
            ],
            [
                'conversation_id' => $conversation->id,
                'sender_id' => $user->id,
                'sender_type' => 'user',
                'message' => 'Halo, saya ingin membuat website e-commerce untuk bisnis saya. Bisa tolong jelaskan paket yang tersedia?',
                'message_type' => 'text',
                'created_at' => now()->subMinutes(8),
                'updated_at' => now()->subMinutes(8)
            ],
            [
                'conversation_id' => $conversation->id,
                'sender_id' => $staff->id,
                'sender_type' => 'staff',
                'message' => 'Tentu! Kami memiliki beberapa paket website e-commerce yang bisa disesuaikan dengan kebutuhan Anda. Mulai dari paket Basic hingga Enterprise. Bisa ceritakan lebih detail tentang bisnis Anda?',
                'message_type' => 'text',
                'created_at' => now()->subMinutes(6),
                'updated_at' => now()->subMinutes(6)
            ],
            [
                'conversation_id' => $conversation->id,
                'sender_id' => $user->id,
                'sender_type' => 'user',
                'message' => 'Saya menjual produk fashion online. Saat ini masih pakai marketplace, tapi ingin punya website sendiri. Kira-kira berapa budget yang diperlukan?',
                'message_type' => 'text',
                'created_at' => now()->subMinutes(4),
                'updated_at' => now()->subMinutes(4)
            ],
            [
                'conversation_id' => $conversation->id,
                'sender_id' => $staff->id,
                'sender_type' => 'staff',
                'message' => 'Perfect! Untuk bisnis fashion e-commerce, kami rekomendasikan paket Professional yang include payment gateway, inventory management, dan responsive design. Budget mulai dari 15 juta untuk fitur lengkap. Apakah Anda ingin konsultasi lebih detail via call?',
                'message_type' => 'text',
                'created_at' => now()->subMinutes(2),
                'updated_at' => now()->subMinutes(2)
            ]
        ];

        foreach ($messages as $messageData) {
            ChatMessage::create($messageData);
        }

        // Update conversation last message time
        $conversation->update([
            'last_message_at' => now()->subMinutes(2)
        ]);

        $this->command->info('Chat data seeded successfully!');
    }
}
