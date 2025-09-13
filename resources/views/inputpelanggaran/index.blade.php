@extends('layouts.admin.home')
@section('title', 'Input Poin')
@section('titelcard', 'Input Poin')
@section('content')
<style>
.spin {
  animation: spin 1s linear infinite;
}
@keyframes spin {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
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
  background-color: #7c3aed;
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

/* RFID Scanner Styles */
#rfid_input {
  transition: all 0.3s ease;
}

#rfid_input:focus {
  border-color: #7c3aed;
  box-shadow: 0 0 0 0.2rem rgba(124, 58, 237, 0.25);
}

#rfid_status i {
  transition: all 0.3s ease;
}

/* Student Info Animation */
#student_info_section {
  transition: all 0.3s ease;
}

/* Keyboard Shortcuts Help */
.keyboard-shortcuts {
  position: fixed;
  bottom: 20px;
  right: 20px;
  background: rgba(0, 0, 0, 0.8);
  color: white;
  padding: 10px;
  border-radius: 8px;
  font-size: 12px;
  z-index: 1000;
}

.keyboard-shortcuts h6 {
  margin-bottom: 5px;
  font-size: 12px;
}

.keyboard-shortcuts .shortcut {
  display: flex;
  justify-content: space-between;
  margin-bottom: 2px;
}

.keyboard-shortcuts kbd {
  background: #333;
  color: white;
  padding: 2px 6px;
  border-radius: 3px;
  font-size: 10px;
}

/* RFID Status Colors */
.rfid-status-scanning {
  color: #7c3aed !important;
  animation: pulse 1s infinite;
}

.rfid-status-success {
  color: #10b981 !important;
}

.rfid-status-error {
  color: #ef4444 !important;
}

@keyframes pulse {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.5; }
}

/* Form Focus States */
.form-control:focus, .form-select:focus {
  border-color: #7c3aed;
  box-shadow: 0 0 0 0.2rem rgba(124, 58, 237, 0.25);
}

/* Success/Error States */
.is-valid {
  border-color: #10b981;
}

