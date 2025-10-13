<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessController extends Controller
{
    /**
     * Show the business product landing page.
     */
    public function show()
    {
        return view('products.business.index', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Show the CRM application page.
     */
    public function crm()
    {
        return view('products.business.crm', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Show the Sales application page.
     */
    public function sales()
    {
        return view('products.business.sales', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Show the ERP application page.
     */
    public function erp()
    {
        return view('products.business.erp', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Show the POS application page.
     */
    public function pos()
    {
        return view('products.business.pos', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Show the Rental application page.
     */
    public function rental()
    {
        return view('products.business.rental', [
            'user' => Auth::user()
        ]);
    }
}
