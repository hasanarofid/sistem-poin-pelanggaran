<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        
        // Cek jika user adalah admin berdasarkan role (prioritas utama) atau username
        if ($user->role === 'admin' || $user->username === 'admin') {
            return $next($request);
        }

        // Jika bukan admin, redirect ke dashboard sesuai role
        if ($user->role === 'guru' || $user->username === 'guru') {
            return redirect()->route('guru.dashboard');
        }
        
        if ($user->role === 'siswa' || $user->username === 'siswa') {
            return redirect()->route('siswa.dashboard');
        }

        // Jika tidak ada role yang cocok, redirect ke login
        return redirect()->route('login');
    }
}
