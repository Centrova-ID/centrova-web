<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display invoice page
     */
    public function index()
    {
        // Dummy data untuk invoice
        $invoiceData = [
            'invoice_number' => 'INV-' . date('Ymd') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT),
            'date' => date('Y-m-d'),
            'due_date' => date('Y-m-d', strtotime('+30 days')),
            'company' => [
                'name' => 'CENTROVA RETAIL',
                'address' => 'Jl. Teknologi Digital No. 123',
                'city' => 'Jakarta Selatan, 12345',
                'phone' => '+62 21 1234 5678',
                'email' => 'info@centrova.com',
                'website' => 'www.centrova.com'
            ],
            'customer' => [
                'name' => 'PT. Contoh Pelanggan',
                'address' => 'Jl. Pelanggan No. 456',
                'city' => 'Jakarta Pusat, 10110',
                'phone' => '+62 21 9876 5432',
                'email' => 'customer@example.com'
            ],
            'items' => [
                [
                    'description' => 'Premium Product Package',
                    'quantity' => 2,
                    'unit_price' => 1250000,
                    'amount' => 2500000
                ],
                [
                    'description' => 'Professional Service',
                    'quantity' => 1,
                    'unit_price' => 750000,
                    'amount' => 750000
                ],
                [
                    'description' => 'Support & Maintenance',
                    'quantity' => 1,
                    'unit_price' => 500000,
                    'amount' => 500000
                ]
            ],
            'subtotal' => 3750000,
            'tax_rate' => 11,
            'tax_amount' => 412500,
            'total' => 4162500,
            'payment_method' => 'Transfer Bank',
            'bank_details' => [
                'bank_name' => 'Bank Central Asia',
                'account_number' => '1234567890',
                'account_name' => 'PT. Centrova Retail'
            ],
            'notes' => 'Terima kasih atas kepercayaan Anda menggunakan layanan Centrova. Pembayaran dapat dilakukan melalui transfer bank ke rekening yang tertera.'
        ];

        return view('invoice.index', compact('invoiceData'));
    }

    /**
     * Generate PDF invoice
     */
    public function generatePDF($invoiceId = null)
    {
        // Implementasi untuk generate PDF akan ditambahkan nanti
        return redirect()->route('invoice.index')->with('success', 'PDF generation feature will be available soon');
    }

    /**
     * Send invoice via email
     */
    public function sendEmail($invoiceId = null)
    {
        // Implementasi untuk send email akan ditambahkan nanti
        return redirect()->route('invoice.index')->with('success', 'Email sending feature will be available soon');
    }
}
