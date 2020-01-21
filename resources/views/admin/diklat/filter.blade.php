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
              <h3 class="mb-0">Filter Data</h3>
            </div>
            <div class="card-body">
            <form action="" method="post">
                <div class="form-group">
                    <label for="">Sekolah</label>
                    <select class="form-control" name="diklat_id" id="diklat_id">
                    <option value="">-- pilih Diklat --</option>
                    @foreach($diklat as $s)
                        <option value="{{$s->id}}">{{$s->nama}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary" type="submit" name="submit" >Cetak Data</button>
                @csrf
                </form>
            </div>
          </div>
        </div>
      </div>
@endsection