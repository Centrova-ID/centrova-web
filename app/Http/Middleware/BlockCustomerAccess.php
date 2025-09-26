<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class BlockCustomerAccess
{
    /**
     * Handle an incoming request.
     * 
     * This middleware explicitly blocks customer accounts from accessing office area.
     * This is the PRIMARY protection layer for office subdomain.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Define allowed staff roles
        $allowedRoles = ['admin', 'staff', 'customer_service', 'privacy_officer'];
        
        // IMMEDIATELY block if this is office subdomain
        if ($request->getHost() === 'office.centrova.test') {
            
            // Check both guards for any user
            $webUser = Auth::guard('web')->user();
            $staffUser = Auth::guard('staff')->user();
            
            // If no user at all, allow through (will be handled by other middleware)
            $hasAnyUser = $webUser || $staffUser;
            
            if ($hasAnyUser) {
                // Check web guard user first
                if ($webUser) {
                    $role = strtolower(trim($webUser->role ?? 'customer'));
                    
                    // STRICT: Any customer role or null role is BLOCKED
                    if ($role === 'customer' || is_null($webUser->role) || empty($webUser->role)) {
                        Log::warning('BLOCKED: Customer attempted office access', [
                            'user_id' => $webUser->id,
                            'email' => $webUser->email,
                            'role' => $webUser->role,
                            'ip' => $request->ip(),
                            'url' => $request->fullUrl(),
                            'user_agent' => $request->userAgent()
                        ]);
                        
                        // Force complete logout from all guards
                        Auth::guard('web')->logout();
                        Auth::guard('staff')->logout();
                        $request->session()->invalidate();
                        $request->session()->regenerateToken();
                        
                        // Return 404 instead of access denied page
                        abort(404);
                    }
                    
                    // Additional check with role validation
                    $allowedRoles = ['admin', 'staff', 'customer_service', 'privacy_officer'];
                    if (!in_array($role, $allowedRoles)) {
                        Log::warning('BLOCKED: Non-staff user attempted office access', [
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
                        
                        // Return 404 instead of access denied page
                        abort(404);
                    }
                    
                    // Additional validation: check against allowed staff roles
                    if (!in_array($role, $allowedRoles)) {
                        Log::warning('BLOCKED: Invalid role attempted office access', [
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
                        
                        // Return 404 instead of access denied page
                        abort(404);
                    }
                }
                
                // Check staff guard user
                if ($staffUser) {
                    $role = strtolower(trim($staffUser->role ?? ''));
                    
                    if ($role === 'customer' || !in_array($role, $allowedRoles)) {
                        Log::warning('BLOCKED: Customer account found in staff guard', [
                            'staff_id' => $staffUser->id,
                            'email' => $staffUser->email,
                            'role' => $staffUser->role,
                            'ip' => $request->ip()
                        ]);
                        
                        Auth::guard('staff')->logout();
                        Auth::guard('web')->logout();
                        $request->session()->invalidate();
                        $request->session()->regenerateToken();
                        
                        // Return 404 instead of access denied page
                        abort(404);
                    }
                }
            }
        }
        
        return $next($request);
    }
}
