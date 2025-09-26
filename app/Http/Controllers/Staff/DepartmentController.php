<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('staff.auth');
        $this->middleware('staff.role:admin');
    }

    /**
     * Check if user is admin.
     */
    private function checkAdminRole()
    {
        $staff = Auth::guard('staff')->user();
        if (!$staff || $staff->role !== 'admin') {
            abort(403, 'Access denied. Admin role required.');
        }
    }

    /**
     * Display a listing of departments.
     */
    public function index(Request $request)
    {
        $this->checkAdminRole();
        
        // Get all departments
        $departments = Department::with(['manager', 'staff'])
                                ->orderBy('created_at', 'desc')
                                ->get();

        // Get selected department data - support both old ID and new code parameter
        $selectedDepartment = null;
        $selectedDepartmentId = $request->get('id', null);
        $selectedDepartmentCode = $request->get('code', null);
        
        if ($selectedDepartmentCode) {
            $selectedDepartment = Department::with(['manager', 'staff'])
                                           ->where('code', $selectedDepartmentCode)
                                           ->first();
        } elseif ($selectedDepartmentId) {
            $selectedDepartment = Department::with(['manager', 'staff'])
                                           ->find($selectedDepartmentId);
            // Redirect to new URL format if found
            if ($selectedDepartment && $selectedDepartment->code) {
                return redirect()->route('staff.departments.show', $selectedDepartment->code);
            }
        }

        return view('staff.management.departement.index', compact('departments', 'selectedDepartment'));
    }

    /**
     * Show department by code (new professional URL format).
     */
    public function showByCode($code)
    {
        $this->checkAdminRole();
        
        // Get all departments for sidebar
        $departments = Department::with(['manager', 'staff'])
                                ->orderBy('created_at', 'desc')
                                ->get();

        // Get selected department by code
        $selectedDepartment = Department::with(['manager', 'staff'])
                                       ->where('code', $code)
                                       ->firstOrFail();

        return view('staff.management.departement.index', compact('departments', 'selectedDepartment'));
    }

    /**
     * Edit department by code.
     */
    public function editByCode($code)
    {
        $this->checkAdminRole();
        
        $department = Department::where('code', $code)->firstOrFail();
        return $this->edit($department);
    }

    /**
     * Update department by code.
     */
    public function updateByCode(Request $request, $code)
    {
        $this->checkAdminRole();
        
        $department = Department::where('code', $code)->firstOrFail();
        return $this->update($request, $department);
    }

    /**
     * Update department status by code.
     */
    public function updateStatusByCode(Request $request, $code)
    {
        $this->checkAdminRole();
        
        $department = Department::where('code', $code)->firstOrFail();
        return $this->updateStatus($request, $department);
    }

    /**
     * Delete department by code.
     */
    public function destroyByCode($code)
    {
        $this->checkAdminRole();
        
        $department = Department::where('code', $code)->firstOrFail();
        return $this->destroy($department);
    }

    /**
     * Show the form for creating a new department.
     */
    public function create()
    {
        $this->checkAdminRole();
        
        // Get staff members who can be managers
        $managers = User::whereNotNull('role')
                       ->where('role', '!=', 'customer')
                       ->whereIn('role', ['admin', 'manager', 'supervisor'])
                       ->where('status', 'active') // Only active users
                       ->select('id', 'name', 'email', 'role')
                       ->orderBy('name')
                       ->get();

        return view('staff.management.departement.create', compact('managers'));
    }

    /**
     * Store a newly created department in storage.
     */
    public function store(Request $request)
    {
        $this->checkAdminRole();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:departments,name',
            'code' => 'nullable|string|max:10|unique:departments,code',
            'description' => 'nullable|string|max:1000',
            'manager_id' => 'nullable|exists:users,id',
            'budget' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'status' => 'required|in:active,inactive',
            'established_date' => 'nullable|date',
        ]);

        // Generate code if not provided
        if (empty($validated['code'])) {
            $validated['code'] = Department::generateCode($validated['name']);
        }

        try {
            $department = Department::create($validated);

            Log::info('Department created', [
                'department_id' => $department->id,
                'created_by' => Auth::guard('staff')->id(),
                'department_data' => $validated
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Department created successfully.',
                'department' => $department
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to create department', [
                'error' => $e->getMessage(),
                'data' => $validated,
                'created_by' => Auth::guard('staff')->id()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to create department. Please try again.'
            ], 500);
        }
    }

    /**
     * Display the specified department.
     */
    public function show(Department $department)
    {
        $this->checkAdminRole();
        
        $department->load(['manager', 'staff']);
        
        return view('staff.management.departement.show', compact('department'));
    }

    /**
     * Show the form for editing the specified department.
     */
    public function edit(Department $department)
    {
        $this->checkAdminRole();
        
        // Get staff members who can be managers
        $managers = User::whereNotNull('role')
                       ->where('role', '!=', 'customer')
                       ->whereIn('role', ['admin', 'manager', 'supervisor'])
                       ->select('id', 'name', 'email', 'role')
                       ->orderBy('name')
                       ->get();

        return view('staff.management.departement.edit', compact('department', 'managers'));
    }

    /**
     * Update the specified department in storage.
     */
    public function update(Request $request, Department $department)
    {
        $this->checkAdminRole();
        
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('departments', 'name')->ignore($department->id)
            ],
            'code' => [
                'nullable',
                'string',
                'max:10',
                Rule::unique('departments', 'code')->ignore($department->id)
            ],
            'description' => 'nullable|string|max:1000',
            'manager_id' => 'nullable|exists:users,id',
            'budget' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'status' => 'required|in:active,inactive',
            'established_date' => 'nullable|date',
        ]);

        try {
            $department->update($validated);

            Log::info('Department updated', [
                'department_id' => $department->id,
                'updated_by' => Auth::guard('staff')->id(),
                'changes' => $department->getChanges()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Department updated successfully.',
                'department' => $department->fresh()
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to update department', [
                'department_id' => $department->id,
                'error' => $e->getMessage(),
                'data' => $validated,
                'updated_by' => Auth::guard('staff')->id()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update department. Please try again.'
            ], 500);
        }
    }

    /**
     * Update the specified department status.
     */
    public function updateStatus(Request $request, Department $department)
    {
        $this->checkAdminRole();
        
        $validated = $request->validate([
            'status' => 'required|in:active,inactive'
        ]);

        try {
            $department->update($validated);

            Log::info('Department status updated', [
                'department_id' => $department->id,
                'new_status' => $validated['status'],
                'updated_by' => Auth::guard('staff')->id()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Department status updated successfully.',
                'department' => $department->fresh()
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to update department status', [
                'department_id' => $department->id,
                'error' => $e->getMessage(),
                'updated_by' => Auth::guard('staff')->id()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update department status. Please try again.'
            ], 500);
        }
    }

    /**
     * Remove the specified department from storage.
     */
    public function destroy(Department $department)
    {
        $this->checkAdminRole();
        
        try {
            // Check if department has staff members
            if ($department->staff()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot delete department with active staff members. Please reassign staff first.'
                ], 400);
            }

            $department->delete();

            Log::info('Department deleted', [
                'department_id' => $department->id,
                'deleted_by' => Auth::guard('staff')->id()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Department deleted successfully.'
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to delete department', [
                'department_id' => $department->id,
                'error' => $e->getMessage(),
                'deleted_by' => Auth::guard('staff')->id()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete department. Please try again.'
            ], 500);
        }
    }

    /**
     * Get department statistics.
     */
    public function statistics()
    {
        $this->checkAdminRole();
        
        $stats = [
            'total_departments' => Department::count(),
            'active_departments' => Department::where('status', 'active')->count(),
            'inactive_departments' => Department::where('status', 'inactive')->count(),
            'departments_with_managers' => Department::whereNotNull('manager_id')->count(),
            'total_staff_in_departments' => User::whereNotNull('department_id')->count(),
        ];

        return response()->json($stats);
    }
}
