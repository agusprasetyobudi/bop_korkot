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
                    <h1>List Kabupaten</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li class="breadcrumb-item active">List Kabupaten</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('body')
    <section class="content">
        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Data Kabupaten</h5>
                    </div>
                    <div class="card-body text-right">
                        <a href="{!! route('KabupatenKotaCreate') !!}" class="btn btn-warning">Tambah Kabupaten</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="tableKabupaten">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-center">id</th>
                                    <th class="text-uppercase text-center">nama kota/kabupaten</th>
                                    <th class="text-uppercase text-center">nama provinsi</th>
                                    <th class="text-uppercase text-center">opsi</th>
                                </tr>
                            </thead>
                        </table>
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
          let tables = $('#tableKabupaten').DataTable({
                pagging: true,
                lengthChange:true,
                searching: true,
                ajax: "{!! route('KabupatenKotaView') !!}",
                columns:[
                    {data: 'DT_RowIndex', className:'text-center'},
                    {data: 'kabupaten_name', className:'text-center'},
                    {data: 'provinsi_name', className:'text-center'},
                    {data: 'action', className:'text-center'}
                ],
          })
      })
      </script>
@endsection