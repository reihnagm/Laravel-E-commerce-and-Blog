<?php

namespace App\Http\Middleware;

use Closure;

class cors
{

    public function handle($request, Closure $next)
    {

        // return $next($request)
        //         ->header('Access-Control-Allow-Origin', '*')
        //         ->header('Access-Control-Allow-Methods','GET, POST, PUT, DELETE, OPTIONS')
        //         ->header('Access-Control-Allow-Headers','Content-type, Authorization, X-Requested-With');

        $response = $next($request);

        $response->headers->set('Access-Control-Allow-Origin' , '*');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, Application');

        return $response;
    }
}
