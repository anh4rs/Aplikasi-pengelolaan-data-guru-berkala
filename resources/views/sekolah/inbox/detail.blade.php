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
              </div>
            </div>
            <div class="card-body">
               <h1>verifikasi Permohonan</h1>
               <h5>{{$inbox->subjek}}</h5>
               <p>{{$inbox->created_at}}</p>
               <br><br><br>
               Dengan ini kami beritahukan bahwa Kami Sudah menerima Permohonan berkala dengan keterangan sebagai berikut :<br> <br>
               <table class="table table-hover">
               <tr>
               <td width="20%">Nama </td>
               <td>:{{$inbox->data_berkala->guru->nama}}</td>
               </tr>
               <tr>
               <td width="20%">Diajukan pada </td>
               <td>:{{$inbox->data_berkala->created_at}}</td>
               </tr>
               </table>
              <br>
               setelah melakukan verifikasi data maka dengan ini kami memberiyahukan bahwa permohonan tersebut telah 
               @if($inbox->status_permohonan == 1)
               <strong class="text-success">Diterima</strong>.
               @else
               <strong class="text-danger" >Ditolak</strong>.
               @endif <br> <br>
              <div class="alert alert-secondary">
              <h5>Keterangan</h5>
              <p>{{$inbox->keterangan}}</p>
              </div>
               <br> demikian pemberitahuan ini kami sampaikan terimakasih.
            </div>
            <div class=" text-right card-footer">
                <a class="btn btn-sm btn-danger" href="{{Route('inboxDelete', ['id' => $inbox->id ])}}"><i class="ti-popcorn">hapus</i></a>
            </div>
          </div>
        </div>
      </div>
      <br>
      <br>
@endsection