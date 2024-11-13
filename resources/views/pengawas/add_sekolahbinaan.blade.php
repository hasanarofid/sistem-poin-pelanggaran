@extends('layouts.admin.home')
@section('title', 'Set Sekolah Binaan')
@section('titelcard', 'Set Sekolah Binaan')

@section ('content')
<style>
    .select2-selection__choice{
        background-color: #7367f0 !important;
        color: #fff !important;
    }
</style>
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
          <div class="col-12">
              <div class="card mb-4">
                  <div class="card-header pb-0 p-3">
                      <div class="row">
                          <div class="col-6 d-flex align-items-center">
                              <h6 class="mb-0">Set Sekolah Binaan  (Total : {{ $total_binaan }} ) </h6>
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
                                                <form  action="{{ route('masterpengawas.store_sekolah') }}"
                        method="POST"
                        enctype="multipart/form-data">
                     @csrf
                     <input type="hidden" name="id_pengawas" id="id_pengawas" value="{{ $models->id }}">
              
                     
                     <div class="form-group">
                        <label for="kabupaten_id">Sekolah </label>
                        
                        <select name="sekolah_id[]" id="sekolah_id" class="form-select select2" required multiple>
                            @php
                                $allSelected = true;
                            @endphp
                            @foreach ($sekolah as $item)
                                @php
                                    $selected = $binaan->contains('sekolah.id', $item->id) ? 'selected' : '';
                                    if (!$selected) {
                                        // If any item is not selected, set allSelected to false
                                        $allSelected = false;
                                    }
                                @endphp
                                <option   value="{{ $item->id }}" {{ $selected }}>{{ $item->nama_sekolah }}</option>
                            @endforeach
                            @if ($allSelected)
                                <option  value="" disabled hidden>All selected</option>
                            @endif
                        </select>
                        
                        
                     </div>
                    


                     <button type="submit" class="btn btn-sm btn-success">
                        <i class="fa fa-save"></i>   Save
                        </button>
                    
                  </form>
               </div>
            </div>
         </div>
      </div>
 </div>
</div>
@endsection
       @section('script')
       <script>
           $(document).ready(function () {
      $('#sekolah_id').select2();
   });
       </script>
 
       @endsection


