<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class SSOController extends Controller
{
    /**
     * Login endpoint untuk aplikasi Centrova Retail
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'app_source' => 'required|string'
        ]);

        $email = $request->email;
        $password = $request->password;
        $appSource = $request->app_source;

        // Cari user berdasarkan email
        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password tidak valid'
            ], 401);
        }

        // Check if user is active
        if (!is_null($user->status) && $user->status !== 'active') {
            return response()->json([
                'success' => false,
                'message' => 'Akun Anda telah disuspend. Silakan hubungi administrator.'
            ], 403);
        }

        // Generate SSO token
        $ssoToken = $this->generateSSOToken($user->id, $appSource);

        // Update last login
        $user->update(['last_login_at' => now()]);

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username,
                    'email' => $user->email,
                    'role' => $user->role ?? 'customer'
                ],
                'sso_token' => $ssoToken,
                'expires_at' => Carbon::now()->addDays(30)->toISOString()
            ]
        ]);
    }

    /**
     * Verify SSO token
     */
    public function verifyToken(Request $request)
    {
        $request->validate([
            'sso_token' => 'required|string'
        ]);

        $token = $request->sso_token;
        
        $ssoSession = DB::table('sso_sessions')
            ->where('token', $token)
            ->where('expires_at', '>', now())
            ->where('is_active', true)
            ->first();

        if (!$ssoSession) {
            return response()->json([
                'success' => false,
                'message' => 'Token tidak valid atau sudah expired'
            ], 401);
        }

        $user = User::find($ssoSession->user_id);
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        // Update last activity
        DB::table('sso_sessions')
            ->where('token', $token)
            ->update(['last_activity' => now()]);

        return response()->json([
            'success' => true,
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username,
                    'email' => $user->email,
                    'role' => $user->role ?? 'customer'
                ]
            ]
        ]);
    }

    /**
     * Auto login untuk website dari aplikasi
     */
    public function autoLogin(Request $request)
    {
        $request->validate([
            'sso_token' => 'required|string'
        ]);

        $token = $request->sso_token;
        
        $ssoSession = DB::table('sso_sessions')
            ->where('token', $token)
            ->where('expires_at', '>', now())
            ->where('is_active', true)
            ->first();

        if (!$ssoSession) {
            return redirect()->route('login')->withErrors([
                'login' => 'Session expired. Silakan login kembali.'
            ]);
        }

        $user = User::find($ssoSession->user_id);
        
        if (!$user) {
            return redirect()->route('login')->withErrors([
                'login' => 'User tidak ditemukan.'
            ]);
        }

        // Login user ke website
        Auth::login($user, true);

        // Update last activity
        DB::table('sso_sessions')
            ->where('token', $token)
            ->update(['last_activity' => now()]);

        // Redirect based on user role
        if (!is_null($user->role) && $user->role !== 'customer') {
            return redirect()->route('staff.dashboard');
        } else {
            return redirect()->route('account');
        }
    }

    /**
     * Logout dari semua platform
     */
    public function logout(Request $request)
    {
        $request->validate([
            'sso_token' => 'required|string'
        ]);

        $token = $request->sso_token;

        // Deactivate SSO session
        DB::table('sso_sessions')
            ->where('token', $token)
            ->update(['is_active' => false]);

        // Logout dari website jika ada session
        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil dari semua platform'
        ]);
    }

    /**
     * Generate SSO Token
     */
    private function generateSSOToken($userId, $appSource)
    {
        $token = bin2hex(random_bytes(32));
        $expiresAt = Carbon::now()->addDays(30);

        // Deactivate existing tokens for this user and app
        DB::table('sso_sessions')
            ->where('user_id', $userId)
            ->where('app_source', $appSource)
            ->update(['is_active' => false]);

        // Create new SSO session
        DB::table('sso_sessions')->insert([
            'user_id' => $userId,
            'token' => $token,
            'app_source' => $appSource,
            'expires_at' => $expiresAt,
            'created_at' => now(),
            'last_activity' => now(),
            'is_active' => true
        ]);

        return $token;
    }

    /**
     * Get user profile
     */
    public function profile(Request $request)
    {
        $request->validate([
            'sso_token' => 'required|string'
        ]);

        $token = $request->sso_token;
        
        $ssoSession = DB::table('sso_sessions')
            ->where('token', $token)
            ->where('expires_at', '>', now())
            ->where('is_active', true)
            ->first();

        if (!$ssoSession) {
            return response()->json([
                'success' => false,
                'message' => 'Token tidak valid atau sudah expired'
            ], 401);
        }

        $user = User::find($ssoSession->user_id);
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username,
                    'email' => $user->email,
                    'role' => $user->role ?? 'customer',
                    'profile_picture' => $user->profile_picture,
                    'created_at' => $user->created_at,
                    'last_login_at' => $user->last_login_at
                ]
            ]
        ]);
    }
}
