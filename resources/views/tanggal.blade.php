@extends('layouts.master')

@if(session('cart_location'))
  @php $judul = session('cart_location')['lokasi']['name']; @endphp
  @section('judul', 'Lokasi: '.$judul)
@endif

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
        <a href="/" class="btn btn-primary mb-3">Change Location</a>
        <a href="{{ route('locationToService', session('cart_location')['lokasi']['id']) }}" class="btn btn-success mb-3">Select Other Service</a>

        <div class="card">
          <div class="card-header bg-dark text-light">Date</div>
          <div class="card-body">

          <form action="{{ route('addTanggal') }}" method="post">
          @csrf
           <div class="mb-3 mt-3">
              <label class="form-label">Select Date</label>
              <input name="date" required type="date" class="form-control" min="2013-12-25"
              @if(session('cart_tanggal'))
                value="{{ session('cart_tanggal')['tanggal2'] }}""
              @endif
              >
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

@push('script')
<script>
  var today = new Date().toISOString().split('T')[0];
  document.getElementsByName("date")[0].setAttribute('min', today);
</script>
@endpush