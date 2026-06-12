<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
|--------------------------------------------------------------------------
| Load Organized Route Files
|--------------------------------------------------------------------------
|
| Route files are organized by functionality for better maintainability:
| - main.php: Main domain routes (centrova.id)
| - support.php: Support subdomain routes (support.centrova.id)
| - account.php: Account subdomain routes (account.centrova.id)
| - office.php: Office subdomain routes (office.centrova.id) - Staff management
| - chat.php: Chat system routes
| - subdomains.php: Other subdomain routes (news, docs, developer, etc.)
| - fallback.php: Fallback routes and mobile compatibility
|
*/

// Main domain routes (centrova.id)
require __DIR__.'/main.php';

// Support subdomain routes (support.centrova.id)
require __DIR__.'/support.php';

// Account subdomain routes (account.centrova.id)
require __DIR__.'/account.php';

// OAuth routes
require __DIR__.'/oauth.php';

// Office subdomain routes (office.centrova.id) - Staff management
require __DIR__.'/office.php';

// Chat routes for customers
require __DIR__.'/chat.php';

// Domain routes
require __DIR__.'/domain.php';

// Avatar routes for hashed illustrations
Route::get('/{hash}', [App\Http\Controllers\AvatarController::class, 'serveHashedAvatar'])->name('avatar.hashed')->where('hash', '[a-zA-Z0-9]{32}_[a-fA-F0-9]{32}');
Route::get('/api/illustrations/{category}', [App\Http\Controllers\AvatarController::class, 'getIllustrationsWithHash']);
Route::post('/api/avatar/set-illustration', [App\Http\Controllers\AvatarController::class, 'setIllustrationAvatar'])->name('avatar.set-illustration');
Route::post('/api/avatar/upload/{user}', [App\Http\Controllers\AvatarController::class, 'uploadAvatar'])->name('avatar.upload')->middleware('auth');

// Test routes
Route::get('/test/blob-avatar', function () {
    return view('test-blob-avatar');
})->name('test.blob-avatar');

// Invoice routes
Route::prefix('invoice')->name('invoice.')->group(function () {
    Route::get('/', [App\Http\Controllers\Invoice\InvoiceController::class, 'index'])->name('index');
    Route::get('/pdf/{id?}', [App\Http\Controllers\Invoice\InvoiceController::class, 'generatePDF'])->name('pdf');
    Route::post('/email/{id?}', [App\Http\Controllers\Invoice\InvoiceController::class, 'sendEmail'])->name('email');
});

// Other subdomain routes (news, docs, developer, careers, learn)
require __DIR__.'/subdomains.php';

// Fallback routes and mobile compatibility
require __DIR__.'/fallback.php';

// Typo redirect fallback routes - harus setelah semua route lain
Route::fallback(function () {
    // Middleware akan menangani redirect typo otomatis
    abort(404);
});

// Test routes (only for development)
// if (app()->environment('local')) {
//     require __DIR__.'/test.php';
// }
