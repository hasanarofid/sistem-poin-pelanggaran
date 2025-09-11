@extends('layouts.admin.home')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header text-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Detail Data Siswa</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.siswa.index') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left"></i> &nbsp; Kembali
                        </a>
                        <a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> &nbsp; Edit
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <table class="table table-striped">
                                <tr>
                                    <th width="40%"><b>NIS</b></th>
                                    <td>{{ $siswa->nis }}</td>
                                </tr>
                                <tr>
                                    <th><b>Nama Lengkap</b></th>
                                    <td>{{ $siswa->nama }}</td>
                                </tr>
                                <tr>
                                    <th><b>Kelas</b></th>
                                    <td>{{ $siswa->nama_kelas_lengkap }}</td>
                                </tr>
                                <tr>
                                    <th><b>Tahun Ajaran</b></th>
                                    <td>{{ $siswa->tahunAjaran->tahun_ajaran ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th><b>Jenis Kelamin</b></th>
                                    <td>{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                </tr>
                                <tr>
                                    <th><b>HP Orang Tua</b></th>
                                    <td>{{ $siswa->hp_orang_tua ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6 mb-3">
                            <table class="table table-striped">
                                <tr>
                                    <th width="40%"><b>Tempat Lahir</b></th>
                                    <td>{{ $siswa->tempat_lahir }}</td>
                                </tr>
                                <tr>
                                    <th><b>Tanggal Lahir</b></th>
                                    <td>{{ $siswa->tanggal_lahir->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <th><b>RFID</b></th>
                                    <td>{{ $siswa->rfid ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th><b>Finger</b></th>
                                    <td>{{ $siswa->finger ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th><b>Status</b></th>
                                    <td>
                                        <span class="badge" style="background-color: {{ $siswa->status ? '#dcfce7' : '#fee2e2' }}; color: {{ $siswa->status ? '#166534' : '#dc2626' }}; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500;">
                                            {{ $siswa->status ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><b>Dibuat</b></th>
                                    <td>{{ $siswa->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5 class="mb-3">Alamat</h5>
                            <p class="border p-3 ">{{ $siswa->alamat }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
