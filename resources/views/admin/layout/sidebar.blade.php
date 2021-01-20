<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('template/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('variable.sort_webname') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('template/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ session('nama_admin') }}</a>
          <small class="text-light">{{ session('level') }}</small>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::segment(2) == '' ? 'active':'' }}">
              <i class="fas fa-tachometer-alt nav-icon"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-header">MASTER DATA</li>
          <li class="nav-item">
            <a href="{{ route('admin.admin.index') }}" class="nav-link {{ Request::segment(2) == 'admin' ? 'active':'' }}">
              <i class="fas fa-user nav-icon"></i>
              <p>Admin</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.ppat.index') }}" class="nav-link {{ Request::segment(2) == 'ppat' ? 'active':'' }}">
              <i class="fas fa-users nav-icon"></i>
              <p>PPAT</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.wp.index') }}" class="nav-link {{ Request::segment(2) == 'wp' ? 'active':'' }}">
              <i class="fas fa-users nav-icon"></i>
              <p>Wajib Pajak</p>
            </a>
          </li>
          <li class="nav-header">TRANSAKSI</li>
          <li class="nav-item  {{ Request::segment(2) == 'transaksi' ? 'menu-open':'' }}">
            <a href="#" class="nav-link  {{ Request::segment(2) == 'transaksi' ? 'active':'' }}">
              <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>
                DATA TRANSAKSI
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.transaksi.didaftarkan') }}" class="nav-link  {{ Request::segment(3) == 'didaftarkan' ? 'active':'' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Didaftarkan</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.transaksi.diperiksa') }}" class="nav-link  {{ Request::segment(3) == 'diperiksa' ? 'active':'' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Diperiksa</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.transaksi.ditolak') }}" class="nav-link  {{ Request::segment(3) == 'ditolak' ? 'active':'' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ditolak</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>