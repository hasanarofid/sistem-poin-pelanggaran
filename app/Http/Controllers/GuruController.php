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
        
        // Pastikan user adalah guru berdasarkan role (prioritas utama) atau username
        if ($user->role !== 'guru' && $user->username !== 'guru') {
            abort(403, 'Unauthorized access');
        }

        return view('guru.dashboard', compact('user'));
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
        if ($user->role !== 'guru' && $user->username !== 'guru') {
            abort(403, 'Unauthorized access');
        }

        $query = Siswa::with(['kelas', 'tahunAjaran']);
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%")
                  ->orWhereHas('kelas', function($q) use ($search) {
                      $q->where('nama_kelas', 'like', "%{$search}%");
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
        if ($user->role !== 'guru' && $user->username !== 'guru') {
            abort(403, 'Unauthorized access');
        }

        $kelas = Kelas::all();
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
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|unique:siswa,nis',
            'kelas_id' => 'required|exists:kelas,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajaran,id',
            'alamat' => 'nullable|string',
            'no_telp' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->nama,
            'username' => $request->nis,
            'password' => Hash::make('siswa123'),
            'role' => 'siswa',
            'alamat_lengkap' => $request->alamat,
        ]);
        $request->merge(['user_id' => $user->id]);
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
        if ($user->role !== 'guru' && $user->username !== 'guru') {
            abort(403, 'Unauthorized access');
        }

        $siswa = Siswa::findOrFail($id);
        $kelas = Kelas::all();
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
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|unique:siswa,nis,' . $id,
            'kelas_id' => 'required|exists:kelas,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajaran,id',
            'alamat' => 'nullable|string',
            'no_telp' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $siswa = Siswa::findOrFail($id);
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
        if ($user->role !== 'guru' && $user->username !== 'guru') {
            abort(403, 'Unauthorized access');
        }

        $siswa = Siswa::findOrFail($id);
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
    public function siswaImportForm()
    {
        $user = Auth::user();
        
        // Pastikan user adalah guru
        if ($user->role !== 'guru' && $user->username !== 'guru') {
            abort(403, 'Unauthorized access');
        }

        return view('siswa.import');
    }

    /**
     * Import siswa from Excel for guru
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function siswaImport(Request $request)
    {
        ini_set('max_execution_time', 300);

        // $validator = Validator::make($request->all(), [
        //     'file' => 'required|mimes:xlsx,xls,csv'
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator);
        // }

        try {
            $import = new SiswaImport();
            Excel::import($import, $request->file('file'));
            
            // Buat pesan berdasarkan hasil import
            $messages = [];
            
            if ($import->successCount > 0) {
                $messages[] = "Berhasil mengimpor {$import->successCount} data siswa.";
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
        if ($user->role !== 'guru' && $user->username !== 'guru') {
            abort(403, 'Unauthorized access');
        }

        return Excel::download(new SiswaExport, 'template_siswa.xlsx');
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
