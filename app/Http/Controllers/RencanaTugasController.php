<?php

namespace App\Http\Controllers;

use App\Models\UmpanbalikT;
use Illuminate\Http\Request;
use App\Models\RencanaKerjaT;
use App\Kabupaten;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Imports\ImportUser;
use App\Exports\ExportUser;
use App\SekolahM;
use App\User;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class RencanaTugasController extends Controller
{
    //index
    public function index(){
        $listPengawas = User::where('role','pengawas')->get();
        return view('rencanakerja.index',compact('listPengawas'));
    }

    public function getdata(Request $request){
        if ($request->ajax()) {
            $query = RencanaKerjaT::with('kategoriprogram', 'jenisprogram', 'aspekprogram', 'pengawasnama')
            ->latest();
            if ($request->has('pengawas') && $request->pengawas !== 'all') {
                $query->where('id_pengawas', $request->pengawas);
            }
            return Datatables::of($query->get())
                ->addIndexColumn()
                ->addColumn('pengawas', function($row){
                    return $row->pengawasnama->nip . ' - ' . $row->pengawasnama->name;
                })
                ->addColumn('tanggal', function($row){
                    return $row->created_at->format('d M Y h:i:s');
                })
                ->addColumn('nama_kategori', function($row){
                    return $row->kategoriprogram->nama;
                })
                ->addColumn('nama_jenis', function($row){
                    return !empty($row->jenisprogram->nama) ? $row->jenisprogram->nama : '-';
                })
                ->addColumn('nama_aspek', function($row){
                    return !empty($row->aspekprogram->nama) ? $row->aspekprogram->nama : '-';
                })
                ->addColumn('bulan_tahun', function($row){
                    return $row->bulan . ' - ' . $row->tahun_ajaran;
                })
                ->addColumn('nama_sekolah', function($row) {
                    $sekolahIds = explode(',', $row->sekolah_id);
                    $sekolahs = SekolahM::whereIn('id', $sekolahIds)->get();
    
                    $nama_sekolah = '';
                    foreach ($sekolahs as $sekolah) {
                        $nama_sekolah .= '<span class="badge bg-label-primary m-1" data-sekolah2="' . $sekolah->nama_sekolah . '">' . $sekolah->nama_sekolah . '</span> ';
                    }
    
                    return $nama_sekolah;
                })
             
                ->addColumn('status', function($row){
                    if($row->status == 1){
                        $status = '<span class="badge bg-label-success m-1" >Sudah Kirim WA Blast</span>';
                    }else{
                        $status = '<span class="badge bg-label-danger m-1" >Belum Kirim WA Blast</span>';
                    }
                        return $status;
                })
                ->addColumn('action', function($row) {
                    return '<a id="sendWaButton-'.$row->id.'" onclick="kirimWaBlast('.$row->id.')" class="btn btn-sm bg-success text-white"> 
                                <i class="fa fa-envelope"></i> Kirim Wa
                            </a>';
                })

                ->rawColumns(['pengawas', 'nama_kategori', 'nama_jenis', 'nama_aspek', 'nama_sekolah','nama_sekolah2','status','action'])
                ->make(true);
        }
    
      
        return view('rencanakerja.index');
    }

    public function kirimWa($id)
    {
        try {
            $model = RencanaKerjaT::findOrFail($id);
            $sekolahIds = explode(',', $model->sekolah_id);
            
            $sekolahs = SekolahM::with('kepalaSekolahSatu')->whereIn('id', $sekolahIds)->get();
            
            foreach ($sekolahs as $list) {
                $nama_sekolah = $list->nama_sekolah;
                $kepalaSekolah = $list->kepalaSekolahSatu;
                if ($kepalaSekolah) {
                    $nama_kepala_sekolah = $kepalaSekolah->nama;
                    $nama_kepala_sekolah_id = $kepalaSekolah->id;
                    $no_telp = $kepalaSekolah->no_telp;
                    
                    $this->buildUmpanBalik($model, $nama_sekolah, $nama_kepala_sekolah, $nama_kepala_sekolah_id, $no_telp);
                }
            }
            $model->status = 1;
            $model->save();
        } catch (\Exception $e) {
            Log::error("Failed to send WhatsApp message: " . $e->getMessage());
        }
    }
    
    public function buildUmpanBalik($model, $nama_sekolah, $nama_kepala_sekolah, $nama_kepala_sekolah_id, $no_telp)
    {
        try {
            $uniqueUrl = Str::uuid()->toString();
            
            $umpanBalik = new UmpanbalikT();
            $umpanBalik->id_pelaporan = $model->id;
            $umpanBalik->id_user = $nama_kepala_sekolah_id;
            $umpanBalik->id_pengawas = $model->id_pengawas;
            $umpanBalik->generate_url = $uniqueUrl;
            $umpanBalik->save();
            
            $fullUrl = url('umpan-balik/' . $uniqueUrl);
            
            $pesan = "Yth Bapak / Ibu {$nama_kepala_sekolah}
            Kepala {$nama_sekolah}, 
            Pada bulan {$model->bulan} {$model->tahun} 
            pengawas {$model->pengawasnama->name}
            akan melakukan kegiatan pendampingan {$model->nama_program_kerja}
            ke sekolah. 
            Mohon dapat mengisi formulir Monev pada link berikut : {$fullUrl}
            
            Berikut ini beberapa catatan yang penting: 
            1. Pastikan link diisi pada hari pengawas melakukan pendampingan.
            2. Sertakan 1 bukti pendampingan berupa foto kegiatan bersama pengawas.
            
            Terimakasih
            Pesan ini digenerate otomatis oleh Sistem Monitoring dan Evaluasi Digital Pengawas (SiMODiP) KCD Kabupaten Tangerang";
    
            $this->sendWhatsAppMessage($no_telp, $pesan);
            
        } catch (\Exception $e) {
            Log::error("Failed to create or send feedback link: " . $e->getMessage());
        }
    }
    
    protected function sendWhatsAppMessage($phone, $message)
    {
        $token = 'OZ9q0PSQUUV4PRZGxyKUfZjt9EFyt22dTIRnklQSepTmFlrFMN9BqaIs7RXtnD9I';
        $url = "https://jogja.wablas.com/api/send-message";
    
        try {
            $response = Http::withHeaders([
                'Authorization' => $token,
            ])->post($url, [
                'phone' => $phone,
                'message' => $message,
            ]);
    
            if ($response->successful()) {
                Log::info("WhatsApp message sent successfully to {$phone}");
            } else {
                Log::error("Failed to send WhatsApp message to {$phone}: " . $response->body());
            }
            
        } catch (\Exception $e) {
            Log::error("WhatsApp API error for {$phone}: " . $e->getMessage());
        }
    }

}
