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
                <h1>List Error Reporting</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                <li class="breadcrumb-item"><a href="{!! route('ListWebErrorReporting') !!}">Error Reporting</a></li>
                <li class="breadcrumb-item active">List Error Reporting</li>
            </ol>
            </div>
        </div>
        </div>
    </section>
@endsection

@section('body')
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body text-right">
                            <a href="{!! route('bukuBankCreate') !!}" class="btn btn-default">Tambah Data Buku Bank</a>
                        </div>
                        <div class="card-body">
                            <table id="tableErrorData" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase">#</th>
                                        <th class="text-center text-uppercase">Error Code</th>
                                        <th class="text-center text-uppercase">Message Error</th>
                                        <th class="text-center text-uppercase">Url</th>
                                        <th class="text-center text-uppercase">Has User Error</th> 
                                        <th class="text-center text-uppercase">Action</th>
                                    </tr>
                                </thead> 
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- @section('addtionalJS')
    <!-- DataTables -->
  <script src="{!! asset('assets/adminlte/plugins/datatables/jquery.dataTables.min.js') !!}"></script>
  <script src="{!! asset('assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') !!}"></script>
  <script src="{!! asset('assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') !!}"></script>
  <script src="{!! asset('assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') !!}"></script>
  <script>
      $(()=>{
          let tables = $("#tableErrorData").DataTable({
              paging: true,
              lengthChange: true,
              searching: true
          })
      })
  </script>
@endsection --}}