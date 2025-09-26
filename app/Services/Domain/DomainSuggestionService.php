<?php

namespace App\Services\Domain;

use App\Models\Domain\DomainPricing;

class DomainSuggestionService
{
    protected DomainSearchService $searchService;

    public function __construct(DomainSearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    /**
     * Get domain suggestions with availability check
     */
    public function getSuggestions(string $keyword, int $limit = 10): array
    {
        $suggestions = [];
        $popularTlds = DomainPricing::getPopularTlds()->pluck('tld')->toArray();

        // Get basic suggestions
        $basicSuggestions = $this->generateBasicSuggestions($keyword, $limit * 2);

        foreach ($basicSuggestions as $suggestion) {
            if (count($suggestions) >= $limit) break;

            foreach ($popularTlds as $tld) {
                if (count($suggestions) >= $limit) break;
                
                $fullDomain = $suggestion . '.' . $tld;
                $result = $this->searchService->checkSingleDomain($fullDomain);
                
                if ($result['available'] && $result['supported']) {
                    $suggestions[] = $result;
                }
            }
        }

        return array_slice($suggestions, 0, $limit);
    }

    /**
     * Generate creative domain suggestions
     */
    protected function generateBasicSuggestions(string $keyword, int $limit): array
    {
        $suggestions = [];
        
        // Original keyword
        $suggestions[] = $keyword;

        // Add prefixes
        $prefixes = ['my', 'get', 'the', 'best', 'top', 'new', 'smart', 'pro', 'super', 'mega'];
        foreach ($prefixes as $prefix) {
            $suggestions[] = $prefix . $keyword;
            $suggestions[] = $prefix . '-' . $keyword;
        }

        // Add suffixes
        $suffixes = ['online', 'digital', 'tech', 'pro', 'store', 'web', 'net', 'hub', 'zone', 'center'];
        foreach ($suffixes as $suffix) {
            $suggestions[] = $keyword . $suffix;
            $suggestions[] = $keyword . '-' . $suffix;
        }

        // Add numbers
        for ($i = 1; $i <= 99; $i++) {
            $suggestions[] = $keyword . $i;
            if ($i <= 10) {
                $suggestions[] = $keyword . '0' . $i;
            }
        }

        // Add year variations
        $currentYear = date('Y');
        for ($year = $currentYear; $year <= $currentYear + 5; $year++) {
            $suggestions[] = $keyword . $year;
        }

        // Add common variations
        $variations = [
            $keyword . 'app',
            $keyword . 'site',
            $keyword . 'world',
            $keyword . 'plus',
            $keyword . 'max',
            'e' . $keyword,
            'i' . $keyword,
            $keyword . 'x',
            $keyword . 'ly',
            $keyword . 'fy'
        ];

        $suggestions = array_merge($suggestions, $variations);

        // Remove duplicates and clean up
        $suggestions = array_unique($suggestions);
        $suggestions = array_filter($suggestions, function($suggestion) {
            return preg_match('/^[a-zA-Z0-9]([a-zA-Z0-9-]*[a-zA-Z0-9])?$/', $suggestion) 
                   && strlen($suggestion) >= 2 
                   && strlen($suggestion) <= 63;
        });

        return array_slice(array_values($suggestions), 0, $limit);
    }

    /**
     * Get premium domain suggestions
     */
    public function getPremiumSuggestions(string $keyword): array
    {
        // This would typically integrate with premium domain marketplaces
        // For now, return empty array
        return [];
    }

    /**
     * Get expired domain suggestions
     */
    public function getExpiredDomainSuggestions(string $keyword): array
    {
        // This would integrate with expired domain services
        // For now, return empty array
        return [];
    }
}
