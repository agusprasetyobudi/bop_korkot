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
                    <h1>Tambah Data Kantor</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('KantorView') !!}">Kantor</a></li>
                        <li class="breadcrumb-item active">Tambah Kantor</li>
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
                            Tambah Data Kantor
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="" class="text-uppercase">kode kantor</label>
                                <input type="text" id="kode_kantor" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="text-uppercase">osp</label>
                                <select id="osp" class="form-control osp-select" required>
                                    <option disabled selected>Pilih OSP</option>
                                    @foreach ($osp as $item)
                                        <option value="{!! $item->id !!}">{!! $item->osp_name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="text-uppercase">provinsi</label>
                                <select id="provinsi" class="form-control provinsi-select" required>
                                    <option disabled selected>Pilih Provinsi</option>
                                    @foreach ($provinsi as $item)
                                        <option value="{!! $item->id !!}">{!! $item->provinsi_name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="text-uppercase">kabupaten</label>
                                <select id="kabupaten" class="form-control kabupaten-select" required>
                                    <option disabled selected>Pilih Kota/Kabupaten</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" class="text-uppercase">nama kantor</label>
                                <input type="text" id="nama_kantor" class="form-control" required>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-warning btn-add-kantor">Tambah Data Kantor</button>
                        </div> 
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                    <form action="{!! route('KantorPost') !!}" method="post">
                        @csrf
                        <div class="card-header">List Data Kantor</div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="tableDataKantor">
                                <thead>
                                    <tr>
                                        <th class="tex-center text-uppercase">#</th>
                                        <th class="tex-center text-uppercase">kode kantor</th>
                                        <th class="tex-center text-uppercase">osp</th>
                                        <th class="tex-center text-uppercase">provinsi</th>
                                        <th class="tex-center text-uppercase">kabupaten</th>
                                        <th class="tex-center text-uppercase">nama kantor</th>
                                        <th class="tex-center text-uppercase">opsi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-warning btn-block">Simpang Data Kantor</button>
                        </div>
                    </form>
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
<script src="{!! asset('assets/adminlte/plugins/select2/js/select2.full.min.js') !!}"></script>
<script src="{!! asset('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<script>
    $(()=>{
        $('.osp-select').select2({
        theme: 'bootstrap4',
        width: '100%'
        })
        $('.provinsi-select').select2({
        theme: 'bootstrap4',
        width: '100%'
        }) 
        $('.kabupaten-select').select2({
        theme: 'bootstrap4',,
        width: '100%'
        ajax:{
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{!! route('GetKabupatenKota') !!}",
            dataType: 'json',
            type: 'POST',
            data:function(term){
                return {
                    id: $('.provinsi-select').find('option:selected').val()
                }
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        // console.log(item)
                        return {
                            text: item.kabupaten_name,
                            id: item.id
                        }
                    })
                };
            }
        }
        })
        let tables = $('#tableDataKantor').DataTable({
            paging: false,
            lengthChange: false,
            searching: false,
            columnDefs: [
                {"className": "text-center", "targets": "_all"}
            ]
        })

        let count = 1
        $('.btn-add-kantor').click(()=>{
            let GetKodeKantor = $('#kode_kantor').val(),
            GetOSP = $('#osp').val(),
            GetProvinsi = $('#provinsi').val(),
            GetKabupaten = $('#kabupaten').val(),
            GetNamaKantor = $('#nama_kantor').val()
            if(GetKodeKantor !="" && GetOSP != ""&&GetProvinsi != "" && GetKabupaten != "" && GetNamaKantor!=""){                
                // console.log({
                //     kode_kantor: GetKodeKantor,
                //     osp : GetOSP,
                //     provinsi: GetProvinsi,
                //     kabupaten: GetKabupaten,
                //     nama_kantor: GetNamaKantor
                // })
                if(count < 21){
                tables.row.add([
                    `${count}`,
                    `${$('#kode_kantor').val()}<input name='kode_kantor[]' type='hidden' value='${GetKodeKantor}' />`,
                    `${$('#osp option:selected').html()}<input name='osp_id[]' type='hidden' value='${GetOSP}' />`,
                    `${$('#provinsi option:selected').html()}<input name='provinsi_id[]' type='hidden' value='${GetProvinsi}' />`,
                    `${$('#kabupaten option:selected').html()}<input name='kabupaten_id[]' type='hidden' value='${GetKabupaten}' />`,
                    `${$('#nama_kantor').val()}<input name='nama_kantor[]' type='hidden' value='${GetNamaKantor}' />`,
                    `<button data-id='${count}' data-val='${count}' type='button' class='btn circle btn-danger btn-delete-row'><i class='fa fa-trash'></i></button>`,
                ]).draw(false)
                count++ 
                $('#kode_kantor').val(null) 
                $('#osp').val('').trigger('change')
                $('#provinsi').val('').trigger('change')
                $('#kabupaten').val('').trigger('change')
                $('#nama_kantor').val('').trigger('change')
                }else{
                    alert('Data Yang Ditambahkan Mencapai Maksimum')
                }
            }else if(GetKodeKantor =="" || GetKodeKantor == null){
                alert('Kode Kantor Tidak Boleh Kosong')
            }else if(GetOSP == "" || GetOSP == null){
                alert('OSP Tidak Boleh Kosong')
            }else if(GetProvinsi == "" || GetProvinsi == null){
                alert('Provinsi Tidak Boleh Kosong')
            }else if(GetKabupaten == "" || GetKabupaten == null){
                alert('Kabupaten Tidak Boleh Kosong')
            }else if(GetNamaKantor == "" || GetNamaKantor == null){
                alert('Nama Kantor Tidak Boleh Kosong')
            }
        })
        $('#tableDataKantor tbody').on( 'click', '.btn-delete-row', function () {
        tables
        .row( $(this).parents('tr') )
        .remove()
        .draw();
        count--
        })
    })
</script>
@endsection