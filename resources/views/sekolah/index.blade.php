@extends('layouts.sekolah')
@section('content')    
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->

          <h1 class="text-white" >Selamat Datang Admin Sekolah {{ Auth::user()->name }}</h1>
        </div>
      </div>
    </div>
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-8 mb-5 mb-xl-0">
          <div class="card bg-gradient-default shadow">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h6 class="text-uppercase text-light ls-1 mb-1">Guru</h6>
                  <h2 class="text-white mb-0">jumlah Guru</h2>
                  <h4 class="text-white mb-0">{{$sekolah->guru->count()}} Orang</h4>
                  <br>
                  <p></p>
                </div>
              </div>
            </div>
            <div class="card-body">
              <!-- Chart -->
            </div>
          </div>
        </div>
        <div class="col-xl-4">
          <div class="card shadow">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h6 class="text-uppercase text-muted ls-1 mb-1">Data Berkala</h6>
                  <h2 class="mb-0">Riwayat Berkala</h2>
                  <h1 class="text-success" >{{$data->count()}}<small> Data Berkala</small></h1> 
                  <p></p>
                </div>
              </div>
            </div>
            <div class="card-body">
              <!-- Chart -->
            
            </div>
          </div>
        </div>
      </div style="margin-bottom:300px">
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
@endsection
