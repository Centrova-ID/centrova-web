<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class DomainApiService
{
    protected $client;
    protected $baseUrl;
    protected $apiKey;
    protected $resellerId;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = config('domain.api_base_url', 'https://test.httpapi.com/api/');
        $this->apiKey = config('domain.api_key');
        $this->resellerId = config('domain.reseller_id');
    }

    /**
     * Check domain availability
     */
    public function checkAvailability($domainName, $tlds = ['.com'])
    {
        try {
            $cacheKey = 'domain_availability_' . md5($domainName . implode('', $tlds));
            
            return Cache::remember($cacheKey, 300, function () use ($domainName, $tlds) {
                $results = [];
                
                foreach ($tlds as $tld) {
                    $fullDomain = $domainName . $tld;
                    
                    // Mock API call for demonstration
                    // In real implementation, replace with actual API call
                    $available = $this->mockAvailabilityCheck($fullDomain);
                    $pricing = $this->getPricing($tld);
                    
                    $results[] = [
                        'domain' => $fullDomain,
                        'tld' => $tld,
                        'available' => $available,
                        'pricing' => $pricing,
                        'premium' => false, // Check if premium domain
                    ];
                }
                
                return $results;
            });
        } catch (\Exception $e) {
            Log::error('Domain availability check failed', [
                'domain' => $domainName,
                'tlds' => $tlds,
                'error' => $e->getMessage()
            ]);
            
            return $this->getErrorResponse('Gagal memeriksa ketersediaan domain');
        }
    }

    /**
     * Register domain
     */
    public function registerDomain($domainName, $years = 1, $contactInfo = [])
    {
        try {
            $response = $this->makeApiCall('domains/register', [
                'domain' => $domainName,
                'years' => $years,
                'contacts' => $this->formatContactInfo($contactInfo),
                'nameservers' => config('domain.default_nameservers', [
                    'ns1.centrova.com',
                    'ns2.centrova.com'
                ])
            ]);

            if ($response['success']) {
                return [
                    'success' => true,
                    'domain_id' => $response['domain_id'],
                    'order_id' => $response['order_id'],
                    'message' => 'Domain berhasil didaftarkan'
                ];
            }

            return [
                'success' => false,
                'message' => $response['message'] ?? 'Registrasi domain gagal'
            ];
        } catch (\Exception $e) {
            Log::error('Domain registration failed', [
                'domain' => $domainName,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'message' => 'Registrasi domain gagal: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Renew domain
     */
    public function renewDomain($domainName, $years = 1)
    {
        try {
            $response = $this->makeApiCall('domains/renew', [
                'domain' => $domainName,
                'years' => $years
            ]);

            return [
                'success' => $response['success'] ?? false,
                'message' => $response['message'] ?? 'Perpanjangan domain gagal',
                'expiry_date' => $response['expiry_date'] ?? null
            ];
        } catch (\Exception $e) {
            Log::error('Domain renewal failed', [
                'domain' => $domainName,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'message' => 'Perpanjangan domain gagal: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Update nameservers
     */
    public function updateNameservers($domainName, $nameservers = [])
    {
        try {
            $response = $this->makeApiCall('domains/nameservers', [
                'domain' => $domainName,
                'nameservers' => $nameservers
            ]);

            return [
                'success' => $response['success'] ?? false,
                'message' => $response['message'] ?? 'Update nameserver gagal'
            ];
        } catch (\Exception $e) {
            Log::error('Nameserver update failed', [
                'domain' => $domainName,
                'nameservers' => $nameservers,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'message' => 'Update nameserver gagal: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Get domain info
     */
    public function getDomainInfo($domainName)
    {
        try {
            $response = $this->makeApiCall('domains/info', [
                'domain' => $domainName
            ]);

            if ($response['success']) {
                return [
                    'success' => true,
                    'domain' => $response['domain'],
                    'status' => $response['status'],
                    'expiry_date' => $response['expiry_date'],
                    'nameservers' => $response['nameservers'] ?? [],
                    'contacts' => $response['contacts'] ?? []
                ];
            }

            return [
                'success' => false,
                'message' => $response['message'] ?? 'Gagal mengambil info domain'
            ];
        } catch (\Exception $e) {
            Log::error('Get domain info failed', [
                'domain' => $domainName,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'message' => 'Gagal mengambil info domain: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Make API call to domain provider
     */
    protected function makeApiCall($endpoint, $data = [])
    {
        // Mock API response for demonstration
        // In real implementation, replace with actual API call
        return $this->mockApiResponse($endpoint, $data);
    }

    /**
     * Mock API response for demonstration
     */
    protected function mockApiResponse($endpoint, $data)
    {
        // Simulate API delay
        usleep(100000); // 0.1 second

        switch ($endpoint) {
            case 'domains/register':
                return [
                    'success' => true,
                    'domain_id' => 'DOM' . rand(100000, 999999),
                    'order_id' => 'ORD' . rand(100000, 999999),
                    'message' => 'Domain registered successfully'
                ];

            case 'domains/renew':
                return [
                    'success' => true,
                    'message' => 'Domain renewed successfully',
                    'expiry_date' => now()->addYear()->format('Y-m-d')
                ];

            case 'domains/nameservers':
                return [
                    'success' => true,
                    'message' => 'Nameservers updated successfully'
                ];

            case 'domains/info':
                return [
                    'success' => true,
                    'domain' => $data['domain'],
                    'status' => 'active',
                    'expiry_date' => now()->addYear()->format('Y-m-d'),
                    'nameservers' => ['ns1.centrova.com', 'ns2.centrova.com'],
                    'contacts' => []
                ];

            default:
                return [
                    'success' => false,
                    'message' => 'Unknown endpoint'
                ];
        }
    }

    /**
     * Mock availability check
     */
    protected function mockAvailabilityCheck($domain)
    {
        // Simulate some domains as unavailable
        $unavailableDomains = ['google.com', 'facebook.com', 'youtube.com', 'amazon.com'];
        
        foreach ($unavailableDomains as $unavailable) {
            if (stripos($domain, $unavailable) !== false) {
                return false;
            }
        }

        // Random availability for demonstration
        return rand(1, 10) > 3; // 70% chance of being available
    }

    /**
     * Get pricing for TLD
     */
    protected function getPricing($tld)
    {
        $pricing = \App\Models\DomainPricing::where('tld', $tld)->first();
        
        if ($pricing) {
            return [
                'registration' => $pricing->registration_price,
                'renewal' => $pricing->renewal_price,
                'transfer' => $pricing->transfer_price,
                'formatted_registration' => $pricing->formatted_registration_price,
                'formatted_renewal' => $pricing->formatted_renewal_price,
                'min_years' => $pricing->min_years,
                'max_years' => $pricing->max_years,
                'has_privacy' => $pricing->has_privacy_protection,
                'privacy_price' => $pricing->privacy_price ?? 0,
            ];
        }

        // Return default pricing if not found in database
        return [
            'registration' => 150000,
            'renewal' => 150000,
            'transfer' => 150000,
            'formatted_registration' => 'Rp 150.000',
            'formatted_renewal' => 'Rp 150.000',
            'min_years' => 1,
            'max_years' => 10,
            'has_privacy' => false,
            'privacy_price' => 0,
        ];
    }

    /**
     * Format contact info for API
     */
    protected function formatContactInfo($contactInfo)
    {
        return [
            'registrant' => $contactInfo,
            'admin' => $contactInfo,
            'tech' => $contactInfo,
            'billing' => $contactInfo
        ];
    }

    /**
     * Get error response
     */
    protected function getErrorResponse($message)
    {
        return [
            'success' => false,
            'message' => $message,
            'results' => []
        ];
    }

    /**
     * Get suggested domains
     */
    public function getSuggestedDomains($domainName, $count = 5)
    {
        $suggestions = [];
        $suffixes = ['online', 'pro', 'store', 'tech', 'digital', 'web'];
        $prefixes = ['my', 'get', 'the', 'new', 'best'];

        // Add suffix suggestions
        foreach (array_slice($suffixes, 0, $count) as $suffix) {
            $suggestions[] = $domainName . $suffix . '.com';
        }

        // Add prefix suggestions
        foreach (array_slice($prefixes, 0, $count) as $prefix) {
            $suggestions[] = $prefix . $domainName . '.com';
        }

        return array_slice($suggestions, 0, $count);
    }
}