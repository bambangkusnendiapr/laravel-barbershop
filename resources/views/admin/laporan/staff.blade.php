<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Barbershop | Laporan Pelayanan</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <i class="fas fa-globe"></i> Barbershop.
          <small class="float-right">Date: {{ $dari->format('d F Y') }} - {{ $sampai->format('d F Y') }}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>

    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>#</th>
            <th>Staff</th>
            <th>Melayani</th>
            <th>Jumlah</th>
          </tr>
          </thead>
          <tbody>
              @foreach($staff as $staff)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $staff->first_name }}</td>
                  <td>{{ $orders->where('staff', $staff->id)->count() }} x</td>
                  <td>{{ $orders->where('staff', $staff->id)->sum('gross') }} K</td>
                </tr>
              @endforeach
          </tbody>
          <tfoot>
              <tr>
                  <th colspan="2" class="text-center">Total</th>
                  <th>{{ $orders->count() }} x</th>
                  <th>{{ $orders->sum('gross') }} K</th>
              </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>