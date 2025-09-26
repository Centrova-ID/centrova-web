<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use App\Models\StaffUser;

class StaffAuthController extends Controller
{
    /**
     * Show the staff login form.
     */
    public function showLoginForm()
    {
        // Check if already authenticated as staff
        if (Auth::guard('staff')->check()) {
            return redirect()->route('staff.dashboard');
        }
        
        // Check if user is already authenticated via web guard and is staff
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            
            if ($user && $user->isStaff()) {
                // Try to find corresponding staff user by email
                $staff = StaffUser::where('email', $user->email)->first();
                
                if ($staff && $staff->isActive()) {
                    // Auto-login to staff guard
                    Auth::guard('staff')->login($staff, true);
                    
                    // Update last login
                    $staff->update(['last_login_at' => now()]);
                    
                    return redirect()->route('staff.dashboard');
                }
            }
        }
        
        // Use the unified login page with staff mode
        return view('auth.login', ['isStaffLogin' => true]);
    }

    /**
     * Handle staff login attempt.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Kata sandi harus diisi',
        ]);

        $credentials = $request->only('email', 'password');

        // Check if staff user exists and is active
        $staff = StaffUser::where('email', $credentials['email'])->first();
        
        if (!$staff) {
            return back()->withErrors([
                'email' => 'These credentials do not match our records.',
            ])->onlyInput('email');
        }

        if (!$staff->isActive()) {
            return redirect()->route('staff.login', ['mode' => 'suspended']);
        }

        if (Auth::guard('staff')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            // Update last login
            $staff->update(['last_login_at' => now()]);
            
            return redirect()->intended(route('staff.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Handle staff logout.
     */
    public function logout(Request $request)
    {
        Auth::guard('staff')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('staff.login');
    }

    /**
     * Show the staff password reset request form.
     */
    public function showForgotPasswordForm()
    {
        return view('staff.auth.forgot-password');
    }

    /**
     * Handle staff password reset request.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:staff_users,email',
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.exists' => 'Email tidak ditemukan',
        ]);

        // Check if staff is active
        $staff = StaffUser::where('email', $request->email)->first();
        if (!$staff->isActive()) {
            return back()->withErrors([
                'email' => 'Your account has been suspended. Please contact administrator.',
            ]);
        }

        $status = Password::broker('staff_users')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    /**
     * Show the staff password reset form.
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('staff.auth.reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Handle staff password reset.
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ], [
            'token.required' => 'Token harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Kata sandi harus diisi',
            'password.min' => 'Kata sandi minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok',
        ]);

        $status = Password::broker('staff_users')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (StaffUser $staff, string $password) {
                $staff->forceFill([
                    'password' => Hash::make($password)
                ]);

                $staff->save();
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('staff.login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
