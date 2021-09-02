@extends('layouts.master')

@if(session('cart_location'))
  @php $judul = session('cart_location')['lokasi']['name']; @endphp
  @section('judul', 'Lokasi: '.$judul)
@endif

@section('content')

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">

        <a href="/" class="btn btn-dark mb-3"><i class="bi bi-arrow-left"></i> Back</a>
        <a href="/" class="btn btn-primary mb-3">Change Location</a>

      @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ $message }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <div class="card">
        <form action="{{ route('front') }}">
          <div class="card-header bg-dark text-light">Services</div>
          <div class="card-body">
     
            @foreach($categories as $category)
              <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="heading{{ $category->id }}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $category->id }}" aria-expanded="true" aria-controls="collapse{{ $category->id }}">
                      {{ $category->name }}
                    </button>
                  </h2>
                  <div id="collapse{{ $category->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $category->id }}" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <table class="table table-striped">
                        @foreach($category->services as $service)
                          <tr>
                            <td>
                              <span>{{ $service->name }}</span><br>
                              <span class="form-check-label text-muted" for="flexCheckDefault">
                                  {{ $service->duration }} {{ $service->time }}
                              </span> |
                              <span class="form-check-label text-primary" for="flexCheckDefault">
                                  <strong>{{ $service->price }}K</strong>
                              </span>
                            </td>
                            <td><a href="{{ route('addToCart', $service->id) }}" class="btn btn-secondary">Add</a></td>
                          </tr>
                        @endforeach
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
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
                <a href="{{ route('cart') }}" type="submit" class="btn btn-light w-100">VIEW SUMMERY</a>
              </div>
            </div>
          </div>
        </form>
      </div>

      </div>
    </div>
  </div>

@endsection