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
                    <h1>Tambah Data Kontrak</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('KontrakHome') !!}">Kontrak</a></li>
                        <li class="breadcrumb-item active">Tambah Data Kontrak</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('body')
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <form action="POST"> 
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">Form Kontrak</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="" class="text-uppercase">kode Kontrak</label>
                                                <input type="text" name="kode_kontrak" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="text-uppercase">tanggal kontrak </label>
                                                <input type="text" name="tanggal_kontrak" id="" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="" class="text-uppercase">tanggal kontrak dimulai</label>
                                                <input type="text" name="tanggal_kontrak_mulai" id="" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="text-uppercase">tanggal kontrak akhir</label>
                                                <input type="text" name="tanggal_kontrak_akhir" id="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">Komponen Biaya Kontrak</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="" class="text-uppercase">Komponen Biaya</label>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <select name="" id="" class="form-control">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select name="" id="" class="form-control">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select name="" id="" class="form-control">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-uppercase" >start periode</label>
                                                <input type="text" name="start_periode" id="" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="text-uppercase">amandemen/nominal</label>
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                         <input type="text" name="amandemen" id="" class="form-control text-center" value="1">
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="nominal" id="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="" class="text-uppercase">dari/ke</label>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input type="text" name="dari" id="" class="form-control text-uppercase" placeholder="dari">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" name="ke" id="" class="form-control text-uppercase" placeholder="ke">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="text-uppercase">finish periode</label>
                                                <input type="text" name="finish_periode" id="" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="text-uppercase">kantor</label>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <select name="osp" id="" class="form-control">
                                                            <option value="">1</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <select name="kantor" id="" class="form-control">
                                                            <option value="">2</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <input type="button" value="Tambah Item" class="btn btn-default float-right">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="card"> 
                                <div class="card-body">
                                    <table id="tableTambahDataKontrak" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center text-uppercase">#</th>
                                                <th class="text-center text-uppercase">Komponen</th>
                                                <th class="text-center text-uppercase">Sub Komponen</th>
                                                <th class="text-center text-uppercase">aktifitas</th>
                                                <th class="text-center text-uppercase">dari</th>
                                                <th class="text-center text-uppercase">ke</th>
                                                <th class="text-center text-uppercase">start periode</th>
                                                <th class="text-center text-uppercase">finish periode</th>
                                                <th class="text-center text-uppercase">amandemen</th>
                                                <th class="text-center text-uppercase">nilai Kontrak</th>
                                                <th class="text-center text-uppercase">kantor</th>
                                                <th class="text-center text-uppercase">Opsi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div> 
                                <div class="card-footer">
                                    <button class="btn btn-warning btn-lg btn-block">Simpan Data</button>
                                </div>
                            </div>
                        </div>
                    </div> 
                </form>
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
            let tables = $('#tableTambahDataKontrak').DataTable({
                paging: false,
                lengthChange: false,
                searching: false
            })
        })
    </script>
@endsection
