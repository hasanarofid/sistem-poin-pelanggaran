@extends('layouts.admin.home')
@section('title', 'Add Admin')
@section('titelcard', 'Add Admin')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Form Add Admin</h5>
                        </div>
                        <div class="card-body ">
                            @if (Session::has('success'))
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
                            <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="name">Nama Admin</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Nama Admin" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kabupaten_id">Wilayah Kabupaten </label>
                                    <select name="kabupaten_id" id="kabupaten_id" class="form-control" required>
                                        <option value="">.: Pilih Wilayah :. </option>
                                        @foreach ($wilayah as $item)
                                            <option value="{{ $item->id }}">{{ $item->kelompok_kabupaten }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="no_telp">No WA</label>
                                    <input type="number" class="form-control" name="no_telp" id="no_telp"
                                        placeholder="No Telp/Wa" required>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat_lengkap">Alamat</label>
                                    <textarea class="form-control" name="alamat_lengkap" id="alamat_lengkap" cols="10" rows="5" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="kota">Kota</label>
                                    <input type="text" class="form-control" name="kota" id="kota"
                                        placeholder="Kota">
                                </div>
                                <div class="mb-3">
                                    <label for="kode_area">Kode Area</label>
                                    <input type="number" class="form-control" name="kode_area" id="kode_area"
                                        placeholder="Kode Area">
                                </div>
                                <hr>
                                <p>Info Login</p>
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="Password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="repeatpassword">Ulangi Password</label>
                                    <input type="password" class="form-control" name="repeatpassword" id="repeatpassword"
                                        placeholder="Ulangi Password" required>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success waves-effect waves-light"><i class="fa fa-save"></i>&nbsp;Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection
