<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SitemapController;

/*
|--------------------------------------------------------------------------
| Main Domain Routes (centrova.id)
|--------------------------------------------------------------------------
*/

Route::domain('centrova.id')->middleware(['web', 'language'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    Route::post('/contact', [HomeController::class, 'sendContact'])->name('contact.send');
    Route::get('/team', [HomeController::class, 'teamIndex'])->name('team.index');
    Route::get('/team/{slug}', [HomeController::class, 'teamProfile'])->name('team.profile');
    Route::get('/team/sultan-rahmatulloh', [HomeController::class, 'teamProfile'])->defaults('slug', 'sultan-rahmatulloh')->name('team.sultan');
    Route::get('/team/syahied-ramadhan', [HomeController::class, 'teamProfile'])->defaults('slug', 'syahied-ramadhan')->name('team.syahied');
    Route::get('/team/muhammad-fadli', [HomeController::class, 'teamProfile'])->defaults('slug', 'muhammad-fadli')->name('team.fadli');
    Route::get('/sitemap', [SitemapController::class, 'index'])->name('sitemap');
    Route::get('/sitemap.xml', [SitemapController::class, 'xml'])->name('sitemap.xml');
    Route::get('/search', [HomeController::class, 'search'])->name('search');
    Route::get('/search/suggestions', [HomeController::class, 'searchSuggestions'])->name('search.suggestions');

    // Legal Routes
    Route::prefix('legal')->group(function () {
        Route::get('/', [LegalController::class, 'index'])->name('legal.index');
        Route::get('/privacy', [LegalController::class, 'privacy'])->name('legal.privacy');
        Route::get('/terms', [LegalController::class, 'terms'])->name('legal.terms');
        Route::get('/license', [LegalController::class, 'license'])->name('legal.license');
        Route::get('/trademark', [LegalController::class, 'trademark'])->name('legal.trademark');
        Route::get('/copyright', [LegalController::class, 'copyright'])->name('legal.copyright');
        Route::get('/compliance', [LegalController::class, 'compliance'])->name('legal.compliance');
        Route::get('/opensource', [LegalController::class, 'opensource'])->name('legal.opensource');
        Route::get('/cookies', [LegalController::class, 'cookies'])->name('legal.cookies');
        Route::get('/disclaimer', [LegalController::class, 'disclaimer'])->name('legal.disclaimer');
    });

    // Service Routes
    Route::prefix('services')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->name('services.index');
        Route::get('/web', [ServiceController::class, 'webDevelopment'])->name('services.web.index');
        Route::get('/web-company-profile', [ServiceController::class, 'webCompanyProfile'])->name('services.web-company-profile');
        Route::get('/ecommerce', [ServiceController::class, 'ecommerce'])->name('services.ecommerce');
        Route::get('/app', [ServiceController::class, 'appDevelopment'])->name('services.app.index');
        Route::get('/mobile-app', [ServiceController::class, 'mobileAppDevelopment'])->name('services.mobile-app.index');
        Route::get('/uiux', [ServiceController::class, 'uiuxDesign'])->name('services.uiux.index');
        Route::get('/custom-solution', [ServiceController::class, 'customSolution'])->name('services.custom-solution.index');
        Route::get('/web/{slug}/{page?}', [ServiceController::class, 'webPortfolio'])->name('services.web.portfolio');
        Route::get('/web-development', [ServiceController::class, 'webDevelopment'])->name('services.web-development');
        Route::get('/app-development', [ServiceController::class, 'appDevelopment'])->name('services.app-development');
        Route::get('/mobile-app-development', [ServiceController::class, 'mobileAppDevelopment'])->name('services.mobile-app-development');
        Route::get('/uiux-design', [ServiceController::class, 'uiuxDesign'])->name('services.uiux-design');
    });

    Route::get('/service/consult', [ServiceController::class, 'consult'])->name('service.consult');

    // English routes (with /en prefix)
    Route::prefix('en')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('en.home');
        Route::get('/about', [HomeController::class, 'about'])->name('en.about');
        Route::get('/contact', [HomeController::class, 'contact'])->name('en.contact');
        Route::post('/contact', [HomeController::class, 'sendContact'])->name('en.contact.send');
        Route::get('/team', [HomeController::class, 'teamIndex'])->name('en.team.index');
        Route::get('/team/{slug}', [HomeController::class, 'teamProfile'])->name('en.team.profile');
        Route::get('/team/sultan-rahmatulloh', [HomeController::class, 'teamProfile'])->defaults('slug', 'sultan-rahmatulloh')->name('en.team.sultan');
        Route::get('/team/syahied-ramadhan', [HomeController::class, 'teamProfile'])->defaults('slug', 'syahied-ramadhan')->name('en.team.syahied');
        Route::get('/team/muhammad-fadli', [HomeController::class, 'teamProfile'])->defaults('slug', 'muhammad-fadli')->name('en.team.fadli');
        Route::get('/sitemap', [SitemapController::class, 'index'])->name('en.sitemap');
        Route::get('/search', [HomeController::class, 'search'])->name('en.search');
        Route::get('/search/suggestions', [HomeController::class, 'searchSuggestions'])->name('en.search.suggestions');

        // English Legal Routes
        Route::prefix('legal')->group(function () {
            Route::get('/', [LegalController::class, 'index'])->name('en.legal.index');
            Route::get('/privacy', [LegalController::class, 'privacy'])->name('en.legal.privacy');
            Route::get('/terms', [LegalController::class, 'terms'])->name('en.legal.terms');
            Route::get('/license', [LegalController::class, 'license'])->name('en.legal.license');
            Route::get('/trademark', [LegalController::class, 'trademark'])->name('en.legal.trademark');
            Route::get('/copyright', [LegalController::class, 'copyright'])->name('en.legal.copyright');
            Route::get('/compliance', [LegalController::class, 'compliance'])->name('en.legal.compliance');
            Route::get('/opensource', [LegalController::class, 'opensource'])->name('en.legal.opensource');
            Route::get('/cookies', [LegalController::class, 'cookies'])->name('en.legal.cookies');
            Route::get('/disclaimer', [LegalController::class, 'disclaimer'])->name('en.legal.disclaimer');
        });

        // English Service Routes
        Route::prefix('services')->group(function () {
            Route::get('/', [ServiceController::class, 'index'])->name('en.services.index');
            Route::get('/web', [ServiceController::class, 'webDevelopment'])->name('en.services.web.index');
            Route::get('/web-company-profile', [ServiceController::class, 'webCompanyProfile'])->name('en.services.web-company-profile');
            Route::get('/ecommerce', [ServiceController::class, 'ecommerce'])->name('en.services.ecommerce');
            Route::get('/app', [ServiceController::class, 'appDevelopment'])->name('en.services.app.index');
            Route::get('/mobile-app', [ServiceController::class, 'mobileAppDevelopment'])->name('en.services.mobile-app.index');
            Route::get('/uiux', [ServiceController::class, 'uiuxDesign'])->name('en.services.uiux.index');
            Route::get('/custom-solution', [ServiceController::class, 'customSolution'])->name('en.services.custom-solution.index');
            Route::get('/web/{slug}/{page?}', [ServiceController::class, 'webPortfolio'])->name('en.services.web.portfolio');
            Route::get('/web-development', [ServiceController::class, 'webDevelopment'])->name('en.services.web-development');
            Route::get('/app-development', [ServiceController::class, 'appDevelopment'])->name('en.services.app-development');
            Route::get('/mobile-app-development', [ServiceController::class, 'mobileAppDevelopment'])->name('en.services.mobile-app-development');
            Route::get('/uiux-design', [ServiceController::class, 'uiuxDesign'])->name('en.services.uiux-design');
        });

        Route::get('/service/consult', [ServiceController::class, 'consult'])->name('en.service.consult');
    });
});
