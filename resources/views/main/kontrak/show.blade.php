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
                    <h1>Detail Kontrak</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('KontrakHome') !!}">Kontrak</a></li>
                        <li class="breadcrumb-item active">Kontrak Detail</li>
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
                        <div class="card-body text-right">
                            <div class="card-body text-right"><a href="{!! route('KontrakDetailCreate',['id'=> Request::segment(2)]) !!}" class="btn btn-warning">Tambah Data Detail Kontrak</a></div>
                        </div> 
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="tableKontrakDetail">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase">#</th>
                                        <th class="text-center text-uppercase">komponen</th>
                                        <th class="text-center text-uppercase">sub komponen</th>
                                        <th class="text-center text-uppercase">aktifitas</th>
                                        <th class="text-center text-uppercase">osp</th>
                                        <th class="text-center text-uppercase">kantor</th>
                                        <th class="text-center text-uppercase">nominal</th>
                                        <th class="text-center text-uppercase">provinsi asal</th>
                                        <th class="text-center text-uppercase">kabupaten asal</th>
                                        <th class="text-center text-uppercase">provinsi tujuan</th>
                                        <th class="text-center text-uppercase">kabupaten tujuan</th>
                                        <th class="text-center text-uppercase">amandemen</th>
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
            let tables = $('#tableKontrakDetail').DataTable({
                responsive:true,
                autoWidth: false,
                paging: true,
                lengthChange: true,
                searching: true,
                ajax: "{!! route('KontrakViewDetail',['id'=>Request::segment(2)]) !!}",
                columns:[
                    {data:'DT_RowIndex', className: 'text-center text-uppercase'},
                    {data:'komponen', className: 'text-center text-uppercase'},
                    {data:'sub_komponen', className: 'text-center text-uppercase'},
                    {data:'aktifitas', className: 'text-center text-uppercase'},
                    {data:'osp', className: 'text-center text-uppercase'},
                    {data:'kantor', className: 'text-center text-uppercase'},
                    {data:'nominal', className: 'text-center text-uppercase'},
                    {data:'provinsi_asal', className: 'text-center text-uppercase'},
                    {data:'kabupaten_asal', className: 'text-center text-uppercase'},
                    {data:'provinsi_tujuan', className: 'text-center text-uppercase'},
                    {data:'kabupaten_tujuan', className: 'text-center text-uppercase'},
                    {data:'amandemen', className: 'text-center text-uppercase'},
                    {data:'action', className: 'text-center text-uppercase'},
                ]
            })
            $('#tableKontrakDetail tbody').on('click', 'button', tables, function () { 
            if(confirm('Anda yakin mau menghapus item ini ?')){
                    const id = $(this).data('name');
                    let url = "{{ route('KontrakDestroyDetail', ':id') }}";
                        url = url.replace(':id', id);
                        document.location.href=url; 
                } 
            })
        })
    </script>
@endsection
