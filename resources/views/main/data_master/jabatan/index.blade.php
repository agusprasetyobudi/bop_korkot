@extends('layouts.adminlte')

@section('navbar')
    @include('layouts.partials.navbar')
@endsection

@section('sidebar')
    @include('layouts.partials.sidebar')
@endsection

@section('addtionalCSS')
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') !!}">
@endsection

@section('page_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List Jabatan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">List Jabatan</li>
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
                            <h5>Data Jabatan</h5>
                        </div>
                        <div class="card-body text-right">
                            <a href="{!! route('JabatanCreate') !!}" class="btn btn-warning">Tambah Data Jabatan</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover dataTable dtr-inline" id="tableJabatan">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-center">#</th>
                                        <th class="text-uppercase text-center">kode jabatan</th>
                                        <th class="text-uppercase text-center">jabatan</th>
                                        <th class="text-uppercase text-center">posisi kantor</th>
                                        <th class="text-uppercase text-center">opsi</th>
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
    let tables = $('#tableJabatan').DataTable({ 
        responsive: true,
        autoWidth: false,
        pagging: true,
        lengthChange:true,
        searching: true,
        ajax:"{!! route('JabatanView') !!}",
        columns:[
            {data:'DT_RowIndex', className: 'text-center text-uppercase'},
            {data:'kode_jabatan', className: 'text-center text-uppercase'},
            {data:'nama_jabatan', className: 'text-center text-uppercase'},
            {data:'posisi_kantor', className: 'text-center text-uppercase'}, 
            {data:'action', className: 'text-center'},
        ]
    })
    $('#tableJabatan tbody').on('click', 'button', tables, function () { 
            if(confirm('Anda yakin mau menghapus item ini ?')){
                    const id = $(this).data('name');
                    let url = "{{ route('JabatanDestroy', ':id') }}";
                        url = url.replace(':id', id);
                        document.location.href=url; 
                } 
    })
})
</script>
    
@endsection