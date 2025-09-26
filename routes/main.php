<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Services\ServiceInquiryController;
use App\Http\Controllers\Account\MultiAccountController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\PrivacyRequestController;
use App\Http\Controllers\WebUIController;

/*
|--------------------------------------------------------------------------
| Main Domain Routes (centrova.test)
|--------------------------------------------------------------------------
*/

// Indonesian routes (default - no prefix)
Route::domain('centrova.test')->middleware(['web', 'language'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/products', [HomeController::class, 'products'])->name('home.products.index');
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    Route::post('/contact', [HomeController::class, 'sendContact'])->name('contact.send');
    Route::get('/team', [HomeController::class, 'teamIndex'])->name('team.index');
    Route::get('/team/{slug}', [HomeController::class, 'teamProfile'])->name('team.profile');
    Route::get('/sitemap', [SitemapController::class, 'index'])->name('sitemap');
    Route::get('/search', [HomeController::class, 'search'])->name('search');
    Route::get('/search/suggestions', [HomeController::class, 'searchSuggestions'])->name('search.suggestions');

    // Legal Routes
    Route::prefix('legal')->group(function () {
        Route::get('/', [LegalController::class, 'index'])->name('legal.index');
        Route::get('/privacy', [LegalController::class, 'privacy'])->name('legal.privacy');
        Route::get('/privacy.pdf', [LegalController::class, 'privacyPdf'])->name('legal.privacy.pdf');
        Route::get('/privacy/contact', [LegalController::class, 'privacyContact'])->name('legal.privacy.contact');
        Route::post('/privacy/contact', [LegalController::class, 'submitPrivacyContact'])->name('legal.privacy.contact.submit');
        Route::get('/terms', [LegalController::class, 'terms'])->name('legal.terms');
        Route::get('/license', [LegalController::class, 'license'])->name('legal.license');
        Route::get('/trademark', [LegalController::class, 'trademark'])->name('legal.trademark');
        Route::get('/copyright', [LegalController::class, 'copyright'])->name('legal.copyright');
        Route::get('/compliance', [LegalController::class, 'compliance'])->name('legal.compliance');
        Route::get('/opensource', [LegalController::class, 'opensource'])->name('legal.opensource');
        Route::get('/cookies', [LegalController::class, 'cookies'])->name('legal.cookies');
        Route::get('/support-terms', [LegalController::class, 'supportTerms'])->name('legal.support-terms');
        Route::get('/retail-terms', [LegalController::class, 'retailTerms'])->name('legal.retail-terms');
        Route::get('/disclaimer', [LegalController::class, 'disclaimer'])->name('legal.disclaimer');
    });

    // Privacy Request Routes (Public)
    Route::prefix('privacy')->name('privacy.')->group(function () {
        Route::get('/request', [PrivacyRequestController::class, 'showForm'])->name('request.form');
        Route::post('/request', [PrivacyRequestController::class, 'submitRequest'])->name('request.submit');
        Route::post('/request/status', [PrivacyRequestController::class, 'checkStatus'])->name('request.status');
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
        
    // Service Inquiry Routes
    Route::get('/inquiry', [ServiceInquiryController::class, 'create'])->name('services.inquiry.create');
    Route::post('/inquiry', [ServiceInquiryController::class, 'store'])->name('services.inquiry.store');
    
    // Portfolio routes for web services
    Route::get('/web/{slug}/{page?}', [ServiceController::class, 'webPortfolio'])->name('services.web.portfolio');
    
    // Backward compatibility routes
    Route::get('/web-development', [ServiceController::class, 'webDevelopment'])->name('services.web-development');
    Route::get('/app-development', [ServiceController::class, 'appDevelopment'])->name('services.app-development');
    Route::get('/mobile-app-development', [ServiceController::class, 'mobileAppDevelopment'])->name('services.mobile-app-development');
    Route::get('/uiux-design', [ServiceController::class, 'uiuxDesign'])->name('services.uiux-design');
});

    // Multi-Account Management Routes untuk domain utama
    Route::middleware(['auth', 'multi.account'])->prefix('accounts')->name('main.accounts.')->group(function () {
        Route::post('/switch', [MultiAccountController::class, 'switch'])->name('switch');
        Route::post('/add', [MultiAccountController::class, 'addAccount'])->name('add');
        Route::delete('/remove', [MultiAccountController::class, 'removeAccount'])->name('remove');
        Route::post('/logout-current', [MultiAccountController::class, 'logoutCurrent'])->name('logout-current');
        Route::post('/logout-all', [MultiAccountController::class, 'logoutAll'])->name('logout-all');
    });    // English routes (with /en prefix)
    Route::prefix('en')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('en.home');
        Route::get('/products', [HomeController::class, 'products'])->name('en.home.products.index');
        Route::get('/about', [HomeController::class, 'about'])->name('en.about');
        Route::get('/contact', [HomeController::class, 'contact'])->name('en.contact');
        Route::post('/contact', [HomeController::class, 'sendContact'])->name('en.contact.send');
        Route::get('/team', [HomeController::class, 'teamIndex'])->name('en.team.index');
        Route::get('/team/{slug}', [HomeController::class, 'teamProfile'])->name('en.team.profile');
        Route::get('/sitemap', [SitemapController::class, 'index'])->name('en.sitemap');
        Route::get('/search', [HomeController::class, 'search'])->name('en.search');
        Route::get('/search/suggestions', [HomeController::class, 'searchSuggestions'])->name('en.search.suggestions');

        // English Legal Routes
        Route::prefix('legal')->group(function () {
            Route::get('/', [LegalController::class, 'index'])->name('en.legal.index');
            Route::get('/privacy', [LegalController::class, 'privacy'])->name('en.legal.privacy');
            Route::get('/privacy/contact', [LegalController::class, 'privacyContact'])->name('en.legal.privacy.contact');
            Route::get('/terms', [LegalController::class, 'terms'])->name('en.legal.terms');
            Route::get('/license', [LegalController::class, 'license'])->name('en.legal.license');
            Route::get('/trademark', [LegalController::class, 'trademark'])->name('en.legal.trademark');
            Route::get('/copyright', [LegalController::class, 'copyright'])->name('en.legal.copyright');
            Route::get('/compliance', [LegalController::class, 'compliance'])->name('en.legal.compliance');
            Route::get('/opensource', [LegalController::class, 'opensource'])->name('en.legal.opensource');
            Route::get('/cookies', [LegalController::class, 'cookies'])->name('en.legal.cookies');
            Route::get('/support-terms', [LegalController::class, 'supportTerms'])->name('en.legal.support-terms');
            Route::get('/retail-terms', [LegalController::class, 'retailTerms'])->name('en.legal.retail-terms');
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
            
            // Service Inquiry Routes
            Route::get('/inquiry', [ServiceInquiryController::class, 'create'])->name('en.services.inquiry.create');
            Route::post('/inquiry', [ServiceInquiryController::class, 'store'])->name('en.services.inquiry.store');
            
            // Portfolio routes for web services
            Route::get('/web/{slug}/{page?}', [ServiceController::class, 'webPortfolio'])->name('en.services.web.portfolio');
            
            // Backward compatibility routes
            Route::get('/web-development', [ServiceController::class, 'webDevelopment'])->name('en.services.web-development');
            Route::get('/app-development', [ServiceController::class, 'appDevelopment'])->name('en.services.app-development');
            Route::get('/mobile-app-development', [ServiceController::class, 'mobileAppDevelopment'])->name('en.services.mobile-app-development');
            Route::get('/uiux-design', [ServiceController::class, 'uiuxDesign'])->name('en.services.uiux-design');
        });
        
        // Multi-Account Management Routes untuk English routes
        Route::middleware(['auth', 'multi.account'])->prefix('accounts')->name('en.accounts.')->group(function () {
            Route::post('/switch', [MultiAccountController::class, 'switch'])->name('switch');
            Route::post('/add', [MultiAccountController::class, 'addAccount'])->name('add');
            Route::delete('/remove', [MultiAccountController::class, 'removeAccount'])->name('remove');
            Route::post('/logout-current', [MultiAccountController::class, 'logoutCurrent'])->name('logout-current');
            Route::post('/logout-all', [MultiAccountController::class, 'logoutAll'])->name('logout-all');
        });
    });

    // Web UI Routes
    Route::prefix('web-ui')->name('webui.')->group(function () {
        Route::get('/', [WebUIController::class, 'index'])->name('index');
        Route::get('/{category}', [WebUIController::class, 'category'])->name('category');
    });
});
