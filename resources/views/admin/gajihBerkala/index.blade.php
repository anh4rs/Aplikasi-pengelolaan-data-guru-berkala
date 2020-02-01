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
              <h3 class="mb-0">TABEL GAJIH TAHUN {{$tahun}} </h3>
                <br>
              <div class="text-right">
              <a href="{{Route('gajiCetak')}}" class="btn btn-icon btn-sm btn-outline-info"><span class="btn-inner--icon"><i class="ni ni-cloud-download-95"></i></span>
                <span class="btn-inner--text">Cetak Laporan</span></a>
              <button class="btn btn-icon btn-sm btn-outline-primary" id="tambah" type="button" >
	            <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                <span class="btn-inner--text">Tambah Data</span>
              </button>
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
                <input type="text" class="form-control" name="tahun" id="tahun" value="{{$tahun}}">
                <input type="hidden" class="form-control" name="id" id="id">
                <div class="form-group">
                        <label for="golongan">Kode Golongan</label>
                        <select class="form-control" name="golongan_id" id="golongan_id">
                            <option value="">-- pilih golongan --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="golongan">Masa Kerja Golongan (MKG)</label>
                        <input type="number" class="form-control" name="mkg" id="mkg">
                    </div>
                    <div class="form-group">
                        <label for="golongan">Besaran Gaji </label>
                        <input type="text" class="form-control" name="besaran_gaji" id="besaran_gaji">
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

            getGolongan = () =>{
            $.ajax({
                    type: "GET",
                    url: "{{ url('/api/golongan')}}",
                    beforeSend: false,
                    success : function(returnData) {
                        $.each(returnData.data, function (index, value) {
                        $('#golongan_id').append(
                            '<option value="'+value.uuid+'">'+value.kode_golongan+'</option>'
                        )
                    })
                }
            })
        }
        getGolongan();
        //fungsi hapus
        hapus = (uuid, nama) =>{
            let csrf_token=$('meta[name="csrf_token"]').attr('content');
            Swal.fire({
                        title: 'apa anda yakin?',
                        text: " Menghapus  Data gaji " + nama,
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

            //event btn tambah
            $('#tambah').click(function(){
                $('.modal-title').text('Tambah Data');
                $('#golongan_id').val('');
                $('#mkg').val('');
                $('#besaran_gaji').val('');
                $('#btn-form').text('Simpan Data');
                $('#mediumModal').modal('show');
            })

            //event btn edit klik
            edit = uuid =>{
                $.ajax({
                    type: "GET",
                    url: "{{ url('/api/gaji')}}" + '/' + uuid,
                    beforeSend: false,
                    success : function(returnData) {
                        $('.modal-title').text('Edit Data');
                        $('#id').val(returnData.data.uuid);
                        $('#mkg').val(returnData.data.mkg);
                        $('#besaran_gaji').val(returnData.data.besaran_gaji);
                        $('#btn-form').text('Ubah Data');
                        $('#mediumModal').modal('show');
                    }
                })
            }

            //fungsi render datatable
            $(document).ready(function() {
                let tahun =  $('#tahun').val();
                $('#datatable').DataTable( {
                    responsive: true,
                    processing: true,
                    serverSide: false,
                    searching: true,
                    ajax: {
                        "type": "GET",
                        "url":  "{{ url('/api/gaji')}}" + '/' + tahun,
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
                        }},
                        {data: null , render : function ( data, type, row, meta ) {
                            let uuid = row.golongan.uuid;
                            let nama = row.nama;
                            return type === 'display'  ?
                            '<button onClick="edit(\''+uuid+'\')" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editmodal"><i class="ti-pencil"> edit</i></button> <button onClick="hapus(\'' + uuid + '\',\'' + nama + '\')" class="btn btn-sm btn-outline-danger" > <i class="ti-trash">hapus</i></button>':
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
