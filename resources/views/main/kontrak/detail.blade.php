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
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/daterangepicker/daterangepicker.css') !!}">
@endsection

@section('page_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Data Komponen Biaya Kontrak</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('KontrakHome') !!}">Kontrak</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('KontrakViewDetail',['id'=> Request::segment(2)]) !!}">Kontrak Detail</a></li>
                        <li class="breadcrumb-item active">Tambah Data Komponen Biaya Kontrak</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('body')
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    {{-- <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">Form Kontrak</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="" class="text-uppercase">kode Kontrak</label>
                                            <input type="text" class="form-control kode-kontrak">
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="text-uppercase">tanggal kontrak </label>
                                            <input type="text" class="form-control" value="{!! $date_now !!}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="" class="text-uppercase">tanggal kontrak dimulai</label>
                                            <input type="text" class="form-control kontrak-mulai" value="{!! $date_now !!}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="text-uppercase">tanggal kontrak akhir</label>
                                            <input type="text" class="form-control kontrak-akhir" value="{!! $date_now !!}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div> --}}
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">Komponen Biaya Kontrak</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="" class="text-uppercase">Komponen Biaya</label>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <select class="form-control komponen"> 
                                                    </select>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <select class="form-control sub-komponen">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <select class="form-control sub-aktifitas">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-uppercase" >start periode</label>
                                            <input type="text" class="form-control dates-start">
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="text-uppercase">amandemen/nominal</label>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                     {{-- <input type="text" class="form-control text-center amandemen"> --}}
                                                     <select  class="form-control amandemen"> 
                                                    </select>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control nominal">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="" class="text-uppercase">asal/tujuan</label>
                                            <div class="row">
                                                <div class="col-sm-6"> 
                                                    <select class="form-control text-uppercase provinsi-dari"></select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <select class="form-control text-uppercase provinsi-ke"></select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group"> 
                                            <div class="row">
                                                <div class="col-sm-6"> 
                                                    <select class="form-control text-uppercase kabupaten-dari"></select>
                                                </div>
                                                <div class="col-sm-6"> 
                                                    <select class="form-control text-uppercase kabupaten-ke"></select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="text-uppercase">finish periode</label>
                                            <input type="text" class="form-control dates-end">
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="text-uppercase">kantor</label>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <select class="form-control osp">
                                                        {{-- <option value="">1</option> --}}
                                                    </select>
                                                </div>
                                                <div class="col-sm-9">
                                                    <select class="form-control kantor">
                                                        {{-- <option value="">2</option> --}}
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="button" value="Tambah Item" class="btn btn-default btn-add float-right">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <form action="{!! route('KontrakDetailCreatePost',['id'=>Request::segment(2)]) !!}" method="post">
                            @csrf
                            <input type="hidden" name="urldata" class="kode-kontrak-post" value="{!! Request::segment(2) !!}"> 
                            <div class="card"> 
                                <div class="card-header">
                                    List Data Kontrak
                                </div>
                                <div class="card-body">
                                    <table id="tableTambahDataKontrak" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center text-uppercase">#</th>
                                                <th class="text-center text-uppercase">Komponen</th>
                                                <th class="text-center text-uppercase">Sub Komponen</th>
                                                <th class="text-center text-uppercase">aktifitas</th>
                                                <th class="text-center text-uppercase">asal</th>
                                                <th class="text-center text-uppercase">tujuan</th>
                                                <th class="text-center text-uppercase">start periode</th>
                                                <th class="text-center text-uppercase">finish periode</th>
                                                <th class="text-center text-uppercase">amandemen</th>
                                                <th class="text-center text-uppercase">nilai Kontrak</th>
                                                <th class="text-center text-uppercase">kantor</th>
                                                <th class="text-center text-uppercase">Opsi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div> 
                                <div class="card-footer">
                                    <button class="btn btn-warning btn-lg btn-block">Simpan Data</button>
                                </div>
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
    <script src="{!! asset('assets/adminlte/plugins/moment/moment.min.js') !!}"></script>
    <script src="{!! asset('assets/adminlte/plugins/daterangepicker/daterangepicker.js') !!}"></script>
    <script>
            $(()=>{
                $('.amandemen').select2({
                    placeholder: 'Pilih Amandemen',
                    theme: 'bootstrap4',
                    width: '100%',
                    ajax:{
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: "{!! route('AmandemenGetAPI') !!}",
                        dataType: 'json',
                        type: 'GET', 
                        processResults: function (data) { 
                            return {
                                results: $.map(data, function (item) { 
                                    let name_amandemen = `${item.kode_amandemen} - ${item.nama_amandemen}`
                                    return { 
                                        text: name_amandemen,
                                        id: item.id
                                    }
                                })
                            };
                        }
                    }
                })
                $('.komponen').select2({
                    placeholder: 'Pilih Komponen',
                    theme: 'bootstrap4',
                    width: '100%',
                    ajax:{
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: "{!! route('GetKomponenAPI') !!}",
                        dataType: 'json',
                        type: 'GET',
                        data:function(term){ 
                            return { 
                                q: $.trim(term.term)
                            }
                        },
                        processResults: function (data) { 
                            return {
                                results: $.map(data, function (item) {
                                    // console.log(item)
                                    return {
                                        text: item.nama_komponen,
                                        id: item.id
                                    }
                                })
                            };
                        }
                    }
                })
                $('.sub-komponen').select2({
                    placeholder: 'Pilih Sub Komponen',
                    theme: 'bootstrap4',
                    width: '100%',
                    ajax:{
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: "{!! route('GetSubKomponenAPI') !!}",
                        dataType: 'json',
                        type: 'POST',
                        data:function(term){ 
                            return {
                                id: $('.komponen').find('option:selected').val(),
                                q: $.trim(term.term) 
                            }
                        },
                        processResults: function (data) { 
                            return {
                                results: $.map(data, function (item) {
                                    // console.log(item)
                                    return {
                                        text: item.nama_komponen,
                                        id: item.id
                                    }
                                })
                            };
                        }
                    }
                })
                $('.sub-aktifitas').select2({
                    placeholder: 'Pilih Aktifitas',
                    theme: 'bootstrap4',
                    width: '100%',
                    ajax:{
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: "{!! route('GetSubAktifitasAPI') !!}",
                        dataType: 'json',
                        type: 'POST',
                        data:function(term){ 
                            return {
                                id: $('.sub-komponen').find('option:selected').val(),
                                q: $.trim(term.term) 
                            }
                        },
                        processResults: function (data) { 
                            return {
                                results: $.map(data, function (item) {
                                    // console.log(item)
                                    return {
                                        text: item.nama_aktifitas,
                                        id: item.id
                                    }
                                })
                            };
                        }
                    }
                })
                $('.osp').select2({
                    placeholder: 'Pilih OSP',
                    theme: 'bootstrap4',
                    width: '100%',
                    ajax:{
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: "{!! route('OSPGetAPI') !!}",
                        dataType: 'json',
                        type: 'GET', 
                        data:function(term){ 
                            return { 
                                q: $.trim(term.term)
                            }
                        },
                        processResults: function (data) { 
                            return {
                                results: $.map(data, function (item) {
                                    // console.log(item)
                                    return {
                                        text: item.nama_osp,
                                        id: item.id
                                    }
                                })
                            };
                        }
                    }
                })
                $('.kantor').select2({
                    placeholder: 'Pilih Aktifitas',
                    theme: 'bootstrap4',
                    width: '100%',
                    ajax:{
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: "{!! route('KantorGetAPI') !!}",
                        dataType: 'json',
                        type: 'POST',
                        data:function(term){ 
                            return {
                                id: $('.osp').find('option:selected').val(),
                                q: $.trim(term.term)
                            }
                        },
                        processResults: function (data) { 
                            return {
                                results: $.map(data, function (item) {
                                    // console.log(item)
                                    let nama_osp = `${item.kode_kantor} - ${item.nama_kantor}`
                                    return {
                                        text: nama_osp,
                                        id: item.id
                                    }
                                })
                            };
                        }
                    }
                })
                $('.provinsi-dari').select2({
                    placeholder: 'Pilih Asal Provinsi',
                    theme: 'bootstrap4',
                    width: '100%',
                    ajax:{
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: "{!! route('GetProvinsiAPI') !!}",
                        dataType: 'json',
                        type: 'GET', 
                        data:function(term){ 
                            return { 
                                q: $.trim(term.term)
                            }
                        },
                        processResults: function (data) { 
                            return {
                                results: $.map(data, function (item) {
                                    // console.log(item)
                                    return {
                                        text: item.provinsi,
                                        id: item.id
                                    }
                                })
                            };
                        }
                    }
                })
                $('.provinsi-ke').select2({
                    placeholder: 'Pilih Tujuan Provinsi',
                    theme: 'bootstrap4',
                    width: '100%',
                    ajax:{
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: "{!! route('GetProvinsiAPI') !!}",
                        dataType: 'json',
                        type: 'GET', 
                        data:function(term){ 
                            return { 
                                q: $.trim(term.term)
                            }
                        },
                        processResults: function (data) { 
                            return {
                                results: $.map(data, function (item) {
                                    // console.log(item)
                                    return {
                                        text: item.provinsi,
                                        id: item.id
                                    }
                                })
                            };
                        }
                    }
                })
                $('.kabupaten-ke').select2({
                    placeholder: 'Pilih Tujuan Kabupaten/Kota',
                    theme: 'bootstrap4',
                    width: '100%',
                    ajax:{
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: "{!! route('GetKabupatenKota') !!}",
                        dataType: 'json',
                        type: 'POST',  
                        data:function(term){ 
                            return {
                                id: $('.provinsi-ke').find('option:selected').val(),
                                q: $.trim(term.term)
                            }
                        },
                        processResults: function (data) { 
                            return {
                                results: $.map(data, function (item) { 
                                    return {
                                        text: item.kabupaten_name,
                                        id: item.id
                                    }
                                })
                            };
                        }
                    }
                })
                $('.kabupaten-dari').select2({
                    placeholder: 'Pilih Asal Kabupaten/Kota',  
                    theme: 'bootstrap4',
                    width: '100%',
                    ajax:{
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: "{!! route('GetKabupatenKota') !!}",
                        dataType: 'json',
                        type: 'POST',  
                        data:function(term){ 
                            return {
                                id: $('.provinsi-dari').find('option:selected').val(),
                                q: $.trim(term.term)
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
                $('.dates-start').daterangepicker({ 
                    singleDatePicker:true,
                    locale: {
                                format: 'DD/MM/YYYY'
                            },
                    minDate: moment().format('DD/MM/YYYY')
                })
                $('.dates-end').daterangepicker({
                    singleDatePicker:true,
                    locale: {
                                format: 'DD/MM/YYYY'
                            },
                    minDate: $('.dates-start').val() 

                })
                let tables = $('#tableTambahDataKontrak').DataTable({
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
                    // alert()
                    let komponen = $('.komponen').find('option:selected').val(),
                    sub_komponen = $('.sub-komponen').find('option:selected').val(),
                    sub_aktifitas = $('.sub-aktifitas').find('option:selected').val(),
                    osp = $('.osp').find('option:selected').val(),
                    kantor = $('.kantor').find('option:selected').val(),
                    provinsi_dari = $('.provinsi-dari').find('option:selected').val(),
                    provinsi_ke = $('.provinsi-ke').find('option:selected').val(),
                    kabupaten_dari = $('.kabupaten-dari').find('option:selected').val(),
                    kabupaten_ke = $('.kabupaten-ke').find('option:selected').val(),
                    date_start = $('.dates-start').val(),
                    date_end = $('.dates-end').val(),
                    amandemen = $('.amandemen').val(),
                    nominal = $('.nominal').val()
                    const rules = $.trim(komponen) != '' && $.trim(sub_komponen) != '' && $.trim(osp) != '' && $.trim(kantor) != '' && $.trim(provinsi_dari) != '' && $.trim(provinsi_ke) != '' && $.trim(kabupaten_dari) != '' && $.trim(kabupaten_ke) != '' && $.trim(date_start) != '' && $.trim(date_end) != '';
                    if(rules){
                        const kode_kontrak_post = $('.kode-kontrak-post').val()
                        if(kode_kontrak_post == null || kode_kontrak_post == ''){ 
                            $('.kode-kontrak-post').val($('.kode-kontrak').val())
                            $('.kontrak-mulai-post').val($('.kontrak-mulai').val())
                            $('.kontrak-akhir-post').val($('.kontrak-akhir').val())
                        }
                        tables.row.add([
                            `${count}`,
                            `${$('.komponen').find('option:selected').html()}<input type='hidden' name='komponen[]' value='${komponen}'>`,
                            `${$('.sub-komponen').find('option:selected').html()}<input type='hidden' name='sub_komponen[]' value='${sub_komponen}'>`,
                            `${$('.sub-aktifitas').find('option:selected').html()}<input type='hidden' name='sub_aktifitas[]' value='${sub_aktifitas}'>`, 
                            `${$('.kabupaten-dari').find('option:selected').html()}<input type='hidden' name='kabupaten_dari[]' value='${kabupaten_dari}'><input type='hidden' name='provinsi_dari[]' value='${provinsi_dari}'>`,
                            `${$('.kabupaten-ke').find('option:selected').html()}<input type='hidden' name='kabupaten_ke[]' value='${kabupaten_ke}'><input type='hidden' name='provinsi_ke[]' value='${provinsi_ke}'>`,
                            `${date_start}<input type='hidden' name='periode_start[]' value='${date_start}'>`,
                            `${date_end}<input type='hidden' name='preiode_end[]' value='${date_end}'>`,
                            `${$('.amandemen').find('option:selected').html()}<input type='hidden' name='id_amandemen[]' value='${amandemen}'>`,
                            `${$('.nominal').val()}<input type='hidden' name='nominal[]' value='${nominal}'>`,
                            `${$('.kantor').find('option:selected').html()}<input type='hidden' name='kantor[]' value='${kantor}'><input type='hidden' name='osp[]' value='${osp}'>`,
                            `<button data-id='${count}' data-val='${count}' type='button' class='btn circle btn-danger btn-delete-row'><i class='fa fa-trash'></i></button>`,
                        ]).draw(false)
                        count++
                        $('.komponen').val(null).trigger('change')
                        $('.sub-komponen').val(null).trigger('change')
                        $('.sub-aktifitas').val(null).trigger('change')
                        $('.osp').val(null).trigger('change')
                        $('.kantor').val(null).trigger('change')
                        $('.provinsi-dari').val(null).trigger('change')
                        $('.provinsi-ke').val(null).trigger('change')
                        $('.kabupaten-dari').val(null).trigger('change')
                        $('.kabupaten-ke').val(null).trigger('change')
                        $('.amandemen').val(null).trigger('change')
                        $('.nominal').val(null)
                        $('.dates-start').val(moment().format('DD/MM/YYYY'))
                        $('.dates-end').val(moment().format('DD/MM/YYYY')) 
                    }else if(kode_kontrak == '' || kode_kontrak == null || kode_kontrak == undefined){
                        alert('Kode Kontrak Tidak Boleh Kosong');
                    }else if(komponen == '' || komponen == null || komponen == undefined){
                        alert('Komponen Tidak Boleh Kosong');
                    }else if(sub_komponen == '' || sub_komponen == null || sub_komponen == undefined){
                        alert('Sub Komponen Tidak Boleh Kosong');
                    }else if(sub_aktifitas == '' || sub_aktifitas == null || sub_aktifitas == undefined){
                        alert('Sub Aktifitas Tidak Boleh Kosong');
                    }else if(osp == '' || osp == null || osp == undefined){
                        alert('OSP Tidak Boleh Kosong');
                    }else if(kantor == '' || kantor == null || kantor == undefined){
                        alert('Kantor Tidak Boleh Kosong');
                    }else if(provinsi_dari == '' || provinsi_dari == null || provinsi_dari == undefined){
                        alert('Provinsi Asal Tidak Boleh Kosong');
                    }else if(provinsi_ke == '' || provinsi_ke == null || provinsi_ke == undefined){
                        alert('Provinsi Tujuan Tidak Boleh Kosong');
                    }else if(kabupaten_dari == '' || kabupaten_dari == null || kabupaten_dari == undefined){
                        alert('Kabupaten Asal Tidak Boleh Kosong');
                    }else if(kabupaten_ke == '' || kabupaten_ke == null || kabupaten_ke == undefined){
                        alert('Kabupaten Tujuan Tidak Boleh Kosong');
                    }else if(date_start == '' || date_start == null || date_start == undefined){
                        alert('Start Periode Tidak Boleh Kosong');
                    }else if(date_end == '' || date_end == null || date_end == undefined){
                        alert('Finish Periode Tidak Boleh Kosong');
                    }else if(amandemen == '' || amandemen == null || amandemen == undefined){
                        alert('Amandemen Tidak Boleh Kosong');
                    }else if(nominal == '' || nominal == null || nominal == undefined){
                        alert('Nominal Tidak Boleh Kosong');
                    }else{
                        alert('Semua Field Tidak Boleh Kosong')
                    }
                        
                    
                })
                $('#tableTambahDataKontrak tbody').on( 'click', '.btn-delete-row', function () {
                tables
                .row( $(this).parents('tr') )
                .remove()
                .draw();
                count--
                })
            })
    </script>
@endsection
