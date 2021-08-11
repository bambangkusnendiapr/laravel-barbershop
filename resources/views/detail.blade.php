@extends('layouts.master')

@section('content')

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">

        <a href="/customer" class="btn btn-dark mb-3"><i class="bi bi-arrow-left"></i> Back</a>

      <div class="card">
        <form action="{{ route('addPayment') }}" method="post">
          @csrf
          <div class="card-header bg-dark text-light">Booking Detail</div>
          <div class="card-body">

            @if(session('cart_location'))
              <div>
                <div class="d-inline">Location : {{ session('cart_location')['lokasi']['name'] }}</div>
                <a href="/" class="btn btn-dark mb-3 btn-sm d-inline">Change Location</a>
              </div>
            @endif

            @if(session('cart'))
              <div>
                <div class="d-inline">{{ count((array) session('cart')) }} Services</div>
                <a href="{{ route('locationToService', session('cart_location')['lokasi']['id']) }}" class="btn btn-dark mb-3 btn-sm d-inline">Select Other Service</a>
              </div>
            @endif

            @if(session('cart_staff'))
              <div>
                <div class="d-inline">Staff :  {{ session('cart_staff')['name'] }} | Date Time :  {{ session('cart_staff')['date_time']->format('d F Y H:m') }}</div>
                <a href="/staff" class="btn btn-dark mb-3 btn-sm d-inline">Change Staff or Date Time</a>
              </div>
            @endif

            <br>

            <table class="table table-striped">
                <tr>
                  <th>SERVICE</th>
                  <th>DURATION</th>
                </tr>
                @php $total = 0; @endphp
                @if(session('cart'))
                  @foreach(session('cart') as $id => $details)
                  @php $total += $details['price'] * $details['quantity'] @endphp
                    <tr>
                      <td>{{ $details['name'] }}</td>
                      <td>{{ $details['duration'] }} {{ $details['time'] }}</td>
                    </tr>
                  @endforeach
                @endif
                <tr>
                  <th>Barber</th>
                  @php $cart_staff = session()->get('cart_staff'); @endphp
                  <td>{{ $cart_staff['name'] }}</td>
                </tr>
                <tr>
                  <th>Date</th>
                  <td>{{ $cart_staff['date_time']->format('d F Y H:m') }}</td>
                </tr>
                <tr>
                  <th>Place</th>
                  <td>
                    @foreach(session('cart_location') as $id => $details)
                      {{ $details['name'] }}
                    @endforeach
                  </td>
                </tr>
                <tr>
                  <th>Net Total</th>
                  <td>{{ $total }}</td>
                </tr>
                <tr>
                  <th>Tax</th>
                  <td>0.0</td>
                </tr>
                <tr>
                  <th>Gross</th>
                  <td>{{ $total }}</td>
                </tr>
            </table>

            <div>
              <label for="">Select Payment</label>
              <select required name="payment" class="form-select" aria-label="Default select example">
                <option selected disabled value="">Select Payment</option>
                @foreach($payments as $payment)
                  <option value="{{ $payment->id }}">{{ $payment->bank }} | {{ $payment->norek }} | a.n {{ $payment->an }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="card-footer bg-dark">
            <div class="row">
              <div class="col-md-6">
                @if(session('cart'))
                  <span class="text-light">{{ count((array) session('cart')) }} Service | Ksh {{ $total }}</span>
                @endif
              </div>
              <div class="col-md-6">
                <button type="submit" class="btn btn-light w-100">NEXT</button>
              </div>
            </div>
          </div>
        </form>
      </div>

      </div>
    </div>
  </div>

@endsection