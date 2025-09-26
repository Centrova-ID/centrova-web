<?php

namespace App\Http\Controllers\Domain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Domain\DomainPricing;
use App\Services\Domain\DomainSearchService;
use App\Services\Domain\DomainSuggestionService;

class DomainSearchController extends Controller
{
    protected DomainSearchService $domainSearchService;
    protected DomainSuggestionService $suggestionService;

    public function __construct(
        DomainSearchService $domainSearchService,
        DomainSuggestionService $suggestionService
    ) {
        $this->domainSearchService = $domainSearchService;
        $this->suggestionService = $suggestionService;
    }

    /**
     * Show domain search page
     */
    public function index()
    {
        $popularTlds = DomainPricing::getPopularTlds();
        $allTlds = DomainPricing::getAvailableTlds();

        return view('domain.search.index', compact('popularTlds', 'allTlds'));
    }

    /**
     * Search for domain availability
     */
    public function search(Request $request): JsonResponse
    {
        $request->validate([
            'domain' => 'required|string|min:2|max:63|regex:/^[a-zA-Z0-9]([a-zA-Z0-9-]*[a-zA-Z0-9])?$/',
            'tlds' => 'array',
            'tlds.*' => 'string|exists:domain_pricing,tld'
        ]);

        $domain = strtolower(trim($request->input('domain')));
        $tlds = $request->input('tlds', []);

        // If no TLDs specified, use popular ones
        if (empty($tlds)) {
            $tlds = DomainPricing::getPopularTlds()->pluck('tld')->toArray();
        }

        try {
            $results = $this->domainSearchService->searchDomains($domain, $tlds);
            
            // Get suggestions for unavailable domains
            $suggestions = [];
            $unavailableDomains = collect($results)->where('available', false)->pluck('domain')->toArray();
            
            if (!empty($unavailableDomains)) {
                $suggestions = $this->suggestionService->getSuggestions($domain, 5);
            }

            return response()->json([
                'success' => true,
                'results' => $results,
                'suggestions' => $suggestions,
                'search_term' => $domain
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mencari domain. Silakan coba lagi.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Get domain suggestions
     */
    public function suggestions(Request $request): JsonResponse
    {
        $request->validate([
            'domain' => 'required|string|min:2|max:63',
            'limit' => 'integer|min:1|max:20'
        ]);

        $domain = strtolower(trim($request->input('domain')));
        $limit = $request->input('limit', 10);

        try {
            $suggestions = $this->suggestionService->getSuggestions($domain, $limit);

            return response()->json([
                'success' => true,
                'suggestions' => $suggestions
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mendapatkan saran domain.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Check single domain availability
     */
    public function checkAvailability(Request $request): JsonResponse
    {
        $request->validate([
            'domain' => 'required|string|regex:/^[a-zA-Z0-9]([a-zA-Z0-9-]*[a-zA-Z0-9])?\.[a-zA-Z]{2,}$/'
        ]);

        $fullDomain = strtolower(trim($request->input('domain')));

        try {
            $result = $this->domainSearchService->checkSingleDomain($fullDomain);

            return response()->json([
                'success' => true,
                'result' => $result
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat memeriksa ketersediaan domain.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Get pricing information for TLDs
     */
    public function pricing(): JsonResponse
    {
        $pricing = DomainPricing::active()
            ->ordered()
            ->get()
            ->map(function ($tld) {
                return [
                    'tld' => $tld->tld,
                    'display_name' => $tld->display_name,
                    'registration_price' => $tld->registration_price,
                    'renewal_price' => $tld->renewal_price,
                    'formatted_registration_price' => $tld->formatted_registration_price,
                    'formatted_renewal_price' => $tld->formatted_renewal_price,
                    'is_popular' => $tld->is_featured,
                    'min_years' => $tld->min_years,
                    'max_years' => $tld->max_years,
                    'has_privacy' => $tld->hasPrivacyProtection(),
                    'privacy_price' => $tld->privacy_price
                ];
            });

        return response()->json([
            'success' => true,
            'pricing' => $pricing
        ]);
    }
}
