<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowcaseController extends Controller
{
    /**
     * Display the company profile showcase page.
     */
    public function companyProfile()
    {
        return view('showcase.web.company-profile', [
            'user' => Auth::user()
        ]);
    }
}
