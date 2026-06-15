<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\ServiceController;

/*
|--------------------------------------------------------------------------
| Fallback & Mobile Routes
|--------------------------------------------------------------------------
*/

// Default routes (fallback)
Route::middleware(['web'])->group(function () {
    Route::get('/', [HomeController::class, 'index']);
});

// Mobile access routes for services
Route::prefix('services')->middleware(['web'])->group(function () {
    Route::get('/', [ServiceController::class, 'index']);
    Route::get('/web', [ServiceController::class, 'webDevelopment']);
    Route::get('/app', [ServiceController::class, 'appDevelopment']);
    Route::get('/mobile-app', [ServiceController::class, 'mobileAppDevelopment']);
    Route::get('/uiux', [ServiceController::class, 'uiuxDesign']);
    Route::get('/custom-solution', [ServiceController::class, 'customSolution']);
    Route::get('/ai/ai-strategy', [ServiceController::class, 'aiStrategy'])->name('services.ai-strategy.index');
    Route::get('/ai/ai-agents', [ServiceController::class, 'aiAgents'])->name('services.ai-agents.index');
    Route::get('/ai/ai-automation', [ServiceController::class, 'aiAutomation'])->name('services.ai-automation.index');
    // Backward compatibility
    Route::get('/web-development', [ServiceController::class, 'webDevelopment']);
    Route::get('/app-development', [ServiceController::class, 'appDevelopment']);
    Route::get('/mobile-app-development', [ServiceController::class, 'mobileAppDevelopment']);
    Route::get('/uiux-design', [ServiceController::class, 'uiuxDesign']);
});

Route::middleware(['web'])->group(function () {
    Route::get('/team', [HomeController::class, 'teamIndex']);
    Route::get('/team/{slug}', [HomeController::class, 'teamProfile']);
});

Route::middleware(['web'])->group(function () {
    Route::get('/legal', [LegalController::class, 'index']);
    Route::get('/legal/privacy', [LegalController::class, 'privacy']);
    Route::get('/legal/terms', [LegalController::class, 'terms']);
    Route::get('/legal/license', [LegalController::class, 'license']);
    Route::get('/legal/trademark', [LegalController::class, 'trademark']);
    Route::get('/legal/copyright', [LegalController::class, 'copyright']);
    Route::get('/legal/compliance', [LegalController::class, 'compliance']);
    Route::get('/legal/opensource', [LegalController::class, 'opensource']);
    Route::get('/legal/cookies', [LegalController::class, 'cookies']);
    Route::get('/legal/disclaimer', [LegalController::class, 'disclaimer']);
});

// Portfolio routes
Route::middleware(['web'])->group(function () {
    Route::get('/portfolio/{slug}', function ($slug) {
        $portfolioPath = public_path("portfolio/{$slug}.html");
        if (file_exists($portfolioPath)) {
            return response()->file($portfolioPath);
        }
        return response()->file(public_path('portfolio/default.html'));
    })->name('portfolio.show');
});

// Fallback home/about/contact/search
Route::middleware(['web'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home.fallback');
    Route::get('/about', [HomeController::class, 'about'])->name('about.fallback');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact.fallback');
    Route::post('/contact', [HomeController::class, 'sendContact'])->name('contact.fallback.send');
    Route::get('/search', [HomeController::class, 'search'])->name('search.fallback');
});
