<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Department;

class StaffDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('staff.auth');
    }

    /**
     * Show the staff dashboard.
     */
    public function index()
    {
        $staff = Auth::guard('staff')->user();
        $webUser = Auth::guard('web')->user();
        
        // Debug logging to track who's accessing
        Log::info('Dashboard access attempt', [
            'staff_guard' => $staff ? [
                'id' => $staff->id,
                'email' => $staff->email,
                'role' => $staff->role,
                'model' => get_class($staff)
            ] : null,
            'web_guard' => $webUser ? [
                'id' => $webUser->id,
                'email' => $webUser->email,
                'role' => $webUser->role,
                'model' => get_class($webUser)
            ] : null,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);
        
        // Additional safety check - ensure staff user is actually staff
        if ($staff && $staff instanceof \App\Models\User && !$staff->isStaff()) {
            Log::warning('Non-staff user found in staff guard', [
                'user' => $staff,
                'ip' => request()->ip()
            ]);
            
            Auth::guard('staff')->logout();
            Auth::guard('web')->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            
            return redirect()->route('staff.login')
                ->with('error', 'Invalid staff credentials. Please login again.');
        }
        
        return view('staff.dashboard', compact('staff'));
    }

    /**
     * Show all staff list (accessible to all authenticated staff).
     */
    public function staffList(Request $request)
    {
        // Redirect old staff_id parameter to new uid parameter
        if ($request->has('staff_id') && !$request->has('uid')) {
            $staffId = $request->get('staff_id');
            $staff = User::find($staffId);
            if ($staff && $staff->staff_uid) {
                $queryParams = $request->except(['staff_id']);
                $queryParams['uid'] = $staff->staff_uid;
                return redirect()->to($request->url() . '?' . http_build_query(array_filter($queryParams)));
            }
        }
        
        // Remove staff_id from request if both staff_id and uid are present
        if ($request->has('staff_id') && $request->has('uid')) {
            $queryParams = $request->except(['staff_id']);
            return redirect()->to($request->url() . '?' . http_build_query(array_filter($queryParams)));
        }
        
        $query = User::with('department')
                    ->whereNotNull('role')
                    ->where('role', '!=', 'customer');
                    // Remove select to get all fields for now
        
        // Handle search functionality
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('email', 'LIKE', '%' . $searchTerm . '%');
            });
        }
        
        $staffUsers = $query->orderBy('name', 'asc')->get();
        
        // Handle staff selection by UID instead of ID
        $selectedStaffUid = $request->get('uid');
        $selectedStaff = null;
        if ($selectedStaffUid) {
            $selectedStaff = $staffUsers->firstWhere('staff_uid', $selectedStaffUid);
            // If found, load the department relationship
            if ($selectedStaff && !$selectedStaff->relationLoaded('department')) {
                $selectedStaff->load('department');
            }
        }
        
        // Load departments for dropdown - cache for 1 hour
        $departments = Cache::remember('active_departments', 3600, function() {
            return Department::where('status', 'active')
                           ->orderBy('name', 'asc')
                           ->get();
        });
        
        return view('staff.management.staff.index', compact('staffUsers', 'selectedStaff', 'selectedStaffUid', 'departments'));
    }

    /**
     * Show staff management (admin only).
     */
    public function staffManagement()
    {
        $this->checkAdminRole();
        
        $staffUsers = User::whereNotNull('role')
                         ->where('role', '!=', 'customer')
                         ->select('id', 'name', 'email', 'role', 'status', 'profile_picture', 'created_at', 'updated_at')
                         ->orderBy('created_at', 'desc')
                         ->paginate(10);
        
        return view('staff.management.index', compact('staffUsers'));
    }

    /**
     * Show create staff form (admin only).
     */
    public function createStaff()
    {
        $this->checkAdminRole();
        
        return view('staff.management.create');
    }

    /**
     * Store new staff (admin only).
     */
    public function storeStaff(Request $request)
    {
        $this->checkAdminRole();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|in:admin,customer_service,developer,marketing,manager,supervisor',
            'password' => 'required|string|min:8|confirmed',
            'status' => 'required|in:active,suspended',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        return redirect()->route('staff.management')
                         ->with('success', 'Staff user created successfully.');
    }

    /**
     * Show edit staff form (admin only).
     */
    public function editStaff(User $staff)
    {
        $this->checkAdminRole();
        
        return view('staff.management.edit', compact('staff'));
    }

    /**
     * Update staff by UID (admin only).
     */
    public function updateStaffByUID(Request $request, $staff_uid)
    {
        try {
            $this->checkAdminRole();
        } catch (\Exception $e) {
            Log::error('Admin role check failed: ' . $e->getMessage());
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized: Admin access required.'
                ], 403);
            }
            throw $e;
        }
        
        // Find staff by staff_uid
        $staff = User::where('staff_uid', $staff_uid)->first();
        if (!$staff) {
            Log::error('Staff not found with UID: ' . $staff_uid);
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Staff member not found.'
                ], 404);
            }
            abort(404);
        }
        
        // Debug: Log incoming request data
        Log::info('Update Staff Request Data:', [
            'all' => $request->all(),
            'input' => $request->input(),
            'method' => $request->method(),
            'content_type' => $request->header('Content-Type'),
            'files' => $request->file()
        ]);
        Log::info('Staff UID: ' . $staff_uid);
        Log::info('Staff found: ' . $staff->id);
        
        // Clean up request data - remove empty strings and convert them to null
        $requestData = $request->all();
        foreach ($requestData as $key => $value) {
            if ($value === '') {
                $requestData[$key] = null;
            }
        }
        
        try {
            $validated = $request->validate([
                'name' => 'nullable|string|max:255',
                'role' => 'nullable|in:admin,customer_service,developer,marketing,manager,supervisor',
                'department_id' => 'nullable|exists:departments,id',
                'username' => [
                    'nullable',
                    'string',
                    'max:255',
                    'unique:users,username,' . $staff->id,
                    'regex:/^[a-zA-Z0-9_.-]+$/' // Only allow alphanumeric, underscore, dot, dash
                ],
                'location' => 'nullable|string|max:255',
                'bio' => 'nullable|string|max:1000',
            ]);

            // Debug: Log validated data
            Log::info('Validated data:', $validated);

            // Update staff information
            $staff->update($validated);

            // Return JSON response for AJAX requests
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Staff information updated successfully.',
                    'staff' => $staff->fresh()
                ]);
            }

            return redirect()->back()
                             ->with('success', 'Staff information updated successfully.');
                             
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Debug: Log validation errors
            Log::error('Validation errors:', $e->errors());
            
            // Return JSON response for AJAX requests with validation errors
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed.',
                    'errors' => $e->errors()
                ], 422);
            }
            
            throw $e;
        } catch (\Exception $e) {
            // Debug: Log general errors
            Log::error('General error in updateStaffByUID:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Return JSON response for AJAX requests with general errors
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred: ' . $e->getMessage()
                ], 500);
            }
            
            throw $e;
        }
    }

    /**
     * Update staff status (admin only).
     */
    public function updateStaffStatus(Request $request, $staff_uid)
    {
        $this->checkAdminRole();
        
        // Find staff by staff_uid
        $staff = User::where('staff_uid', $staff_uid)->firstOrFail();
        
        $validated = $request->validate([
            'status' => 'required|in:active,suspended',
        ]);

        $staff->update($validated);

        // Return JSON response for AJAX requests
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Staff status updated successfully.',
                'status' => $staff->status
            ]);
        }

        return redirect()->back()
                         ->with('success', 'Staff status updated successfully.');
    }

    /**
     * Reset staff password (admin only).
     */
    public function resetStaffPassword(Request $request, $staff_uid)
    {
        $this->checkAdminRole();
        
        // Validate the request
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
            'send_notification' => 'sometimes|boolean'
        ]);
        
        // Find staff by staff_uid
        $staff = User::where('staff_uid', $staff_uid)->firstOrFail();
        
        // Update password
        $staff->update([
            'password' => bcrypt($request->password),
            'password_updated_at' => now()
        ]);

        // TODO: Send notification if requested
        $sendNotification = $request->boolean('send_notification', false);
        if ($sendNotification) {
            // Here you can add email notification logic
            // Mail::to($staff->email)->send(new PasswordResetNotification($staff));
        }

        // Return JSON response for AJAX requests
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Password has been reset successfully.',
                'notification_sent' => $sendNotification
            ]);
        }

        return redirect()->back()
                         ->with('success', 'Password has been reset successfully.');
    }

    /**
     * Update staff (admin only).
     */
    public function updateStaff(Request $request, User $staff)
    {
        $this->checkAdminRole();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $staff->id,
            'role' => 'required|in:admin,customer_service,developer,marketing,manager,supervisor',
            'status' => 'required|in:active,suspended',
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ]);
            $validated['password'] = bcrypt($request->password);
        }

        $staff->update($validated);

        return redirect()->route('staff.management')
                         ->with('success', 'Staff user updated successfully.');
    }

    /**
     * Delete staff (admin only).
     */
    public function destroyStaff(User $staff)
    {
        $this->checkAdminRole();
        
        // Prevent admin from deleting themselves
        if ($staff->id === Auth::id()) {
            return redirect()->route('staff.management')
                           ->with('error', 'You cannot delete your own account.');
        }

        $staff->delete();

        return redirect()->route('staff.management')
                         ->with('success', 'Staff user deleted successfully.');
    }

    /**
     * Validate admin password for security verification.
     */
    public function validateAdminPassword(Request $request)
    {
        try {
            $this->checkAdminRole();

            $request->validate([
                'password' => 'required|string'
            ]);

            /** @var \App\Models\User $staff */
            $staff = Auth::guard('staff')->user();

            // Verify password
            if (!Hash::check($request->password, $staff->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Password salah'
                ], 401);
            }

            return response()->json([
                'success' => true,
                'message' => 'Password verified successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Error validating admin password: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while validating password'
            ], 500);
        }
    }

    /**
     * Get staff password for admin view (requires admin role).
     */
    public function getStaffPassword(Request $request, $staff_uid)
    {
        try {
            $this->checkAdminRole();

            // Find staff by UID - use User model since staff_uid is in users table, not staff_users
            /** @var \App\Models\User $targetStaff */
            $targetStaff = \App\Models\User::where('staff_uid', $staff_uid)->first();

            if (!$targetStaff) {
                Log::warning('Staff not found', ['staff_uid' => $staff_uid]);
                return response()->json([
                    'success' => false,
                    'message' => 'Staff not found'
                ], 404);
            }

            // Generate a temporary password for this viewing session
            $temporaryPassword = 'temp' . date('His') . rand(100, 999); // e.g., temp14230567
            
            // Update the user's password to this temporary password
            $targetStaff->password = Hash::make($temporaryPassword);
            $targetStaff->save();
            
            // Log the action for security audit
            $adminUser = Auth::guard('staff')->user() ?: Auth::user();
            Log::info('Admin generated temporary password for staff', [
                'admin_id' => $adminUser->id,
                'admin_email' => $adminUser->email,
                'target_staff_id' => $targetStaff->id,
                'target_staff_email' => $targetStaff->email,
                'temporary_password' => $temporaryPassword,
                'timestamp' => now()
            ]);

            return response()->json([
                'success' => true,
                'password' => $temporaryPassword,
                'message' => 'Temporary password generated successfully',
                'note' => 'Password baru telah dibuat dan bisa digunakan untuk login. Password lama sudah tidak berlaku.'
            ]);

        } catch (\Exception $e) {
            Log::error('Error in getStaffPassword', [
                'staff_uid' => $staff_uid,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while generating password: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Check if current user has admin role.
     */
    private function checkAdminRole()
    {
        // Debug: check multiple guards
        Log::info('checkAdminRole called', [
            'default_guard' => Auth::getDefaultDriver(),
            'staff_guard_user' => Auth::guard('staff')->user() ? [
                'id' => Auth::guard('staff')->user()->id,
                'email' => Auth::guard('staff')->user()->email,
                'role' => Auth::guard('staff')->user()->role
            ] : null,
            'default_guard_user' => Auth::user() ? [
                'id' => Auth::user()->id,
                'email' => Auth::user()->email,
                'role' => Auth::user()->role ?? null
            ] : null,
            'web_guard_user' => Auth::guard('web')->user() ? [
                'id' => Auth::guard('web')->user()->id,
                'email' => Auth::guard('web')->user()->email,
                'role' => Auth::guard('web')->user()->role ?? null
            ] : null,
        ]);

        // Try staff guard first (should return User model with staff role)
        /** @var \App\Models\User $staff */
        $staff = Auth::guard('staff')->user();
        
        if (!$staff) {
            // Try default guard and check if it's a staff user
            $user = Auth::user();
            if ($user && $user instanceof \App\Models\User && $user->isStaff()) {
                $staff = $user;
            }
        }
        
        if (!$staff) {
            Log::warning('No authenticated staff user found in any guard');
            abort(403, 'Unauthorized access. Please login as staff member.');
        }
        
        if (!$staff->isAdmin()) {
            Log::warning('Staff user is not admin', [
                'staff_id' => $staff->id,
                'staff_role' => $staff->role
            ]);
            abort(403, 'Unauthorized access. Admin role required.');
        }
        
        Log::info('Admin role check passed', [
            'staff_id' => $staff->id,
            'staff_email' => $staff->email,
            'staff_role' => $staff->role
        ]);
    }
}
