<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class StakeholderMiddleware
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
        // Stakeholder
         if(Auth::user()->role == "Stakeholder"){
            return $next($request);
        }
        else{
            return redirect('/');
        }
    }
}
