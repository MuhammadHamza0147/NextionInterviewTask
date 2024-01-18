<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class setLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        app()->setLocale(session('locale' , config('app.locale')));
        return $next($request);
    }
}
