<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RequirePasswordConfirmation
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, int $timeoutInMinutes = 1, string $mode = 'security')
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $sessionKey = 'auth.password_confirmed_at';
        $confirmedAt = $request->session()->get($sessionKey);

        // Check if password was confirmed within the timeout period
        if ($confirmedAt && now()->diffInMinutes($confirmedAt) < $timeoutInMinutes) {
            return $next($request);
        }

        // If this is a password confirmation request
        if ($request->isMethod('post') && $request->has('current_password')) {
            $user = Auth::user();
            
            if (Hash::check($request->current_password, $user->password)) {
                // Store confirmation timestamp
                $request->session()->put($sessionKey, now());
                
                // Redirect to intended URL or current page
                return redirect()->intended($request->url());
            } else {
                return back()->withErrors([
                    'current_password' => 'Password yang Anda masukkan salah.'
                ])->withInput();
            }
        }

        // Determine view data based on mode
        $viewData = [
            'intended_url' => $request->fullUrl(),
            'mode' => $mode
        ];

        // Set mode-specific data
        switch ($mode) {
            case 'security':
                $viewData['title'] = 'Konfirmasi Password';
                $viewData['subtitle'] = 'Untuk keamanan, masukkan password Anda untuk melanjutkan';
                $viewData['icon'] = 'lock';
                break;
            case 'sensitive':
                $viewData['title'] = 'Verifikasi Identitas';
                $viewData['subtitle'] = 'Tindakan ini memerlukan verifikasi identitas Anda';
                $viewData['icon'] = 'shield';
                break;
            case 'admin':
                $viewData['title'] = 'Akses Administrator';
                $viewData['subtitle'] = 'Masukkan password untuk mengakses area administrator';
                $viewData['icon'] = 'key';
                break;
            default:
                $viewData['title'] = 'Konfirmasi Password';
                $viewData['subtitle'] = 'Masukkan password Anda untuk melanjutkan';
                $viewData['icon'] = 'lock';
        }

        // Show password confirmation form
        return response()->view('auth.confirm-password', $viewData);
    }
}
