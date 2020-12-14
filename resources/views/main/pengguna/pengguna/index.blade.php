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
                    <h1>List Pengguna</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/')!!}">Home</a></li>
                        <li class="breadcrumb-item active">List Pengguna</li>
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
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5>Data Pengguna</h5>
                                </div>
                                <div class="col-lg-6 text-right">
                                    <a href="{!! route('PenggunaCreate') !!}" class="btn btn-warning">Tambah Data Pengguna</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-bordered" id="tableDataPengguna">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase">#</th>
                                        <th class="text-center text-uppercase">name</th>
                                        <th class="text-center text-uppercase">username</th>
                                        <th class="text-center text-uppercase">osp</th>
                                        <th class="text-center text-uppercase">kantor</th>
                                        <th class="text-center text-uppercase">jabatan</th>
                                        <th class="text-center text-uppercase">group</th>
                                        <th class="text-center text-uppercase">opsi</th>
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

@section('addtionalJS')
<!-- DataTables -->
<script src="{!! asset('assets/adminlte/plugins/datatables/jquery.dataTables.min.js') !!}"></script>
<script src="{!! asset('assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') !!}"></script>
<script src="{!! asset('assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') !!}"></script>
<script src="{!! asset('assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') !!}"></script>
<script>
  $(()=>{
      let tables = $("#tableDataPengguna").DataTable({
          responsive: true,
          autoWidth: false,
          paging: true,
          lengthChange: true,
          searching: true,
          processing: true,
          ajax: "{!! route('PenggunaView') !!}",
          columns:[
              {data: 'DT_RowIndex', className:'text-center text-uppercase'},
              {data: 'name', className:'text-center text-uppercase'},
              {data: 'username', className:'text-center text-uppercase'},
              {data: 'osp', className:'text-center text-uppercase'},
              {data: 'kantor', className:'text-center text-uppercase'},
              {data: 'jabatan', className:'text-center text-uppercase'},
              {data: 'groups', className:'text-center text-uppercase'},
              {data: 'opsi', className:'text-center text-uppercase'},
          ]
      })
  })
</script>    
@endsection