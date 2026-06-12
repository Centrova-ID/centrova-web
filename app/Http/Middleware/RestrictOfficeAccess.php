<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\StaffUser;
use Symfony\Component\HttpFoundation\Response;

class RestrictOfficeAccess
{
    /**
     * Handle an incoming request.
     * 
     * This middleware ensures ONLY staff members can access the office subdomain.
     * Customer accounts are completely blocked from accessing office.centrova.id
     * Staff accounts that are already logged in on main domain can access office area.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // IMMEDIATE CHECK: Block if this is not the office subdomain
        if ($request->getHost() !== 'office.centrova.id') {
            return $next($request);
        }
        
        // IMMEDIATE CHECK: Block all non-staff access attempts
        $webUser = Auth::guard('web')->user();
        $staffUser = Auth::guard('staff')->user();
        
        // If any user is a customer, immediately block
        $allowedRoles = ['admin', 'staff', 'customer_service', 'privacy_officer'];
        if ($webUser && (!in_array(strtolower($webUser->role ?? 'customer'), $allowedRoles) || strtolower($webUser->role ?? 'customer') === 'customer')) {
            Log::warning('BLOCKED: Customer/Non-staff attempted office access', [
                'user_id' => $webUser->id,
                'email' => $webUser->email,
                'role' => $webUser->role,
                'ip' => $request->ip(),
                'url' => $request->fullUrl()
            ]);
            
            Auth::guard('web')->logout();
            Auth::guard('staff')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            abort(404);
        }
        
        // First, check if already authenticated with staff guard
        if (Auth::guard('staff')->check()) {
            $staff = Auth::guard('staff')->user();
            
            // Verify staff is still active and valid
            if ($staff && $staff->status === 'active' && in_array(strtolower($staff->role ?? ''), $allowedRoles)) {
                return $next($request);
            } else {
                // Staff inactive or invalid, logout and redirect to login
                Auth::guard('staff')->logout();
                Auth::guard('web')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('staff.login')->with('error', 'Your account has been suspended or is invalid.');
            }
        }

        // Check if user is authenticated via web guard (shared session from main domain)
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            
            // STRICT CHECK: If user role is customer (case insensitive) or null, throw 404
            $userRole = strtolower($user->role ?? 'customer');
            
            if ($userRole === 'customer' || is_null($user->role)) {
                // Log the unauthorized access attempt
                Log::warning('Customer account attempted to access office subdomain - returning 404', [
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'role' => $user->role,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'requested_url' => $request->fullUrl()
                ]);
                
                // Force logout from web guard to prevent further access
                Auth::guard('web')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                // Return 404 instead of access denied page
                abort(404);
            }
            
            // Double check with role validation as well
            $userRole = strtolower($user->role ?? 'customer');
            if ($user && !in_array($userRole, $allowedRoles)) {
                // Log the unauthorized access attempt
                Log::warning('Non-staff account attempted to access office subdomain - returning 404', [
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'role' => $user->role,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'requested_url' => $request->fullUrl()
                ]);
                
                // Force logout from web guard
                Auth::guard('web')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                // Return 404 instead of access denied page
                abort(404);
            }
            
            // If user is staff and logged in via web guard, auto-login to staff guard
            if ($user && in_array($userRole, $allowedRoles)) {
                // STRICT VALIDATION: Additional check before auto-login
                if (!in_array($userRole, $allowedRoles)) {
                    Log::warning('Auto-login blocked: Invalid role', [
                        'user_id' => $user->id,
                        'email' => $user->email,
                        'role' => $user->role,
                        'ip' => $request->ip()
                    ]);
                    
                    Auth::guard('web')->logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    
                    abort(404);
                }
                
                // Try to find corresponding staff user by email
                $staffUser = StaffUser::where('email', $user->email)->first();
                
                if ($staffUser && $staffUser->status === 'active') {
                    // ADDITIONAL VALIDATION: Ensure staff user also has valid role
                    $staffRole = strtolower(trim($staffUser->role ?? ''));
                    if (!in_array($staffRole, $allowedRoles)) {
                        Log::warning('Auto-login blocked: Staff user has invalid role', [
                            'staff_id' => $staffUser->id,
                            'staff_email' => $staffUser->email,
                            'staff_role' => $staffUser->role,
                            'web_user_id' => $user->id,
                            'ip' => $request->ip()
                        ]);
                        
                        abort(404);
                    }
                    
                    // Auto-login to staff guard using shared session
                    Auth::guard('staff')->login($staffUser, true);
                    
                    // Update last login
                    $staffUser->update(['last_login_at' => now()]);
                    
                    Log::info('Auto-login successful', [
                        'web_user' => $user->email,
                        'staff_user' => $staffUser->email,
                        'ip' => $request->ip()
                    ]);
                    
                    return $next($request);
                } else {
                    // Staff user not found or inactive in staff table
                    Log::warning('Auto-login blocked: No corresponding staff user', [
                        'web_user_id' => $user->id,
                        'web_user_email' => $user->email,
                        'staff_user_exists' => $staffUser ? 'inactive' : 'not_found',
                        'ip' => $request->ip()
                    ]);
                    
                    abort(404);
                }
            }
        }

        // Skip authentication requirement for specific login/auth routes
        $allowedRoutes = [
            'staff.login',
            'staff.login.submit', 
            'staff.password.request',
            'staff.password.email',
            'staff.password.reset',
            'staff.password.update'
        ];
        
        if (in_array($request->route()->getName(), $allowedRoutes)) {
            return $next($request);
        }

        // Not authenticated at all - redirect to staff login
        return redirect()->route('staff.login')
            ->with('info', 'Please login with your staff credentials to access the office area.');
    }
}
