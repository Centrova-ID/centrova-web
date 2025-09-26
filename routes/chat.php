<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

/*
|--------------------------------------------------------------------------
| Chat Routes for Customers
|--------------------------------------------------------------------------
*/

Route::middleware(['web', 'auth'])->group(function () {
    Route::prefix('chat')->name('chat.')->group(function () {
        Route::get('/', [ChatController::class, 'index'])->name('index');
        Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('send');
        Route::post('/get-new-messages', [ChatController::class, 'getNewMessages'])->name('get-new');
        Route::post('/close-conversation', [ChatController::class, 'closeConversation'])->name('close');
    });
});
