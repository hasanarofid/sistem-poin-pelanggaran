<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GuruRoleMiddleware
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
        
        // Cek jika user adalah guru berdasarkan role (prioritas utama) atau username
        if ($user->role === 'Guru' || $user->role === 'guru' || $user->username === 'guru') {
            return $next($request);
        }

        // Jika bukan guru, redirect ke dashboard sesuai role
        if ($user->role === 'admin' || $user->role === 'Admin' || $user->username === 'admin') {
            return redirect()->route('admin.index');
        }
        
        if ($user->role === 'siswa' || $user->role === 'Siswa' || $user->username === 'siswa') {
            return redirect()->route('siswa.dashboard');
        }

        // Jika tidak ada role yang cocok, redirect ke login
        return redirect()->route('login');
    }
}
