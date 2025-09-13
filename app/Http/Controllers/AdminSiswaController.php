<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;
use App\Kelas;
use App\TahunAjaran;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SiswaExport;
use App\Exports\TemplateSiswaExport;
use App\Imports\SiswaImport;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSiswaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role.admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Siswa::with(['kelas', 'tahunAjaran', 'point']);
        
        // Jika ada parameter search, tambahkan kondisi pencarian
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        $tahunAjaran = TahunAjaran::all();
        return view('siswa.create', compact('kelas', 'tahunAjaran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        $siswa = Siswa::create($request->all());

        // Buat default poin 100 untuk siswa baru
        \App\Point::create([
            'siswa_id' => $siswa->id,
            'total_poin' => 100
        ]);

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Siswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $siswa = Siswa::with(['kelas', 'tahunAjaran'])->findOrFail($id);
        return view('siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $kelas = Kelas::all();
        $tahunAjaran = TahunAjaran::all();
        return view('siswa.edit', compact('siswa', 'kelas', 'tahunAjaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Siswa berhasil dihapus.');
    }

    /**
     * Export siswa to Excel
     *
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        return Excel::download(new SiswaExport, 'siswa.xlsx');
    }

    /**
     * Show import form
     *
     * @return \Illuminate\Http\Response
     */
    public function importForm()
    {
        return view('siswa.import');
    }

    /**
     * Import siswa from Excel
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
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
                return redirect()->route('admin.siswa.index')
                    ->with('success', implode("<br>", $messages));
            }
            
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
        }
    }

    /**
     * Download template Excel
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadTemplate()
    {
        return Excel::download(new TemplateSiswaExport, 'template_siswa.xlsx');
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

            return redirect()->route('admin.siswa.index')
                ->with('success', 'Kelas siswa berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui kelas siswa: ' . $e->getMessage());
        }
    }
}
