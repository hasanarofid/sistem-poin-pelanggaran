@extends('layouts.master')
@section('title','Pengawas')
@section('subjudul','add Pengawas')
@section('breadcrumbs')
<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">add Pengawas</a></li>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css">

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
                        <h6 class="mb-0">Form Add Pengawas </h6>
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

                     <form action="{{ route('masterpengawas.store_sekolah') }}"
                        method="POST"
                        enctype="multipart/form-data">
                     @csrf
                     <input type="hidden" name="id_pengawas" id="id_pengawas" value="{{ $models->id }}">
              
                     
                     <div class="form-group">
                        <label for="kabupaten_id">Sekolah </label>
                        <select name="sekolah_id[]" id="sekolah_id" class="form-control select2" required multiple>
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
                                <option value="{{ $item->id }}" {{ $selected }}>{{ $item->nama_sekolah }}</option>
                            @endforeach
                            @if ($allSelected)
                                <option value="" disabled hidden>All selected</option>
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
@endsection
    @section('js')
       <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>

         <script>
           jQuery(document).ready(function () {
    // Initialize Select2 for the 'select2' class elements
    jQuery('.select2').select2();

  
});
   
         </script>
       @endsection


