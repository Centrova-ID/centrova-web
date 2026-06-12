<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Auth\AccountController;
use App\Http\Controllers\Account\ProfileController;
use App\Http\Controllers\Account\SecurityController;
use App\Http\Controllers\Account\MultiAccountController;
use App\Http\Controllers\ServiceCancellationController;

/*
|--------------------------------------------------------------------------
| Fallback & Mobile Routes
|--------------------------------------------------------------------------
*/

// Default routes (fallback)
Route::middleware(['web'])->group(function () {
    Route::get('/', [HomeController::class, 'index']);
});

Route::prefix('developer')->middleware(['web'])->group(function () {
    Route::get('/', function () { return view('developer.index'); });
    Route::get('/ui-kit', function () { return view('developer.ui-kit'); });
});

// Mobile access routes
Route::prefix('services')->middleware(['web'])->group(function () {
    Route::get('/', [ServiceController::class, 'index']);
    Route::get('/web', [ServiceController::class, 'webDevelopment']);
    Route::get('/app', [ServiceController::class, 'appDevelopment']);
    Route::get('/mobile-app', [ServiceController::class, 'mobileAppDevelopment']);
    Route::get('/uiux', [ServiceController::class, 'uiuxDesign']);
    Route::get('/custom-solution', [ServiceController::class, 'customSolution']);
    
    // Backward compatibility routes
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
    Route::get('/legal/support-terms', [LegalController::class, 'supportTerms']);
    Route::get('/legal/retail-terms', [LegalController::class, 'retailTerms']);
    Route::get('/legal/disclaimer', [LegalController::class, 'disclaimer']);
});

// Portfolio routes
Route::middleware(['web'])->group(function () {
    Route::get('/portfolio/{slug}', function ($slug) {
        $portfolioPath = public_path("portfolio/{$slug}.html");
        
        if (file_exists($portfolioPath)) {
            return response()->file($portfolioPath);
        }
        
        // Return default portfolio page if specific portfolio doesn't exist
        return response()->file(public_path('portfolio/default.html'));
    })->name('portfolio.show');
});

// Web Development Detail Routes
Route::middleware(['web'])->group(function () {
    Route::get('/services/web-development/{slug}', function ($slug) {
        $portfolioWebPath = public_path("portfolio/{$slug}.html");
        
        if (file_exists($portfolioWebPath)) {
            return response()->file($portfolioWebPath);
        }
        
        // Return default portfolio page if specific page doesn't exist
        return response()->file(public_path('portfolio/default.html'));
    })->name('services.web-development.detail');
});

Route::middleware(['web'])->group(function () {
    Route::get('/careers', function () { return view('careers.index'); })->name('careers.home');
});

/*
|--------------------------------------------------------------------------
| Rollback Routes for Subdomain Fallback
|--------------------------------------------------------------------------
| These routes serve as fallbacks when subdomains are not available.
| They use prefixes to maintain functionality without subdomain routing.
*/

// Support fallback routes (support.centrova.id -> /support/*)
// Fallback routes untuk support subdomain jika subdomain tidak bisa diakses
Route::prefix('support')->middleware(['web'])->group(function () {
    Route::get('/', function () { return view('support.index'); })->name('support.fallback.home');
    Route::get('/help', function () { return view('support.help.index'); })->name('support.fallback.help.home');
    Route::get('/web/consult', function () { return view('support.web.consult'); })->name('support.fallback.web.consult');
    Route::get('/web/consult/chat', [ChatController::class, 'index'])->middleware('auth')->name('support.fallback.web.chat');
    Route::get('/web/consult/chat/reply/{messageId}', function($messageId) {
        return redirect()->route('support.fallback.web.chat')->with('reply_to_message_id', $messageId);
    })->middleware('auth')->name('support.fallback.web.chat.reply');
    
    // Chat AJAX endpoints
    Route::post('/web/consult/chat/send', [ChatController::class, 'sendMessage'])->middleware('auth')->name('support.fallback.web.chat.send');
    Route::get('/web/consult/chat/messages/{conversation}', [ChatController::class, 'getNewMessages'])->middleware('auth')->name('support.fallback.web.chat.messages');
    Route::post('/web/consult/chat/close/{conversation}', [ChatController::class, 'closeConversation'])->middleware('auth')->name('support.fallback.web.chat.close');
    
    Route::get('/services', function () { return view('support.services.index'); })->name('support.fallback.services.home');
    Route::get('/services/web', function () { return view('support.services.web'); })->name('support.fallback.services.web');
    Route::get('/services/app', function () { return view('support.services.app'); })->name('support.fallback.services.app');
    Route::get('/services/mobile', function () { return view('support.services.mobile'); })->name('support.fallback.services.mobile');
    Route::get('/services/uiux', function () { return view('support.services.uiux'); })->name('support.fallback.services.uiux');
});

