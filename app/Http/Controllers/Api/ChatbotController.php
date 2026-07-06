<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function ask(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        $userMessage = $request->input('message');

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer sk-66c4d2e259984004ab9e0e8b655c4099',
                'Content-Type' => 'application/json',
            ])->timeout(60)->post('https://api.deepseek.com/v1/chat/completions', [
                'model' => 'deepseek-chat',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Anda adalah asisten AI resmi Centrova (PT Centrova Teknologi Indonesia). Jawab pertanyaan dengan ramah, informatif, dan dalam bahasa Indonesia. Anda membantu pengguna yang menanyakan tentang layanan Centrova seperti: web development, mobile app development, UI/UX design, AI automation, AI agents, konsultasi teknologi, dan solusi digital lainnya. Jika ditanya di luar topik layanan Centrova, arahkan kembali ke layanan Centrova dengan sopan. Gunakan bahasa yang hangat dan profesional. Maksimal 300 kata per respons.',
                    ],
                    [
                        'role' => 'user',
                        'content' => $userMessage,
                    ],
                ],
                'max_tokens' => 1000,
                'temperature' => 0.7,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $reply = $data['choices'][0]['message']['content'] ?? 'Maaf, saya tidak bisa menjawab pertanyaan tersebut saat ini.';

                return response()->json([
                    'success' => true,
                    'reply' => $reply,
                ]);
            }

            Log::error('DeepSeek API error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return response()->json([
                'success' => false,
                'reply' => 'Maaf, layanan AI sedang sibuk. Silakan coba lagi nanti.',
            ], 500);

        } catch (\Exception $e) {
            Log::error('Chatbot exception: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'reply' => 'Maaf, terjadi kesalahan koneksi. Silakan coba lagi nanti.',
            ], 500);
        }
    }
}
