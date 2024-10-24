
<div class="row" style="display: none">
    <div class="col-12 col-lg-12 ">
        <!-- About User -->
        <div class="card mb-4">
            <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                <div class="app-card-header p-3 border-bottom-0">
                    <div class="row align-items-center gx-3">
                        <div class="col-auto">
                            <h6 class="app-card-title">Form Pelaporan </h6>
                        </div>
                    </div>
                </div>
                <div class="app-card-body px-4 w-100">
                  <form class="browser-default-validation" method="POST" action="{{ route('pengawas.pelaporan.save-pelaporan') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-name">Nama Kegiatan</label>
                      <select
                            id="id_tugas"
                            name="id_tugas"
                            class="select2 form-select"
                            required
                            >
                            <option value="">Select</option>
                            @foreach ($kegiatan as $item)
                                <option value="{{ $item->id }}">{{ $item->tugas->kegiatan }}</option>
                            @endforeach
                          </select>
                    </div>
                    

                    <div class="mb-3">
                      <label class="form-label" for="basic-default-upload-file">Upload Foto</label>
                      <input type="file" name="foto" class="form-control" id="basic-default-upload-file" accept="image/*" required />
                    </div>
                
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-bio">Keterangan</label>
                      <textarea
                        class="form-control"
                        id="basic-default-bio"
                        name="keterangan"
                        rows="3"
                        required></textarea>
                    </div>


                    <div class="row">
                      <div class="col-12">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                    </div>
                    <br>
                  </form>
                </div>
            </div>
        </div>
        <!--/ About User -->

        <!--/ Profile Overview -->
    </div>