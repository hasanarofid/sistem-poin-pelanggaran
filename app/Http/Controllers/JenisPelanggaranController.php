<?php

namespace App\Http\Controllers;

use App\Models\JenisPelanggaran;
use App\Models\Kategori;
use Illuminate\Http\Request;

class JenisPelanggaranController extends Controller
{
    //index
    public function index(Request $request)
    {
        $query = JenisPelanggaran::with('kategori');

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode', 'like', "%{$search}%")
                    ->orWhere('nama_pelanggaran', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhereHas('kategori', function ($kategoriQuery) use ($search) {
                        $kategoriQuery->where('nama_kategori', 'like', "%{$search}%");
                    });
            });
        }

        $jenisPelanggaran = $query->orderBy('kode', 'asc')->paginate(10);
        $kategori = Kategori::where('is_aktif', true)->get();

        return view('jenispelanggaran.index', compact('jenisPelanggaran', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode'             => 'required|string|max:255|unique:jenis_pelanggaran,kode',
            'nama_pelanggaran' => 'required|string|max:255',
            'kategori_id'      => 'required|integer',
            'poin'             => 'required|integer|min:-100|max:100',
            'deskripsi'        => 'nullable',
        ]);

        JenisPelanggaran::create([
            'kode'             => $request->kode,
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

        $request->validate([
            'kode'             => 'required|string|max:255|unique:jenis_pelanggaran,kode,' . $id,
            'nama_pelanggaran' => 'required|string|max:255',
            'kategori_id'      => 'required|integer',
            'poin'             => 'required|integer|min:-100|max:100',
            'deskripsi'        => 'nullable',
        ]);

        // Update data
        $pelanggaran->kode = $request->kode;
        $pelanggaran->nama_pelanggaran = $request->nama_pelanggaran;
        $pelanggaran->kategori_id = $request->kategori_id;
        $pelanggaran->poin = $request->poin;
        $pelanggaran->deskripsi = $request->deskripsi;
        $pelanggaran->save();

        // Kalau pakai AJAX, balikan JSON
        return redirect()->route('admin.jenis-poin.index')
            ->with('success', 'Jenis Poin berhasil diperbarui');
    }
}
