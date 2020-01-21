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
              <h3 class="mb-0">Tabel data Gajih berkala</h3>
              <div class="text-right">
              <a href="{{Route('golonganCetak')}}" class="btn btn-icon btn-sm btn-outline-info"><span class="btn-inner--icon"><i class="ni ni-cloud-download-95"></i></span>
                <span class="btn-inner--text">Cetak Daftar Gaji</span></a>
              </div>
            </div>
            <div class="table-responsive">
              <table id="datatable" class="table align-items-center table-striped text-center">
                <thead class="thead-light">
                  <tr>
                    <th cope="col">No</th>
                    <th scope="col"> gologan</th>
                    <th scope="col">MKG </th>
                    <th scope="col">Besaran Gaji </th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <br>
      <br>
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
                    ajax: {
                        "type": "GET",
                        "url": "{{route('API.gaji-sekolah.get')}}",
                        "dataSrc": "data",
                        "contentType": "application/json; charset=utf-8",
                        "dataType": "json",
                        "processData": true
                    },
                    columns: [
                        {data: null , render : function ( data, type, row, meta ) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }},
                        {"data": "golongan.kode_golongan"},
                        {data: null , render : function ( data, type, row, meta ) {
                           return '<p> '+row.mkg+' tahun </p>'
                        }},                        
                        {data: null , render : function ( data, type, row, meta ) {
                           return '<p> Rp.'+row.besaran_gaji+'</p>'
                        }}
                    ]
                });

                } );
    </script>
@endsection