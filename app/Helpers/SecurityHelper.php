<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SecurityHelper
{
    /**
     * Sanitize redirect URL to prevent open redirect attacks
     * 
     * @param Request $request
     * @param string $default Default redirect URL if validation fails
     * @return string
     */
    public static function sanitizeRedirectTarget(Request $request, string $default = '/'): string
    {
        $target = $request->input('redirect', $default);

        // Allow empty or null values to use default
        if (empty($target)) {
            return $default;
        }

        // Only allow internal paths (starting with '/')
        // But not protocol-relative URLs (starting with '//')
        if (is_string($target) && str_starts_with($target, '/') && !str_starts_with($target, '//')) {
            // Additional validation: prevent common bypass attempts
            $target = filter_var($target, FILTER_SANITIZE_URL);
            
            // Check for suspicious patterns
            if (self::containsSuspiciousPatterns($target)) {
                return $default;
            }
            
            return $target;
        }

        // If we need to allow specific external domains, uncomment and modify below:
        /*
        $allowedHosts = [
            parse_url(config('app.url'), PHP_URL_HOST),
            'trusted.example.com',
        ];

        $parsedUrl = parse_url($target);
        if ($parsedUrl !== false && 
            isset($parsedUrl['host']) && 
            in_array($parsedUrl['host'], $allowedHosts, true)) {
            return $target;
        }
        */

        // Fallback to default for any invalid/suspicious URLs
        return $default;
    }

    /**
     * Check for suspicious patterns in URLs that could indicate attack attempts
     * 
     * @param string $url
     * @return bool
     */
    private static function containsSuspiciousPatterns(string $url): bool
    {
        $suspiciousPatterns = [
            'javascript:',
            'data:',
            'vbscript:',
            'about:',
            'file:',
            'ftp:',
            '%2F%2F',  // URL encoded //
            '%0A',     // Newline
            '%0D',     // Carriage return
        ];

        $lowerUrl = strtolower($url);
        
        foreach ($suspiciousPatterns as $pattern) {
            if (str_contains($lowerUrl, $pattern)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Generate a secure nonce for CSP
     * 
     * @return string
     */
    public static function generateNonce(): string
    {
        return base64_encode(random_bytes(16));
    }

    /**
     * Mask email address for privacy
     * 
     * @param string $email
     * @return string
     */
    public static function maskEmail(string $email): string
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // For non-email strings (like usernames)
            if (strlen($email) <= 2) {
                return str_repeat('*', strlen($email));
            }
            return substr($email, 0, 2) . str_repeat('*', strlen($email) - 2);
        }

        $parts = explode('@', $email);
        $username = $parts[0];
        $domain = $parts[1];
        
        if (strlen($username) <= 2) {
            $maskedUsername = str_repeat('*', strlen($username));
        } else {
            $maskedUsername = substr($username, 0, 2) . str_repeat('*', strlen($username) - 2);
        }
        
        return $maskedUsername . '@' . $domain;
    }
}
