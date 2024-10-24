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
                                <h5 class="card-title mb-1 pt-2">Total Guru</h5>
                                <div class="badge p-2 rounded">
                                    <button type="button" class="btn btn-icon btn-info waves-effect waves-light">
                                        <span class="ti ti-user"></span>
                                    </button>
                                </div>
                            </div>
                            <h4 class="mb-0">{{ $total_guru }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-4 col-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title mb-1 pt-2">Total Pengawas</h5>
                                <div class="badge p-2 rounded">
                                    <button type="button" class="btn btn-icon btn-danger waves-effect waves-light">
                                        <span class="ti ti-eye"></span>
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
                                <h5 class="card-title mb-1 pt-2">Total Stackholder</h5>
                                <div class="badge p-2 rounded">
                                    <button type="button" class="btn btn-icon btn-primary waves-effect waves-light">
                                        <span class="ti ti-briefcase"></span>
                                    </button>
                                </div>
                            </div>
                            <h4 class="mb-0">{{ $total_stockholder }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Tupoksi Tahun 2023</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 table-primary table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th rowspan="3">No</th>
                                        <th rowspan="3">Kegiatan</th>
                                        <th colspan="12" style="text-align: center">Waktu Pelaksanaan</th>
                                    </tr>
                                    <tr>
                                        <th colspan="12" style="text-align: center"> Bulan</th>
                                    </tr>
                                    <tr>
                                        <!-- Enam kolom untuk Jan -->
                                        <th style="text-align: center">Jan</th>
                                        <th style="text-align: center">Feb</th>
                                        <th style="text-align: center">Mar</th>
                                        <th style="text-align: center">Apr</th>
                                        <th style="text-align: center">Mei</th>
                                        <th style="text-align: center">Jun</th>
                                        <th style="text-align: center">Jul</th>
                                        <th style="text-align: center">Ags</th>
                                        <th style="text-align: center">Sept</th>
                                        <th style="text-align: center">Okt</th>
                                        <th style="text-align: center">Nov</th>
                                        <th style="text-align: center">Des</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($master as $item)
                                        <tr>
                                            <td>{{ empty($item->id_kegiatan) ? $no++ : '' }}</td>
                                            <td class="{{ empty($item->id_kegiatan) ? 'bg-success' : '' }} ">
                                                {{ $item->kegiatan }}</td>
                                            @if (strpos($item->bulan, ',') !== false)
                                                @php
                                                    $parts = explode(',', $item->bulan);
                                                    if ($parts[0] == 'Jan' || $parts[1] == 'Jan') {
                                                        echo '<td class="bg-warning"></td>';
                                                    } else {
                                                        echo '<td></td>';
                                                    }
                                                @endphp
                                            @else
                                                @if ($item->bulan == 'Jan')
                                                    <td class="bg-warning"></td>
                                                @else
                                                    <td></td>
                                                @endif
                                            @endif
    
                                            @if (strpos($item->bulan, ',') !== false)
                                                @php
                                                    $parts = explode(',', $item->bulan);
                                                    if ($parts[0] == 'Feb' || $parts[1] == 'Feb') {
                                                        echo '<td class="bg-warning"></td>';
                                                    } else {
                                                        echo '<td></td>';
                                                    }
                                                @endphp
                                            @else
                                                @if ($item->bulan == 'Feb')
                                                    <td class="bg-warning"></td>
                                                @else
                                                    <td></td>
                                                @endif
                                            @endif
    
                                            @if (strpos($item->bulan, ',') !== false)
                                                @php
                                                    $parts = explode(',', $item->bulan);
                                                    if ($parts[0] == 'Mar' || $parts[1] == 'Mar') {
                                                        echo '<td class="bg-warning"></td>';
                                                    } else {
                                                        echo '<td></td>';
                                                    }
                                                @endphp
                                            @else
                                                @if ($item->bulan == 'Mar')
                                                    <td class="bg-warning"></td>
                                                @else
                                                    <td></td>
                                                @endif
                                            @endif
    
                                            @if (strpos($item->bulan, ',') !== false)
                                                @php
                                                    $parts = explode(',', $item->bulan);
                                                    if ($parts[0] == 'Apr' || $parts[1] == 'Apr') {
                                                        echo '<td class="bg-warning"></td>';
                                                    } else {
                                                        echo '<td></td>';
                                                    }
                                                @endphp
                                            @else
                                                @if ($item->bulan == 'Apr')
                                                    <td class="bg-warning"></td>
                                                @else
                                                    <td></td>
                                                @endif
                                            @endif
    
                                            @if (strpos($item->bulan, ',') !== false)
                                                @php
                                                    $parts = explode(',', $item->bulan);
                                                    if ($parts[0] == 'Mei' || $parts[1] == 'Mei') {
                                                        echo '<td class="bg-warning"></td>';
                                                    } else {
                                                        echo '<td></td>';
                                                    }
                                                @endphp
                                            @else
                                                @if ($item->bulan == 'Mei')
                                                    <td class="bg-warning"></td>
                                                @else
                                                    <td></td>
                                                @endif
                                            @endif
    
                                            @if (strpos($item->bulan, ',') !== false)
                                                @php
                                                    $parts = explode(',', $item->bulan);
                                                    if ($parts[0] == 'Jun' || $parts[1] == 'Jun') {
                                                        echo '<td class="bg-warning"></td>';
                                                    } else {
                                                        echo '<td></td>';
                                                    }
                                                @endphp
                                            @else
                                                @if ($item->bulan == 'Jun')
                                                    <td class="bg-warning"></td>
                                                @else
                                                    <td></td>
                                                @endif
                                            @endif
    
                                            @if (strpos($item->bulan, ',') !== false)
                                                @php
                                                    $parts = explode(',', $item->bulan);
                                                    if ($parts[0] == 'Jul' || $parts[1] == 'Jul') {
                                                        echo '<td class="bg-warning"></td>';
                                                    } else {
                                                        echo '<td></td>';
                                                    }
                                                @endphp
                                            @else
                                                @if ($item->bulan == 'Jul')
                                                    <td class="bg-warning"></td>
                                                @else
                                                    <td></td>
                                                @endif
                                            @endif
    
    
                                            @if (strpos($item->bulan, ',') !== false)
                                                @php
                                                    $parts = explode(',', $item->bulan);
                                                    if ($parts[0] == 'Ags' || $parts[1] == 'Ags') {
                                                        echo '<td class="bg-warning"></td>';
                                                    } else {
                                                        echo '<td></td>';
                                                    }
                                                @endphp
                                            @else
                                                @if ($item->bulan == 'Ags')
                                                    <td class="bg-warning"></td>
                                                @else
                                                    <td></td>
                                                @endif
                                            @endif
    
                                            @if (strpos($item->bulan, ',') !== false)
                                                @php
                                                    $parts = explode(',', $item->bulan);
                                                    if ($parts[0] == 'Sept' || $parts[1] == 'Sept') {
                                                        echo '<td class="bg-warning"></td>';
                                                    } else {
                                                        echo '<td></td>';
                                                    }
                                                @endphp
                                            @else
                                                @if ($item->bulan == 'Sept')
                                                    <td class="bg-warning"></td>
                                                @else
                                                    <td></td>
                                                @endif
                                            @endif
    
                                            @if (strpos($item->bulan, ',') !== false)
                                                @php
                                                    $parts = explode(',', $item->bulan);
                                                    if ($parts[0] == 'Okt' || $parts[1] == 'Okt') {
                                                        echo '<td class="bg-warning"></td>';
                                                    } else {
                                                        echo '<td></td>';
                                                    }
                                                @endphp
                                            @else
                                                @if ($item->bulan == 'Okt')
                                                    <td class="bg-warning"></td>
                                                @else
                                                    <td></td>
                                                @endif
                                            @endif
    
                                            @if (strpos($item->bulan, ',') !== false)
                                                @php
                                                    $parts = explode(',', $item->bulan);
                                                    if ($parts[0] == 'Nov' || $parts[1] == 'Nov') {
                                                        echo '<td class="bg-warning"></td>';
                                                    } else {
                                                        echo '<td></td>';
                                                    }
                                                @endphp
                                            @else
                                                @if ($item->bulan == 'Nov')
                                                    <td class="bg-warning"></td>
                                                @else
                                                    <td></td>
                                                @endif
                                            @endif
    
                                            @if (strpos($item->bulan, ',') !== false)
                                                @php
                                                    $parts = explode(',', $item->bulan);
                                                    if ($parts[0] == 'Des' || $parts[1] == 'Des') {
                                                        echo '<td class="bg-warning"></td>';
                                                    } else {
                                                        echo '<td></td>';
                                                    }
                                                @endphp
                                            @else
                                                @if ($item->bulan == 'Des')
                                                    <td class="bg-warning"></td>
                                                @else
                                                    <td></td>
                                                @endif
                                            @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
