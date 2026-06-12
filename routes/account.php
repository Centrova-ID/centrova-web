<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AccountController;
use App\Http\Controllers\Account\ProfileController as AccountProfileController;
use App\Http\Controllers\Account\SecurityController;
use App\Http\Controllers\Account\MultiAccountController;
use App\Http\Controllers\Account\DataRightsController;
use App\Http\Controllers\ServiceCancellationController;
use App\Http\Controllers\PrivacyRequestController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Account Subdomain Routes (account.centrova.id)
|--------------------------------------------------------------------------
*/

Route::domain('account.centrova.id')->middleware(['web'])->group(function () {
    // Login routes - accessible for both guest and auth users (for confirm-password mode)
    Route::get('/login', [AccountController::class, 'loginView'])->name('login');
    Route::post('/login', [AccountController::class, 'login'])->name('login.post');
    
    // Download data for suspended accounts - accessible without auth
    Route::get('/download-account-data', [\App\Http\Controllers\Account\DataDownloadController::class, 'downloadAccountData'])->name('account.download.data');
    
    // Guest only routes
    Route::middleware('guest')->group(function () {
        Route::get('/register', [AccountController::class, 'registerView'])->name('register');
        Route::post('/register', [AccountController::class, 'register'])->name('register.post');
        
        // Two Factor Authentication verification routes (outside auth middleware)
        Route::get('/two-factor/verify', [\App\Http\Controllers\Auth\TwoFactorAuthController::class, 'showVerification'])->name('two-factor.verify');
        Route::post('/two-factor/verify', [\App\Http\Controllers\Auth\TwoFactorAuthController::class, 'verify'])->name('two-factor.verify.post');
        Route::post('/two-factor/recovery', [\App\Http\Controllers\Auth\TwoFactorAuthController::class, 'verifyRecovery'])->name('two-factor.recovery');
        
        // New integrated 2FA routes through login page
        Route::post('/login/2fa/pin', [AccountController::class, 'verify2FAPin'])->name('login.2fa.pin');
        Route::post('/login/2fa/whatsapp', [AccountController::class, 'verify2FAWhatsApp'])->name('login.2fa.whatsapp');
        Route::post('/login/2fa/recovery', [AccountController::class, 'verify2FARecovery'])->name('login.2fa.recovery');
        
        // WhatsApp 2FA verification routes
        Route::get('/two-factor/whatsapp/verify', [\App\Http\Controllers\Auth\WhatsAppTwoFactorController::class, 'showVerification'])->name('two-factor.whatsapp.verify');
        Route::post('/two-factor/whatsapp/verify', [\App\Http\Controllers\Auth\WhatsAppTwoFactorController::class, 'verifyOtp'])->name('two-factor.whatsapp.verify.post');
        Route::post('/two-factor/whatsapp/send-otp', [\App\Http\Controllers\Auth\WhatsAppTwoFactorController::class, 'sendOtp'])->name('two-factor.whatsapp.send-otp');
        Route::post('/two-factor/whatsapp/resend-otp', [\App\Http\Controllers\Auth\WhatsAppTwoFactorController::class, 'resendOtp'])->name('two-factor.whatsapp.resend-otp');
        Route::get('/two-factor/switch-to-pin', [\App\Http\Controllers\Auth\WhatsAppTwoFactorController::class, 'switchToPin'])->name('two-factor.switch-to-pin');
    });

    // Public Domain Search Routes (accessible without auth)
    Route::prefix('domain')->name('domain.')->group(function () {
        Route::get('/search', [\App\Http\Controllers\DomainController::class, 'index'])->name('search.index');
        Route::post('/search', [\App\Http\Controllers\DomainController::class, 'search'])->name('search.post');
        Route::get('/cart/count', [\App\Http\Controllers\DomainController::class, 'getCartCount'])->name('cart.count');
        Route::post('/cart/add', [\App\Http\Controllers\DomainController::class, 'addToCart'])->name('cart.add');
        Route::get('/cart', [\App\Http\Controllers\DomainController::class, 'showCart'])->name('cart.index');
    });

    // Authenticated routes
    Route::middleware(['auth', 'multi.account'])->group(function () {
        Route::post('/logout', [AccountController::class, 'logout'])->name('logout');
        Route::get('/', [AccountController::class, 'account'])->name('account');
        Route::get('/account', [AccountController::class, 'account']);
        
        // Real-time API endpoints for account data
        Route::prefix('api')->group(function () {
            Route::get('/security-score', [AccountController::class, 'getSecurityScore'])->name('api.security-score');
            Route::get('/device-data', [AccountController::class, 'getDeviceData'])->name('api.device-data');
            Route::get('/recent-activities', [AccountController::class, 'getRecentActivities'])->name('api.recent-activities');
        });
        
        // Password confirmation routes (for authenticated users)
        Route::get('/confirm-password', [AccountController::class, 'showConfirmPassword'])->name('confirm-password');
        Route::post('/confirm-password', [AccountController::class, 'confirmPassword'])->name('confirm-password.post');
        
        Route::get('/dashboard', function () {
            return view('auth.dashboard', ['user' => Auth::user()]);
        })->name('dashboard');
        
        // Profile Management Routes
        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/', [AccountProfileController::class, 'index'])->name('index');
            Route::put('/basic', [AccountProfileController::class, 'updateBasic'])->name('update-basic');
            Route::put('/address', [AccountProfileController::class, 'updateAddress'])->name('update-address');
            Route::post('/profile-picture', [AccountProfileController::class, 'updateProfilePicture'])->name('update-picture');
            Route::delete('/profile-picture', [AccountProfileController::class, 'removeProfilePicture'])->name('remove-picture');
            Route::get('/category-images', [AccountProfileController::class, 'getCategoryImages'])->name('get-category-images');
            Route::put('/password', [AccountProfileController::class, 'updatePassword'])->name('update-password');
        });
        
        // Multi-Account Management Routes
        Route::prefix('accounts')->name('accounts.')->group(function () {
            Route::get('/', [MultiAccountController::class, 'index'])->name('index');
            Route::get('/switcher', [MultiAccountController::class, 'showSwitcher'])->name('switcher');
            Route::get('/add', [MultiAccountController::class, 'showAddAccount'])->name('add.show');
            Route::post('/switch', [MultiAccountController::class, 'switch'])->name('switch');
            Route::post('/add', [MultiAccountController::class, 'addAccount'])->name('add');
            Route::delete('/remove', [MultiAccountController::class, 'removeAccount'])->name('remove');
            Route::post('/logout-current', [MultiAccountController::class, 'logoutCurrent'])->name('logout-current');
            Route::post('/logout-all', [MultiAccountController::class, 'logoutAll'])->name('logout-all');
        });
        
        // Security Management Routes
        Route::prefix('security')->name('security.')->group(function () {
            // Security Dashboard and Management
            Route::get('/', [SecurityController::class, 'index'])->name('index');
            Route::get('/login-activities', [SecurityController::class, 'loginActivities'])->name('login-activities');
            Route::get('/recovery-codes', [SecurityController::class, 'showRecoveryCodesGeneration'])->name('recovery-codes');
            
            // Password Management
            Route::get('/password/edit', [SecurityController::class, 'editPassword'])->name('password.edit');
            Route::get('/password/signinoption', [SecurityController::class, 'signinOption'])->name('password.signinoption');
            Route::put('/password', [SecurityController::class, 'updatePassword'])->name('password.update');
            
            // Two Factor Authentication Routes
            Route::prefix('two-factor')->name('two-factor.')->group(function () {
                Route::get('/', [\App\Http\Controllers\Auth\TwoFactorAuthController::class, 'index'])->name('index');
                Route::post('/', [\App\Http\Controllers\Auth\TwoFactorAuthController::class, 'index'])->name('index.post');
                Route::get('/enable', [\App\Http\Controllers\Auth\TwoFactorAuthController::class, 'showEnable'])->name('enable.form');
                Route::post('/enable', [\App\Http\Controllers\Auth\TwoFactorAuthController::class, 'enable'])->name('enable');
                Route::get('/disable', [\App\Http\Controllers\Auth\TwoFactorAuthController::class, 'showDisable'])->name('disable.form');
                Route::post('/disable', [\App\Http\Controllers\Auth\TwoFactorAuthController::class, 'disable'])->name('disable');
                Route::post('/recovery-codes', [\App\Http\Controllers\Auth\TwoFactorAuthController::class, 'generateRecoveryCodes'])->name('recovery-codes');
                Route::delete('/devices/{deviceId}', [\App\Http\Controllers\Auth\TwoFactorAuthController::class, 'revokeDevice'])->name('device.revoke');
                
                // WhatsApp 2FA management routes
                Route::post('/whatsapp/toggle', [\App\Http\Controllers\Auth\TwoFactorAuthController::class, 'toggleWhatsApp'])->name('whatsapp.toggle');
                Route::post('/set-preferred-method', [\App\Http\Controllers\Auth\TwoFactorAuthController::class, 'setPreferredMethod'])->name('set-preferred-method');
                
                // WhatsApp 2FA detailed management
                Route::prefix('whatsapp')->name('whatsapp.')->group(function () {
                    Route::get('/', [\App\Http\Controllers\Auth\TwoFactorAuthController::class, 'whatsappIndex'])->name('index');
                    Route::post('/add-phone', [\App\Http\Controllers\Auth\TwoFactorAuthController::class, 'addPhone'])->name('add-phone');
                    Route::post('/set-active', [\App\Http\Controllers\Auth\TwoFactorAuthController::class, 'setActivePhone'])->name('set-active');
                    Route::post('/resend-verification', [\App\Http\Controllers\Auth\TwoFactorAuthController::class, 'resendPhoneVerification'])->name('resend-verification');
                    Route::delete('/remove-phone', [\App\Http\Controllers\Auth\TwoFactorAuthController::class, 'removePhone'])->name('remove-phone');
                });
                
                // Device trust management
                Route::post('/toggle-device-trust', [\App\Http\Controllers\Auth\TwoFactorAuthController::class, 'toggleDeviceTrust'])->name('toggle-device-trust');
            });
            
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
            
            // Login Alerts/Notifications
            Route::get('/login-alerts', [SecurityController::class, 'loginAlerts'])->name('login-alerts');
            Route::get('/login-alerts/detail', [SecurityController::class, 'loginAlertDetail'])->name('login-alerts.detail');
            Route::post('/login-alerts/detail/mark-safe', [SecurityController::class, 'markLoginAlertSafe'])->name('login-alerts.mark-safe');
            Route::post('/login-alerts/detail/report-suspicious', [SecurityController::class, 'reportSuspiciousLogin'])->name('login-alerts.report');
            
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
        
        Route::get('/privacy', [AccountController::class, 'privacy'])->name('account.privacy');
        Route::get('/subscription', [AccountController::class, 'subscription'])->name('account.subscription');
        
        // Domain Management Routes
        Route::prefix('domains')->name('domains.')->group(function () {
            Route::get('/', [\App\Http\Controllers\DomainController::class, 'index'])->name('index');
            Route::get('/search', [\App\Http\Controllers\DomainController::class, 'index'])->name('search');
            Route::post('/search', [\App\Http\Controllers\DomainController::class, 'search'])->name('search.post');
            Route::get('/dashboard', [\App\Http\Controllers\DomainController::class, 'dashboard'])->name('dashboard');
            Route::get('/cart', [\App\Http\Controllers\DomainController::class, 'showCart'])->name('cart');
            Route::get('/cart/count', [\App\Http\Controllers\DomainController::class, 'getCartCount'])->name('cart.count');
            Route::post('/cart/add', [\App\Http\Controllers\DomainController::class, 'addToCart'])->name('cart.add');
            Route::delete('/cart/remove', [\App\Http\Controllers\DomainController::class, 'removeFromCart'])->name('cart.remove');
            Route::delete('/cart/clear', [\App\Http\Controllers\DomainController::class, 'clearCart'])->name('cart.clear');
            
            // Checkout Routes
            Route::get('/checkout', [\App\Http\Controllers\DomainCheckoutController::class, 'index'])->name('checkout.index');
            Route::post('/checkout', [\App\Http\Controllers\DomainCheckoutController::class, 'process'])->name('checkout.process');
            Route::get('/checkout/success/{order}', [\App\Http\Controllers\DomainCheckoutController::class, 'success'])->name('checkout.success');
            Route::get('/checkout/failed/{order}', [\App\Http\Controllers\DomainCheckoutController::class, 'failed'])->name('checkout.failed');
            
            // Domain Management
            Route::get('/{domain}', [\App\Http\Controllers\DomainController::class, 'show'])->name('show');
            Route::get('/{domain}/renew', [\App\Http\Controllers\DomainController::class, 'showRenewal'])->name('renew');
            Route::post('/{domain}/renew', [\App\Http\Controllers\DomainController::class, 'processRenewal'])->name('renew.process');
            Route::get('/{domain}/nameservers', [\App\Http\Controllers\DomainController::class, 'showNameservers'])->name('nameservers');
            Route::post('/{domain}/nameservers', [\App\Http\Controllers\DomainController::class, 'updateNameservers'])->name('nameservers.update');
            Route::post('/{domain}/auto-renew', [\App\Http\Controllers\DomainController::class, 'toggleAutoRenewal'])->name('auto-renew.toggle');
            Route::post('/{domain}/sync', [\App\Http\Controllers\DomainController::class, 'sync'])->name('sync');
            
            // Orders
            Route::get('/orders', [\App\Http\Controllers\DomainController::class, 'orders'])->name('orders.index');
            Route::get('/orders/{order}', [\App\Http\Controllers\DomainController::class, 'showOrder'])->name('orders.show');
        });
        
        // GDPR Data Rights Management
        Route::prefix('data-rights')->name('data-rights.')->group(function () {
            Route::get('/', [DataRightsController::class, 'index'])->name('index');
            Route::post('/export', [DataRightsController::class, 'exportData'])->name('export');
            Route::get('/download/{category}', [DataRightsController::class, 'downloadDataCategory'])->name('download-category');
            Route::post('/rectify', [DataRightsController::class, 'rectifyData'])->name('rectify');
            Route::post('/delete', [DataRightsController::class, 'requestDeletion'])->name('delete');
        });
        
        // Multi-Account Demo
        Route::get('/multi-account-demo', function () {
            return view('auth.multi-account-demo');
        })->name('multi-account.demo');
        
        // Service Cancellation Routes
        Route::prefix('services')->group(function () {
            Route::get('/cancellation', [ServiceCancellationController::class, 'index'])->name('services.cancellation.index');
            Route::get('/cancellation/{id}', [ServiceCancellationController::class, 'show'])->name('services.cancellation.show');
            Route::post('/cancellation/{id}/cancel', [ServiceCancellationController::class, 'cancel'])->name('services.cancellation.cancel');
        });
    });

    // Privacy Request Routes (Public - available without auth)
    Route::prefix('privacy')->name('privacy.')->group(function () {
        Route::get('/request', [PrivacyRequestController::class, 'showForm'])->name('request.form');
        Route::post('/request', [PrivacyRequestController::class, 'submitRequest'])->name('request.submit');
        Route::post('/request/status', [PrivacyRequestController::class, 'checkStatus'])->name('request.status');
    });
});
