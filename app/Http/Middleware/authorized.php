<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class authorized
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth()->user() && Auth()->user()->role!='Customer'){
            return $next($request);
        }
        return redirect()->back();
    }
}
