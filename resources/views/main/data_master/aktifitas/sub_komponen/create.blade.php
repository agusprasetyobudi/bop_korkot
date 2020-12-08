@extends('layouts.adminlte')

@section('navbar')
    @include('layouts.partials.navbar')
@endsection

@section('sidebar')
    @include('layouts.partials.sidebar')
@endsection

@section('addtionalCSS')
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css') !!}">    
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/select2/css/select2.min.css') !!}">    
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}">
@endsection

@section('page_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Sub Komponen Aktifitas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('SubKomponenView',['id'=>$parent_id]) !!}">List Sub Komponen</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('AktifitasSubKomponen',['id'=>$id,'sub_id'=>$parent_id]) !!}">List Sub Komponen Aktifitas</a></li>
                        <li class="breadcrumb-item active">Tambah Sub Komponen Aktifitas</li>
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
                            Tambah Sub Komponen Aktifitas
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="" class="text-uppercase">nama aktifitas</label>
                                {{-- <input type="text" name="" id="" class="form-control nama-aktifitas" value="{!! $data !!}"> --}}
                                <select name="nama_aktifitas" class="form-control nama-aktifitas">
                                    @foreach ($data as $item) 
                                        <option value="{!! $item->id !!}">{!! $item->nama_aktifitas !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-warning btn-add">Tambah Data Aktifitas</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <form action="{!! route('AktifitasSubKomponenStore') !!}" method="post">
                        @csrf
                        <input type="hidden" name="urldata" value="{!! $parent_id !!}">
                        <input type="hidden" name="sub_urldata" value="{!! $id !!}">
                        <div class="card">
                            <div class="card-header">
                                List Tambah Data Sub Komponen Aktifitas
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
<script src="{!! asset('assets/adminlte/plugins/select2/js/select2.full.min.js') !!}"></script>
<script src="{!! asset('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<script>
$(()=>{
    $('.nama-aktifitas').select2({
        theme: 'bootstrap4',
        width: '100%'
        })
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
                    `${$('.nama-aktifitas option:selected').html()}<input type='hidden' name='nama_aktifitas[]' value="${GetNamaAktifitas}">`,
                    `<button data-id='${count}' data-val="${count}" type="button" class="btn circle btn-danger btn-delete-row"><i class="fa fa-trash"></i></button>`
                ]).draw(false)
                count++
                $('.nama-aktifitas').val('').trigger('change') 
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