<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Purple Admin</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />

    <script>
      $(document).ready(function() {
          $('.js-example-basic-single').select2();
      });
  </script>
  </head>
  <body>
    <div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center justify-content-between">
              <a href="https://www.bootstrapdash.com/product/purple-bootstrap-admin-template/"><i class="mdi mdi-home me-3 text-white"></i></a>
              <button id="bannerClose" class="btn border-0 p-0">
                <i class="mdi mdi-close text-white me-0"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-center">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <li class="nav-item d-flex align-items-center h-100">
            <a class="nav-link">
              <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
            </a>
          </li>
          <ul class="navbar-nav navbar-nav-right">
          </ul>
        </div>
      </nav>
      <div class="container-fluid page-body-wrapper">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="assets/images/faces/face1.jpg" alt="profile">
                  <span class="login-status online"></span>
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">David Grey. H</span>
                  <span class="text-secondary text-small">Project Manager</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="dashboard">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#tambah" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Tambah</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-plus-box menu-icon"></i>
              </a>
              <div class="collapse" id="tambah">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item mdi mdi-book-multiple-variant"> <a class="nav-link" href="{{ url('proyek') }}">Proyek</a></li>
                  <li class="nav-item mdi mdi-account-multiple"> <a class="nav-link" href="{{ url('tim') }}">Tim</a></li>
                  <li class="nav-item mdi mdi-account"> <a class="nav-link" href="{{ url('anggota') }}">Anggota</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#list" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">List</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-menu menu-icon"></i>
              </a>
              <div class="collapse" id="list">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item mdi mdi-book-multiple-variant"> <a class="nav-link" href="{{ url('listproyek') }}">Proyek</a></li>
                  <li class="nav-item mdi mdi-account-multiple"> <a class="nav-link" href="{{ url('listim') }}">Tim</a></li>
                  <li class="nav-item mdi mdi-account"> <a class="nav-link" href="{{ url('listanggota') }}">Anggota</a></li>
                </ul>
              </div>
            </li>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
            <li class="nav-item">
              <a class="nav-link" href="route('logout')" onclick="event.preventDefault();
              this.closest('form').submit();">
                <span class="menu-title">Logout</span>
                <i class="mdi mdi-logout menu-icon"></i>
              </a>
            </li>
            </form>
          </ul>
        </nav>
        <div class="main-panel">
          <div class="content-wrapper">
            @yield('content')
          </div>
          <footer class="footer">
            <div class="container-fluid d-flex justify-content-between">
              <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Made by Kelompok 7 IF4B with Purple Admin</span>
            </div>
          </footer>
        </div>
      </div>
    </div>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/todolist.js"></script>
  </body>
</html>