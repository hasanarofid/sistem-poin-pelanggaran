<?php

namespace App\Http\Controllers;

use App\Models\AspekProgram;
use App\Models\JenisProgram;
use App\Models\Kategory;
use App\Models\RencanaKerjaT;
use App\Models\SekolahbinaanT;
use App\Models\TugaskerjaT;
use App\SekolahM;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use DataTables;
class PerencanaanController extends Controller
{
    //index
    public function index(){
        $kegiatan = TugaskerjaT::with('tugas')
        ->where('id_pengawas',Auth::user()->id)->get();
        $kategory = Kategory::where('type','perencanaan')->get();
        $subkategory = [];
        $binaan = SekolahbinaanT::with('sekolah')
        ->where('id_pengawas',Auth::user()->id)->get();
        $currentMonth = date('n'); // Numeric representation of the current month (1-12)
        $currentYear = date('Y');  // Current year
        $months = [];
    
        // Generate the current and next 3 months
        for ($i = 0; $i < 3; $i++) {
            $timestamp = strtotime("+$i month");
            $months[] = [
                'value' => date('n', $timestamp),  // Month number (1-12)
                'name' => date('F', $timestamp),   // Full month name
            ];
        }
        $jenisProgram = JenisProgram::where('status',true)->get();
        $aspekProgram = AspekProgram::where('status',true)->get();

        return view('dashboard_pengawas.perencanaan.index',
        compact('kegiatan'
        ,'kategory','subkategory','binaan','months',
        'jenisProgram','aspekProgram'
        
    ));
    }

     // get data perencanaa
     public function getdata(Request $request){
        if ($request->ajax()) {

    
         $post = RencanaKerjaT::with('kategoriprogram')
         ->where('id_pengawas',Auth::user()->id)->latest()->get();
    
            return Datatables::of($post)
                    ->addIndexColumn()
            //          ->addColumn('foto', function($row){
            //             if($row->foto == 'userdefault.jpg'){
            //                 $foto = asset('userdefault.jpg');
            //             }else{
            //                 $foto =  route('laporan',$row->foto );
            //             }

            //          return  ' <div class="card card-profile"><img src="'.$foto.'" height="100px" alt="Image placeholder" class="card-img-top"></div>';
            //         })->addColumn('tugas', function($row){
            //             return !empty($row->tugaskerja->tugas->kegiatan) ? $row->tugaskerja->tugas->kegiatan: '-';
            ->addColumn('tanggal', function($row){
                return $row->created_at->format('d M Y h:i:s');
            })
            ->addColumn('nama_kategori', function($row){
                return $row->kategoriprogram->nama;
            })

             ->addColumn('nama_sekolah', function($row){
                $sekolahIds = explode(',', $row->sekolah_id);
                $sekolahs = SekolahM::whereIn('id', $sekolahIds)->get();
                
                $nama_sekolah = '';
                foreach ($sekolahs as $sekolah) {
                    $nama_sekolah .= '<span class="badge bg-label-primary m-1">' . $sekolah->nama_sekolah . '</span> '; // Added a space for separation
                }
                // dd($nama_sekolah);
                
                return $nama_sekolah;
            })

            ->addColumn('action', function($row){
   
                           $btn = '<a  onclick="editPerencanaan('.$row->id.')" class="btn btn-sm bg-info text-white " > <i class="fa fa-edit"></i> Edit</a>';
                           $btn = $btn. '<a href="#" onclick="deletePerencanaan('.$row->id.')" class="btn btn-danger btn-sm deletePost"><i class="fa fa-remove"></i> Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action','nama_kategori','nama_sekolah'])
                    ->make(true);
        }
    }

    public function save(Request $request){
        $sekolah_ids = implode(',', $request->post('sekolah_id'));
        $model = new RencanaKerjaT();
        $model->tahun_ajaran = date('Y');
        $model->id_pengawas = Auth::user()->id;
        $model->nama_program_kerja = $request->post('nama_program_kerja');
        $model->kategoriprogram_id = $request->post('kategoriprogram_id');
        $model->sekolah_id = $sekolah_ids;
        $model->deskripsi_permasalahan = $request->post('deskripsi_permasalahan');
        $model->target_capaian = $request->post('target_capaian');
        $model->tenggat_waktu = $request->post('tenggat_waktu');
        $model->save();
        return redirect()->route('pengawas.perencanaan')->with('success', 'Perencanaan berhasil disimpan!');
    }

    //update 
    public function update(Request $request){
        $data = RencanaKerjaT::findOrFail($request->post('id'));
        // dd($request->post());
        $sekolah_ids = implode(',', $request->post('sekolah_id'));
        $data->tahun_ajaran = date('Y');
        $data->id_pengawas = Auth::user()->id;
        $data->nama_program_kerja = $request->post('nama_program_kerja');
        $data->kategoriprogram_id = $request->post('kategoriprogram_id');
        $data->sekolah_id = $sekolah_ids;
        $data->deskripsi_permasalahan = $request->post('deskripsi_permasalahan');
        $data->target_capaian = $request->post('target_capaian');
        $data->tenggat_waktu = $request->post('tenggat_waktu');
        $data->save();
        return redirect()->route('pengawas.perencanaan')->with('success', 'Perencanaan berhasil diedit!');
    }


    public function edit($id)
    {
        // Ambil data dari model berdasarkan ID atau yang lain sesuai kebutuhan
        $data = RencanaKerjaT::findOrFail($id); // Gantilah YourModel dengan model yang sesuai
        
        return response()->json($data);
    }


    public function hapus($id)
    {
        // Temukan data yang akan dihapus
        $data = RencanaKerjaT::findOrFail($id);
        
        // Lakukan operasi penghapusan data
        $data->delete();
        
        // Balas dengan respons yang sesuai
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }

}
