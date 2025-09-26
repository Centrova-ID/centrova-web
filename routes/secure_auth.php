<?php

/*
|--------------------------------------------------------------------------
| Secure Authentication Routes
|--------------------------------------------------------------------------
|
| Routes dengan implementasi security enhancements untuk sistem autentikasi
| Termasuk rate limiting, security headers, dan logging
|
*/

use App\Http\Controllers\Auth\SecureLoginController;
use Illuminate\Support\Facades\Route;

// Apply security headers to all auth routes
Route::middleware(['web', 'guest'])->group(function () {
    
    // Login routes with enhanced rate limiting
    Route::middleware(['advanced.rate.limit:login'])->group(function () {
        Route::get('/login', function () {
            return view('auth.login');
        })->name('login');
        
        Route::post('/login', [SecureLoginController::class, 'login'])
             ->name('login.post');
    });

    // 2FA verification routes
    Route::middleware(['advanced.rate.limit:2fa'])->group(function () {
        Route::post('/2fa/verify-pin', [SecureLoginController::class, 'verify2FA'])
             ->name('login.2fa.pin');
        
        Route::post('/2fa/verify-whatsapp', [SecureLoginController::class, 'verifyWhatsApp'])
             ->name('login.2fa.whatsapp');
    });

    // Recovery routes with stricter rate limiting
    Route::middleware(['advanced.rate.limit:recovery'])->group(function () {
        Route::post('/2fa/recovery', [SecureLoginController::class, 'verifyRecovery'])
             ->name('login.2fa.recovery');
    });

    // Password reset routes
    Route::middleware(['advanced.rate.limit:password_reset'])->group(function () {
        Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')
             ->name('password.request');
        
        Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')
             ->name('password.email');
        
        Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')
             ->name('password.reset');
        
        Route::post('/password/reset', 'Auth\ResetPasswordController@reset')
             ->name('password.update');
    });

    // Registration routes (if enabled)
    Route::middleware(['advanced.rate.limit:registration'])->group(function () {
        Route::get('/register', 'Auth\RegisterController@showRegistrationForm')
             ->name('register');
        
        Route::post('/register', 'Auth\RegisterController@register')
             ->name('register.post');
    });
});

// Logout route for authenticated users
Route::middleware(['web', 'auth'])->group(function () {
    Route::post('/logout', function () {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        
        // Log logout event
        logger()->channel('security')->info('User logged out', [
            'user_id' => auth()->id(),
            'ip' => request()->ip(),
        ]);
        
        return redirect('/');
    })->name('logout');
});

/*
|--------------------------------------------------------------------------
| Admin/Staff Authentication Routes
|--------------------------------------------------------------------------
|
| Separate routes for staff/admin with additional security measures
|
*/

Route::prefix('staff')->middleware(['web', 'guest'])->group(function () {
    
    // Staff login with stricter rate limiting
    Route::middleware(['advanced.rate.limit:staff_login'])->group(function () {
        Route::get('/login', function () {
            return view('auth.login', ['isStaffLogin' => true]);
        })->name('staff.login');
        
        Route::post('/login', 'Auth\StaffLoginController@login')
             ->name('staff.login.submit');
    });
    
    // Staff password reset
    Route::middleware(['advanced.rate.limit:staff_password_reset'])->group(function () {
        Route::get('/password/reset', 'Auth\StaffForgotPasswordController@showLinkRequestForm')
             ->name('staff.password.request');
        
        Route::post('/password/email', 'Auth\StaffForgotPasswordController@sendResetLinkEmail')
             ->name('staff.password.email');
    });
});

/*
|--------------------------------------------------------------------------
| API Authentication Routes
|--------------------------------------------------------------------------
|
| API routes for mobile/SPA authentication with API rate limiting
|
*/

Route::prefix('api/auth')->middleware(['api'])->group(function () {
    
    // API login with API-specific rate limiting
    Route::middleware(['advanced.rate.limit:api_login'])->group(function () {
        Route::post('/login', 'Api\AuthController@login');
        Route::post('/refresh', 'Api\AuthController@refresh');
    });
    
    // API registration
    Route::middleware(['advanced.rate.limit:api_registration'])->group(function () {
        Route::post('/register', 'Api\AuthController@register');
    });
    
    // Authenticated API routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', 'Api\AuthController@logout');
        Route::get('/me', 'Api\AuthController@me');
    });
});

/*
|--------------------------------------------------------------------------
| Security Testing Routes (DEVELOPMENT ONLY)
|--------------------------------------------------------------------------
|
| Routes untuk testing security measures - hanya untuk development
|
*/

if (app()->environment(['local', 'development', 'testing'])) {
    Route::prefix('security-test')->middleware(['web'])->group(function () {
        
        // Test rate limiting
        Route::get('/rate-limit-test', function () {
            return response()->json([
                'message' => 'Rate limit test endpoint',
                'timestamp' => now()->toISOString(),
                'ip' => request()->ip(),
            ]);
        })->middleware(['advanced.rate.limit:test']);
        
        // Test security headers
        Route::get('/headers-test', function () {
            return response('<h1>Security Headers Test</h1><p>Check response headers</p>')
                  ->header('Content-Type', 'text/html');
        });
        
        // Test redirect sanitization
        Route::post('/redirect-test', function () {
            $redirect = \App\Helpers\SecurityHelper::sanitizeRedirectTarget(request(), '/safe-default');
            return response()->json([
                'original' => request('redirect'),
                'sanitized' => $redirect,
            ]);
        });
    });
}
