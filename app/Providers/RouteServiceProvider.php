<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = 'https://account.centrova.id/account';

    /**
     * Get the appropriate home URL based on current request context
     */
    public static function getHomeUrl(Request $request = null): string
    {
        if (!$request) {
            $request = request();
        }
        
        // Check if current request is from fallback route
        $isFallbackRoute = str_contains($request->url(), '/account/') && 
                          !str_contains($request->getHost(), 'account.centrova.id');
        
        if ($isFallbackRoute) {
            // Return fallback account route URL
            return route('account.fallback.index');
        }
        
        // Return default subdomain URL
        return self::HOME;
    }

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
