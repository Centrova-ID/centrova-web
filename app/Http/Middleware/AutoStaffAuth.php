<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StaffUser;
use Symfony\Component\HttpFoundation\Response;

class AutoStaffAuth
{
    /**
     * Handle an incoming request.
     * 
     * Auto-login staff user if they are already authenticated as staff via web guard,
     * otherwise redirect to staff login.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if already authenticated with staff guard
        if (Auth::guard('staff')->check()) {
            $staff = Auth::guard('staff')->user();
            
            // Verify staff is still active
            if ($staff && $staff->isActive()) {
                return $next($request);
            } else {
                // Staff inactive, logout and redirect to login
                Auth::guard('staff')->logout();
                return redirect()->route('staff.login')->with('error', 'Your account has been suspended.');
            }
        }

        // Check if user is authenticated via web guard and is staff
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            
            if ($user && $user->isStaff()) {
                // Try to find corresponding staff user by email
                $staffUser = StaffUser::where('email', $user->email)->first();
                
                if ($staffUser && $staffUser->isActive()) {
                    // Auto-login to staff guard
                    Auth::guard('staff')->login($staffUser, true);
                    
                    // Update last login
                    $staffUser->update(['last_login_at' => now()]);
                    
                    return $next($request);
                }
            }
        }

        // Not authenticated as staff or no valid staff account found
        // Redirect to staff login
        return redirect()->route('staff.login');
    }
}
