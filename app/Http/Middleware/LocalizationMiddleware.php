<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class LocalizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if locale is stored in session
        if (Session::has('locale')) {
            $locale = Session::get('locale');
            App::setLocale($locale);
        }

        //$locale = Session::get('locale');
        //Session::get('locale');
        //App::setLocale($locale);
        
        return $next($request);
    }
}
