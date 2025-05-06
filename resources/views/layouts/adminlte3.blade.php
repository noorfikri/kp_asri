<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administrasi Toko ASRI | Dashboard</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/favicon.ico')}}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <script src="https://kit.fontawesome.com/a85611667c.js" crossorigin="anonymous"></script>
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/css/adminlte.css')}}">

  <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script type="text/javascript" src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE -->
    <script src="{{asset('assets/js/adminlte.js')}}"></script>

@yield('javascript')

</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('/admin')}}" class="nav-link">Home</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="{{asset(Auth::user()->profile_picture)}}" class="user-image img-circle elevation-2" alt="User Image">
          <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-primary">
            <img src="{{asset(Auth::user()->profile_picture)}}" class="img-circle elevation-2" alt="User Image">

            <p>
              {{ Auth::user()->name }} - {{ Auth::user()->category}}
              <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="#" class="btn btn-default btn-flat">Profil</a>
            <a class="btn btn-default btn-flat float-right" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link">
      <img src="{{asset('assets/img/Logo ASRI.png')}}" alt="ASRI Logo" class="brand-image" style="opacity: .8">
      <span class="brand-text font-weight-light">Administrasi Toko ASRI</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset(Auth::user()->profile_picture)}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
        <li class="nav-header">DASHBOARD</li>
        <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fa-solid fa-house"></i>
          <p>
            Dashboard
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{url('/admin')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Dashboard</p>
            </a>
          </li>
        </ul>
        </li>
        <li class="nav-header">Barang</li>
        <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fa-solid fa-boxes-stacked"></i>
          <p>
            Barang
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('categories.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Daftar Kategori</p>
            </a>
            <a href="{{route('items.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Daftar Barang</p>
            </a>
            <a href="{{route('brands.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Daftar Merek</p>
            </a>
          </li>
        </ul>
        </li>
        <li class="nav-header">Data Transaksi</li>
        <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fa-solid fa-cart-flatbed"></i>
          <p>
            Penjualan
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('sellingtransactions.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Transaksi Penjualan</p>
            </a>
        </li>
        </ul>
        </li>
        <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fa-solid fa-cart-arrow-down"></i>
          <p>
            Pembelian
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('buyingtransactions.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Transaksi Pembelian</p>
            </a>
          </li>
        </ul>
        </li>
        <li class="nav-header">SUPPLIER</li>
        <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fa-solid fa-truck"></i>
          <p>
            Supplier
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('suppliers.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Daftar Supplier</p>
            </a>
          </li>
        </ul>
        </li>
        <li class="nav-header">Laporan</li>
        <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fa-solid fa-clipboard-list"></i>
          <p>
            Laporan
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('reports.index')}}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Daftar Laporan</p>
            </a>
          </li>
        </ul>
        </li>
        <li class="nav-header">Pesan</li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fa-solid fa-envelope"></i>
            <p>
              Pesan
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('messages.index')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Daftar Pesan</p>
              </a>
            </li>
          </ul>
          </li>
        <li class="nav-header">Akun</li>
        @can('user-management-access',Auth::user())
        <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa-solid fa-user"></i>
              <p>
                Manajemen Akun
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('users.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Daftar Akun</p>
                </a>
              </li>
            </ul>
            </li>
        @endcan
        <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fa-solid fa-user"></i>
          <p>
            Akun
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Akun</p>
            </a>
          </li>
        </ul>
      </li>
        <li class="nav-header">Keluar</li>
        <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="nav-icon fa-solid fa-sign-out-alt"></i>
          <p>Keluar</p>
        </a>
        </li>
      </ul>
    </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    @yield('content')

  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
</div>
<!-- ./wrapper -->

<!-- OPTIONAL SCRIPTS -->
<!-- <script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script> -->
<!-- AdminLTE for demo purposes -->
<!-- <script src="{{asset('assets/js/demo.js')}}"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="{{asset('assets/js/pages/dashboard3.js')}}"></script> -->
</body>
</html>
