<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Helpers\RouteHelper;

class RouteHelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register the RouteHelper as a singleton
        $this->app->singleton(RouteHelper::class, function ($app) {
            return new RouteHelper();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Register Blade directives for route helpers
        $this->registerBladeDirectives();
        
        // Register global helper functions
        $this->registerGlobalHelpers();
    }
    
    /**
     * Register Blade directives
     */
    protected function registerBladeDirectives(): void
    {
        // @smartRoute directive
        Blade::directive('smartRoute', function ($expression) {
            return "<?php echo app(App\Helpers\RouteHelper::class)->smartRoute{$expression}; ?>";
        });
        
        // @routeType directive - shows current route type
        Blade::directive('routeType', function () {
            return "<?php echo app(App\Helpers\RouteHelper::class)->getCurrentRouteType(); ?>";
        });
        
        // @subdomain directive - shows current subdomain
        Blade::directive('subdomain', function () {
            return "<?php echo app(App\Helpers\RouteHelper::class)->getCurrentSubdomain(); ?>";
        });
        
        // @ifSubdomain directive
        Blade::directive('ifSubdomain', function ($expression) {
            return "<?php if(app(App\Helpers\RouteHelper::class)->getCurrentSubdomain() === {$expression}): ?>";
        });
        
        // @endifSubdomain directive
        Blade::directive('endifSubdomain', function () {
            return "<?php endif; ?>";
        });
        
        // @ifFallback directive
        Blade::directive('ifFallback', function () {
            return "<?php if(app(App\Helpers\RouteHelper::class)->getCurrentRouteType() === 'fallback'): ?>";
        });
        
        // @endifFallback directive
        Blade::directive('endifFallback', function () {
            return "<?php endif; ?>";
        });
    }
    
    /**
     * Register global helper functions
     */
    protected function registerGlobalHelpers(): void
    {
        if (!function_exists(__NAMESPACE__ . '\smart_route')) {
            /**
             * Generate smart route
             */
            function smart_route($subdomain, $route, $parameters = []) {
                return app(RouteHelper::class)->smartRoute($subdomain, $route, $parameters);
            }
        }
        
        if (!function_exists(__NAMESPACE__ . '\is_subdomain_available')) {
            /**
             * Check if subdomain is available
             */
            function is_subdomain_available($subdomain) {
                return app(RouteHelper::class)->isSubdomainAvailable($subdomain);
            }
        }
        
        if (!function_exists(__NAMESPACE__ . '\current_route_type')) {
            /**
             * Get current route type
             */
            function current_route_type() {
                return app(RouteHelper::class)->getCurrentRouteType();
            }
        }
        
        if (!function_exists(__NAMESPACE__ . '\current_subdomain')) {
            /**
             * Get current subdomain
             */
            function current_subdomain() {
                return app(RouteHelper::class)->getCurrentSubdomain();
            }
        }
        
        if (!function_exists(__NAMESPACE__ . '\navigation_menu')) {
            /**
             * Get navigation menu with proper routes
             */
            function navigation_menu() {
                return app(RouteHelper::class)->getNavigationMenu();
            }
        }
    }
}
