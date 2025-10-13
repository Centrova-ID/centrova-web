<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SEOService;

class SEOServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(SEOService::class, function ($app) {
            return new SEOService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Register SEO view composer for global access
        view()->composer('*', function ($view) {
            $view->with('seoService', app(SEOService::class));
        });
    }
}
