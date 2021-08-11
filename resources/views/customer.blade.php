@extends('layouts.master')

@section('content')

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">

        <a href="/staff" class="btn btn-dark mb-3"><i class="bi bi-arrow-left"></i> Back</a>

      <div class="card">
        <form action="{{ route('addCustomer') }}" method="post">
          @csrf
          <div class="card-header bg-dark text-light">Staff and DateTime</div>
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

            <div class="mb-3">
              <input name="first" type="text" required class="form-control" placeholder="First Name*"
              @if(session('cart_customer'))
                value="{{ session('cart_customer')['first'] }}"
              @endif
              >
            </div>
            <div class="mb-3">
              <input name="last" type="text" required class="form-control" placeholder="Last Name*"
              @if(session('cart_customer'))
                value="{{ session('cart_customer')['last'] }}"
              @endif
              >
            </div>
            <div class="mb-3">
              <input name="email" type="email" required class="form-control" placeholder="Email*"
              @if(session('cart_customer'))
                value="{{ session('cart_customer')['email'] }}"
              @endif
              >
            </div>
            <div class="mb-3">
              <input name="phone" type="number" required class="form-control" placeholder="Phone*"
              @if(session('cart_customer'))
                value="{{ session('cart_customer')['phone'] }}"
              @endif
              >
            </div>
            <div class="mb-3">
              <input name="address" type="text" class="form-control" placeholder="Address"
              @if(session('cart_customer'))
                value="{{ session('cart_customer')['address'] }}"
              @endif
              >
            </div>
            <div class="mb-3">
              @if(session('cart_customer') && session('cart_customer')['note'] != null)
                <textarea name="note" class="form-control" rows="3">{{ session('cart_customer')['note'] }}</textarea>
              @else
                <textarea name="note" class="form-control" rows="3" placeholder="Booking Note"></textarea>
              @endif
            </div>
          <div class="card-footer bg-dark">
            <div class="row">
              <div class="col-md-6">
                @if(session('cart'))
                  @php $total = 0; @endphp
                  @foreach(session('cart') as $id => $details)
                    @php $total += $details['price'] * $details['quantity'] @endphp
                  @endforeach
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