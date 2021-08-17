@extends('layouts.admin.main')
@section('master_data', 'menu-open')
@section('category', 'active')
@section('title', 'Edit Category')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Category</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item"><a href="#">Category</a></li>
            <li class="breadcrumb-item active">Edit Category</li>
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
                <a href="{{ route('category.index') }}" class="btn btn-dark"><i class="fas fa-arrow-left"></i> Back</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ route('category.update', $category->id) }}" method="post">
                  @csrf
                  @method('put')
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label>
                    <input name="category" type="text" value="{{ $category->name }}" required class="form-control" id="exampleInputEmail1" placeholder="Enter category Name">
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