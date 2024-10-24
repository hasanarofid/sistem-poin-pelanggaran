      <!-- Edit User Modal -->
      <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
          <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              <div class="text-center mb-4">
                <h3 class="mb-2">Tambah data Pelaporan</h3>
                <p class="text-muted">Inputkan data Pelaporan anda</p>
              </div>
              <form id="add_laporan" class="row g-3"  action="{{ route('pengawas.pelaporan.save-pelaporan') }}" method="POST" enctype="multipart/form-data">
                @csrf
               
                <div class="col-12 col-md-6">
                    <label class="form-label" for="basic-default-name">Kategori Program </label>
                    <select
                          id="kategoriprogram_id"
                          name="kategoriprogram_id"
                          class="select2 form-select"
                          onchange="pilihKategory(this)"
                          required
                          >
                          <option value="">Select</option>
                          @foreach ($kategory as $item)
                              <option value="{{ $item->id }}">{{ $item->nama }}</option>
                          @endforeach
                        </select>
                </div>

                <div class="col-12 col-md-6">
                  <label class="form-label" for="basic-default-name">Sub Kategori </label>
                  <select
                        id="sub_kategori"
                        name="sub_kategori"
                        class="select2 form-select"
                        onchange="pilihSubKategory(this)"
                        required
                        >
                        <option value="">Select</option>
                        @foreach ($subkategory as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                      </select>
              </div>
    
               
              
              
    
                <div class="col-12 col-md-4">
                  <label class="form-label" for="basic-default-name">Sasaran Laporan </label>
                  <select
                        id="sasaran"
                        name="sasaran"
                        class="select2 form-select"
                        onchange="pilihSasaran(this)"
                        required
                        >
                        @php
                            $sasaran = [
                    'Sekolah'=>'Sekolah',
                    'Guru'=>'Guru',
                    'Kepala Sekolah'=>'Kepala Sekolah',
                ];
                        @endphp
                        <option value="">Pilih</option>
                        @foreach ($sasaran as $key=>$item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                      </select>
                </div>
    
                <div class="col-12 col-md-4">
                  <label class="form-label" for="basic-default-name">Object Sasaran </label>
                  <select
                        id="object_sasaran"
                        name="object_sasaran"
                        class="select2 form-select"
                        required
                        >
                        <option value="">Select</option>
                        
                      </select>
                </div>
    
                <div class="col-12 col-md-4">
                  <label class="form-label" for="basic-default-name">Tanggal Pendampingan </label>
                  <input type="date" name="tgl_pendampingan" id="tgl_pendampingan" class="form-control" required>
                </div>
    
    
                <div class="col-12">
                  <label class="form-label" for="judul">Judul Laporan </label>
                  <input type="text" name="judul" id="judul_edit" class="form-control" required>
                </div>
    
    
                  <div class="col-12">
                    <label class="form-label" for="deskripsi_permasalahan">Deskripsikan permasalahan </label>
                    <textarea id="deskripsi_permasalahan" name="deskripsi_permasalahan" class="form-control"></textarea>
                </div>
    
                <div class="col-12">
                    <label class="form-label" for="uraian">Target capaian</label>
                    <textarea id="target_capaian" name="target_capaian" class="form-control"></textarea>
                </div>
    
                <div class="col-12">
                  <label class="form-label" for="uraian">Catatan dan Evaluasi</label>
                  <textarea id="catatan_evaluasi" name="catatan_evaluasi" class="form-control"></textarea>
                </div>
    
                <div class="col-12">
                  <label class="form-label" for="uraian">Saran dan Rekomendasi</label>
                  <textarea id="saran_rekomendasi" name="saran_rekomendasi" class="form-control"></textarea>
                </div>
    
                <div class="col-12">
                    <label class="form-label" for="basic-default-name">Lampiran (doc/xls/pdf) </label>
                    <input type="file" name="lampiran" id="lampiran" class="form-control" accept=".doc,.xls,.pdf" required>
                  </div>
    
                
                
                    <div class="col-12 text-center">
                  <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                  <button
                    type="reset"
                    class="btn btn-label-secondary"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                    Cancel
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!--/ Edit User Modal -->


