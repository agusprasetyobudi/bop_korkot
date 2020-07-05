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
                    <h1>Tambah Jabatan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('JabatanView') !!}">Jabatan</a></li>
                        <li class="breadcrumb-item active">Tambah Jabatan</li>
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
                        <div class="card-header">Tambah Data Jabatan</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="" class="text-uppercase">kode jabatan</label>
                                <input type="text" class="form-control kode-jabatan">
                            </div>
                            <div class="form-group">
                                <label for="" class="text-uppercase">nama jabatan</label>
                                <input type="text" class="form-control nama-jabatan">
                            </div>
                            <div class="form-group">
                                <label for="" class="text-uppercase">posisi kantor</label>
                                <select class="form-control posisi-kantor text-uppercase">
                                    <option selected disabled class="text-uppercase">pilih posisi kantor</option>
                                    <option value="korkot" class="text-uppercase">korkot</option>
                                    <option value="askot" class="text-uppercase">askot</option>
                                    <option value="provinsi" class="text-uppercase">provinsi</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-warning btn-add">Tambah Data Jabatan</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <form action="{!! route('JabatanCreate') !!}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-header">List Data Tambah Jabatan</div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover dataTable dtr-inline tableTambahJabatan" role="grid" aria-describedby="example2_info">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-center">#</th>
                                            <th class="text-uppercase text-center">kode jabatan</th>
                                            <th class="text-uppercase text-center">nama jabatan</th>
                                            <th class="text-uppercase text-center">posisi kantor</th>
                                            <th class="text-uppercase text-center">opsi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-warning btn-block">Simpan Data Jabatan</button>
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
        let tables = $('.tableTambahJabatan').DataTable({
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
        $('.posisi-kantor').select2({  
            width: '100%',
            theme:'bootstrap4',
            containerCssClass: 'text-uppercase',
            dropdownCssClass: 'text-uppercase'
        })
        let count = 1
        $('.btn-add').click(()=>{
            let GetKodeJabatan = $('.kode-jabatan').val(),
            GetNamaJabatan  = $('.nama-jabatan').val(),
            GetPosisiKantor = $('.posisi-kantor').val()
            if(GetKodeJabatan != "" && GetNamaJabatan != "" && GetPosisiKantor != "" && GetPosisiKantor != undefined){
                if(count < 21){
                    tables.row.add([
                    `${count}`,
                    `${GetKodeJabatan}<input name='kode_jabatan[]' type='hidden' value='${GetKodeJabatan}'/>`,
                    `${GetNamaJabatan}<input name='nama_jabatan[]' type='hidden' value='${GetNamaJabatan}'/>`,
                    `${$('.posisi-kantor option:selected').html()}<input name='posisi_kantor[]' type='hidden' value='${GetPosisiKantor}'/>`,
                    `<button data-id='${count}' data-val='${count}' type='button' class='btn circle btn-danger btn-delete-row'><i class='fa fa-trash'></i></button>`,
                    ]).draw(false)
                    count ++
                $('.kode-jabatan').val(null)
                $('.nama-jabatan').val(null)
                $('.posisi-kantor').val('pilih posisi kantor').trigger('change')
                }
            }else if(GetKodeJabatan == null ||GetKodeJabatan == ""){
                alert('Kode Jabatan Tidak Boleh Kosong')
            }else if(GetNamaJabatan == null || GetNamaJabatan ==""){
                alert('Nama Jabatan Tidak Boleh Kosong')
            }else if(GetPosisiKantor == null || GetPosisiKantor =="" || GetPosisiKantor == undefined){
                alert('Posisi Kantor Tidak Boleh Kosong')
            }
        })
        $('.tableTambahJabatan tbody').on('click', '.btn-delete-row', function (){
            tables
            .row($(this).parents('tr'))
            .remove()
            .draw()
            count--
        })
    })
</script>    
@endsection