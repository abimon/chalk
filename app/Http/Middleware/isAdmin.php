<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth()->user() && Auth()->user()->role == 'Admin'){
            return $next($request);
        }
    }
}
