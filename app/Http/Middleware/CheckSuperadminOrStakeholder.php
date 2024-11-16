<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class CheckSuperadminOrStakeholder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->role === 'Super Admin' || $request->user()->role === 'Stakeholder') {
            return $next($request);
        }
        return redirect('/'); // Ganti dengan route lain sesuai kebutuhan

    }
}
