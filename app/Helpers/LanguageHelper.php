<?php

if (!function_exists('switchLanguageUrl')) {
    /**
     * Generate URL for language switching
     *
     * @param string $locale
     * @return string
     */
    function switchLanguageUrl($locale)
    {
        $currentUrl = request()->url();
        $currentLocale = app()->getLocale();
        
        if ($locale === 'id') {
            // Remove /en from URL for Indonesian
            if ($currentLocale === 'en') {
                return str_replace('/en', '', $currentUrl);
            }
            return $currentUrl;
        } else {
            // Add /en for English
            if ($currentLocale === 'id') {
                return url('/en' . request()->getPathInfo());
            }
            return $currentUrl;
        }
    }
}

if (!function_exists('getCurrentLocale')) {
    /**
     * Get current application locale
     *
     * @return string
     */
    function getCurrentLocale()
    {
        return app()->getLocale();
    }
}

if (!function_exists('isCurrentLocale')) {
    /**
     * Check if given locale is current locale
     *
     * @param string $locale
     * @return bool
     */
    function isCurrentLocale($locale)
    {
        return app()->getLocale() === $locale;
    }
}

if (!function_exists('localizedRoute')) {
    /**
     * Generate localized route URL
     *
     * @param string $routeName
     * @param array $parameters
     * @param string|null $locale
     * @return string
     */
    function localizedRoute($routeName, $parameters = [], $locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        
        if ($locale === 'en') {
            return url('/en' . route($routeName, $parameters, false));
        }
        
        return route($routeName, $parameters);
    }
}
