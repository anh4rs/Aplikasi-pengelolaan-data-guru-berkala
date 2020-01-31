<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{
        }
          table{
        border-collapse: collapse;
        width:100%;
      }
         table, th, td{
      }
      th{
        background-color: darkslategray;
        text-align: center;
        color: aliceblue;
      }
      td{
      }
      br{
          margin-bottom: 5px !important;
      }
     .judul{
         text-align: center;
     }
     .header{
         margin-bottom: 0px;
         text-align: center;
         height: 150px;
         padding: 0px;
     }
     .pemko{
         width:70px;
     }
     .logo{
         float: left;
         margin-right: 0px;
         width: 15%;
         padding:0px;
         text-align: right;
     }
     .headtext{
         float:right;
         margin-left: 0px;
         width: 75%;
         padding-left:0px;
         padding-right:10%;
     }
     hr{
         margin-top: 10%;
         height: 3px;
         background-color: black;
     }
     .ttd{
         margin-left:70%;
         text-align: center;
         text-transform: uppercase;
     }
    </style>
</head>
<body>
    <div class="header">
            <div class="logo">
                    <img  class="pemko" src="img/logo.png" " >
            </div>
            <div class="headtext">
                <h3 style="margin:0px;">PEMERINTAH KABUPATEN TAPIN</h3>
                <h1 style="margin:0px;">DINAS PENDIDIKAN</h1>
                <p style="margin:0px;">Alamat : Jl.Brigjend H.Hasan Baseri Km. 2  (0517) 31040 Fax. 31046 Rantau</p>
            </div>
            <hr>
    </div>
    <div class="container">
        <div class="isi">
        <h2 style="text-align:center;text-transform: uppercase;">DETAIL PERMOHONAN</h2>
        <table class="table">
                        <tr>
                            <td>Guru</td>
                            <td>: {{$permohonan->guru->nama}}</td>
                        </tr>
                        <tr>
                            <td>Pejabat Struktural</td>
                            <td>: {{$permohonan->pejabat_struktural->nama}}</td>
                        </tr>
                        <tr>
                            <td>Nomor Surat</td>
                            <td>: {{$permohonan->nomor_surat}}</td>
                        </tr>
                        <tr>
                            <td>Lampiran</td>
                            <td>: {{$permohonan->lampiran}}</td>
                        </tr>
                        <tr>
                            <td>Perihal</td>
                            <td>: {{$permohonan->perihal}}</td>
                        </tr>
                        <tr>
                            <td>Gajih Lama</td>
                            <td>: Rp.{{$permohonan->gaji_lama}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Keputusan</td>
                            <td>: {{$permohonan->tgl_keputusan}}</td>
                        </tr>
                        <tr>
                            <td>Nomor Keputusan</td>
                            <td>: {{$permohonan->no_keputusan}}</td>
                        </tr>                        <tr>
                            <td>Tanggal Keputusan</td>
                            <td>: {{$permohonan->tgl_keputusan}}</td>
                        </tr>
                        </tr>                        
                        <tr>
                            <td>MKG pada tanggal tersebut</td>
                            <td>: {{$permohonan->mkg}}</td>
                        </tr>
                        <tr>
                            <td>Gajih Baru</td>
                            <td>: Rp.{{$permohonan->gaji_baru}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Gjih berlaku</td>
                            <td>: {{$permohonan->tgl_gaji_berlaku}}</td>
                        </tr>
                        <tr>
                            <td>Kenaikan Gajih Berikutnya</td>
                            <td>: {{$permohonan->tgl_gaji_berikut}}</td>
                        </tr>
                        <tr>
                            <td>Status Permohonan</td>
                            <td> : 
                                @if($permohonan->status == 0)
                                    <label style="color:blue;"class="btn btn-sm btn-warning" for="">Pending</label>
                                @elseif($permohonan->status == 1)
                                    <label style="color:green;" class="btn btn-sm btn-success" for="">Terverifikasi</label>
                                @else
                                    <label style="color:red;" class="btn btn-sm btn-danger" for="">Ditolak</label>
                                @endif
                            </td>
                        </tr>
                    </table>    
                      <br>
                      <br>
                      <div class="ttd">
                        <h5> <p>Tapin, {{$tgl}}</p></h5>
                        <h5>{{ $pejabat_struktural->jabatan }}</h5>
                        <br>
                        <br>
                        <h5 style="text-decoration:underline;">{{ $pejabat_struktural->nama }}</h5>
                        <h5>{{ $pejabat_struktural->golongan->golongan }} / {{ $pejabat_struktural->golongan->kode_golongan}}}</h5>
                        <h5>NIP.{{ $pejabat_struktural->NIP }}</h5>
                      </div>
                    </div>
        </div>
            </body>
</html>
