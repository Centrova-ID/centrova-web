<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\DomainOrder;
use App\Models\DomainPricing;
use App\Services\DomainApiService;
use App\Services\DomainRegistrationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class DomainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'search']);
    }

    /**
     * Display domain search page
     */
    public function index()
    {
        $featuredTlds = DomainPricing::featured()->available()->ordered()->get();
        $popularTlds = DomainPricing::featured()->available()->ordered()->get(); // Using featured instead of popular
        $allTlds = DomainPricing::available()->ordered()->get(); // Add all TLDs

        return view('domain.search.index', compact('featuredTlds', 'popularTlds', 'allTlds'));
    }

    /**
     * Domain search API endpoint
     */
    public function search(Request $request)
    {
        $request->validate([
            'domain' => 'required|string|min:1|max:63|regex:/^[a-z0-9][a-z0-9\-]*[a-z0-9]?$/i',
            'tlds' => 'sometimes|array',
            'tlds.*' => 'string'
        ]);

        $domainName = strtolower($request->domain);
        $tlds = $request->tlds ?? ['com', 'id', 'net'];
        
        // Ensure TLDs have dots
        $tlds = array_map(function($tld) {
            return strpos($tld, '.') === 0 ? $tld : '.' . $tld;
        }, $tlds);

        // Check if domain name contains blocked words
        $blockedWords = config('domain.validation.blocked_words', []);
        foreach ($blockedWords as $word) {
            if (stripos($domainName, $word) !== false) {
                return response()->json([
                    'success' => false,
                    'message' => 'Nama domain mengandung kata yang tidak diperbolehkan'
                ]);
            }
        }

        try {
            $domainApiService = new DomainApiService();
            $results = $domainApiService->checkAvailability($domainName, $tlds);
            $suggestions = [];

            // Get suggestions if some domains are unavailable
            $unavailableCount = collect($results)->where('available', false)->count();
            if ($unavailableCount > 0) {
                $suggestions = $domainApiService->getSuggestedDomains($domainName, 5);
            }

            return response()->json([
                'success' => true,
                'results' => $results,
                'suggestions' => $suggestions,
                'search_term' => $domainName
            ]);
        } catch (\Exception $e) {
            Log::error('Domain search error: ' . $e->getMessage(), [
                'domain' => $domainName,
                'tlds' => $tlds,
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mencari domain. Silakan coba lagi.',
                'error' => app()->environment('local') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Show user's domains dashboard
     */
    public function dashboard()
    {
        $user = Auth::user();
        $domains = Domain::where('user_id', $user->id)->paginate(10);
        
        $stats = [
            'total_domains' => Domain::where('user_id', $user->id)->count(),
            'active_domains' => Domain::where('user_id', $user->id)->where('status', 'active')->count(),
            'expiring_soon' => Domain::where('user_id', $user->id)->where('expiry_date', '<=', now()->addDays(30))->count(),
            'expired_domains' => Domain::where('user_id', $user->id)->where('status', 'expired')->count(),
        ];

        return view('domains.dashboard', compact('domains', 'stats'));
    }

    /**
     * Show domain details
     */
    public function show(Domain $domain)
    {
        $this->authorize('view', $domain);
        
        $domain->load('nameserverRecords');
        
        return view('domains.show', compact('domain'));
    }

    /**
     * Show domain renewal page
     */
    public function showRenewal(Domain $domain)
    {
        $this->authorize('update', $domain);

        if (!$domain->canBeRenewed()) {
            return redirect()->route('domains.show', $domain)
                ->with('error', 'Domain ini tidak dapat diperpanjang pada saat ini.');
        }

        $pricing = DomainPricing::getPricing($domain->tld);
        $availableYears = $pricing ? $pricing->getAvailableYears() : [1];

        return view('domains.renew', compact('domain', 'pricing', 'availableYears'));
    }

    /**
     * Process domain renewal
     */
    public function processRenewal(Request $request, Domain $domain)
    {
        $this->authorize('update', $domain);

        $request->validate([
            'years' => 'required|integer|min:1|max:10'
        ]);

        $registrationService = new DomainRegistrationService();
        $result = $registrationService->processRenewal($domain, $request->years);

        if ($result['success']) {
            return redirect()->route('domains.show', $domain)
                ->with('success', $result['message']);
        }

        return back()->with('error', $result['message']);
    }

    /**
     * Show nameserver management page
     */
    public function showNameservers(Domain $domain)
    {
        $this->authorize('update', $domain);

        if (!$domain->canUpdateNameservers()) {
            return redirect()->route('domains.show', $domain)
                ->with('error', 'Nameserver domain ini tidak dapat diubah pada saat ini.');
        }

        $domain->load('nameserverRecords');
        $currentNameservers = $domain->nameservers ?? [];

        return view('domains.nameservers', compact('domain', 'currentNameservers'));
    }

    /**
     * Update domain nameservers
     */
    public function updateNameservers(Request $request, Domain $domain)
    {
        $this->authorize('update', $domain);

        $request->validate([
            'nameservers' => 'required|array|min:2|max:4',
            'nameservers.*' => 'required|string|regex:/^[a-z0-9][a-z0-9\-\.]*[a-z0-9]$/'
        ]);

        $oldNameservers = $domain->nameservers ?? [];
        $newNameservers = array_filter($request->nameservers);

        $registrationService = new DomainRegistrationService();
        $result = $registrationService->updateNameservers($domain, $newNameservers);

        if ($result['success']) {
            return redirect()->route('domains.show', $domain)
                ->with('success', $result['message']);
        }

        return back()->with('error', $result['message'])->withInput();
    }

    /**
     * Toggle auto-renewal
     */
    public function toggleAutoRenewal(Domain $domain)
    {
        $this->authorize('update', $domain);

        $domain->update([
            'auto_renew' => !$domain->auto_renew
        ]);

        $status = $domain->auto_renew ? 'diaktifkan' : 'dinonaktifkan';
        
        return back()->with('success', "Auto-renewal berhasil {$status}.");
    }

    /**
     * Show domain orders
     */
    public function orders()
    {
        $user = Auth::user();
        $orders = DomainOrder::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);

        return view('domains.orders.index', compact('orders'));
    }

    /**
     * Show specific order
     */
    public function showOrder(DomainOrder $order)
    {
        $this->authorize('view', $order);

        return view('domains.orders.show', compact('order'));
    }

    /**
     * Add domain to cart
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'domain' => 'required|string',
            'years' => 'sometimes|integer|min:1|max:10',
            'privacy_protection' => 'sometimes|boolean'
        ]);

        $cart = Session::get('domain_cart', []);
        $domain = $request->domain;
        
        if (!isset($cart[$domain])) {
            $cart[$domain] = [
                'domain' => $domain,
                'years' => $request->years ?? 1,
                'privacy_protection' => $request->privacy_protection ?? false,
                'added_at' => now()
            ];
            
            Session::put('domain_cart', $cart);
            
            return response()->json([
                'success' => true,
                'message' => 'Domain berhasil ditambahkan ke keranjang',
                'cart_count' => count($cart)
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Domain sudah ada di keranjang'
        ]);
    }

    /**
     * Get cart count
     */
    public function getCartCount()
    {
        $cart = Session::get('domain_cart', []);
        
        return response()->json([
            'success' => true,
            'count' => count($cart)
        ]);
    }

    /**
     * Remove domain from cart
     */
    public function removeFromCart(Request $request)
    {
        $request->validate([
            'domain' => 'required|string'
        ]);

        $cart = Session::get('domain_cart', []);
        $cart = array_values(array_filter($cart, function($item) use ($request) {
            return $item !== $request->domain;
        }));

        Session::put('domain_cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Domain dihapus dari keranjang',
            'cart_count' => count($cart)
        ]);
    }

    /**
     * Show cart
     */
    public function showCart()
    {
        $cart = Session::get('domain_cart', []);
        $cartItems = [];
        $total = 0;

        foreach ($cart as $domainName) {
            $parts = explode('.', $domainName, 2);
            $tld = '.' . $parts[1];
            $pricing = DomainPricing::getPricing($tld);

            if ($pricing) {
                $cartItems[] = [
                    'domain' => $domainName,
                    'tld' => $tld,
                    'price' => $pricing->registration_price,
                    'formatted_price' => $pricing->formatted_registration_price
                ];
                $total += $pricing->registration_price;
            }
        }

        $tax = $total * config('domain.payment.tax_rate', 0.11);
        $grandTotal = $total + $tax;

        return view('domains.cart', compact('cartItems', 'total', 'tax', 'grandTotal'));
    }

    /**
     * Clear cart
     */
    public function clearCart()
    {
        Session::forget('domain_cart');

        return redirect()->route('domains.cart')
            ->with('success', 'Keranjang berhasil dikosongkan');
    }

    /**
     * Sync domain with external provider
     */
    public function sync(Domain $domain)
    {
        $this->authorize('update', $domain);

        $registrationService = new DomainRegistrationService();
        $result = $registrationService->syncDomainInfo($domain);

        if ($result['success']) {
            return back()->with('success', $result['message']);
        }

        return back()->with('error', $result['message']);
    }
}