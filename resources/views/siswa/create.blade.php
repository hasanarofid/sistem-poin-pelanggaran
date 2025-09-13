@extends('layouts.admin.home')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Data Siswa</h3>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ request()->routeIs('admin.*') ? route('admin.siswa.store') : route('guru.siswa.store') }}"
                            method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nis">NIS <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('nis') is-invalid @enderror"
                                            id="nis" name="nis" value="{{ old('nis') }}" required>
                                        @error('nis')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            id="nama" name="nama" value="{{ old('nama') }}" required>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kelas_id">Kelas <span class="text-danger">*</span></label>
                                        <select id="kelas_id" class="form-select select2" name="kelas_id">
                                            <option value="" {{ request('kelas') == '' ? 'selected' : '' }}>-- Pilih
                                                Kelas --</option>
                                        </select>
                                        @error('kelas')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tahun_ajaran_id">Tahun Ajaran <span class="text-danger">*</span></label>
                                        <select class="form-control @error('tahun_ajaran_id') is-invalid @enderror"
                                            id="tahun_ajaran_id" name="tahun_ajaran_id" required>
                                            <option value="">Pilih Tahun Ajaran</option>
                                            @foreach ($tahunAjaran as $ta)
                                                <option value="{{ $ta->id }}"
                                                    {{ old('tahun_ajaran_id') == $ta->id ? 'selected' : '' }}>
                                                    {{ $ta->tahun_ajaran }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('tahun_ajaran_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hp_orang_tua">HP Orang Tua</label>
                                        <input type="text"
                                            class="form-control @error('hp_orang_tua') is-invalid @enderror"
                                            id="hp_orang_tua" name="hp_orang_tua" value="{{ old('hp_orang_tua') }}">
                                        @error('hp_orang_tua')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                                        <select class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                            id="jenis_kelamin" name="jenis_kelamin" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>
                                                Laki-laki</option>
                                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tempat_lahir">Tempat Lahir <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('tempat_lahir') is-invalid @enderror"
                                            id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                                            required>
                                        @error('tempat_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                                        <input type="date"
                                            class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                            id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                                            required>
                                        @error('tanggal_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="rfid">RFID</label>
                                        <input type="text" class="form-control @error('rfid') is-invalid @enderror"
                                            id="rfid" name="rfid" value="{{ old('rfid') }}">
                                        @error('rfid')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="finger">Finger</label>
                                        <input type="text" class="form-control @error('finger') is-invalid @enderror"
                                            id="finger" name="finger" value="{{ old('finger') }}">
                                        @error('finger')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3"
                                    required>{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> &nbsp; Simpan
                                </button>
                                <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> &nbsp; Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var kelas = $('#kelas_id');
        var selectedKelasId = "{{ request('kelas_id') }}";

        // Jika ada kelas yang dipilih, load data kelas tersebut
        if (selectedKelasId && selectedKelasId !== '') {
            $.ajax({
                url: "{{ route('laporan.setkelas') }}",
                dataType: 'json',
                type: "GET",
                data: {
                    id: selectedKelasId
                },
                success: function(data) {
                    if (data.length > 0) {
                        var option = new Option(data[0].nama_kelas + ' (' + data[0].subkelas + ')',
                            data[0].id, true, true);
                        kelas.append(option).trigger('change');
                    }
                }
            });
        }

        kelas.select2({
            ajax: {
                url: "{{ route('laporan.setkelas') }}",
                dataType: 'json',
                delay: 250,
                type: "GET",
                data: function(params) {
                    return {
                        term: params.term,
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.nama_kelas + ' (' + item.subkelas + ')',
                                id: item.id,
                            };
                        })
                    };
                },
                cache: true
            },
        });
    </script>
@endsection
