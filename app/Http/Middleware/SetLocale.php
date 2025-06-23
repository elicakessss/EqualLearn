<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */    public function handle(Request $request, Closure $next): Response
    {
        $availableLocales = ['en', 'tl', 'pt'];
        $locale = 'en'; // Default locale

        // Priority 1: Check if locale is passed in request (URL parameter)
        if ($request->has('locale') && in_array($request->get('locale'), $availableLocales)) {
            $locale = $request->get('locale');
            Session::put('locale', $locale);
        }
        // Priority 2: Check session for stored locale
        elseif (Session::has('locale') && in_array(Session::get('locale'), $availableLocales)) {
            $locale = Session::get('locale');
        }

        // Set the application locale for this request
        App::setLocale($locale);
        config(['app.locale' => $locale]);

        return $next($request);
    }
}