.is-invalid {
  border-color: #ef4444;
}
</style>
<div class="content-wrapper" style="margin: 0 !important; padding: 0 !important; width: 100% !important;">
  <div class="container-xxl flex-grow-1 container-p-y" style="padding: 30px !important; width: 100% !important; max-width: none !important; margin: 0 !important;">

    <!-- Header Title & Buttons -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="mb-0" style="font-size: 28px; font-weight: 700; color: #1f2937;">Input Poin</h1>
      <div class="d-flex gap-2">
        <!-- <span class="badge rounded-pill bg-dark" style="padding: 10px 15px; font-size: 14px;">
          <i class="ti ti-cloud" style="margin-right: 6px;"></i> Auto-sync ke Spreadsheet
        </span>
        <a href="#"
          class="btn btn-success d-flex align-items-center"
          style="padding: 10px 15px; font-size: 14px;"
          data-bs-toggle="modal" data-bs-target="#modalTambahPelanggaran">
          <i class="ti ti-plus" style="margin-right: 6px;"></i> Tambah Input Poin
        </a> -->
      </div>
    </div>

    <!-- Form Card -->
    <div class="card">
      <div class="card-body">
        <form action="{{ request()->routeIs('admin.*') ? route('admin.input-poin.store') : route('guru.input-poin.store') }}"
          method="POST"
          id="formTambahInputPelanggaran">
          @csrf
          <div class="modal-body">
            <!-- RFID Scanner Section -->
            <div class="mb-4">
              <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                  <h6 class="mb-0"><i class="ti ti-scan me-2"></i>RFID Scanner</h6>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <label for="rfid_input" class="form-label">Scan RFID Card</label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="ti ti-scan"></i></span>
                        <input type="text" 
                               id="rfid_input" 
                               name="rfid_input" 
                               class="form-control form-control-lg" 
                               placeholder="Tap RFID card atau ketik manual..."
                               autocomplete="off"
                               style="font-size: 18px; font-weight: 500;">
                        <button type="button" class="btn btn-outline-secondary" id="clear_rfid">
                          <i class="ti ti-x"></i>
                        </button>
                      </div>
                      <div class="form-text">
                        <i class="ti ti-info-circle me-1"></i>
                        Tap RFID card pada scanner atau ketik nomor RFID secara manual
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="text-center">
                        <div id="rfid_status" class="mb-2">
                          <i class="ti ti-scan fs-1 text-muted"></i>
                        </div>
                        <small class="text-muted" id="rfid_status_text">Siap untuk scan</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Student Info Display -->
            <div class="mb-3" id="student_info_section" style="display: none;">
              <div class="card border-success">
                <div class="card-header bg-success text-white">
                  <h6 class="mb-0"><i class="ti ti-user-check me-2"></i>Informasi Siswa</h6>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="text-center">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                          <i class="ti ti-user fs-2 text-primary"></i>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-9">
                      <h5 class="mb-1" id="student_name">-</h5>
                      <p class="mb-1 text-muted">
                        <strong>NIS:</strong> <span id="student_nis">-</span> | 
                        <strong>Kelas:</strong> <span id="student_kelas">-</span>
                      </p>
                      <p class="mb-0">
                        <strong>Poin Saat Ini:</strong> 
                        <span class="badge bg-primary fs-6" id="student_points">-</span>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pilih Siswa (Fallback) -->
            <div class="mb-3">
              <label for="siswa_id" class="form-label">
                Pilih Siswa 
                <small class="text-muted">(jika RFID tidak tersedia)</small>
              </label>
              <select id="siswa_id" name="siswa_id" class="form-select select2">
                <option value="">Pilih siswa...</option>
                @foreach($siswa as $value)
                <option value="{{$value->id}}" 
                        data-nis="{{$value->nis}}" 
                        data-nama="{{$value->nama}}" 
                        data-kelas="{{$value->nama_kelas_lengkap}}"
                        data-rfid="{{$value->rfid}}"
                        data-points="{{$value->point ? $value->point->total_poin : 100}}">
                  {{$value->nis}} - {{$value->nama}} - {{$value->nama_kelas_lengkap}}
                </option>
                @endforeach
              </select>
            </div>

            <!-- Jenis Poin -->
            <div class="mb-3">
              <label for="jenis_pelanggaran_id" class="form-label">Jenis Poin</label>
              <select id="jenis_pelanggaran_id" name="jenis_pelanggaran_id" class="form-select select2">
                <option value="">Jenis Poin...</option>
                @foreach($jenisPelanggaran as $value)
                <option value="{{ $value->id }}" data-poin="{{ $value->poin }}" data-kategori="{{ $value->kategori->nama_kategori }}" data-kode="{{ $value->kode }}" data-nama="{{ $value->nama_pelanggaran }}">
                  {{ $value->kode }} - {{ $value->nama_pelanggaran }} ({{ $value->poin > 0 ? '+' : '' }}{{ $value->poin }} point)
                </option>
                @endforeach
              </select>
            </div>

            <!-- keterangan -->
            <div class="mb-3">
              <label for="keterangan" class="form-label">Keterangan</label>
              <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Keterangan..."></textarea>
            </div>

          </div>

          <!-- Footer -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" style="">Simpan</button>
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
    // RFID Scanner Variables
    let rfidScanTimeout;
    let isScanning = false;
    
    // Initialize select2 for siswa dropdown with search
    $('#siswa_id').select2({
      placeholder: 'Pilih siswa...',
      allowClear: true,
      width: '100%',
      matcher: function(params, data) {
        // If there are no search terms, return all data
        if ($.trim(params.term) === '') {
          return data;
        }

        // Do not display the item if there is no 'text' property
        if (typeof data.text === 'undefined') {
          return null;
        }

        // Search in NIS, Nama, Kelas, and RFID
        let searchTerm = params.term.toLowerCase();
        let nis = data.element.getAttribute('data-nis') || '';
        let nama = data.element.getAttribute('data-nama') || '';
        let kelas = data.element.getAttribute('data-kelas') || '';
        let rfid = data.element.getAttribute('data-rfid') || '';
        
        if (nis.toLowerCase().indexOf(searchTerm) > -1 || 
            nama.toLowerCase().indexOf(searchTerm) > -1 || 
            kelas.toLowerCase().indexOf(searchTerm) > -1 ||
            rfid.toLowerCase().indexOf(searchTerm) > -1) {
          return data;
        }

        // Return null if the term should not be displayed
        return null;
      }
    });

    // RFID Scanner Functions
    function updateRFIDStatus(status, text, icon = 'ti ti-scan') {
      $('#rfid_status').html(`<i class="${icon} fs-1"></i>`);
      $('#rfid_status_text').text(text);
      
      // Update colors based on status
      switch(status) {
        case 'scanning':
          $('#rfid_status i').removeClass('text-muted text-success text-danger').addClass('text-primary');
          $('#rfid_status_text').removeClass('text-muted text-success text-danger').addClass('text-primary');
          break;
        case 'success':
          $('#rfid_status i').removeClass('text-muted text-primary text-danger').addClass('text-success');
          $('#rfid_status_text').removeClass('text-muted text-primary text-danger').addClass('text-success');
          break;
        case 'error':
          $('#rfid_status i').removeClass('text-muted text-primary text-success').addClass('text-danger');
          $('#rfid_status_text').removeClass('text-muted text-primary text-success').addClass('text-danger');
          break;
        default:
          $('#rfid_status i').removeClass('text-primary text-success text-danger').addClass('text-muted');
          $('#rfid_status_text').removeClass('text-primary text-success text-danger').addClass('text-muted');
      }
    }

    function findStudentByRFID(rfid) {
      let found = false;
      $('#siswa_id option').each(function() {
        let optionRfid = $(this).data('rfid');
        if (optionRfid && optionRfid.toString() === rfid.toString()) {
          let option = $(this);
          let studentId = option.val();
          let studentName = option.data('nama');
          let studentNis = option.data('nis');
          let studentKelas = option.data('kelas');
          let studentPoints = option.data('points');
          
          // Set the selected student
          $('#siswa_id').val(studentId).trigger('change');
          
          // Update student info display
          $('#student_name').text(studentName);
          $('#student_nis').text(studentNis);
          $('#student_kelas').text(studentKelas);
          $('#student_points').text(studentPoints);
          $('#student_info_section').show();
          
          // Update RFID status
          updateRFIDStatus('success', 'Siswa ditemukan!', 'ti ti-user-check');
          
          // Play success sound (if available)
          playSound('success');
          
          // Auto focus to jenis poin
          setTimeout(() => {
            $('#jenis_pelanggaran_id').select2('open');
          }, 500);
          
          found = true;
          return false; // Break the loop
        }
      });
      
      if (!found) {
        updateRFIDStatus('error', 'RFID tidak ditemukan', 'ti ti-user-x');
        playSound('error');
        
        // Clear student info
        $('#student_info_section').hide();
        $('#siswa_id').val('').trigger('change');
      }
      
      return found;
    }

    function playSound(type) {
      // Create audio context for sound feedback
      try {
        const audioContext = new (window.AudioContext || window.webkitAudioContext)();
        const oscillator = audioContext.createOscillator();
        const gainNode = audioContext.createGain();
        
        oscillator.connect(gainNode);
        gainNode.connect(audioContext.destination);
        
        if (type === 'success') {
          // Success sound: ascending tone
          oscillator.frequency.setValueAtTime(800, audioContext.currentTime);
          oscillator.frequency.setValueAtTime(1000, audioContext.currentTime + 0.1);
          gainNode.gain.setValueAtTime(0.3, audioContext.currentTime);
          gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.2);
          oscillator.start(audioContext.currentTime);
          oscillator.stop(audioContext.currentTime + 0.2);
        } else if (type === 'error') {
          // Error sound: descending tone
          oscillator.frequency.setValueAtTime(400, audioContext.currentTime);
          oscillator.frequency.setValueAtTime(200, audioContext.currentTime + 0.1);
          gainNode.gain.setValueAtTime(0.3, audioContext.currentTime);
          gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.2);
          oscillator.start(audioContext.currentTime);
          oscillator.stop(audioContext.currentTime + 0.2);
        }
      } catch (e) {
        // Fallback: no sound if audio context is not supported
        console.log('Audio not supported');
      }
    }

    // RFID Input Handler
    $('#rfid_input').on('input', function() {
      let rfid = $(this).val().trim();
      
      if (rfid.length > 0) {
        updateRFIDStatus('scanning', 'Mencari siswa...', 'ti ti-loader-2 spin');
        
        // Clear previous timeout
        if (rfidScanTimeout) {
          clearTimeout(rfidScanTimeout);
        }
        
        // Set timeout for scanning (simulate RFID scanner behavior)
        rfidScanTimeout = setTimeout(() => {
          findStudentByRFID(rfid);
        }, 300);
      } else {
        updateRFIDStatus('', 'Siap untuk scan');
        $('#student_info_section').hide();
        $('#siswa_id').val('').trigger('change');
      }
    });

    // Clear RFID button
    $('#clear_rfid').on('click', function() {
      $('#rfid_input').val('').focus();
      updateRFIDStatus('', 'Siap untuk scan');
      $('#student_info_section').hide();
      $('#siswa_id').val('').trigger('change');
    });

    // Auto focus RFID input on page load
    $('#rfid_input').focus();

    // Keyboard shortcuts
    $(document).on('keydown', function(e) {
      // F1: Focus RFID input
      if (e.key === 'F1') {
        e.preventDefault();
        $('#rfid_input').focus().select();
      }
      
      // F2: Focus jenis poin
      if (e.key === 'F2') {
        e.preventDefault();
        $('#jenis_pelanggaran_id').select2('open');
      }
      
      // F3: Focus keterangan
      if (e.key === 'F3') {
        e.preventDefault();
        $('#keterangan').focus();
      }
      
      // Ctrl+Enter: Submit form
      if (e.ctrlKey && e.key === 'Enter') {
        e.preventDefault();
        if ($('#siswa_id').val() && $('#jenis_pelanggaran_id').val()) {
          $('#formTambahInputPelanggaran').submit();
        }
      }
    });

    // Handle siswa dropdown change
    $('#siswa_id').on('change', function() {
      let selectedOption = $(this).find('option:selected');
      if (selectedOption.val()) {
        let studentName = selectedOption.data('nama');
        let studentNis = selectedOption.data('nis');
        let studentKelas = selectedOption.data('kelas');
        let studentPoints = selectedOption.data('points');
        
        // Update student info display
        $('#student_name').text(studentName);
        $('#student_nis').text(studentNis);
        $('#student_kelas').text(studentKelas);
        $('#student_points').text(studentPoints);
        $('#student_info_section').show();
        
        // Update RFID input if it matches
        let rfid = selectedOption.data('rfid');
        if (rfid) {
          $('#rfid_input').val(rfid);
          updateRFIDStatus('success', 'Siswa dipilih', 'ti ti-user-check');
        }
      } else {
        $('#student_info_section').hide();
        $('#rfid_input').val('');
        updateRFIDStatus('', 'Siap untuk scan');
      }
    });

    // Initialize select2 for jenis poin dropdown with search
    $('#jenis_pelanggaran_id').select2({
      placeholder: 'Jenis Poin...',
      allowClear: true,
      width: '100%',
      matcher: function(params, data) {
        // If there are no search terms, return all data
        if ($.trim(params.term) === '') {
          return data;
        }

        // Do not display the item if there is no 'text' property
        if (typeof data.text === 'undefined') {
          return null;
        }

        // Search in kode, nama, and kategori
        let searchTerm = params.term.toLowerCase();
        let kode = data.element.getAttribute('data-kode') || '';
        let nama = data.element.getAttribute('data-nama') || '';
        let kategori = data.element.getAttribute('data-kategori') || '';
        
        if (kode.toLowerCase().indexOf(searchTerm) > -1 || 
            nama.toLowerCase().indexOf(searchTerm) > -1 || 
            kategori.toLowerCase().indexOf(searchTerm) > -1) {
          return data;
        }

        // Return null if the term should not be displayed
        return null;
      }
    });

    // Add preview section for point change
    let previewHtml = `
      <div class="mb-3" id="preview-section" style="display: none;">
        <div class="alert alert-info">
          <h6 class="mb-2"><i class="ti ti-info-circle me-1"></i> Preview Perubahan Poin</h6>
          <div id="preview-content"></div>
        </div>
      </div>
    `;
    $('#jenis_pelanggaran_id').closest('.mb-3').after(previewHtml);

    // Handle jenis poin change to show preview
    $('#jenis_pelanggaran_id').on('change', function() {
      let selectedOption = $(this).find('option:selected');
      let poin = selectedOption.data('poin');
      let kategori = selectedOption.data('kategori');
      let nama = selectedOption.text();
      
      if (poin !== undefined && poin !== null) {
        let poinChange = poin > 0 ? `+${poin}` : poin;
        let poinType = poin > 0 ? 'Penghargaan' : 'Pelanggaran';
        let colorClass = poin > 0 ? 'text-success' : 'text-danger';
        let icon = poin > 0 ? 'ti ti-arrow-up' : 'ti ti-arrow-down';
        
        let previewContent = `
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <strong>${nama}</strong><br>
              <small class="text-muted">Kategori: ${kategori}</small>
            </div>
            <div class="text-end">
              <span class="badge ${poin > 0 ? 'bg-success' : 'bg-danger'} fs-6">
                <i class="${icon} me-1"></i>${poinChange} poin
              </span><br>
              <small class="${colorClass}">${poinType}</small>
            </div>
          </div>
        `;
        
        $('#preview-content').html(previewContent);
        $('#preview-section').show();
      } else {
        $('#preview-section').hide();
      }
    });

    // Reset form
    function resetForm() {
      $('#siswa_id').val('').trigger('change');
      $('#jenis_pelanggaran_id').val('').trigger('change');
      $('#keterangan').val('');
      $('#preview-section').hide();
    }

    // Submit form
    $('#formTambahInputPelanggaran').on('submit', function(e) {
      e.preventDefault();

      let form = $(this);
      let formData = form.serialize();
      let actionUrl = form.attr('action');

      // Show loading
      let submitBtn = form.find('button[type="submit"]');
      let originalText = submitBtn.html();
      submitBtn.html('<i class="ti ti-loader-2 spin me-1"></i>Menyimpan...').prop('disabled', true);

      $.ajax({
        url: actionUrl,
        type: "POST",
        data: formData,
        success: function(response) {
          if (response.success) {
            Swal.fire({
              icon: 'success',
              title: 'Berhasil!',
              text: 'Data poin berhasil disimpan',
              showConfirmButton: false,
              timer: 2000
            }).then(() => {
              resetForm();
              location.reload();
            });
          }
        },
        error: function(xhr) {
          if (xhr.status === 422) {
            let errors = xhr.responseJSON.errors;
            let pesan = '';
            $.each(errors, function(key, value) {
              pesan += value[0] + "\n";
            });
            Swal.fire({
              icon: 'error',
              title: 'Validasi gagal',
              text: pesan
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Gagal!',
              text: 'Terjadi kesalahan server'
            });
          }
        },
        complete: function() {
          // Reset button
          submitBtn.html(originalText).prop('disabled', false);
        }
      });
    });

    // Initial reset
    resetForm();

    // Add keyboard shortcuts help
    let shortcutsHelp = `
      <div class="keyboard-shortcuts" id="shortcuts-help">
        <h6>Keyboard Shortcuts</h6>
        <div class="shortcut">
          <span>RFID Scanner</span>
          <kbd>F1</kbd>
        </div>
        <div class="shortcut">
          <span>Jenis Poin</span>
          <kbd>F2</kbd>
        </div>
        <div class="shortcut">
          <span>Keterangan</span>
          <kbd>F3</kbd>
        </div>
        <div class="shortcut">
          <span>Submit</span>
          <kbd>Ctrl+Enter</kbd>
        </div>
        <div class="shortcut">
          <span>Toggle Help</span>
          <kbd>F12</kbd>
        </div>
      </div>
    `;
    $('body').append(shortcutsHelp);

    // Toggle shortcuts help
    $(document).on('keydown', function(e) {
      if (e.key === 'F12') {
        e.preventDefault();
        $('#shortcuts-help').toggle();
      }
    });

    // Hide shortcuts help initially
    $('#shortcuts-help').hide();

    // Show shortcuts help on first load
    setTimeout(() => {
      $('#shortcuts-help').fadeIn();
      setTimeout(() => {
        $('#shortcuts-help').fadeOut();
      }, 5000);
    }, 2000);
  });
</script>

@endsection