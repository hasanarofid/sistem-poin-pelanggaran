@extends('layouts.master')

@php
    $kelompok_kabupaten = App\Kabupaten::find(Auth::user()->kabupaten_id)->kelompok_kabupaten;
@endphp
@section('subjudul','Admin '.$kelompok_kabupaten)
@section('title','stakeholder')
@section('breadcrumbs')
<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">list stakeholder</a></li>
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
                      <h6 class="mb-0">Tabel stakeholder </h6>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
     

                  <div class="btn-group" role="group" aria-label="Basic example">
                      <a  class="btn btn-sm bg-primary text-white " href="{{  route('stakeholder.add')  }}"><i class="fas fa-plus" aria-hidden="true"></i> Add </a>
                      <a  class="btn btn-sm bg-info text-white" href="{{  route('stakeholder.import')  }}" >  <i class="fa fa-file-excel-o" aria-hidden="true"></i> Import</a>
                      <a class="btn btn-sm  bg-success text-white " target="_blank" href="{{  route('stakeholder.excelcontoh')  }}"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Contoh</a>
                   </div>
                   


                    

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
              <div class="table-responsive p-0">
                <table class=" align-items-center mb-0 table-primary table-hover table-bordered" id="data-table">
                  <thead>
                    <tr>
                      <th class="text-sm font-weight mb-1 ">No</th>
                      <th class="text-sm font-weight mb-1 ">Foto Profile</th>
                      <th class="text-sm font-weight mb-1 ">Kabupten</th>

                      <th class="text-sm font-weight mb-1 ">Nama</th>
                      <th class="text-sm font-weight mb-1 ">Email</th>

                      <th class="text-sm font-weight mb-1">No Whatsapp</th>
                      <th class="text-sm font-weight mb-1">Alamat</th>
                      <th class="text-sm font-weight mb-1">Action</th>

                    </tr>
                  </thead>
                  <tbody>
           
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
 </div>
@endsection
       @section('js')
       <script >
 // resources/js/app.js

jQuery(document).ready(function () {
  jQuery('#myModal').on('show.bs.modal', function (event) {
    // Additional actions to perform when the modal is shown
    alert(1);
  });
});

   jQuery(function () {
    
    
       jQuery.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
          }
    });
   //   alert(3);
    var table = jQuery('#data-table').DataTable({
     
        processing: true,
        serverSide: true,
        ajax: "{{ route('stakeholder.getdata') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'foto', name: 'foto'},
            {data: 'kabupaten', name: 'kabupaten'},

            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},

            {data: 'no_telp', name: 'no_telp'},
            {data: 'alamat', name: 'alamat'},

            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });
  </script>
       @endsection

