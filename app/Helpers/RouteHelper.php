<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route as LaravelRoute;

class RouteHelper
{
    /**
     * Generate smart route based on subdomain availability
     * 
     * @param string $subdomain
     * @param string $route
     * @param array $parameters
     * @return string
     */
    public static function smartRoute($subdomain, $route, $parameters = [])
    {
        $useSubdomains = config('app.use_subdomains', true);
        $fallbackEnabled = config('app.fallback_routes_enabled', true);
        
        // If subdomains are enabled and available, use original route
        if ($useSubdomains && self::isSubdomainAvailable($subdomain)) {
            return route($route, $parameters);
        }
        
        // If fallback is enabled, use fallback route
        if ($fallbackEnabled) {
            $fallbackRoute = "{$subdomain}.fallback.{$route}";
            
            // Check if fallback route exists
            if (LaravelRoute::has($fallbackRoute)) {
                return route($fallbackRoute, $parameters);
            }
        }
        
        // Default fallback to main domain
        return url('/');
    }
    
    /**
     * Check if subdomain is available
     * 
     * @param string $subdomain
     * @return bool
     */
    public static function isSubdomainAvailable($subdomain)
    {
        // You can implement actual subdomain checking logic here
        // For now, we'll use config to determine availability
        $availableSubdomains = config('app.available_subdomains', [
            'support', 'account', 'news', 'developer', 'learn', 'docs', 'careers'
        ]);
        
        return in_array($subdomain, $availableSubdomains);
    }
    
    /**
     * Get current route type (subdomain or fallback)
     * 
     * @return string
     */
    public static function getCurrentRouteType()
    {
        $currentRoute = request()->route();
        
        if (!$currentRoute) {
            return 'unknown';
        }
        
        $routeName = $currentRoute->getName();
        
        if (strpos($routeName, '.fallback.') !== false) {
            return 'fallback';
        }
        
        return 'subdomain';
    }
    
    /**
     * Get subdomain from current request
     * 
     * @return string|null
     */
    public static function getCurrentSubdomain()
    {
        $host = request()->getHost();
        $parts = explode('.', $host);
        
        // If we have more than 2 parts, first part is subdomain
        if (count($parts) > 2) {
            return $parts[0];
        }
        
        return null;
    }
    
    /**
     * Generate URL with fallback support
     * 
     * @param string $route
     * @param array $parameters
     * @param bool $absolute
     * @return string
     */
    public static function urlWithFallback($route, $parameters = [], $absolute = true)
    {
        // Parse route to get subdomain
        $routeParts = explode('.', $route);
        
        if (count($routeParts) >= 2) {
            $subdomain = $routeParts[0];
            $actualRoute = implode('.', array_slice($routeParts, 1));
            
            return self::smartRoute($subdomain, $actualRoute, $parameters);
        }
        
        // If no subdomain detected, use normal route
        return route($route, $parameters, $absolute);
    }
    
    /**
     * Check if current environment supports subdomains
     * 
     * @return bool
     */
    public static function supportsSubdomains()
    {
        // In local development, subdomains might not work properly
        if (app()->environment('local')) {
            return config('app.local_subdomains_enabled', false);
        }
        
        return config('app.use_subdomains', true);
    }
    
