@extends('layouts.admin.home')

@section('title', 'Profile Siswa')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                {!! session('success') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                {!! session('error') !!}
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <h4 class="fw-bold" style="color: #1f2937; font-size: 1.5rem; margin-bottom: 20px;">
                    Profil & Riwayat Pelanggaran
                </h4>
                <div class="row">
                    <!-- Informasi Siswa -->
                    <div class="col-md-5">
                        <div class="card" style="border: 1px solid #e5e7eb; border-radius: 8px; height: 100%;">
                            <div class="card-header" style="background: #fff; border-bottom: 1px solid #e5e7eb;">
                                <h5 class="card-title" style="font-weight: 600; color: #374151; margin: 0;">
                                    Informasi Siswa
                                </h5>
                            </div>
                            <div class="card-body" style="margin-top: 25px;">
                                <p style="margin: 0; color: #6b7280;">NISN</p>
                                <p style="font-weight: 600; color: #374151;">{{ $model->nis }}</p>
                                <p style="margin: 0; color: #6b7280;">Nama</p>
                                <p style="font-weight: 600; color: #374151;">{{ $model->nama }}</p>
                                <p style="margin: 0; color: #6b7280;">Kelas</p>
                                <p style="font-weight: 600; color: #374151;">{{ $kelas->nama_kelas }} -
                                    {{ $kelas->subkelas }}</p>
                                <p style="margin: 0; color: #6b7280;">Jenis Kelamin</p>
                                <p style="font-weight: 600; color: #374151;">
                                    {{ $model->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                                <p style="margin: 0; color: #6b7280;">Total Poin Pelanggaran</p>
                                <p style="font-weight: 600; color: #dc2626;">{{ $point->total_poin }}</p>
                                <!-- Button Ubah Password -->
                                <button type="button" class="btn btn-warning mt-3" data-bs-toggle="modal"
                                    data-bs-target="#ubahPasswordModal">
                                    Ubah Password
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Riwayat Pelanggaran -->
                    <div class="col-md-7">
                        <div class="card" style="border: 1px solid #e5e7eb; border-radius: 8px; height: 100%;">
                            <div class="card-header" style="background: #fff; border-bottom: 1px solid #e5e7eb;">
                                <h5 class="card-title" style="font-weight: 600; color: #374151; margin: 0;">
                                    Riwayat Pelanggaran
                                </h5>
                            </div>
                            <div class="card-body" style="max-height: 400px; overflow-y: auto; margin-top: 25px;">
                                <!-- Item pelanggaran -->
                                @foreach ($riwayatPoin as $item)
                                <div class="d-flex mb-4"
                                    style="position: relative; border-left: 4px solid {{ $item->poin_perubahan < 0 ? '#dc2626' : '#059669' }}; padding-left: 15px;">
                                    <div style="flex: 1;">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div style="flex: 1;">
                                                <p style="font-weight: 600; color: {{ $item->poin_perubahan < 0 ? '#dc2626' : '#059669' }}; margin: 0 0 5px 0;">
                                                    {{ $item->jenisPelanggaran && $item->jenisPelanggaran->kategori ? $item->jenisPelanggaran->kategori->nama_kategori : 'Pelanggaran' }}
                                                </p>
                                                <p style="margin: 0; color: #6b7280; font-size: 0.9rem;">
                                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d') }} {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('F Y') }} - {{ $item->inputBy ? $item->inputBy->name : 'Sistem' }}
                                                </p>
                                                <p style="margin: 0; color: #6b7280; font-size: 0.9rem;">
                                                    {{ $item->jenisPelanggaran ? $item->jenisPelanggaran->nama_pelanggaran : 'Tidak ada keterangan' }}
                                                </p>
                                                @if($item->keterangan)
                                                <p style="margin: 0; color: #6b7280; font-size: 0.8rem; font-style: italic;">
                                                    "{{ $item->keterangan }}"
                                                </p>
                                                @endif
                                            </div>
                                            <span class="badge"
                                                style="background-color: {{ $item->poin_perubahan < 0 ? '#fef2f2' : '#f0fdf4' }}; color: {{ $item->poin_perubahan < 0 ? '#dc2626' : '#059669' }}; font-weight: 600; border: 1px solid {{ $item->poin_perubahan < 0 ? '#fecaca' : '#bbf7d0' }}; padding: 6px 12px; border-radius: 6px;">
                                                {{ $item->poin_perubahan > 0 ? '+' : '' }}{{ $item->poin_perubahan }} poin
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <!-- Ulangi item lain di sini -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ubah Password -->
    <div class="modal fade" id="ubahPasswordModal" tabindex="-1" aria-labelledby="ubahPasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahPasswordModalLabel">Ubah Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('siswa.ubah-password', $model->user_id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="passwordBaru" class="form-label">Password Baru</label>
                            <input name="password" type="password" class="form-control" id="passwordBaru" required
                                placeholder="Masukkan password baru" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="konfirmasiPassword" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="konfirmasiPassword" required
                                placeholder="Konfirmasi password baru" autocomplete="off">
                        </div>
                        <button type="submit" class="btn btn-primary" onclick="validatePassword()">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('siswa.jsfunction')
@endsection
