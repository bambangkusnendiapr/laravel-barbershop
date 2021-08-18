@extends('layouts.master')

@section('content')

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">

        <form class="d-flex" action="{{ route('search.code') }}">
          <input class="form-control me-2" required type="text" value="{{ request('search') }}" name="search" placeholder="Search Order Code" aria-label="Search">
          <button class="btn btn-outline-dark" type="submit">Search</button>
        </form>

        @if ($search == true)
          <div class="alert alert-warning alert-dismissible fade show mt-5" role="alert">
            Data Not Found
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

      </div>
    </div>
  </div>

@endsection