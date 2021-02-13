<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /*if ($request->has('lang')) {
            $locale = $request->input('lang');
            if ($locale && $locale != session('lang')) {
                session()->put('lang', $locale);
            }
        }
        App::setLocale(session('lang', 'en'));*/

        $locale = $request->route('lang', 'en');
        URL::defaults([
            'lang' => $locale,
        ]);
        Route::current()->forgetParameter('lang');
        
        return $next($request);
    }
}
