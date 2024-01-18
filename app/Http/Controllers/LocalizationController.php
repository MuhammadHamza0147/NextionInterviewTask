<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function index($locale)
    {
        if(!in_array($locale ,config('locale.locales'))){
            abort(400);
        }
        session(['locale' => $locale]);
        return redirect()->back();
    }
}
