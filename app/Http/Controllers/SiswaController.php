<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Siswa;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $riwayatPelanggaran = DB::table('input_pelanggaran_t as t')
            ->select(
                't.created_at as tanggal',
                'j.nama_pelanggaran',
                'j.poin',
                'k.nama_kategori'
            )
            ->leftJoin('jenis_pelanggaran as j', 't.jenis_pelanggaran_id', '=', 'j.id')
            ->leftJoin('kategori_m as k', 'j.kategori_id', '=', 'k.id')
            ->where('t.siswa_id', $model->id)
            ->orderBy('t.created_at', 'desc')
            ->get();
        $hasilPoin = DB::table('input_pelanggaran_t as t')
            ->select(
                DB::raw('SUM(j.poin) as total_poin')
            )
            ->leftJoin('siswa as s', 't.siswa_id', '=', 's.id')
            ->leftJoin('jenis_pelanggaran as j', 't.jenis_pelanggaran_id', '=', 'j.id')
            ->leftJoin('kelas as k', 's.kelas_id', '=', 'k.id')
            ->leftJoin('users as u', 't.pelapor_id', '=', 'u.id')
            ->where('s.id', $model->id)
            ->groupBy('s.id')
            ->first();
        // Pastikan user adalah siswa berdasarkan role (prioritas utama) atau username
        if ($user->role !== 'siswa' && $user->username !== 'siswa') {
            abort(403, 'Unauthorized access');
        }

        return view('siswa.profile', compact('user', 'model', 'kelas', 'hasilPoin', 'riwayatPelanggaran'));
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