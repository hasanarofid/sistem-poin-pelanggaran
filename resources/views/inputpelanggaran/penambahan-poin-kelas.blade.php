@extends('layouts.admin.home')
@section('title', 'Penambahan Poin Kelas')
@section('titelcard', 'Penambahan Poin Kelas')
@section('content')
<style>
.penambahan-card {
  border-radius: 12px;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
  border: none;
}

.penambahan-header {
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  color: white;
  border-radius: 12px 12px 0 0;
  padding: 1.5rem;
}

.penambahan-body {
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
  border-color: #10b981;
  box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
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
  background-color: #10b981;
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

.students-selection {
  background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
  border-radius: 8px;
  padding: 1.5rem;
  margin-top: 1.5rem;
  border-left: 4px solid #10b981;
}

.students-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}

.students-count {
  background: #10b981;
  color: white;
  padding: 0.25rem 0.75rem;
  border-radius: 20px;
  font-size: 0.875rem;
  font-weight: 600;
}

.student-item {
  display: flex;
  align-items: center;
  padding: 0.75rem;
  background: white;
  border-radius: 8px;
  margin-bottom: 0.5rem;
  border: 1px solid #e5e7eb;
  transition: all 0.3s ease;
}

.student-item:hover {
  border-color: #10b981;
  box-shadow: 0 2px 4px rgba(16, 185, 129, 0.1);
}

.student-item input[type="checkbox"] {
  margin-right: 0.75rem;
  transform: scale(1.2);
}

.student-info {
  flex: 1;
}

.student-name {
  font-weight: 600;
  color: #374151;
  margin-bottom: 0.25rem;
}

.student-details {
  font-size: 0.875rem;
  color: #6b7280;
}

.student-points {
  font-weight: 600;
  color: #10b981;
  font-size: 0.875rem;
}

.bulk-actions {
  display: flex;
  gap: 0.5rem;
  margin-bottom: 1rem;
}

.bulk-actions .btn {
  padding: 0.5rem 1rem;
  font-size: 0.875rem;
  border-radius: 6px;
}

.select-all-btn {
  background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
  border: none;
  color: white;
}

.deselect-all-btn {
  background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
  border: none;
  color: white;
}

.preview-card {
  background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
  border: 1px solid #f59e0b;
  border-radius: 8px;
  padding: 1.5rem;
  margin-top: 1.5rem;
}

.preview-title {
  font-weight: 600;
  color: #92400e;
  margin-bottom: 1rem;
}

.preview-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0.5rem 0;
  border-bottom: 1px solid #fbbf24;
}

.preview-item:last-child {
  border-bottom: none;
}

.preview-label {
  font-weight: 500;
  color: #92400e;
}

.preview-value {
  font-weight: 600;
  color: #92400e;
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

.submit-button {
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  border: none;
  color: white;
}

.reset-button {
  background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
  border: none;
  color: white;
}

.loading-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.7);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

