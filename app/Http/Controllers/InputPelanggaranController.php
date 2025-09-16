<?php

namespace App\Http\Controllers;

use App\Models\InputPelanggaranT;
use App\Models\JenisPelanggaran;
use App\Siswa;
use App\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InputPelanggaranController extends Controller
{
    //index
    public function index()
    {
        $user = Auth::user();
        
        // Filter berdasarkan role
        if ($user->role === 'Guru') {
            // Untuk guru, hanya tampilkan siswa di kelasnya
            $kelasId = $user->kelas_id;
            $inputPelanggaranT = InputPelanggaranT::with('jenispelanggaran', 'siswa')
                ->whereHas('siswa', function($q) use ($kelasId) {
                    $q->where('kelas_id', $kelasId);
                })->get();
            $siswa = Siswa::with(['kelas', 'point'])
                ->where('kelas_id', $kelasId)
                ->orderBy('nama', 'asc')->get();
        } else {
            // Untuk admin, tampilkan semua data
            $inputPelanggaranT = InputPelanggaranT::with('jenispelanggaran', 'siswa')->get();
            $siswa = Siswa::with(['kelas', 'point'])->orderBy('nama', 'asc')->get();
        }
        
        $jenisPelanggaran = JenisPelanggaran::with('kategori')->orderBy('kode', 'asc')->get();
        return view('inputpelanggaran.index', compact('inputPelanggaranT', 'siswa', 'jenisPelanggaran'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $pelapor_id = $user->id;
        $request->validate([
            'siswa_id'                  => 'required|string|max:255',
            'jenis_pelanggaran_id'      => 'required|integer',
            'keterangan'                => 'nullable|string',
        ]);

        // Validasi untuk guru: pastikan siswa adalah dari kelas guru
        if ($user->role === 'Guru') {
            $siswa = Siswa::find($request->siswa_id);
            if (!$siswa || $siswa->kelas_id !== $user->kelas_id) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Anda hanya dapat menginput poin untuk siswa di kelas yang Anda ajar.'
                    ]);
                }
                return redirect()->back()
                    ->with('error', 'Anda hanya dapat menginput poin untuk siswa di kelas yang Anda ajar.');
            }
        }

        // Mulai transaksi database
        DB::beginTransaction();
        
        try {
            // Simpan input pelanggaran
            $inputPelanggaran = InputPelanggaranT::create([
                'siswa_id'              => $request->siswa_id,
                'jenis_pelanggaran_id'  => $request->jenis_pelanggaran_id,
                'keterangan'            => $request->keterangan,
                'pelapor_id'            => $pelapor_id,
            ]);

            // Ambil data jenis pelanggaran untuk mendapatkan poin
            $jenisPelanggaran = JenisPelanggaran::find($request->jenis_pelanggaran_id);
            
            // Ambil atau buat poin siswa (jika belum diambil di validasi)
            if (!isset($siswa)) {
                $siswa = Siswa::find($request->siswa_id);
            }
            $point = $siswa->getOrCreatePoint();
            
            // Tentukan jenis transaksi berdasarkan poin
            $jenisTransaksi = $jenisPelanggaran->poin < 0 ? 'pelanggaran' : 'reward';
            
            // Update poin dengan histori (poin bisa bertambah atau berkurang)
            $point->updatePoin(
                $jenisPelanggaran->poin, // Poin sesuai dengan nilai di database
                $jenisTransaksi,
                $inputPelanggaran->id, // Selalu gunakan input_pelanggaran_id karena semua input masuk ke tabel ini
                $request->keterangan,
                $pelapor_id
            );

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan'
                ]);
            }

            // Redirect berdasarkan role
            $redirectRoute = $user->role === 'Guru' ? 'guru.input-poin' : 'admin.input-poin.index';
            return redirect()
                ->route($redirectRoute)
                ->with('success', 'Data berhasil disimpan');
                
        } catch (\Exception $e) {
            DB::rollback();
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }

            // Redirect berdasarkan role
            $redirectRoute = $user->role === 'Guru' ? 'guru.input-poin' : 'admin.input-poin.index';
            return redirect()
                ->route($redirectRoute)
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $pelanggaran = InputPelanggaranT::findOrFail($id);
        $pelanggaran->delete();

        return redirect()
            ->route('admin.input-poin.index')
            ->with('success', 'Data berhasil dihapus');
    }

    public function edit($id)
    {
        $pelanggaran = InputPelanggaranT::findOrFail($id);
        return response()->json($pelanggaran);
    }

    public function update(Request $request, $id)
    {
        $pelapor_id = Auth::user()->id;
        $request->validate([
            'siswa_id' => 'required',
            'jenis_pelanggaran_id' => 'required',
            'keterangan' => 'nullable|string',
        ]);

        $pelanggaran = InputPelanggaranT::findOrFail($id);
        $pelanggaran->update([
            'siswa_id' => $request->siswa_id,
            'jenis_pelanggaran_id' => $request->jenis_pelanggaran_id,
            'keterangan' => $request->keterangan,
            'pelapor_id' => $pelapor_id,
        ]);

        return response()->json(['success' => true, 'message' => 'Input Poin berhasil diperbarui']);
    }

    // Method untuk list input point
    public function listInputPoin()
    {
        $inputPelanggaranT = InputPelanggaranT::with(['jenispelanggaran.kategori', 'siswa.kelas', 'pelapor'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('inputpelanggaran.list', compact('inputPelanggaranT'));
    }

    // Method untuk show detail input point
    public function showInputPoin($id)
    {
        $inputPelanggaran = InputPelanggaranT::with(['jenispelanggaran.kategori', 'siswa.kelas', 'pelapor'])
            ->findOrFail($id);
        
        return view('inputpelanggaran.show', compact('inputPelanggaran'));
    }

    // Method untuk edit input point
    public function editInputPoin($id)
    {
        $inputPelanggaran = InputPelanggaranT::with(['jenispelanggaran.kategori', 'siswa.kelas'])
            ->findOrFail($id);
        $jenisPelanggaran = JenisPelanggaran::with('kategori')->orderBy('kode', 'asc')->get();
        $siswa = Siswa::with(['kelas', 'point'])->orderBy('nama', 'asc')->get();
        
        return view('inputpelanggaran.edit', compact('inputPelanggaran', 'jenisPelanggaran', 'siswa'));
    }

    // Method untuk update input point dengan recalculate poin
    public function updateInputPoin(Request $request, $id)
    {
        // dd('ada');
        $user = Auth::user();
        $pelapor_id = $user->id;
        
        $request->validate([
            'siswa_id' => 'required|integer|exists:siswa,id',
            'jenis_pelanggaran_id' => 'required|integer|exists:jenis_pelanggaran,id',
            'keterangan' => 'nullable|string|max:255',
        ]);

        // Debug logging
        \Log::info('Updating input poin', [
            'input_id' => $id,
            'request_data' => $request->all(),
            'user_id' => $pelapor_id
        ]);

        DB::beginTransaction();
        
        try {
            // Ambil data lama untuk rollback poin
            $oldInputPelanggaran = InputPelanggaranT::findOrFail($id);
            $oldJenisPelanggaran = JenisPelanggaran::findOrFail($oldInputPelanggaran->jenis_pelanggaran_id);
            $oldSiswa = Siswa::findOrFail($oldInputPelanggaran->siswa_id);
            $oldPoint = $oldSiswa->getOrCreatePoint();
            
            // Rollback poin lama
            $oldJenisTransaksi = $oldJenisPelanggaran->poin < 0 ? 'pelanggaran' : 'reward';
            $oldPoint->updatePoin(
                -$oldJenisPelanggaran->poin, // Negatif untuk rollback
                $oldJenisTransaksi,
                $oldInputPelanggaran->id,
                'Rollback: ' . $oldInputPelanggaran->keterangan,
                $pelapor_id
            );

            // Update input pelanggaran
            $oldInputPelanggaran->update([
                'siswa_id' => $request->siswa_id,
                'jenis_pelanggaran_id' => $request->jenis_pelanggaran_id,
                'keterangan' => $request->keterangan,
                'pelapor_id' => $pelapor_id,
            ]);

            // Ambil data baru untuk apply poin
            $newJenisPelanggaran = JenisPelanggaran::findOrFail($request->jenis_pelanggaran_id);
            $newSiswa = Siswa::findOrFail($request->siswa_id);
            $newPoint = $newSiswa->getOrCreatePoint();
            
            // Apply poin baru
            $newJenisTransaksi = $newJenisPelanggaran->poin < 0 ? 'pelanggaran' : 'reward';
            $newPoint->updatePoin(
                $newJenisPelanggaran->poin,
                $newJenisTransaksi,
                $oldInputPelanggaran->id,
                $request->keterangan,
                $pelapor_id
            );

            DB::commit();

            // Debug logging
            \Log::info('Update successful, redirecting with flash message', [
                'input_id' => $id,
                'user_id' => $pelapor_id
            ]);

            return redirect()
                ->route('admin.list-input-poin.index')
                ->with('success', 'Data berhasil diperbarui dan poin dihitung ulang');
                
        } catch (\Exception $e) {
            DB::rollback();
            
            // Log error untuk debugging
            \Log::error('Error updating input poin: ' . $e->getMessage(), [
                'input_id' => $id,
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()
                ->route('admin.list-input-poin.index')
                ->with('error', 'Terjadi kesalahan server: ' . $e->getMessage());
        }
    }

    // Method untuk penambahan poin otomatis satu kelas
    public function penambahanPoinKelas()
    {
        $kelas = Kelas::aktif()->orderBy('nama_kelas', 'asc')->orderBy('subkelas', 'asc')->get();
        $jenisPelanggaran = JenisPelanggaran::with('kategori')->orderBy('kode', 'asc')->get();
        
        return view('inputpelanggaran.penambahan-poin-kelas', compact('kelas', 'jenisPelanggaran'));
    }

    // Method untuk get siswa by kelas (AJAX)
    public function getSiswaByKelas($kelas_id)
    {
        $siswa = Siswa::with(['kelas', 'point'])
            ->where('kelas_id', $kelas_id)
            ->orderBy('nama', 'asc')
            ->get();
        
        return response()->json($siswa);
    }

    // Method untuk store poin kelas (multi insert)
    public function storePoinKelas(Request $request)
    {
        $user = Auth::user();
        $pelapor_id = $user->id;
        
        // Debug logging
        \Log::info('Store Poin Kelas - Request Data:', [
            'request_data' => $request->all(),
            'user_id' => $pelapor_id
        ]);
        
        try {
            $request->validate([
                'kelas_id' => 'required|integer|exists:kelas,id',
                'jenis_pelanggaran_id' => 'required|integer|exists:jenis_pelanggaran,id',
                'keterangan' => 'nullable|string|max:255',
                'siswa_ids' => 'required|array|min:1',
                'siswa_ids.*' => 'required|integer|exists:siswa,id',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Store Poin Kelas - Validation Error:', [
                'errors' => $e->errors(),
                'request_data' => $request->all()
            ]);
            
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $e->errors()
                ], 422);
            }
            
            return redirect()
                ->route('admin.penambahan-poin-kelas.index')
                ->withErrors($e->errors())
                ->withInput();
        }

        DB::beginTransaction();
        
        try {
            $jenisPelanggaran = JenisPelanggaran::find($request->jenis_pelanggaran_id);
            $jenisTransaksi = $jenisPelanggaran->poin < 0 ? 'pelanggaran' : 'reward';
            $successCount = 0;
            $errors = [];

            // Optimized bulk processing
            $siswaIds = $request->siswa_ids;
            $chunkSize = 10; // Process in chunks of 10 for better performance
            
            \Log::info('Processing siswa_ids:', [
                'siswa_ids' => $siswaIds,
                'total_count' => count($siswaIds)
            ]);
            
            // Process in chunks to avoid memory issues
            foreach (array_chunk($siswaIds, $chunkSize) as $chunk) {
                // Bulk insert for this chunk
                $inputPelanggaranData = [];
                foreach ($chunk as $siswa_id) {
                    $inputPelanggaranData[] = [
                        'siswa_id' => $siswa_id,
                        'jenis_pelanggaran_id' => $request->jenis_pelanggaran_id,
                        'keterangan' => $request->keterangan,
                        'pelapor_id' => $pelapor_id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                
                \Log::info('Bulk insert data for chunk:', [
                    'chunk_size' => count($chunk),
                    'data' => $inputPelanggaranData
                ]);
                
                // Bulk insert this chunk
                $insertResult = InputPelanggaranT::insert($inputPelanggaranData);
                
                \Log::info('Bulk insert result:', [
                    'result' => $insertResult,
                    'chunk_size' => count($chunk)
                ]);
                
                // Get inserted records for this chunk
                $inputPelanggaranList = InputPelanggaranT::where('pelapor_id', $pelapor_id)
                    ->where('jenis_pelanggaran_id', $request->jenis_pelanggaran_id)
                    ->whereIn('siswa_id', $chunk)
                    ->orderBy('created_at', 'desc')
                    ->limit(count($chunk))
                    ->get();

                // Update poin for this chunk
                foreach ($inputPelanggaranList as $inputPelanggaran) {
                    try {
                        $siswa = Siswa::find($inputPelanggaran->siswa_id);
                        $point = $siswa->getOrCreatePoint();
                        
                        // Update poin dengan histori
                        $point->updatePoin(
                            $jenisPelanggaran->poin,
                            $jenisTransaksi,
                            $inputPelanggaran->id,
                            $request->keterangan,
                            $pelapor_id
                        );

                        $successCount++;
                    } catch (\Exception $e) {
                        $errors[] = "Siswa ID {$inputPelanggaran->siswa_id}: " . $e->getMessage();
                    }
                }
            }

            DB::commit();

            $message = "Berhasil menambahkan poin untuk {$successCount} siswa";
            if (!empty($errors)) {
                $message .= ". Terdapat " . count($errors) . " error: " . implode(', ', $errors);
            }

            \Log::info('Store Poin Kelas - Success:', [
                'success_count' => $successCount,
                'errors' => $errors,
                'message' => $message
            ]);

            // Return JSON response for AJAX
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'data' => [
                        'success_count' => $successCount,
                        'total_processed' => count($request->siswa_ids),
                        'errors' => $errors
                    ]
                ]);
            }

            return redirect()
                ->route('admin.penambahan-poin-kelas.index')
                ->with('success', $message);
                
        } catch (\Exception $e) {
            DB::rollback();
            
            \Log::error('Store Poin Kelas - Error:', [
                'error_message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);
            
            $errorMessage = 'Terjadi kesalahan: ' . $e->getMessage();
            
            // Return JSON response for AJAX
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage,
                    'error' => [
                        'message' => $e->getMessage(),
                        'file' => $e->getFile(),
                        'line' => $e->getLine()
                    ]
                ], 500);
            }
            
            return redirect()
                ->route('admin.penambahan-poin-kelas.index')
                ->with('error', $errorMessage);
        }
    }

    // Method untuk AJAX get kelas untuk filter
    public function getKelasForFilter(Request $request)
    {
        $term = $request->get('term', '');
        
        $kelas = Kelas::aktif()
            ->where(function($query) use ($term) {
                $query->where('nama_kelas', 'like', '%' . $term . '%')
                      ->orWhere('subkelas', 'like', '%' . $term . '%');
            })
            ->orderBy('nama_kelas', 'asc')
            ->orderBy('subkelas', 'asc')
            ->get();
        
        return response()->json($kelas);
    }

    // Method untuk AJAX get jenis poin untuk filter
    public function getJenisPoinForFilter(Request $request)
    {
        $term = $request->get('term', '');
        
        $jenisPelanggaran = JenisPelanggaran::with('kategori')
            ->where(function($query) use ($term) {
                $query->where('kode', 'like', '%' . $term . '%')
                      ->orWhere('nama_pelanggaran', 'like', '%' . $term . '%')
                      ->orWhereHas('kategori', function($q) use ($term) {
                          $q->where('nama_kategori', 'like', '%' . $term . '%');
                      });
            })
            ->orderBy('kode', 'asc')
            ->get();
        
        return response()->json($jenisPelanggaran);
    }
}
