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
        <a href="{{ route('tanggal') }}" class="btn btn-secondary mb-3">Change Date</a>

        <div class="card">
          <div class="card-header bg-dark text-light">Capster and Time</div>
          <div class="card-body">

          <form action="{{ route('addStaff') }}" method="post">
          @csrf
              <input name="date" required type="hidden" class="form-control" min="2013-12-25"
              @if(session('cart_tanggal'))
                value="{{ session('cart_tanggal')['tanggal2'] }}"
              @endif
              >
           <div>
             <label for="">Select Capster</label>
             <select name="staff" required class="form-select" aria-label="Default select example">
              <option selected disabled value="">Select Capster</option>
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

    <br>

    <div class="row justify-content-center">
      <div class="col-md-8">

        <div class="card">
          <div class="card-header">
            Antrian Tanggal @if(session('cart_tanggal')) {{ session('cart_tanggal')['tanggal2'] }} @endif
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped">
                <tr>
                  <th>#</th>
                  <th>Waktu</th>
                  <th>Pelanggan</th>
                  <th>Capster</th>
                  <th>Lokasi</th>
                </tr>
                @foreach($antrian as $data)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->time->jam }}</td>
                    <td>{{ $data->client->first_name }}</td>
                    <td>{{ $data->employee->first_name }}</td>
                    <td>{{ $data->lokasi->name }}</td>
                  </tr>
                @endforeach
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

@endsection

