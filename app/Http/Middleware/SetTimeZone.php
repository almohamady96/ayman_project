<?php

namespace App\Http\Middleware;

use App\Setting;
use Closure;

class SetTimeZone
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //set timezone
        //$currentTimeZone=date_default_timezone_get();
        //date_default_timezone_set($currentTimeZone);
        date_default_timezone_set('Africa/Cairo');

        //email and app name in emails
        $setting = Setting::get()->keyBy('key')->all();
        session()->put('messages_email', $setting['messages_email']->value);
        session()->put('app_name', $setting['title']->value);

        return $next($request);
    }
}
