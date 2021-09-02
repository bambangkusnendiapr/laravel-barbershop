@extends('layouts.admin.main')
@section('title', 'Profile')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Profile</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Profile</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  
  <!-- Main content -->
  <section class="content">
    
    <div class="container-fluid">
      @if ($message = Session::get('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
      <div class="row">
        <div class="col-12">
          <!-- Default box -->
          <div class="card card-outline card-primary">
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ route('profile.update',Auth::user()->id) }}" method="post">
                  @csrf
                  @method('put')
                  <div class="form-group row">
                      <label class="col-sm-2 col-form-label">First Name</label>
                      <div class="col-sm-10">
                          <input type="text" required class="form-control" name="first" value="{{ Auth::user()->first_name }}">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Last Name</label>
                      <div class="col-sm-10">
                          <input type="text" required class="form-control" name="last" value="{{ Auth::user()->last_name }}">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                          <input type="text" required class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}">
                          @error('email')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-5 col-form-label">No. HP (Isi dengan format 628****)</label>
                      <div class="col-sm-7">
                          <input type="number" required class="form-control" name="hp" value="{{ Auth::user()->hp }}">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Address</label>
                      <div class="col-sm-10">
                          <input type="text" required class="form-control" name="address" value="{{ Auth::user()->address }}">
                      </div>
                  </div>
                  <hr>
                  <div class="form-group row">
                      <label class="col-sm-5 col-form-label">New Password (Biarkan kosong jika tidak ganti password)</label>
                      <div class="col-sm-7">
                          <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter Password" autocomplete="new-password">
                          @error('password')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-5 col-form-label">Confirm New Password</label>
                      <div class="col-sm-7">
                          <input type="password" class="form-control" name="password_confirmation" placeholder="Enter Password" autocomplete="new-password">
                      </div>
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