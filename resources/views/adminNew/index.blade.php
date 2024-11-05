@extends('layouts.admin.home')
@section('title', 'Dashboard')
@section('titelcard', 'Dashboard')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-xl-3 col-md-4 col-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title mb-1 pt-2">Total Sekolah</h5>
                                <div class="badge p-2 rounded">
                                    <button type="button" class="btn btn-icon btn-success waves-effect waves-light">
                                        <span class="ti ti-school"></span>
                                    </button>
                                </div>
                            </div>
                            <h4 class="mb-0">{{ $total_sekolah }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-4 col-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title mb-1 pt-2">Total Pengawas</h5>
                                <div class="badge p-2 rounded">
                                    <button type="button" class="btn btn-icon btn-info waves-effect waves-light">
                                        <span class="ti ti-user"></span>
                                    </button>
                                </div>
                            </div>
                            <h4 class="mb-0">{{ $total_pengawas }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-4 col-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title mb-1 pt-2">Total Rencana Kerja</h5>
                                <div class="badge p-2 rounded">
                                    <button type="button" class="btn btn-icon btn-danger waves-effect waves-light">
                                        <span class="ti ti-eye"></span>
                                    </button>
                                </div>
                            </div>
                            <h4 class="mb-0">{{ $total_rencankerja }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-4 col-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title mb-1 pt-2">Total Umpan Balik</h5>
                                <div class="badge p-2 rounded">
                                    <button type="button" class="btn btn-icon btn-primary waves-effect waves-light">
                                        <span class="ti ti-briefcase"></span>
                                    </button>
                                </div>
                            </div>
                            <h4 class="mb-0">{{ $total_umpanbalik }}</h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
