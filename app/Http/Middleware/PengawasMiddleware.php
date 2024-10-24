<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class PengawasMiddleware
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
        // Pengecualian untuk route '/pengawas'
        if ($request->is('pengawas') || $request->is('pengawas/*')) {
            return $next($request);
        }

        // Cek apakah pengguna terautentikasi dan memiliki peran 'Pengawas'
        if(Auth::check() && Auth::user()->role == "Pengawas") {
            return $next($request);
        } else {
            return redirect('/pengawas');
        }
    }
}
