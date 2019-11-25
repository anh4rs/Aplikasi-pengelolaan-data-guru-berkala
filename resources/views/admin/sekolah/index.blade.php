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
              <h3 class="mb-0">Card tables</h3>
              <div class="text-right">
              <button class="btn btn-icon btn-sm btn-info" type="button">
	            <span class="btn-inner--icon"><i class="ni ni-cloud-download-95"></i></span>
                <span class="btn-inner--text">Cetak Laporan</span>
              </button>
              <button class="btn btn-icon btn-sm btn-primary" type="button">
	            <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                <span class="btn-inner--text">Tambah Data</span>
              </button>
              </div>
            </div>
            <div class="table-responsive">
              <table id="datatable" class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Kategori</th>
                    <th scope="col">Nama Sekolah</th>
                    <th scope="col">Status</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                   <td>Seklah Menengah Atas</td>
                    <td>
                      SMAN 2 BANJARBARU
                    </td>
                    <td>
                      <span class="badge badge-dot mr-4">
                        <i class="bg-success"></i> Negeri
                      </span>
                    </td>
                    <td>
                     Jl.Mentaos Banjarbaru
                    </td>
                    <td>
                    <button class="btn btn-sm  btn-success" type="button">
	                    <span class="btn-inner--icon">detail</span>
                    </button>
                    <button class="btn btn-sm  btn-primary" type="button">
	                    <span class="btn-inner--icon">edit</span>
                    </button>
                    <button class="btn btn-sm btn-danger" type="button">
	                    <span class="btn-inner--icon">hapus</span>
                    </button>
                    </td>
                  </tr>
                  <tr>
                   <td>Seklah Menengah Atas</td>
                    <td>
                      SMAN KANAAN
                    </td>
                    <td>
                      <span class="badge badge-dot mr-4">
                        <i class="bg-success"></i> Negeri
                      </span>
                    </td>
                    <td>
                     Jl.Mentaos Banjarbaru
                    </td>
                    <td>
                    <button class="btn btn-sm  btn-success" type="button">
	                    <span class="btn-inner--icon">detail</span>
                    </button>
                    <button class="btn btn-sm  btn-primary" type="button">
	                    <span class="btn-inner--icon">edit</span>
                    </button>
                    <button class="btn btn-sm btn-danger" type="button">
	                    <span class="btn-inner--icon">hapus</span>
                    </button>
                    </td>
                  </tr>
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
$(document).ready(function() {
    $('#datatable').DataTable();
} );
</script>
@endsection