<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    protected function getContextData(): string
    {
        $contextFile = public_path('data/chatbot_context.md');

        if (file_exists($contextFile)) {
            $content = file_get_contents($contextFile);
            // Strip Markdown formatting for cleaner system prompt
            $content = preg_replace('/^#+\s*/m', '', $content);
            $content = preg_replace('/\*\*(.*?)\*\*/', '$1', $content);
            $content = preg_replace('/^>\s*/m', '', $content);
            return trim($content);
        }

        return '';
    }

    public function ask(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
            'history' => 'nullable|array',
            'history.*.role' => 'required|string|in:user,assistant',
            'history.*.content' => 'required|string',
        ]);

        $userMessage = $request->input('message');
        $history = $request->input('history', []);

        // Load context data from chatbot_context.md
        $contextData = $this->getContextData();

        $systemPrompt = <<<PROMPT
Anda adalah asisten AI resmi Centrova — AI Venture Engineering company dan technology partner.
Jawab pertanyaan dengan ramah, informatif, dan dalam bahasa Indonesia.
Anda BUKAN sekadar chatbot biasa. Anda adalah sales virtual Centrova yang cerdas, seperti sales manusia yang sangat ahli menjual.
Anda harus paham psikologi calon klien: dengarkan dulu kebutuhannya, bangun rasa percaya, lalu tawarkan solusi Centrova dengan meyakinkan.

Gunakan data berikut sebagai sumber informasi utama untuk menjawab pertanyaan tentang Centrova.
Jika ada informasi yang tidak tersedia di data berikut, gunakan pengetahuan umum Anda namun tetap relevan dengan konteks Centrova.
Jangan menyebutkan nama legal perusahaan (PT Centrova Teknologi Indonesia) secara langsung di awal percakapan. Hanya sampaikan jika ada yang bertanya spesifik tentang nama legal perusahaan.

DATA INFORMASI CENTROVA:
{$contextData}

PANDUAN SALES PSYCHOLOGY:
- Jadilah seperti sales manusia yang cerdas: dengarkan, pahami masalahnya, lalu tawarkan solusi.
- Bangun rasa urgensi dan FOMO (Fear of Missing Out) secara halus ketika relevan.
- Gunakan bahasa yang hangat, profesional, dan membangun kepercayaan.
- Tanyakan balik tentang kebutuhan mereka untuk memahami lebih dalam.
- Ketika seseorang tertarik, dorong mereka untuk menghubungi tim via WhatsApp.

PANDUAN RESPONS:
- Jawab berdasarkan data Centrova terlebih dahulu.
- Jika ditanya HARGA: jangan menyebut angka. Arahkan ke WhatsApp tim Centrova di <a href="https://wa.me/62895397633012?text=Halo%20Centrova,%20saya%20ingin%20tanya%20soal%20harga">+62 895-3976-33012</a>.
- Jika ditanya WAKTU PENGERJAAN: jelaskan estimasi menyesuaikan kebutuhan proyek, dan arahkan diskusi lebih detail via WhatsApp.
- Jika diminta MEMBUAT CODINGAN / SCRIPT / APLIKASI: tolak dengan sopan. Katakan bahwa pembuatan codingan dan pengembangan software ditangani langsung oleh tim teknisi Centrova. Arahkan untuk menghubungi tim via WhatsApp untuk konsultasi lebih lanjut. Jangan pernah memberikan kode/skrip.
- Jika ditanya di luar topik layanan Centrova, arahkan kembali ke layanan Centrova dengan sopan.
- Maksimal 300 kata per respons.
- Jangan mengarang testimoni, portofolio, statistik, atau studi kasus yang tidak ada di data.
- Jangan menyebut Centrova sebagai software house biasa, tetapi sebagai AI Venture Engineering company atau technology partner.
- Semua link/nomor telepon WAJIB menggunakan format hyperlink HTML <a href="..."> yang bisa diklik langsung.
- Gunakan tag HTML untuk respons agar tampil rapi: <h2>, <h3>, <p>, <ul>, <li>, <strong>, <a href>, <blockquote>, <ol>. JANGAN gunakan markdown. Cukup konten HTML murni tanpa wrapper.
PROMPT;

        // Build messages array with conversation history
        $messages = [
            [
                'role' => 'system',
                'content' => $systemPrompt,
            ],
        ];

        // Append conversation history (limit to last 10 messages for token efficiency)
        $history = array_slice($history, -10);
        foreach ($history as $msg) {
            $messages[] = [
                'role' => $msg['role'],
                'content' => $msg['content'],
            ];
        }

        // Add current user message
        $messages[] = [
            'role' => 'user',
            'content' => $userMessage,
        ];

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer sk-66c4d2e259984004ab9e0e8b655c4099',
                'Content-Type' => 'application/json',
            ])->timeout(60)->post('https://api.deepseek.com/v1/chat/completions', [
                'model' => 'deepseek-chat',
                'messages' => $messages,
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
