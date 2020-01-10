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
              <a href="{{Route('guruFilter')}}" class="btn btn-icon btn-sm btn-outline-info"><span class="btn-inner--icon"><i class="ni ni-cloud-download-95"></i></span>
                <span class="btn-inner--text">Filter Cetak</span></a> 
              <a href="{{Route('guruKeseluruhanCetak')}}" class="btn btn-icon btn-sm btn-outline-info"><span class="btn-inner--icon"><i class="ni ni-cloud-download-95"></i></span>
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
                    <th scope="col">NIP</th>
                    <th scope="col">nama</th>
                    <th scope="col">NPSN Sekolah</th>
                    <th scope="col">Telepon</th>
                    <th scope="col">Jabatan</th>
                    <th scope="col">Mata Pelajaran</th>
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
                        <label for="guru"> NIP</label>
                        <input type="text" class="form-control" name="NIP" id="NIP">
                    </div>
                    <div class="form-group">
                        <label for="guru">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama">
                    </div>
                    <div class="form-group">
                        <label for="guru">Sekolah</label>
                        <select name="sekolah_id" class="form-control" id="sekolah_id">
                          <option value="">-- pilih sekolah --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="guru">Golongan</label>
                        <select name="golongan_id" class="form-control" id="golongan_id">
                          <option value="">-- pilih golongan --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="guru">Jabatan</label>
                        <select name="jabatan_id" class="form-control" id="jabatan_id">
                          <option value="">-- pilih jabatan --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="guru">Mata Pelajaran</label>
                        <select name="mata_pelajaran_id" class="form-control" id="mata_pelajaran_id">
                          <option value="">-- Isi Jika ada  --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="guru">Status</label>
                        <select name="status" class="form-control" id="status">
                          <option value="">-- pilih Status --</option>
                          <option value="PNS">-- PNS --</option>
                          <option value="Kontrak">-- Kontrak --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="guru">Telepon</label>
                        <input type="text" class="form-control" name="telepon" id="telepon">
                    </div>
                    <div class="form-group">
                        <label for="guru">Tempat lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir">
                    </div>
                    <div class="form-group">
                        <label for="guru"> Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir">
                    </div>
                    <div class="form-group">
                        <label for="guru">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control"></textarea>
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
        //get data sekolah
        getSekolah = () =>{
            $.ajax({
                    type: "GET",
                    url: "{{ url('/api/sekolah')}}",
                    beforeSend: false,
                    success : function(returnData) {
                        $.each(returnData.data, function (index, value) {
                        $('#sekolah_id').append(
                            '<option value="'+value.uuid+'">'+value.NPSN+'</option>'
                        )
                    })
                }
            })
        }

        //get data golongan
        getGolongan = () =>{
            $.ajax({
                    type: "GET",
                    url: "{{ url('/api/golongan')}}",
                    beforeSend: false,
                    success : function(returnData) {
                        $.each(returnData.data, function (index, value) {
                        $('#golongan_id').append(
                            '<option value="'+value.uuid+'">'+value.golongan+'</option>'
                        )
                    })
                }
            })
        }

        //get data jabatan
        getJabatan = () =>{
            $.ajax({
                    type: "GET",
                    url: "{{ url('/api/jabatan')}}",
                    beforeSend: false,
                    success : function(returnData) {
                        $.each(returnData.data, function (index, value) {
                        $('#jabatan_id').append(
                            '<option value="'+value.uuid+'">'+value.jabatan+'</option>'
                        )
                    })
                }
            })
        }

        //get data mata pelajar
        getMp = () => {
            $.ajax({
                    type: "GET",
                    url: "{{ url('/api/mapel')}}",
                    beforeSend: false,
                    success : function(returnData) {
                        $.each(returnData.data, function (index, value) {
                        $('#mata_pelajaran_id').append(
                            '<option value="'+value.uuid+'">'+value.nama+'</option>'
                        )
                    })
                }
            })
        }

        getSekolah();
        getGolongan();
        getJabatan();
        getMp();

        //fungsi hapus        
        hapus = (uuid, nama) =>{
            let csrf_token=$('meta[name="csrf_token"]').attr('content');
            Swal.fire({
                        title: 'apa anda yakin?',
                        text: " Menghapus  Data guru " + nama,
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'hapus data',
                        cancelButtonText: 'batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                url : "{{ url('/api/guru')}}" + '/' + uuid,
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
                $('#NIP').val('');
                $('#nama').val('');
                $('#golongan_id').val('');  
                $('#jabatan_id').val('');  
                $('#mata_pelajaran_id').val('');
                $('#telepon').val('');    
                $('#tempat_lahir').val('');
                $('#tgl_lahir').val('');
                $('#alamat').val('');
                $('#status').val('');                                                                
                $('#btn-form').text('Simpan Data');
                $('#mediumModal').modal('show');
            })

            //event btn edit klik        
            edit = uuid =>{
                $.ajax({
                    type: "GET",
                    url: "{{ url('/api/guru')}}" + '/' + uuid,
                    beforeSend: false,
                    success : function(returnData) {
                        $('.modal-title').text('Edit Data');
                        $('#id').val(returnData.data.uuid);
                        $('#NIP').val(returnData.data.NIP);
                        $('#nama').val(returnData.data.nama);
                        $('#sekolah_id').val(returnData.data.sekolah.uuid); 
                        $('#golongan_id').val(returnData.data.golongan.uuid); 
                        $('#jabatan_id').val(returnData.data.jabatan.uuid);
                        $('#mata_pelajaran_id').val(returnData.data.mata_pelajaran.uuid);
                        $('#telepon').val(returnData.data.telepon);  
                        $('#tempat_lahir').val(returnData.data.tempat_lahir);
                        $('#tgl_lahir').val(returnData.data.tgl_lahir);
                        $('#alamat').val(returnData.data.alamat);
                        $('#status').val(returnData.data.status);                                                              
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
                        "url": "{{route('API.guru.get')}}",
                        "dataSrc": "data",
                        "contentType": "application/json; charset=utf-8",
                        "dataType": "json",
                        "processData": true
                    },
                    columns: [
                        {"data": "NIP"},
                        {"data": "nama"},
                        {"data": "sekolah.NPSN"},
                        {"data": "telepon"},
                        {"data": "jabatan.jabatan"},
                        {"data": "mata_pelajaran.nama"},
                        {data: null , render : function ( data, type, row, meta ) {
                            let uuid = row.uuid;
                            let nama = row.nama;
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
                        let url = '{{route("API.guru.update", '')}}'
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
                            url: "{{Route('API.guru.create')}}",
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