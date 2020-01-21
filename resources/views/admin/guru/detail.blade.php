@extends('layouts.admin')
@section('content')
 <!-- Header -->
 <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 400px; background-image: url(/admin/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h1 class="display-2 text-white">Profil Guru</h1>
            <p class="text-white mt-0 mb-5">ini adalah halaman profil guru. anda dapat melihat data diri anda, riwayat kependidikan dan program diklat yang telah diikuti</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="{{asset('img/user/default.jpg')}}" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center mt-md-5">
             
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h3>
                  {{$guru->nama}}<span class="font-weight-light"></span>
                </h3>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i>NIP.{{$guru->NIP}}
                </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>{{$guru->jabatan->jabatan}}
                </div>
                <div>
                  <i class="ni education_hat mr-2"></i>{{$guru->sekolah->nama}}
                </div>
                <hr class="my-4" />
              </div>
            </div>
          </div>
          <br>
          <div class="card card-profile shadow">
            <div class="card-header border-0">
              <div class="text-right">
                    <button class="btn btn-sm btn-primary" id="btnPendidikan" >+ tambah pendidikan</button>
                </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
                <h3>
                  Data Pendidikan<span class="font-weight-light"></span>
                </h3>
                <div> 
                <ul id="pendidikanList">
                
                </ul>
                </div>
                <hr class="my-4" />
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Data Pribadi</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Nama</label> <br>
                        <h5 class="h5 font-weight-300">{{$guru->nama}}</h5>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">NIP</label>
                        <h5 class="h5 font-weight-300">{{$guru->NIP}}</h5>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Golongan</label>
                        <h5 class="h5 font-weight-300">{{$guru->golongan->kode_golongan}}</h5>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Jabatan</label>
                        <h5 class="h5 font-weight-300">{{$guru->jabatan->jabatan}}</h5>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Tempat, Tanggal lahir</label>
                        <h5 class="h5 font-weight-300"> {{$guru->tempat_lahir}}, {{$guru->tgl_lahir}}</h5>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Status Kepegawaian</label>
                        <h5 class="h5 font-weight-300">{{$guru->status}}</h5>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <h6 class="heading-small text-muted mb-4">Kontak</h6>
                <div class="pl-lg-4">
                <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Telepon</label>
                        <h5 class="h5 font-weight-300">{{$guru->telepon}}</h5>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Alamat</label>
                        <h5 class="h5 font-weight-300">{{$guru->alamat}}</h5>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Description -->
                <h6 class="heading-small text-muted mb-4">Diklat</h6>
                <div class="pl-lg-4">
                  <div class="form-group">
                    <form id="form2" action="" method="post">
                      <input type="hidden" class="form-control" name="guru_id" id="guru_id2" value="{{$guru->uuid}}">
                        <div class="form-group">
                            <label for="judul">Diklat</label>
                            <select class="form-control" name="diklat_id" id="diklat_id" required >
                              <option value="">-- Pilih Diklat --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="berita">Tahun </label>
                            <input type="date" class="form-control" name="waktu" id="waktu"></input>
                        </div>                    
                    </div>   
                <div class="modal-footer">
                  <button type="submit" name="submit" class="btn btn-sm btn-primary">+ tambahkan diklat</button>
                </div>
                </form>    
                    <table id="datatable" class="table align-items-center table-striped text-center">
                        <thead class="thead-light">
                            <tr>
                                <th cope="col">No</th>
                                <th scope="col">Diklat</th>
                                <th scope="col">tahun</th>
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
        </div>
      </div>
      <div class="modal fade" id="tambahPendidikan" >
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title1"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>    
            <div class="modal-body">
                <form id="form1" action="" method="post">
                <input type="hidden" class="form-control" name="guru_id" id="guru_id1" value="{{$guru->id}}">
                    <div class="form-group">
                        <label for="judul">Pendidikan</label>
                        <select class="form-control" name="pendidikan" id="pendidikan">
                          <option value="">-- Pilih Pendidikan --</option>
                          <option value="SD">SD</option>
                          <option value="SMP">SMP</option>
                          <option value="SMA">SMA</option>
                          <option value="S1">S1</option>
                          <option value="S2">S2</option>
                          <option value="S3">S3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="berita">Nama Sekolah </label>
                        <input type="text" class="form-control" name="nama" id="nama" ></input>
                    </div>                    
                    <div class="form-group">
                        <label for="berita">Tahun Lulus </label>
                        <input type="date" class="form-control" name="tahun" id="tahun" ></input>
                    </div> 
            </div>   
            <div class="modal-footer">
                <button type="button" class="btn btn-link " data-dismiss="modal">Close</button> 
                <button type="submit" id="btn-form1" class="btn btn-primary"></button>
            </div>
            </form>    
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        //get data mata pelajar
        getPendidikan = () => {
          let id = $('#guru_id1').val();        
            $.ajax({
                    type: "GET",
                    url: "{{ url('/api/pendidikan-sekolah')}}" + '/' + id,
                    beforeSend: false,
                    success : function(returnData) {
                        $.each(returnData.data, function (index, value) {
                        $('#pendidikanList').append(
                            '<li >'+value.pendidikan+' - '+value.nama+'</li> <a onClick="hapus(\'' + value.uuid + '\',\'' + value.nama + '\')" class=" text-white btn btn-sm btn-danger">hapus</a>'
                        )
                    })
                }
            })
        }
        getPendidikan();

          //get data Diklat
          getDiklat = () => {
            $.ajax({
                    type: "GET",
                    url: "{{ url('/api/diklat')}}",
                    beforeSend: false,
                    success : function(returnData) {
                        $.each(returnData.data, function (index, value) {
                        $('#diklat_id').append(
                          '<option value="'+ value.uuid +'">'+ value.nama +'</option>'
                        )
                    })
                }
            })
        }
        getDiklat();

               //fungsi hapus
               hapus = (uuid, nama) =>{
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
                                url : "{{ url('/api/pendidikan-sekolah')}}" + '/' + uuid,
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
                                location.reload();
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

      //fungsi render datatable            
        $(document).ready(function() {
          let uuid = $('#guru_id2').val();        
                $('#datatable').DataTable( {
                    responsive: true,
                    processing: true,
                    serverSide: false,
                    searching: true,
                    ajax: {
                        "type": "GET",
                        "url": "{{ url('/api/diklat_sekolah')}}" + '/' + uuid,
                        "dataSrc": "data",
                        "contentType": "application/json; charset=utf-8",
                        "dataType": "json",
                        "processData": true
                    },
                    columns: [
                      {data: null , render : function ( data, type, row, meta ) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }},
                        {"data": "diklat.nama"},
                        {"data": "waktu"},
                        {data: null , render : function ( data, type, row, meta ) {
                            let uuid = row.uuid;
                            let nama = row.nama;
                            return type === 'display'  ?
                            '<button onClick="hapus(\'' + uuid + '\',\'' + nama + '\')" class="btn btn-sm btn-outline-danger" > <i class="ti-trash"></i>Hapus</button>':
                        data;
                        }}
                    ]
                });
              });

        $('#btnPendidikan').click(function(){
            $('.modal-title1').text('Tambah Data Pendidikan');
            $('#pendidikan').val('');
            $('#nama').val('');        
            $('#tahun_lulus').val('');
            $('#btn-form1').text('Simpan Berita');
            $('#tambahPendidikan').modal('show');
        })

           //event form submit        
           $("#form1").submit(function (e) {
                e.preventDefault()
                let form = $('#modal-body form');
                    $.ajax({
                        url: "{{Route('API.pendidikan-sekolah.create')}}",
                        type: "post",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (response) {
                            form.trigger('reset');
                            $('#tambahPendidikan').modal('hide');
                            location.reload();
                        },
                        error:function(response){
                            console.log(response);
                        }
                    })
            } );
            
             //event form submit        
             $("#form2").submit(function (e) {
                e.preventDefault()
                let form = $('#modal-body form');
                    $.ajax({
                        url: "{{Route('API.diklat_sekolah.create')}}",
                        type: "post",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (response) {
                            form.trigger('reset');
                            location.reload();
                        },
                        error:function(response){
                            console.log(response);
                        }
                    })
            } );

    </script>
@endsection
