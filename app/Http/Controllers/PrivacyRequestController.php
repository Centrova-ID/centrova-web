<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrivacyRequest;
use App\Models\User;
use App\Models\StaffUser;

class PrivacyRequestController extends Controller
{
    public function showForm()
    {
        return view('privacy.request-form');
    }

    public function submitRequest(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'request_type' => 'required|in:' . implode(',', array_keys(PrivacyRequest::getRequestTypes())),
            'description' => 'required|string|min:10',
            'phone' => 'nullable|string|max:20',
            'account_reference' => 'nullable|string|max:100'
        ]);

        // Set due date based on request type (GDPR compliance - 30 days for most requests)
        $dueDate = match($validated['request_type']) {
            PrivacyRequest::TYPE_DATA_ACCESS => now()->addDays(30),
            PrivacyRequest::TYPE_DATA_DELETION => now()->addDays(30),
            PrivacyRequest::TYPE_DATA_PORTABILITY => now()->addDays(30),
            PrivacyRequest::TYPE_CONSENT_WITHDRAWAL => now()->addDays(1), // Faster for consent withdrawal
            PrivacyRequest::TYPE_DATA_CORRECTION => now()->addDays(7),
            PrivacyRequest::TYPE_COMPLAINT => now()->addDays(5),
            default => now()->addDays(30)
        };

        // Set priority based on request type
        $priority = match($validated['request_type']) {
            PrivacyRequest::TYPE_CONSENT_WITHDRAWAL => PrivacyRequest::PRIORITY_HIGH,
            PrivacyRequest::TYPE_COMPLAINT => PrivacyRequest::PRIORITY_HIGH,
            PrivacyRequest::TYPE_DATA_DELETION => PrivacyRequest::PRIORITY_MEDIUM,
            default => PrivacyRequest::PRIORITY_MEDIUM
        };

        // Find or create user
        $user = User::where('email', $validated['customer_email'])->first();

        // Auto-assign to available privacy officer
        $privacyOfficer = StaffUser::where('role', 'privacy_officer')
            ->where('status', 'active')
            ->first();

        $privacyRequest = PrivacyRequest::create([
            'user_id' => $user?->id,
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'phone' => $validated['phone'] ?? null,
            'type' => $validated['request_type'],
            'description' => $validated['description'],
            'status' => PrivacyRequest::STATUS_PENDING,
            'priority' => $priority,
            'due_date' => $dueDate,
            'assigned_to' => $privacyOfficer?->id,
        ]);

        // Send confirmation email to customer
        // TODO: Implement email notification

        // Send notification to privacy officer
        // TODO: Implement staff notification

        return redirect()->route('privacy.request.form')
            ->with('success', 'Your privacy request has been submitted successfully. You will receive a confirmation email shortly. Reference ID: ' . $privacyRequest->id);
    }

    public function checkStatus(Request $request)
    {
        $request->validate([
            'reference_id' => 'required|integer',
            'email' => 'required|email'
        ]);

        $privacyRequest = PrivacyRequest::where('id', $request->reference_id)
            ->where('customer_email', $request->email)
            ->first();

        if (!$privacyRequest) {
            return back()->with('error', 'Privacy request not found. Please check your reference ID and email address.');
        }

        return view('privacy.status', compact('privacyRequest'));
    }
}
