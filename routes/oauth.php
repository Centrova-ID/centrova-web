<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OAuth\OAuthController;
use App\Http\Controllers\OAuth\OAuthClientController;

/*
|--------------------------------------------------------------------------
| OAuth Routes
|--------------------------------------------------------------------------
|
| Routes untuk sistem OAuth 2.0 Centrova
| Berdasarkan RFC 6749 - The OAuth 2.0 Authorization Framework
|
*/

// OpenID Connect Discovery
Route::get('/.well-known/openid_configuration', [OAuthController::class, 'discovery'])
    ->name('oauth.discovery');

// JWKS endpoint
Route::get('/.well-known/jwks.json', [OAuthController::class, 'jwks'])
    ->name('oauth.jwks');

// OAuth 2.0 Authorization Server endpoints
Route::prefix('oauth')->name('oauth.')->group(function () {
    
    // Authorization endpoint (RFC 6749 Section 3.1)
    Route::get('/authorize', [OAuthController::class, 'showAuthorizationForm'])
        ->middleware(['oauth.rate:authorize'])
        ->name('authorize');
    
    // Authorization approval/denial
    Route::post('/authorize', [OAuthController::class, 'approve'])
        ->middleware(['oauth.rate:authorize'])
        ->name('approve');
    
    // Token endpoint (RFC 6749 Section 3.2)
    Route::post('/token', [OAuthController::class, 'token'])
        ->middleware(['oauth.rate:token'])
        ->name('token');
    
    // Token revocation endpoint (RFC 7009)
    Route::post('/revoke', [OAuthController::class, 'revoke'])
        ->middleware(['oauth.rate:revoke'])
        ->name('revoke');
    
    // UserInfo endpoint (OpenID Connect Core 1.0 Section 5.3)
    Route::get('/userinfo', [OAuthController::class, 'userinfo'])
        ->middleware(['oauth.rate:userinfo'])
        ->name('userinfo');
    
    // Client Management (untuk developer)
    Route::middleware(['auth'])->prefix('clients')->name('clients.')->group(function () {
        Route::get('/', [OAuthClientController::class, 'index'])->name('index');
        Route::get('/create', [OAuthClientController::class, 'create'])->name('create');
        Route::post('/', [OAuthClientController::class, 'store'])->name('store');
        Route::get('/{client}', [OAuthClientController::class, 'show'])->name('show');
        Route::get('/{client}/edit', [OAuthClientController::class, 'edit'])->name('edit');
        Route::put('/{client}', [OAuthClientController::class, 'update'])->name('update');
        Route::delete('/{client}', [OAuthClientController::class, 'destroy'])->name('destroy');
        Route::post('/{client}/regenerate-secret', [OAuthClientController::class, 'regenerateSecret'])->name('regenerate-secret');
        Route::post('/{client}/toggle-status', [OAuthClientController::class, 'toggleStatus'])->name('toggle-status');
        Route::get('/{client}/tokens', [OAuthClientController::class, 'tokens'])->name('tokens');
    });
});

// API endpoints yang dilindungi OAuth
Route::prefix('api/v1')->middleware(['oauth'])->name('api.v1.')->group(function () {
    
    // User profile (membutuhkan scope 'profile')
    Route::middleware(['oauth:profile'])->group(function () {
        Route::get('/me', function (Illuminate\Http\Request $request) {
            $user = $request->oauth_user;
            $scopes = $request->oauth_scopes;
            
            $response = [
                'id' => $user->id,
                'username' => $user->username,
                'name' => $user->name,
            ];
            
            if (in_array('email', $scopes)) {
                $response['email'] = $user->email;
                $response['email_verified'] = !is_null($user->email_verified_at);
            }
            
            if (in_array('phone', $scopes) && $user->phone) {
                $response['phone'] = $user->phone;
            }
            
            if (in_array('address', $scopes) && $user->address) {
                $response['address'] = $user->address;
            }
            
            return response()->json($response);
        })->name('me');
    });
    
    // Protected resource examples
    Route::middleware(['oauth:read'])->group(function () {
        Route::get('/profile', function (Illuminate\Http\Request $request) {
            return response()->json([
                'user' => $request->oauth_user,
                'client' => $request->oauth_client->name,
                'scopes' => $request->oauth_scopes
            ]);
        })->name('profile');
    });
});

// Routes untuk testing OAuth (development only)
if (app()->environment('local')) {
    Route::prefix('oauth/test')->name('oauth.test.')->group(function () {
        
        // Test client credentials
        Route::get('/client', function () {
            $client = \App\Models\OAuth\OAuthClient::where('name', 'Test Application')->first();
            
            if (!$client) {
                $client = \App\Models\OAuth\OAuthClient::create([
                    'name' => 'Test Application',
                    'description' => 'Aplikasi test untuk development OAuth',
                    'redirect_uris' => ['http://localhost:3000/callback'],
                    'scopes' => ['openid', 'profile', 'email'],
                    'user_id' => 1,
                    'website_url' => 'http://localhost:3000'
                ]);
            }
            
            return response()->json([
                'client_id' => $client->client_id,
                'client_secret' => $client->client_secret,
                'redirect_uris' => $client->redirect_uris,
                'scopes' => $client->scopes
            ]);
        })->name('client');
        
        // Test authorization URL
        Route::get('/auth-url', function (Illuminate\Http\Request $request) {
            $client = \App\Models\OAuth\OAuthClient::where('name', 'Test Application')->first();
            
            if (!$client) {
                return response()->json(['error' => 'Test client not found. Call /oauth/test/client first.']);
            }
            
            $params = [
                'response_type' => 'code',
                'client_id' => $client->client_id,
                'redirect_uri' => $client->redirect_uris[0],
                'scope' => 'openid profile email',
                'state' => \Illuminate\Support\Str::random(32)
            ];
            
            $authUrl = route('oauth.authorize') . '?' . http_build_query($params);
            
            return response()->json([
                'authorization_url' => $authUrl,
                'params' => $params
            ]);
        })->name('auth-url');
    });
}

// Documentation routes
Route::prefix('oauth/docs')->name('oauth.docs.')->group(function () {
    Route::get('/', [App\Http\Controllers\OAuth\OAuthDocsController::class, 'index'])->name('index');
    Route::get('/developer-guide', [App\Http\Controllers\OAuth\OAuthDocsController::class, 'developerGuide'])->name('guide');
    Route::get('/api-reference', [App\Http\Controllers\OAuth\OAuthDocsController::class, 'apiReference'])->name('api');
    Route::get('/examples', [App\Http\Controllers\OAuth\OAuthDocsController::class, 'examples'])->name('examples');
    Route::get('/openapi.json', [App\Http\Controllers\OAuth\OAuthDocsController::class, 'openApiSpec'])->name('openapi');
});
