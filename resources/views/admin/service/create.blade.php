@extends('layouts.admin.main')
@section('master_data', 'menu-open')
@section('service', 'active')
@section('title', 'Create Service')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Create Service</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item"><a href="#">Service</a></li>
            <li class="breadcrumb-item active">Create Service</li>
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
                <a href="{{ route('service.index') }}" class="btn btn-dark"><i class="fas fa-arrow-left"></i> Back</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ route('service.store') }}" method="post">
                  @csrf
                  <div class="form-group">
                    <label for="exampleInputEmail1">Service</label>
                    <input name="name" type="text" value="{{ old('name') }}" required class="form-control" id="exampleInputEmail1" placeholder="Enter Service Name">
                  </div>
                  <div class="form-group">
                    <label>Select Category</label>
                    <select name="category" required class="form-control">
                      <option selected disabled value="">Select Category</option>
                      @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Duration</label>
                    <input name="duration" type="number" value="{{ old('duration') }}" required class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Select Time</label>
                    <select name="time" required class="form-control">
                      <option selected disabled value="">Select Time</option>
                        <option value="Hr">Hr</option>
                        <option value="mins">mins</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Price</label>
                    <input name="price" type="number" value="{{ old('price') }}" required class="form-control">
                  </div>
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

@endpush