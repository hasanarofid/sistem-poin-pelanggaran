<?php

namespace App\Http\Controllers;

use App\Models\InputRewardT;
use App\Models\JenisReward;
use App\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InputRewardController extends Controller
{
    //index
    public function index()
    {
        $inputRewardT = InputRewardT::with('jenisReward', 'siswa')->get();
        $siswa = Siswa::get();
        $jenisReward = JenisReward::where('is_aktif', true)->get();
        return view('inputreward.index', compact('inputRewardT', 'siswa', 'jenisReward'));
    }

    public function store(Request $request)
    {
        $pelapor_id = Auth::user()->id;
        $request->validate([
            'siswa_id'                  => 'required|string|max:255',
            'jenis_reward_id'      => 'required|integer',
            'keterangan'                => 'nullable|string',
        ]);

        // Mulai transaksi database
        DB::beginTransaction();
        
        try {
            // Simpan input reward
            $inputReward = InputRewardT::create([
                'siswa_id'              => $request->siswa_id,
                'jenis_reward_id'  => $request->jenis_reward_id,
                'keterangan'            => $request->keterangan,
                'pelapor_id'            => $pelapor_id,
            ]);

            // Ambil data jenis reward untuk mendapatkan poin
            $jenisReward = JenisReward::find($request->jenis_reward_id);
            
            // Ambil atau buat poin siswa
            $siswa = Siswa::find($request->siswa_id);
            $point = $siswa->getOrCreatePoint();
            
            // Update poin dengan histori (poin bertambah untuk reward)
            $point->updatePoin(
                $jenisReward->poin, // Poin bertambah
                'reward',
                null,
                $request->jenis_reward_id,
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
                ->route('admin.input-reward.index')
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
                ->route('admin.input-reward.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $reward = InputRewardT::findOrFail($id);
        $reward->delete();

        return redirect()
            ->route('admin.input-reward.index')
            ->with('success', 'Data berhasil dihapus');
    }

    public function edit($id)
    {
        $reward = InputRewardT::findOrFail($id);
        return response()->json($reward);
    }

    public function update(Request $request, $id)
    {
        $pelapor_id = Auth::user()->id;
        $request->validate([
            'siswa_id' => 'required',
            'jenis_reward_id' => 'required',
            'keterangan' => 'nullable|string',
        ]);

        $reward = InputRewardT::findOrFail($id);
        $reward->update([
            'siswa_id' => $request->siswa_id,
            'jenis_reward_id' => $request->jenis_reward_id,
            'keterangan' => $request->keterangan,
            'pelapor_id' => $pelapor_id,
        ]);

        return response()->json(['success' => true, 'message' => 'Input Reward berhasil diperbarui']);
    }
}
