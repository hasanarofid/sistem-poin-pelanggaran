@extends('layouts.admin.home')
@section('title', 'Edit  Kepala Sekolah')
@section('titelcard', 'Edit  Kepala Sekolah')

@section ('content')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
          <div class="col-12">
              <div class="card mb-4">
                  <div class="card-header pb-0 p-3">
                      <div class="row">
                          <div class="col-6 d-flex align-items-center">
                              <h6 class="mb-0">Edit Kepala  Sekolah</h6>
                          </div>
                     
                      </div>
                  </div>
                  <div class="card-body">
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


                     <form action="{{ route('guru.update',array('id'=>$models->id)) }}"
                        method="POST"
                        enctype="multipart/form-data">
                     @csrf
                     <div class="form-group">
                        <label for="name">Nama Sekolah</label>
                        <select
                        id="sekolah_id"
                        name="sekolah_id"
                        class="select2 form-select"
                        required
                    >
                        <option value="">.: Pilih Sekolah:. </option>
                        @foreach ($listsekolah as $sekolah)
                            <option value="{{ $sekolah->id }}" 
                                {{ ($models->sekolah_id == $sekolah->id) ? 'selected' : '' }}>
                                {{ $sekolah->nama_sekolah }}
                            </option>
                        @endforeach
                    </select>
                        
               </div>

                     <div class="form-group">
                        <label for="name">Nama </label>
                        <input type="text" class="form-control" name="nama" id="nama" value="{{ $models->nama }}" placeholder="Nama Guru" required>
                     </div>
                     <div class="form-group">
                        <label for="name">Jabatan </label>
                        <select name="jabatan" id="jabatan" class="form-control" required>
                           <option value="">.: Pilih Jabatan:. </option>
                           <option value="Kepala Sekolah" {{ ($models->jabatan == 'Kepala Sekolah') ? 'selected' : ''  }}> Kepala Sekolah </option>
                        
                        </select>
                     </div>
                     
                 
                       <div class="form-group">
                              <label for="no_telp">No Telpon</label>
                              <input type="number" class="form-control" name="no_telp" id="no_telp" value="{{ $models->no_telp }}" placeholder="No Telp/Wa" required> 
                     </div>
                         <div class="form-group">
                              <label for="alamat_lengkap">Alamat</label>
                              <textarea class="form-control" name="alamat_lengkap" id="alamat_lengkap" cols="10" rows="5" required>{{ $models->alamat_lengkap }}</textarea>
                     </div>
                      <div class="form-group">
                              <label for="kota">Kota</label>
                              <input type="text" class="form-control" name="kota" id="kota" placeholder="Kota" value="{{ $models->kota }}">
                     </div>
                     <div class="form-group">
                              <label for="kode_area">Kode Area</label>
                              <input type="number" class="form-control" name="kode_area" id="kode_area" placeholder="Kode Area" value="{{ $models->kode_area }}">
                     </div>
                     <hr>
                     
                     <button type="submit" class="btn btn-sm btn-success">
                        <i class="fa fa-save"></i>   Save
                        </button>
                    
                  </form>
               </div>
            </div>
         </div>
      </div>
 </div>
@endsection
@section('script')
<script>
  $(document).ready(function () {
        // Initialize Select2 after the DOM is ready and options are populated
        $('#sekolah_id').select2();

        // Optionally trigger change event if needed
        $('#sekolah_id').trigger('change');
    });
</script>

@endsection

