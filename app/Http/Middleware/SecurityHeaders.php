<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request and add security headers.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Content Security Policy
        $csp = $this->getContentSecurityPolicy($request);
        $response->headers->set('Content-Security-Policy', $csp);

        // Strict Transport Security (only for HTTPS)
        if ($request->isSecure()) {
            $response->headers->set(
                'Strict-Transport-Security',
                'max-age=31536000; includeSubDomains; preload'
            );
        }

        // X-Frame-Options to prevent clickjacking
        $response->headers->set('X-Frame-Options', 'DENY');

        // X-Content-Type-Options to prevent MIME sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Referrer Policy
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Permissions Policy (formerly Feature Policy)
        $response->headers->set(
            'Permissions-Policy',
            'geolocation=(), microphone=(), camera=(), payment=(), usb=(), autoplay=()'
        );

        // X-XSS-Protection (legacy, but still useful for older browsers)
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        return $response;
    }

    /**
     * Generate Content Security Policy based on the current route
     */
    private function getContentSecurityPolicy(Request $request): string
    {
        $nonce = base64_encode(random_bytes(16));
        
        // Store nonce in request for use in views
        $request->attributes->set('csp_nonce', $nonce);

        // Basic CSP - adjust based on your application needs
        $csp = [
            "default-src 'self'",
            "script-src 'self' 'nonce-{$nonce}'",
            "style-src 'self' 'unsafe-inline'", // Tailwind requires unsafe-inline
            "img-src 'self' data: https:",
            "font-src 'self' data:",
            "connect-src 'self'",
            "frame-src 'none'",
            "object-src 'none'",
            "base-uri 'self'",
            "form-action 'self'",
        ];

        // Add specific rules for auth pages
        if ($this->isAuthRoute($request)) {
            // You might need to adjust these based on your specific needs
            // For example, if you use external CDNs for fonts or analytics
        }

        return implode('; ', $csp);
    }

    /**
     * Check if current route is an authentication route
     */
    private function isAuthRoute(Request $request): bool
    {
        $path = $request->path();
        
        return str_starts_with($path, 'auth/') || 
               str_starts_with($path, 'login') || 
               str_starts_with($path, 'register') ||
               str_starts_with($path, 'password/') ||
               str_starts_with($path, '2fa/');
    }
}
