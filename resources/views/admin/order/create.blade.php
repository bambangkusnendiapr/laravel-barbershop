@extends('layouts.admin.main')
@section('order', 'active')
@section('title', 'Create Order')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Create Order</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item"><a href="#">Order</a></li>
            <li class="breadcrumb-item active">Create Order</li>
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
                <form action="{{ route('order.store') }}" method="post">
                  @csrf
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Select Service</label>
                    <div class="col-sm-10" id="accordion">

                      @foreach($categories as $category)
                        <div class="card card-primary card-outline">
                          <a class="d-block w-100" data-toggle="collapse" href="#collapse{{ $category->id }}">
                              <div class="card-header">
                                  <h4 class="card-title w-100">
                                      {{ $category->name }}
                                  </h4>
                              </div>
                          </a>
                          <div id="collapse{{ $category->id }}" class="collapse" data-parent="#accordion">
                              <div class="card-body">
                                <table class="table table-sm table-striped">
                                  @foreach($category->services as $service)
                                    <tr>
                                      <td>
                                        <span>{{ $service->name }}</span><br>
                                        <span class="form-check-label text-muted" for="flexCheckDefault">
                                            {{ $service->duration }} {{ $service->time }}
                                        </span> |
                                        <span class="form-check-label text-primary" for="flexCheckDefault">
                                            <strong>{{ $service->price }} K</strong>
                                        </span>
                                      </td>
                                      <td><a href="{{ route('addToCart', $service->id) }}" class="btn btn-secondary">Add</a></td>
                                    </tr>
                                  @endforeach
                                </table>
                              </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
                  @if(session('cart'))
                  <hr>
                  <table class="table table-sm table-striped">
                    <tr>
                      <th>Service</th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th>Sub Total</th>
                      <th>Action</th>
                    </tr>
                    @php $total = 0; @endphp
                    @foreach(session('cart') as $id => $details)
                      @php $total += $details['price'] * $details['quantity'] @endphp
                      <tr>
                        <td>{{ $details['name'] }}</td>
                        <td>{{ $details['price'] }} K</td>
                        <td><input type="number" value="{{ $details['quantity'] }}" class="form-control quantity" /></td>
                        <td>{{ $details['price'] * $details['quantity'] }} K</td>
                        <td>
                          <button class="btn btn-info btn-sm update-cart d-inline" data-id="{{ $id }}"><i class="fas fa-sync-alt"></i></button>
                          <a href="{{ route('deleteService', $id) }}" class="btn btn-sm btn-danger d-inline"><i class="fas fa-trash"></i></a>
                        </td>
                      </tr>
                    @endforeach
                    <tr>
                      <td></td>
                      <td></td>
                      <td>Total</td>
                      <td>{{ $total }}</td>
                      <td></td>
                    </tr>
                  </table>
                  @endif
                  <hr>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">First Name</label>
                    <div class="col-sm-10">
                      <input type="text" required class="form-control"name="first" placeholder="First Name*">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Last Name</label>
                    <div class="col-sm-10">
                      <input type="text" required class="form-control"name="last" placeholder="Last Name*">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" required class="form-control"name="email" placeholder="Email*">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                      <input type="number" name="no" required class="form-control" id="inputPassword3">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="address" placeholder="Address">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Booking Note</label>
                    <div class="col-sm-10">
                      <textarea name="note" class="form-control" placeholder="Booking Note"></textarea>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Select Staff</label>
                    <div class="col-sm-10">
                      <select required name="staff" class="form-control">
                        <option selected disabled value="">Select Staff</option>
                        @foreach($staffs as $staff)
                          <option value="{{ $staff->id }}">{{ $staff->first_name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Select Location</label>
                    <div class="col-sm-10">
                      <select required name="location" class="form-control">
                        <option selected disabled value="">Select Location</option>
                        @foreach($locations as $location)
                          <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Select Payment</label>
                    <div class="col-sm-10">
                      <select required name="payment" class="form-control">
                        <option selected disabled value="">Select Payment</option>
                        @foreach($payments as $payment)
                          <option value="{{ $payment->id }}">{{ $payment->bank }} | {{ $payment->an }} | {{ $payment->norek }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Select Date</label>
                    <div class="col-sm-10">
                      <input type="date" required class="form-control" name="date">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Select Time</label>
                    <div class="col-sm-10">
                      <select required name="time" class="form-control">
                        <option selected disabled value="">Select Time</option>
                        @foreach($times as $time)
                          <option value="{{ $time->id }}">{{ $time->jam }}</option>
                        @endforeach
                      </select>
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