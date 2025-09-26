<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\PrivacyTemplate;
use App\Models\PrivacyRequest;
use App\Models\PrivacyContactInquiry;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrivacyOfficerController extends Controller
{
    public function __construct()
    {
        $this->middleware('staff.auth');
        $this->middleware(function ($request, $next) {
            $staff = Auth::guard('staff')->user();
            if (!$staff || !in_array($staff->role, ['privacy_officer', 'admin'])) {
                abort(403, 'Access denied. Privacy Officer role required.');
            }
            return $next($request);
        });
    }

    public function dashboard()
    {
        $pendingRequests = PrivacyRequest::where('status', PrivacyRequest::STATUS_PENDING)->count();
        $inProgressRequests = PrivacyRequest::where('status', PrivacyRequest::STATUS_IN_PROGRESS)->count();
        $overdueRequests = PrivacyRequest::where('due_date', '<', now())
            ->whereNotIn('status', [PrivacyRequest::STATUS_COMPLETED, PrivacyRequest::STATUS_CANCELLED])
            ->count();
        $totalTemplates = PrivacyTemplate::where('is_active', true)->count();

        // Privacy Contact Inquiries Stats
        $pendingInquiries = PrivacyContactInquiry::where('status', 'submitted')->count();
        $totalInquiries = PrivacyContactInquiry::count();
        $recentInquiries = PrivacyContactInquiry::orderBy('created_at', 'desc')->take(5)->get();

        $recentRequests = PrivacyRequest::with(['user', 'assignedTo', 'template'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $urgentRequests = PrivacyRequest::where('priority', PrivacyRequest::PRIORITY_URGENT)
            ->whereNotIn('status', [PrivacyRequest::STATUS_COMPLETED, PrivacyRequest::STATUS_CANCELLED])
            ->with(['user', 'assignedTo'])
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('staff.privacy.dashboard', compact(
            'pendingRequests',
            'inProgressRequests', 
            'overdueRequests',
            'totalTemplates',
            'pendingInquiries',
            'totalInquiries',
            'recentInquiries',
            'recentRequests',
            'urgentRequests'
        ));
    }

    // Privacy Requests Management
    public function requests(Request $request)
    {
        $query = PrivacyRequest::with(['user', 'assignedTo', 'template']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('request_type', $request->type);
        }

        // Filter by priority
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $requests = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('staff.privacy.requests.index', compact('requests'));
    }

    public function showRequest(PrivacyRequest $request)
    {
        $request->load(['user', 'assignedTo', 'processedBy', 'template']);
        
        return view('staff.privacy.requests.show', compact('request'));
    }

    public function processRequest(Request $request, PrivacyRequest $privacyRequest)
    {
        $validated = $request->validate([
            'status' => 'required|in:' . implode(',', array_keys(PrivacyRequest::getStatuses())),
            'template_id' => 'nullable|exists:privacy_templates,id',
            'response_content' => 'required|string',
            'notes' => 'nullable|string'
        ]);

        $privacyRequest->update([
            'status' => $validated['status'],
            'template_id' => $validated['template_id'],
            'response_content' => $validated['response_content'],
            'notes' => $validated['notes'],
            'processed_by' => Auth::id(),
            'response_sent_at' => now()
        ]);

        // Here you would typically send the response email to the customer
        // TODO: Implement email sending logic

        return redirect()->route('staff.privacy.requests.show', $privacyRequest)
            ->with('success', 'Privacy request has been processed successfully.');
    }

    // Templates Management
    public function templates()
    {
        $templates = PrivacyTemplate::with(['createdBy', 'updatedBy'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('staff.privacy.templates.index', compact('templates'));
    }

    public function createTemplate()
    {
        return view('staff.privacy.templates.create');
    }

    public function storeTemplate(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:' . implode(',', array_keys(PrivacyTemplate::getTypes())),
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'variables' => 'nullable|array',
            'is_active' => 'boolean'
        ]);

        $validated['created_by'] = Auth::id();
        $validated['updated_by'] = Auth::id();

        PrivacyTemplate::create($validated);

        return redirect()->route('staff.privacy.templates.index')
            ->with('success', 'Template created successfully.');
    }

    public function editTemplate(PrivacyTemplate $template)
    {
        return view('staff.privacy.templates.edit', compact('template'));
    }

    public function updateTemplate(Request $request, PrivacyTemplate $template)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:' . implode(',', array_keys(PrivacyTemplate::getTypes())),
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'variables' => 'nullable|array',
            'is_active' => 'boolean'
        ]);

        $validated['updated_by'] = Auth::id();

        $template->update($validated);

        return redirect()->route('staff.privacy.templates.index')
            ->with('success', 'Template updated successfully.');
    }

    public function destroyTemplate(PrivacyTemplate $template)
    {
        $template->delete();

        return redirect()->route('staff.privacy.templates.index')
            ->with('success', 'Template deleted successfully.');
    }

    // Automation & Reports
    public function automation()
    {
        $automationRules = [
            'auto_assign_data_access' => 'Auto-assign data access requests to available officers',
            'auto_response_acknowledgment' => 'Send automatic acknowledgment within 1 hour',
            'escalate_overdue' => 'Escalate requests overdue by 72 hours',
            'monthly_report' => 'Generate monthly privacy reports automatically'
        ];

        return view('staff.privacy.automation', compact('automationRules'));
    }

    public function reports()
    {
        $monthlyStats = [
            'total_requests' => PrivacyRequest::whereMonth('created_at', now()->month)->count(),
            'completed_requests' => PrivacyRequest::whereMonth('created_at', now()->month)
                ->where('status', PrivacyRequest::STATUS_COMPLETED)->count(),
            'avg_response_time' => '2.3 days', // Calculate this based on actual data
            'customer_satisfaction' => '95%' // This would come from surveys
        ];

        $requestsByType = PrivacyRequest::selectRaw('request_type, COUNT(*) as count')
            ->whereMonth('created_at', now()->month)
            ->groupBy('request_type')
            ->get();

        return view('staff.privacy.reports', compact('monthlyStats', 'requestsByType'));
    }

    public function contactInquiries()
    {
        $inquiries = PrivacyContactInquiry::orderBy('created_at', 'desc')->paginate(15);
        
        $stats = [
            'total' => PrivacyContactInquiry::count(),
            'pending' => PrivacyContactInquiry::where('status', 'submitted')->count(),
            'in_progress' => PrivacyContactInquiry::where('status', 'in_progress')->count(),
            'completed' => PrivacyContactInquiry::where('status', 'completed')->count(),
        ];

        return view('staff.privacy.contact-inquiries.index', compact('inquiries', 'stats'));
    }

    public function showContactInquiry(PrivacyContactInquiry $inquiry)
    {
        return view('staff.privacy.contact-inquiries.show', compact('inquiry'));
    }

    public function updateInquiryStatus(Request $request, PrivacyContactInquiry $inquiry)
    {
        $request->validate([
            'status' => 'required|in:submitted,in_progress,completed,closed'
        ]);

        $inquiry->update([
            'status' => $request->status,
            'responded_at' => $request->status !== 'submitted' ? now() : null
        ]);

        return redirect()->back()->with('success', 'Status inquiry berhasil diperbarui.');
    }
}
