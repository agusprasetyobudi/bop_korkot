@extends('layouts.adminlte')

@section('navbar')
    @include('layouts.partials.navbar')
@endsection

@section('sidebar')
    @include('layouts.partials.sidebar')
@endsection

@section('page_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Report Buku Bank</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li class="breadcrumb-item active">Report Buku Bank</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('addtionalCSS')
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css') !!}">
@endsection

@section('body')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Report Buku Bank</h5>
                        </div>
                        <div class="card-body">
                            <label for="" class="text-uppercase">Reprot Buku Bank</label>
                            <div class="row">
                                <div class="col-md-3">
                                    <select name="" id="" class="form-control">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="" id="" class="form-control">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="" id="" class="form-control">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="" id="" class="form-control">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-warning">proses</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body text-right"></div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="tableReportBukuBank">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase">#</th>
                                        <th class="text-center text-uppercase">tanggal</th>
                                        <th class="text-center text-uppercase">uraian</th>
                                        <th class="text-center text-uppercase">no bukti</th>
                                        <th class="text-center text-uppercase">transaksi debet</th>
                                        <th class="text-center text-uppercase">transaksi kredit</th>
                                        <th class="text-center text-uppercase">saldo debet</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-warning"><i class="far fa-file-excel"></i> Export</button>
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
     let tables = $('#tableReportBukuBank').DataTable({
         pagging: true,
         lengthChange:true,
         searching: true
     })
 })
</script>
@endsection