<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\RouteHelper;
use Symfony\Component\HttpFoundation\Response;

class SubdomainFallbackMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only handle if fallback is enabled
        if (!config('app.fallback_routes_enabled', true)) {
            return $next($request);
        }
        
        // Get current subdomain
        $subdomain = RouteHelper::getCurrentSubdomain();
        
        // If no subdomain, continue normally
        if (!$subdomain) {
            return $next($request);
        }
        
        // Check if subdomain is available
        if (!RouteHelper::isSubdomainAvailable($subdomain)) {
            return $this->redirectToFallback($request, $subdomain);
        }
        
        // If subdomain is disabled globally but we're on subdomain, redirect to fallback
        if (!config('app.use_subdomains', true)) {
            return $this->redirectToFallback($request, $subdomain);
        }
        
        return $next($request);
    }
    
    /**
     * Redirect to fallback route
     * 
     * @param Request $request
     * @param string $subdomain
     * @return Response
     */
    protected function redirectToFallback(Request $request, string $subdomain): Response
    {
        $currentRoute = $request->route();
        $path = $request->path();
        
        // Build fallback URL
        $fallbackUrl = $this->buildFallbackUrl($request, $subdomain, $path);
        
        // Redirect with 302 (temporary redirect)
        return redirect($fallbackUrl, 302);
    }
    
    /**
     * Build fallback URL
     * 
     * @param Request $request
     * @param string $subdomain
     * @param string $path
     * @return string
     */
    protected function buildFallbackUrl(Request $request, string $subdomain, string $path): string
    {
        $baseUrl = config('app.url');
        
        // Remove subdomain from host and use main domain
        $mainDomain = preg_replace('/^[^.]+\./', '', $request->getHost());
        $scheme = $request->getScheme();
        $port = $request->getPort();
        
        // Build base URL for main domain
        $baseUrl = $scheme . '://' . $mainDomain;
        if ($port && !in_array($port, [80, 443])) {
            $baseUrl .= ':' . $port;
        }
        
        // Add subdomain as prefix to path
        if ($path === '/') {
            $fallbackPath = '/' . $subdomain;
        } else {
            $fallbackPath = '/' . $subdomain . '/' . ltrim($path, '/');
        }
        
        // Preserve query parameters
        $queryString = $request->getQueryString();
        if ($queryString) {
            $fallbackPath .= '?' . $queryString;
        }
        
        return $baseUrl . $fallbackPath;
    }
    
    /**
     * Check if current request is for a health check or monitoring
     * 
     * @param Request $request
     * @return bool
     */
    protected function isHealthCheck(Request $request): bool
    {
        $path = $request->path();
        $healthCheckPaths = [
            'health',
            'health-check', 
            'ping',
            'status',
            'monitoring'
        ];
        
        return in_array($path, $healthCheckPaths);
    }
}
