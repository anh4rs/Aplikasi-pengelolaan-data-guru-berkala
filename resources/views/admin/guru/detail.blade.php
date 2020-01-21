@extends('layouts.admin')
@section('content')
 <!-- Header -->
 <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 400px; background-image: url(/admin/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h1 class="display-2 text-white">Profil Guru</h1>
            <p class="text-white mt-0 mb-5">ini adalah halaman profil guru. anda dapat melihat data diri anda, riwayat kependidikan dan program diklat yang telah diikuti</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="{{asset('img/user/default.jpg')}}" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center mt-md-5">
             
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h3>
                  {{$guru->nama}}<span class="font-weight-light"></span>
                </h3>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i>NIP.{{$guru->NIP}}
                </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>{{$guru->jabatan->jabatan}}
                </div>
                <div>
                  <i class="ni education_hat mr-2"></i>{{$guru->sekolah->nama}}
                </div>
                <hr class="my-4" />
              </div>
            </div>
          </div>
          <br>
          <div class="card card-profile shadow">
            <div class="card-header border-0">
              <div class="text-right">
                    <a class="btn btn-sm btn-primary" href="">+ tambah data</a>
                </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
                <h3>
                  Data Pendidikan<span class="font-weight-light"></span>
                </h3>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer
                </div>
                <div>
                  <i class="ni education_hat mr-2"></i>University of Computer Science
                </div>
                <hr class="my-4" />
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Data Pribadi</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Nama</label> <br>
                        <h5 class="h5 font-weight-300">{{$guru->nama}}</h5>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">NIP</label>
                        <h5 class="h5 font-weight-300">{{$guru->NIP}}</h5>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Golongan</label>
                        <h5 class="h5 font-weight-300">{{$guru->golongan->kode_golongan}}</h5>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Jabatan</label>
                        <h5 class="h5 font-weight-300">{{$guru->jabatan->jabatan}}</h5>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Tempat, Tanggal lahir</label>
                        <h5 class="h5 font-weight-300"> {{$guru->tempat_lahir}}, {{$guru->tgl_lahir}}</h5>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Status Kepegawaian</label>
                        <h5 class="h5 font-weight-300">{{$guru->status}}</h5>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Kontak</h6>
                <div class="pl-lg-4">
                <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Telepon</label>
                        <h5 class="h5 font-weight-300">{{$guru->telepon}}</h5>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Alamat</label>
                        <h5 class="h5 font-weight-300">{{$guru->alamat}}</h5>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Description -->
                <h6 class="heading-small text-muted mb-4">Diklat</h6>
                <div class="pl-lg-4">
                  <div class="form-group">
                    <label>Tebel Diklat</label>
                    <table id="datatable" class="table align-items-center table-striped text-center">
                        <thead class="thead-light">
                            <tr>
                                <th cope="col">No</th>
                                <th scope="col">Kode gologan</th>
                                <th scope="col">Nama </th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>                  
                </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
@endsection
@section('script')
    <script>
     //fungsi render datatable
     $(document).ready(function() {
                $('#datatable').DataTable( {
                    responsive: true,
                    processing: true,
                    serverSide: false,
                    searching: true,
                });
            });
    </script>
@endsection
