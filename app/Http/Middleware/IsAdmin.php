<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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
        if (Auth::id() && Auth::user()->level == 'users') {
            return redirect('/error');
        }
        elseif (!Auth::id()) {
            return redirect('/error');
        }
        return $next($request);
    }
}
