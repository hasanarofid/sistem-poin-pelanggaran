@extends('layouts.master')
@section('title','Sekolah')
@section('subjudul','import Sekolah')
@section('breadcrumbs')
<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">import Sekolah</a></li>
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
 <div class="container-fluid py-4">
       <div class="row">
         <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0 p-3">
                     <div class="row">
                     <div class="col-6 d-flex align-items-center">
                        <h6 class="mb-0">Import Sekolah </h6>
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
  @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

                     <form action="{{ route('sekolah.importfile') }}"
                        method="POST"
                        enctype="multipart/form-data">
                     @csrf
                     <input type="file" name="file"
                              class="form-control">
                     <br>
                   <button type="submit" class="btn btn-sm btn-success">
                        <i class="fa fa-file-excel-o"></i>   Import
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

