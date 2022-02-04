@extends('layouts.master')

@section('content')

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">

        <div class="table-responsive">
          <table class="table table-striped">
            <tr>
              <th>#</th>
              <th>Tanggal</th>
              <th>Waktu</th>
              <th>Pelanggan</th>
              <th>Capster</th>
              <th>Lokasi</th>
            </tr>
            @foreach($order as $data)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->date->format('d F Y') }}</td>
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

@endsection