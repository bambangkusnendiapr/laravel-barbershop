@extends('layouts.admin.main')
@section('order', 'active')
@section('title', 'Edit Order')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Order</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item"><a href="#">Order</a></li>
            <li class="breadcrumb-item active">Edit Order</li>
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
          @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ $message }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
          <!-- Default box -->
          <div class="card">
              <div class="card-header">
                <a href="{{ route('order.index') }}" class="btn btn-dark"><i class="fas fa-arrow-left"></i> Back</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ route('order.update', $order->id) }}" method="post">
                  @csrf
                  @method('put')   
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">First Name</label>
                    <div class="col-sm-10">
                      <input type="text" required class="form-control"name="first" value="{{ $order->client->first_name }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Last Name</label>
                    <div class="col-sm-10">
                      <input type="text" required class="form-control"name="last" value="{{ $order->client->last_name }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" required class="form-control"name="email" value="{{ $order->client->email }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                      <input type="number" name="no" required class="form-control" id="inputPassword3" value="{{ $order->client->hp }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="address" placeholder="Address" value="{{ $order->client->address }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Booking Note</label>
                    <div class="col-sm-10">
                      <textarea name="note" class="form-control" placeholder="Booking Note">{{ $order->note }}</textarea>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Select Staff</label>
                    <div class="col-sm-10">
                      <select name="staff" class="form-control">
                        <option selected disabled value="">Select Staff</option>
                        @foreach($staffs as $staff)
                          <option value="{{ $staff->id }}" {{ $order->staff == $staff->id ? 'selected':'' }}>{{ $staff->first_name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Select Location</label>
                    <div class="col-sm-10">
                      <select name="location" class="form-control">
                        <option selected disabled value="">Select Location</option>
                        @foreach($locations as $location)
                          <option value="{{ $location->id }}" {{ $order->location_id == $location->id ? 'selected':'' }}>{{ $location->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Select Payment</label>
                    <div class="col-sm-10">
                      <select name="payment" class="form-control">
                        <option selected disabled value="">Select Payment</option>
                        @foreach($payments as $payment)
                          <option value="{{ $payment->id }}" {{ $order->payment_id == $payment->id ? 'selected':'' }}>{{ $payment->bank }} | {{ $payment->an }} | {{ $payment->norek }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Select Date</label>
                    <div class="col-sm-7">
                    <label class="col-form-label">{{ $order->date->format('d F Y') }}</label> (Kosongkan jika tidak mengganti tanggal)
                    </div>
                    <div class="col-sm-3">
                      <input type="date" class="form-control" name="date" value="{{ $order->date }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Select Time</label>
                    <div class="col-sm-10">
                      <select required name="time" class="form-control">
                        <option selected disabled value="">Select Time</option>
                        @foreach($times as $time)
                          <option value="{{ $time->id }}" {{ $order->time_id == $time->id ? 'selected':'' }}>{{ $time->jam }}</option>
                        @endforeach
                      </select>
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
<script>
  $(document).ready(function(){

    // $('.quantity').on('click', function() {
      $(".update-cart").click(function (e) {
           e.preventDefault();
           var ele = $(this);
            $.ajax({
               url: '{{ url('update-cart') }}',
               method: "patch",
               data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
               success: function (response) {
                   window.location.reload();
               }
            });
        });
    // });

  });
</script>
@endpush