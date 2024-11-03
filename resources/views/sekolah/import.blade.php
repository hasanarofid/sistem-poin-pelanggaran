@extends('layouts.admin.home')
@section('title', 'Import  Sekolah')
@section('titelcard', 'Import  Sekolah')
@section('content')
<div class="content-wrapper">
   <div class="container-xxl flex-grow-1 container-p-y">
       <div class="row">
           <div class="col-12">
               <div class="card mb-4">
                   <div class="card-header pb-0 p-3">
                       <div class="row">
                           <div class="col-6 d-flex align-items-center">
                               <h6 class="mb-0">Import  Sekolah</h6>
                           </div>
                       </div>
                   </div>
                   <div class="card-body">
                       <!-- Display Success Message -->
                       @if (Session::has('success'))
                           <div class="alert alert-success">
                               {{ Session::get('success') }}
                           </div>
                       @endif

                       <!-- Display Errors -->
                       @if (Session::has('errors'))
                           <div class="alert alert-danger">
                               <ul>
                                   @foreach (Session::get('errors') as $error)
                                   {{ dd($error) }}
                                       <li>{{ $error }}</li>
                                   @endforeach
                               </ul>
                           </div>
                       @endif

                       <form action="{{ route('sekolah.importfile') }}" method="POST" enctype="multipart/form-data">
                           @csrf
                           <input type="file" name="file" class="form-control">
                           <br>
                           <button type="submit" class="btn btn-sm btn-success">
                               <i class="fa fa-file-excel-o"></i> Import
                           </button>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
@section('js')
@endsection


