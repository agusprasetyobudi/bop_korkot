@extends('layouts.adminlte')

@section('navbar')
    @include('layouts.partials.navbar')
@endsection

@section('sidebar')
    @include('layouts.partials.sidebar')
@endsection

@section('addtionalCSS')
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css') !!}">    
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/select2/css/select2.min.css') !!}">    
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}">
    {{-- <link rel="stylesheet" href="{!! asset('assets/css/select2-bootstrap4.css') !!}">     --}}
@endsection

@section('page_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Data Kabupaten/Kota</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('KabupatenKotaView') !!}">List Kabupaten/Kota</a></li>
                        <li class="breadcrumb-item active">Tambah Kabupaten/Kota</li>
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
                <div class="col-lg-12" >
                    <div class="card">
                        <div class="card-header">Tambah Data Kabupaten/Kota</div>
                        <form id="addFomrs">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="" class="text-uppercase">Nama Kabupaten/Kota</label>
                                    <input type="text" name="" id="nama-kota-kabupaten" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="" class="text-uppercase">Nama Provinsi</label>
                                    <select name="" id="nama-provinsi" class="form-control nama-provinsi-select2">
                                        <option selected disabled value>Pilih Provinsi</option>
                                        @foreach ($province as $item)
                                            <option value="{!! $item->id !!}">{!! $item->provinsi_name !!}</option>
                                        @endforeach
                                        {{-- <option value="10">Kota</option> --}}
                                    </select>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="" class="text-uppercase">Nama Kabuptaen/Kota</label>
                                    <input type="text" name="" id="" class="form-control">
                                </div> --}}
                            </div>
                        </form>
                        <div class="card-footer text-right"> 
                            <button class="btn btn-warning btn-add-kabkot">Tambah Kabupaten/Kota</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <form action="{!! route('KabupatenKotaPost') !!}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-header">List Kabupten/Kota Ditambahkan</div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover" id="tableKabupatenKotaTambah">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-center">#</th>
                                            <th class="text-uppercase text-center">Nama Kabupaten/Kota</th>
                                            <th class="text-uppercase text-center">nama provinsi</th>
                                            <th class="text-uppercase text-center">Opsi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning btn-block">Simpan Data Kabupaten/Kota</button>
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
<script src="{!! asset('assets/adminlte/plugins/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> --}}
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js"></script> --}}
<script>
      $(function () {
        $(".nama-provinsi-select2").select2()
        // $(".nama-provinsi-select2").select2("val", "", "placeholder", "Select a Contact Group")
      let tables = $('#tableKabupatenKotaTambah').DataTable({
        paging: false,
        lengthChange:false,
        searching: false,
        columnDefs: [
        {"className": "text-center", "targets": "_all"}
      ]});
        
    let count = 1
    $('.btn-add-kabkot').click(()=>{
        let GetNama = $('#nama-kota-kabupaten').val()  
        let GetJenis = $('#nama-provinsi').find('option:selected').val()  
        // console.log({GetNama,GetJenis}) 
        if($.trim(GetNama) !='' && $.trim(GetJenis) != '' && GetJenis != 'Pilih Provinsi'){
            if(count < 21){
                    tables.row.add([
                    `${count}`,
                    `${$('#nama-kota-kabupaten').val()}<input name='name_kabupate_kota[]' type='hidden' value='${GetNama}' />`,
                    `${$('#nama-provinsi option:selected').html()}<input name='provinsi_id[]' type='hidden' value='${GetJenis}' />`,
                    `<button data-id='${count}' data-val='${count}' type='button' class='btn circle btn-danger btn-delete-row'><i class='fa fa-trash'></i></button>`,
                ]).draw(false)
                count++ 
                $('#nama-kota-kabupaten').val(null) 
                $('.nama-provinsi-select2').val('').trigger('change')
            }else{
                alert('Data Yang Ditambahkan Mencapai Maksimum')
            }
        }else if(GetNama == null || GetNama == ""){
          alert('Nama Kota/Kabupaten Tidak Boleh Kosong')
        }else if(GetJenis == null || GetJenis == "" || GetJenis == "Pilih Kota/Kabupaten"){
          alert('Type Kota/Kabupaten Tidak Boleh Kosong') 
        }else{
            alert('Data Harus Terisi')
        }
    })
    $('#tableKabupatenKotaTambah tbody').on( 'click', '.btn-delete-row', function () {
        tables
        .row( $(this).parents('tr') )
        .remove()
        .draw();
        count--
    })

      });

</script> 
@endsection