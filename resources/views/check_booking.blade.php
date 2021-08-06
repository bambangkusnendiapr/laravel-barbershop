@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Check Booking</div>
                    <div class="card-body">
                      <form action="{{ route('booking.check') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                          <input type="text" required name="code" id="myInput" class="form-control" aria-label="Recipient's username" aria-describedby="button-addon2" placeholder="Input Your Code">
                          <button class="btn btn-secondary" type="submit" id="button-addon2">Check Code</button>
                        </div>
                      </form>

                      @role('superadmin|owner|staff')
                      <hr>
                      <table id="tabel" class="table table-striped mt-5">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>CODE</th>
                            <th>Customer</th>
                            <th>LUNAS</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($orders as $order)
                            <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>
                                <a href="{{ route('booking', $order->code) }}" class="text-decoration-none">
                                  {{ $order->code }}
                                </a>
                              </td>
                              <td>{{ $order->client->first_name }}</td>
                              <td>{{ $order->lunas }}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                      @endrole

                    </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
@endpush

@push('script')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script>
$(document).ready(function(){

  $('#tabel').DataTable();

});
</script>
@endpush