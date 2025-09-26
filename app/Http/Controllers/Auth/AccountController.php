<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\DetectsFallbackRoute;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Device;
use App\Models\Subscription;
use App\Models\TrustedDevice;
use App\Services\LoginActivityService;
use App\Services\MultiAccountService;
use App\Services\SecurityScoreService;
use App\Services\RealTimeDeviceService;
use App\Services\AccountDataCacheService;
use App\Services\FailedLoginService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AccountController extends Controller
{
    use DetectsFallbackRoute;
    protected LoginActivityService $loginActivityService;
    protected MultiAccountService $multiAccountService;
    protected SecurityScoreService $securityScoreService;
    protected RealTimeDeviceService $realTimeDeviceService;
    protected AccountDataCacheService $cacheService;
    protected FailedLoginService $failedLoginService;

    public function __construct(
        LoginActivityService $loginActivityService, 
        MultiAccountService $multiAccountService,
        SecurityScoreService $securityScoreService,
        RealTimeDeviceService $realTimeDeviceService,
        AccountDataCacheService $cacheService,
        FailedLoginService $failedLoginService
    ) {
        $this->loginActivityService = $loginActivityService;
        $this->multiAccountService = $multiAccountService;
        $this->securityScoreService = $securityScoreService;
        $this->realTimeDeviceService = $realTimeDeviceService;
        $this->cacheService = $cacheService;
        $this->failedLoginService = $failedLoginService;
    }

    public function loginView(Request $request)
    {
        $mode = $request->get('mode', 'login');
        $redirect = $request->get('redirect');
        
        // If user is already authenticated and not in special modes, redirect to dashboard
        if (Auth::check() && !in_array($mode, ['confirm-password', 'add-different-account'])) {
            return redirect()->route('account');
        }
        
        // For confirm-password mode, user must be authenticated
        if ($mode === 'confirm-password' && !Auth::check()) {
            return redirect()->route('login')->withErrors([
                'error' => 'Sesi Anda telah berakhir. Silakan login kembali.'
            ]);
        }
        
        // For add-different-account mode, user must be authenticated
        if ($mode === 'add-different-account' && !Auth::check()) {
            return redirect()->route('login')->withErrors([
                'error' => 'Sesi Anda telah berakhir. Silakan login kembali.'
            ]);
        }
        
        return view('auth.login', compact('mode', 'redirect'));
    }

    public function registerView()
    {
        return view('auth.register');
    }
    
    public function login(Request $request)
    {
        $mode = $request->get('mode', 'login');
        $redirect = $request->get('redirect');
        
        // Handle password confirmation mode
        if ($mode === 'confirm-password') {
            return $this->handlePasswordConfirmation($request, $redirect);
        }
        
        // Handle add different account mode
        if ($mode === 'add-different-account') {
            return $this->handleAddDifferentAccount($request);
        }
        
        // Handle regular login
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ], [
            'login.required' => 'Nama pengguna atau email harus diisi',
            'password.required' => 'Kata sandi harus diisi',
        ]);

        $loginInput = $request->input('login');
        
        // Check if login should be blocked due to too many failed attempts
        $blockInfo = $this->failedLoginService->shouldBlockLogin($request, $loginInput);
        if ($blockInfo['locked']) {
            $unlockTimeMessage = $this->failedLoginService->getUnlockTimeMessage($blockInfo['unlock_time']);
            return redirect()->route(\App\Helpers\RouteHelper::getContextRoute('login', 'account.fallback.login'), ['mode' => 'locked'])
                ->with('lockout_message', $unlockTimeMessage)
                ->with('attempts_count', $blockInfo['attempts_count'])
                ->with('locked_identifier', $loginInput);
        }

        $loginField = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = [
            $loginField => $loginInput,
            'password' => $request->input('password')
        ];

        Log::info('Login attempt', [
            'login_field' => $loginField,
            'value' => $loginInput,
            'credentials_key' => $loginField
        ]);

        // Check if this might be a suspicious login attempt
        $user = User::where($loginField, $loginInput)->first();
        $isSuspicious = false;
        
        if ($user) {
            // Check if user is active
            $userStatus = $user->status;
            if (!is_null($userStatus) && $userStatus !== 'active') {
                // Store user email in session for download functionality
                session(['suspended_user_email' => $user->email]);
                
                // Update suspended_at timestamp if not already set
                if (!$user->suspended_at && $user->status === 'suspended') {
                    $user->update([
                        'suspended_at' => now(),
                        'suspension_reason' => $user->suspension_reason ?? 'Aktivitas yang melanggar ketentuan penggunaan atau berisiko terhadap keamanan akun'
                    ]);
                }
                
                // Redirect to suspension page instead of showing error
                return redirect()->route(\App\Helpers\RouteHelper::getContextRoute('login', 'account.fallback.login'), ['mode' => 'suspended']);
            }
            
        }

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            // Get the authenticated user
            $authenticatedUser = Auth::user();
            
            // Clear failed login attempts on successful login
            $this->failedLoginService->clearFailedAttempts($loginInput);
            
            // Debug 2FA status
            Log::info('Login attempt', [
                'user_id' => $authenticatedUser->id,
                'email' => $authenticatedUser->email,
                'has_2fa_record' => $authenticatedUser->twoFactorAuth !== null,
                'is_2fa_enabled' => $authenticatedUser->twoFactorAuth ? $authenticatedUser->twoFactorAuth->is_enabled : false,
                'require_every_login' => $authenticatedUser->twoFactorAuth ? $authenticatedUser->twoFactorAuth->require_2fa_every_login : false,
            ]);
            
            // Check if user has 2FA enabled
            $hasTwoFactor = $authenticatedUser->twoFactorAuth && $authenticatedUser->twoFactorAuth->is_enabled;
            
            if ($hasTwoFactor) {
                $twoFactorAuth = $authenticatedUser->twoFactorAuth;
                
                // Check if user requires 2FA on every login (no device trust)
                $requiresEveryLogin = $twoFactorAuth && !$twoFactorAuth->allowsDeviceTrust();
                
                // If requires every login OR device is not trusted, require 2FA
                $deviceFingerprint = TrustedDevice::generateFingerprint($request);
                $isDeviceTrusted = !$requiresEveryLogin && TrustedDevice::isTrusted($authenticatedUser->id, $deviceFingerprint);
                
                if (!$isDeviceTrusted) {
                    // Device not trusted or user requires 2FA every login, require verification
                    Auth::logout(); // Logout temporarily
                    $request->session()->put('2fa_user_id', $authenticatedUser->id);
                    
                    // Check if user prefers WhatsApp 2FA and has phone number
                    if ($twoFactorAuth && $twoFactorAuth->prefersWhatsApp() && !empty($authenticatedUser->phone)) {
                        return redirect()->route('login', ['mode' => '2fa-whatsapp']);
                    } else {
                        return redirect()->route('login', ['mode' => '2fa-verify']);
                    }
                }
                
                // Device is trusted, update last used
                $trustedDevice = TrustedDevice::where('user_id', $authenticatedUser->id)
                    ->where('device_fingerprint', $deviceFingerprint)
                    ->where('is_active', true)
                    ->first();
                    
                if ($trustedDevice) {
                    $trustedDevice->updateLastUsed();
                }
            }
            
            // Update last login time
            User::where('id', $authenticatedUser->id)->update(['last_login_at' => now()]);
            
            // Add user to multi-account session
            $this->multiAccountService->addAccount($authenticatedUser, true);
            
            // Log successful login activity
            $this->loginActivityService->logActivity(
                Auth::id(),
                $request,
                'success',
                null,
                $isSuspicious
            );
            
            Log::info('User authenticated successfully', [
                'user_id' => Auth::id(),
                'user_name' => Auth::user()->name,
                'user_role' => Auth::user()->role ?? 'customer',
                'session_id' => session()->getId(),
                'is_suspicious' => $isSuspicious
            ]);

            // Redirect based on user role and detect if using fallback route
            $userRole = $authenticatedUser->role;
            
            if (!is_null($userRole) && $userRole !== 'customer') {
                return redirect()->intended(route('staff.dashboard'));
            } else {
                // Use trait method to redirect to appropriate account route
                return $this->redirectToContext($request, 'account', 'account.fallback.index');
            }
        }

        // Log failed login attempt
        if ($user) {
            $this->loginActivityService->logActivity(
                $user->id,
                $request,
                'failed',
                'Invalid credentials',
                $isSuspicious
            );
        }

        // Record failed login attempt
        $this->failedLoginService->recordFailedAttempt($request, $loginInput, 'login');

        Log::error('Login failed - credentials do not match', [
            'login_field' => $loginField,
            'value' => $loginInput,
            'user_exists' => \App\Models\User::where($loginField, $loginInput)->exists()
        ]);

        return back()->withErrors([
            'login' => 'Username/email atau password yang Anda masukkan tidak sesuai dengan data kami.',
        ])->onlyInput('login');
    }

    /**
     * Handle 2FA PIN verification from login page
     */
    public function verify2FAPin(Request $request)
    {
        // Combine PIN from separate inputs if needed
        if (!$request->has('pin') && $request->has('pin_1')) {
            $pin = $request->pin_1 . $request->pin_2 . $request->pin_3 . 
                   $request->pin_4 . $request->pin_5 . $request->pin_6;
            $request->merge(['pin' => $pin]);
        }

        $validator = Validator::make($request->all(), [
            'pin' => 'required|digits:6',
            'trust_device' => 'sometimes|boolean',
        ], [
            'pin.required' => 'PIN harus diisi',
            'pin.digits' => 'PIN harus terdiri dari 6 angka',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login', ['mode' => '2fa-verify'])->withErrors($validator)->withInput();
        }

        $userId = session('2fa_user_id');
        if (!$userId) {
            return redirect()->route('login')->withErrors(['error' => 'Session tidak valid']);
        }

        $user = User::findOrFail($userId);
        
        // Check if login should be blocked due to too many failed attempts
        $blockInfo = $this->failedLoginService->shouldBlock2FA($request, $userId);
        if ($blockInfo['locked']) {
            // Clear 2FA session and redirect to locked page
            session()->forget('2fa_user_id');
            
            $unlockTimeMessage = $this->failedLoginService->getUnlockTimeMessage($blockInfo['unlock_time']);
            return redirect()->route(\App\Helpers\RouteHelper::getContextRoute('login', 'account.fallback.login'), ['mode' => 'locked'])
                ->with('lockout_message', $unlockTimeMessage)
                ->with('attempts_count', $blockInfo['attempts_count'])
                ->with('auto_logout', true);
        }
        
        $twoFactorAuth = $user->twoFactorAuth;

        if (!$twoFactorAuth || !$twoFactorAuth->is_enabled) {
            return redirect()->route('login')->withErrors(['error' => 'Autentikasi 2 faktor tidak aktif']);
        }

        // Check if login should be blocked due to too many failed attempts
        $blockInfo = $this->failedLoginService->shouldBlock2FA($request, $userId);
        if ($blockInfo['locked']) {
            // Clear 2FA session and redirect to locked page
            session()->forget('2fa_user_id');
            
            $unlockTimeMessage = $this->failedLoginService->getUnlockTimeMessage($blockInfo['unlock_time']);
            return redirect()->route(\App\Helpers\RouteHelper::getContextRoute('login', 'account.fallback.login'), ['mode' => 'locked'])
                ->with('lockout_message', $unlockTimeMessage)
                ->with('attempts_count', $blockInfo['attempts_count'])
                ->with('auto_logout', true)
                ->with('locked_identifier', $user->email);
        }

        // Check if account is locked
        if ($twoFactorAuth->isLocked()) {
            $lockTime = $twoFactorAuth->locked_until->diffForHumans();
            return redirect()->route('login', ['mode' => '2fa-verify'])
                ->withErrors(['pin' => "Akun terkunci karena terlalu banyak percobaan gagal. Coba lagi {$lockTime}."]);
        }

        // Verify PIN
        if (!$twoFactorAuth->verifyPin($request->pin)) {
            \App\Models\TwoFactorAuthLog::logAction($user->id, 'pin_failed', ['action' => 'login_verification']);
            
            // Record failed 2FA attempt
            $this->failedLoginService->recordFailed2FA($request, $userId, '2fa-verify');
            
            // Check if this attempt caused a lockout
            $blockInfo = $this->failedLoginService->shouldBlock2FA($request, $userId);
            if ($blockInfo['locked']) {
                // Clear 2FA session and redirect to locked page
                session()->forget('2fa_user_id');
                
                $unlockTimeMessage = $this->failedLoginService->getUnlockTimeMessage($blockInfo['unlock_time']);
                return redirect()->route(\App\Helpers\RouteHelper::getContextRoute('login', 'account.fallback.login'), ['mode' => 'locked'])
                    ->with('lockout_message', $unlockTimeMessage)
                    ->with('attempts_count', $blockInfo['attempts_count'])
                    ->with('auto_logout', true)
                    ->with('locked_identifier', $user->email);
            }
            
            return redirect()->route('login', ['mode' => '2fa-verify'])
                ->withErrors(['pin' => 'PIN salah'])->withInput();
        }

        // PIN verified successfully
        \App\Models\TwoFactorAuthLog::logAction($user->id, 'pin_verified', ['action' => 'login_verification']);

        // Clear failed login attempts on successful 2FA
        $this->failedLoginService->clearFailed2FA($userId);

        // Trust device if requested AND user allows device trust
        if ($request->trust_device && $twoFactorAuth->allowsDeviceTrust()) {
            $this->trustCurrentDevice($user, $request);
        }

        // Complete login
        Auth::login($user);
        session()->forget('2fa_user_id');

        // Update last login time
        User::where('id', $user->id)->update(['last_login_at' => now()]);

        // Add user to multi-account session
        $this->multiAccountService->addAccount($user, true);

        // Log successful login activity
        $this->loginActivityService->logActivity(
            $user->id,
            $request,
            'success',
            '2FA PIN verification successful'
        );

        // Redirect based on user role
        $userRole = $user->role;
        if (!is_null($userRole) && $userRole !== 'customer') {
            return redirect()->intended(route('staff.dashboard'));
        } else {
            return $this->redirectToContext($request, 'account', 'account.fallback.index');
        }
    }

    /**
     * Handle 2FA WhatsApp OTP verification from login page
     */
    public function verify2FAWhatsApp(Request $request)
    {
        // Combine OTP from separate inputs if needed
        if (!$request->has('otp_code') && $request->has('otp_1')) {
            $otp = $request->otp_1 . $request->otp_2 . $request->otp_3 . 
                   $request->otp_4 . $request->otp_5 . $request->otp_6;
            $request->merge(['otp_code' => $otp]);
        }

        $validator = Validator::make($request->all(), [
            'otp_code' => 'required|digits:6',
            'trust_device' => 'sometimes|boolean',
        ], [
            'otp_code.required' => 'Kode OTP harus diisi',
            'otp_code.digits' => 'Kode OTP harus terdiri dari 6 angka',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login', ['mode' => '2fa-whatsapp'])->withErrors($validator)->withInput();
        }

        $userId = session('2fa_user_id');
        if (!$userId) {
            return redirect()->route('login')->withErrors(['error' => 'Session tidak valid']);
        }

        $user = User::findOrFail($userId);

        // Check if login should be blocked due to too many failed attempts
        $blockInfo = $this->failedLoginService->shouldBlock2FA($request, $userId);
        if ($blockInfo['locked']) {
            // Clear 2FA session and redirect to locked page
            session()->forget('2fa_user_id');
            
            $unlockTimeMessage = $this->failedLoginService->getUnlockTimeMessage($blockInfo['unlock_time']);
            return redirect()->route(\App\Helpers\RouteHelper::getContextRoute('login', 'account.fallback.login'), ['mode' => 'locked'])
                ->with('lockout_message', $unlockTimeMessage)
                ->with('attempts_count', $blockInfo['attempts_count'])
                ->with('auto_logout', true)
                ->with('locked_identifier', $user->email);
        }

        // Use WhatsApp OTP service to verify
        $whatsappOtpService = app(\App\Services\WhatsAppOtpService::class);
        $result = $whatsappOtpService->verifyOtp($user, $request->otp_code);

        if (!$result['success']) {
            \App\Models\TwoFactorAuthLog::logAction($user->id, 'whatsapp_otp_failed');
            
            // Record failed 2FA attempt
            $this->failedLoginService->recordFailed2FA($request, $userId, '2fa-whatsapp');
            
            // Check if this attempt caused a lockout
            $blockInfo = $this->failedLoginService->shouldBlock2FA($request, $userId);
            if ($blockInfo['locked']) {
                // Clear 2FA session and redirect to locked page
                session()->forget('2fa_user_id');
                
                $unlockTimeMessage = $this->failedLoginService->getUnlockTimeMessage($blockInfo['unlock_time']);
                return redirect()->route(\App\Helpers\RouteHelper::getContextRoute('login', 'account.fallback.login'), ['mode' => 'locked'])
                    ->with('lockout_message', $unlockTimeMessage)
                    ->with('attempts_count', $blockInfo['attempts_count'])
                    ->with('auto_logout', true)
                    ->with('locked_identifier', $user->email);
            }
            
            return redirect()->route('login', ['mode' => '2fa-whatsapp'])
                ->withErrors(['otp_code' => $result['message']])->withInput();
        }

        // OTP verified successfully
        \App\Models\TwoFactorAuthLog::logAction($user->id, 'whatsapp_otp_verified');

        // Clear failed login attempts on successful 2FA
        $this->failedLoginService->clearFailed2FA($userId);

        // Trust device if requested AND user allows device trust
        if ($request->trust_device && $user->twoFactorAuth->allowsDeviceTrust()) {
            $this->trustCurrentDevice($user, $request);
        }

        // Complete login
        Auth::login($user);
        session()->forget('2fa_user_id');

        // Update last login time
        User::where('id', $user->id)->update(['last_login_at' => now()]);

        // Add user to multi-account session
        $this->multiAccountService->addAccount($user, true);

        // Log successful login activity
        $this->loginActivityService->logActivity(
            $user->id,
            $request,
            'success',
            '2FA WhatsApp verification successful'
        );

        // Redirect based on user role
        $userRole = $user->role;
        if (!is_null($userRole) && $userRole !== 'customer') {
            return redirect()->intended(route('staff.dashboard'));
        } else {
            return $this->redirectToContext($request, 'account', 'account.fallback.index');
        }
    }

    /**
     * Handle 2FA recovery code verification from login page
     */
    public function verify2FARecovery(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'recovery_code' => 'required|string|size:8',
        ], [
            'recovery_code.required' => 'Kode pemulihan harus diisi',
            'recovery_code.size' => 'Kode pemulihan harus terdiri dari 8 karakter',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login', ['mode' => '2fa-verify'])->withErrors($validator);
        }

        $userId = session('2fa_user_id');
        if (!$userId) {
            return redirect()->route('login');
        }

        $user = User::findOrFail($userId);
        $twoFactorAuth = $user->twoFactorAuth;

        if (!$twoFactorAuth || !$twoFactorAuth->is_enabled) {
            return redirect()->route('login');
        }

        // Check if login should be blocked due to too many failed attempts
        $blockInfo = $this->failedLoginService->shouldBlock2FA($request, $userId);
        if ($blockInfo['locked']) {
            // Clear 2FA session and redirect to locked page
            session()->forget('2fa_user_id');
            
            $unlockTimeMessage = $this->failedLoginService->getUnlockTimeMessage($blockInfo['unlock_time']);
            return redirect()->route(\App\Helpers\RouteHelper::getContextRoute('login', 'account.fallback.login'), ['mode' => 'locked'])
                ->with('lockout_message', $unlockTimeMessage)
                ->with('attempts_count', $blockInfo['attempts_count'])
                ->with('auto_logout', true)
                ->with('locked_identifier', $user->email);
        }

        // Verify recovery code
        if (!$twoFactorAuth->verifyRecoveryCode($request->recovery_code)) {
            \App\Models\TwoFactorAuthLog::logAction($user->id, 'recovery_failed', ['action' => 'login_verification']);
            
            // Record failed 2FA attempt
            $this->failedLoginService->recordFailed2FA($request, $userId, '2fa-recovery');
            
            // Check if this attempt caused a lockout
            $blockInfo = $this->failedLoginService->shouldBlock2FA($request, $userId);
            if ($blockInfo['locked']) {
                // Clear 2FA session and redirect to locked page
                session()->forget('2fa_user_id');
                
                $unlockTimeMessage = $this->failedLoginService->getUnlockTimeMessage($blockInfo['unlock_time']);
                return redirect()->route(\App\Helpers\RouteHelper::getContextRoute('login', 'account.fallback.login'), ['mode' => 'locked'])
                    ->with('lockout_message', $unlockTimeMessage)
                    ->with('attempts_count', $blockInfo['attempts_count'])
                    ->with('auto_logout', true)
                    ->with('locked_identifier', $user->email);
            }
            
            return redirect()->route('login', ['mode' => '2fa-verify'])
                ->withErrors(['recovery_code' => 'Kode pemulihan tidak valid']);
        }

        // Recovery code verified successfully
        \App\Models\TwoFactorAuthLog::logAction($user->id, 'recovery_verified', ['action' => 'login_verification']);

        // Clear failed login attempts on successful 2FA
        $this->failedLoginService->clearFailed2FA($userId);

        // Complete login
        Auth::login($user);
        session()->forget('2fa_user_id');

        // Update last login time
        User::where('id', $user->id)->update(['last_login_at' => now()]);

        // Add user to multi-account session
        $this->multiAccountService->addAccount($user, true);

        // Log successful login activity
        $this->loginActivityService->logActivity(
            $user->id,
            $request,
            'success',
            '2FA recovery code verification successful'
        );

        // Redirect based on user role
        $userRole = $user->role;
        if (!is_null($userRole) && $userRole !== 'customer') {
            return redirect()->intended(route('staff.dashboard'));
        } else {
            return $this->redirectToContext($request, 'account', 'account.fallback.index');
        }
    }

    /**
     * Trust current device
     */
    protected function trustCurrentDevice($user, $request)
    {
        $deviceFingerprint = TrustedDevice::generateFingerprint($request);
        $deviceInfo = TrustedDevice::parseUserAgent($request->header('User-Agent'));

        $trustedDevice = TrustedDevice::create([
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

        \App\Models\TwoFactorAuthLog::logAction($user->id, 'device_trusted', ['device_id' => $trustedDevice->id]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => ['required', 'string', 'min:8', 'confirmed', Password::defaults()],
        ], [
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Nama maksimal 100 karakter',
            'username.required' => 'Username harus diisi',
            'username.max' => 'Username maksimal 50 karakter',
            'username.unique' => 'Username sudah digunakan',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.max' => 'Email maksimal 100 karakter',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Kata sandi harus diisi',
            'password.min' => 'Kata sandi minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        // Log successful registration and first login
        $this->loginActivityService->logActivity(
            $user->id,
            $request,
            'success',
            'Account registration and first login',
            false
        );

        // Use trait method to redirect to appropriate account route
        return $this->redirectToContext($request, 'account', 'account.fallback.index');
    }

    public function logout(Request $request)
    {
        // Use multi-account service to logout all accounts
        $this->multiAccountService->logoutAll();
        
        // Use trait method to redirect to appropriate login route
        $loginRoute = $this->getRouteForContext($request, 'login', 'account.fallback.login');
        return redirect()->route($loginRoute)->with('status', 'Anda telah berhasil logout dari semua platform.');
    }

    public function profile()
    {
        $user = Auth::user();
        
        return view('auth.profile', compact('user'));
    }

    public function privacy()
    {
        return view('auth.privacy');
    }

    public function security()
    {
        return redirect()->route('security.index');
    }

    public function subscription()
    {
        return view('auth.subscription');
    }    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
        ], [
            'name.required' => 'Nama harus diisi',
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username sudah digunakan',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'phone.max' => 'Nomor telepon maksimal 20 karakter',
            'birth_date.date' => 'Format tanggal lahir tidak valid',
        ]);

        if (isset($validated['birth_date'])) {
            $validated['birth_date'] = date('Y-m-d', strtotime($validated['birth_date']));
        }

        $user = Auth::user();
        
        // Remove timestamps from Eloquent update
        User::withoutTimestamps(function () use ($user, $validated) {
            User::where('id', $user->id)->update($validated);
        });

        return back()->with('success', 'Profile berhasil diperbarui');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([            'current_password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    $fail('Password saat ini tidak sesuai.');
                }
            }],
            'password' => ['required', 'string', 'confirmed', Password::defaults()]
        ]);        $user = Auth::user();        User::withoutTimestamps(function () use ($user, $validated) {
            User::where('id', $user->id)->update([
                'password' => Hash::make($validated['password'])
            ]);
        });

        return back()->with('success', 'Password berhasil diubah');
    }

    public function updatePrivacy(Request $request)
    {
        $validated = $request->validate([
            'public_profile' => 'boolean',
            'show_online_status' => 'boolean',
            'show_activity' => 'boolean',
        ]);        $user = Auth::user();        User::withoutTimestamps(function () use ($user, $validated) {
            User::where('id', $user->id)->update([
                'privacy_settings' => array_merge($user->privacy_settings ?? [], $validated)
            ]);
        });

        return back()->with('success', 'Pengaturan privasi berhasil diperbarui');
    }

    public function updateCommunication(Request $request)
    {
        $validated = $request->validate([
            'marketing_emails' => 'boolean',
            'product_notifications' => 'boolean',
        ]);        $user = Auth::user();        User::withoutTimestamps(function () use ($user, $validated) {
            User::where('id', $user->id)->update([
                'communication_preferences' => array_merge($user->communication_preferences ?? [], $validated)
            ]);
        });

        return back()->with('success', 'Preferensi komunikasi berhasil diperbarui');
    }

    public function updateAdditionalProfile(Request $request)
    {
        $validated = $request->validate([
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
        ]);

        $user = Auth::user();
        User::where('id', $user->id)->update($validated);

        return back()->with('success', 'Informasi tambahan berhasil diperbarui');
    }

    public function account()
    {
        $user = auth()->user();
        
        // Get real-time device information using the new service
        $deviceData = $this->realTimeDeviceService->getRealTimeDevices($user);
        $devices = $deviceData['devices'];
        $deviceCount = $deviceData['stats']['total_devices'];
        
        // Get cached account overview data
        $overviewData = $this->cacheService->getAccountOverview($user);
        $subscription = $overviewData['subscription'];
        $activeOrders = $overviewData['service_orders']['active'];
        $totalOrders = $overviewData['service_orders']['total'];

        // Get recent login activities using the new service
        $recentActivities = $this->realTimeDeviceService->getRealTimeLoginActivities($user, 5);

        // Get comprehensive security score
        $securityData = $this->securityScoreService->calculateSecurityScore($user);
        $securityScore = $securityData['score'];

        return view('auth.account', compact(
            'user', 
            'deviceCount', 
            'devices', 
            'subscription',
            'activeOrders',
            'totalOrders',
            'recentActivities',
            'securityScore'
        ));
    }

    /**
     * Get real-time security score (API endpoint)
     */
    public function getSecurityScore(Request $request)
    {
        $user = auth()->user();
        $securityData = $this->securityScoreService->calculateSecurityScore($user);
        
        return response()->json([
            'success' => true,
            'data' => [
                'score' => $securityData['score'],
                'level' => $securityData['level'],
                'factors' => $securityData['factors'],
                'recommendations' => $securityData['recommendations'],
                'last_updated' => $securityData['last_calculated']->format('Y-m-d H:i:s')
            ]
        ]);
    }

    /**
     * Get real-time device data (API endpoint)
     */
    public function getDeviceData(Request $request)
    {
        $user = auth()->user();
        $deviceData = $this->realTimeDeviceService->getRealTimeDevices($user);
        
        // Convert objects back to arrays for JSON response
        $devices = $deviceData['devices']->map(function ($device) {
            return (array) $device;
        });
        
        return response()->json([
            'success' => true,
            'data' => [
                'devices' => $devices->take(10), // Limit for performance
                'stats' => $deviceData['stats'],
                'last_updated' => $deviceData['last_updated']->format('Y-m-d H:i:s')
            ]
        ]);
    }

    /**
     * Get real-time login activities (API endpoint)
     */
    public function getRecentActivities(Request $request)
    {
        $user = auth()->user();
        $limit = $request->get('limit', 10);
        $activities = $this->realTimeDeviceService->getRealTimeLoginActivities($user, $limit);
        
        // Convert objects back to arrays for JSON response
        $activitiesArray = $activities->map(function ($activity) {
            return (array) $activity;
        });
        
        return response()->json([
            'success' => true,
            'data' => [
                'activities' => $activitiesArray,
                'last_updated' => now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
    
    /**
     * Show password confirmation form for authenticated users
     */
    public function showConfirmPassword(Request $request)
    {
        $redirect = $request->get('redirect');
        return view('auth.confirm-password', compact('redirect'));
    }
    
    /**
     * Handle password confirmation for authenticated users
     */
    public function confirmPassword(Request $request)
    {
        $redirect = $request->get('redirect');
        return $this->handlePasswordConfirmation($request, $redirect);
    }
    
    /**
     * Handle password confirmation for accessing secure features
     */
    private function handlePasswordConfirmation(Request $request, $redirect = null)
    {
        $request->validate([
            'password' => 'required',
        ]);
        
        $user = Auth::user();
        
        // Check if login should be blocked due to too many failed attempts
        $blockInfo = $this->failedLoginService->shouldBlockLogin($request, $user->email);
        if ($blockInfo['locked']) {
            // Auto logout user and redirect to locked page
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            $unlockTimeMessage = $this->failedLoginService->getUnlockTimeMessage($blockInfo['unlock_time']);
            return redirect()->route(\App\Helpers\RouteHelper::getContextRoute('login', 'account.fallback.login'), ['mode' => 'locked'])
                ->with('lockout_message', $unlockTimeMessage)
                ->with('attempts_count', $blockInfo['attempts_count'])
                ->with('auto_logout', true)
                ->with('locked_identifier', $user->email);
        }
        
        // Verify current user's password
        if (!Hash::check($request->password, $user->password)) {
            // Record failed password confirmation attempt
            $this->failedLoginService->recordFailedAttempt($request, $user->email, 'confirm-password');
            
            // Check if this attempt caused a lockout
            $blockInfo = $this->failedLoginService->shouldBlockLogin($request, $user->email);
            if ($blockInfo['locked']) {
                // Auto logout user and redirect to locked page
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                $unlockTimeMessage = $this->failedLoginService->getUnlockTimeMessage($blockInfo['unlock_time']);
                return redirect()->route(\App\Helpers\RouteHelper::getContextRoute('login', 'account.fallback.login'), ['mode' => 'locked'])
                    ->with('lockout_message', $unlockTimeMessage)
                    ->with('attempts_count', $blockInfo['attempts_count'])
                    ->with('auto_logout', true)
                    ->with('locked_identifier', $user->email);
            }
            
            return back()->withErrors([
                'password' => 'Kata sandi yang Anda masukkan tidak sesuai.'
            ]);
        }
        
        // Clear failed attempts on successful password confirmation
        $this->failedLoginService->clearFailedAttempts($user->email);
        
        // Store password confirmation timestamp in session
        $request->session()->put('password_confirmed_at', time());
        
        // Redirect based on the redirect parameter
        if ($redirect) {
            // Handle predefined redirects
            switch ($redirect) {
                case 'twofactor':
                    return redirect()->route('security.two-factor.index');
                case 'twofactor-enable':
                    return redirect()->route('security.two-factor.enable.form');
                case 'twofactor-disable':
                    return redirect()->route('security.two-factor.disable.form');
                default:
                    // Handle custom URLs (for office staff password viewing)
                    if (filter_var($redirect, FILTER_VALIDATE_URL)) {
                        // Add password_confirmed parameter to the redirect URL
                        $parsedUrl = parse_url($redirect);
                        $query = [];
                        
                        if (isset($parsedUrl['query'])) {
                            parse_str($parsedUrl['query'], $query);
                        }
                        
                        $query['password_confirmed'] = 'true';
                        
                        $newUrl = $parsedUrl['scheme'] . '://' . $parsedUrl['host'];
                        if (isset($parsedUrl['port'])) {
                            $newUrl .= ':' . $parsedUrl['port'];
                        }
                        $newUrl .= $parsedUrl['path'];
                        if (!empty($query)) {
                            $newUrl .= '?' . http_build_query($query);
                        }
                        
                        return redirect($newUrl);
                    }
                    
                    // Fallback for unrecognized redirects
                    return redirect()->route('security.index');
            }
        }
        
        // Default redirect to security page
        return redirect()->route('security.index');
    }
    
    /**
     * Handle add different account login
     */
    private function handleAddDifferentAccount(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        $loginInput = $request->login;
        
        // Check if login should be blocked due to too many failed attempts
        $blockInfo = $this->failedLoginService->shouldBlockLogin($request, $loginInput);
        if ($blockInfo['locked']) {
            $unlockTimeMessage = $this->failedLoginService->getUnlockTimeMessage($blockInfo['unlock_time']);
            return redirect()->route(\App\Helpers\RouteHelper::getContextRoute('login', 'account.fallback.login'), ['mode' => 'locked'])
                ->with('lockout_message', $unlockTimeMessage)
                ->with('attempts_count', $blockInfo['attempts_count']);
        }

        // Determine login field (email or username)
        $loginField = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
        $credentials = [
            $loginField => $loginInput,
            'password' => $request->password
        ];

        try {
            $result = $this->multiAccountService->loginAdditionalAccount($credentials, false);
            
            if ($result['success']) {
                // Clear failed attempts on successful login
                $this->failedLoginService->clearFailedAttempts($loginInput);
                
                return redirect()->route('account')
                    ->with('success', $result['message']);
            } else {
                // Record failed login attempt for add different account
                $this->failedLoginService->recordFailedAttempt($request, $loginInput, 'add-different-account');
                
                return redirect()->back()
                    ->withErrors(['login' => $result['message']])
                    ->withInput();
            }
        } catch (\Exception $e) {
            // Record failed login attempt for add different account
            $this->failedLoginService->recordFailedAttempt($request, $loginInput, 'add-different-account');
            
            return redirect()->back()
                ->withErrors(['login' => 'Terjadi kesalahan saat menambah akun'])
                ->withInput();
        }
    }
}
