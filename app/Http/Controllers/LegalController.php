<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\PrivacyContactInquiry;
use Barryvdh\DomPDF\Facade\Pdf;

class LegalController extends Controller
{
    public function index()
    {
        return view('legal.index');
    }

    public function privacy()
    {
        return view('legal.privacy');
    }

    public function privacyPdf()
    {
        // Generate PDF with all sections expanded
        $pdf = Pdf::loadView('legal.privacy-pdf');
        
        // Set paper size and orientation
        $pdf->setPaper('A4', 'portrait');
        
        // Set options for better rendering. Use DejaVu Sans (bundled with dompdf)
        // and increase DPI so fonts and spacing look closer to the web layout
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isPhpEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'DejaVu Sans',
            // raise DPI to improve font metrics and reduce "squashed" appearance
            'dpi' => 150,
            'fontSubsetting' => true,
        ]);
        
        // Return PDF download with filename
        return $pdf->download('Kebijakan-Privasi-Centrova-' . date('Y-m-d') . '.pdf');
    }

    public function privacyContact()
    {
        return view('legal.privacy.contact');
    }

    public function submitPrivacyContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'country' => 'required|string|max:255',
            'inquiry_type' => 'required|string|max:255',
            'subject' => 'required|string|max:500',
            'message' => 'required|string|max:1000',
            'human_verification' => 'required|accepted',
            'privacy_consent' => 'required|accepted',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Save to database
            $inquiry = PrivacyContactInquiry::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'country' => $request->country,
                'inquiry_type' => $request->inquiry_type,
                'subject' => $request->subject,
                'message' => $request->message,
                'status' => 'submitted',
                'submitted_at' => now(),
            ]);

            // Send notification email to privacy officer
            $this->sendNotificationToPrivacyOfficer($inquiry);

            // Send auto-reply to customer
            $this->sendAutoReplyToCustomer($inquiry);

            return response()->json([
                'success' => true,
                'message' => 'Terima kasih! Pertanyaan Anda telah dikirim. Kami akan merespons dalam 2-5 hari kerja.',
                'inquiry_id' => $inquiry->id
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengirim formulir. Silakan coba lagi.'
            ], 500);
        }
    }

    private function sendNotificationToPrivacyOfficer($inquiry)
    {
        // TODO: Implement email notification to privacy officer
        // For now, we'll just log it
        Log::info('Privacy inquiry submitted', [
            'inquiry_id' => $inquiry->id,
            'customer' => $inquiry->first_name . ' ' . $inquiry->last_name,
            'email' => $inquiry->email,
            'type' => $inquiry->inquiry_type
        ]);
    }

    private function sendAutoReplyToCustomer($inquiry)
    {
        // TODO: Implement auto-reply email to customer
        // For now, we'll just log it
        Log::info('Auto-reply sent to customer', [
            'inquiry_id' => $inquiry->id,
            'customer_email' => $inquiry->email
        ]);
    }

    public function terms()
    {
        return view('legal.terms');
    }

    public function license()
    {
        return view('legal.license');
    }

    public function trademark()
    {
        return view('legal.trademark');
    }

    public function copyright()
    {
        return view('legal.copyright');
    }

    public function compliance()
    {
        return view('legal.compliance');
    }

    public function opensource()
    {
        return view('legal.opensource');
    }

    public function cookies()
    {
        return view('legal.cookies');
    }

    public function supportTerms()
    {
        return view('legal.support-terms');
    }

    public function retailTerms()
    {
        return view('legal.retail-terms');
    }

    public function disclaimer()
    {
        return view('legal.disclaimer');
    }
}
