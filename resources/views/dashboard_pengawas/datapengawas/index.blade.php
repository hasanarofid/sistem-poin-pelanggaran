@extends('layouts.pengawas.home')
@section('title','Login')
@section('content')

<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Sekolah Binaan </h4> --}}
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
            {{ Session::forget('success') }}
        @endif

        <div class="row">
            <div class="col-12 col-lg-12 ">
                <!-- About User -->
                <div class="card mb-4">
                    <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                        <div class="app-card-header p-3 border-bottom-0">
                            <div class="row align-items-center gx-3">
                                <div class="col-auto">
                                    <h6 class="app-card-title">Data Pengawas </h6>
                                </div>
                            </div>
                        </div>
                        <div class="app-card-body px-4 w-100">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>No Hp</th>
                                            <th>Sekolah Binaan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($groupedBinaan as $group)
                                            @foreach ($group['sekolahs'] as $index => $sekolah)
                                                <tr class="{{ $index === 0 ? 'group-start' : '' }}">
                                                    @if ($index === 0)
                                                        <td rowspan="{{ count($group['sekolahs']) }}">{{ $no++ }}</td>
                                                        <td rowspan="{{ count($group['sekolahs']) }}">{{ $group['pengawas']->name }}</td>
                                                        <td rowspan="{{ count($group['sekolahs']) }}">{{ $group['pengawas']->profile->no_telp }}</td>
                                                    @endif
                                                    <td>{{ $sekolah->nama_sekolah }}</td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>
                                
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <!--/ About User -->

                <!--/ Profile Overview -->
            </div>
        </div>



        <div class="content-backdrop fade"></div>
    </div>
</div>

<!-- JavaScript DataTables -->
@endsection
