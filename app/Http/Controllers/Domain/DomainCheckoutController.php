<?php

namespace App\Http\Controllers\Domain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\DomainOrder;
use App\Models\Domain;
use App\Services\DomainRegistrationService;
use App\Services\PaymentService;

class DomainCheckoutController extends Controller
{
    /**
     * Show checkout page
     */
    public function index()
    {
        $cart = Session::get('domain_cart', []);
        
        if (empty($cart)) {
            return redirect()->route('domain.search.index')
                ->with('error', 'Keranjang domain kosong. Silakan pilih domain terlebih dahulu.');
        }

        $totals = $this->calculateTotals($cart);
        $user = Auth::user();

        return view('domain.checkout.index', compact('cart', 'totals', 'user'));
    }

    /**
     * Process checkout
     */
    public function process(Request $request)
    {
        $request->validate([
            'billing_name' => 'required|string|max:255',
            'billing_email' => 'required|email|max:255',
            'billing_phone' => 'required|string|max:20',
            'billing_address' => 'required|string|max:500',
            'billing_city' => 'required|string|max:100',
            'billing_postal_code' => 'required|string|max:10',
            'payment_method' => 'required|in:bank_transfer,credit_card,e_wallet',
            'terms_accepted' => 'required|accepted'
        ]);

        $cart = Session::get('domain_cart', []);
        
        if (empty($cart)) {
            return redirect()->route('domain.search.index')
                ->with('error', 'Keranjang domain kosong.');
        }

        try {
            DB::connection('account')->beginTransaction();

            // Create order
            $order = $this->createOrder($cart, $request->all());

            // Process payment
            $paymentService = new PaymentService();
            $paymentResult = $paymentService->processPayment($order, [
                'method' => $request->input('payment_method')
            ]);

            if ($paymentResult['success']) {
                // Register domains
                $this->registerDomains($order);
                
                // Clear cart
                Session::forget('domain_cart');
                
                DB::connection('account')->commit();

                return redirect()->route('domain.checkout.success', $order)
                    ->with('success', 'Domain berhasil didaftarkan!');
            } else {
                DB::connection('account')->rollBack();
                
                return redirect()->route('domain.checkout.failed', $order)
                    ->with('error', $paymentResult['message']);
            }

        } catch (\Exception $e) {
            DB::connection('account')->rollBack();
            
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan saat memproses pesanan: ' . $e->getMessage());
        }
    }

    /**
     * Show success page
     */
    public function success(DomainOrder $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(404);
        }

        $domains = Domain::where('user_id', Auth::id())
            ->whereIn('domain_name', $order->domains)
            ->get();

        return view('domain.checkout.success', compact('order', 'domains'));
    }

    /**
     * Show failed page
     */
    public function failed(DomainOrder $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(404);
        }

        return view('domain.checkout.failed', compact('order'));
    }

    /**
     * Create domain order
     */
    protected function createOrder(array $cart, array $billingData): DomainOrder
    {
        $totals = $this->calculateTotals($cart);

        $order = DomainOrder::create([
            'order_number' => DomainOrder::generateOrderNumber(),
            'user_id' => Auth::id(),
            'domains' => array_keys($cart),
            'subtotal' => $totals['subtotal'],
            'tax_amount' => $totals['tax_amount'],
            'total_amount' => $totals['total'],
            'currency' => 'IDR',
            'status' => 'pending',
            'payment_status' => 'pending',
            'payment_method' => $billingData['payment_method'],
            'order_details' => [
                'items' => array_values($cart),
                'totals' => $totals
            ],
            'billing_info' => [
                'name' => $billingData['billing_name'],
                'email' => $billingData['billing_email'],
                'phone' => $billingData['billing_phone'],
                'address' => $billingData['billing_address'],
                'city' => $billingData['billing_city'],
                'postal_code' => $billingData['billing_postal_code']
            ]
        ]);

        return $order;
    }

    /**
     * Register domains after successful payment
     */
    protected function registerDomains(DomainOrder $order): void
    {
        // $registrationService = new DomainRegistrationService();
        
        foreach ($order->order_details['items'] as $item) {
            $domain = Domain::create([
                'domain_name' => $item['domain'],
                'user_id' => $order->user_id,
                'tld' => $item['tld'],
                'status' => 'pending',
                'registration_date' => now(),
                'expiry_date' => now()->addYears($item['years']),
                'auto_renew' => false,
                'registration_price' => $item['registration_price'],
                'renewal_price' => $item['registration_price'], // Same as registration for now
                'nameservers' => ['ns1.centrova.com', 'ns2.centrova.com'],
                'privacy_protection' => $item['privacy_protection'],
                'privacy_price' => $item['privacy_price']
            ]);

            // Register with external registrar (simplified for demo)
            // $registrationService->registerDomain($domain, $order->billing_info);
        }

        // Update order status
        $order->update([
            'status' => 'completed',
            'payment_status' => 'paid',
            'paid_at' => now()
        ]);
    }

    /**
     * Calculate cart totals
     */
    protected function calculateTotals(array $cart): array
    {
        $subtotal = 0;
        $privacyTotal = 0;

        foreach ($cart as $item) {
            $subtotal += $item['total_registration_price'];
            $privacyTotal += $item['total_privacy_price'];
        }

        $taxRate = 0.11; // 11% PPN
        $taxAmount = ($subtotal + $privacyTotal) * $taxRate;
        $total = $subtotal + $privacyTotal + $taxAmount;

        return [
            'item_count' => count($cart),
            'subtotal' => $subtotal,
            'privacy_total' => $privacyTotal,
            'tax_rate' => $taxRate,
            'tax_amount' => $taxAmount,
            'total' => $total,
            'formatted' => [
                'subtotal' => 'Rp ' . number_format($subtotal, 0, ',', '.'),
                'privacy_total' => 'Rp ' . number_format($privacyTotal, 0, ',', '.'),
                'tax_amount' => 'Rp ' . number_format($taxAmount, 0, ',', '.'),
                'total' => 'Rp ' . number_format($total, 0, ',', '.')
            ]
        ];
    }
}
