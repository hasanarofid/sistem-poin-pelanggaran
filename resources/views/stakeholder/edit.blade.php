@extends('layouts.master')
@section('title','Stakeholder')
@section('subjudul','Edit Stakeholder')
@section('breadcrumbs')
<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Edit Stakeholder</a></li>
<style>
#data-table_info{
   font-size: 12px;
}
#data-table_paginate{
   font-size: 12px;
}
#data-table tbody tr {
    font-size: 12px; /* Adjust the font size to your desired value */
}

</style>
@endsection
@section ('content')
 <div class="container-fluid py-2">
 

       <div class="row">
         <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0 p-3">
                     <div class="row">
                     <div class="col-6 d-flex align-items-center">
                        <h6 class="mb-0">Form Edit Stakeholder </h6>
                     </div>
                     
                     </div>
                  </div>
               <div class="card-body ">
@if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
    {{ Session::forget('success') }}
@endif
               @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                     <form action="{{ route('stakeholder.update',array('id'=>$models->id)) }}"
                        method="POST"
                        enctype="multipart/form-data">
                     @csrf
                     <div class="form-group">
                              <label for="name">Nama Stakeholder</label>
                              <input value="{{ $models->name  }}" type="text" class="form-control" name="name" id="name" placeholder="Nama Pengawas" required>
                     </div>

                     <div class="form-group">
                        <label for="kabupaten_id">Wilayah Kabupaten </label>
                        <select name="kabupaten_id" id="kabupaten_id" class="form-control" required>
                           <option value="">.: Pilih Wilayah :. </option>
                           @foreach ($wilayah as $item)
                              <option {{ ($models->kabupaten_id == $item->id) ? 'selected' : '' }} value="{{  $item->id }}">{{  $item->nama_kabupaten }}</option>
                           @endforeach
                            </select>
                     </div>

                     <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" class="form-control" value="{{ $models->nip  }}" name="nip" id="nip" placeholder="NIP" readonly>
                     </div>
                     <div class="form-group">
                        <label for="name">Jenjang Jabatan </label>
                        <select name="jenjang_jabatan" id="jenjang_jabatan" class="form-control" required>
                           <option value="">.: Pilih Jenjang Jabatan :. </option>
                           <option value="Pengawas Sekolah Utama"  {{ ($models->jenjang_jabatan == 'Pengawas Sekolah Utama') ? 'selected' : ''  }}> Pengawas Sekolah Utama </option>
                           <option value="Pengawas Sekolah Ahli Madya"  {{ ($models->jenjang_jabatan == 'Pengawas Sekolah Ahli Madya') ? 'selected' : ''  }}> Pengawas Sekolah Ahli Madya </option>
                           <option value="Pengawas Sekolah Ahli Muda"  {{ ($models->jenjang_jabatan == 'Pengawas Sekolah Ahli Muda') ? 'selected' : ''  }}> Pengawas Sekolah Ahli Muda </option>
                        </select>
                     </div>

                     <div class="form-group">
                        <label for="pangkat">Pangkat</label>
                        <input type="text" class="form-control" value="{{ $models->pangkat  }}" name="pangkat" id="pangkat" placeholder="Pangkat">
                     </div>

                     <div class="form-group">
                        <label for="gol_ruang">Gol. Ruang</label>
                        <input type="text" class="form-control" value="{{ $models->gol_ruang  }}" name="gol_ruang" id="gol_ruang" placeholder="Gol. Ruang">
                     </div>
                       <div class="form-group">
                              <label for="no_telp">No Telpon</label>
                              <input value="{{ $models->no_telp  }}" type="number" class="form-control" name="no_telp" id="no_telp" placeholder="No Telp/Wa" required> 
                     </div>
                         <div class="form-group">
                              <label for="alamat_lengkap">Alamat</label>
                              <textarea class="form-control" name="alamat_lengkap" id="alamat_lengkap" cols="10" rows="5" required>{{ $models->alamat_lengkap  }}</textarea>
                     </div>
                      <div class="form-group">
                              <label for="kota">Kota</label>
                              <input type="text" value="{{ $models->kota  }}" class="form-control" name="kota" id="kota" placeholder="Kota">
                     </div>
                     <div class="form-group">
                              <label for="kode_area">Kode Area</label>
                              <input type="number" value="{{ $models->kode_area  }}" class="form-control" name="kode_area" id="kode_area" placeholder="Kode Area">
                     </div>
                     <hr>
                     <p>Info Login Update password bila ingin ubah</p>
                    <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" readonly="true" value="{{ $models->email  }}" class="form-control" name="email" id="email" placeholder="Email" required>
                     </div>

                       <div class="form-group">
                              <label for="password">Password</label>
                              <input type="password" value="" class="form-control" name="password"  id="password" placeholder="Password" >
                           </div>

                                              


                     <button type="submit" class="btn btn-sm btn-success">
                        <i class="fa fa-save"></i>   Update
                        </button>
                    
                  </form>
               </div>
            </div>
         </div>
      </div>
 </div>
@endsection
       @section('js')

       @endsection

