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
              <h3 class="mb-0">Profil Sekolah</h3>
            </div>
           <div class="card-body">
           <div class="table-responsive">
              <table class="table">
                <tr>
                  <td>Nama Sekolah</td>
                  <td>: {{$sekolah->nama}}</td>
                </tr>
                <tr>
                  <td>NPSN</td>
                  <td>: {{$sekolah->NPSN}}</td>
                </tr>                
                <tr>
                  <td>Status sekolah</td>
                  <td>: {{$sekolah->status_sekolah}}</td>
                </tr>
                <tr>
                  <td>Tingkat Pendidikan</td>
                  <td>: {{$sekolah->b_pendidikan}}</td>
                </tr>                
                <tr>
                  <td>Status Kepemilikan</td>
                  <td>: {{$sekolah->status_pemilik}}</td>
                </tr>
                <tr>
                  <td>No SK</td>
                  <td>: {{$sekolah->sk}}</td>
                </tr>                
                <tr>
                  <td>Tanggal SK</td>
                  <td>: {{$sekolah->tgl_sk}}</td>
                </tr>
                <tr>
                  <td>SK Izin</td>
                  <td>: {{$sekolah->sk_izin}}</td>
                </tr>                
                <tr>
                  <td>Tanggal SK Izin</td>
                  <td>: {{$sekolah->tgl_sk_izin}}</td>
                </tr>
                <tr>
                  <td>password</td>
                  <td>: <button id="tambah" class="btn btn-sm btn-primary">ganti password</button></td>
                </tr>
              </table>
            </div>
           </div>
           <div class="card-footer">

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
                <input type="hidden" class="form-control" name="id" id="id">
                    <div class="form-group">
                        <label for="golongan">Password Baru </label>
                        <input type="text" class="form-control" name="password" id="password">
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
            //event btn tambah
            $('#tambah').click(function(){
                $('.modal-title').text('Tambah Data');
                $('#password').val('');
                $('#btn-form').text('Simpan Data');
                $('#mediumModal').modal('show');
            })


                //event form submit            
                $("form").submit(function (e) {
                    e.preventDefault()
                    let form = $('#modal-body form');
                        $.ajax({
                            url: "{{Route('API.sekolah-data.updatePassword')}}",
                            type: "post",
                            data: $(this).serialize(),
                            success: function (response) {
                                form.trigger('reset');
                                $('#mediumModal').modal('hide');
                                if (response.Error) {
                                    
                                    var array = $.map(response, function(value, index) {
                                    return [value];
                                    });
                                    Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: response.Error,
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                }else{
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Data Berhasil Disimpan',
                                        showConfirmButton: false,
                                        timer: 1500
                                })
                                }
                            },
                            error:function(response){
                                console.log(response);
                            }
                        })
                } );
   </script>
@endsection