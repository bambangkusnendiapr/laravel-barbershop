@extends('layouts.admin.main')
@section('master_data', 'menu-open')
@section('payment', 'active')
@section('title', 'Edit Payment')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Payment</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item"><a href="#">Payment</a></li>
            <li class="breadcrumb-item active">Edit Payment</li>
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
                <a href="{{ route('payment.index') }}" class="btn btn-dark"><i class="fas fa-arrow-left"></i> Back</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ route('payment.update', $payment->id) }}" method="post">
                  @csrf
                  @method('put')
                  <div class="form-group">
                    <label for="exampleInputEmail1">Bank</label>
                    <input name="bank" type="text" value="{{ $payment->bank }}" required class="form-control" id="exampleInputEmail1" placeholder="Enter Bank Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Cabang</label>
                    <input name="cabang" type="text" value="{{ $payment->cabang }}" required class="form-control" id="exampleInputEmail1" placeholder="Enter Cabang Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Atas Nama</label>
                    <input name="an" type="text" value="{{ $payment->an }}" required class="form-control" id="exampleInputEmail1" placeholder="Atas Nama">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nomor Rekening</label>
                    <input name="norek" type="number" value="{{ $payment->norek }}" required class="form-control" id="exampleInputEmail1">
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Update</button>
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

@endpush