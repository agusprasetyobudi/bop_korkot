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
        <h1>Rekapitulasi Kontrak</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
            <li class="breadcrumb-item active">Rekapitulasi Kontrak</li>
        </ol>
        </div>
    </div>
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('body')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>
                                Rekapitulasi Sisa Kontrak
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="" class="text-uppercase">osp</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select name="" id="" class="form-control">
                                            <option value="">1</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select name="" id="" class="form-control">
                                            <option value="">1</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="text-uppercase">periode invoice</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <select name="" id="" class="form-control">
                                            <option value="">2</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="" id="" class="form-control">
                                            <option value="">3</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="" id="" class="form-control">
                                            <option value="">4</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-warning">View</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>
                                Komponen Biaya Kontrak
                            </h5>
                        </div>
                        <div class="card-body text-right"></div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="tableRekapKontrak">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase">#</th>
                                        <th class="text-center text-uppercase">kode rab</th>
                                        <th class="text-center text-uppercase">komponen</th>
                                        <th class="text-center text-uppercase">subkomponen/aktifitas</th>
                                        <th class="text-center text-uppercase">kontrak amandemen</th>
                                        <th class="text-center text-uppercase">invoice lalu</th>
                                        <th class="text-center text-uppercase">invoice saat ini</th>
                                        <th class="text-center text-uppercase">invoice s/d saat ini</th>
                                        <th class="text-center text-uppercase">sisa kontrak</th>
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
            let tables = $("#tableRekapKontrak").DataTable({
                paging: true,
                lengthChange: true,
                searching: true
            })
        })
    </script>
@endsection