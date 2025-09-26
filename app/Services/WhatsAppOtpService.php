<?php

namespace App\Services;

use App\Models\User;
use App\Models\WhatsAppOtp;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class WhatsAppOtpService
{
    protected $fonnte_url;
    protected $fonnte_token;

    public function __construct()
    {
        $this->fonnte_url = config('services.fonnte.url');
        $this->fonnte_token = config('services.fonnte.token');
    }

    /**
     * Generate dan kirim OTP via WhatsApp
     */
    public function sendOtp(User $user): array
    {
        // Cek apakah user punya nomor telepon
        if (empty($user->phone)) {
            return [
                'success' => false,
                'message' => 'Nomor telepon belum terdaftar. Silakan update nomor telepon Anda terlebih dahulu.'
            ];
        }

        // Format nomor telepon
        $phone = $this->formatPhoneNumber($user->phone);

        // Generate OTP
        $otpCode = $this->generateOtp();

        // Simpan OTP ke database (skip for testing with fake users)
        if ($user->id && $user->id !== 999999) {
            $otp = WhatsAppOtp::create([
                'user_id' => $user->id,
                'phone' => $phone,
                'otp_code' => $otpCode,
                'expires_at' => Carbon::now()->addMinutes(5), // Berlaku 5 menit
                'attempts' => 0,
                'is_used' => false,
            ]);
        }

        // Kirim OTP via WhatsApp
        $sendResult = $this->sendWhatsAppMessage($phone, $otpCode, $user->name);

        if ($sendResult['success']) {
            return [
                'success' => true,
                'message' => 'Kode OTP telah dikirim ke WhatsApp Anda.',
                'expires_in' => 5 // menit
            ];
        } else {
            // Hapus OTP jika gagal mengirim (dan bukan testing)
            if (isset($otp)) {
                $otp->delete();
            }
            return [
                'success' => false,
                'message' => 'Gagal mengirim OTP. Silakan coba lagi.'
            ];
        }
    }

    /**
     * Verifikasi OTP
     */
    public function verifyOtp(User $user, string $otpCode): array
    {
        $otp = WhatsAppOtp::where('user_id', $user->id)
            ->where('is_used', false)
            ->where('expires_at', '>', Carbon::now())
            ->latest()
            ->first();

        if (!$otp) {
            return [
                'success' => false,
                'message' => 'Kode OTP tidak valid atau sudah kadaluarsa.'
            ];
        }

        // Increment attempts
        $otp->increment('attempts');

        // Check max attempts
        if ($otp->attempts > 3) {
            $otp->update(['is_used' => true]);
            return [
                'success' => false,
                'message' => 'Terlalu banyak percobaan. Silakan minta kode OTP baru.'
            ];
        }

        // Verify OTP
        if ($otp->otp_code !== $otpCode) {
            return [
                'success' => false,
                'message' => 'Kode OTP salah. Silakan coba lagi.',
                'attempts_left' => 3 - $otp->attempts
            ];
        }

        // OTP valid, mark as used
        $otp->update([
            'is_used' => true,
            'verified_at' => Carbon::now()
        ]);

        return [
            'success' => true,
            'message' => 'Kode OTP berhasil diverifikasi.'
        ];
    }

    /**
     * Cek apakah user dapat request OTP baru
     */
    public function canRequestNewOtp(User $user): array
    {
        $lastOtp = WhatsAppOtp::where('user_id', $user->id)
            ->latest()
            ->first();

        if (!$lastOtp) {
            return ['can_request' => true];
        }

        // Cooldown 1 menit antar request
        $cooldownTime = 60; // seconds
        $timeSinceLastRequest = Carbon::now()->diffInSeconds($lastOtp->created_at);

        if ($timeSinceLastRequest < $cooldownTime) {
            $waitTime = $cooldownTime - $timeSinceLastRequest;
            return [
                'can_request' => false,
                'wait_time' => $waitTime,
                'message' => "Silakan tunggu {$waitTime} detik sebelum meminta kode OTP baru."
            ];
        }

        return ['can_request' => true];
    }

    /**
     * Generate OTP 6 digit
     */
    private function generateOtp(): string
    {
        return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    /**
     * Format nomor telepon ke format internasional
     */
    private function formatPhoneNumber(string $phone): string
    {
        // Remove semua karakter non-digit
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // Jika dimulai dengan 0, ganti dengan 62
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }

        // Jika belum ada kode negara, tambahkan 62
        if (!str_starts_with($phone, '62')) {
            $phone = '62' . $phone;
        }

        return $phone;
    }

    /**
     * Kirim pesan WhatsApp via Fonnte
     */
    private function sendWhatsAppMessage(string $phone, string $otpCode, string $name): array
    {
        try {
            $message = "Halo {$name},\n\n";
            $message .= "Kode OTP Centrova Anda adalah: *{$otpCode}*\n\n";
            $message .= "⏰ Berlaku selama 5 menit\n";
            $message .= "🔒 Jangan berikan kode ini kepada siapapun\n\n";
            $message .= "Jika Anda tidak meminta kode ini, abaikan pesan ini.\n\n";
            $message .= "Salam,\nTim Centrova";

            $response = Http::withHeaders([
                'Authorization' => $this->fonnte_token,
            ])->withOptions([
                'verify' => false, // Disable SSL verification for development
            ])->post($this->fonnte_url, [
                'target' => $phone,
                'message' => $message,
                'countryCode' => '62',
            ]);

            if ($response->successful()) {
                $result = $response->json();
                
                Log::info('WhatsApp OTP sent successfully', [
                    'phone' => $phone,
                    'otp' => $otpCode,
                    'response' => $result
                ]);

                return [
                    'success' => true,
                    'response' => $result
                ];
            } else {
                Log::error('Failed to send WhatsApp OTP', [
                    'phone' => $phone,
                    'status' => $response->status(),
                    'response' => $response->body()
                ]);

                return [
                    'success' => false,
                    'error' => 'Failed to send WhatsApp message',
                    'details' => $response->body()
                ];
            }
        } catch (\Exception $e) {
            Log::error('Exception while sending WhatsApp OTP', [
                'phone' => $phone,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Bersihkan OTP yang sudah kadaluarsa
     */
    public function cleanExpiredOtps(): int
    {
        return WhatsAppOtp::where('expires_at', '<', Carbon::now())
            ->orWhere('is_used', true)
            ->where('created_at', '<', Carbon::now()->subDays(7))
            ->delete();
    }
}
