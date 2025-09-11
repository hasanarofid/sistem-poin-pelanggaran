@extends('layouts.admin.home')
@section('title', 'Jenis Pelanggaran')
@section('titelcard', 'Jenis Pelanggaran')
@section('content')
<div class="content-wrapper" style="margin: 0 !important; padding: 0 !important; width: 100% !important;">
    <div class="container-xxl flex-grow-1 container-p-y" style="padding: 30px !important; width: 100% !important; max-width: none !important; margin: 0 !important;">

        <!-- Header Title & Buttons -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0" style="font-size: 28px; font-weight: 700; color: #1f2937;">Jenis Pelanggaran</h1>
            <div class="d-flex gap-2">
                <a href="#"
                    class="btn btn-success d-flex align-items-center"
                    style="padding: 10px 15px; font-size: 14px;"
                    data-bs-toggle="modal" data-bs-target="#modalTambahPelanggaran">
                    <i class="ti ti-plus" style="margin-right: 6px;"></i> Tambah Jenis Pelanggaran
                </a>
            </div>
        </div>

        <!-- Form Card -->
        <!-- Form Card -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 25%;">Nama Pelanggaran</th>
                                <th style="width: 20%;">Kategori</th>
                                <th style="width: 15%;">Poin Pelanggaran</th>
                                <th style="width: 25%;">Deskripsi</th>
                                <th style="width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jenisPelanggaran as $index => $pelanggaran)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $pelanggaran->nama_pelanggaran }}</td>
                                <td>{{ $pelanggaran->kategori->nama_kategori ?? '-' }}</td>
                                <td>{{ $pelanggaran->poin }}</td>
                                <td>{{ $pelanggaran->deskripsi ?? '-' }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button type="button"
                                            class="btn btn-sm btn-warning btnEditJenisPelanggaran"
                                            data-id="{{ $pelanggaran->id }}"
                                            data-nama="{{ $pelanggaran->nama_pelanggaran }}"
                                            data-kategori="{{ $pelanggaran->kategori->kategori_id }}"
                                            data-poin="{{ $pelanggaran->poin }}"
                                            data-deskripsi="{{ $pelanggaran->deskripsi }}">
                                            <i class="ti ti-edit"></i>
                                        </button>
                                        <form action="{{ route('admin.jenis-pelanggaran.destroy', $pelanggaran->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data pelanggaran.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalTambahPelanggaran" tabindex="-1" aria-labelledby="modalTambahPelanggaranLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalTambahPelanggaranLabel">Tambah Jenis Pelanggaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <form action="{{ route('admin.jenis-pelanggaran.store') }}" method="POST" id="formTambahPelanggaran">
                @csrf
                <div class="modal-body">

                    <!-- Nama Pelanggaran -->
                    <div class="mb-3">
                        <label for="nama_pelanggaran" class="form-label">Nama Pelanggaran</label>
                        <input type="text" class="form-control" id="nama_pelanggaran" name="nama_pelanggaran" placeholder="">
                    </div>

                    <!-- Kategori -->
                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori</label>
                        <select id="kategori_id" name="kategori_id" class="form-select">
                            <option value="">Pilih kategori...</option>
                            @foreach($kategori as $value)
                            <option value="{{$value->id}}">{{$value->nama_kategori}}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Poin -->
                    <div class="mb-3">
                        <label for="poin" class="form-label">Poin Pelanggaran</label>
                        <input type="number" class="form-control" id="poin" name="poin" min="1" max="50" placeholder="Masukkan poin (1-50)">
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi detail pelanggaran..."></textarea>
                    </div>

                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="modalEditPelanggaran" tabindex="-1" aria-labelledby="modalEditPelanggaranLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalEditPelanggaranLabel">Edit Jenis Pelanggaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <form method="POST" id="formEditPelanggaran">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id" name="id">

                <div class="modal-body">

                    <!-- Nama Pelanggaran -->
                    <div class="mb-3">
                        <label for="edit_nama_pelanggaran" class="form-label">Nama Pelanggaran</label>
                        <input type="text" class="form-control" id="edit_nama_pelanggaran" name="nama_pelanggaran" placeholder="">
                    </div>

                    <!-- Kategori -->
                    <div class="mb-3">
                        <label for="edit_kategori_id" class="form-label">Kategori</label>
                        <select id="edit_kategori_id" name="kategori_id" class="form-select">
                            <option value="">Pilih kategori...</option>
                            @foreach($kategori as $value)
                            <option value="{{$value->id}}">{{$value->nama_kategori}}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Poin -->
                    <div class="mb-3">
                        <label for="edit_poin" class="form-label">Poin Pelanggaran</label>
                        <input type="number" class="form-control" id="edit_poin" name="poin" min="1" max="50" placeholder="Masukkan poin (1-50)">
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="edit_deskripsi" class="form-label">Deskripsi (Opsional)</label>
                        <textarea class="form-control" id="edit_deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi detail pelanggaran..."></textarea>
                    </div>

                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    $(document).ready(function() {
        // Submit form tambah pelanggaran
        $('#formTambahPelanggaran').on('submit', function(e) {
            e.preventDefault();

            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('admin.jenis-pelanggaran.store') }}",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.success) {
                        $('#modalTambahPelanggaran').modal('hide');
                        $('#formTambahPelanggaran')[0].reset();
                        location.reload();
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let pesan = '';
                        $.each(errors, function(key, value) {
                            pesan += value[0] + "\n";
                        });
                        alert(pesan); // bisa diganti pakai toast/alert Bootstrap
                    } else {
                        alert("Gagal menyimpan data!");
                    }
                }
            });
        });

    });
    // Klik tombol edit
    $(document).on("click", ".btnEditJenisPelanggaran", function() {
        let id = $(this).data("id");
        let nama = $(this).data("nama");
        let kategori_id = $(this).data("kategori");
        let poin = $(this).data("poin");
        let deskripsi = $(this).data("deskripsi");

        // isi ke modal
        $("#edit_id").val(id);
        $("#edit_nama_pelanggaran").val(nama);
        $("#edit_kategori_id").val(kategori_id);
        $("#edit_poin").val(poin);
        $("#edit_deskripsi").val(deskripsi);

        $("#modalEditPelanggaran").modal("show");
    });

    // Submit form edit
    $("#formEditPelanggaran").on("submit", function(e) {
        e.preventDefault();

        let id = $("#edit_id").val();
        let formData = $(this).serialize();

        $.ajax({
            url: "/admin/jenis-pelanggaran/" + id, // sesuaikan dengan route update
            type: "POST", // tetap POST, karena ada @method('PUT')
            data: formData,
            success: function(res) {
                if (res.success) {
                    $("#modalEditPelanggaran").modal("hide");
                    location.reload();
                } else {
                    alert(res.message || "Gagal update data");
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert("Terjadi kesalahan saat update");
            }
        });
    });
</script>

@endsection