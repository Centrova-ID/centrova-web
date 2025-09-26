<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait DetectsFallbackRoute
{
    /**
     * Detect if the current request is using fallback route
     * (main domain with /account prefix instead of account subdomain)
     */
    protected function isFallbackRoute(Request $request, string $prefix = 'account'): bool
    {
        $url = $request->url();
        $host = $request->getHost();
        
        // Check if URL contains /{prefix}/ pattern and host is NOT the subdomain
        return str_contains($url, "/{$prefix}/") && 
               !str_contains($host, "{$prefix}.centrova.test");
    }
    
    /**
     * Get appropriate route name based on whether using fallback or not
     */
    protected function getRouteForContext(Request $request, string $originalRoute, string $fallbackRoute = null): string
    {
        if ($this->isFallbackRoute($request)) {
            return $fallbackRoute ?? "account.fallback.{$originalRoute}";
        }
        
        return $originalRoute;
    }
    
    /**
     * Get redirect response based on fallback context
     */
    protected function redirectToContext(Request $request, string $originalRoute, string $fallbackRoute = null)
    {
        $route = $this->getRouteForContext($request, $originalRoute, $fallbackRoute);
        return redirect()->intended(route($route));
    }
}
