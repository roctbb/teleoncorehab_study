<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAccepted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::User()->state=='pending') {
            return redirect('/insider/pending');
        }

        if (Auth::User()->state=='declined') {
            return redirect('/insider/declined');
        }

        return $next($request);
    }
}
