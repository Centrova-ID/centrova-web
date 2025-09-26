<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\MultiAccountService;
use Symfony\Component\HttpFoundation\Response;

class InitializeMultiAccount
{
    protected MultiAccountService $multiAccountService;

    public function __construct(MultiAccountService $multiAccountService)
    {
        $this->multiAccountService = $multiAccountService;
    }

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Initialize multi-account session for authenticated users
        if (auth()->check()) {
            $this->multiAccountService->initializeForExistingAuth();
        }

        return $next($request);
    }
}
