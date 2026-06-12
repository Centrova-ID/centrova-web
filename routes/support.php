<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

/*
|--------------------------------------------------------------------------
| Support Subdomain Routes (support.centrova.id)
|--------------------------------------------------------------------------
*/

Route::domain('support.centrova.id')->middleware(['web'])->group(function () {
    Route::get('/', function () { return view('support.index'); })->name('support.home');
    Route::get('/help', function () { return view('support.help.index'); })->name('support.help.home');
    Route::get('/web/consult', function () { return view('support.web.consult'); })->name('support.web.consult');
    Route::get('/web/consult/chat', [ChatController::class, 'index'])->middleware('auth')->name('support.web.chat');
    Route::get('/web/consult/chat/reply/{messageId}', function($messageId) {
        return redirect()->route('support.web.chat')->with('reply_to_message_id', $messageId);
    })->middleware('auth')->name('support.web.chat.reply');
    
    // Chat AJAX endpoints
    Route::post('/web/consult/chat/send', [ChatController::class, 'sendMessage'])->middleware('auth')->name('support.web.chat.send');
    Route::get('/web/consult/chat/messages/{conversation}', [ChatController::class, 'getNewMessages'])->middleware('auth')->name('support.web.chat.messages');
    Route::post('/web/consult/chat/close/{conversation}', [ChatController::class, 'closeConversation'])->middleware('auth')->name('support.web.chat.close');
    
    Route::get('/services', function () { return view('support.services.index'); })->name('support.services.home');
    Route::get('/services/web', function () { return view('support.services.web'); })->name('support.services.web');
    Route::get('/services/app', function () { return view('support.services.app'); });
    Route::get('/services/mobile', function () { return view('support.services.mobile'); });
    Route::get('/services/uiux', function () { return view('support.services.uiux'); });
});
