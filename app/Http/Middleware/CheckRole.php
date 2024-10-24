<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckRole
{
     public function handle($request, Closure $next, $role)
    {
        // dd($role);die;
        if (Auth::check() && in_array($role, [Auth::user()->role])) {
            
            return $next($request);
        }

        return redirect('/'); // Redirect to a suitable URL
    }
}
