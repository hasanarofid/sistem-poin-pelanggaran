<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Siswa;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $model = Siswa::where('user_id', $user->id)->first();
        $kelas = Kelas::find($model->kelas_id);
        // Pastikan user adalah siswa berdasarkan role (prioritas utama) atau username
        if ($user->role !== 'siswa' && $user->username !== 'siswa') {
            abort(403, 'Unauthorized access');
        }

        return view('siswa.profile', compact('user', 'model', 'kelas'));
    }

    //ubahpassword
    public function ubahPassword(Request $request, $id)
    {
        try {
            $modelSiswa = Siswa::where('user_id', $id)->first();
           
            if (!$modelSiswa) {
                return redirect()->route('siswa.profile')->with('error', 'Siswa tidak ditemukan.');
            }

            $model = User::where('id', $modelSiswa->user_id)->first();
            if (!$model) {
                return redirect()->route('siswa.profile')->with('error', 'Pengguna tidak ditemukan.');
            }

            $model->password = Hash::make($request->password);
            $model->update();

            return redirect()->route('siswa.profile')->with('success', 'Password berhasil diubah. Silahkan login kembali.');
        } catch (\Exception $e) {
            return redirect()->route('siswa.profile')->with('error', 'Terjadi kesalahan saat mengubah password.');
        }
    }
}