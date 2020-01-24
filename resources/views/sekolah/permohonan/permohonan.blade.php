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
              <h3 class="mb-0">Buat Permohonan Gajih Berkala</h3>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                <form action="" method="post">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="guru">Guru</label>
                        <select name="guru_id" class="form-control" id="guru_id" required>
                            <option value="">-- Pilih guru  --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="guru">Pejabat Struktural</label>
                        <select name="pejabat_struktural_id" class="form-control" id="pejabat_struktural_id" required>
                            <option value="">-- Pilih --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="guru"> Nomor Surat</label>
                        <input type="text" class="form-control" name="nomor_surat" id="nomor_surat" placeholder="Nomor Surat" required>
                    </div>
                    <div class="form-group">
                        <label for="guru">Lampiran</label>
                        <input type="text" class="form-control" name="lampiran" id="lampiran" placeholder="Lampiran Surat" required>
                    </div>
                    <div class="form-group">
                        <label for="guru">Perihal</label>
                        <input type="text" class="form-control" name="perihal" id="perihal" placeholder="Perihal Permohonan" required>
                    </div>
                    <div class="form-group">
                        <label for="guru">Gajih Lama (Rp.)</label>
                        <input type="text" class="form-control" name="gaji_lama" id="gaji_lama" placeholder="Gajih Sebelumnya" required>
                    </div>
                    <div class="form-group">
                        <label for="guru">Tanggal Keputusan</label>
                        <input type="date" class="form-control" name="tgl_keputusan" id="tgl_keputusan" placeholder="Tanggal Keputusan" required>
                    </div>
                    <div class="form-group">
                        <label for="guru">Nomor Keputusan</label>
                        <input type="text" class="form-control" name="no_keputusan" id="no_keputusan" placeholder="Nomor Keputusan" required>
                    </div>                    
                    <div class="form-group">
                        <label for="guru">MKG Pada Tanggal Tersebut</label>
                        <input type="text" class="form-control" name="mkg" id="mkg" placeholder="MKG" required>
                    </div>                    
                    <div class="form-group">
                        <label for="guru">Gajih Baru (Rp.)</label>
                        <select name="gaji_baru" id="gaji_baru" class="form-control">
                            <option value=""> -- pilih jaih baru --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="guru">Terbilang</label>
                        <input type="text" class="form-control" name="terbilang" id="terbilang" placeholder="Terbilang ..." required>
                    </div>
                    <div class="form-group">
                        <label for="guru">Tanggal Gajih Berlaku</label>
                        <input type="date" class="form-control" name="tgl_gaji_berlaku" id="tgl_gaji_berlaku" placeholder="Tanggal Gaji Berlaku" required>
                    </div>
                    <div class="form-group">
                        <label for="guru">Kenaikan Gaji Berikutnya</label>
                        <input type="date" class="form-control" name="tgl_gaji_berikut" id="tgl_gaji_berikut" placeholder="Kenaikan Gaji Berikutnya" required>
                    </div>
            </div>   
            </div>
            <div class="card-footer text-right">
            <a href="{{route('adminSekolahPermohonanIndex')}}" class="btn btn-link " data-dismiss="modal">Close</a> 
                <button type="submit" id="btn-form" class="btn btn-primary">Kirim Permohonan</button>
            </div>
            </form> 
            </div>
          </div>
        </div>
      </div>
      <br>
      <br>
     
@endsection
@section('script')
    <script>
        //get data sekolah
        getGuru = () =>{
            $.ajax({
                    type: "GET",
                    url: "{{ url('/api/guru-sekolah')}}",
                    beforeSend: false,
                    success : function(returnData) {
                        $.each(returnData.data, function (index, value) {
                        $('#guru_id').append(
                            '<option value="'+value.id+'">'+value.nama+'</option>'
                        )
                    })
                }
            })
        }

        //get data golongan
        getPejabat = () =>{
            $.ajax({
                    type: "GET",
                    url: "{{ url('/api/pejabat-sekolah')}}",
                    beforeSend: false,
                    success : function(returnData) {
                        $.each(returnData.data, function (index, value) {
                        $('#pejabat_struktural_id').append(
                            '<option value="'+value.uuid+'">'+value.nama+'</option>'
                        )
                    })
                }
            })
        }
             //get data golongan
             getGaji = () =>{
            $.ajax({
                    type: "GET",
                    url: "{{ url('/api/gaji-sekolah')}}",
                    beforeSend: false,
                    success : function(returnData) {
                        $.each(returnData.data, function (index, value) {
                        $('#gaji_baru').append(
                            '<option value="'+value.besaran_gaji+'">'+value.golongan.kode_golongan+' - Rp.'+ value.besaran_gaji +'</option>'
                        )
                    })
                }
            })
        }

        getGuru();
        getPejabat();
        getGaji();

                //event form submit            
                $("form").submit(function (e) {
                    e.preventDefault()
                    let form = $('#modal-body form');
                    if($('.modal-title').text() == 'Edit Data'){
                        let url = '{{route("API.data-sekolah.update", '')}}'
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
                            url: "{{Route('API.data-sekolah.create')}}",
                            type: "post",
                            data: $(this).serialize(),
                            success: function (response) {
                                if (response.Error) {
                                    
                                    var array = $.map(response, function(value, index) {
                                                        return [value];
                                                    });
                                    Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: response.Error,
                                    showConfirmButton: false,
                                    timer: 5000
                                })
                                    $.each(array, function(index, val){

                                        console.log(index);

                                    });

                                }else{
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Data Berhasil Disimpan',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                
                                window.location.replace("/adminSekolah/permohonan/index");
                            }
                            },
                            error:function(response){
                                
                            }
                        })
                    }
                } );
    </script>
@endsection