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

// Support subdomain routes (support.centrova.id) — DISABLED
// require __DIR__.'/support.php';

// Account subdomain routes (account.centrova.id) — DISABLED
// require __DIR__.'/account.php';

// OAuth routes — DISABLED
// require __DIR__.'/oauth.php';

// Office subdomain routes (office.centrova.id) - Staff management — DISABLED
// require __DIR__.'/office.php';

// Chat routes for customers — DISABLED
// require __DIR__.'/chat.php';

// Domain routes — DISABLED
// require __DIR__.'/domain.php';

// Other subdomain routes (news, docs, developer, careers, learn) — DISABLED
// require __DIR__.'/subdomains.php';

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
