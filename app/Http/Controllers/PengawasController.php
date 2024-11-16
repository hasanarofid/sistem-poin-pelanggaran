<?php

namespace App\Http\Controllers;

use App\Models\RencanaKerjaT;
use App\Models\UmpanbalikT;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
class PengawasController extends Controller
{
    //index
    public function index(){
       // Periksa apakah pengguna sudah login
       if (Auth::check()) {
        // Periksa apakah pengguna adalah pengawas
        if (Auth::user()->role == "Pengawas") {
            // Pengguna sudah login dan adalah pengawas, lanjutkan ke halaman pengawas
            $tahunini = date('Y');  // Current year
            $monthNamesIndo = [
                1 => 'Januari', 
                2 => 'Februari', 
                3 => 'Maret', 
                4 => 'April', 
                5 => 'Mei', 
                6 => 'Juni', 
                7 => 'Juli', 
                8 => 'Agustus', 
                9 => 'September', 
                10 => 'Oktober', 
                11 => 'November', 
                12 => 'Desember'
            ];
            for ($i = 0; $i < 12; $i++) {
                $timestamp = strtotime("+$i month");
                $monthNumber = date('n', $timestamp);
                $months[] = [
                    'value' => $monthNumber,                // Month number (1-12)
                    'name' => $monthNamesIndo[$monthNumber] // Full month name in Indonesian
                ];
            }
            $bulanini = $months[0]['name'];
            $totalRencankerja = RencanaKerjaT::where('bulan',$bulanini)
            ->where('tahun_ajaran',$tahunini)
            ->where('id_pengawas',Auth::user()->id)
            ->count();



         

                $listsekolahdilayani = UmpanbalikT::with('pengawasnama', 'rencanakerja')
                ->whereHas('pengawasnama', function ($query) {
                    $query->where('id_pengawas', Auth::user()->id);
                })
                ->whereHas('tanggapanUmpanBalik')
                ->whereHas('rencanakerja', function ($query) use ($bulanini, $tahunini) {
                    $query->where('bulan', $bulanini)
                        ->where('tahun_ajaran', $tahunini);
                })
                ->get();

                $sekolahdilayani = 0;
                foreach ($listsekolahdilayani as $value) {
                    $sekolahIds = explode(',', $value->rencanakerja->sekolah_id);
                    $sekolahdilayani += count($sekolahIds);
                }
              

                // dd($sekolahdilayani);

            // dd($totalRencankerja);
            return view('dashboard_pengawas.home',
            compact(
                'totalRencankerja',
                'sekolahdilayani',
                'listsekolahdilayani'
                )
        );
        } else {
            // Pengguna sudah login, namun bukan pengawas, arahkan ke halaman 403 Forbidden
            abort(403);
        }
        } else {
            // Pengguna belum login, arahkan ke halaman login pengawas
            return redirect('/pengawas/login');
        }
    }

    //edit profile
    public function editprofile(){
        $user = User::with('profile')->find(Auth::user()->id);
        return view('dashboard_pengawas.editprofile',compact('user'));
    }
    //update profile
    public function updateprofile(Request $request){
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');

            // Generate a unique name based on the current date and time.
            $imageName = now()->format('YmdHis') . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
        
            // Store the image in the "blog" directory within the "public" disk.
            $request->foto->storeAs('pengawas', $imageName, 'public');
            
        }else{
            $imageName = 'userdefault.jpg';
        }
        $user = User::find(Auth::user()->id);
        $user->foto_profile = $imageName;
        $user->name = $request->post('nama');
        $user->save();
        $profile = Profile::where('user_id',$user->id)->first();
        $profile->alamat_lengkap = $request->post('alamat');
        $profile->no_telp = $request->post('telp');
        $profile->homepage = $request->post('homepage');
        $profile->bio = $request->post('profile');
        $profile->save();
        return redirect()->route('pengawas.editprofile')->with('success', 'Profile berhasil diupdate!');

    }

    //ubahpassword
    public function ubahpassword(Request $request) {
        // Validasi input
        $request->validate([
            'passl' => 'required',
            'passb' => 'required|string|min:8|confirmed',
        ]);
    
        // Ambil pengguna yang sedang login
        $user = User::find(Auth::user()->id);
    
        // Periksa apakah password lama yang dimasukkan benar
        if (!Hash::check($request->passl, $user->password)) {
            return back()->with('error', 'Password lama tidak sesuai.');
        }

        if ($request->passb != $request->passu) {
            return back()->with('error', 'Password  tidak sesuai dengan ulangi password.');
        }
    
        // Update password baru
        $user->password = Hash::make($request->passb);
        $user->save();
    
        return redirect()->back()->with('success_pass', 'Password berhasil diubah.');
    }

}
