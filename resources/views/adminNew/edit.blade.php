@extends('layouts.admin.home')
@section('title', 'Edit Admin')
@section('titelcard', 'Edit Admin')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Form Edit Admin</h5>
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
                            <form action="{{ route('admin.update', ['id' => $model->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="name">Nama Admin</label>
                                    <input type="text" value="{{ $model->name }}" class="form-control" name="name"
                                        id="name" placeholder="Nama Admin" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kabupaten_id">Wilayah Kabupaten </label>
                                    <select name="kabupaten_id" id="kabupaten_id" class="form-control" required>
                                        <option value="">.: Pilih Wilayah :. </option>
                                        @foreach ($wilayah as $item)
                                            <option {{ $model->kabupaten_id == $item->id ? 'selected' : '' }}
                                                value="{{ $item->id }}">{{ $item->kelompok_kabupaten }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="no_telp">No WA</label>
                                    <input type="number" value="{{ $model->no_telp }}" class="form-control" name="no_telp"
                                        id="no_telp" placeholder="No Telp/Wa" required>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat_lengkap">Alamat</label>
                                    <textarea class="form-control" name="alamat_lengkap" id="" cols="10" rows="5" required>{{ $model->alamat_lengkap }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="kota">Kota</label>
                                    <input type="text" class="form-control" value="{{ $model->kota }}" name="kota"
                                        id="kota" placeholder="Kota">
                                </div>
                                <div class="mb-3">
                                    <label for="kode_area">Kode Area</label>
                                    <input type="number" class="form-control" name="kode_area"
                                        value="{{ $model->kode_area }}" id="kode_area" placeholder="Kode Area">
                                </div>
                                <hr>
                                <p>Info Login</p>
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Email" value="{{ $model->email }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" value="" name="password"
                                        id="password" placeholder="Password">
                                </div>
                                <div class="mb-3">
                                    <label for="repeatpassword">Ulangi Password</label>
                                    <input type="password" class="form-control" value="" name="repeatpassword"
                                        id="repeatpassword" placeholder="Ulangi Password">
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