.loading-content {
  background: white;
  padding: 2rem;
  border-radius: 12px;
  text-align: center;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

.loading-spinner {
  width: 3rem;
  height: 3rem;
  border: 4px solid #f3f3f3;
  border-top: 4px solid #10b981;
  border-radius: 50%;
  animation: spin 1s linear infinite;
  margin: 0 auto 1rem;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Select2 Styling */
.select2-container--default .select2-selection--single {
  height: 38px;
  border: 1px solid #d1d5db;
  border-radius: 8px;
  background-color: rgba(255, 255, 255, 0.9);
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
  line-height: 36px;
  padding-left: 12px;
  color: #374151;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
  height: 36px;
}

.select2-container--default .select2-results__option--highlighted[aria-selected] {
  background-color: #10b981;
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

.select2-container--default .select2-selection--single:focus {
  border-color: #10b981;
  box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
}

.empty-state {
  text-align: center;
  padding: 3rem 1rem;
  color: #6b7280;
}

.empty-state i {
  font-size: 4rem;
  margin-bottom: 1rem;
  opacity: 0.5;
}

.stats-card {
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  color: white;
  border-radius: 12px;
  padding: 1.5rem;
  margin-bottom: 1.5rem;
}

.stats-card .stat-item {
  text-align: center;
}

.stats-card .stat-number {
  font-size: 2rem;
  font-weight: 700;
  margin-bottom: 0.5rem;
}

.stats-card .stat-label {
  font-size: 0.875rem;
  opacity: 0.9;
}
</style>

<div class="content-wrapper" style="margin: 0 !important; padding: 0 !important; width: 100% !important;">
  <div class="container-xxl flex-grow-1 container-p-y" style="padding: 30px !important; width: 100% !important; max-width: none !important; margin: 0 !important;">

    <!-- Flash Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="ti ti-check-circle me-2"></i>
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="ti ti-alert-circle me-2"></i>
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <i class="ti ti-alert-triangle me-2"></i>
      {{ session('warning') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="ti ti-alert-circle me-2"></i>
      <strong>Validasi Gagal:</strong>
      <ul class="mb-0 mt-2">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Header Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="mb-0" style="font-size: 28px; font-weight: 700; color: #1f2937;">Penambahan Poin Kelas</h1>
      <div class="d-flex gap-2">
        <a href="{{ route('admin.input-poin.index') }}" class="btn btn-primary">
          <i class="ti ti-plus me-2"></i>Input Poin Individu
        </a>
        <a href="{{ route('admin.list-input-poin.index') }}" class="btn btn-secondary">
          <i class="ti ti-list me-2"></i>List Input Poin
        </a>
      </div>
    </div>

    <!-- Stats Card -->
    <div class="stats-card">
      <div class="row">
        <div class="col-md-3">
          <div class="stat-item">
            <div class="stat-number">{{ $kelas->count() }}</div>
            <div class="stat-label">Total Kelas</div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stat-item">
            <div class="stat-number">{{ $jenisPelanggaran->count() }}</div>
            <div class="stat-label">Jenis Poin</div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stat-item">
            <div class="stat-number" id="totalSiswa">0</div>
            <div class="stat-label">Siswa Terpilih</div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stat-item">
            <div class="stat-number" id="totalPoin">0</div>
            <div class="stat-label">Total Poin</div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <!-- Form Card -->
      <div class="col-lg-8">
        <div class="card penambahan-card">
          <div class="penambahan-header">
            <h4 class="mb-0"><i class="ti ti-users me-2"></i>Form Penambahan Poin Kelas</h4>
          </div>
          <div class="penambahan-body">
            <form action="{{ route('admin.penambahan-poin-kelas.store') }}" method="POST" id="penambahanForm">
              @csrf
              
              <!-- Pilih Kelas -->
              <div class="mb-3">
                <label for="kelas_id" class="form-label">Pilih Kelas</label>
                <select id="kelas_id" name="kelas_id" class="form-select select2" required>
                  <option value="">Pilih kelas...</option>
                  @foreach($kelas as $value)
                  <option value="{{$value->id}}" data-nama="{{$value->nama_kelas}}" data-subkelas="{{$value->subkelas}}">
                    {{$value->nama_kelas}} - {{$value->subkelas}}
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
                          data-nama="{{ $value->nama_pelanggaran }}">
                    {{ $value->kode }} - {{ $value->nama_pelanggaran }} ({{ $value->poin > 0 ? '+' : '' }}{{ $value->poin }} point)
                  </option>
                  @endforeach
                </select>
              </div>

              <!-- Keterangan -->
              <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Keterangan untuk semua siswa..."></textarea>
              </div>

              <!-- Students will be sent via FormData in JavaScript -->

              <!-- Submit Button -->
              <div class="d-flex justify-content-between">
                <button type="button" class="btn reset-button" id="resetBtn">
                  <i class="ti ti-refresh me-2"></i>Reset Form
                </button>
                <button type="submit" class="btn submit-button" id="submitBtn" disabled>
                  <i class="ti ti-users me-2"></i>Tambahkan Poin ke Kelas
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Preview Card -->
      <div class="col-lg-4">
        <div class="card penambahan-card">
          <div class="penambahan-header">
            <h4 class="mb-0"><i class="ti ti-eye me-2"></i>Preview Penambahan</h4>
          </div>
          <div class="penambahan-body">
            <div class="preview-card" id="previewCard" style="display: none;">
              <div class="preview-title">Data yang akan ditambahkan</div>
              <div class="preview-item">
                <span class="preview-label">Kelas:</span>
                <span class="preview-value" id="previewKelas">-</span>
              </div>
              <div class="preview-item">
                <span class="preview-label">Jenis Poin:</span>
                <span class="preview-value" id="previewJenisPoin">-</span>
              </div>
              <div class="preview-item">
                <span class="preview-label">Jumlah Siswa:</span>
                <span class="preview-value" id="previewJumlahSiswa">-</span>
              </div>
              <div class="preview-item">
                <span class="preview-label">Poin per Siswa:</span>
                <span class="preview-value" id="previewPoinPerSiswa">-</span>
              </div>
              <div class="preview-item">
                <span class="preview-label">Total Poin:</span>
                <span class="preview-value" id="previewTotalPoin">-</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Students Selection -->
    <div class="students-selection" id="studentsSelection" style="display: none;">
      <div class="students-header">
        <h5 class="mb-0">Pilih Siswa</h5>
        <div class="d-flex gap-2">
          <span class="students-count" id="selectedCount">0 siswa terpilih</span>
          <div class="bulk-actions">
            <button type="button" class="btn select-all-btn" id="selectAllBtn">
              <i class="ti ti-check me-1"></i>Pilih Semua
            </button>
            <button type="button" class="btn deselect-all-btn" id="deselectAllBtn">
              <i class="ti ti-x me-1"></i>Batal Pilih
            </button>
          </div>
        </div>
      </div>
      <div id="studentsList">
        <!-- Students will be loaded here -->
      </div>
    </div>

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay" style="display: none;">
      <div class="loading-content">
        <div class="loading-spinner"></div>
        <h5>Memproses Penambahan Poin...</h5>
        <p class="text-muted">Mohon tunggu, sedang menambahkan poin untuk siswa yang dipilih.</p>
        
        <!-- Progress Bar -->
        <div class="progress mt-3" style="height: 25px;">
          <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
               id="progressBar" 
               role="progressbar" 
               style="width: 0%" 
               aria-valuenow="0" 
               aria-valuemin="0" 
               aria-valuemax="100">
            <span id="progressText" class="fw-bold">0%</span>
          </div>
        </div>
        
        <!-- Progress Details -->
        <div class="mt-3">
          <div class="row">
            <div class="col-4">
              <small class="text-muted">Diproses:</small>
              <div class="fw-bold text-success" id="processedCount">0</div>
            </div>
            <div class="col-4">
              <small class="text-muted">Total:</small>
              <div class="fw-bold" id="totalCount">0</div>
            </div>
            <div class="col-4">
              <small class="text-muted">Sisa:</small>
              <div class="fw-bold text-warning" id="remainingCount">0</div>
            </div>
          </div>
        </div>
        
        <!-- Current Status -->
        <div class="mt-2">
          <small class="text-muted">Status:</small>
          <div class="fw-bold text-primary" id="currentStatus">Memulai proses...</div>
        </div>
        
        <!-- Time Estimate -->
        <div class="mt-2">
          <small class="text-muted">Estimasi waktu:</small>
          <div class="fw-bold text-info" id="timeEstimate">Menghitung...</div>
        </div>
        
        <!-- Force Hide Button (hidden by default) -->
        <div class="mt-3" id="forceHideSection" style="display: none;">
          <button type="button" class="btn btn-warning btn-sm" id="forceHideBtn">
            <i class="ti ti-x me-1"></i>Tutup Loading
          </button>
        </div>
      </div>
    </div>

  </div>
</div>

@endsection

@section('script')
<script>
$(document).ready(function() {
  // Auto-hide flash messages after 5 seconds
  setTimeout(function() {
    $('.alert').fadeOut('slow');
  }, 5000);

  let selectedStudents = [];
  let currentKelas = null;
  let currentJenisPoin = null;

  // Reset form to default state
  function resetFormToDefault() {
    // Reset dropdowns
    $('#kelas_id').val('').trigger('change');
    $('#jenis_pelanggaran_id').val('').trigger('change');
    
    // Reset textarea
    $('#keterangan').val('');
    
    // Reset selected students
    selectedStudents = [];
    currentKelas = null;
    currentJenisPoin = null;
    
    // Hide students selection
    $('#studentsSelection').hide();
    
    // Reset preview
    $('#previewCard').hide();
    $('#totalSiswa').text('0');
    $('#totalPoin').text('0');
    
    // Reset submit button
    $('#submitBtn').prop('disabled', true);
    
    // Clear students list
    $('#studentsList').empty();
    
    // Reset counters
    $('#selectedCount').text('0 siswa terpilih');
  }

  // Check if there's a success message and reset form
  @if(session('success'))
    // Reset form after successful submission
    setTimeout(function() {
      resetFormToDefault();
    }, 1000); // Wait 1 second to show success message first
  @else
    // Reset form on page load if no success message
    resetFormToDefault();
  @endif

  // Initialize select2 for kelas dropdown
  $('#kelas_id').select2({
    placeholder: 'Pilih kelas...',
    allowClear: true,
    width: '100%'
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

  // Handle kelas selection
  $('#kelas_id').on('change', function() {
    let kelasId = $(this).val();
    if (kelasId) {
      currentKelas = $(this).find('option:selected');
      loadStudents(kelasId);
    } else {
      hideStudentsSelection();
    }
  });

  // Handle jenis poin selection
  $('#jenis_pelanggaran_id').on('change', function() {
    let jenisPoinId = $(this).val();
    if (jenisPoinId) {
      currentJenisPoin = $(this).find('option:selected');
      updatePreview();
    } else {
      hidePreview();
    }
  });

  // Load students by kelas
  function loadStudents(kelasId) {
    $.ajax({
      url: "{{ route('admin.penambahan-poin-kelas.get-siswa', '') }}/" + kelasId,
      type: "GET",
      success: function(response) {
        displayStudents(response);
        showStudentsSelection();
      },
      error: function() {
        Swal.fire({
          icon: 'error',
          title: 'Gagal!',
          text: 'Gagal memuat data siswa'
        });
      }
    });
  }

  // Display students
  function displayStudents(students) {
    let html = '';
    students.forEach(function(student) {
      html += `
        <div class="student-item">
          <input type="checkbox" class="student-checkbox" value="${student.id}" id="student_${student.id}">
          <div class="student-info">
            <div class="student-name">${student.nama}</div>
            <div class="student-details">NIS: ${student.nis}</div>
          </div>
          <div class="student-points">${student.point ? student.point.total_poin : 100} poin</div>
        </div>
      `;
    });
    $('#studentsList').html(html);
    
    // Add event listeners to checkboxes
    $('.student-checkbox').on('change', function() {
      updateSelectedStudents();
    });
  }

  // Update selected students
  function updateSelectedStudents() {
    selectedStudents = [];
    $('.student-checkbox:checked').each(function() {
      selectedStudents.push($(this).val());
    });
    
    $('#selectedCount').text(selectedStudents.length + ' siswa terpilih');
    $('#totalSiswa').text(selectedStudents.length);
    
    updatePreview();
    updateSubmitButton();
  }

  // Select all students
  $('#selectAllBtn').on('click', function() {
    $('.student-checkbox').prop('checked', true);
    updateSelectedStudents();
  });

  // Deselect all students
  $('#deselectAllBtn').on('click', function() {
    $('.student-checkbox').prop('checked', false);
    updateSelectedStudents();
  });

  // Show students selection
  function showStudentsSelection() {
    $('#studentsSelection').show();
  }

  // Hide students selection
  function hideStudentsSelection() {
    $('#studentsSelection').hide();
    selectedStudents = [];
    updatePreview();
    updateSubmitButton();
  }

  // Update preview
  function updatePreview() {
    if (currentKelas && currentJenisPoin && selectedStudents.length > 0) {
      let kelasNama = currentKelas.data('nama') + ' - ' + currentKelas.data('subkelas');
      let jenisPoinNama = currentJenisPoin.data('nama');
      let poin = currentJenisPoin.data('poin');
      let totalPoin = poin * selectedStudents.length;
      
      $('#previewKelas').text(kelasNama);
      $('#previewJenisPoin').text(jenisPoinNama);
      $('#previewJumlahSiswa').text(selectedStudents.length + ' siswa');
      $('#previewPoinPerSiswa').html(`<span class="point-change ${poin > 0 ? 'point-positive' : 'point-negative'}">${poin > 0 ? '+' : ''}${poin}</span>`);
      $('#previewTotalPoin').html(`<span class="point-change ${totalPoin > 0 ? 'point-positive' : 'point-negative'}">${totalPoin > 0 ? '+' : ''}${totalPoin}</span>`);
      
      $('#totalPoin').text(totalPoin);
      $('#previewCard').show();
    } else {
      hidePreview();
    }
  }

  // Hide preview
  function hidePreview() {
    $('#previewCard').hide();
    $('#totalPoin').text('0');
  }

  // Update submit button
  function updateSubmitButton() {
    if (selectedStudents.length > 0 && currentJenisPoin) {
      $('#submitBtn').prop('disabled', false);
    } else {
      $('#submitBtn').prop('disabled', true);
    }
  }

  // Form submission - Simplified version
  $('#penambahanForm').on('submit', function(e) {
    e.preventDefault();
    
    if (selectedStudents.length === 0) {
      Swal.fire({
        icon: 'warning',
        title: 'Peringatan!',
        text: 'Pilih minimal satu siswa untuk menambahkan poin'
      });
      return;
    }
    
    // Show loading overlay with progress
    showProgressOverlay();
    
    // Start progress simulation
    let progressInterval = startProgressSimulation();
    
    // Add selected students to form as hidden inputs
    let form = $(this);
    
    // Remove existing hidden inputs for siswa_ids
    form.find('input[name="siswa_ids[]"]').remove();
    
    // Add selected students as hidden inputs
    selectedStudents.forEach(function(siswaId) {
      let hiddenInput = $('<input>').attr({
        type: 'hidden',
        name: 'siswa_ids[]',
        value: siswaId
      });
      form.append(hiddenInput);
    });
    
    console.log('Form data being sent:');
    console.log('Selected students:', selectedStudents);
    console.log('Form action:', form.attr('action'));
    console.log('CSRF token:', $('meta[name="csrf-token"]').attr('content'));
    
    // Submit form directly (no AJAX)
    console.log('Submitting form directly...');
    
    // Clear progress interval
    clearInterval(progressInterval);
    
    // Hide loading overlay
    $('#loadingOverlay').hide();
    
    // Submit form directly
    form[0].submit();
    
    // Auto-hide loading overlay after 2 seconds
    setTimeout(function() {
      $('#loadingOverlay').hide();
    }, 2000);
  });
  
  // Show progress overlay
  function showProgressOverlay() {
    $('#loadingOverlay').show();
    $('#totalCount').text(selectedStudents.length);
    $('#processedCount').text('0');
    $('#remainingCount').text(selectedStudents.length);
    $('#currentStatus').text('Memulai proses...');
    $('#timeEstimate').text('Menghitung...');
    $('#forceHideSection').hide(); // Hide force hide button initially
    updateProgress(0);
    
    // Show force hide button after 5 seconds
    setTimeout(function() {
      $('#forceHideSection').show();
    }, 5000);
  }
  
  // Force hide loading overlay
  function forceHideLoading() {
    console.log('Force hiding loading overlay...');
    $('#loadingOverlay').hide();
    $('#forceHideSection').hide();
  }
  
  // Start progress simulation
  function startProgressSimulation() {
    let processed = 0;
    let total = selectedStudents.length;
    let startTime = new Date().getTime();
    let progressInterval = setInterval(function() {
      processed++;
      let percentage = Math.round((processed / total) * 100);
      let remaining = total - processed;
      
      // Update progress
      $('#processedCount').text(processed);
      $('#remainingCount').text(remaining);
      $('#currentStatus').text(`Memproses siswa ${processed} dari ${total}...`);
      updateProgress(percentage);
      
      // Calculate time estimate
      let currentTime = new Date().getTime();
      let elapsed = (currentTime - startTime) / 1000; // seconds
      let rate = processed / elapsed; // students per second
      let estimatedTotal = total / rate;
      let remainingTime = (remaining / rate);
      
      if (remainingTime > 60) {
        $('#timeEstimate').text(`~${Math.round(remainingTime / 60)} menit tersisa`);
      } else {
        $('#timeEstimate').text(`~${Math.round(remainingTime)} detik tersisa`);
      }
      
      if (processed >= total) {
        clearInterval(progressInterval);
        $('#currentStatus').text('Menyelesaikan proses...');
        $('#timeEstimate').text('Hampir selesai...');
        updateProgress(100);
        
        // Auto-hide loading overlay after 2 seconds if still visible
        setTimeout(function() {
          if ($('#loadingOverlay').is(':visible')) {
            console.log('Auto-hiding loading overlay after timeout');
            $('#loadingOverlay').hide();
          }
        }, 2000);
      }
    }, 300); // Update every 300ms for smoother progress
    
    return progressInterval; // Return interval ID so it can be cleared
  }
  
  // Update progress bar
  function updateProgress(percentage) {
    $('#progressBar').css('width', percentage + '%').attr('aria-valuenow', percentage);
    $('#progressText').text(percentage + '%');
  }

  // Reset button handler
  $('#resetBtn').on('click', function() {
    Swal.fire({
      title: 'Reset Form?',
      text: 'Apakah Anda yakin ingin mengosongkan form?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#10b981',
      cancelButtonColor: '#6b7280',
      confirmButtonText: 'Ya, Reset!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        resetFormToDefault();
        Swal.fire({
          title: 'Form Direset!',
          text: 'Form telah dikembalikan ke kondisi awal.',
          icon: 'success',
          timer: 2000,
          showConfirmButton: false
        });
      }
    });
  });

  // Force hide loading button handler
  $('#forceHideBtn').on('click', function() {
    Swal.fire({
      title: 'Tutup Loading?',
      text: 'Apakah Anda yakin ingin menutup loading overlay?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#f59e0b',
      cancelButtonColor: '#6b7280',
      confirmButtonText: 'Ya, Tutup!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        forceHideLoading();
        Swal.fire({
          title: 'Loading Ditutup!',
          text: 'Loading overlay telah ditutup.',
          icon: 'info',
          timer: 1500,
          showConfirmButton: false
        });
      }
    });
  });

  // Keyboard shortcuts
  $(document).on('keydown', function(e) {
    // Escape: Reset form or hide loading
    if (e.key === 'Escape') {
      if ($('#loadingOverlay').is(':visible')) {
        forceHideLoading();
      } else {
        resetFormToDefault();
      }
    }
    
    // Ctrl+A: Select all students
    if (e.ctrlKey && e.key === 'a' && $('#studentsSelection').is(':visible')) {
      e.preventDefault();
      $('#selectAllBtn').click();
    }
    
    // Ctrl+R: Reset form
    if (e.ctrlKey && e.key === 'r') {
      e.preventDefault();
      $('#resetBtn').click();
    }
    
    // Ctrl+H: Force hide loading
    if (e.ctrlKey && e.key === 'h' && $('#loadingOverlay').is(':visible')) {
      e.preventDefault();
      $('#forceHideBtn').click();
    }
  });
});
</script>
@endsection
