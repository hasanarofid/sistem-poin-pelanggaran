@extends('layouts.admin.home')
@section('title', 'Master Kategori')
@section('titelcard', 'Master Kategori')
@section('content')
<div class="content-wrapper" style="margin: 0 !important; padding: 0 !important; width: 100% !important;">
    <div class="container-xxl flex-grow-1 container-p-y" style="padding: 30px !important; width: 100% !important; max-width: none !important; margin: 0 !important;">

        <!-- Header Title & Buttons -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0" style="font-size: 28px; font-weight: 700; color: #1f2937;">Master Kategori</h1>
            <div class="d-flex gap-2">
                <a href="#"
                    class="btn btn-success d-flex align-items-center"
                    style="padding: 10px 15px; font-size: 14px;"
                    data-bs-toggle="modal" data-bs-target="#modalTambahKategori">
                    <i class="ti ti-plus" style="margin-right: 6px;"></i> Tambah Master Kategori
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
                                <th style="width: 25%;">Nama Kategori</th>
                                <th style="width: 15%;">Status</th>
                                <th style="width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kategori as $index => $value)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $value->nama_kategori ?? '-' }}</td>
                                <td>{{ $value->is_aktif == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button type="button"
                                            class="btn btn-sm btn-warning btnEditKategori">
                                            <i class="ti ti-edit"></i>
                                        </button>
                                        <form action="{{ route('admin.kategori.destroy', $value->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
<div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-labelledby="modalTambahKategoriLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalTambahKategoriLabel">Tambah Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <form action="{{ route('admin.kategori.store') }}" method="POST" id="formTambahKategori">
                @csrf
                <div class="modal-body">

                    <!-- Nama Kategori -->
                    <div class="mb-3">
                        <label for="nama_kategori" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="">
                    </div>

                    <!-- Kategori -->
                    <div class="mb-3">
                        <label for="is_aktif" class="form-label">Status</label>
                        <select id="is_aktif" name="is_aktif" class="form-select">
                            <option value="">Pilih Status...</option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
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

<!-- MODAL EDIT -->
<!-- Modal Edit Kategori -->
<div class="modal fade" id="modalEditKategori" tabindex="-1" aria-labelledby="modalEditKategoriLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalEditKategoriLabel">Edit Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <form id="formEditKategori">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_id" name="id">

                    <div class="mb-3">
                        <label for="edit_nama_kategori" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="edit_nama_kategori" name="nama_kategori" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_is_aktif" class="form-label">Status</label>
                        <select class="form-select" id="edit_is_aktif" name="is_aktif" required>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>

                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    $(document).ready(function() {
        // Submit form tambah pelanggaran
        $('#formTambahKategori').on('submit', function(e) {
            e.preventDefault();

            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('admin.kategori.store') }}",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.success) {
                        $('#modalTambahKategori').modal('hide');
                        $('#formTambahKategori')[0].reset();
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

    $(document).on("click", ".btnEditKategori", function() {
        let row = $(this).closest("tr");
        let id = row.find("form").attr("action").split("/").pop(); // ambil ID dari action form delete
        let nama_kategori = row.find("td:eq(1)").text().trim();
        let status = row.find("td:eq(2)").text().trim() === "Aktif" ? 1 : 0;

        // Set nilai ke modal
        $("#edit_id").val(id);
        $("#edit_nama_kategori").val(nama_kategori);
        $("#edit_is_aktif").val(status);

        // Tampilkan modal
        $("#modalEditKategori").modal("show");
    });

    // Submit form Edit
    $("#formEditKategori").on("submit", function(e) {
        e.preventDefault();

        let id = $("#edit_id").val();
        let formData = $(this).serialize();

        $.ajax({
            url: "/admin/kategori/" + id + "/update", // ✅ sesuai route
            type: "POST", // tetap POST karena ada @method('PUT') di form
            data: formData,
            success: function(response) {
                if (response.success) {
                    $("#modalEditKategori").modal("hide");
                    location.reload();
                } else {
                    alert(response.message || "Gagal update data");
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert("Terjadi kesalahan saat update!");
            }
        });
    });
</script>

@endsection