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
        <h1>Rekapitulasi Input Level PMU</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
            <li class="breadcrumb-item active">Rekapitulasi Input Level PMU</li>
        </ol>
        </div>
    </div>
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('body')
<section class="content"></section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body text-right">
                        <a href="{!! route('rekapInputCreated') !!}" class="btn btn-default">Tambah Rekapitulasi</a>
                    </div>
                    <div class="card-body">
                        <table id="tableRekapitulas" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase">#</th>
                                    <th class="text-center text-uppercase">no bukti transfer</th>
                                    <th class="text-center text-uppercase">tanggal transfer</th>
                                    <th class="text-center text-uppercase">nama penerima</th>
                                    <th class="text-center text-uppercase">bank penerima</th>
                                    <th class="text-center text-uppercase">no rekening penerima</th>
                                    <th class="text-center text-uppercase">nilai kontrak</th>
                                    <th class="text-center text-uppercase">jumlah diterima</th>
                                    <th class="text-center text-uppercase">selisih</th>
                                    <th class="text-center text-uppercase">periode</th>
                                    <th class="text-center text-uppercase">jumlah diterima</th>
                                    <th class="text-center text-uppercase">selisih</th>
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
        let tables = $('#tableRekapitulas').DataTable({
            paging: true,
            lengthChange: true,
            searching:true
        })
    })
</script>
@endsection