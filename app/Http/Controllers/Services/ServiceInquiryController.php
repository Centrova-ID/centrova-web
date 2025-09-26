<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services\ServiceInquiry;
use Illuminate\Support\Facades\Validator;

class ServiceInquiryController extends Controller
{
    /**
     * Display a listing of service inquiries
     */
    public function index(Request $request)
    {
        $query = ServiceInquiry::query();

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by service type
        if ($request->has('service_type') && $request->service_type !== 'all') {
            $query->where('service_type', $request->service_type);
        }

        // Filter by priority
        if ($request->has('priority') && $request->priority !== 'all') {
            $query->where('priority', $request->priority);
        }

        // Search by name or email
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%");
            });
        }

        $inquiries = $query->orderBy('created_at', 'desc')
                          ->paginate(15);

        return view('admin.services.inquiries.index', compact('inquiries'));
    }

    /**
     * Show the form for creating a new inquiry (public form)
     */
    public function create()
    {
        return view('services.inquiry.form');
    }

    /**
     * Store a newly created inquiry
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'service_type' => 'required|in:web-development,mobile-app,ui-ux-design,digital-marketing,other',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
            'budget_range' => 'nullable|string|max:100',
            'timeline' => 'nullable|string|max:100',
            'source' => 'nullable|in:website,whatsapp,social-media,referral,google,other',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan dalam pengisian form. Silakan periksa kembali.');
        }

        try {
            $inquiry = ServiceInquiry::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'company' => $request->company,
                'service_type' => $request->service_type,
                'subject' => $request->subject,
                'message' => $request->message,
                'budget_range' => $request->budget_range,
                'timeline' => $request->timeline,
                'source' => $request->source ?? 'website',
                'status' => 'new',
                'priority' => $this->determinePriority($request),
            ]);

            // Send notification email to admin (optional)
            // $this->sendAdminNotification($inquiry);

            return back()->with('success', 'Terima kasih! Inquiry Anda telah dikirim. Tim kami akan menghubungi Anda segera.');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan sistem. Silakan coba lagi atau hubungi kami langsung.');
        }
    }

    /**
     * Display the specified inquiry
     */
    public function show(ServiceInquiry $inquiry)
    {
        return view('admin.services.inquiries.show', compact('inquiry'));
    }

    /**
     * Update the specified inquiry
     */
    public function update(Request $request, ServiceInquiry $inquiry)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:new,contacted,quoted,converted,closed',
            'priority' => 'required|in:low,medium,high,urgent',
            'assigned_to' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:2000',
            'follow_up_date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $inquiry->update($request->only([
            'status', 'priority', 'assigned_to', 'notes', 'follow_up_date'
        ]));

        return back()->with('success', 'Inquiry updated successfully.');
    }

    /**
     * Remove the specified inquiry
     */
    public function destroy(ServiceInquiry $inquiry)
    {
        $inquiry->delete();
        return redirect()->route('admin.inquiries.index')
                        ->with('success', 'Inquiry deleted successfully.');
    }

    /**
     * Convert inquiry to order
     */
    public function convertToOrder(Request $request, ServiceInquiry $inquiry)
    {
        $validator = Validator::make($request->all(), [
            'package_name' => 'required|string',
            'price' => 'required|numeric|min:0',
            'billing_type' => 'required|in:project,monthly',
            'requirements' => 'nullable|array',
            'features' => 'nullable|array',
            'timeline' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        try {
            $order = $inquiry->convertToOrder([
                'service_type' => $inquiry->service_type,
                'package_name' => $request->package_name,
                'billing_type' => $request->billing_type,
                'price' => $request->price,
                'requirements' => $request->requirements,
                'features' => $request->features,
                'timeline' => $request->timeline,
                'status' => 'pending',
                'payment_status' => 'pending',
            ]);

            return redirect()->route('admin.orders.show', $order)
                           ->with('success', 'Inquiry successfully converted to order.');

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to convert inquiry to order: ' . $e->getMessage());
        }
    }

    /**
     * Get inquiries that need follow up
     */
    public function needFollowUp()
    {
        $inquiries = ServiceInquiry::needFollowUp()
                                  ->orderBy('follow_up_date', 'asc')
                                  ->get();

        return view('admin.services.inquiries.follow-up', compact('inquiries'));
    }

    /**
     * Determine priority based on request data
     */
    private function determinePriority(Request $request)
    {
        // Auto-determine priority based on certain criteria
        $priority = 'medium'; // default

        // High budget = high priority
        if ($request->budget_range && str_contains(strtolower($request->budget_range), '10+')) {
            $priority = 'high';
        }

        // Urgent timeline = high priority
        if ($request->timeline && str_contains(strtolower($request->timeline), 'urgent')) {
            $priority = 'urgent';
        }

        // Company inquiry = higher priority than personal
        if ($request->company) {
            $priority = $priority === 'medium' ? 'high' : $priority;
        }

        return $priority;
    }

    /**
     * Send admin notification (implement as needed)
     */
    private function sendAdminNotification(ServiceInquiry $inquiry)
    {
        // Implement email notification to admin
        // Mail::to(config('app.admin_email'))->send(new NewInquiryNotification($inquiry));
    }
}
