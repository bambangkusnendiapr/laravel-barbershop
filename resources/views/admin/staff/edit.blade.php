@extends('layouts.admin.main')
@section('staff', 'active')
@section('title', 'Edit Capster')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Capster</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item"><a href="#">Capster</a></li>
            <li class="breadcrumb-item active">Edit Capster</li>
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
                <a href="{{ route('staff.index') }}" class="btn btn-dark"><i class="fas fa-arrow-left"></i> Back</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ route('staff.update', $staff->id) }}" method="post">
                  @csrf
                  @method('put')

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Select Location</label>
                    <div class="col-sm-10">
                      <select required name="location" class="form-control">
                        <option selected disabled value="">Select Location</option>
                        @foreach($locations as $location)
                          <option value="{{ $location->id }}" {{ $location->id == $staff->location_id ? 'selected':'' }}>{{ $location->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">First Name</label>
                    <div class="col-sm-10">
                      <input type="text" required class="form-control" name="first" value="{{ $staff->first_name }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Last Name</label>
                    <div class="col-sm-10">
                      <input type="text" required class="form-control" name="last" value="{{ $staff->last_name }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" required class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $staff->email }}">
                      @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                      <input type="number" name="no" required class="form-control" value="{{ $staff->hp }}" id="inputPassword3">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                      <input type="text" name="address" value="{{ $staff->address }}" class="form-control" id="inputPassword3">
                    </div>
                  </div>

                  <hr>

                  <strong>*) Kosongkan jika tidak ganti password</strong>

                  <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" name="password" autocomplete="new-password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                      @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="password-confirm" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-10">
                      <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror" id="password-confirm" placeholder="Password" autocomplete="new-password">
                    </div>
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