<?php

namespace App\Http\Middleware;

use App\Setting;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSettings
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
        $setting = Setting::get()->keyBy('key')->all();
        //check if site open or closed
        if ($setting['status']->value != 'open') {
            if (Auth::user() && (Auth::user()->hasRole(1) || Auth::user()->hasRole(2))) {
                return $next($request);
            } else {
                return redirect('/Sorry');
            }
        } else {
            return $next($request);

        }
    }
}
