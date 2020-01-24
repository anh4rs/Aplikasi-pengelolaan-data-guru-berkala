@extends('layouts.sekolah')
@section('content')    
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
      </div>
    </div>
    <div class="container-fluid mt--9">
      <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow" style="padding:10px;">
            <div class="card-header border-0">
              <h3 class="mb-0">Profil Sekolah</h3>
            </div>
           <div class="card-body">
           <div class="table-responsive">
              <table class="table">
                <tr>
                  <td>Nama Sekolah</td>
                  <td>: {{$sekolah->nama}}</td>
                </tr>
                <tr>
                  <td>NPSN</td>
                  <td>: {{$sekolah->NPSN}}</td>
                </tr>                
                <tr>
                  <td>Status sekolah</td>
                  <td>: {{$sekolah->status_sekolah}}</td>
                </tr>
                <tr>
                  <td>Tingkat Pendidikan</td>
                  <td>: {{$sekolah->b_pendidikan}}</td>
                </tr>                
                <tr>
                  <td>Status Kepemilikan</td>
                  <td>: {{$sekolah->status_pemilik}}</td>
                </tr>
                <tr>
                  <td>No SK</td>
                  <td>: {{$sekolah->sk}}</td>
                </tr>                
                <tr>
                  <td>Tanggal SK</td>
                  <td>: {{$sekolah->tgl_sk}}</td>
                </tr>
                <tr>
                  <td>SK Izin</td>
                  <td>: {{$sekolah->sk_izin}}</td>
                </tr>                <tr>
                  <td>Tanggal SK Izin</td>
                  <td>: {{$sekolah->tgl_sk_izin}}</td>
                </tr>
              </table>
            </div>
           </div>
           <div class="card-footer">

           </div>

          </div>
        </div>
      </div>
      <br>
      <br>
@endsection
@section('script')
   
@endsection