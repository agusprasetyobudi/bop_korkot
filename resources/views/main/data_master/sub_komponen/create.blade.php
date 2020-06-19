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
                    <h1>Tambah Data Komponen Biaya</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('KomponenBiayaView') !!}">List Komponen Biaya</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('SubKomponenView',['id'=>Request::segment('4')]) !!}">List Sub Komponen Biaya</a></li>
                        <li class="breadcrumb-item active">Tambah Sub Komponen Biaya</li>
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
                        <div class="card-header">Tambah Data Komponen Biaya</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="" class="text-uppercase">Komponen Biaya</label>
                                <input type="text" name="" id="" class="form-control komponen-biaya">
                            </div>
                            <div class="form-group">
                                <label for="" class="text-uppercase"></label>
                                <input type="text" name="" id=""></div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-warning btn-add">Tambah Komponen Biaya</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <form action="{!! route('KomponenBiayaPost') !!}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-header">List Tambah Data Komponen Biaya</div>
                            <div class="card-body">
                                <table class="table table-bordered tablehover" id="tableKomponenBiaya">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-uppercase">#</th> 
                                            <th class="text-center text-uppercase">Komponen Biaya</th>
                                            <th class="text-center text-uppercase">Opsi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning btn-block">Simpan Data Komponen Biaya</button>
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
        let tables = $('#tableKomponenBiaya').DataTable({
            responsive: true,
            autoWidth: false,
            paging: false,
            searching: false,
            bSort: false,
            columnDefs:[
                {"className":"text-center","targets":"_all"}
            ]
        })
        let count = 1
        $('.btn-add').click(()=>{
            let GetKomponen = $('.komponen-biaya').val()
            if( GetKomponen != "" && GetKomponen != null && GetKomponen != undefined){
                if(count < 21){
                    tables.row.add([
                        `${count}`,
                        `${GetKomponen}<input type="hidden" name="komponen_biaya[]" value="${GetKomponen}"/>`,
                        `<button data-id="${count}" data-val="${count}" type="button" class="btn circle btn-danger btn-delete-row"><i class="fa fa-trash"></i></button>`
                    ]).draw(false)
                    count ++
                    $('.komponen-biaya').val('')
                }
            }else{
                alert('Komponen Biaya Tidak Boleh Kosong')
            }
        })

        $('#tableKomponenBiaya tbody').on('click', '.btn-delete-row', function(){
            tables
            .row($(this).parents('tr'))
            .remove()
            .draw()
            count--
        })
    })
</script>
@endsection