<?php

namespace App\Http\Controllers;

use App\Models\JenisPelanggaran;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    //index
    public function index()
    {
        $kategori = Kategori::get();
        return view('kategori.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'is_aktif'         => 'required|boolean',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'is_aktif' => $request->is_aktif,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan'
            ]);
        }

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Data berhasil disimpan');
    }

    public function destroy($id)
    {
        $pelanggaran = Kategori::findOrFail($id);
        $pelanggaran->delete();

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Data berhasil dihapus');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'is_aktif'      => 'required|boolean',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'is_aktif'      => $request->is_aktif,
        ]);

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui');
    }
}
