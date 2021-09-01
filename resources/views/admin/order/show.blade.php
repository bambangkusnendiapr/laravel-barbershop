@extends('layouts.admin.main')
@section('order', 'active')
@section('title', 'Show Order')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Show Order</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item"><a href="#">Order</a></li>
            <li class="breadcrumb-item active">Show Order</li>
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
                <div class="row">
                  <div class="col-md-4">
                    Code : <strong>{{ $order->code }}</strong>
                  </div>
                  <div class="col-md-4">
                    First Name : <strong>{{ $order->client->first_name }}</strong>
                  </div>
                  <div class="col-md-4">
                    Last Name : <strong>{{ $order->client->last_name }}</strong>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    Email : <strong>{{ $order->client->email }}</strong>
                  </div>
                  <div class="col-md-4">
                    Phone : <strong>{{ $order->client->hp }}</strong>
                  </div>
                  <div class="col-md-4">
                    Address : <strong>{{ $order->client->address }}</strong>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">
                    Staff : <strong>{{ $order->employee->first_name }}</strong>
                  </div>
                  <div class="col-md-4">
                    Location : <strong>{{ $order->lokasi->name }}</strong>
                  </div>
                  <div class="col-md-4">
                    Payment : <strong>{{ $order->payment->bank }} | {{ $order->payment->an }} | {{ $order->payment->norek }}</strong>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    Date and Time: <strong>{{ $order->date->format('d F Y') }} {{ $order->time->jam }}</strong>
                  </div>
                  <div class="col-md-4">
                    Note : <strong>{{ $order->note }}</strong>
                  </div>
                  <div class="col-md-4">
                    TF : <strong>{{ $order->lunas }}</strong>
                  </div>
                </div>
                <hr>
                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-default"><i class="fas fa-plus"></i> Add Service</button>
                <table class="table table-striped table-sm" width="100%">
                  <tr>
                    <th>#</th>
                    <th>SERVICE</th>
                    <th>PRICE</th>
                    <th>QTY</th>
                    <th>SUB TOTAL</th>
                    <th>ACTION</th>
                  </tr>
                  @php $total = 0; $quantity = 0; @endphp
                  @foreach($order->service as $service)
                    @php $total += $service->price * $service->pivot->qty @endphp
                    @php $quantity += $service->pivot->qty @endphp
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $service->name }}</td>
                    <td>{{ $service->price }} K</td>
                    <td>{{ $service->pivot->qty }}</td>
                    <td>{{ $service->pivot->total }} K</td>
                    <td>
                      <form action="{{ route('service.hapus', $service->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="order" value="{{ $order->id }}">
                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-default{{ $service->id }}">edit</button>
                        <button type="submit" class="btn btn-danger btn-sm">delete</button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                  <tr>
                    <th></th>
                    <th></th>
                    <th>TOTAL</th>
                    <th>{{ $quantity }}</th>
                    <th>{{ $total }} K</th>
                    <th></th>
                  </tr>
                </table>
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

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title">Form Service</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('add_service') }}" method="post">
        @csrf
        <input type="hidden" name="order_id" value="{{ $order->id }}">
        <div class="modal-body">
          <div class="form-group">
            <label class="col-form-label">Select Service</label>
              <select required name="service" class="form-control">
                <option selected disabled value="">Select Service</option>
                @foreach($services as $service)
                  <option value="{{ $service->id }}">{{ $service->name }} | {{ $service->desc }} | <strong>{{ $service->price }} K</strong></option>
                @endforeach
              </select>
          </div>
          <div class="form-group">
            <label class="col-form-label">Quantity</label>
            <input type="number" class="form-control" name="qty" required>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@foreach($order->service as $service)
<div class="modal fade" id="modal-default{{ $service->id }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h4 class="modal-title">Form Edit Service</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('update_service', $service->id) }}" method="post">
        @csrf
        @method('put')
        <input type="hidden" name="order_id" value="{{ $order->id }}">
        <div class="modal-body">
          <div class="form-group">
            <label class="col-form-label">Select Service</label>
              <select required name="service" class="form-control">
                <option selected disabled value="">Select Service</option>
                @foreach($services as $data)
                  <option value="{{ $data->id }}" {{ $data->id == $service->id ? 'selected':'' }}>{{ $data->name }} | {{ $data->desc }} | <strong>{{ $data->price }} K</strong></option>
                @endforeach
              </select>
          </div>
          <div class="form-group">
            <label class="col-form-label">Quantity</label>
            <input type="number" class="form-control" name="qty" required value="{{ $service->pivot->qty }}">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-warning">Update</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endforeach

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