<?php

namespace App\Http\Controllers;

use App\Models\JenisPelanggaran;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    //index
    public function index(Request $request)
    {
        $query = Kategori::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_kategori', 'like', "%{$search}%");
            });
        }

        $kategori = $query->orderBy('nama_kategori', 'asc')->paginate(10);
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
            'is_aktif' => 'required|in:0,1',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->is_aktif = $request->is_aktif;
        $kategori->save();

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil diperbarui'
        ]);
    }
}
