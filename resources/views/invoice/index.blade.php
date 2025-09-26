<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $invoiceData['invoice_number'] }} | Centrova Retail</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom CSS for Invoice -->
    <link rel="stylesheet" href="{{ asset('assets/invoice/invoice.css') }}">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans">
    <div class="min-h-screen py-8">
        <div class="max-w-4xl mx-auto px-4">
            <!-- Header Actions -->
            <div class="no-print mb-6 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-800">Invoice Management</h1>
                <div class="flex gap-3">
                    <button onclick="printInvoice()" class="btn-centrova">
                        <i class="fas fa-print"></i>
                        Print
                    </button>
                    <button onclick="generatePDF()" class="btn-pdf px-4 py-2 rounded-lg hover:bg-red-700 transition-colors flex items-center gap-2">
                        <i class="fas fa-file-pdf"></i>
                        PDF
                    </button>
                    <button onclick="sendEmail()" class="btn-email px-4 py-2 rounded-lg hover:bg-green-700 transition-colors flex items-center gap-2">
                        <i class="fas fa-envelope"></i>
                        Email
                    </button>
                </div>
            </div>

            <!-- Invoice Container -->
            <div class="bg-white rounded-xl shadow-lg print-shadow p-8 invoice-container fade-in">
                <!-- Header -->
                <div class="flex justify-between items-start mb-8">
                    <!-- Company Logo & Info -->
                    <div class="flex items-start gap-4">
                        <div class="invoice-logo">
                            <!-- Centrova Logo SVG -->
                            <svg class="w-12 h-12 text-white" viewBox="0 0 57 58.54" fill="currentColor">
                                <path d="M46.47,22.59A10.53,10.53,0,0,0,54.1,4.81l-.19-.19c-.06-.06-.12-.13-.19-.19A10.53,10.53,0,0,0,39,4.62l-7.45,7.44L39,19.51A10.5,10.5,0,0,0,46.47,22.59Z" fill="#ffb901"/>
                                <path d="M31.58,12.06,21.36,1.84a6.2,6.2,0,0,0-7.94-.73A31.92,31.92,0,0,0,9.25,4.62,31.58,31.58,0,0,0,53.92,49.28L42.59,38a6.27,6.27,0,0,0-6.88-1.31A10.53,10.53,0,0,1,24.14,19.51Z" fill="currentColor"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-centrova-blue">{{ $invoiceData['company']['name'] }}</h1>
                            <p class="text-gray-600">{{ $invoiceData['company']['address'] }}</p>
                            <p class="text-gray-600">{{ $invoiceData['company']['city'] }}</p>
                            <p class="text-gray-600">{{ $invoiceData['company']['phone'] }}</p>
                            <p class="text-centrova-blue">{{ $invoiceData['company']['email'] }}</p>
                        </div>
                    </div>
                    
                    <!-- Invoice Info -->
                    <div class="text-right">
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">INVOICE</h2>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">Invoice Number</p>
                            <p class="invoice-number">{{ $invoiceData['invoice_number'] }}</p>
                            <p class="text-sm text-gray-600 mt-2">Date</p>
                            <p class="font-medium">{{ date('d F Y', strtotime($invoiceData['date'])) }}</p>
                            <p class="text-sm text-gray-600 mt-2">Due Date</p>
                            <p class="font-medium">{{ date('d F Y', strtotime($invoiceData['due_date'])) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Customer Info -->
                <div class="mb-8">
                    <div class="customer-info">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Bill To:</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $invoiceData['customer']['name'] }}</p>
                                <p class="text-gray-600">{{ $invoiceData['customer']['address'] }}</p>
                                <p class="text-gray-600">{{ $invoiceData['customer']['city'] }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600"><i class="fas fa-phone w-4"></i> {{ $invoiceData['customer']['phone'] }}</p>
                                <p class="text-gray-600"><i class="fas fa-envelope w-4"></i> {{ $invoiceData['customer']['email'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Items Table -->
                <div class="mb-8">
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse items-table">
                            <thead>
                                <tr class="centrova-gradient text-white">
                                    <th class="text-left p-4 rounded-tl-lg">Description</th>
                                    <th class="text-center p-4">Qty</th>
                                    <th class="text-right p-4">Unit Price</th>
                                    <th class="text-right p-4 rounded-tr-lg">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invoiceData['items'] as $index => $item)
                                <tr class="border-b border-gray-200 {{ $index % 2 == 0 ? 'bg-gray-50' : 'bg-white' }}">
                                    <td class="p-4">
                                        <p class="font-medium text-gray-800">{{ $item['description'] }}</p>
                                    </td>
                                    <td class="p-4 text-center">{{ $item['quantity'] }}</td>
                                    <td class="p-4 text-right">Rp {{ number_format($item['unit_price'], 0, ',', '.') }}</td>
                                    <td class="p-4 text-right font-medium">Rp {{ number_format($item['amount'], 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Totals -->
                <div class="flex justify-end mb-8">
                    <div class="w-full md:w-1/2">
                        <div class="total-section">
                            <div class="flex justify-between mb-3">
                                <span class="text-gray-600">Subtotal:</span>
                                <span class="font-medium">Rp {{ number_format($invoiceData['subtotal'], 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between mb-3">
                                <span class="text-gray-600">Tax ({{ $invoiceData['tax_rate'] }}%):</span>
                                <span class="font-medium">Rp {{ number_format($invoiceData['tax_amount'], 0, ',', '.') }}</span>
                            </div>
                            <hr class="my-3">
                            <div class="flex justify-between text-lg font-bold">
                                <span class="text-gray-800">Total:</span>
                                <span class="total-amount">Rp {{ number_format($invoiceData['total'], 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Info -->
                <div class="mb-8">
                    <div class="payment-info">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Payment Information</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Payment Method</p>
                                <p class="font-medium">{{ $invoiceData['payment_method'] }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Bank Details</p>
                                <div class="bank-details">
                                    <p class="font-medium">{{ $invoiceData['bank_details']['bank_name'] }}</p>
                                    <p class="text-sm">{{ $invoiceData['bank_details']['account_number'] }}</p>
                                    <p class="text-sm">{{ $invoiceData['bank_details']['account_name'] }}</p>
                                </div>
                                <button onclick="copyBankDetails()" class="mt-2 text-xs text-centrova-blue hover:underline">
                                    <i class="fas fa-copy"></i> Copy Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Notes</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $invoiceData['notes'] }}</p>
                </div>

                <!-- Footer -->
                <div class="invoice-footer">
                    <p class="text-gray-600">Thank you for your business!</p>
                    <p class="text-sm text-gray-500 mt-2">{{ $invoiceData['company']['website'] }} | {{ $invoiceData['company']['email'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom JavaScript -->
    <script src="{{ asset('assets/invoice/invoice.js') }}"></script>
</body>
</html>
