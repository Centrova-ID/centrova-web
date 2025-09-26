<?php

namespace App\Http\Controllers;

use App\Models\DomainOrder;
use App\Models\DomainPricing;
use App\Services\DomainEmailService;
use App\Services\DomainRegistrationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class DomainCheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show checkout page
     */
    public function index()
    {
        $cart = Session::get('domain_cart', []);

        if (empty($cart)) {
            return redirect()->route('domains.index')
                ->with('error', 'Keranjang domain kosong. Silakan pilih domain terlebih dahulu.');
        }

        $cartItems = [];
        $subtotal = 0;

        foreach ($cart as $domainName) {
            $parts = explode('.', $domainName, 2);
            $tld = '.' . $parts[1];
            $pricing = DomainPricing::getPricing($tld);

            if ($pricing) {
                $cartItems[] = [
                    'domain' => $domainName,
                    'tld' => $tld,
                    'price' => $pricing->registration_price,
                    'formatted_price' => $pricing->formatted_registration_price,
                    'years' => 1 // Default 1 year
                ];
                $subtotal += $pricing->registration_price;
            }
        }

        $taxRate = config('domain.payment.tax_rate', 0.11);
        $taxAmount = $subtotal * $taxRate;
        $total = $subtotal + $taxAmount;

        $user = Auth::user();

        return view('domains.checkout.index', compact(
            'cartItems', 
            'subtotal', 
            'taxAmount', 
            'total', 
            'taxRate',
            'user'
        ));
    }

    /**
     * Process checkout and create order
     */
    public function process(Request $request)
    {
        $request->validate([
            'billing_name' => 'required|string|max:255',
            'billing_email' => 'required|email|max:255',
            'billing_phone' => 'required|string|max:20',
            'billing_address' => 'required|string|max:500',
            'billing_city' => 'required|string|max:100',
            'billing_state' => 'required|string|max:100',
            'billing_country' => 'required|string|size:2',
            'billing_postal_code' => 'required|string|max:10',
            'payment_method' => 'required|in:bank_transfer,credit_card,e_wallet',
            'terms_accepted' => 'required|accepted'
        ]);

        $cart = Session::get('domain_cart', []);

        if (empty($cart)) {
            return redirect()->route('domains.index')
                ->with('error', 'Keranjang domain kosong.');
        }

        try {
            DB::beginTransaction();

            // Calculate totals
            $subtotal = 0;
            $validDomains = [];

            foreach ($cart as $domainName) {
                $parts = explode('.', $domainName, 2);
                $tld = '.' . $parts[1];
                $pricing = DomainPricing::getPricing($tld);

                if ($pricing && $pricing->is_available) {
                    $validDomains[] = $domainName;
                    $subtotal += $pricing->registration_price;
                }
            }

            if (empty($validDomains)) {
                throw new \Exception('Tidak ada domain yang valid dalam keranjang.');
            }

            $taxRate = config('domain.payment.tax_rate', 0.11);
            $taxAmount = $subtotal * $taxRate;
            $total = $subtotal + $taxAmount;

            // Create domain order
            $order = DomainOrder::create([
                'user_id' => Auth::id(),
                'order_number' => DomainOrder::generateOrderNumber(),
                'domains' => $validDomains,
                'order_type' => 'registration',
                'status' => 'pending',
                'subtotal' => $subtotal,
                'tax_amount' => $taxAmount,
                'discount_amount' => 0,
                'total_amount' => $total,
                'payment_status' => 'pending',
                'payment_method' => $request->payment_method,
                'billing_details' => json_encode([
                    'name' => $request->billing_name,
                    'email' => $request->billing_email,
                    'phone' => $request->billing_phone,
                    'address' => $request->billing_address,
                    'city' => $request->billing_city,
                    'state' => $request->billing_state,
                    'country' => $request->billing_country,
                    'postal_code' => $request->billing_postal_code
                ]),
                'order_details' => json_encode([
                    'items' => array_map(function($domain) {
                        $parts = explode('.', $domain, 2);
                        $tld = '.' . $parts[1];
                        $pricing = DomainPricing::getPricing($tld);
                        return [
                            'domain' => $domain,
                            'tld' => $tld,
                            'price' => $pricing->registration_price,
                            'years' => 1
                        ];
                    }, $validDomains),
                    'tax_rate' => $taxRate
                ])
            ]);

            // Send order confirmation email
            $emailService = new DomainEmailService();
            $emailService->sendOrderConfirmation(Auth::user(), $order);

            // Clear cart
            Session::forget('domain_cart');

            DB::commit();

            return redirect()->route('domains.checkout.payment', $order->id)
                ->with('success', 'Pesanan berhasil dibuat. Silakan lakukan pembayaran.');

        } catch (\Exception $e) {
            DB::rollback();
            
            return back()
                ->withInput()
                ->with('error', 'Gagal membuat pesanan: ' . $e->getMessage());
        }
    }

    /**
     * Show payment page
     */
    public function showPayment(DomainOrder $order)
    {
        $this->authorize('view', $order);

        if ($order->payment_status !== 'pending') {
            return redirect()->route('domains.orders.show', $order)
                ->with('info', 'Pesanan ini sudah dibayar atau dibatalkan.');
        }

        $paymentMethods = $this->getPaymentMethods();

        return view('domains.checkout.payment', compact('order', 'paymentMethods'));
    }

    /**
     * Process payment
     */
    public function processPayment(Request $request, DomainOrder $order)
    {
        $this->authorize('update', $order);

        $request->validate([
            'payment_method' => 'required|in:bank_transfer,virtual_account,credit_card,ewallet',
        ]);

        if ($order->payment_status !== 'pending') {
            return redirect()->route('domains.orders.show', $order)
                ->with('error', 'Pesanan ini sudah dibayar atau dibatalkan.');
        }

        try {
            $paymentService = new \App\Services\PaymentService();
            $result = $paymentService->processPayment($order, $request->all());

            if ($result['success']) {
                // Send payment confirmation email
                $emailService = new DomainEmailService();
                $emailService->sendPaymentConfirmation(Auth::user(), $order);

                // Trigger domain registration
                $registrationService = new DomainRegistrationService();
                $registrationResult = $registrationService->registerDomain($order);

                if ($registrationResult['success']) {
                    return redirect()->route('domains.orders.show', $order)
                        ->with('success', 'Pembayaran berhasil dan domain sedang diproses.');
                } else {
                    return redirect()->route('domains.orders.show', $order)
                        ->with('warning', 'Pembayaran berhasil, namun ada masalah dalam registrasi domain. Tim kami akan menanganinya segera.');
                }
            }

            return back()->with('error', $result['message'] ?? 'Pembayaran gagal diproses.');

        } catch (\Exception $e) {
            Log::error('Domain payment processing failed', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);

            return back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }

    /**
     * Cancel order
     */
    public function cancelOrder(DomainOrder $order)
    {
        $this->authorize('update', $order);

        if (!$order->canBeCancelled()) {
            return back()->with('error', 'Pesanan ini tidak dapat dibatalkan.');
        }

        $order->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
            'cancellation_reason' => 'Dibatalkan oleh customer'
        ]);

        return redirect()->route('domains.orders.index')
            ->with('success', 'Pesanan berhasil dibatalkan.');
    }

    /**
     * Show order success page
     */
    public function success(DomainOrder $order)
    {
        $this->authorize('view', $order);

        if ($order->status !== 'completed') {
            return redirect()->route('domains.orders.show', $order);
        }

        return view('domains.checkout.success', compact('order'));
    }

    /**
     * Get available payment methods
     */
    protected function getPaymentMethods()
    {
        return [
            'bank_transfer' => [
                'name' => 'Transfer Bank',
                'description' => 'Transfer ke rekening bank kami',
                'icon' => 'fas fa-university',
                'instructions' => 'Lakukan transfer ke rekening yang tertera dan upload bukti pembayaran.'
            ],
            'credit_card' => [
                'name' => 'Kartu Kredit',
                'description' => 'Pembayaran dengan kartu kredit/debit',
                'icon' => 'fas fa-credit-card',
                'instructions' => 'Masukkan detail kartu kredit Anda untuk pembayaran instan.'
            ],
            'e_wallet' => [
                'name' => 'E-Wallet',
                'description' => 'GoPay, OVO, DANA, LinkAja',
                'icon' => 'fas fa-mobile-alt',
                'instructions' => 'Scan QR code dengan aplikasi e-wallet Anda.'
            ]
        ];
    }

    /**
     * Generate payment reference
     */
    protected function generatePaymentReference($paymentMethod)
    {
        $prefix = strtoupper(substr($paymentMethod, 0, 3));
        return $prefix . '-' . date('YmdHis') . '-' . substr(uniqid(), -4);
    }

    /**
     * Webhook endpoint for payment notifications
     */
    public function webhook(Request $request)
    {
        // In a real implementation, this would handle webhooks from payment providers
        // For now, we'll just log the webhook data
        
        Log::info('Domain payment webhook received', $request->all());

        return response()->json(['status' => 'success']);
    }
}