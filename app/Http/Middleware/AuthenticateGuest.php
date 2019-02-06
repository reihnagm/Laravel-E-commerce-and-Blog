<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AuthenticateGuest
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

        Auth::loginUsingId($request->user()['id']); 

        return $next($request);
    }
}
