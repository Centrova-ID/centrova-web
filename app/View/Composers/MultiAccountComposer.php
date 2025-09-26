<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Services\MultiAccountService;

class MultiAccountComposer
{
    protected MultiAccountService $multiAccountService;

    public function __construct(MultiAccountService $multiAccountService)
    {
        $this->multiAccountService = $multiAccountService;
    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $multiAccountData = null;
        
        if (Auth::check()) {
            try {
                $multiAccountData = $this->multiAccountService->getAccountSwitchingData();
            } catch (\Exception $e) {
                // Jika terjadi error, set null
                $multiAccountData = null;
            }
        }

        $view->with('multiAccountData', $multiAccountData);
    }
}
