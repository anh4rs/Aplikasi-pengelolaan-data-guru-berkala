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
              <h3 class="mb-0">Filter Permohonan Berdasarkan Status</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="0">Pending</option>
                                <option value="2">Ditolak</option>
                            </select>
                        </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <a class="btn btn-sm btn-danger" href="">Batal</a>
                <button type="submit" name="submit" id="btn-form" class="btn btn-sm btn-primary">Cetak Data </button>
                {{csrf_field()}}
                </form>
            </div>
          </div>
        </div>
      </div>
      <br>
      <br>
@endsection