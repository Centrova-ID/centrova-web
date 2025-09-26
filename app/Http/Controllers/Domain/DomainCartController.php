<?php

namespace App\Http\Controllers\Domain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;
use App\Models\Domain\DomainPricing;
use App\Services\Domain\DomainSearchService;

class DomainCartController extends Controller
{
    protected DomainSearchService $searchService;

    public function __construct(DomainSearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    /**
     * Show cart page
     */
    public function index()
    {
        $cart = $this->getCart();
        $totals = $this->calculateTotals($cart);

        return view('domain.cart.index', compact('cart', 'totals'));
    }

    /**
     * Add domain to cart
     */
    public function add(Request $request): JsonResponse
    {
        $request->validate([
            'domain' => 'required|string|regex:/^[a-zA-Z0-9]([a-zA-Z0-9-]*[a-zA-Z0-9])?\.[a-zA-Z]{2,}$/',
            'years' => 'integer|min:1|max:10',
            'privacy_protection' => 'boolean'
        ]);

        $domain = strtolower(trim($request->input('domain')));
        $years = $request->input('years', 1);
        $privacyProtection = $request->boolean('privacy_protection');

        try {
            // Check if domain is available
            $domainCheck = $this->searchService->checkSingleDomain($domain);
            
            if (!$domainCheck['available'] || !$domainCheck['supported']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Domain tidak tersedia atau tidak didukung.'
                ], 400);
            }

            // Get current cart
            $cart = $this->getCart();

            // Check if domain already in cart
            if (isset($cart[$domain])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Domain sudah ada di keranjang.'
                ], 400);
            }

            // Extract TLD and get pricing
            $parts = explode('.', $domain);
            $tld = implode('.', array_slice($parts, 1));
            $pricing = DomainPricing::getPricingForTld($tld);

            if (!$pricing) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pricing tidak ditemukan untuk TLD ini.'
                ], 400);
            }

            // Validate years
            if ($years < $pricing->min_years || $years > $pricing->max_years) {
                return response()->json([
                    'success' => false,
                    'message' => "Durasi harus antara {$pricing->min_years} - {$pricing->max_years} tahun."
                ], 400);
            }

            // Calculate prices
            $registrationPrice = $pricing->registration_price * $years;
            $privacyPrice = $privacyProtection && $pricing->hasPrivacyProtection() 
                ? $pricing->privacy_price * $years 
                : 0;
            $totalPrice = $registrationPrice + $privacyPrice;

            // Add to cart
            $cart[$domain] = [
                'domain' => $domain,
                'tld' => $tld,
                'years' => $years,
                'privacy_protection' => $privacyProtection,
                'registration_price' => $pricing->registration_price,
                'privacy_price' => $pricing->privacy_price,
                'total_registration_price' => $registrationPrice,
                'total_privacy_price' => $privacyPrice,
                'total_price' => $totalPrice,
                'added_at' => now()->toISOString()
            ];

            $this->saveCart($cart);

            return response()->json([
                'success' => true,
                'message' => 'Domain berhasil ditambahkan ke keranjang.',
                'cart_count' => count($cart),
                'totals' => $this->calculateTotals($cart)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menambahkan domain ke keranjang.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Remove domain from cart
     */
    public function remove(Request $request): JsonResponse
    {
        $request->validate([
            'domain' => 'required|string'
        ]);

        $domain = strtolower(trim($request->input('domain')));
        $cart = $this->getCart();

        if (!isset($cart[$domain])) {
            return response()->json([
                'success' => false,
                'message' => 'Domain tidak ditemukan di keranjang.'
            ], 404);
        }

        unset($cart[$domain]);
        $this->saveCart($cart);

        return response()->json([
            'success' => true,
            'message' => 'Domain berhasil dihapus dari keranjang.',
            'cart_count' => count($cart),
            'totals' => $this->calculateTotals($cart)
        ]);
    }

    /**
     * Update domain in cart
     */
    public function update(Request $request): JsonResponse
    {
        $request->validate([
            'domain' => 'required|string',
            'years' => 'integer|min:1|max:10',
            'privacy_protection' => 'boolean'
        ]);

        $domain = strtolower(trim($request->input('domain')));
        $years = $request->input('years');
        $privacyProtection = $request->boolean('privacy_protection');

        $cart = $this->getCart();

        if (!isset($cart[$domain])) {
            return response()->json([
                'success' => false,
                'message' => 'Domain tidak ditemukan di keranjang.'
            ], 404);
        }

        try {
            $cartItem = $cart[$domain];
            $pricing = DomainPricing::getPricingForTld($cartItem['tld']);

            if (!$pricing) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pricing tidak ditemukan.'
                ], 400);
            }

            // Validate years
            if ($years < $pricing->min_years || $years > $pricing->max_years) {
                return response()->json([
                    'success' => false,
                    'message' => "Durasi harus antara {$pricing->min_years} - {$pricing->max_years} tahun."
                ], 400);
            }

            // Recalculate prices
            $registrationPrice = $pricing->registration_price * $years;
            $privacyPrice = $privacyProtection && $pricing->hasPrivacyProtection() 
                ? $pricing->privacy_price * $years 
                : 0;
            $totalPrice = $registrationPrice + $privacyPrice;

            // Update cart item
            $cart[$domain]['years'] = $years;
            $cart[$domain]['privacy_protection'] = $privacyProtection;
            $cart[$domain]['total_registration_price'] = $registrationPrice;
            $cart[$domain]['total_privacy_price'] = $privacyPrice;
            $cart[$domain]['total_price'] = $totalPrice;

            $this->saveCart($cart);

            return response()->json([
                'success' => true,
                'message' => 'Keranjang berhasil diperbarui.',
                'cart_item' => $cart[$domain],
                'totals' => $this->calculateTotals($cart)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui keranjang.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Clear cart
     */
    public function clear(): JsonResponse
    {
        Session::forget('domain_cart');

        return response()->json([
            'success' => true,
            'message' => 'Keranjang berhasil dikosongkan.',
            'cart_count' => 0,
            'totals' => $this->calculateTotals([])
        ]);
    }

    /**
     * Get cart count
     */
    public function count(): JsonResponse
    {
        $cart = $this->getCart();

        return response()->json([
            'success' => true,
            'count' => count($cart)
        ]);
    }

    /**
     * Get cart contents
     */
    public function contents(): JsonResponse
    {
        $cart = $this->getCart();
        $totals = $this->calculateTotals($cart);

        return response()->json([
            'success' => true,
            'cart' => array_values($cart),
            'totals' => $totals
        ]);
    }

    /**
     * Get cart from session
     */
    protected function getCart(): array
    {
        return Session::get('domain_cart', []);
    }

    /**
     * Save cart to session
     */
    protected function saveCart(array $cart): void
    {
        Session::put('domain_cart', $cart);
    }

    /**
     * Calculate cart totals
     */
    protected function calculateTotals(array $cart): array
    {
        $subtotal = 0;
        $privacyTotal = 0;
        $itemCount = count($cart);

        foreach ($cart as $item) {
            $subtotal += $item['total_registration_price'];
            $privacyTotal += $item['total_privacy_price'];
        }

        $taxRate = 0.11; // 11% PPN
        $taxAmount = ($subtotal + $privacyTotal) * $taxRate;
        $total = $subtotal + $privacyTotal + $taxAmount;

        return [
            'item_count' => $itemCount,
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
