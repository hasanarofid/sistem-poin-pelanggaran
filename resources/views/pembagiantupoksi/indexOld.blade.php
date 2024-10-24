@extends('layouts.master')
@section('subjudul', 'Super Admin ')
@section('title', 'Pembagian Tupoksi')
@section('breadcrumbs')
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">list Pembagian Tupoksi</a></li>
    <style>
        #data-table_info {
            font-size: 12px;
        }

        #data-table_paginate {
            font-size: 12px;
        }

        #data-table tbody tr {
            font-size: 12px;
            /* Adjust the font size to your desired value */
        }
    </style>
@endsection
@section('content')


    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Tabel Pembagian Tupoksi </h6>
                            </div>
                            <div class="col-6 d-flex justify-content-end">


                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a class="btn btn-sm bg-primary text-white " href="{{ route('mastertupoksi.add') }}"><i
                                            class="fas fa-plus" aria-hidden="true"></i> Add </a>
                                    {{-- <a  class="btn btn-sm bg-info text-white" href="{{  route('pengawas.import')  }}" >  <i class="fa fa-file-excel-o" aria-hidden="true"></i> Import</a>
                      <a class="btn btn-sm  bg-success text-white " target="_blank" href="{{  route('pengawas.excelcontoh')  }}"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Contoh</a> --}}
                                </div>





                            </div>
                        </div>
                    </div>
                    <div class="card-body ">
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                            {{ Session::forget('success') }}
                        @endif
                        <div class="table-responsive p-0">
                            <table id="myTable" class="display">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Deskripsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Induk 1</td>
                                        <td>Deskripsi Induk 1</td>
                                    </tr>
                                    <tr class="child">
                                        <td>Anak 1</td>
                                        <td>Deskripsi Anak 1</td>
                                    </tr>
                                    <tr>
                                        <td>Induk 2</td>
                                        <td>Deskripsi Induk 2</td>
                                    </tr>
                                    <tr class="child">
                                        <td>Anak 2</td>
                                        <td>Deskripsi Anak 2</td>
                                    </tr>
                                    <!-- Dan seterusnya -->
                                </tbody>
                            </table>


                            <table class=" align-items-center mb-0 table-primary table-hover table-bordered"
                                id="data-table">
                                <thead>
                                    <tr>
                                        <th class="text-sm font-weight mb-1 ">No</th>
                                        <th class="text-sm font-weight mb-1 ">Tahun Ajaran</th>
                                        <th class="text-sm font-weight mb-1 ">Semester</th>

                                        <th class="text-sm font-weight mb-1 ">Kegiatan</th>
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
    <script>
        // resources/js/app.js

        jQuery(document).ready(function() {
            jQuery('#myModal').on('show.bs.modal', function(event) {
                // Additional actions to perform when the modal is shown
                alert(1);
            });
        });

        jQuery(function() {


            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            //   alert(3);
            var table = jQuery('#data-table').DataTable({

                processing: true,
                serverSide: true,
                ajax: "{{ route('mastertupoksi.getdata') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'tahun_ajaran',
                        name: 'tahun_ajaran'
                    },
                    {
                        data: 'semester',
                        name: 'semester'
                    },

                    {
                        data: 'kegiatan',
                        name: 'kegiatan'
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endsection
