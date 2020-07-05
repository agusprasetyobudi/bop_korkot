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
                    <h1>Tambah Amandemen</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="li breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('AmandemenView') !!}">Amandemen</a></li>
                        <li class="breadcrumb-item active">Tambah Amandemen</li>
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
                        <div class="card-header">Tambah Data Amandemen</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="" class="text-uppercase">kode amandemen</label>
                                <input type="text" class="form-control kode_amandemen">
                            </div>
                            <div class="form-group">
                                <label for="" class="text-uppercase">nama amandemen</label>
                                <input type="text" class="form-control nama_amandemen">
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-warning btn-add">Tambah Data Amandemen</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <form action="{!! route('AmandemenCreatePost') !!}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-header">List Data Amandemen</div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover" id="tableAmandemen">
                                    <thead>
                                        <tr>
                                            <th class="tex-center text-uppercase">#</th>
                                            <th class="tex-center text-uppercase">kode amandemen</th>
                                            <th class="tex-center text-uppercase">nama amandemen</th>
                                            <th class="tex-center text-uppercase">opsi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning btn-block">Tambah Data Amandemen</button>
                            </div>
                        </div>
                    </form>
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
    <script src="{!! asset('assets/adminlte/plugins/select2/js/select2.full.min.js') !!}"></script>
    <script src="{!! asset('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
    <script>
        $(()=>{
            let tables = $('#tableAmandemen').DataTable({
                    responsive: true,
                    autoWidth: false,
                    paging: false,
                    lengthChange:false,
                    searching: false,
                    bSort: false,
                    columnDefs: [
                        {"className": "text-center", "targets": "_all"}
                    ]
            })
            let count = 1
            $('.btn-add').click(()=>{
                let kode_amandemen = $('.kode_amandemen').val(),
                nama_amandemen = $('.nama_amandemen').val()
                
                if(kode_amandemen !='' && nama_amandemen != ''){
                    tables.row.add([
                        `${count}`,
                        `${$('.kode_amandemen').val()}<input type="hidden" name="kode_amandemen[]" value="${kode_amandemen}">`,
                        `${$('.nama_amandemen').val()}<input type="hidden" name="nama_amandemen[]" value="${nama_amandemen}">`,
                        `<button data-id='${count}' data-val='${count}' type='button' class='btn circle btn-danger btn-delete-row'><i class='fa fa-trash'></i></button>`,
                    ])
                    .draw(false)
                    count ++
                    $('.kode_amandemen').val(null)
                    $('.nama_amandemen').val(null)
                }else if(kode_amandemen == '' || kode_amandemen == null || kode_amandemen == undefined){
                    alert('Kode Amandemen Tidak Boleh Kosong')
                }else if(nama_amandemen == '' || nama_amandemen == null || nama_amandemen == undefined){
                    alert('Nama Amandemen Tidak Boleh Kosong')
                } 
            })
            $('#tableAmandemen tbody').on( 'click', '.btn-delete-row', function () {
                tables
                .row( $(this).parents('tr') )
                .remove()
                .draw();
                count--
                })
        })
    </script>
    
@endsection