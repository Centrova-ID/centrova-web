<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SSOController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// SSO Routes untuk Centrova Retail App
Route::prefix('sso')->group(function () {
    Route::post('/login', [SSOController::class, 'login']);
    Route::post('/verify-token', [SSOController::class, 'verifyToken']);
    Route::post('/logout', [SSOController::class, 'logout']);
    Route::get('/profile', [SSOController::class, 'profile']);
});

// Web routes untuk auto login dari aplikasi
Route::get('/sso/auto-login', [SSOController::class, 'autoLogin'])->name('sso.auto-login');

// Chatbot API
Route::post('/chatbot/ask', [\App\Http\Controllers\Api\ChatbotController::class, 'ask']);
