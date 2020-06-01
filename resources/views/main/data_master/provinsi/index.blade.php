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
                    <h1>List Provinsi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">List Provinsi</li>
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
                        <div class="card-header">
                            <h5>List Provinsi</h5>
                        </div>
                        <div class="card-body text-right">
                            <a href="{!! route('provinsiCreate') !!}" class="btn btn-warning">Tambah Provinsi</a>
                            {{-- <button class="btn btn-warning">Tambah Provinsi</button> --}}
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="tableProvinsi">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-center">id</th>
                                        <th class="text-uppercase text-center">provinsi</th>
                                        <th class="text-uppercase text-center">opsi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div class="col-lg-12">
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
        let tables = $('#tableProvinsi').DataTable({
            paging: true,
            lengthChange:true,
            searching: true,
            ajax: "{!! route('provinsiView') !!}",
            columns:[
                {data: 'DT_RowIndex', className:'text-center'},
                {data: 'provinsi_name', className:'text-center'},
                {data: 'action', className:'text-center'}
            ],
            // columnDefs: [
            // {"className": "text-center", "targets": "_all"},
        })
    })
    </script>
@endsection