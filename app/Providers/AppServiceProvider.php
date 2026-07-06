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

        // Register GlideService
        $this->app->singleton(\App\Services\GlideService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Load helpers
        require_once app_path('Helpers/LanguageHelper.php');
        require_once app_path('Helpers/BladeHelpers.php');
        
        // Register View Composer untuk multi-account data
        view()->composer([
            'partials.layouts.main',
            'partials.navbar.components.account',
            'auth.components.account-switcher'
        ], \App\View\Composers\MultiAccountComposer::class);

        // Blade directive untuk gambar yang di-resize otomatis via Glide
        // Gunakan: @image('assets/image/photo.jpg', ['w' => 800, 'h' => 600])
        // atau: @img('assets/image/photo.jpg', 'hero') untuk preset
        app('blade.compiler')->directive('img', function ($expression) {
            $params = explode(',', $expression, 2);
            $path = trim(array_shift($params) ?? "''");
            $options = trim(array_shift($params) ?? '[]');
            return "<?php echo app(\App\Services\GlideService::class)->imageUrl({$path}, {$options}); ?>";
        });
    }
}
