<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Other Subdomain Routes
|--------------------------------------------------------------------------
*/

// News subdomain
Route::domain('news.centrova.test')->middleware(['web'])->group(function () {
    Route::get('/', function () { return view('news.index'); })->name('news.home');
    Route::get('/detail', function () { return view('news.detail'); })->name('news.detail');
    Route::get('/editor', function () { return view('news.editor'); })->name('news.create');
});

// Developer subdomain
Route::domain('developer.centrova.test')->middleware(['web'])->group(function () {
    Route::get('/', function () { return view('developer.index'); })->name('developer.home');
    Route::get('/ui-kit', function () { return view('developer.ui-kit'); })->name('developer.ui-kit');
});

// Career subdomain
Route::domain('careers.centrova.test')->middleware(['web'])->group(function () {
    Route::get('/', function () { return view('careers.index'); })->name('careers.home');
});

// Learn subdomain
Route::domain('learn.centrova.test')->middleware(['web'])->group(function () {
    Route::get('/', function () {
        return view('learn.index');
    })->name('learn.index');
});

// Docs subdomain
Route::domain('docs.centrova.test')->middleware(['web'])->group(function () {
    Route::get('/services', function () {
        return view('docs.services.index');
    });
    Route::get('/services/web', function () {
        return view('docs.services.web');
    });
    Route::get('/services/app', function () {
        return view('docs.services.app');
    });
    Route::get('/services/mobile', function () {
        return view('docs.services.mobile');
    });
    Route::get('/services/uiux', function () {
        return view('docs.services.uiux');
    });
});
