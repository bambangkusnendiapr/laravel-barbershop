@extends('layouts.master')

@section('content')

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">

      <!-- <p>{{  now()->format('d F Y H:i') }}</p>
      <p>{{  now() }}</p>
      <p> tambah 1 jam {{  now()->addHour(5) }}</p>
      <p> tambah 1 jam {{  now()->addMinutes(5) }}</p> -->

        @foreach($locations as $location)
          <div class="mb-4">
              <a href="{{ route('locationToService', $location->id) }}" class="btn btn-dark btn-lg w-100">{{ $location->name }}</a>
          </div>
        @endforeach

        <!-- @if(session('cart_location'))
          <p>{{ session('cart_location')['lokasi']['name'] }}</p>
          <p>ada cart location</p>
        @endif
        @if(session('cart_service'))
          <p>ada cart service</p>
        @endif
        @if(session('cart_staff'))
          <p>ada cart staff</p>
        @endif
        @if(session('cart_customer'))
          <p>ada cart customer</p>
        @endif -->

        <!-- <div>
          <a href="{{ route('unsetCart') }}" class="btn btn-danger">Unset All Cart</a>
        </div> -->

      </div>
    </div>
  </div>

@endsection