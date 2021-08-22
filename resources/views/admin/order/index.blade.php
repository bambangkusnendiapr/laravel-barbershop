@extends('layouts.admin.main')
@section('order', 'active')
@section('title', 'Order')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Order</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Order</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  
  <!-- Main content -->
  <section class="content">
    
    <div class="container-fluid">
      @if ($message = Session::get('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
      <div class="row">
        <div class="col-12">
          <!-- Default box -->
          <div class="card">
              <div class="card-header">
                <a href="{{ route('order.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Create order</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-sm table-striped" width="100%">
                  <thead>
                  <tr class="text-center">
                    <th>#</th>
                    <th>Bukti Transfer</th>
                    <th>Code</th>
                    <th>Customer</th>
                    <th>Staff</th>
                    <th>Location</th>
                    <th>Payment</th>
                    <th>DateTime</th>
                    <th>Net</th>
                    <th>Tax</th>
                    <th>Gross</th>
                    <th>Lunas</th>
                    <th>Note</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($orders as $order)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>
                      @if($order->images)
                        <a href="#" data-toggle="modal" data-target="#modal-default{{ $order->id }}">
                          <img id="img" src="{{ url('img/bukti_transfer/')}}/{{ $order->images }}" width="50px"/>
                        </a>
                      @else
                      Belum Transfer
                      @endif
                    </td>
                    <td>{{ $order->code }}</td>
                    <td>{{ $order->client->first_name }}</td>
                    <td>{{ $order->employee->first_name }}</td>
                    <td>{{ $order->lokasi->name }}</td>
                    <td>{{ $order->payment->bank }} a.n {{ $order->payment->an }}, {{ $order->payment->norek }}</td>
                    <td>{{ $order->date->format('d F Y H:m') }}</td>
                    <td>{{ $order->net }}</td>
                    <td>{{ $order->tax }}</td>
                    <td>{{ $order->gross }}</td>
                    <td>{{ $order->lunas }}</td>
                    <td>{{ $order->note }}</td>
                    <td class="text-center">
                      <form action="{{ route('order.destroy', $order->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="loc">
                        <div class="d-flex flex-row bd-highlight mb-3">
                          @if($order->lunas != 'Approved')
                            <a href="{{ route('order.approve', $order->id) }}" class="mr-1 btn btn-success btn-sm">approve</a>
                          @endif
                          <a href="{{ route('order.show', $order->id) }}" class="mr-1 btn btn-info btn-sm">detail</a>
                          <a href="{{ route('order.edit', $order->id) }}" class="mr-1 btn btn-warning btn-sm">edit</a>
                          <button type="submit" class="mr-1 btn btn-danger btn-sm">delete</button>
                        </div>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>

@foreach($orders as $order)
<div class="modal fade" id="modal-default{{ $order->id }}">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Bukti Transfer</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="d-flex justify-content-center">
          <img id="img" src="{{ url('img/bukti_transfer/')}}/{{ $order->images }}" width="250px"/>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endforeach

@endsection

@push('style')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@push('script')
<!-- DataTables  & Plugins -->
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "scrollX": true,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endpush