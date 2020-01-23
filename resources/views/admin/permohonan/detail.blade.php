@extends('layouts.admin')
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
                <h3>Detail Permohonan  / Data Berkala</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td>Guru</td>
                            <td>{{$permohonan->guru->nama}}</td>
                        </tr>
                        <tr>
                            <td>Pejabat Struktural</td>
                            <td>{{$permohonan->pejabat_struktural->nama}}</td>
                        </tr>
                        <tr>
                            <td>Nomor Surat</td>
                            <td>{{$permohonan->nomor_surat}}</td>
                        </tr>
                        <tr>
                            <td>Lampiran</td>
                            <td>{{$permohonan->lampiran}}</td>
                        </tr>
                        <tr>
                            <td>Perihal</td>
                            <td>{{$permohonan->perihal}}</td>
                        </tr>
                        <tr>
                            <td>Gajih Lama</td>
                            <td>Rp.{{$permohonan->gaji_lama}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Keputusan</td>
                            <td>{{$permohonan->tgl_keputusan}}</td>
                        </tr>
                        <tr>
                            <td>Nomor Keputusan</td>
                            <td>{{$permohonan->no_keputusan}}</td>
                        </tr>                        <tr>
                            <td>Tanggal Keputusan</td>
                            <td>{{$permohonan->tgl_keputusan}}</td>
                        </tr>
                        </tr>                        
                        <tr>
                            <td>MKG pada tanggal tersebut</td>
                            <td>{{$permohonan->mkg}}</td>
                        </tr>
                        <tr>
                            <td>Gajih Baru</td>
                            <td>Rp.{{$permohonan->gaji_baru}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Gjih berlaku</td>
                            <td>{{$permohonan->tgl_gaji_berlaku}}</td>
                        </tr>
                        <tr>
                            <td>Kenaikan Gajih Berikutnya</td>
                            <td>{{$permohonan->tgl_gaji_berikut}}</td>
                        </tr>
                        <tr>
                            <td>Status Permohonan</td>
                            <td>
                                @if($permohonan->status == 0)
                                    <label class="btn btn-sm btn-warning" for="">Pending</label>
                                @elseif($permohonan->status == 1)
                                    <label class="btn btn-sm btn-success" for="">Diterima</label>
                                @else
                                    <label class="btn btn-sm btn-danger" for="">Ditolak</label>
                                @endif
                            </td>
                        </tr>
                    </table>                 
            </div>
            <div class="card-footer text-right">
            <a href="/permohonan/detail/cetak/{{$permohonan->id}}"  class="btn">Cetak Permohonan</button>
            </div>
            </div>
          </div>
        </div>
      </div>
@endsection