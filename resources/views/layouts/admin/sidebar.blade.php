<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/" class="brand-link">
    <img src="{{ asset('img/bukti_transfer/bukti.jpg') }}" alt="Barbershop Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Barbershop</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <!-- <div class="image">
        <img src="{{ asset('img/bukti_transfer/bukti.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div> -->
      <div class="info">
        <a href="{{ route('profile.index') }}" class="d-inline">{{ Auth::user()->first_name }}</a>@role('staff') &nbsp;
        <span class="right badge badge-primary">{{ Auth::user()->lokasi->name }}</span>@endrole
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
        @role('superadmin|owner')
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link @yield('dashboard')">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        @endrole
        <li class="nav-item">
          <a href="{{ route('order.index') }}" class="nav-link @yield('order')">
            <i class="nav-icon fas fa-chair"></i>
            <p>
              Order
            </p>
          </a>
        </li>
        @role('superadmin|owner')
        <li class="nav-item @yield('master_data')">
          <a href="#" class="nav-link @yield('location')">
            <i class="nav-icon fas fa-box-open"></i>
            <p>
              Master Data
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('location.index') }}" class="nav-link @yield('location')">
                <i class="far fa-circle nav-icon"></i>
                <p>Location</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('service.index') }}" class="nav-link @yield('service')">
                <i class="far fa-circle nav-icon"></i>
                <p>Service</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('category.index') }}" class="nav-link @yield('category')">
                <i class="far fa-circle nav-icon"></i>
                <p>Category</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('payment.index') }}" class="nav-link @yield('payment')">
                <i class="far fa-circle nav-icon"></i>
                <p>Payment</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('time.index') }}" class="nav-link @yield('time')">
                <i class="far fa-circle nav-icon"></i>
                <p>Time</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{ route('staff.index') }}" class="nav-link @yield('staff')">
            <i class="nav-icon fas fa-id-card"></i>
            <p>
              Capster
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pelanggan') }}" class="nav-link @yield('pelanggan')">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Pelanggan
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>
              Laporan
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link" data-toggle="modal" data-target="#modal-default">
                <i class="far fa-circle nav-icon"></i>
                <p>Pelayanan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link" data-toggle="modal" data-target="#modal-staff">
                <i class="far fa-circle nav-icon"></i>
                <p>Capster</p>
              </a>
            </li>
          </ul>
        </li>
        @endrole
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              Logout
            </p>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<div class="modal fade" id="modal-default">
  <form target="_blank" action="{{ route('laporan.pelayanan') }}" method="post">
  @csrf
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Cetak Laporan Pelayanan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <label>Dari Tangal</label>
              <input type="date" required name="dari" class="form-control">
            </div>
            <div class="col-md-6">
              <label>Sampai Tangal</label>
              <input type="date" required name="sampai" class="form-control">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Cetak</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  <!-- /.modal-dialog -->
  </form>
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-staff">
  <form target="_blank" action="{{ route('laporan.staff') }}" method="post">
  @csrf
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h4 class="modal-title">Cetak Laporan Capster</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <label>Dari Tangal</label>
              <input type="date" required name="dari" class="form-control">
            </div>
            <div class="col-md-6">
              <label>Sampai Tangal</label>
              <input type="date" required name="sampai" class="form-control">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Cetak</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </form>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->