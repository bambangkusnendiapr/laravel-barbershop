@extends('layouts.admin.main')
@section('master_data', 'menu-open')
@section('time', 'active')
@section('title', 'Create Time')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Create Time</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item"><a href="#">Time</a></li>
            <li class="breadcrumb-item active">Create Time</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- Default box -->
          <div class="card">
              <div class="card-header">
                <a href="{{ route('time.index') }}" class="btn btn-dark"><i class="fas fa-arrow-left"></i> Back</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ route('time.store') }}" method="post">
                  @csrf
                  <div class="form-group">
                    <label for="lokasi">Jam</label>
                    <input name="jam" required type="number" value="{{ old('jam') }}" class="form-control @error('jam') is-invalid @enderror" id="lokasi" placeholder="Format contoh: 14.30">

                    @error('jam')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                  </div>
                  <input type="hidden" name="color" class="form-control" id="warna" value="">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>

@endsection

@push('style')

@endpush

@push('script')
<script>
  $(function() {
    $("#lokasi").keyup(function() {
      var symbols, color;
      symbols = "0123456789ABCDEF";

      color = "#"
      for (var i = 0; i < 6; i++) {
        color = color + symbols[Math.floor(Math.random() * 16)];
      }
      $("#warna").val(color);
    });
  });
</script>
@endpush