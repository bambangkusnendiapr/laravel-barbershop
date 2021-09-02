@extends('layouts.master')

@if(session('cart_location'))
  @php $judul = session('cart_location')['lokasi']['name']; @endphp
  @section('judul', 'Lokasi: '.$judul)
@endif

@section('content')

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">    

        <a href="{{ route('locationToService', session('cart_location')['lokasi']['id']) }}" class="btn btn-dark mb-3"><i class="bi bi-arrow-left"></i> Back</a>
        <a href="/" class="btn btn-primary mb-3">Change Location</a>
        <a href="{{ route('locationToService', session('cart_location')['lokasi']['id']) }}" class="btn btn-success mb-3">Select Other Service</a>

      <div class="card">
        <form action="{{ route('front') }}">
          <div class="card-header bg-dark text-light">Summery</div>
          <div class="card-body">
            <div>
              @if(session('cart'))
                <div class="d-inline">{{ count((array) session('cart')) }} Services</div>
              @endif
            </div>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Service</th>
                  <th>Price</th>
                  <th>QTY</th>
                  <th>Sub Total</th>
                  <th>Action</th>
                </tr>
              </thead>
            @php $total = 0; @endphp
              @if(session('cart'))
                @foreach(session('cart') as $id => $details)
                  @php $total += $details['price'] * $details['quantity'] @endphp
                  <tr>
                    <td>{{ $details['name'] }}</td>
                    <td>{{ $details['price'] }} K</td>
                    <td><input type="number" value="{{ $details['quantity'] }}" class="form-control quantity" /></td>
                    <td>{{ $details['price'] * $details['quantity'] }} K</td>
                    <td>
                      <button class="btn btn-info btn-sm update-cart d-inline" data-id="{{ $id }}"><i class="bi bi-arrow-clockwise"></i></button>
                      <a href="{{ route('deleteService', $id) }}" class="btn btn-sm btn-danger d-inline"><i class="bi bi-trash"></i></a>
                    </td>
                  </tr>
                @endforeach
            @endif
            </table>
          </div>
          <div class="card-footer bg-dark">
            <div class="row">
              <div class="col-md-6">
                  <span class="text-light">GRAND TOTAL :  Ksh {{ $total }}</span>
              </div>
              <div class="col-md-6">
                <a href="{{ route('staff') }}" type="submit" class="btn btn-light w-100">NEXT</a>
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