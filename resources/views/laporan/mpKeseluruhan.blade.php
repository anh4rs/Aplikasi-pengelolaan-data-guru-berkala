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
        border: 1px solid #708090;
      }
      th{
        background-color: darkslategray;
        text-align: center;
        color: aliceblue;
      }
      td{
        text-align: center;
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
                    <img  class="pemko" src="img/logo.png"  >
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
        <h2 style="text-align:center;text-transform: uppercase;">DATA JABATAN MATA PELAJARAN</h2>
                <table  class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Mata Pelajaran</th>
                                <th>Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mata_pelajaran as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->kode_mp }}</td>
                                <td>{{ $p->nama }}</td>
                            </tr>
                            @endforeach
                        </tfoot>
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
