@extends('layouts.admin.home')

@section('title', 'Profile Guru')

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
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <h4 class="fw-bold" style="color: #1f2937; font-size: 1.5rem; margin-bottom: 20px;">
                    Profil Guru
                </h4>
                <div class="row">
                    <!-- Informasi Guru -->
                    <div class="col-md-5">
                        <div class="card" style="border: 1px solid #e5e7eb; border-radius: 8px; height: 100%;">
                            <div class="card-header" style="background: #fff; border-bottom: 1px solid #e5e7eb;">
                                <h5 class="card-title" style="font-weight: 600; color: #374151; margin: 0;">
                                    Informasi Guru
                                </h5>
                            </div>
                            <div class="card-body" style="margin-top: 25px;">
                                <p style="margin: 0; color: #6b7280;">Nama</p>
                                <p style="font-weight: 600; color: #374151;">{{ $user->name }}</p>
                                <p style="margin: 0; color: #6b7280;">Email</p>
                                <p style="font-weight: 600; color: #374151;">{{ $user->email }}</p>
                                <p style="margin: 0; color: #6b7280;">Kelas yang Diampu</p>
                                <p style="font-weight: 600; color: #374151;">{{ $kelas->nama_kelas }} - {{ $kelas->subkelas }}</p>
                                <p style="margin: 0; color: #6b7280;">Total Siswa di Kelas</p>
                                <p style="font-weight: 600; color: #dc2626;">{{ $total_siswa }} siswa</p>
                                <!-- Button Ubah Password -->
                                <button type="button" class="btn btn-warning mt-3" data-bs-toggle="modal"
                                    data-bs-target="#ubahPasswordModal">
                                    Ubah Password
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Statistik Kelas -->
                    <div class="col-md-7">
                        <div class="card" style="border: 1px solid #e5e7eb; border-radius: 8px; height: 100%;">
                            <div class="card-header" style="background: #fff; border-bottom: 1px solid #e5e7eb;">
                                <h5 class="card-title" style="font-weight: 600; color: #374151; margin: 0;">
                                    Statistik Kelas
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="stat-card" style="background: #f3f4f6; padding: 20px; border-radius: 8px; text-align: center;">
                                            <div class="stat-number" style="font-size: 2rem; font-weight: 700; color: #dc2626;">
                                                {{ $pelanggaran_bulan_ini }}
                                            </div>
                                            <div class="stat-label" style="color: #6b7280; font-size: 0.875rem;">
                                                Pelanggaran Bulan Ini
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="stat-card" style="background: #f3f4f6; padding: 20px; border-radius: 8px; text-align: center;">
                                            <div class="stat-number" style="font-size: 2rem; font-weight: 700; color: #dc2626;">
                                                {{ $siswa_bermasalah }}
                                            </div>
                                            <div class="stat-label" style="color: #6b7280; font-size: 0.875rem;">
                                                Siswa Bermasalah
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                    <form action="{{ route('guru.ubah-password', $user->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="passwordBaru" class="form-label">Password Baru</label>
                            <input name="password" type="password" class="form-control" id="passwordBaru" required
                                placeholder="Masukkan password baru" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="konfirmasiPassword" class="form-label">Konfirmasi Password</label>
                            <input name="password_confirmation" type="password" class="form-control" id="konfirmasiPassword" required
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
<script>
function validatePassword() {
    const password = document.getElementById('passwordBaru').value;
    const confirmPassword = document.getElementById('konfirmasiPassword').value;
    
    if (password.length < 8) {
        alert('Password minimal 8 karakter!');
        event.preventDefault();
        return false;
    }
    
    if (password !== confirmPassword) {
        alert('Password dan konfirmasi password tidak sama!');
        event.preventDefault();
        return false;
    }
    
    return true;
}

// Add form validation on submit
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form[action*="ubah-password"]');
    if (form) {
        form.addEventListener('submit', function(e) {
            if (!validatePassword()) {
                e.preventDefault();
            }
        });
    }
});
</script>
@endsection
