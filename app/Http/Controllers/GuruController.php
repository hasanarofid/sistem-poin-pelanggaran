<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Siswa;
use App\Kelas;
use App\TahunAjaran;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SiswaExport;
use App\Imports\SiswaImport;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class GuruController extends Controller
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
     * Show the dashboard for guru.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Pastikan user adalah guru
        if ($user->role !== 'Guru') {
            abort(403, 'Unauthorized access');
        }

        // Data untuk dashboard guru berdasarkan kelas
        $kelasId = $user->kelas_id;
        $kelas = $user->kelas;
        
        if (!$kelas) {
            abort(403, 'Guru tidak memiliki kelas yang ditugaskan');
        }

        // Data siswa di kelas guru
        $total_siswa = Siswa::where('kelas_id', $kelasId)->count();
        
        // Pelanggaran bulan ini untuk siswa di kelas guru
        $thisMonth = \Carbon\Carbon::now()->month;
        $thisYear = \Carbon\Carbon::now()->year;
        $pelanggaran_bulan_ini = \App\Models\InputPelanggaranT::whereHas('jenispelanggaran', function($q) {
            $q->where('poin', '<', 0);
        })
        ->whereHas('siswa', function($q) use ($kelasId) {
            $q->where('kelas_id', $kelasId);
        })
        ->whereMonth('created_at', $thisMonth)
        ->whereYear('created_at', $thisYear)
        ->count();
        
        // Siswa bermasalah di kelas guru
        $siswa_bermasalah = \App\Point::whereHas('siswa', function($q) use ($kelasId) {
            $q->where('kelas_id', $kelasId);
        })->where('total_poin', '<=', 20)->count();
        
        // Sanksi aktif di kelas guru
        $sanksi_aktif = \App\Point::whereHas('siswa', function($q) use ($kelasId) {
            $q->where('kelas_id', $kelasId);
        })->where('total_poin', '<=', 30)->count();

        // Pelanggaran hari ini untuk siswa di kelas guru
        $today = \Carbon\Carbon::today();
        $pelanggaran_hari_ini = \App\Models\InputPelanggaranT::with(['siswa.kelas', 'jenispelanggaran'])
            ->whereHas('jenispelanggaran', function($q) {
                $q->where('poin', '<', 0);
            })
            ->whereHas('siswa', function($q) use ($kelasId) {
                $q->where('kelas_id', $kelasId);
            })
            ->whereDate('created_at', $today)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Reward hari ini untuk siswa di kelas guru
        $reward_hari_ini = \App\Models\InputPelanggaranT::with(['siswa.kelas', 'jenispelanggaran'])
            ->whereHas('jenispelanggaran', function($q) {
                $q->where('poin', '>', 0);
            })
            ->whereHas('siswa', function($q) use ($kelasId) {
                $q->where('kelas_id', $kelasId);
            })
            ->whereDate('created_at', $today)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Siswa dengan pelanggaran terbanyak di kelas guru
        $siswa_pelanggaran_terbanyak = DB::table('input_pelanggaran_t')
            ->join('siswa', 'input_pelanggaran_t.siswa_id', '=', 'siswa.id')
            ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->join('jenis_pelanggaran', 'input_pelanggaran_t.jenis_pelanggaran_id', '=', 'jenis_pelanggaran.id')
            ->where('jenis_pelanggaran.poin', '<', 0)
            ->where('siswa.kelas_id', $kelasId)
            ->select('siswa.nama', 'kelas.subkelas as kelas', DB::raw('COUNT(*) as jumlah_pelanggaran'))
            ->groupBy('siswa.id', 'siswa.nama', 'kelas.subkelas')
            ->orderBy('jumlah_pelanggaran', 'desc')
            ->limit(5)
            ->get();

        // Siswa dengan reward terbanyak di kelas guru
        $siswa_reward_terbanyak = DB::table('input_pelanggaran_t')
            ->join('siswa', 'input_pelanggaran_t.siswa_id', '=', 'siswa.id')
            ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->join('jenis_pelanggaran', 'input_pelanggaran_t.jenis_pelanggaran_id', '=', 'jenis_pelanggaran.id')
            ->where('jenis_pelanggaran.poin', '>', 0)
            ->where('siswa.kelas_id', $kelasId)
            ->select('siswa.nama', 'kelas.subkelas as kelas', DB::raw('COUNT(*) as jumlah_reward'))
            ->groupBy('siswa.id', 'siswa.nama', 'kelas.subkelas')
            ->orderBy('jumlah_reward', 'desc')
            ->limit(5)
            ->get();

        // Top pelanggaran di kelas guru
        $top_pelanggaran = DB::table('input_pelanggaran_t')
            ->join('jenis_pelanggaran', 'input_pelanggaran_t.jenis_pelanggaran_id', '=', 'jenis_pelanggaran.id')
            ->join('siswa', 'input_pelanggaran_t.siswa_id', '=', 'siswa.id')
            ->where('jenis_pelanggaran.poin', '<', 0)
            ->where('siswa.kelas_id', $kelasId)
            ->select('jenis_pelanggaran.nama_pelanggaran', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('jenis_pelanggaran.id', 'jenis_pelanggaran.nama_pelanggaran')
            ->orderBy('jumlah', 'desc')
            ->limit(5)
            ->get();

        // Trend pelanggaran mingguan untuk kelas guru
        $trend_pelanggaran = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = \Carbon\Carbon::now()->subDays($i);
            $count = \App\Models\InputPelanggaranT::whereHas('jenispelanggaran', function($q) {
                $q->where('poin', '<', 0);
            })
            ->whereHas('siswa', function($q) use ($kelasId) {
                $q->where('kelas_id', $kelasId);
            })
            ->whereDate('created_at', $date)
            ->count();
            
            $dayNames = ['Sun' => 'Min', 'Mon' => 'Sen', 'Tue' => 'Sel', 'Wed' => 'Rab', 'Thu' => 'Kam', 'Fri' => 'Jum', 'Sat' => 'Sab'];
            $trend_pelanggaran[] = [
                'day' => $dayNames[$date->format('D')] ?? $date->format('D'),
                'count' => $count
            ];
        }

        // Trend reward mingguan untuk kelas guru
        $trend_reward = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = \Carbon\Carbon::now()->subDays($i);
            $count = \App\Models\InputPelanggaranT::whereHas('jenispelanggaran', function($q) {
                $q->where('poin', '>', 0);
            })
            ->whereHas('siswa', function($q) use ($kelasId) {
                $q->where('kelas_id', $kelasId);
            })
            ->whereDate('created_at', $date)
            ->count();
            
            $dayNames = ['Sun' => 'Min', 'Mon' => 'Sen', 'Tue' => 'Sel', 'Wed' => 'Rab', 'Thu' => 'Kam', 'Fri' => 'Jum', 'Sat' => 'Sab'];
            $trend_reward[] = [
                'day' => $dayNames[$date->format('D')] ?? $date->format('D'),
                'count' => $count
            ];
        }

        // Data kosong untuk kelas (karena guru hanya melihat kelasnya sendiri)
        $kelas_pelanggar_terbanyak = collect();
        $kelas_reward_terbanyak = collect();

        return view('guru.dashboard', compact(
            'user', 'kelas', 'total_siswa', 'pelanggaran_bulan_ini', 'siswa_bermasalah', 'sanksi_aktif',
            'pelanggaran_hari_ini', 'reward_hari_ini', 'siswa_pelanggaran_terbanyak', 'siswa_reward_terbanyak',
            'top_pelanggaran', 'trend_pelanggaran', 'trend_reward', 'kelas_pelanggar_terbanyak', 'kelas_reward_terbanyak'
        ));
    }

    /**
     * Display a listing of the siswa resource for guru.
     *
     * @return \Illuminate\Http\Response
     */
    public function siswaIndex(Request $request)
    {
        $user = Auth::user();
        
        // Pastikan user adalah guru
        if ($user->role !== 'Guru') {
            abort(403, 'Unauthorized access');
        }

        // Filter berdasarkan kelas guru
        $kelasId = $user->kelas_id;
        $query = Siswa::with(['kelas', 'tahunAjaran', 'point'])
            ->where('kelas_id', $kelasId);
        
        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('nis', 'like', '%' . $search . '%')
                  ->orWhereHas('kelas', function($kelasQuery) use ($search) {
                      $kelasQuery->where('nama_kelas', 'like', '%' . $search . '%')
                                ->orWhere('subkelas', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('tahunAjaran', function($tahunQuery) use ($search) {
                      $tahunQuery->where('tahun_ajaran', 'like', '%' . $search . '%');
                  });
            });
        }
        
        $siswa = $query->paginate(10);
        $listKelas = Kelas::where('status', true)->get();
        return view('siswa.index', compact('siswa', 'listKelas'));
    }

    /**
     * Show the form for creating a new siswa resource for guru.
     *
     * @return \Illuminate\Http\Response
     */
    public function siswaCreate()
    {
        $user = Auth::user();
        
        // Pastikan user adalah guru
        if ($user->role !== 'Guru') {
            abort(403, 'Unauthorized access');
        }

        // Hanya tampilkan kelas guru
        $kelas = Kelas::where('id', $user->kelas_id)->get();
        $tahunAjaran = TahunAjaran::all();
        return view('siswa.create', compact('kelas', 'tahunAjaran'));
    }

    /**
     * Store a newly created siswa resource in storage for guru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function siswaStore(Request $request)
    {
        $user = Auth::user();
        
        // Pastikan user adalah guru
        if ($user->role !== 'Guru') {
            abort(403, 'Unauthorized access');
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|unique:siswa,nis',
            'kelas_id' => 'required|exists:kelas,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajaran,id',
            'alamat' => 'nullable|string',
            'no_telp' => 'nullable|string',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        // Validasi bahwa kelas_id harus sama dengan kelas guru
        if ($request->kelas_id != $user->kelas_id) {
            return redirect()->back()
                ->withErrors(['kelas_id' => 'Anda hanya dapat menambahkan siswa ke kelas yang Anda ajar.'])
                ->withInput();
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $userSiswa = User::create([
            'name' => $request->nama,
            'username' => $request->nis,
            'password' => Hash::make('siswa123'),
            'role' => 'Siswa',
            'alamat_lengkap' => $request->alamat,
        ]);
        
        $request->merge(['user_id' => $userSiswa->id]);
        Siswa::create($request->all());

        return redirect()->route('guru.siswa.index')
            ->with('success', 'Siswa berhasil ditambahkan.');
    }

    /**
     * Display the specified siswa resource for guru.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function siswaShow($id)
    {
        $user = Auth::user();
        
        // Pastikan user adalah guru
        if ($user->role !== 'guru' && $user->username !== 'guru') {
            abort(403, 'Unauthorized access');
        }

        $siswa = Siswa::with(['kelas', 'tahunAjaran'])->findOrFail($id);
        return view('siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified siswa resource for guru.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function siswaEdit($id)
    {
        $user = Auth::user();
        
        // Pastikan user adalah guru
        if ($user->role !== 'Guru') {
            abort(403, 'Unauthorized access');
        }

        $siswa = Siswa::findOrFail($id);
        
        // Pastikan siswa adalah dari kelas guru
        if ($siswa->kelas_id != $user->kelas_id) {
            abort(403, 'Anda hanya dapat mengedit siswa di kelas yang Anda ajar.');
        }

        // Hanya tampilkan kelas guru
        $kelas = Kelas::where('id', $user->kelas_id)->get();
        $tahunAjaran = TahunAjaran::all();
        return view('siswa.edit', compact('siswa', 'kelas', 'tahunAjaran'));
    }

    /**
     * Update the specified siswa resource in storage for guru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function siswaUpdate(Request $request, $id)
    {
        $user = Auth::user();
        
        // Pastikan user adalah guru
        if ($user->role !== 'Guru') {
            abort(403, 'Unauthorized access');
        }

        $siswa = Siswa::findOrFail($id);
        
        // Pastikan siswa adalah dari kelas guru
        if ($siswa->kelas_id != $user->kelas_id) {
            abort(403, 'Anda hanya dapat mengedit siswa di kelas yang Anda ajar.');
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|unique:siswa,nis,' . $id,
            'kelas_id' => 'required|exists:kelas,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajaran,id',
            'alamat' => 'nullable|string',
            'no_telp' => 'nullable|string',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        // Validasi bahwa kelas_id harus sama dengan kelas guru
        if ($request->kelas_id != $user->kelas_id) {
            return redirect()->back()
                ->withErrors(['kelas_id' => 'Anda hanya dapat memindahkan siswa ke kelas yang Anda ajar.'])
                ->withInput();
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $siswa->update($request->all());

        return redirect()->route('guru.siswa.index')
            ->with('success', 'Siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified siswa resource from storage for guru.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function siswaDestroy($id)
    {
        $user = Auth::user();
        
        // Pastikan user adalah guru
        if ($user->role !== 'Guru') {
            abort(403, 'Unauthorized access');
        }

        $siswa = Siswa::findOrFail($id);
        
        // Pastikan siswa adalah dari kelas guru
        if ($siswa->kelas_id != $user->kelas_id) {
            abort(403, 'Anda hanya dapat menghapus siswa di kelas yang Anda ajar.');
        }

        $siswa->delete();

        return redirect()->route('guru.siswa.index')
            ->with('success', 'Siswa berhasil dihapus.');
    }

    /**
     * Export siswa to Excel for guru
     *
     * @return \Illuminate\Http\Response
     */
    public function siswaExport()
    {
        $user = Auth::user();
        
        // Pastikan user adalah guru
        if ($user->role !== 'guru' && $user->username !== 'guru') {
            abort(403, 'Unauthorized access');
        }

        return Excel::download(new SiswaExport, 'siswa.xlsx');
    }

    /**
     * Show import form for guru
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for importing siswa for guru
     *
     * @return \Illuminate\Http\Response
     */
    public function siswaImportForm()
    {
        $user = Auth::user();
        
        // Pastikan user adalah guru
        if ($user->role !== 'Guru') {
            abort(403, 'Unauthorized access');
        }

        return view('siswa.import', compact('user'));
    }

    /**
     * Import siswa from Excel for guru
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function siswaImport(Request $request)
    {
        $user = Auth::user();
        
        // Pastikan user adalah guru
        if ($user->role !== 'Guru') {
            abort(403, 'Unauthorized access');
        }

        ini_set('max_execution_time', 300);

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator);
        }

        try {
            // Buat custom import untuk guru dengan filter kelas
            $import = new \App\Imports\GuruSiswaImport($user->kelas_id);
            Excel::import($import, $request->file('file'));
            
            // Buat pesan berdasarkan hasil import
            $messages = [];
            
            if ($import->successCount > 0) {
                $messages[] = "Berhasil mengimpor {$import->successCount} data siswa ke kelas {$user->kelas->subkelas}.";
            }
            
            if ($import->errorCount > 0) {
                $errorMessage = "Terjadi {$import->errorCount} error:<br>";
                foreach ($import->errors as $error) {
                    $errorMessage .= "• " . $error . "<br>";
                }
                $messages[] = $errorMessage;
            }
            
            if (empty($messages)) {
                $messages[] = "Tidak ada data yang diproses.";
            }
            
            // Jika ada error, tampilkan sebagai error, jika tidak tampilkan sebagai success
            if ($import->errorCount > 0) {
                return redirect()->back()
                    ->with('error', implode("<br>", $messages));
            } else {
                return redirect()->route('guru.siswa.index')
                    ->with('success', implode("<br>", $messages));
            }
            
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
        }
    }

    /**
     * Download template Excel for guru
     *
     * @return \Illuminate\Http\Response
     */
    public function siswaDownloadTemplate()
    {
        $user = Auth::user();
        
        // Pastikan user adalah guru
        if ($user->role !== 'Guru') {
            abort(403, 'Unauthorized access');
        }

        return Excel::download(new \App\Exports\TemplateSiswaExport, 'template_siswa_guru.xlsx');
    }

    public function updateKelas(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kelas' => 'required|exists:kelas,id',
        ], [
            'kelas.required' => 'Pilih kelas tujuan terlebih dahulu.',
            'kelas.exists' => 'Kelas yang dipilih tidak valid.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validasi gagal. Silakan periksa kembali data yang diisi.');
        }
        
        try {
            $siswa = Siswa::findOrFail($request->id);
            $siswa->kelas_id = $request->kelas;
            $siswa->save();

            return redirect()->route('guru.siswa.index')
                ->with('success', 'Kelas siswa berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui kelas siswa: ' . $e->getMessage());
        }
    }
}
