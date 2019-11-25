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
              <h3 class="mb-0">Tabel Data Jabatan</h3>
              <div class="text-right">
              <button class="btn btn-icon btn-sm btn-outline-info" type="button">
	            <span class="btn-inner--icon"><i class="ni ni-cloud-download-95"></i></span>
                <span class="btn-inner--text">Cetak Laporan</span>
              </button>
              <button class="btn btn-icon btn-sm btn-outline-primary" id="tambah" type="button" >
	            <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                <span class="btn-inner--text">Tambah Data</span>
              </button>
              </div>
            </div>
            <div class="table-responsive">
              <table id="datatable" class="table align-items-center table-flush text-center">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Kode Jabatan</th>
                    <th scope="col">Nama Jabatan</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                   <td>K218</td>
                    <td>
                      Bendahara Perencanaan Keudangan
                    </td>
                    <td>
                    <button class="btn btn-sm  btn-outline-success" type="button">
	                    <span class="btn-inner--icon">detail</span>
                    </button>
                    <button class="btn btn-sm  btn-outline-primary" type="button">
	                    <span class="btn-inner--icon">edit</span>
                    </button>
                    <button class="btn btn-sm btn-outline-danger" type="button">
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
      <div class="modal fade" id="mediumModal"  role="dialog" aria-labelledby="modal-default" >
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
        	
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>    
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="golongan">Kode Jabatan</label>
                        <input type="text" class="form-control" name="kd_jabatan" id="golongan">
                    </div>
                    <div class="form-group">
                        <label for="golongan">Nama Jabatan</label>
                        <input type="text" class="form-control" name="nama_jabatan" id="keterangan">
                    </div>
                </form> 
            </div>   
            <div class="modal-footer">
                <button type="button" class="btn btn-link " data-dismiss="modal">Close</button> 
                <button type="button" id="btn-form" class="btn btn-primary"></button>
            </div>
            
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
$(document).ready(function() {
    $('#datatable').DataTable();
} );
$('#tambah').click(function(){
    $('.modal-title').text('Tambah Data');
    $('#btn-form').text('Simpan Data');
    $('#mediumModal').modal('show');
});
</script>
@endsection