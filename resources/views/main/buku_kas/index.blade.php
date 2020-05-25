@extends('layouts.adminlte')

@section('navbar')
    @include('layouts.partials.navbar')
@endsection

@section('sidebar')
    @include('layouts.partials.sidebar')
@endsection

@section('addtionalCSS')
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css') !!}">
@endsection

@section('page_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Buku Kas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li class="breadcrumb-item active">Buku Kas</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('body')
    <section class="content">
       <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body text-right">
                        <a href="{!! route('bukuKasCreate') !!}" class="btn btn-default">Tambah Data Buku Kas</a>
                    </div>
                    <div class="card-body">
                        <table id="tableBukuKas" class="table table-bordered table-hover">
                            <thead>
                                <th class="text-center text-uppercase">#</th>
                                <th class="text-center text-uppercase">no bukti thansfer</th>
                                <th class="text-center text-uppercase">tanggal</th>
                                <th class="text-center text-uppercase">uraian</th>
                                <th class="text-center text-uppercase">no bukti</th>
                                <th class="text-center text-uppercase">transaksi debet</th>
                                <th class="text-center text-uppercase">transaksi kredit</th>
                                <th class="text-center text-uppercase">saldo debet</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
       </div>
    </section>
@endsection

@section('addtionalJS')
    <!-- DataTables -->
  <script src="{!! asset('assets/adminlte/plugins/datatables/jquery.dataTables.min.js') !!}"></script>
  <script src="{!! asset('assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') !!}"></script>
  <script src="{!! asset('assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') !!}"></script>
  <script src="{!! asset('assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') !!}"></script>
  <script>
      $(()=>{
          let tables = $("#tableBukuKas").DataTable({
              paging: true,
              lengthChange: true,
              searching: true
          })
      })
  </script>
@endsection