// Account fallback routes (account.centrova.id -> /account/*)
Route::prefix('account')->middleware(['web'])->group(function () {
    // Guest routes
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AccountController::class, 'loginView'])->name('account.fallback.login');
        Route::get('/register', [AccountController::class, 'registerView'])->name('account.fallback.register');
        Route::post('/login', [AccountController::class, 'login'])->name('account.fallback.login.post');
        Route::post('/register', [AccountController::class, 'register'])->name('account.fallback.register.post');
        
        // Integrated 2FA routes through login page
        Route::post('/login/2fa/pin', [AccountController::class, 'verify2FAPin'])->name('account.fallback.login.2fa.pin');
        Route::post('/login/2fa/whatsapp', [AccountController::class, 'verify2FAWhatsApp'])->name('account.fallback.login.2fa.whatsapp');
        Route::post('/login/2fa/recovery', [AccountController::class, 'verify2FARecovery'])->name('account.fallback.login.2fa.recovery');
    });

    // Authenticated routes
    Route::middleware(['auth', 'multi.account'])->group(function () {
        Route::post('/logout', [AccountController::class, 'logout'])->name('account.fallback.logout');
        Route::get('/', [AccountController::class, 'account'])->name('account.fallback.index');
        Route::get('/dashboard', function () {
            return view('auth.dashboard', ['user' => Auth::user()]);
        })->name('account.fallback.dashboard');
        
        // Profile Management Routes Fallback
        Route::prefix('profile')->name('account.fallback.profile.')->group(function () {
            Route::get('/', [ProfileController::class, 'index'])->name('index');
            Route::put('/basic', [ProfileController::class, 'updateBasic'])->name('update-basic');
            Route::put('/address', [ProfileController::class, 'updateAddress'])->name('update-address');
            Route::put('/emergency-contact', [ProfileController::class, 'updateEmergencyContact'])->name('update-emergency');
            Route::put('/preferences', [ProfileController::class, 'updatePreferences'])->name('update-preferences');
            Route::post('/profile-picture', [ProfileController::class, 'updateProfilePicture'])->name('update-picture');
            Route::delete('/profile-picture', [ProfileController::class, 'removeProfilePicture'])->name('remove-picture');
            Route::put('/password', [ProfileController::class, 'updatePassword'])->name('update-password');
        });
        
        // Multi-Account Management Routes Fallback
        Route::prefix('accounts')->name('account.fallback.accounts.')->group(function () {
            Route::get('/', [MultiAccountController::class, 'index'])->name('index');
            Route::get('/switcher', [MultiAccountController::class, 'showSwitcher'])->name('switcher');
            Route::get('/add', [MultiAccountController::class, 'showAddAccount'])->name('add.show');
            Route::post('/switch', [MultiAccountController::class, 'switch'])->name('switch');
            Route::post('/add', [MultiAccountController::class, 'addAccount'])->name('add');
            Route::delete('/remove', [MultiAccountController::class, 'removeAccount'])->name('remove');
            Route::post('/logout-current', [MultiAccountController::class, 'logoutCurrent'])->name('logout-current');
            Route::post('/logout-all', [MultiAccountController::class, 'logoutAll'])->name('logout-all');
        });
        
        // Security Management Routes Fallback
        Route::prefix('security')->name('account.fallback.security.')->group(function () {
            // Security Dashboard and Management
            Route::get('/', [SecurityController::class, 'index'])->name('index');
            Route::get('/login-activities', [SecurityController::class, 'loginActivities'])->name('login-activities');
            Route::get('/recovery-codes', [SecurityController::class, 'showRecoveryCodesGeneration'])->name('recovery-codes');
            
            // Password Management
            Route::get('/password/edit', [SecurityController::class, 'editPassword'])->name('password.edit');
            Route::get('/password/signinoption', [SecurityController::class, 'signinOption'])->name('password.signinoption');
            Route::put('/password', [SecurityController::class, 'updatePassword'])->name('password.update');
            
            // Recovery Codes Management
            Route::post('/recovery-codes/generate', [SecurityController::class, 'generateRecoveryCodes'])->name('recovery-codes.generate');
            Route::post('/generate-codes', [SecurityController::class, 'generateRecoveryCodes'])->name('generate-codes');
            Route::post('/recovery-codes/revoke', [SecurityController::class, 'revokeRecoveryCodes'])->name('recovery-codes.revoke');
            Route::post('/revoke-codes', [SecurityController::class, 'revokeRecoveryCodes'])->name('revoke-codes');
            
            // Login Activities Management
            Route::get('/login-activities/download', [SecurityController::class, 'downloadLoginActivities'])->name('login-activities.download');
            Route::get('/download-activities', [SecurityController::class, 'downloadLoginActivities'])->name('download-activities');
            Route::post('/login-activities/{activityId}/mark-safe', [SecurityController::class, 'markActivityAsSafe'])->name('login-activities.mark-safe');
            
            // Device Management Routes
            Route::get('/devices', [SecurityController::class, 'devices'])->name('devices');
            Route::get('/device/{sessionId}', [SecurityController::class, 'deviceDetail'])->name('device.detail');
            Route::delete('/device/{sessionId}', [SecurityController::class, 'revokeDevice'])->name('device.revoke');
            Route::post('/device/revoke-all', [SecurityController::class, 'revokeAllDevices'])->name('device.revoke-all');
            Route::post('/device/force-revoke-all', [SecurityController::class, 'forceRevokeAllDevices'])->name('device.force-revoke-all');
            
            // Session Management
            Route::get('/sessions', [SecurityController::class, 'sessions'])->name('sessions');
            Route::post('/sessions/logout-others', [SecurityController::class, 'logoutOtherDevices'])->name('sessions.logout-others');
            Route::post('/sessions/logout-all', [SecurityController::class, 'logoutAllDevices'])->name('sessions.logout-all');
            Route::delete('/sessions/{sessionId}', [SecurityController::class, 'revokeSession'])->name('sessions.revoke');
            
            // Notifications Management (API Routes)
            Route::get('/notifications', [SecurityController::class, 'getNotifications'])->name('notifications.get');
            Route::post('/notifications/{notificationId}/read', [SecurityController::class, 'markNotificationAsRead'])->name('notifications.read');
            Route::delete('/notifications/{notificationId}', [SecurityController::class, 'deleteNotification'])->name('notifications.delete');
            Route::delete('/notifications', [SecurityController::class, 'clearNotifications'])->name('notifications.clear');
            
            // Real-time Updates (API Routes)
            Route::get('/api/session-count', [SecurityController::class, 'getSessionCount'])->name('api.session-count');
            Route::get('/api/security-score', [SecurityController::class, 'getSecurityScore'])->name('api.security-score');
            Route::get('/api/security-stats', [SecurityController::class, 'getSecurityStats'])->name('api.security-stats');
        });
        
        Route::get('/privacy', [AccountController::class, 'privacy'])->name('account.fallback.privacy');
        Route::get('/subscription', [AccountController::class, 'subscription'])->name('account.fallback.subscription');
        
        // Multi-Account Demo Fallback
        Route::get('/multi-account-demo', function () {
            return view('auth.multi-account-demo');
        })->name('account.fallback.multi-account.demo');
        
        // Service Cancellation Routes Fallback
        Route::prefix('services')->group(function () {
            Route::get('/cancellation', [ServiceCancellationController::class, 'index'])->name('account.fallback.services.cancellation.index');
            Route::get('/cancellation/{id}', [ServiceCancellationController::class, 'show'])->name('account.fallback.services.cancellation.show');
            Route::post('/cancellation/{id}/cancel', [ServiceCancellationController::class, 'cancel'])->name('account.fallback.services.cancellation.cancel');
        });
    });
});

