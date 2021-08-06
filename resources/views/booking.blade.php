@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="alert {{ $order->lunas == 'Lunas' ? 'alert-success' : 'alert-danger' }}" role="alert">
            {{ $order->lunas }}
          </div>
            <div class="card">
                <div class="card-header">Booking Details | Code : {{ $order->code }}</div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="input-group mb-3">
                        <input type="text" id="myInput" readonly class="form-control" aria-label="Recipient's username" aria-describedby="button-addon2" value="{{ $order->code }}">
                        <button class="btn btn-secondary" type="button" onclick="myFunction()" id="button-addon2">Copy Code</button>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group mb-3">
                        <input type="text" id="myInput2" readonly class="form-control" aria-label="Recipient's username" aria-describedby="button-addon2" value="{{ route('booking', $order->code) }}">
                        <button class="btn btn-secondary" onclick="myFunction2()" type="button" id="button-addon2">Copy Link</button>
                      </div>
                    </div>
                  </div>
                  <table class="table">
                    <tr>
                      <th>SERVICE NAME</th>
                      <th>DURATION</th>
                    </tr>
                    @foreach($order->service as $service)
                      <tr>
                        <td>
                          {{ $service->name }} | <small class="text-primary">Ksh {{ $service->price }}</small>
                        </td>
                        <td>{{ $service->duration }} {{ $service->time }}</td>
                      </tr>
                    @endforeach
                    <tr>
                      <th>Barber</th>
                      <th>{{ $order->employee->first_name }}</th>
                    </tr>
                    <tr>
                      <th>Date</th>
                      <th>{{ $order->date->format("d M, Y h:i A") }}</th>
                    </tr>
                    <tr>
                      <th>Place</th>
                      <th>{{ $order->lokasi->name }}</th>
                    </tr>
                    <tr>
                      <th>Net Total</th>
                      <th>Ksh {{ $order->net }}</th>
                    </tr>
                    <tr>
                      <th>Tax</th>
                      <th>{{ $order->tax }}</th>
                    </tr>
                    <tr>
                      <th>Gross</th>
                      <th>Ksh {{ $order->gross }}</th>
                    </tr>
                  </table>
                </div>
                @if($order->lunas == 'Belum Lunas')
                  @role('superadmin|owner|staff')
                    <form action="{{ route('lunas', $order->id) }}" method="post" class="d-inline" id="id_form">
                    @method('put')
                    @csrf
                      <input type="hidden" name="id" value="{{ $order->id }}">
                      <div class="card-footer">
                        <button type="submit" class="btn btn-success w-100">Confirm Lunas</button>
                      </div>
                    </form>
                  @endrole
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Copied the code: " + copyText.value);
}
function myFunction2() {
  var copyText = document.getElementById("myInput2");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Copied the link: " + copyText.value);
}
</script>
@endpush