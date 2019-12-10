<?php

namespace App\Http\Middleware;

use Closure;
use App\Settings;
use Illuminate\Support\Facades\Session;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    

    public function handle($request, Closure $next)
    {
        
        //$Setting = Settings::get()->keyBy('key')->all();

        date_default_timezone_set('Africa/Cairo');
        $locale = Session()->get('Lang');
        if ($locale !== null && array_key_exists($locale, config('app.locales'))) {
            \App::setLocale($locale);
        }
        if ($locale === null) {
            Session::put('Lang',config('app.locale'));
            \App::setLocale(config('app.locale'));
        }
        return $next($request);
    }
}
