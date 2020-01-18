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
              <div class="text-right"> 
              <a href="{{Route('guruKeseluruhanCetak')}}" class="btn btn-icon btn-sm btn-outline-info"><span class="btn-inner--icon"><i class="ni ni-cloud-download-95"></i></span>
                <span class="btn-inner--text">Cetak Laporan</span></a>
              <button class="btn btn-icon btn-sm btn-outline-primary" id="tambah" type="button" >
	            <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                <span class="btn-inner--text">Tambah Data</span>
              </button>
              </div>
            </div>
            <div class="card-body">
                @foreach( $inbox as $d )
                <a href="{{Route('inboxDetail',['id' => $d->id ] )}}">
                <div class="alert alert-secondary" role="alert">
                    <strong>Verifikasi Permohonan</strong> - Admin
                    <div class="text-right">
                        @if($d->status == 0)
                        <span class="badge badge-info">Belum Dibaca</span>
                        @endif
                        <p>{{$d->created_at}}</p>
                    </div>
                </div>
                </a>
                @endforeach
            </div>
          </div>
        </div>
      </div>
      <br>
      <br>
@endsection