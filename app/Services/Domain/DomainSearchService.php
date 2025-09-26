<?php

namespace App\Services\Domain;

use App\Models\Domain\DomainPricing;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DomainSearchService
{
    protected string $apiUrl;
    protected string $apiKey;
    protected string $apiUser;

    public function __construct()
    {
        // Configuration for ResellerClub API
        $this->apiUrl = config('services.resellerclub.api_url', 'https://test.httpapi.com/api/');
        $this->apiKey = config('services.resellerclub.api_key', 'demo-key');
        $this->apiUser = config('services.resellerclub.user_id', 'demo-user');
    }

    /**
     * Search for multiple domains
     */
    public function searchDomains(string $domain, array $tlds): array
    {
        $results = [];

        foreach ($tlds as $tld) {
            $fullDomain = $domain . '.' . $tld;
            $result = $this->checkSingleDomain($fullDomain);
            $results[] = $result;
        }

        return $results;
    }

    /**
     * Check availability of a single domain
     */
    public function checkSingleDomain(string $fullDomain): array
    {
        // Extract TLD from full domain
        $parts = explode('.', $fullDomain);
        $tld = implode('.', array_slice($parts, 1));
        $domainName = $parts[0];

        // Get pricing info
        $pricing = DomainPricing::getPricingForTld($tld);
        
        if (!$pricing) {
            return [
                'domain' => $fullDomain,
                'domain_name' => $domainName,
                'tld' => $tld,
                'available' => false,
                'supported' => false,
                'message' => 'TLD tidak didukung'
            ];
        }

        try {
            // Check with registrar API
            $available = $this->checkWithRegistrar($fullDomain);

            return [
                'domain' => $fullDomain,
                'domain_name' => $domainName,
                'tld' => $tld,
                'available' => $available,
                'supported' => true,
                'pricing' => [
                    'registration' => $pricing->registration_price,
                    'renewal' => $pricing->renewal_price,
                    'formatted_registration' => $pricing->formatted_registration_price,
                    'formatted_renewal' => $pricing->formatted_renewal_price,
                    'min_years' => $pricing->min_years,
                    'max_years' => $pricing->max_years,
                    'has_privacy' => $pricing->hasPrivacyProtection(),
                    'privacy_price' => $pricing->privacy_price
                ]
            ];

        } catch (\Exception $e) {
            Log::error('Domain availability check failed', [
                'domain' => $fullDomain,
                'error' => $e->getMessage()
            ]);

            return [
                'domain' => $fullDomain,
                'domain_name' => $domainName,
                'tld' => $tld,
                'available' => false,
                'supported' => true,
                'error' => true,
                'message' => 'Tidak dapat memeriksa ketersediaan domain'
            ];
        }
    }

    /**
     * Check domain availability with registrar API
     */
    protected function checkWithRegistrar(string $domain): bool
    {
        // For demo purposes, we'll simulate API responses
        // In production, replace this with actual API calls
        
        if (config('app.env') === 'production') {
            return $this->checkWithResellerClubApi($domain);
        }

        // Demo logic: some domains are "available", others are not
        $unavailableDomains = [
            'google.com',
            'facebook.com', 
            'microsoft.com',
            'apple.com',
            'amazon.com',
            'test.com',
            'example.com'
        ];

        return !in_array(strtolower($domain), $unavailableDomains);
    }

    /**
     * Check with actual ResellerClub API
     */
    protected function checkWithResellerClubApi(string $domain): bool
    {
        $response = Http::timeout(10)->get($this->apiUrl . 'domains/available.json', [
            'auth-userid' => $this->apiUser,
            'api-key' => $this->apiKey,
            'domain-name' => $domain
        ]);

        if (!$response->successful()) {
            throw new \Exception('API request failed: ' . $response->status());
        }

        $data = $response->json();
        
        // ResellerClub returns status in different formats
        if (isset($data['status'])) {
            return $data['status'] === 'available';
        }

        if (isset($data[$domain])) {
            return $data[$domain]['status'] === 'available';
        }

        throw new \Exception('Unexpected API response format');
    }

    /**
     * Get domain suggestions based on search term
     */
    public function getDomainSuggestions(string $keyword, int $limit = 10): array
    {
        try {
            if (config('app.env') === 'production') {
                return $this->getSuggestionsFromApi($keyword, $limit);
            }

            // Demo suggestions
            return $this->generateDemoSuggestions($keyword, $limit);

        } catch (\Exception $e) {
            Log::error('Domain suggestions failed', [
                'keyword' => $keyword,
                'error' => $e->getMessage()
            ]);

            return [];
        }
    }

    /**
     * Generate demo domain suggestions
     */
    protected function generateDemoSuggestions(string $keyword, int $limit): array
    {
        $suffixes = ['online', 'digital', 'tech', 'pro', 'store', 'web', 'net', 'biz', 'info'];
        $prefixes = ['my', 'get', 'the', 'best', 'top', 'new', 'smart'];
        $suggestions = [];

        // Add prefix variations
        foreach ($prefixes as $prefix) {
            if (count($suggestions) >= $limit) break;
            $suggestions[] = $prefix . $keyword;
        }

        // Add suffix variations
        foreach ($suffixes as $suffix) {
            if (count($suggestions) >= $limit) break;
            $suggestions[] = $keyword . $suffix;
        }

        // Add number variations
        for ($i = 1; $i <= 99; $i++) {
            if (count($suggestions) >= $limit) break;
            $suggestions[] = $keyword . $i;
        }

        return array_slice(array_unique($suggestions), 0, $limit);
    }

    /**
     * Get suggestions from registrar API
     */
    protected function getSuggestionsFromApi(string $keyword, int $limit): array
    {
        $response = Http::timeout(10)->get($this->apiUrl . 'domains/suggest-names.json', [
            'auth-userid' => $this->apiUser,
            'api-key' => $this->apiKey,
            'keyword' => $keyword,
            'no-of-results' => $limit,
            'hyphen-allowed' => 'true',
            'add-related' => 'true'
        ]);

        if (!$response->successful()) {
            throw new \Exception('Suggestions API request failed');
        }

        $data = $response->json();
        return $data['suggestions'] ?? [];
    }
}
