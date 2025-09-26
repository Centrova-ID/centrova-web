<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\WhatsAppOtpService;
use App\Models\TwoFactorAuthLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WhatsAppTwoFactorController extends Controller
{
    protected $whatsappOtpService;

    public function __construct(WhatsAppOtpService $whatsappOtpService)
    {
        $this->whatsappOtpService = $whatsappOtpService;
    }

    /**
     * Show WhatsApp 2FA verification form
     */
    public function showVerification()
    {
        if (!session('2fa_user_id')) {
            return redirect()->route('login');
        }

        $user = \App\Models\User::findOrFail(session('2fa_user_id'));
        
        // Check if user has phone number
        if (empty($user->phone)) {
            return redirect()->route('login')->withErrors([
                'phone' => 'Nomor telepon diperlukan untuk autentikasi dua faktor via WhatsApp.'
            ]);
        }

        $twoFactorAuth = $user->twoFactorAuth;
        
        return view('auth.two-factor.whatsapp-verify', compact('twoFactorAuth'));
    }

    /**
     * Send WhatsApp OTP
     */
    public function sendOtp(Request $request)
    {
        if (!session('2fa_user_id')) {
            return response()->json([
                'success' => false,
                'message' => 'Session tidak valid.'
            ], 400);
        }

        $user = \App\Models\User::findOrFail(session('2fa_user_id'));

        // Check cooldown
        $cooldownCheck = $this->whatsappOtpService->canRequestNewOtp($user);
        if (!$cooldownCheck['can_request']) {
            return response()->json([
                'success' => false,
                'message' => $cooldownCheck['message'],
                'wait_time' => $cooldownCheck['wait_time'] ?? 0
            ], 429);
        }

        // Send OTP
        $result = $this->whatsappOtpService->sendOtp($user);

        // Log activity
        TwoFactorAuthLog::logAction($user->id, $result['success'] ? 'whatsapp_otp_sent' : 'whatsapp_otp_failed');

        return response()->json($result);
    }

    /**
     * Verify WhatsApp OTP
     */
    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp_code' => 'required|digits:6',
            'trust_device' => 'sometimes|boolean',
        ], [
            'otp_code.required' => 'Kode OTP harus diisi',
            'otp_code.digits' => 'Kode OTP harus terdiri dari 6 angka',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $userId = session('2fa_user_id');
        if (!$userId) {
            return redirect()->route('login');
        }

        $user = \App\Models\User::findOrFail($userId);

        // Verify OTP
        $result = $this->whatsappOtpService->verifyOtp($user, $request->otp_code);

        if (!$result['success']) {
            TwoFactorAuthLog::logAction($user->id, 'whatsapp_otp_failed');
            return back()->withErrors(['otp_code' => $result['message']])->withInput();
        }

        // OTP verified successfully
        TwoFactorAuthLog::logAction($user->id, 'whatsapp_otp_verified');

        // Trust device if requested AND user allows device trust
        if ($request->trust_device && $user->twoFactorAuth->allowsDeviceTrust()) {
            $this->trustCurrentDevice($user);
        }

        // Complete login
        Auth::login($user);
        session()->forget('2fa_user_id');

        // Update last login time
        \App\Models\User::where('id', $user->id)->update(['last_login_at' => now()]);

        return redirect()->intended(route('dashboard'))
            ->with('success', 'Login berhasil dengan verifikasi WhatsApp 2FA.');
    }

    /**
     * Switch to PIN-based 2FA
     */
    public function switchToPin()
    {
        if (!session('2fa_user_id')) {
            return redirect()->route('login');
        }

        return redirect()->route('two-factor.verify');
    }

    /**
     * Resend OTP
     */
    public function resendOtp(Request $request)
    {
        if (!session('2fa_user_id')) {
            return response()->json([
                'success' => false,
                'message' => 'Session tidak valid.'
            ], 400);
        }

        $user = \App\Models\User::findOrFail(session('2fa_user_id'));

        // Check cooldown
        $cooldownCheck = $this->whatsappOtpService->canRequestNewOtp($user);
        if (!$cooldownCheck['can_request']) {
            return response()->json([
                'success' => false,
                'message' => $cooldownCheck['message'],
                'wait_time' => $cooldownCheck['wait_time'] ?? 0
            ], 429);
        }

        // Send new OTP
        $result = $this->whatsappOtpService->sendOtp($user);

        // Log activity
        TwoFactorAuthLog::logAction($user->id, $result['success'] ? 'whatsapp_otp_resent' : 'whatsapp_otp_resend_failed');

        return response()->json($result);
    }

    /**
     * Trust current device
     */
    protected function trustCurrentDevice($user)
    {
        $request = request();
        $deviceFingerprint = \App\Models\TrustedDevice::generateFingerprint($request);
        $deviceInfo = \App\Models\TrustedDevice::parseUserAgent($request->header('User-Agent'));

        $trustedDevice = \App\Models\TrustedDevice::create([
            'user_id' => $user->id,
            'device_fingerprint' => $deviceFingerprint,
            'device_name' => $deviceInfo['browser'] . ' on ' . $deviceInfo['os'],
            'device_type' => $deviceInfo['device_type'],
            'browser' => $deviceInfo['browser'],
            'os' => $deviceInfo['os'],
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'last_used_at' => now(),
            'expires_at' => now()->addDays(30), // Trust for 30 days
            'is_active' => true,
        ]);

        TwoFactorAuthLog::logAction($user->id, 'device_trusted', ['device_id' => $trustedDevice->id]);
    }
}
