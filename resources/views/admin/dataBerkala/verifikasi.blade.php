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
              <h3 class="mb-0">Tabel Data Permohonan datah Berkala {{$permohonan->guru->nama}}</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form action="" method="post">
                        <input type="hidden" name="data_berkala_id" id="data_berkala_id" value="{{$permohonan->id}}">
                        <input type="hidden" name="sekolah_id" id="sekolah_id" value="{{$permohonan->sekolah_id}}">
                        <div class="form-group">
                            <label for="">Subjek</label>
                            <input class="form-control" type="text" name="subjek" id="subjek">
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="0">Pending</option>
                                <option value="1">Diterima</option>
                                <option value="2">Ditolak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <textarea class="form-control"  name="subject" id="subject"></textarea>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer text-right">
                <a class="btn btn-sm btn-danger" href="">Batal</a>
                <button type="submit" class="btn btn-sm btn-primary"> Kirim Veifikasi  </button>
            </div>
          </div>
        </div>
      </div>
      <br>
      <br>
@endsection
@section('script')
    <script>
         //event form submit
         $("form").submit(function (e) {
                    e.preventDefault()
                    let form = $('#modal-body form');
                        let url = '{{route("API.guru.update", '')}}'
                        let id = $('#data_berkala_id').val();
                        $.ajax({
                            url: url+'/'+id,
                            type: "put",
                            data: $(this).serialize(),
                            success: function (response) {
                              //direct page
                              window.location.replace("/permohonan/index");
                            },
                            error:function(response){
                                console.log(response);
                            }
                        })
                } );
    </script>
@endsection