<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Helpers\SecurityHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class SecureLoginController extends Controller
{
    /**
     * Handle login request with enhanced security
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // Check if account is locked
        if ($this->isAccountLocked($request)) {
            return $this->handleLockedAccount($request);
        }

        // Attempt authentication
        if ($this->attemptLogin($request)) {
            return $this->handleSuccessfulLogin($request);
        }

        // Handle failed login
        return $this->handleFailedLogin($request);
    }

    /**
     * Validate login request
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'login' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
            'redirect' => ['nullable', 'string', 'max:500'],
        ]);
    }

    /**
     * Check if account is locked
     */
    protected function isAccountLocked(Request $request): bool
    {
        $identifier = $request->input('login');
        $lockKey = "account_locked:" . hash('sha256', $identifier);
        
        return cache()->has($lockKey);
    }

    /**
     * Handle locked account
     */
    protected function handleLockedAccount(Request $request)
    {
        $identifier = $request->input('login');
        $lockKey = "account_locked:" . hash('sha256', $identifier);
        $lockedUntil = cache()->get($lockKey . '_until', now()->addMinutes(30));
        
        session(['locked_identifier' => $identifier]);
        
        return redirect()->route('login', ['mode' => 'locked'])
            ->withErrors([
                'login' => 'Akun Anda sementara dikunci karena terlalu banyak percobaan login yang gagal. Silakan coba lagi dalam ' . 
                          $lockedUntil->diffForHumans() . '.'
            ]);
    }

    /**
     * Attempt to log the user in
     */
    protected function attemptLogin(Request $request): bool
    {
        $credentials = $this->getCredentials($request);
        
        return Auth::attempt(
            $credentials,
            $request->boolean('remember')
        );
    }

    /**
     * Get login credentials from request
     */
    protected function getCredentials(Request $request): array
    {
        $login = $request->input('login');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
        return [
            $field => $login,
            'password' => $request->input('password'),
        ];
    }

    /**
     * Handle successful login
     */
    protected function handleSuccessfulLogin(Request $request)
    {
        $request->session()->regenerate();
        
        // Clear any lockout data
        $this->clearAccountLockout($request);
        
        // Log successful login
        logger()->channel('security')->info('Successful login', [
            'user_id' => Auth::id(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
        
        // Get safe redirect URL
        $redirectUrl = SecurityHelper::sanitizeRedirectTarget($request, '/dashboard');
        
        return redirect()->intended($redirectUrl);
    }

    /**
     * Handle failed login attempt
     */
    protected function handleFailedLogin(Request $request)
    {
        // Log failed attempt
        logger()->channel('security')->warning('Failed login attempt', [
            'login' => $request->input('login'),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
        
        // Generic error message to prevent user enumeration
        throw ValidationException::withMessages([
            'login' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ]);
    }

    /**
     * Clear account lockout data
     */
    protected function clearAccountLockout(Request $request): void
    {
        $identifier = $request->input('login');
        $lockKey = "account_locked:" . hash('sha256', $identifier);
        $violationKey = "account_violations:" . hash('sha256', $identifier);
        
        cache()->forget($lockKey);
        cache()->forget($lockKey . '_until');
        cache()->forget($violationKey);
        
        session()->forget('locked_identifier');
    }

    /**
     * Handle 2FA PIN verification
     */
    public function verify2FA(Request $request)
    {
        $request->validate([
            'pin' => ['required', 'string', 'size:6', 'regex:/^[0-9]{6}$/'],
            'trust_device' => ['nullable', 'boolean'],
        ]);

        $userId = session('2fa_user_id');
        if (!$userId) {
            return redirect()->route('login')->withErrors([
                'pin' => 'Sesi verifikasi telah kedaluwarsa. Silakan login kembali.'
            ]);
        }

        $user = \App\Models\User::find($userId);
        if (!$user) {
            return redirect()->route('login')->withErrors([
                'pin' => 'Pengguna tidak ditemukan. Silakan login kembali.'
            ]);
        }

        // Verify PIN
        if (!$user->twoFactorAuth->verifyPin($request->input('pin'))) {
            logger()->channel('security')->warning('Failed 2FA attempt', [
                'user_id' => $userId,
                'ip' => $request->ip(),
            ]);

            return back()->withErrors([
                'pin' => 'PIN yang dimasukkan tidak valid. Silakan coba lagi.'
            ]);
        }

        // Log successful 2FA
        logger()->channel('security')->info('Successful 2FA verification', [
            'user_id' => $userId,
            'ip' => $request->ip(),
        ]);

        // Handle device trust
        if ($request->boolean('trust_device')) {
            $this->trustDevice($request, $user);
        }

        // Complete login
        Auth::login($user, session('remember_login', false));
        session()->forget(['2fa_user_id', 'remember_login']);
        $request->session()->regenerate();

        $redirectUrl = SecurityHelper::sanitizeRedirectTarget($request, '/dashboard');
        return redirect($redirectUrl);
    }

    /**
     * Handle recovery code verification
     */
    public function verifyRecovery(Request $request)
    {
        $request->validate([
            'recovery_code' => ['required', 'string', 'size:8', 'alpha_num'],
        ]);

        $userId = session('2fa_user_id');
        if (!$userId) {
            return redirect()->route('login')->withErrors([
                'recovery_code' => 'Sesi verifikasi telah kedaluwarsa. Silakan login kembali.'
            ]);
        }

        $user = \App\Models\User::find($userId);
        if (!$user || !$user->twoFactorAuth) {
            return redirect()->route('login')->withErrors([
                'recovery_code' => 'Pengguna tidak ditemukan. Silakan login kembali.'
            ]);
        }

        // Verify recovery code
        if (!$user->twoFactorAuth->verifyRecoveryCode($request->input('recovery_code'))) {
            logger()->channel('security')->warning('Failed recovery code attempt', [
                'user_id' => $userId,
                'ip' => $request->ip(),
            ]);

            return back()->withErrors([
                'recovery_code' => 'Kode pemulihan tidak valid. Pastikan Anda memasukkan kode yang benar.'
            ]);
        }

        // Log successful recovery
        logger()->channel('security')->info('Successful recovery code verification', [
            'user_id' => $userId,
            'ip' => $request->ip(),
        ]);

        // Complete login
        Auth::login($user, session('remember_login', false));
        session()->forget(['2fa_user_id', 'remember_login']);
        $request->session()->regenerate();

        $redirectUrl = SecurityHelper::sanitizeRedirectTarget($request, '/dashboard');
        return redirect($redirectUrl);
    }

    /**
     * Trust current device for 2FA
     */
    protected function trustDevice(Request $request, $user): void
    {
        $deviceKey = hash('sha256', $request->ip() . $request->userAgent());
        
        cache()->put(
            "trusted_device_{$user->id}_{$deviceKey}",
            true,
            now()->addDays(30)
        );

        logger()->channel('security')->info('Device trusted for 2FA', [
            'user_id' => $user->id,
            'device_key' => $deviceKey,
            'ip' => $request->ip(),
        ]);
    }

    /**
     * Check if current device is trusted
     */
    public function isDeviceTrusted(Request $request, $user): bool
    {
        $deviceKey = hash('sha256', $request->ip() . $request->userAgent());
        
        return cache()->has("trusted_device_{$user->id}_{$deviceKey}");
    }
}
