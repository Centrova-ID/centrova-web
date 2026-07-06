<?php

if (!function_exists('canonical_url')) {
    /**
     * Generate an absolute canonical URL using config('app.url') as the base.
     *
     * Unlike url()->current() / URL::current() which derive the scheme from
     * the incoming request (and may return protocol-relative URLs like
     * "//centrova.test/..."), this helper always prepends the configured
     * APP_URL scheme + host, producing a fully-qualified absolute URL that
     * satisfies Google's SEO requirements for rel=canonical and hreflang.
     *
     * @param  string|null  $path  Optional relative path to append
     * @return string
     */
    function canonical_url(?string $path = null): string
    {
        $base = rtrim(config('app.url'), '/');

        if ($path) {
            return $base . '/' . ltrim($path, '/');
        }

        // Use the current request path + query string
        $request = request();
        $path = '/' . ltrim($request->path(), '/');

        if ($request->getQueryString()) {
            $path .= '?' . $request->getQueryString();
        }

        return $base . $path;
    }
}
