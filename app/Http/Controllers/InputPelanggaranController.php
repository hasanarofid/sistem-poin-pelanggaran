<?php

namespace App\Http\Controllers;

use App\Models\InputPelanggaranT;
use App\Models\JenisPelanggaran;
use App\Siswa;
use Illuminate\Http\Request;

class InputPelanggaranController extends Controller
{
    //index
    public function index()
    {
        $inputPelanggaranT = InputPelanggaranT::with('jenispelanggaran', 'siswa')->get();
        $siswa = Siswa::get();
        $jenisPelanggaran = JenisPelanggaran::get();
        return view('inputpelanggaran.index', compact('inputPelanggaranT', 'siswa', 'jenisPelanggaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id'                  => 'required|string|max:255',
            'jenis_pelanggaran_id'      => 'required|integer',
            'keterangan'                => 'nullable|string',
        ]);

        InputPelanggaranT::create([
            'siswa_id'              => $request->siswa_id,
            'jenis_pelanggaran_id'  => $request->jenis_pelanggaran_id,
            'keterangan'            => $request->keterangan,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan'
            ]);
        }

        return redirect()
            ->route('admin.input-pelanggaran.index')
            ->with('success', 'Data berhasil disimpan');
    }

    public function destroy($id)
    {
        $pelanggaran = InputPelanggaranT::findOrFail($id);
        $pelanggaran->delete();

        return redirect()
            ->route('admin.input-pelanggaran.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
