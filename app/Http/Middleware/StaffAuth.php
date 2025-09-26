<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StaffAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
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

        return $next($request);
    }
}
