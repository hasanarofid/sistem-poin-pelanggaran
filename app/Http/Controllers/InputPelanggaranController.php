<?php

namespace App\Http\Controllers;

use App\Models\InputPelanggaranT;
use App\Models\JenisPelanggaran;
use App\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InputPelanggaranController extends Controller
{
    //index
    public function index()
    {
        $inputPelanggaranT = InputPelanggaranT::with('jenispelanggaran', 'siswa')->get();
        $siswa = Siswa::with(['kelas', 'point'])->orderBy('nama', 'asc')->get(); // Eager load kelas, point and order
        $jenisPelanggaran = JenisPelanggaran::with('kategori')->orderBy('kode', 'asc')->get(); // Eager load kategori and order
        return view('inputpelanggaran.index', compact('inputPelanggaranT', 'siswa', 'jenisPelanggaran'));
    }

    public function store(Request $request)
    {
        $pelapor_id = Auth::user()->id;
        $request->validate([
            'siswa_id'                  => 'required|string|max:255',
            'jenis_pelanggaran_id'      => 'required|integer',
            'keterangan'                => 'nullable|string',
        ]);

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
            
            // Ambil atau buat poin siswa
            $siswa = Siswa::find($request->siswa_id);
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

            return redirect()
                ->route('admin.input-poin.index')
                ->with('success', 'Data berhasil disimpan');
                
        } catch (\Exception $e) {
            DB::rollback();
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }

            return redirect()
                ->route('admin.input-poin.index')
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
}
