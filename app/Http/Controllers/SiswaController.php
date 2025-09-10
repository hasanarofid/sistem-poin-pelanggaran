<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the dashboard for siswa.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Pastikan user adalah siswa berdasarkan role (prioritas utama) atau username
        if ($user->role !== 'siswa' && $user->username !== 'siswa') {
            abort(403, 'Unauthorized access');
        }

        return view('siswa.dashboard', compact('user'));
    }

    /**
     * Show the profile for siswa.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = Auth::user();
        
        // Pastikan user adalah siswa berdasarkan role (prioritas utama) atau username
        if ($user->role !== 'siswa' && $user->username !== 'siswa') {
            abort(403, 'Unauthorized access');
        }

        return view('siswa.profile', compact('user'));
    }
}