// News fallback routes (news.centrova.id -> /news/*)
Route::prefix('news')->middleware(['web'])->group(function () {
    Route::get('/', function () { return view('news.index'); })->name('news.fallback.home');
    Route::get('/detail', function () { return view('news.detail'); })->name('news.fallback.detail');
    Route::get('/editor', function () { return view('news.editor'); })->name('news.fallback.create');
});

// Developer fallback routes (developer.centrova.id -> /developer/*)
Route::prefix('developer')->middleware(['web'])->group(function () {
    Route::get('/', function () { return view('developer.index'); })->name('developer.fallback.home');
    Route::get('/ui-kit', function () { return view('developer.ui-kit'); })->name('developer.fallback.ui-kit');
});

// Learn fallback routes (learn.centrova.id -> /learn/*)
Route::prefix('learn')->middleware(['web'])->group(function () {
    Route::get('/', function () { return view('learn.index'); })->name('learn.fallback.index');
});

// Docs fallback routes (docs.centrova.id -> /docs/*)
Route::prefix('docs')->middleware(['web'])->group(function () {
    Route::get('/services', function () { return view('docs.services.index'); })->name('docs.fallback.services.index');
    Route::get('/services/web', function () { return view('docs.services.web'); })->name('docs.fallback.services.web');
    Route::get('/services/app', function () { return view('docs.services.app'); })->name('docs.fallback.services.app');
    Route::get('/services/mobile', function () { return view('docs.services.mobile'); })->name('docs.fallback.services.mobile');
    Route::get('/services/uiux', function () { return view('docs.services.uiux'); })->name('docs.fallback.services.uiux');
});

// Main domain routes fallback (jika main domain juga perlu fallback)
Route::middleware(['web'])->group(function () {
    // Home routes with fallback naming
    Route::get('/home', [HomeController::class, 'index'])->name('home.fallback');
    Route::get('/products', [HomeController::class, 'products'])->name('home.fallback.products.index');
    Route::get('/about', [HomeController::class, 'about'])->name('about.fallback');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact.fallback');
    Route::post('/contact', [HomeController::class, 'sendContact'])->name('contact.fallback.send');
    Route::get('/sitemap', function () { return view('home.sitemap'); })->name('sitemap.fallback');
    Route::get('/search', [HomeController::class, 'search'])->name('search.fallback');
});
