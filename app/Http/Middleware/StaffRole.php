<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StaffRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Check if staff user is authenticated using staff guard
        if (!Auth::guard('staff')->check()) {
            return redirect()->route('staff.login');
        }

        /** @var \App\Models\StaffUser $staff */
        $staff = Auth::guard('staff')->user();
        
        // Check if staff user is active
        if (!$staff->isActive()) {
            Auth::guard('staff')->logout();
            return redirect()->route('staff.login')->with('error', 'Your account has been suspended.');
        }

        // Check if staff has required role
        if (!empty($roles) && !in_array($staff->role, $roles)) {
            abort(403, 'Unauthorized. Required role: ' . implode(' or ', $roles));
        }

        return $next($request);
    }
}
