<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Domain\DomainSearchController;
use App\Http\Controllers\Domain\DomainCartController;
use App\Http\Controllers\Domain\DomainCheckoutController;
use App\Http\Controllers\Domain\DomainManagementController;
use App\Http\Controllers\Admin\DomainAdminController;

/*
|--------------------------------------------------------------------------
| Domain Routes
|--------------------------------------------------------------------------
|
| Routes for domain reseller functionality including search, cart,
| checkout, and management features.
|
*/

// Public domain routes (no auth required)
Route::prefix('domain')->name('domain.')->group(function () {
    
    // Domain Search
    Route::get('/search', [DomainSearchController::class, 'index'])->name('search.index');
    Route::post('/search', [DomainSearchController::class, 'search'])->name('search.post');
    Route::post('/search/suggestions', [DomainSearchController::class, 'suggestions'])->name('search.suggestions');
    Route::post('/search/check', [DomainSearchController::class, 'checkAvailability'])->name('search.check');
    Route::get('/pricing', [DomainSearchController::class, 'pricing'])->name('pricing');

    // Domain Cart (session-based, no auth required)
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [DomainCartController::class, 'index'])->name('index');
        Route::post('/add', [DomainCartController::class, 'add'])->name('add');
        Route::post('/remove', [DomainCartController::class, 'remove'])->name('remove');
        Route::post('/update', [DomainCartController::class, 'update'])->name('update');
        Route::post('/clear', [DomainCartController::class, 'clear'])->name('clear');
        Route::get('/count', [DomainCartController::class, 'count'])->name('count');
        Route::get('/contents', [DomainCartController::class, 'contents'])->name('contents');
    });
});

// Authenticated domain routes
Route::middleware(['auth'])->prefix('domain')->name('domain.')->group(function () {
    
    // Domain Checkout
    Route::prefix('checkout')->name('checkout.')->group(function () {
        Route::get('/', [DomainCheckoutController::class, 'index'])->name('index');
        Route::post('/process', [DomainCheckoutController::class, 'process'])->name('process');
        Route::get('/success/{order}', [DomainCheckoutController::class, 'success'])->name('success');
        Route::get('/failed/{order}', [DomainCheckoutController::class, 'failed'])->name('failed');
    });

    // Domain Management (Customer Panel)
    Route::prefix('manage')->name('manage.')->group(function () {
        Route::get('/', [DomainManagementController::class, 'index'])->name('index');
        Route::get('/{domain}', [DomainManagementController::class, 'show'])->name('show');
        Route::post('/{domain}/renew', [DomainManagementController::class, 'renew'])->name('renew');
        Route::post('/{domain}/auto-renew', [DomainManagementController::class, 'toggleAutoRenew'])->name('auto-renew');
        Route::put('/{domain}/nameservers', [DomainManagementController::class, 'updateNameservers'])->name('nameservers');
        Route::put('/{domain}/dns', [DomainManagementController::class, 'updateDns'])->name('dns');
        Route::post('/{domain}/privacy', [DomainManagementController::class, 'togglePrivacy'])->name('privacy');
    });
});

// Account subdomain routes for domains
Route::domain('account.centrova.test')->middleware(['web', 'auth'])->prefix('domains')->name('account.domains.')->group(function () {
    Route::get('/', [DomainManagementController::class, 'index'])->name('index');
    Route::get('/{domain}', [DomainManagementController::class, 'show'])->name('show');
    Route::post('/{domain}/renew', [DomainManagementController::class, 'renew'])->name('renew');
    Route::post('/{domain}/auto-renew', [DomainManagementController::class, 'toggleAutoRenew'])->name('auto-renew');
    Route::put('/{domain}/nameservers', [DomainManagementController::class, 'updateNameservers'])->name('nameservers');
    Route::put('/{domain}/dns', [DomainManagementController::class, 'updateDns'])->name('dns');
    Route::post('/{domain}/privacy', [DomainManagementController::class, 'togglePrivacy'])->name('privacy');
});

// Office/Admin domain routes
Route::domain('office.centrova.test')->middleware(['web', 'office.access', 'block.customer'])->prefix('domains')->name('admin.domains.')->group(function () {
    
    // Domain Administration
    Route::get('/', [DomainAdminController::class, 'index'])->name('index');
    Route::get('/create', [DomainAdminController::class, 'create'])->name('create');
    Route::post('/', [DomainAdminController::class, 'store'])->name('store');
    Route::get('/{domain}', [DomainAdminController::class, 'show'])->name('show');
    Route::get('/{domain}/edit', [DomainAdminController::class, 'edit'])->name('edit');
    Route::put('/{domain}', [DomainAdminController::class, 'update'])->name('update');
    Route::delete('/{domain}', [DomainAdminController::class, 'destroy'])->name('destroy');

    // Domain Pricing Management
    Route::prefix('pricing')->name('pricing.')->group(function () {
        Route::get('/', [DomainAdminController::class, 'pricing'])->name('index');
        Route::post('/', [DomainAdminController::class, 'storePricing'])->name('store');
        Route::put('/{pricing}', [DomainAdminController::class, 'updatePricing'])->name('update');
        Route::delete('/{pricing}', [DomainAdminController::class, 'destroyPricing'])->name('destroy');
    });

    // Domain Orders Management
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [DomainAdminController::class, 'orders'])->name('index');
        Route::get('/{order}', [DomainAdminController::class, 'showOrder'])->name('show');
        Route::post('/{order}/process', [DomainAdminController::class, 'processOrder'])->name('process');
        Route::post('/{order}/cancel', [DomainAdminController::class, 'cancelOrder'])->name('cancel');
    });

    // Reports & Analytics
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [DomainAdminController::class, 'reports'])->name('index');
        Route::get('/exports', [DomainAdminController::class, 'exports'])->name('exports');
        Route::post('/export', [DomainAdminController::class, 'export'])->name('export');
    });

    // Bulk Operations
    Route::prefix('bulk')->name('bulk.')->group(function () {
        Route::post('/renew', [DomainAdminController::class, 'bulkRenew'])->name('renew');
        Route::post('/update-status', [DomainAdminController::class, 'bulkUpdateStatus'])->name('update-status');
        Route::post('/send-notifications', [DomainAdminController::class, 'bulkSendNotifications'])->name('send-notifications');
    });
});
