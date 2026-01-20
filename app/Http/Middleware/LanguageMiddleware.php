<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LanguageMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $languages = ['en', 'hi', 'gu'];
        
        // Check session
        if (session()->has('locale')) {
            app()->setLocale(session('locale'));
        }
        // Check URL parameter
        elseif ($request->has('lang') && in_array($request->lang, $languages)) {
            $locale = $request->lang;
            app()->setLocale($locale);
            session()->put('locale', $locale);
        }
        // Check browser language
        else {
            $browserLang = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
            if (in_array($browserLang, $languages)) {
                app()->setLocale($browserLang);
            }
        }
        
        return $next($request);
    }
}