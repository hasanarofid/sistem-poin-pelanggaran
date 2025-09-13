<?php

namespace App\Http\Controllers;

use App\Models\JenisPelanggaran;
use App\Models\Kategori;
use Illuminate\Http\Request;

class JenisPelanggaranController extends Controller
{
    //index
    public function index()
    {
        $jenisPelanggaran = JenisPelanggaran::with('kategori')->get();
        $kategori = Kategori::where('is_aktif', true)->get();
        return view('jenispelanggaran.index', compact('jenisPelanggaran', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggaran' => 'required|string|max:255',
            'kategori_id'      => 'required|integer',
            'poin'             => 'required|integer|min:1|max:50',
            'deskripsi'        => 'nullable',
        ]);

        JenisPelanggaran::create([
            'nama_pelanggaran' => $request->nama_pelanggaran,
            'kategori_id'      => $request->kategori_id,
            'poin'             => $request->poin,
            'deskripsi'        => $request->deskripsi,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan'
            ]);
        }

        return redirect()
            ->route('admin.jenis-poin.index')
            ->with('success', 'Data berhasil disimpan');
    }

    public function destroy($id)
    {
        $pelanggaran = JenisPelanggaran::findOrFail($id);
        $pelanggaran->delete();

        return redirect()
            ->route('admin.jenis-poin.index')
            ->with('success', 'Data berhasil dihapus');
    }

    public function update(Request $request, $id)
    {
        // Cari data
        $pelanggaran = JenisPelanggaran::findOrFail($id);

        // Update data
        $pelanggaran->nama_pelanggaran = $request->nama_pelanggaran;
        $pelanggaran->kategori_id = $request->kategori_id;
        $pelanggaran->poin = $request->poin;
        $pelanggaran->deskripsi = $request->deskripsi;
        $pelanggaran->save();

        // Kalau pakai AJAX, balikan JSON
        return response()->json([
            'success' => true,
            'message' => 'Jenis Poin berhasil diperbarui'
        ]);
    }
}
