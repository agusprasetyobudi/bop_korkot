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
    
@endsection

@section('body')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Kantor</h5>
                        </div>
                        <div class="card-body text-right">
                            <a href="#" class="btn btn-warning">Tambah Data Kantor</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="tableKantor">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-center">#</th>
                                        <th class="text-uppercase text-center">kode kantor</th>
                                        <th class="text-uppercase text-center">osp</th>
                                        <th class="text-uppercase text-center">provinsi</th>
                                        <th class="text-uppercase text-center">kabupaten</th>
                                        <th class="text-uppercase text-center">nama kantor</th>
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
    let tables = $('#tableKantor').DataTable({
        pagging: true,
        lengthChange:true,
        searching: true
    })
})
</script>
    
@endsection