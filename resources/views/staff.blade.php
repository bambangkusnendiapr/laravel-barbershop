@extends('layouts.master')

@section('content')

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">

        @if ($message = Session::get('warning'))
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <a href="/cart" class="btn btn-dark mb-3"><i class="bi bi-arrow-left"></i> Back</a>

        <div class="card">
          <div class="card-header bg-dark text-light">Staff and DateTime</div>
          <div class="card-body">

          @if(session('cart_location'))
            <div class="d-inline">Location : {{ session('cart_location')['lokasi']['name'] }}</div>
            <a href="/" class="btn btn-dark mb-3 btn-sm d-inline">Change Location</a>
          @endif

          <br><br>
          <div>
            @if(session('cart'))
              <div class="d-inline">{{ count((array) session('cart')) }} Services</div>
              <a href="{{ route('locationToService', session('cart_location')['lokasi']['id']) }}" class="btn btn-dark mb-3 btn-sm d-inline">Select Other Service</a>
            @endif
          </div>

          <br>

          <form action="{{ route('addStaff') }}" method="post">
          @csrf
           <div>
             <label for="">Select Staff</label>
             <select name="staff" required class="form-select" aria-label="Default select example">
              <option selected disabled value="">Select Staff</option>
              @foreach($staffs as $staff)
                <option value="{{ $staff->id }}"
                @if(session('cart_staff'))
                  {{ session('cart_staff')['staf_id'] == $staff->id ? 'selected':'' }}
                @endif
                  >{{ $staff->first_name }}</option>
              @endforeach
            </select>
           </div>
           <div class="mb-3 mt-3">
              <label class="form-label">Select Date</label>
              <input name="date" required type="date" class="form-control" min="2018-06-07T08:00" max="2022-06-14T22:00"
              @if(session('cart_staff'))
                value="{{ session('cart_staff')['date'] }}""
              @endif
              >
            </div>
           <div class="mb-3 mt-3">
              <label class="form-label">Select Time</label>
              <select name="time" required class="form-select" aria-label="Default select example">
                <option selected disabled value="">Select Time</option>
                @foreach($times as $time)
                  <option value="{{ $time->id }}"
                  @if(session('cart_staff'))
                    {{ session('cart_staff')['time'] == $time->id ? 'selected':'' }}
                  @endif
                    >{{ $time->jam }}</option>
                @endforeach
              </select>
            </div>
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