    /**
     * Get all available route mappings
     * 
     * @return array
     */
    public static function getRouteMappings()
    {
        return [
            'support' => [
                'home' => ['subdomain' => 'support.home', 'fallback' => 'support.fallback.home'],
                'help.home' => ['subdomain' => 'support.help.home', 'fallback' => 'support.fallback.help.home'],
                'web.consult' => ['subdomain' => 'support.web.consult', 'fallback' => 'support.fallback.web.consult'],
                'web.chat' => ['subdomain' => 'support.web.chat', 'fallback' => 'support.fallback.web.chat'],
            ],
            'account' => [
                'login' => ['subdomain' => 'login', 'fallback' => 'account.fallback.login'],
                'register' => ['subdomain' => 'register', 'fallback' => 'account.fallback.register'],
                'dashboard' => ['subdomain' => 'dashboard', 'fallback' => 'account.fallback.dashboard'],
                'home' => ['subdomain' => 'account', 'fallback' => 'account.fallback.home'],
            ],
            'news' => [
                'home' => ['subdomain' => 'news.home', 'fallback' => 'news.fallback.home'],
                'detail' => ['subdomain' => 'news.detail', 'fallback' => 'news.fallback.detail'],
                'create' => ['subdomain' => 'news.create', 'fallback' => 'news.fallback.create'],
            ],
            'developer' => [
                'home' => ['subdomain' => 'developer.home', 'fallback' => 'developer.fallback.home'],
                'ui-kit' => ['subdomain' => 'developer.ui-kit', 'fallback' => 'developer.fallback.ui-kit'],
            ],
            'learn' => [
                'index' => ['subdomain' => 'learn.index', 'fallback' => 'learn.fallback.index'],
            ],
            'docs' => [
                'services.index' => ['subdomain' => 'docs.services.index', 'fallback' => 'docs.fallback.services.index'],
                'services.web' => ['subdomain' => 'docs.services.web', 'fallback' => 'docs.fallback.services.web'],
                'services.app' => ['subdomain' => 'docs.services.app', 'fallback' => 'docs.fallback.services.app'],
                'services.mobile' => ['subdomain' => 'docs.services.mobile', 'fallback' => 'docs.fallback.services.mobile'],
                'services.uiux' => ['subdomain' => 'docs.services.uiux', 'fallback' => 'docs.fallback.services.uiux'],
            ],
            'careers' => [
                'home' => ['subdomain' => 'careers.home', 'fallback' => 'careers.home'],
            ],
        ];
    }
    
    /**
     * Generate navigation menu with proper routes
     * 
     * @return array
     */
    public static function getNavigationMenu()
    {
        return [
            [
                'title' => 'Home',
                'url' => route('home'),
                'active' => request()->routeIs('home*'),
            ],
            [
                'title' => 'Services',
                'url' => route('services.index'),
                'active' => request()->routeIs('services*'),
            ],
            [
                'title' => 'Support',
                'url' => self::smartRoute('support', 'home'),
                'active' => request()->routeIs('support*'),
            ],
            [
                'title' => 'News',
                'url' => self::smartRoute('news', 'home'),
                'active' => request()->routeIs('news*'),
            ],
            [
                'title' => 'Developer',
                'url' => self::smartRoute('developer', 'home'),
                'active' => request()->routeIs('developer*'),
            ],
            [
                'title' => 'Learn',
                'url' => self::smartRoute('learn', 'index'),
                'active' => request()->routeIs('learn*'),
            ],
            [
                'title' => 'Account',
                'url' => auth()->check() 
                    ? self::smartRoute('account', 'home') 
                    : self::smartRoute('account', 'login'),
                'active' => request()->routeIs('account*'),
            ],
        ];
    }
    
    /**
     * Detect if current request is using fallback route
     */
    public static function isFallbackRoute(Request $request = null): bool
    {
        if (!$request) {
            $request = request();
        }
        
        $url = $request->url();
        $host = $request->getHost();
        
        return str_contains($url, '/account/') && 
               !str_contains($host, 'account.centrova.test');
    }
    
    /**
     * Get appropriate route name for current context
     */
    public static function getContextRoute(string $originalRoute, string $fallbackRoute = null): string
    {
        if (self::isFallbackRoute()) {
            return $fallbackRoute ?? "account.fallback.{$originalRoute}";
        }
        
        return $originalRoute;
    }
    
    /**
     * Get login route for current context
     */
    public static function getLoginRoute(): string
    {
        return self::getContextRoute('login', 'account.fallback.login');
    }
    
    /**
     * Get register route for current context
     */
    public static function getRegisterRoute(): string
    {
        return self::getContextRoute('register', 'account.fallback.register');
    }
    
    /**
     * Get account route for current context
     */
    public static function getAccountRoute(): string
    {
        return self::getContextRoute('account', 'account.fallback.index');
    }
}
