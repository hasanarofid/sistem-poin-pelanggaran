@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Import Data Siswa</h3>
                    <div class="card-tools">
                        <a href="{{ route('siswa.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="alert alert-info">
                        <h5><i class="icon fas fa-info"></i> Petunjuk Import Data Siswa</h5>
                        <ul>
                            <li>File harus berformat Excel (.xlsx, .xls) atau CSV</li>
                            <li>Baris pertama harus berisi header kolom</li>
                            <li>Kolom yang diperlukan: NIS, Nama, Kelas, Subkelas, HP Orang Tua, Jenis Kelamin, Tempat Lahir, Tanggal Lahir, Alamat, Tahun Ajaran, RFID, Finger</li>
                            <li>Format Jenis Kelamin: L (Laki-laki) atau P (Perempuan)</li>
                            <li>Format Tanggal Lahir: YYYY-MM-DD (contoh: 2010-06-08)</li>
                            <li>Jika kelas atau tahun ajaran belum ada, akan dibuat otomatis</li>
                        </ul>
                    </div>

                    <form action="{{ route('siswa.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">Pilih File Excel/CSV <span class="text-danger">*</span></label>
                            <input type="file" class="form-control-file @error('file') is-invalid @enderror" 
                                   id="file" name="file" accept=".xlsx,.xls,.csv" required>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-upload"></i> Import Data
                            </button>
                            <a href="{{ route('siswa.template.download') }}" class="btn btn-success">
                                <i class="fas fa-download"></i> Download Template
                            </a>
                            <a href="{{ route('siswa.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>

                    <div class="mt-4">
                        <h5>Contoh Format File Excel:</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead class="thead-light">
                                    <tr>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Subkelas</th>
                                        <th>HP Orang Tua</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Alamat</th>
                                        <th>Tahun Ajaran</th>
                                        <th>RFID</th>
                                        <th>Finger</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>10106808116</td>
                                        <td>MUHAMMAD RAFKA</td>
                                        <td>Kelas X</td>
                                        <td>X DPIB 1</td>
                                        <td>085365661103</td>
                                        <td>L</td>
                                        <td>Padang</td>
                                        <td>2010-06-08</td>
                                        <td>JJ H. Marsaim Kp. Cijantr</td>
                                        <td>2025/2026</td>
                                        <td>B7867A05</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
