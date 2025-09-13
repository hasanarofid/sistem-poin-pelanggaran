<?php

namespace App\Http\Controllers;

use App\Models\JenisReward;
use App\Models\Kategori;
use Illuminate\Http\Request;

class JenisRewardController extends Controller
{
    //index
    public function index()
    {
        $jenisReward = JenisReward::with('kategori')->get();
        $kategori = Kategori::where('is_aktif', true)->get();
        return view('jenisreward.index', compact('jenisReward', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_reward' => 'required|string|max:255',
            'kategori_id'      => 'required|integer',
            'poin'             => 'required|integer|min:1|max:50',
            'deskripsi'        => 'nullable',
        ]);

        JenisReward::create([
            'nama_reward' => $request->nama_reward,
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
            ->route('admin.jenis-reward.index')
            ->with('success', 'Data berhasil disimpan');
    }

    public function destroy($id)
    {
        $reward = JenisReward::findOrFail($id);
        $reward->delete();

        return redirect()
            ->route('admin.jenis-reward.index')
            ->with('success', 'Data berhasil dihapus');
    }

    public function update(Request $request, $id)
    {
        // Cari data
        $reward = JenisReward::findOrFail($id);

        $request->validate([
            'nama_reward' => 'required|string|max:255',
            'kategori_id'      => 'required|integer',
            'poin'             => 'required|integer|min:1|max:50',
            'deskripsi'        => 'nullable',
        ]);

        $reward->update([
            'nama_reward' => $request->nama_reward,
            'kategori_id'      => $request->kategori_id,
            'poin'             => $request->poin,
            'deskripsi'        => $request->deskripsi,
        ]);

        return response()->json(['success' => true, 'message' => 'Jenis Reward berhasil diperbarui']);
    }
}
