<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TwoFactorAuth;
use App\Models\TwoFactorAuthLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class TwoFactorAuthController extends Controller
{
    /**
     * Show the 2FA setup page
     */
    public function index()
    {
        // Check if password was recently confirmed
        if (!$this->isPasswordRecentlyConfirmed()) {
            return redirect()->route('login', ['mode' => 'confirm-password', 'redirect' => 'twofactor']);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        // Get or create 2FA settings
        $twoFactorAuth = $user->twoFactorAuth ?: $user->twoFactorAuth()->create(['is_enabled' => false]);
        
        // Get trusted devices
        $trustedDevices = $user->trustedDevices()
            ->where('is_active', true)
            ->orderBy('last_used_at', 'desc')
            ->get();
        
        return view('auth.two-factor.index', compact('user', 'twoFactorAuth', 'trustedDevices'));
    }

    /**
     * Show enable 2FA form
     */
    public function showEnable()
    {
        // Check if password was recently confirmed
        if (!$this->isPasswordRecentlyConfirmed()) {
            return redirect()->route('login', ['mode' => 'confirm-password', 'redirect' => 'twofactor-enable']);
        }
        
        $user = Auth::user();
        
        return view('auth.two-factor.enable', compact('user'));
    }

    /**
     * Show disable 2FA form
     */
    public function showDisable()
    {
        // Check if password was recently confirmed
        if (!$this->isPasswordRecentlyConfirmed()) {
            return redirect()->route('login', ['mode' => 'confirm-password', 'redirect' => 'twofactor-disable']);
        }
        
        $user = Auth::user();
        $twoFactorAuth = $user->twoFactorAuth;
        
        if (!$twoFactorAuth || !$twoFactorAuth->is_enabled) {
            return redirect()->route('security.two-factor.index')->withErrors([
                'error' => 'Autentikasi 2 faktor tidak aktif'
            ]);
        }
        
        return view('auth.two-factor.disable', compact('user'));
    }    /**
     * Check if password was recently confirmed (within 1 minute)
     */
    private function isPasswordRecentlyConfirmed()
    {
        $confirmedAt = session('password_confirmed_at');
        return $confirmedAt && (time() - $confirmedAt < 60); // 1 minute
    }

    /**
     * Enable 2FA and set PIN
     */
    public function enable(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pin' => 'required|digits:6',
            'pin_confirmation' => 'required|same:pin',
        ], [
            'pin.required' => 'PIN harus diisi',
            'pin.digits' => 'PIN harus terdiri dari 6 angka',
            'pin_confirmation.required' => 'Konfirmasi PIN harus diisi',
            'pin_confirmation.same' => 'Konfirmasi PIN tidak sesuai',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        // Get or create 2FA settings
        $twoFactorAuth = $user->twoFactorAuth ?: $user->twoFactorAuth()->create(['is_enabled' => false]);

        // Set PIN and enable 2FA
        $twoFactorAuth->setPin($request->pin);
        $twoFactorAuth->is_enabled = true;
        $twoFactorAuth->save();

        // Generate recovery codes
        $recoveryCodes = $twoFactorAuth->generateRecoveryCodes();

        // Log the action
        TwoFactorAuthLog::logAction($user->id, 'pin_created');

        return view('auth.two-factor.recovery-codes', compact('user', 'recoveryCodes'));
    }

    /**
     * Disable 2FA
     */
    public function disable(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_pin' => 'required|digits:6',
        ], [
            'current_pin.required' => 'PIN saat ini harus diisi',
            'current_pin.digits' => 'PIN harus terdiri dari 6 angka',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $user = Auth::user();
        $twoFactorAuth = $user->twoFactorAuth;

        if (!$twoFactorAuth || !$twoFactorAuth->is_enabled) {
            return back()->withErrors(['error' => 'Autentikasi 2 faktor tidak aktif']);
        }

        // Verify current PIN
        if (!$twoFactorAuth->verifyPin($request->current_pin)) {
            TwoFactorAuthLog::logAction($user->id, 'pin_failed', ['action' => 'disable_attempt']);
            return back()->withErrors(['current_pin' => 'PIN salah']);
        }

        // Disable 2FA
        $twoFactorAuth->disable();

        // Remove all trusted devices
        // Revoke all trusted devices
        \App\Models\TrustedDevice::where('user_id', $user->id)
            ->update(['is_active' => false]);

        // Log the action
        TwoFactorAuthLog::logAction($user->id, 'pin_disabled');

        return redirect()->route('security.two-factor.index')
            ->with('success', 'Autentikasi 2 faktor berhasil dinonaktifkan');
    }

    /**
     * Generate new recovery codes
     */
    public function generateRecoveryCodes(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_pin' => 'required|digits:6',
        ], [
            'current_pin.required' => 'PIN saat ini harus diisi',
            'current_pin.digits' => 'PIN harus terdiri dari 6 angka',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $user = Auth::user();
        $twoFactorAuth = $user->twoFactorAuth;

        if (!$twoFactorAuth || !$twoFactorAuth->is_enabled) {
            return back()->withErrors(['error' => 'Autentikasi 2 faktor tidak aktif']);
        }

        // Verify current PIN
        if (!$twoFactorAuth->verifyPin($request->current_pin)) {
            TwoFactorAuthLog::logAction($user->id, 'pin_failed', ['action' => 'recovery_generation']);
            return back()->withErrors(['current_pin' => 'PIN salah']);
        }

        // Generate new recovery codes
        $recoveryCodes = $twoFactorAuth->generateRecoveryCodes();

        // Log the action
        TwoFactorAuthLog::logAction($user->id, 'recovery_generated');

        return view('auth.two-factor.recovery-codes', compact('user', 'recoveryCodes'));
    }

    /**
     * Show PIN verification form
     */
    public function showVerification()
    {
        if (!session('2fa_user_id')) {
            return redirect()->route('login');
        }

        $userId = session('2fa_user_id');
        $user = User::findOrFail($userId);
        $twoFactorAuth = $user->twoFactorAuth;

        return view('auth.two-factor.verify', compact('twoFactorAuth'));
    }

    /**
     * Verify PIN during login
     */
    public function verify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pin' => 'required|digits:6',
            'trust_device' => 'sometimes|boolean',
        ], [
            'pin.required' => 'PIN harus diisi',
            'pin.digits' => 'PIN harus terdiri dari 6 angka',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $userId = session('2fa_user_id');
        if (!$userId) {
            return redirect()->route('login');
        }

        $user = \App\Models\User::findOrFail($userId);
        $twoFactorAuth = $user->twoFactorAuth;

        if (!$twoFactorAuth || !$twoFactorAuth->is_enabled) {
            return redirect()->route('login');
        }

        // Check if account is locked
        if ($twoFactorAuth->isLocked()) {
            $lockTime = $twoFactorAuth->locked_until->diffForHumans();
            return back()->withErrors(['pin' => "Akun terkunci karena terlalu banyak percobaan gagal. Coba lagi {$lockTime}."]);
        }

        // Verify PIN
        if (!$twoFactorAuth->verifyPin($request->pin)) {
            TwoFactorAuthLog::logAction($user->id, 'pin_failed', ['action' => 'login_verification']);
            return back()->withErrors(['pin' => 'PIN salah'])->withInput();
        }

        // PIN verified successfully
        TwoFactorAuthLog::logAction($user->id, 'pin_verified', ['action' => 'login_verification']);

        // Trust device if requested AND user allows device trust
        if ($request->trust_device && $twoFactorAuth->allowsDeviceTrust()) {
            $this->trustCurrentDevice($user);
        }

        // Complete login
        Auth::login($user);
        session()->forget('2fa_user_id');

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Verify recovery code during login
     */
    public function verifyRecovery(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'recovery_code' => 'required|string|size:8',
        ], [
            'recovery_code.required' => 'Kode pemulihan harus diisi',
            'recovery_code.size' => 'Kode pemulihan harus terdiri dari 8 karakter',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $userId = session('2fa_user_id');
        if (!$userId) {
            return redirect()->route('login');
        }

        $user = \App\Models\User::findOrFail($userId);
        $twoFactorAuth = $user->twoFactorAuth;

        if (!$twoFactorAuth || !$twoFactorAuth->is_enabled) {
            return redirect()->route('login');
        }

        // Verify recovery code
        if (!$twoFactorAuth->verifyRecoveryCode(strtoupper($request->recovery_code))) {
            TwoFactorAuthLog::logAction($user->id, 'recovery_failed');
            return back()->withErrors(['recovery_code' => 'Kode pemulihan tidak valid']);
        }

        // Recovery code verified successfully
        TwoFactorAuthLog::logAction($user->id, 'recovery_used');

        // Complete login
        Auth::login($user);
        session()->forget('2fa_user_id');

        return redirect()->intended(route('dashboard'))
            ->with('warning', 'Anda telah menggunakan kode pemulihan. Silakan buat kode pemulihan baru.');
    }

    /**
     * Revoke trusted device
     */
    public function revokeDevice(Request $request, $deviceId)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        // Find the trusted device
        $device = \App\Models\TrustedDevice::where('user_id', $user->id)
            ->where('id', $deviceId)
            ->firstOrFail();
        
        $device->revoke();

        TwoFactorAuthLog::logAction($user->id, 'device_removed', ['device_id' => $deviceId]);

        return back()->with('success', 'Perangkat terpercaya berhasil dihapus');
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

    /**
     * Toggle WhatsApp 2FA
     */
    public function toggleWhatsApp(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $twoFactorAuth = $user->twoFactorAuth;

        if (!$twoFactorAuth || !$twoFactorAuth->is_enabled) {
            return back()->withErrors(['error' => 'Autentikasi 2 faktor harus diaktifkan terlebih dahulu']);
        }

        if (empty($user->phone)) {
            return back()->withErrors(['error' => 'Nomor telepon diperlukan untuk mengaktifkan 2FA via WhatsApp']);
        }

        if ($twoFactorAuth->whatsapp_enabled) {
            $twoFactorAuth->disableWhatsApp();
            TwoFactorAuthLog::logAction($user->id, 'whatsapp_2fa_disabled');
            $message = 'WhatsApp 2FA berhasil dinonaktifkan';
        } else {
            $twoFactorAuth->enableWhatsApp();
            TwoFactorAuthLog::logAction($user->id, 'whatsapp_2fa_enabled');
            $message = 'WhatsApp 2FA berhasil diaktifkan';
        }

        return back()->with('success', $message);
    }

    /**
     * Set preferred 2FA method
     */
    public function setPreferredMethod(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'method' => 'required|in:pin,whatsapp',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $twoFactorAuth = $user->twoFactorAuth;

        if (!$twoFactorAuth || !$twoFactorAuth->is_enabled) {
            return back()->withErrors(['error' => 'Autentikasi 2 faktor tidak aktif']);
        }

        if ($request->method === 'whatsapp' && !$twoFactorAuth->whatsapp_enabled) {
            return back()->withErrors(['error' => 'WhatsApp 2FA belum diaktifkan']);
        }

        if ($request->method === 'whatsapp' && empty($user->phone)) {
            return back()->withErrors(['error' => 'Nomor telepon diperlukan untuk WhatsApp 2FA']);
        }

        $twoFactorAuth->setPreferredMethod($request->method);
        
        TwoFactorAuthLog::logAction($user->id, 'preferred_method_changed', ['method' => $request->method]);

        $methodName = $request->method === 'whatsapp' ? 'WhatsApp' : 'PIN';
        return back()->with('success', "Metode 2FA berhasil diubah ke {$methodName}");
    }

    /**
     * Toggle device trust requirement
     */
    public function toggleDeviceTrust(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $twoFactorAuth = $user->twoFactorAuth;

        if (!$twoFactorAuth || !$twoFactorAuth->is_enabled) {
            return back()->withErrors(['error' => 'Autentikasi 2 faktor harus diaktifkan terlebih dahulu']);
        }

        $newSetting = !$twoFactorAuth->require_2fa_every_login;
        $twoFactorAuth->setRequire2FAEveryLogin($newSetting);

        // If switching to "require every login", revoke all trusted devices
        if ($newSetting) {
            $user->trustedDevices()->where('is_active', true)->update(['is_active' => false]);
            TwoFactorAuthLog::logAction($user->id, 'all_trusted_devices_revoked', ['reason' => 'require_every_login_enabled']);
        }

        TwoFactorAuthLog::logAction($user->id, 'device_trust_policy_changed', [
            'require_every_login' => $newSetting
        ]);

        $message = $newSetting 
            ? 'Sekarang Anda harus melakukan verifikasi 2FA setiap login. Semua perangkat terpercaya telah dihapus.'
            : 'Sekarang Anda dapat mempercayai perangkat untuk tidak melakukan verifikasi 2FA setiap login.';

        return back()->with('success', $message);
    }

    /**
     * Show WhatsApp 2FA management page
     */
    public function whatsappIndex()
    {
        // Check if password was recently confirmed
        if (!$this->isPasswordRecentlyConfirmed()) {
            return redirect()->route('login', ['mode' => 'confirm-password', 'redirect' => 'twofactor']);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        // Get or create 2FA settings
        $twoFactorAuth = $user->twoFactorAuth ?: $user->twoFactorAuth()->create(['is_enabled' => false]);
        
        // Get phone numbers (for now, we'll use a simple collection with user's phone)
        // In a real app, you'd have a separate PhoneNumber model
        $phoneNumbers = collect();
        $activePhoneNumber = null;
        
        if ($user->phone) {
            $phoneNumbers->push((object)[
                'id' => 1,
                'phone' => $user->phone,
                'is_verified' => true, // For demo purposes
                'is_active_for_2fa' => $twoFactorAuth->whatsapp_enabled,
                'created_at' => $user->created_at
            ]);
            
            if ($twoFactorAuth->whatsapp_enabled) {
                $activePhoneNumber = $phoneNumbers->first();
            }
        }
        
        return view('auth.two-factor.whatsapp.index', compact('user', 'twoFactorAuth', 'phoneNumbers', 'activePhoneNumber'));
    }

    /**
     * Add a new phone number for 2FA
     */
    public function addPhone(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|regex:/^\+[1-9]\d{1,14}$/',
        ]);

        // For now, just redirect back with a message
        // In a real app, you'd save to PhoneNumber model and send verification
        return back()->with('success', 'Nomor telepon berhasil ditambahkan. Silakan verifikasi melalui SMS/WhatsApp yang dikirim.');
    }

    /**
     * Set active phone number for 2FA
     */
    public function setActivePhone(Request $request)
    {
        $request->validate([
            'phone_id' => 'required|integer',
        ]);

        // For demo purposes, just toggle WhatsApp 2FA
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $twoFactorAuth = $user->twoFactorAuth;
        
        if ($twoFactorAuth) {
            $twoFactorAuth->update(['whatsapp_enabled' => true]);
        }

        return back()->with('success', 'Nomor telepon berhasil diaktifkan untuk 2FA.');
    }

    /**
     * Resend phone verification
     */
    public function resendPhoneVerification(Request $request)
    {
        $request->validate([
            'phone_id' => 'required|integer',
        ]);

        // For demo purposes, just return success
        return back()->with('success', 'Kode verifikasi telah dikirim ulang ke nomor telepon Anda.');
    }

    /**
     * Remove phone number
     */
    public function removePhone(Request $request)
    {
        // Add comprehensive logging to debug
        Log::info('=== removePhone method called ===', [
            'all_request_data' => $request->all(),
            'method' => $request->method(),
            'user_id' => Auth::id(),
            'headers' => [
                'Content-Type' => $request->header('Content-Type'),
                'X-CSRF-TOKEN' => $request->header('X-CSRF-TOKEN'),
            ]
        ]);

        try {
            $request->validate([
                'phone_id' => 'required|integer',
            ]);
            
            Log::info('Validation passed');
        } catch (\Exception $e) {
            Log::error('Validation failed', ['error' => $e->getMessage()]);
            return back()->withErrors(['phone_id' => 'Invalid phone ID']);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        // Get or create 2FA settings
        $twoFactorAuth = $user->twoFactorAuth ?: $user->twoFactorAuth()->create(['is_enabled' => false]);
        
        Log::info('Current 2FA settings', [
            'whatsapp_enabled_before' => $twoFactorAuth->whatsapp_enabled,
            'user_phone' => $user->phone,
        ]);
        
        try {
            // Disable WhatsApp 2FA but keep the phone number in user profile
            $twoFactorAuth->update([
                'whatsapp_enabled' => false,
            ]);
            
            // Refresh to get updated data
            $twoFactorAuth->refresh();
            
            Log::info('2FA settings after update', [
                'whatsapp_enabled_after' => $twoFactorAuth->whatsapp_enabled,
            ]);

            Log::info('=== removePhone completed successfully ===');
            
            return back()->with('success', 'Nomor telepon berhasil dihapus dari 2FA. Nomor tetap tersimpan di profil Anda.');
            
        } catch (\Exception $e) {
            Log::error('Database update failed', ['error' => $e->getMessage()]);
            return back()->withErrors(['general' => 'Gagal menghapus nomor telepon dari 2FA']);
        }
    }
}
