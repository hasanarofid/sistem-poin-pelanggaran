@extends('layouts.admin.home')
@section('title', 'Dashboard')
@section('titelcard', 'Dashboard')
@section('content')
    <div class="content-wrapper" style="margin: 0 !important; padding: 0 !important; width: 100% !important;">
        <div class="container-xxl flex-grow-1 container-p-y" style="padding: 30px !important; width: 100% !important; max-width: none !important; margin: 0 !important;">
            <!-- Page Title -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="mb-0" style="font-size: 28px; font-weight: 700; color: #1f2937;">Dashboard</h1>
            </div>
            
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title mb-1 pt-2">Total Siswa</h5>
                                <div class="badge p-2 rounded bg-primary">
                                    <span class="ti ti-users text-white"></span>
                                </div>
                            </div>
                            <h4 class="mb-0 text-primary">{{$total_siswa}}</h4>
                            <small class="text-muted">Siswa terdaftar</small>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title mb-1 pt-2">Pelanggaran Bulan Ini</h5>
                                <div class="badge p-2 rounded bg-danger">
                                    <span class="ti ti-alert-triangle text-white"></span>
                                </div>
                            </div>
                            <h4 class="mb-0 text-danger">0</h4>
                            <small class="text-muted">Kasus tercatat</small>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title mb-1 pt-2">Siswa Bermasalah</h5>
                                <div class="badge p-2 rounded bg-warning">
                                    <span class="ti ti-user-x text-white"></span>
                                </div>
                            </div>
                            <h4 class="mb-0 text-warning">2</h4>
                            <small class="text-muted">Poin ≥ 20</small>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title mb-1 pt-2">Sanksi Aktif</h5>
                                <div class="badge p-2 rounded bg-secondary">
                                    <span class="ti ti-gavel text-white"></span>
                                </div>
                            </div>
                            <h4 class="mb-0 text-secondary">1</h4>
                            <small class="text-muted">Poin ≥ 30</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Sections -->
            <div class="row mb-4">
                <!-- Statistik Pelanggaran -->
                <div class="col-xl-8 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Statistik Pelanggaran</h5>
                            <small class="text-muted">
                                <i class="ti ti-refresh me-1"></i>
                                Update otomatis
                            </small>
                        </div>
                        <div class="card-body">
                            <div class="text-center py-5">
                                <p class="text-muted">No data available for the chart</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pelanggaran Terbaru -->
                <div class="col-xl-4 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Pelanggaran Terbaru</h5>
                            <small class="text-success">
                                <i class="ti ti-circle-filled me-1" style="font-size: 8px;"></i>
                                Real-time
                            </small>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item border-0 px-0">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1">Ahmad Rizki - XII RPL 1</h6>
                                            <p class="mb-1 text-muted">Terlambat masuk kelas - Wali Kelas XII RPL 1</p>
                                            <small class="text-muted">15/11/2024</small>
                                        </div>
                                        <span class="badge bg-danger">+5</span>
                                    </div>
                                </div>
                                <div class="list-group-item border-0 px-0">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1">Siti Nurhaliza - XI BD 2</h6>
                                            <p class="mb-1 text-muted">Mengganggu teman - Wali Kelas XI BD 2</p>
                                            <small class="text-muted">12/11/2024</small>
                                        </div>
                                        <span class="badge bg-danger">+15</span>
                                    </div>
                                </div>
                                <div class="list-group-item border-0 px-0">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1">Ahmad Rizki - XII RPL 1</h6>
                                            <p class="mb-1 text-muted">Tidak mengerjakan tugas - Wali Kelas XII RPL 1</p>
                                            <small class="text-muted">10/11/2024</small>
                                        </div>
                                        <span class="badge bg-danger">+10</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Cards -->
            <div class="row">
                <div class="col-xl-4 col-md-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Top Pelanggaran</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item border-0 px-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>1 Terlambat masuk kelas</span>
                                        <span class="badge bg-danger">1x</span>
                                    </div>
                                </div>
                                <div class="list-group-item border-0 px-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>2 Mengganggu teman</span>
                                        <span class="badge bg-danger">1x</span>
                                    </div>
                                </div>
                                <div class="list-group-item border-0 px-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>3 Tidak mengerjakan tugas</span>
                                        <span class="badge bg-danger">1x</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-4 col-md-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Kelas Bermasalah</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item border-0 px-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>1 XI BD 2</span>
                                        <span class="badge bg-warning">1 siswa</span>
                                    </div>
                                </div>
                                <div class="list-group-item border-0 px-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>2 XII DPIB 1</span>
                                        <span class="badge bg-warning">1 siswa</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-4 col-md-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Trend Mingguan</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-end" style="height: 120px;">
                                <div class="text-center">
                                    <div class="bg-light" style="width: 20px; height: 0px; margin: 0 auto 5px;"></div>
                                    <small class="text-muted">Rab</small>
                                </div>
                                <div class="text-center">
                                    <div class="bg-light" style="width: 20px; height: 0px; margin: 0 auto 5px;"></div>
                                    <small class="text-muted">Kam</small>
                                </div>
                                <div class="text-center">
                                    <div class="bg-light" style="width: 20px; height: 0px; margin: 0 auto 5px;"></div>
                                    <small class="text-muted">Jum</small>
                                </div>
                                <div class="text-center">
                                    <div class="bg-light" style="width: 20px; height: 0px; margin: 0 auto 5px;"></div>
                                    <small class="text-muted">Sab</small>
                                </div>
                                <div class="text-center">
                                    <div class="bg-light" style="width: 20px; height: 0px; margin: 0 auto 5px;"></div>
                                    <small class="text-muted">Min</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection