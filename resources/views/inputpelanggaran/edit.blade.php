@extends('layouts.admin.home')
@section('title', 'Edit Input Poin')
@section('titelcard', 'Edit Input Poin')
@section('content')
<style>
.edit-card {
  border-radius: 12px;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
  border: none;
}

.edit-header {
  background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
  color: white;
  border-radius: 12px 12px 0 0;
  padding: 1.5rem;
}

.edit-body {
  padding: 2rem;
}

.form-label {
  font-weight: 600;
  color: #374151;
  margin-bottom: 0.5rem;
}

.form-control, .form-select {
  border-radius: 8px;
  border: 1px solid #d1d5db;
  transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
  border-color: #f59e0b;
  box-shadow: 0 0 0 0.2rem rgba(245, 158, 11, 0.25);
}

.select2-container--default .select2-selection--single {
  height: 38px;
  border: 1px solid #d1d5db;
  border-radius: 8px;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
  line-height: 36px;
  padding-left: 12px;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
  height: 36px;
}

.select2-container--default .select2-results__option--highlighted[aria-selected] {
  background-color: #f59e0b;
}

.select2-container--default .select2-results__option[aria-selected=true] {
  background-color: #e5e7eb;
}

.select2-container--default .select2-results__option {
  padding: 8px 12px;
}

.select2-container--default .select2-search--dropdown .select2-search__field {
  border: 1px solid #d1d5db;
  border-radius: 6px;
  padding: 6px 12px;
}

.select2-dropdown {
  border: 1px solid #d1d5db;
  border-radius: 8px;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.preview-card {
  background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
  border-radius: 8px;
  padding: 1.5rem;
  margin-bottom: 1.5rem;
  border-left: 4px solid #f59e0b;
}

.preview-title {
  font-weight: 600;
  color: #374151;
  margin-bottom: 1rem;
}

.preview-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0.5rem 0;
  border-bottom: 1px solid #e5e7eb;
}

.preview-item:last-child {
  border-bottom: none;
}

.preview-label {
  font-weight: 500;
  color: #6b7280;
}

.preview-value {
  font-weight: 600;
  color: #374151;
}

.point-change {
  font-size: 1.25rem;
  font-weight: 700;
  padding: 0.5rem 1rem;
  border-radius: 8px;
}

.point-positive {
  background-color: #d1fae5;
  color: #065f46;
}

.point-negative {
  background-color: #fee2e2;
  color: #991b1b;
}

.action-buttons {
  display: flex;
  gap: 0.5rem;
  justify-content: center;
  margin-top: 2rem;
}

.action-buttons .btn {
  padding: 0.75rem 1.5rem;
  font-weight: 600;
  border-radius: 8px;
}

.save-button {
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  border: none;
  color: white;
}

.cancel-button {
  background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
  border: none;
  color: white;
}

.breadcrumb {
  background: none;
  padding: 0;
  margin-bottom: 1.5rem;
}

.breadcrumb-item a {
  color: #f59e0b;
  text-decoration: none;
}

.breadcrumb-item a:hover {
  color: #d97706;
  text-decoration: underline;
}

.breadcrumb-item.active {
  color: #6b7280;
}

.warning-alert {
  background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
  border: 1px solid #f59e0b;
  border-radius: 8px;
  padding: 1rem;
  margin-bottom: 1.5rem;
}

.warning-alert .alert-title {
  font-weight: 600;
  color: #92400e;
  margin-bottom: 0.5rem;
}

.warning-alert .alert-text {
  color: #92400e;
  margin-bottom: 0;
}
</style>

<div class="content-wrapper" style="margin: 0 !important; padding: 0 !important; width: 100% !important;">
  <div class="container-xxl flex-grow-1 container-p-y" style="padding: 30px !important; width: 100% !important; max-width: none !important; margin: 0 !important;">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.list-input-poin.index') }}">List Input Poin</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.list-input-poin.show', $inputPelanggaran->id) }}">Detail</a></li>
        <li class="breadcrumb-item active">Edit</li>
      </ol>
    </nav>

    <!-- Header Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="mb-0" style="font-size: 28px; font-weight: 700; color: #1f2937;">Edit Input Poin</h1>
      <div class="d-flex gap-2">
        <a href="{{ route('admin.list-input-poin.show', $inputPelanggaran->id) }}" class="btn btn-secondary">
          <i class="ti ti-arrow-left me-2"></i>Kembali
        </a>
      </div>
    </div>

    <!-- Warning Alert -->
    <div class="warning-alert">
      <div class="alert-title">
        <i class="ti ti-alert-triangle me-2"></i>Peringatan
      </div>
      <div class="alert-text">
        Mengedit input poin akan menghitung ulang poin siswa. Pastikan data yang diubah sudah benar.
      </div>
    </div>

    <div class="row">
      <!-- Edit Form -->
      <div class="col-lg-8">
        <div class="card edit-card">
          <div class="edit-header">
            <h4 class="mb-0"><i class="ti ti-edit me-2"></i>Form Edit Input Poin</h4>
          </div>
          <div class="edit-body">
            <form action="{{ route('admin.list-input-poin.update_input', $inputPelanggaran->id) }}" method="POST" id="editForm">
              @csrf
              @method('PUT')
              
              <!-- Pilih Siswa -->
              <div class="mb-3">
                <label for="siswa_id" class="form-label">Pilih Siswa</label>
                <select id="siswa_id" name="siswa_id" class="form-select select2" required>
                  <option value="">Pilih siswa...</option>
                  @foreach($siswa as $value)
                  <option value="{{$value->id}}" 
                          data-nis="{{$value->nis}}" 
                          data-nama="{{$value->nama}}" 
                          data-kelas="{{$value->nama_kelas_lengkap}}"
                          data-points="{{$value->point ? $value->point->total_poin : 100}}"
                          {{ $value->id == $inputPelanggaran->siswa_id ? 'selected' : '' }}>
                    {{$value->nis}} - {{$value->nama}} - {{$value->nama_kelas_lengkap}}
                  </option>
                  @endforeach
                </select>
              </div>

              <!-- Jenis Poin -->
              <div class="mb-3">
                <label for="jenis_pelanggaran_id" class="form-label">Jenis Poin</label>
                <select id="jenis_pelanggaran_id" name="jenis_pelanggaran_id" class="form-select select2" required>
                  <option value="">Jenis Poin...</option>
                  @foreach($jenisPelanggaran as $value)
                  <option value="{{ $value->id }}" 
                          data-poin="{{ $value->poin }}" 
                          data-kategori="{{ $value->kategori->nama_kategori }}" 
                          data-kode="{{ $value->kode }}" 
                          data-nama="{{ $value->nama_pelanggaran }}"
                          {{ $value->id == $inputPelanggaran->jenis_pelanggaran_id ? 'selected' : '' }}>
                    {{ $value->kode }} - {{ $value->nama_pelanggaran }} ({{ $value->poin > 0 ? '+' : '' }}{{ $value->poin }} point)
                  </option>
                  @endforeach
                </select>
              </div>

              <!-- Keterangan -->
              <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Keterangan...">{{ $inputPelanggaran->keterangan }}</textarea>
              </div>

              <!-- Submit Button -->
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn save-button">
                  <i class="ti ti-device-floppy me-2"></i>Simpan Perubahan
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Preview Card -->
      <div class="col-lg-4">
        <div class="card edit-card">
          <div class="edit-header">
            <h4 class="mb-0"><i class="ti ti-eye me-2"></i>Preview Perubahan</h4>
          </div>
          <div class="edit-body">
            <div class="preview-card">
              <div class="preview-title">Data Lama</div>
              <div class="preview-item">
                <span class="preview-label">Siswa:</span>
                <span class="preview-value">{{ $inputPelanggaran->siswa->nama }}</span>
              </div>
              <div class="preview-item">
                <span class="preview-label">Jenis Poin:</span>
                <span class="preview-value">{{ $inputPelanggaran->jenispelanggaran->nama_pelanggaran }}</span>
              </div>
              <div class="preview-item">
                <span class="preview-label">Poin:</span>
                <span class="preview-value point-change {{ $inputPelanggaran->jenispelanggaran->poin > 0 ? 'point-positive' : 'point-negative' }}">
                  {{ $inputPelanggaran->jenispelanggaran->poin > 0 ? '+' : '' }}{{ $inputPelanggaran->jenispelanggaran->poin }}
                </span>
              </div>
            </div>

            <div class="preview-card" id="newDataPreview" style="display: none;">
              <div class="preview-title">Data Baru</div>
              <div class="preview-item">
                <span class="preview-label">Siswa:</span>
                <span class="preview-value" id="newSiswa">-</span>
              </div>
              <div class="preview-item">
                <span class="preview-label">Jenis Poin:</span>
                <span class="preview-value" id="newJenisPoin">-</span>
              </div>
              <div class="preview-item">
                <span class="preview-label">Poin:</span>
                <span class="preview-value point-change" id="newPoin">-</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Action Buttons -->
    <div class="action-buttons">
      <a href="{{ route('admin.list-input-poin.show', $inputPelanggaran->id) }}" class="btn cancel-button">
        <i class="ti ti-x me-2"></i>Batal
      </a>
      <button type="submit" form="editForm" class="btn save-button">
        <i class="ti ti-device-floppy me-2"></i>Simpan Perubahan
      </button>
    </div>

  </div>
</div>

@endsection

@section('script')
<script>
$(document).ready(function() {
  // Initialize select2 for siswa dropdown
  $('#siswa_id').select2({
    placeholder: 'Pilih siswa...',
    allowClear: true,
    width: '100%',
    matcher: function(params, data) {
      if ($.trim(params.term) === '') {
        return data;
      }
      if (typeof data.text === 'undefined') {
        return null;
      }
      let searchTerm = params.term.toLowerCase();
      let nis = data.element.getAttribute('data-nis') || '';
      let nama = data.element.getAttribute('data-nama') || '';
      let kelas = data.element.getAttribute('data-kelas') || '';
      
      if (nis.toLowerCase().indexOf(searchTerm) > -1 || 
          nama.toLowerCase().indexOf(searchTerm) > -1 || 
          kelas.toLowerCase().indexOf(searchTerm) > -1) {
        return data;
      }
      return null;
    }
  });

  // Initialize select2 for jenis poin dropdown
  $('#jenis_pelanggaran_id').select2({
    placeholder: 'Jenis Poin...',
    allowClear: true,
    width: '100%',
    matcher: function(params, data) {
      if ($.trim(params.term) === '') {
        return data;
      }
      if (typeof data.text === 'undefined') {
        return null;
      }
      let searchTerm = params.term.toLowerCase();
      let kode = data.element.getAttribute('data-kode') || '';
      let nama = data.element.getAttribute('data-nama') || '';
      let kategori = data.element.getAttribute('data-kategori') || '';
      
      if (kode.toLowerCase().indexOf(searchTerm) > -1 || 
          nama.toLowerCase().indexOf(searchTerm) > -1 || 
          kategori.toLowerCase().indexOf(searchTerm) > -1) {
        return data;
      }
      return null;
    }
  });

  // Update preview when form changes
  function updatePreview() {
    let siswaSelected = $('#siswa_id').find('option:selected');
    let jenisPoinSelected = $('#jenis_pelanggaran_id').find('option:selected');
    
    if (siswaSelected.val() && jenisPoinSelected.val()) {
      let siswaNama = siswaSelected.data('nama');
      let jenisPoinNama = jenisPoinSelected.data('nama');
      let poin = jenisPoinSelected.data('poin');
      
      $('#newSiswa').text(siswaNama);
      $('#newJenisPoin').text(jenisPoinNama);
      
      let poinHtml = `<span class="point-change ${poin > 0 ? 'point-positive' : 'point-negative'}">${poin > 0 ? '+' : ''}${poin}</span>`;
      $('#newPoin').html(poinHtml);
      
      $('#newDataPreview').show();
    } else {
      $('#newDataPreview').hide();
    }
  }

  // Handle form changes
  $('#siswa_id, #jenis_pelanggaran_id').on('change', function() {
    updatePreview();
  });

  // Initial preview update
  updatePreview();

  // Form submission
  // Gunakan form submit biasa tanpa AJAX untuk menghindari masalah route
  $('#editForm').on('submit', function(e) {
    // Jangan preventDefault, biarkan form submit secara normal
    
    let submitBtn = $(this).find('button[type="submit"]');
    let originalText = submitBtn.html();
    submitBtn.html('<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...').prop('disabled', true);
    
    console.log('Form submitting to:', $(this).attr('action'));
    console.log('Form method:', $(this).attr('method'));
    
    // Form akan submit secara normal ke route yang benar
    return true;
  });

  // Keyboard shortcuts
  $(document).on('keydown', function(e) {
    // Escape: Go back
    if (e.key === 'Escape') {
      window.location.href = "{{ route('admin.list-input-poin.show', $inputPelanggaran->id) }}";
    }
    
    // Ctrl+S: Save
    if (e.ctrlKey && e.key === 's') {
      e.preventDefault();
      $('#editForm').submit();
    }
  });
});
</script>
@endsection
