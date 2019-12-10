<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
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
        if (Auth::guest()) {
            return redirect('/');
        }else{

            //get the route actions
            $actions = $request->route()->getAction();
            $roles = isset($actions['roles']) ? $actions['roles'] : '';

            // if user has roles or no roles on the route
            if ($request->user()->hasAnyRole($roles) || !$roles) {

                return $next($request);
            }
            return redirect('/');

        }
    }
}
