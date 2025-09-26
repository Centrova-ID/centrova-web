<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PrivacyOfficerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->guard('staff')->check()) {
            return redirect()->route('staff.login');
        }

        $staff = auth()->guard('staff')->user();
        
        if (!$staff || $staff->role !== 'privacy_officer') {
            abort(403, 'Access denied. Privacy Officer role required.');
        }

        return $next($request);
    }
}
