@extends('layouts.admin.main')
@section('dashboard', 'active')
@section('title', 'Dashboard')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $visitors->count() }}</h3>

              <p>Visitors</p>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-md-3 col-6">
          <!-- small box -->
          <div class="small-box bg-secondary">
            <div class="inner">
              <h3>{{ $staff->count() }}</h3>

              <p>Capster</p>
            </div>
            <div class="icon">
              <i class="fas fa-id-card"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-md-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $members->count() }}</h3>

              <p>Pelanggan</p>
            </div>
            <div class="icon">
              <i class="fas fa-user-tie"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-md-3 col-6">
          <!-- small box -->
          <div class="small-box bg-default">
            <div class="inner">
              <h3>{{ $locations->count() }}</h3>

              <p>Locations</p>
            </div>
            <div class="icon">
              <i class="fas fa-map-marker-alt"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <div class="row">
        <div class="col-md-4">
          <!-- small box -->
          <div class="small-box bg-dark">
            <div class="inner">
              <h3>{{ $services->count() }}</h3>

              <p>Services</p>
            </div>
            <div class="icon">
              <i class="fas fa-chair"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-md-4">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ $orders->count() }}</h3>

              <p>Orders</p>
            </div>
            <div class="icon">
              <i class="fas fa-chair"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-md-4">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $orders->sum('gross') }} K</h3>

              <p>Revenue</p>
            </div>
            <div class="icon">
              <i class="fas fa-money-bill-wave"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <div class="row">
        <div class="col-12">
          <!-- DONUT CHART -->
          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title">Grafik Order</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <table class="table table-striped table-sm">
                    <tr>
                      <th>Location</th>
                      <th>Orders</th>
                    </tr>
                    @foreach($locations as $location)
                      <tr>
                        <td>{{ $location->name }}</td>
                        <td>{{ $location->orders->count() }}</td>
                      </tr>
                    @endforeach
                    <tr>
                      <th>Total</th>
                      <th>{{ $orders->count() }}</th>
                    </tr>
                  </table>
                </div>
                <div class="col-md-6">
                  <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <!-- PIE CHART -->
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Grafik Revenue</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <table class="table table-striped table-sm">
                    <tr>
                      <th>Location</th>
                      <th>Orders</th>
                    </tr>
                    @foreach($locations as $location)
                      <tr>
                        <td>{{ $location->name }}</td>
                        <td>{{ $location->orders->sum('gross') }} K</td>
                      </tr>
                    @endforeach
                    <tr>
                      <th>Total</th>
                      <th>{{ $orders->sum('gross') }} K</th>
                    </tr>
                  </table>
                </div>
                <div class="col-md-6">
                  <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <!-- Bar chart -->
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">
                <i class="far fa-chart-bar"></i>
                Grafik Capster
              </h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <table class="table table-striped table-sm">
                    <tr>
                      <th>Location</th>
                      <th>Capster</th>
                    </tr>
                    @foreach($locations as $location)
                      <tr>
                        <td>{{ $location->name }}</td>
                        <td>{{ $staff->where('location_id', $location->id)->count() }}</td>
                      </tr>
                    @endforeach
                    <tr>
                      <th>Total</th>
                      <th>{{ $staff->count() }}</th>
                    </tr>
                  </table>
                </div>
                <div class="col-md-8">
                  <div id="bar-chart" style="height: 300px;"></div>
                </div>
              </div>
            </div>
            <!-- /.card-body-->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>

@endsection

@push('script')
<!-- ChartJS -->
<script src="{{ asset('admin/plugins/chart.js/Chart.min.js') }}"></script>
<!-- FLOT CHARTS -->
<script src="{{ asset('admin/plugins/flot/jquery.flot.js') }}"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="{{ asset('admin/plugins/flot/plugins/jquery.flot.resize.js') }}"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="{{ asset('admin/plugins/flot/plugins/jquery.flot.pie.js') }}"></script>
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
        @foreach($locations as $location)
          '{{ $location->name }}',
        @endforeach
      ],
      datasets: [
        {
          data: [
            @foreach($locations as $location)
            {{ $location->orders->count() }},
            @endforeach
            ],
          backgroundColor : [
            @foreach($locations as $location)
            '{{ $location->color }}',
            @endforeach
            ],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var revenueData        = {
      labels: [
        @foreach($locations as $location)
          '{{ $location->name }}',
        @endforeach
      ],
      datasets: [
        {
          data: [
            @foreach($locations as $location)
            {{ $location->orders->sum('gross') }},
            @endforeach
            ],
          backgroundColor : [
            @foreach($locations as $location)
            '{{ $location->color }}',
            @endforeach
            ],
        }
      ]
    }
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = revenueData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })

    /*
     * BAR CHART
     * ---------
     */

    var bar_data = {
      data : [
        @foreach($locations as $location)
          [{{ $loop->iteration }},{{ $staff->where('location_id', $location->id)->count() }}],
        @endforeach
        ],
      bars: { show: true }
    }
    $.plot('#bar-chart', [bar_data], {
      grid  : {
        borderWidth: 1,
        borderColor: '#f3f3f3',
        tickColor  : '#f3f3f3'
      },
      series: {
         bars: {
          show: true, barWidth: 0.5, align: 'center',
        },
      },
      colors: ['#3c8dbc'],
      xaxis : {
        ticks: [
          @foreach($locations as $location)
            [{{ $loop->iteration }},'{{ $location->name }}'],
          @endforeach
          ]
      }
    })
    /* END BAR CHART */

  })
</script>
@endpush