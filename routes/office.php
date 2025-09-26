<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Staff\StaffAuthController;
use App\Http\Controllers\Staff\StaffDashboardController;
use App\Http\Controllers\Staff\ProfileController as StaffProfileController;
use App\Http\Controllers\Staff\StaffChatController;
use App\Http\Controllers\Staff\PrivacyOfficerController;
use App\Http\Controllers\Staff\UICategoryController;
use App\Http\Controllers\Staff\UIComponentController;
use App\Http\Controllers\Staff\DepartmentController;

/*
|--------------------------------------------------------------------------
| Office Subdomain Routes (office.centrova.test)
|--------------------------------------------------------------------------
*/

Route::domain('office.centrova.test')->group(function () {
    // Public authentication routes - NO middleware restrictions
    Route::middleware(['web'])->group(function () {
        Route::get('/login', [StaffAuthController::class, 'showLoginForm'])->name('staff.login');
        Route::post('/login', [StaffAuthController::class, 'login'])->name('staff.login.submit');
        Route::post('/logout', [StaffAuthController::class, 'logout'])->name('staff.logout');
        
        // Staff Password Reset Routes
        Route::get('/password/reset', [StaffAuthController::class, 'showForgotPasswordForm'])->name('staff.password.request');
        Route::post('/password/email', [StaffAuthController::class, 'sendResetLinkEmail'])->name('staff.password.email');
        Route::get('/password/reset/{token}', [StaffAuthController::class, 'showResetForm'])->name('staff.password.reset');
        Route::post('/password/reset', [StaffAuthController::class, 'reset'])->name('staff.password.update');
    });
    
    // ALL other routes require STRICT staff authentication
    Route::middleware(['web', 'office.access', 'block.customer'])->group(function () {
        // Root path - redirects to staff dashboard
        Route::get('/', function () {
            return redirect()->route('staff.dashboard');
        });
        
        // Dashboard - main route
        Route::get('/dashboard', [StaffDashboardController::class, 'index'])->name('staff.dashboard');
        
        // Staff List - simple view for all staff (accessible to all authenticated staff)
        Route::get('/staff', [StaffDashboardController::class, 'staffList'])->name('staff.list');
        
        // Profile Management (untuk staff dengan data tambahan)
        Route::prefix('profile')->name('staff.profile.')->group(function () {
            Route::get('/', [StaffProfileController::class, 'show'])->name('index');
            Route::put('/update', [StaffProfileController::class, 'update'])->name('update');
            Route::put('/password', [StaffProfileController::class, 'updatePassword'])->name('password.update');
            Route::put('/notifications', [StaffProfileController::class, 'updateNotifications'])->name('notifications.update');
            Route::delete('/profile-picture', [StaffProfileController::class, 'removeProfilePicture'])->name('picture.remove');
            Route::get('/download-data', [StaffProfileController::class, 'downloadData'])->name('data.download');
            Route::delete('/delete-account', [StaffProfileController::class, 'deleteAccount'])->name('delete.account');
        });
        
        // Staff Management (Admin only)
        Route::middleware('staff.role:admin')->group(function () {
            Route::get('/management', [StaffDashboardController::class, 'staffManagement'])->name('staff.management');
            Route::get('/management/create', [StaffDashboardController::class, 'createStaff'])->name('staff.management.create');
            Route::post('/management', [StaffDashboardController::class, 'storeStaff'])->name('staff.management.store');
            Route::get('/management/{staff}/edit', [StaffDashboardController::class, 'editStaff'])->name('staff.management.edit');
            Route::put('/management/{staff}', [StaffDashboardController::class, 'updateStaff'])->name('staff.management.update');
            Route::delete('/management/{staff}', [StaffDashboardController::class, 'destroyStaff'])->name('staff.management.destroy');
            
            // Staff management nested routes for individual staff by UID
            Route::prefix('management/staff')->name('staff.management.staff.')->group(function () {
                Route::put('/{staff_uid}', [StaffDashboardController::class, 'updateStaffByUID'])->name('update');
                Route::patch('/{staff_uid}/status', [StaffDashboardController::class, 'updateStaffStatus'])->name('status');
                Route::post('/{staff_uid}/reset-password', [StaffDashboardController::class, 'resetStaffPassword'])->name('reset-password');
                Route::post('/validate-password', [StaffDashboardController::class, 'validateAdminPassword'])->name('validate-password');
                Route::get('/{staff_uid}/get-password', [StaffDashboardController::class, 'getStaffPassword'])->name('get-password');
            });
            
            // Department Management (Admin only) - Professional URLs
            Route::prefix('departments')->name('staff.departments.')->group(function () {
                Route::get('/', [DepartmentController::class, 'index'])->name('index');
                Route::get('/create', [DepartmentController::class, 'create'])->name('create');
                Route::post('/', [DepartmentController::class, 'store'])->name('store');
                Route::get('/{code}', [DepartmentController::class, 'showByCode'])->name('show');
                Route::get('/{code}/edit', [DepartmentController::class, 'editByCode'])->name('edit');
                Route::put('/{code}', [DepartmentController::class, 'updateByCode'])->name('update');
                Route::patch('/{code}/status', [DepartmentController::class, 'updateStatusByCode'])->name('status');
                Route::delete('/{code}', [DepartmentController::class, 'destroyByCode'])->name('destroy');
                Route::get('/statistics', [DepartmentController::class, 'statistics'])->name('statistics');
            });
            
            // Legacy department management routes (redirect to new format)
            Route::prefix('management/department')->group(function () {
                Route::get('/', function() {
                    return redirect()->route('staff.departments.index');
                })->name('staff.management.department.index');
                
                Route::get('/', function() {
                    $id = request('id');
                    if ($id) {
                        $department = \App\Models\Department::find($id);
                        if ($department && $department->code) {
                            return redirect()->route('staff.departments.show', $department->code);
                        }
                    }
                    return redirect()->route('staff.departments.index');
                });
                
                // Debug route for testing
                Route::get('/debug-staff', function() {
                    $staff = \App\Models\User::whereNotNull('role')
                                           ->where('role', '!=', 'customer')
                                           ->select('id', 'name', 'email', 'role', 'status', 'department_id')
                                           ->get();
                    return response()->json([
                        'total_staff' => $staff->count(),
                        'staff' => $staff->take(5)
                    ]);
                })->name('debug-staff');
            });
        });

        // Chat Support
        Route::prefix('chat')->name('staff.chat.')->group(function () {
            Route::get('/', [StaffChatController::class, 'index'])->name('index');
            Route::get('/conversation/{id}', [StaffChatController::class, 'showConversation'])->name('conversation');
            Route::get('/conversation/{id}/preview', [StaffChatController::class, 'getConversationPreview'])->name('conversation.preview');
            Route::post('/send-message', [StaffChatController::class, 'sendMessage'])->name('send');
            Route::post('/get-new-messages', [StaffChatController::class, 'getNewMessages'])->name('get-new');
            Route::post('/get-messages-paginated', [StaffChatController::class, 'getMessagesPaginated'])->name('get-messages-paginated');
            Route::post('/take-conversation', [StaffChatController::class, 'takeConversation'])->name('take');
            Route::post('/close-conversation', [StaffChatController::class, 'closeConversation'])->name('close');
            Route::get('/conversations', [StaffChatController::class, 'getConversations'])->name('conversations');
            Route::post('/toggle-pin', [StaffChatController::class, 'togglePin'])->name('toggle-pin');
            Route::post('/remove-conversation', [StaffChatController::class, 'removeConversation'])->name('remove');
            Route::post('/toggle-star-message', [StaffChatController::class, 'toggleStarMessage'])->name('toggle-star');
            Route::post('/delete-message', [StaffChatController::class, 'deleteMessage'])->name('delete-message');
            Route::post('/typing-status', [StaffChatController::class, 'updateTypingStatus'])->name('typing-status');
            Route::get('/typing-users', [StaffChatController::class, 'getTypingUsers'])->name('typing-users');
            Route::post('/get-conversations-update', [StaffChatController::class, 'getConversationsUpdate'])->name('get-conversations-update');
            Route::post('/search-conversations', [StaffChatController::class, 'searchConversations'])->name('search-conversations');
        });

        // Privacy Officer Routes (Privacy Officer & Admin only)
        Route::prefix('privacy')->name('staff.privacy.')->middleware('staff.role:privacy_officer,admin')->group(function () {
            Route::get('/dashboard', [PrivacyOfficerController::class, 'dashboard'])->name('dashboard');
            
            // Privacy Requests Management
            Route::prefix('requests')->name('requests.')->group(function () {
                Route::get('/', [PrivacyOfficerController::class, 'requests'])->name('index');
                Route::get('/{request}', [PrivacyOfficerController::class, 'showRequest'])->name('show');
                Route::put('/{request}/process', [PrivacyOfficerController::class, 'processRequest'])->name('process');
            });
            
            // Templates Management
            Route::prefix('templates')->name('templates.')->group(function () {
                Route::get('/', [PrivacyOfficerController::class, 'templates'])->name('index');
                Route::get('/create', [PrivacyOfficerController::class, 'createTemplate'])->name('create');
                Route::post('/', [PrivacyOfficerController::class, 'storeTemplate'])->name('store');
                Route::get('/{template}/edit', [PrivacyOfficerController::class, 'editTemplate'])->name('edit');
                Route::put('/{template}', [PrivacyOfficerController::class, 'updateTemplate'])->name('update');
                Route::delete('/{template}', [PrivacyOfficerController::class, 'destroyTemplate'])->name('destroy');
            });

            // Contact Inquiries Management
            Route::prefix('contact-inquiries')->name('contact-inquiries.')->group(function () {
                Route::get('/', [PrivacyOfficerController::class, 'contactInquiries'])->name('index');
                Route::get('/{inquiry}', [PrivacyOfficerController::class, 'showContactInquiry'])->name('show');
                Route::put('/{inquiry}/update-status', [PrivacyOfficerController::class, 'updateInquiryStatus'])->name('update-status');
            });
            
            // Automation & Reports
            Route::get('/automation', [PrivacyOfficerController::class, 'automation'])->name('automation');
            Route::get('/reports', [PrivacyOfficerController::class, 'reports'])->name('reports');
        });

        // UI Management (All staff except customer role can access)
        Route::middleware('staff.role:admin,staff,privacy_officer')->group(function () {
            // UI Categories
            Route::resource('ui-categories', UICategoryController::class)->names([
                'index' => 'staff.ui-categories.index',
                'create' => 'staff.ui-categories.create',
                'store' => 'staff.ui-categories.store',
                'show' => 'staff.ui-categories.show',
                'edit' => 'staff.ui-categories.edit',
                'update' => 'staff.ui-categories.update',
                'destroy' => 'staff.ui-categories.destroy',
            ])->parameters(['ui-categories' => 'uiCategory']);

            // UI Components
            Route::resource('ui-components', UIComponentController::class)->names([
                'index' => 'staff.ui-components.index',
                'create' => 'staff.ui-components.create',
                'store' => 'staff.ui-components.store',
                'show' => 'staff.ui-components.show',
                'edit' => 'staff.ui-components.edit',
                'update' => 'staff.ui-components.update',
                'destroy' => 'staff.ui-components.destroy',
            ])->parameters(['ui-components' => 'uiComponent']);

            // Component Preview
            Route::get('ui-components/{uiComponent}/preview', [UIComponentController::class, 'preview'])
                ->name('staff.ui-components.preview');
        });

        // Domain Administration Routes (admin level access)
        Route::prefix('admin/domains')->name('admin.domains.')->middleware(['staff.admin'])->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\DomainAdminController::class, 'index'])->name('index');
            Route::get('/domains', [App\Http\Controllers\Admin\DomainAdminController::class, 'domains'])->name('list');
            Route::get('/domains/{domain}', [App\Http\Controllers\Admin\DomainAdminController::class, 'show'])->name('show');
            
            // Domain Orders
            Route::get('/orders', [App\Http\Controllers\Admin\DomainAdminController::class, 'orders'])->name('orders');
            Route::get('/orders/{order}', [App\Http\Controllers\Admin\DomainAdminController::class, 'showOrder'])->name('order.show');
            
            // Domain Pricing
            Route::get('/pricing', [App\Http\Controllers\Admin\DomainAdminController::class, 'pricing'])->name('pricing');
            Route::post('/pricing', [App\Http\Controllers\Admin\DomainAdminController::class, 'storePricing'])->name('pricing.store');
            Route::put('/pricing/{pricing}', [App\Http\Controllers\Admin\DomainAdminController::class, 'updatePricing'])->name('pricing.update');
            
            // Bulk Actions
            Route::post('/domains/bulk-renew', [App\Http\Controllers\Admin\DomainAdminController::class, 'bulkRenew'])->name('bulk.renew');
            Route::post('/domains/bulk-update-status', [App\Http\Controllers\Admin\DomainAdminController::class, 'bulkUpdateStatus'])->name('bulk.update-status');
            
            // Reports
            Route::get('/reports', [App\Http\Controllers\Admin\DomainAdminController::class, 'reports'])->name('reports');
        });
    });
    
    // Catch-all route - block any unauthorized access attempts
    Route::fallback(function () {
        abort(404);
    });
});
