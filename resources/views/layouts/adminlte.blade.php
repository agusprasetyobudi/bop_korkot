<!DOCTYPE html>
<html lang="en">
<head> 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  {{-- <title>AdminLTE 3 | Dashboard 2</title> --}}
  {{-- @yield('title') --}}
  <title>{!! env('APP_NAMES') !!}</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/fontawesome-free/css/all.min.css') !!}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') !!}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{!! asset('assets/adminlte/dist/css/adminlte.min.css') !!}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  @yield('addtionalCSS')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
  @yield('navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @yield('sidebar')
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  @yield('page_header')
  @yield('body')
</div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  {{-- <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside> --}}
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; {!! now()->year !!} <a href="{!! URL::to('/') !!}" class="text-uppercase"> {!! env('APP_NAMES') !!}</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> {!! env('APP_VERS') !!}
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{!! asset('assets/adminlte/plugins/jquery/jqueryNew.js') !!}"></script>
<!-- Bootstrap -->
<script src="{!! asset('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<!-- overlayScrollbars -->
<script src="{!! asset('assets/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') !!}"></script>
<!-- AdminLTE App -->
<script src="{!! asset('assets/adminlte/dist/js/adminlte.js') !!}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{!! asset('assets/adminlte/dist/js/demo.js') !!}"></script>
@yield('addtionalJS')

@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"]) 
<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{!! asset('assets/adminlte/plugins/jquery-mousewheel/jquery.mousewheel.js') !!}"></script>
<script src="{!! asset('assets/adminlte/plugins/raphael/raphael.min.js') !!}"></script>
<script src="{!! asset('assets/adminlte/plugins/jquery-mapael/jquery.mapael.min.js') !!}"></script>
<script src="{!! asset('assets/adminlte/plugins/jquery-mapael/maps/usa_states.min.js') !!}"></script>
<!-- ChartJS -->
<script src="{!! asset('assets/adminlte/plugins/chart.js/Chart.min.js') !!}"></script>

<!-- PAGE SCRIPTS -->
<script src="{!! asset('assets/adminlte/dist/js/pages/dashboard2.js') !!}"></script>
</body>
</html>
