@extends('layouts.pengawas.home')
@section('title', 'Profile')
@section('titelcard', 'Profile')
@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User Profile /</span> Profile</h4>
      @php
      if(Auth::user()->foto_profile == 'userdefault.jpg'){
            $foto = asset('userdefault.jpg');
        }else{
            $foto =  route('fotopengawas',Auth::user()->foto_profile );
        }
      @endphp
      <!-- Header -->
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="user-profile-header-banner">
              <img src="{{ asset('theme/assets/img/pages/profile-banner.png') }}" alt="Banner image" class="rounded-top" />
            </div>
            <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
              <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                <img
                  src="{{ $foto }}"
                  alt="user image"
                  class="d-block ms-0 ms-sm-4 rounded user-profile-img" style="height: 100px !important" />
              </div>
              <div class="flex-grow-1 mt-3 mt-sm-5">
                <div
                  class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                  <div class="user-profile-info">
                    <h4>{{ Auth::user()->name}}</h4>
                    <ul
                      class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                      <li class="list-inline-item"><i class="ti ti-color-swatch"></i> {{ Auth::user()->jenjang_jabatan }}- {{  Auth::user()->pangkat}}</li>
                      <li class="list-inline-item"><i class="ti ti-map-pin"></i> {{ App\Kabupaten::find(Auth::user()->kabupaten_id)->nama_kabupaten }}</li>
                    </ul>
                  </div>
                  <a href="{{ route('pengawas.editprofile') }}" class="btn btn-primary">
                    <i class="ti ti-user-check me-1"></i>Edit Profile
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/ Header -->

      <!-- User Profile Content -->
      <div class="row">
        <div class="col-xl-4 col-lg-5 col-md-5">
          <!-- About User -->
          <div class="card mb-4">
            <div class="card-body">
              <small class="card-text text-uppercase">About</small>
              <ul class="list-unstyled mb-4 mt-3">
                <li class="d-flex align-items-center mb-3">
                  <i class="ti ti-user"></i><span class="fw-bold mx-2">Nama Lengkap:</span> <span>{{ Auth::user()->name}}</span>
                </li>
                <li class="d-flex align-items-center mb-3">
                  <i class="ti ti-check"></i><span class="fw-bold mx-2">NIP:</span> <span>{{ Auth::user()->nip}}</span>
                </li>
                <li class="d-flex align-items-center mb-3">
                  <i class="ti ti-crown"></i><span class="fw-bold mx-2">Unit kerja:</span> <span> {{ Auth::user()->jenjang_jabatan }} - {{  Auth::user()->pangkat}} - {{ Auth::user()->gol_ruang }}</span>
                </li>
                <li class="d-flex align-items-center mb-3">
                  <i class="ti ti-flag"></i><span class="fw-bold mx-2">No Hp:</span> <span>
                    {{ App\Profile::where('user_id', Auth::user()->id)->first()->no_telp }}</span>
                </li>
                <li class="d-flex align-items-center mb-3">
                  <i class="ti ti-file-description"></i><span class="fw-bold mx-2">Homepage:</span>
                  <span>
                    @php
                    $profile = App\Profile::where('user_id', Auth::user()->id)->first();
                @endphp
            
                @if (!empty($profile->homepage))
                    <a href="{{ $profile->homepage }}" target="_blank">{{ $profile->homepage }}</a>
                @endif

             </span>
                </li>
                <li class="d-flex align-items-center mb-3">
                  <i class="ti ti-flag"></i><span class="fw-bold mx-2">Bio:</span> <span>
                    {{ !empty($profile->bio) ? $profile->bio : '' }}</span>
                </li>
              </ul>

            </div>
          </div>
          <!--/ About User -->
          <!-- Profile Overview -->
          <div class="card mb-4">
            <div class="card-body">
              <p class="card-text text-uppercase">Rencana Kerja Bulan ini</p>
              <ul class="list-unstyled mb-0">
                <li class="d-flex align-items-center mb-3">
                  <i class="ti ti-check"></i><span class="fw-bold mx-2"> Rencana:</span> <span> {{ $totalRencankerja }} </span>
                </li>
                <li class="d-flex align-items-center mb-3">
                  <i class="ti ti-layout-grid"></i><span class="fw-bold mx-2">Sekolah yang dilayani:</span>
                  <span>{{ $sekolahdilayani }}</span>
                </li>
                <li class="d-flex align-items-center">
                  <i class="ti ti-users"></i><span class="fw-bold mx-2">List Rencana Kerja:</span> 
                </li>
              </ul>
              <br>
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Program</th>
                      </tr>                  
                    </thead>
                    <tbody>
                      @php
                          $no = 1;
                      @endphp
                      @foreach ($listsekolahdilayani as $item)
                      <tr>
                        <td> {{ $no++}} </td>
                        <td> {{ $item->rencanakerja->nama_program_kerja}} </td>
                      </tr>
                      @endforeach
                    </tbody>
                 
                  
                  </table>
                </div>


            </div>
          </div>

          <div class="card mb-4">
            <div class="card-body">
              <p class="card-text text-uppercase">Daftar Sekolah Binaan Bulan Ini</p>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Sekolah</th>
                  </tr>                  
                </thead>
                <tbody>
                  @php
                      $no = 1;
                  @endphp
                  @foreach ($listsekolahdilayani as $item)
                  @php
                        $sekolahIds = explode(',', $item->rencanakerja->sekolah_id);
                        $sekolahs = App\SekolahM::whereIn('id', $sekolahIds)->get();

                  @endphp
                  @foreach ($sekolahs as $sekolah)
                  <tr>
                    <td> {{ $no++}} </td>
                    <td> {{ $sekolah->nama_sekolah}} </td>
                  </tr>
                  @endforeach                 
                  @endforeach
                </tbody>
             
              
              </table>
            </div>
          </div>
          <!--/ Profile Overview -->
        </div>
        <div class="col-xl-8 col-lg-7 col-md-7">
          <!-- Activity Timeline -->
          <div class="card card-action mb-4">
            <div class="card-header align-items-center">
              <h5 class="card-action-title mb-0">Kinerja</h5>
            </div>
            <div class="card-body pb-0">
              {{-- chart --}}


              {{-- end chart --}}
            </div>
          </div>
          <!--/ Activity Timeline -->
         
        
        </div>
      </div>
      <!--/ User Profile Content -->
    </div>
    <!-- / Content -->

    

    <div class="content-backdrop fade"></div>
  </div>
@endsection
