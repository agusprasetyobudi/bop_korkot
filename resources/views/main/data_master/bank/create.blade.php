@extends('layouts.adminlte')

@section('navbar')
    @include('layouts.partials.navbar')
@endsection

@section('sidebar')
    @include('layouts.partials.sidebar')
@endsection

@section('addtionalCSS') 
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') !!}">    
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}">   
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/select2/css/select2.min.css') !!}">    
@endsection

@section('page_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Bank</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('BankView') !!}">Bank</a></li>
                        <li class="breadcrumb-item active">Tambah Bank</li>
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
                        <div class="card-header">Tambah Data Bank</div>
                        <div class="card-body"> 
                            <div class="form-group">
                                <label for="" class="text-uppercase">nama bank</label>
                                <input type="text" class="form-control nama-bank">
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-warning btn-add">Tambah Data Bank</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <form action="{!! route('BankPost') !!}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-header">List Data Tambah Bank</div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover dataTable dtr-inline tableTambahBank" role="grid" aria-describedby="example2_info">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-center">#</th>
                                            <th class="text-uppercase text-center">Nama Bank</th>
                                            <th class="text-uppercase text-center">opsi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-warning btn-block">Simpan Data Bank</button>
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
        let tables = $('.tableTambahBank').DataTable({
            responsive: true,
            autoWidth: false,
            paging:false,
            lengthChange:false,
            searching:false,
            bSort: false,
            columnDefs:[
                {"className":"text-center text-uppercase","targets":"_all"}
            ]
        }) 
        let count = 1
        $('.btn-add').click(()=>{
            let GetNamaBank = $('.nama-bank').val()
            if(GetNamaBank != ""){
                if(count < 21){
                    tables.row.add([
                    `${count}`,
                    `${GetNamaBank}<input name='nama_bank[]' type='hidden' value='${GetNamaBank}'/>`, 
                    `<button data-id='${count}' data-val='${count}' type='button' class='btn circle btn-danger btn-delete-row'><i class='fa fa-trash'></i></button>`,
                    ]).draw(false)
                    count ++
                $('.nama-bank').val(null)
                }
            }else{
                alert('Nama Bank Tidak Boleh Kosong')
            }
        })
        $('.tableTambahBank tbody').on('click', '.btn-delete-row', function (){
            tables
            .row($(this).parents('tr'))
            .remove()
            .draw()
            count--
        })
    })
</script>    
@endsection