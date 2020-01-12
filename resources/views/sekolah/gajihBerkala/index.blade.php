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
              <h3 class="mb-0">Tabel Data Permohonan Gajih Berkala</h3>
              <div class="text-right"> 
              <a href="#" class="btn btn-icon btn-sm btn-outline-info"><span class="btn-inner--icon"><i class="ni ni-cloud-download-95"></i></span>
                <span class="btn-inner--text">Cetak Laporan</span></a>
              <a href="{{Route('permohonanTambah')}}" class="btn btn-icon btn-sm btn-outline-primary"  >
	            <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                <span class="btn-inner--text">Tambah Data</span>
              </a>
              </div>
            </div>
            <div class="table-responsive">
              <table id="datatable" class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIP</th>
                    <th scope="col">Perihal</th>
                    <th scope="col">Nomor Keputusan</th>
                    <th scope="col">Gajih Baru</th>
                    <th scope="col">Status</th>
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
@endsection
@section('script')
    <script>

        //fungsi hapus        
        hapus = (uuid, nama) =>{
            let csrf_token=$('meta[name="csrf_token"]').attr('content');
            Swal.fire({
                        title: 'apa anda yakin?',
                        text: " Menghapus  Data permohonan " + nama,
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'hapus data',
                        cancelButtonText: 'batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                url : "{{ url('/api/gaji')}}" + '/' + uuid,
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

            // //event btn edit klik        
            // edit = uuid =>{
            //     $.ajax({
            //         type: "GET",
            //         url: "{{ url('/api/gaji')}}" + '/' + uuid,
            //         beforeSend: false,
            //         success : function(returnData) {
            //             $('.modal-title').text('Edit Data');
            //             $('#id').val(returnData.data.uuid);
            //             $('#NIP').val(returnData.data.NIP);
            //             $('#nama').val(returnData.data.nama);
            //             $('#sekolah_id').val(returnData.data.sekolah.uuid); 
            //             $('#golongan_id').val(returnData.data.golongan.uuid); 
            //             $('#jabatan_id').val(returnData.data.jabatan.uuid);
            //             $('#mata_pelajaran_id').val(returnData.data.mata_pelajaran.uuid);
            //             $('#telepon').val(returnData.data.telepon);  
            //             $('#tempat_lahir').val(returnData.data.tempat_lahir);
            //             $('#tgl_lahir').val(returnData.data.tgl_lahir);
            //             $('#alamat').val(returnData.data.alamat);
            //             $('#status').val(returnData.data.status);                                                              
            //             $('#btn-form').text('Ubah Data');
            //             $('#mediumModal').modal('show');
            //         }
            //     })
            // }

            //fungsi render datatable            
            $(document).ready(function() {
                $('#datatable').DataTable( {
                    responsive: true,
                    processing: true,
                    serverSide: false,
                    searching: true,
                    ajax: {
                        "type": "GET",
                        "url": "{{route('API.gaji.get')}}",
                        "dataSrc": "data",
                        "contentType": "application/json; charset=utf-8",
                        "dataType": "json",
                        "processData": true
                    },
                    columns: [
                        {data: null , render : function ( data, type, row, meta ) {
                            let no = 1;
                           return '<p>'+ no++ +' </p>'
                        }},
                        {"data": "guru.nama"},
                        {"data": "guru.NIP"},
                        {"data": "perihal"},
                        {"data": "no_keputusan"},
                        {data: null , render : function ( data, type, row, meta ) {
                            let gaji = row.gaji_baru;
                           return '<p>Rp.'+ gaji +' </p>'
                        }},
                        {data: null , render : function ( data, type, row, meta ) {
                            let status = row.status;
                            if(status == 0){
                                return '<a class="btn btn-sm btn-warning"> Pending </a>';
                            }else if(status == 1){
                                return '<a class="btn btn-sm btn-primary"> Dalam Proses </a>';
                            }else{
                                return '<a class="btn btn-sm btn-success"> Terverifikasi </a>';
                            }
                        }},
                        {data: null , render : function ( data, type, row, meta ) {
                            let uuid = row.uuid;
                            let nama = row.nama;
                            return type === 'display'  ?
                            '<a class="btn btn-sm btn-primary text-white"> Detail</a><button onClick="hapus(\'' + uuid + '\',\'' + nama + '\')" class="btn btn-sm btn-danger" > <i class="ti-trash"></i>Hapus</button>':
                        data;
                        }}
                    ]
                });

                //event form submit            
                $("form").submit(function (e) {
                    e.preventDefault()
                    let form = $('#modal-body form');
                    if($('.modal-title').text() == 'Edit Data'){
                        let url = '{{route("API.gaji.update", '')}}'
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
                            url: "{{Route('API.gaji.create')}}",
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