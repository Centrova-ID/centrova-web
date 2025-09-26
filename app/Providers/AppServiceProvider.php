<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register MultiAccountService as singleton
        $this->app->singleton(\App\Services\MultiAccountService::class);
        
        // Register TranslationService as singleton
        $this->app->singleton(\App\Services\TranslationService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Load language helper
        require_once app_path('Helpers/LanguageHelper.php');
        
        // Register View Composer untuk multi-account data
        view()->composer([
            'partials.layouts.main',
            'partials.navbar.components.account',
            'auth.components.account-switcher'
        ], \App\View\Composers\MultiAccountComposer::class);
    }
}
