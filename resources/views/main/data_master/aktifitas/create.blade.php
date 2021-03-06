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
                    <h1>Tambah Data Aktifitas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('AktifitasView') !!}">List Aktifitas</a></li>
                        <li class="breadcrumb-item active">Tambah Aktifitas</li>
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
                            Tambah Data Aktifitas
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="" class="text-uppercase">nama aktifitas</label>
                                <input type="text" name="" id="" class="form-control nama-aktifitas">
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-warning btn-add">Tambah Data Aktifitas</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <form action="{!! route('AktifitasPost') !!}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                List Tambah Data Aktifitas
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover tableTambahAktifitas">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-uppercase">#</th>
                                            <th class="text-center text-uppercase">nama aktifitas</th>
                                            <th class="text-center text-uppercase">opsi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning btn-block">Simpan Data Aktifitas</button>
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
<script>
$(()=>{
    let tables = $('.tableTambahAktifitas').DataTable({
        paging: false,
        lengthChange:false,
        searching: false,
        bSort: false,
        columnDefs:[
            {"className": "text-center","targets": "_all"}
        ]
    })
    let count = 1
    $('.btn-add').click(()=>{
        let GetNamaAktifitas = $('.nama-aktifitas').val()
        if(GetNamaAktifitas !="" && GetNamaAktifitas != null && GetNamaAktifitas != undefined){
            if(count < 21){
                tables.row.add([
                    `${count}`,
                    `${GetNamaAktifitas}<input type='hidden' name='nama_aktifitas[]' value="${GetNamaAktifitas}">`,
                    `<button data-id='${count}' data-val="${count}" type="button" class="btn circle btn-danger btn-delete-row"><i class="fa fa-trash"></i></button>`
                ]).draw(false)
                count++
                $('.nama-aktifitas').val(null) 
            }
        }else{
            alert('Nama Aktifitas Tidak Boleh Kosong')
        }
    })
    $('.tableTambahAktifitas').on('click','.btn-delete-row', function(){
        tables
        .row($(this).parents('tr'))
        .remove()
        .draw()
        count--
    })
})
</script>  
    
@endsection