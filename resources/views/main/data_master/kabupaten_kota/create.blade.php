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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">Tambah Data Kabupaten/Kota</div>
                        <form id="addFomrs">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="" class="text-uppercase">Nama Kabuptaen/Kota</label>
                                    <input type="text" name="" id="nama-kota-kabupaten" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="" class="text-uppercase">Type Kabuptaen/Kota</label>
                                    <select name="" id="jenis-kota-kabupaten" class="form-control">
                                        <option selected disabled value>Pilih Kota/Kabupaten</option>
                                        <option value="10">Kota</option>
                                        <option value="20">Kabupaten</option>
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
                                            <th class="text-uppercase text-center">Type Kabupaten/Kota</th>
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
<script>
      $(function () {

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
        let GetJenis = $('#jenis-kota-kabupaten').find('option:selected').val()  
        // console.log({GetNama,GetJenis}) 
        if($.trim(GetNama) !='' && $.trim(GetJenis) != '' && GetJenis != 'Pilih Kota/Kabupaten'){
            tables.row.add([
                `${count}`,
                `${$('#nama-kota-kabupaten').val()}<input name='name_kabupate_kota[]' type='hidden' value='${GetNama}' />`,
                `${$('#jenis-kota-kabupaten option:selected').html()}<input name='type_kabupate_kota[]' type='hidden' value='${GetJenis}' />`,
                `<button data-id='${count}' data-val='${count}' type='button' class='btn circle btn-danger btn-delete-row'><i class='fa fa-trash'></i></button>`,
            ]).draw(false)
            count++ 
            $('#nama-kota-kabupaten').val(null)
            // $('#jenis-kota-kabupaten option').prop('selected', function(){
            //     return this.defaultSelected;
            // }).attr('disabled','disabled'); 
            $('#jenis-kota-kabupaten option').prop('selected', function() {
                return this.defaultSelected;
            });
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