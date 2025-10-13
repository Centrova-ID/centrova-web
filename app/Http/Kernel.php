<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\TrackSessionActivity::class,
            \App\Http\Middleware\CleanupExpiredDevices::class,
            \App\Http\Middleware\TypoRedirectMiddleware::class,
            \App\Http\Middleware\CaptureFailedLogin::class,
            \App\Http\Middleware\SEOMiddleware::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's middleware aliases.
     *
     * Aliases may be used to conveniently assign middleware to routes and groups.
     *
     * @var array<string, class-string|string>
     */
    protected $middlewareAliases = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \App\Http\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'staff.auth' => \App\Http\Middleware\StaffAuth::class,
        'auto.staff.auth' => \App\Http\Middleware\AutoStaffAuth::class,
        'office.access' => \App\Http\Middleware\RestrictOfficeAccess::class,
        'block.customer' => \App\Http\Middleware\BlockCustomerAccess::class,
        'staff.role' => \App\Http\Middleware\StaffRole::class,
        'privacy.officer' => \App\Http\Middleware\PrivacyOfficerMiddleware::class,
        'multi.account' => \App\Http\Middleware\InitializeMultiAccount::class,
        'language' => \App\Http\Middleware\LanguageMiddleware::class,
        'require.password' => \App\Http\Middleware\RequirePasswordConfirmation::class,
        'typo.redirect' => \App\Http\Middleware\TypoRedirectMiddleware::class,
        'oauth' => \App\Http\Middleware\OAuthMiddleware::class,
        'oauth.rate' => \App\Http\Middleware\OAuthRateLimiter::class,
    ];
}
