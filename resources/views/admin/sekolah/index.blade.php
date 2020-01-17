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
              <h3 class="mb-0">Tabel Data</h3>
              <div class="text-right"> 
              <a href="{{Route('sekolahKeseluruhanCetak')}}" class="btn btn-icon btn-sm btn-outline-info"><span class="btn-inner--icon"><i class="ni ni-cloud-download-95"></i></span>
                <span class="btn-inner--text">Cetak Laporan</span></a>
              <button class="btn btn-icon btn-sm btn-outline-primary" id="tambah" type="button" >
	            <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                <span class="btn-inner--text">Tambah Data</span>
              </button>
              </div>
            </div>
            <div class="table-responsive">
              <table id="datatable" class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">npsn</th>
                    <th scope="col">Status</th>
                    <th scope="col">Bentuk pendidikan</th>
                    <th scope="col">nomor SK</th>
                    <th scope="col">Status Pemilik</th>
                    <th scope="col">No SK Izin</th>
                    <th scope="col">Aksi</th>
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
                <input type="hidden" name="id" id="id">
                <div class="form-group">
                        <label for="sekolah">Nama Sekolah</label>
                        <input type="text" class="form-control" name="nama" id="nama">
                    </div>
                    <div class="form-group">
                        <label for="sekolah">NPSN</label>
                        <input type="text" class="form-control" name="NPSN" id="NPSN">
                    </div>
                    <div class="form-group">
                        <label for="sekolah">Status</label>
                        <select name="status_sekolah" class="form-control" id="status_sekolah">
                          <option value="">-- pilih status --</option>
                          <option value="Negeri">Negeri</option>
                          <option value="Swasta">Swasta</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="id" id="id">
                        <label for="sekolah">Bentuk Pendidikan</label>
                        <select name="b_pendidikan" id="b_pendidikan" class="form-control">
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA">SMA</option>
                            <option value="SMK">SMK</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sekolah">Status Pemilik</label>
                        <select name="status_pemilik" class="form-control" id="status_pemilik">
                          <option value="">-- pilih status pemilik--</option>
                          <option value="Negeri">Negeri</option>
                          <option value="Perseorangan">Perseorangan</option>
                          <option value="Yayasan">Yayasan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sekolah">Nomor SK</label>
                        <input type="text" class="form-control" name="sk" id="sk">
                    </div>
                    <div class="form-group">
                        <label for="sekolah">Tanggal SK</label>
                        <input type="date" class="form-control" name="tgl_sk" id="tgl_sk">
                    </div>
                    <div class="form-group">
                        <label for="sekolah"> SK Izin</label>
                        <input type="text" class="form-control" name="sk_izin" id="sk_izin">
                    </div>
                    <div class="form-group">
                        <label for="sekolah">Tanggal SK Izin</label>
                        <input type="date" class="form-control" name="tgl_sk_izin" id="tgl_sk_izin">
                    </div>
                    <div class="form-group">
                        <label for="sekolah"> Username</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>                    
                    <div class="form-group">
                        <label for="sekolah"> Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>                    
                    <div class="form-group">
                        <label for="sekolah"> Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
            </div>   
            <div class="modal-footer">
                <button type="button" class="btn btn-link " data-dismiss="modal">Close</button> 
                <button type="submit" id="btn-form" class="btn btn-primary"></button>
            </div>
        </form> 
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        //fungsi hapus
        hapus = (uuid, nama)=>{
            let csrf_token=$('meta[name="csrf_token"]').attr('content');
            Swal.fire({
                        title: 'apa anda yakin?',
                        text: " Menghapus  Data sekolah " + nama,
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'hapus data',
                        cancelButtonText: 'batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                url : "{{ url('/api/sekolah')}}" + '/' + uuid,
                                type : "POST",
                                data : {'_method' : 'DELETE', '_token' :csrf_token},
                                success: function (response) {
                                    Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Data Berhasil Dihapus',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            $('#datatable').DataTable().ajax.reload(null, false);
                        },
                    })
                    } else if (result.dismiss === swal.DismissReason.cancel) {
                        Swal.fire(
                        'Dibatalkan',
                        'data batal dihapus',
                        'error'
                        )
                    }
                })
            }
    
            //event btn tambah klik
            $('#tambah').click(function(){
                $('.modal-title').text('Tambah Data');
                $('#nama').val('');
                $('#NPSN').val('');
                $('#status').val('');
                $('#b_pendidikan').val('');  
                $('#status_pemilik').val('');  
                $('#sk').val('');
                $('#tgl_sk').val('');    
                $('#sk_izin').val('');
                $('#tgl_sk_izin').val('');                
                $('#btn-form').text('Simpan Data');
                $('#mediumModal').modal('show');
            })
            //event btn edit klik         
            edit = uuid =>{
                $.ajax({
                    type: "GET",
                    url: "{{ url('/api/sekolah')}}" + '/' + uuid,
                    beforeSend: false,
                    success : function(returnData) {
                        $('.modal-title').text('Edit Data');
                        $('#id').val(returnData.data.uuid);
                        $('#nama').val(returnData.data.nama);
                        $('#NPSN').val(returnData.data.NPSN);
                        $('#status').val(returnData.data.status_sekolah);
                        $('#b_pendidikan').val(returnData.data.b_pendidikan); 
                        $('#status_pemilik').val(returnData.data.status_pemilik);
                        $('#sk').val(returnData.data.sk);
                        $('#tgl_sk').val(returnData.data.tgl_sk); 
                        $('#sk_izin').val(returnData.data.sk_izin);
                        $('#tgl_sk_izin').val(returnData.data.tgl_sk_izin);   
                        $('#name').val(returnData.data.user.name);   
                        $('#email').val(returnData.data.user.email);
                        $('#btn-form').text('Ubah Data');
                        $('#mediumModal').modal('show');
                    }
                })
            }

            //fungsi render datatable
            $(document).ready(function() {
                $('#datatable').DataTable( {
                    responsive: true,
                    processing: true,
                    serverSide: false,
                    searching: true,
                    ajax: {
                        "type": "GET",
                        "url": "{{route('API.sekolah.get')}}",
                        "dataSrc": "data",
                        "contentType": "application/json; charset=utf-8",
                        "dataType": "json",
                        "processData": true
                    },
                    columns: [
                        {data: null , render : function ( data, type, row, meta ) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }},
                        {"data": "nama"},
                        {"data": "NPSN"},
                        {"data": "status_sekolah"},
                        {"data": "b_pendidikan"},
                        {"data": "status_pemilik"},
                        {"data": "sk"},
                        {"data": "sk_izin"},
                        {data: null , render : function ( data, type, row, meta ) {
                            let uuid = row.uuid;
                            let nama = row.NPSN;
                            return type === 'display'  ?
                            '<button onClick="edit(\''+uuid+'\')" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editmodal"><i class="ti-pencil"></i> Edit</button> <button onClick="hapus(\'' + uuid + '\',\'' + nama + '\')" class="btn btn-sm btn-outline-danger" > <i class="ti-trash"></i>Hapus</button>':
                        data;
                        }}
                    ]
                });

                //event form submit
                $("form").submit(function (e) {
                    e.preventDefault()
                    let form = $('#modal-body form');
                    if($('.modal-title').text() == 'Edit Data'){
                        let url = '{{route("API.sekolah.update", '')}}'
                        let id = $('#id').val();
                        $.ajax({
                            url: url+'/'+id,
                            type: "put",
                            data: $(this).serialize(),
                            success: function (response) {
                                form.trigger('reset');
                                $('#mediumModal').modal('hide');
                                $('#datatable').DataTable().ajax.reload();
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Data Berhasil Tersimpan',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            },
                            error:function(response){
                                console.log(response);
                            }
                        })
                    }else{
                        $.ajax({
                            url: "{{Route('API.sekolah.create')}}",
                            type: "post",
                            data: $(this).serialize(),
                            success: function (response) {
                                form.trigger('reset');
                                $('#mediumModal').modal('hide');
                                $('#datatable').DataTable().ajax.reload();
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Data Berhasil Disimpan',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            },
                            error:function(response){
                                console.log(response);
                            }
                        })
                    }
                } );
                } );
    </script>
@endsection