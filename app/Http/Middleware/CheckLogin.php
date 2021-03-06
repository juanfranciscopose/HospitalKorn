<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class CheckLogin
{
    public function handle($request, Closure $next)
    {
        if (! Auth::check()){
            abort(403, 'Accion no autorizada.');
        }
        return $next($request);
    }
}
