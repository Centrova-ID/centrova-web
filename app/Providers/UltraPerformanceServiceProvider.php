<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use App\Services\DatabasePreloadService;

/**
 * ULTRA-PERFORMANCE SERVICE PROVIDER
 * Aggressive optimizations for maximum speed
 */
class UltraPerformanceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register preload service
        $this->app->singleton(DatabasePreloadService::class);

        // Disable unnecessary features in production
        if ($this->app->environment('production')) {
            // Disable debug backtrace
            ini_set('zend.exception_ignore_args', '1');
            
            // Disable unused features
            config(['app.debug' => false]);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Preload database data on boot
        if ($this->app->environment('production')) {
            $this->app->make(DatabasePreloadService::class)->bootPreload();
        }

        // Share commonly used data with all views (from cache)
        View::composer('*', function ($view) {
            $view->with('_cached_config', $this->getCachedConfig());
        });

        // Register ultra-fast cache directive
        $this->registerCacheDirective();

        // Optimize view compiler
        $this->optimizeViews();
    }

    /**
     * Get cached configuration (avoid repeated config calls)
     */
    protected function getCachedConfig(): array
    {
        return Cache::rememberForever('app:config:shared', function () {
            return [
                'app_name' => config('app.name'),
                'app_url' => config('app.url'),
                'cdn_url' => config('filesystems.cdn_url', ''),
            ];
        });
    }

    /**
     * Register @cache directive for ultra-fast fragment caching
     */
    protected function registerCacheDirective(): void
    {
        // Simple cache wrapper (minimal overhead)
        Blade::directive('cache', function ($expression) {
            list($key, $ttl) = explode(',', $expression . ',3600');
            
            return "<?php if(!\$__cache_output = Cache::get({$key})): ob_start(); ?>";
        });

        Blade::directive('endcache', function ($expression) {
            list($key, $ttl) = explode(',', $expression . ',3600');
            
            return "<?php \$__cache_output = ob_get_clean(); 
                    Cache::put({$key}, \$__cache_output, {$ttl}); 
                    echo \$__cache_output; 
                else: 
                    echo \$__cache_output; 
                endif; ?>";
        });
    }

    /**
     * Optimize view compilation
     */
    protected function optimizeViews(): void
    {
        // Precompile views in production
        if ($this->app->environment('production')) {
            // Views already compiled by view:cache command
            config(['view.cache' => true]);
        }
    }
}
