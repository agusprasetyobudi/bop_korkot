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
                    <h1>List Sub Komponen Aktifitas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('SubKomponenView',['id'=>$id]) !!}">List Sub Komponen</a></li>
                        <li class="breadcrumb-item active">List Sub Komponen Aktifitas</li>
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
                            <h5>Data Sub Komponen Aktifitas</h5>
                        </div>
                        <div class="card-body text-right">
                            <a href="{!! route('AktifitasSubKomponenAdd',['id'=>$id, 'sub_id'=>$parent_id]) !!}" class="btn btn-warning">Tambah Sub Komponen Aktifitas</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="tableAktifitas">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase">#</th>
                                        <th class="text-center text-uppercase">Aktifitas</th>
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
        let tables = $('#tableAktifitas').DataTable({
            pagging: true,
            lengthChange:true,
            ajax: "{!! route('AktifitasSubKomponen',['id'=>Request::segment(4),'sub_id'=>Request::segment(5)]) !!}",
                columns:[
                    {data: 'DT_RowIndex', className:'text-center'},
                    {data: 'nama_aktifitas', className:'text-center'}, 
                    {data: 'action', className:'text-center'}
                ],
        })
        $('#tableAktifitas tbody').on('click', 'button', tables, function () { 
            if(confirm('Anda yakin mau menghapus item ini ?')){
                    const id = $(this).data('name');
                    const sub_id = $(this).data('name');
                    let url = "{{ route('AktifitasSubKomponenDestroy', ['id'=>':id','sub_id'=>':sub_id']) }}";
                        url = url.replace(':id', id);
                        url = url.replace(':sub_id', sub_id);
                        // alert(url);
                        // console.log(url)
                        document.location.href=url; 
                } 
        })
    })
    </script>  
@endsection