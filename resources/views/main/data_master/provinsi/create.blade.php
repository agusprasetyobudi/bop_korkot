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
                    <h5>Tambah Data Provinsi</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('provinsiView') !!}">List Provinsi</a></li>
                        <li class="breadcrumb-item active">Tambah Data Provinsi</li>
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
                        <div class="card-header">Form Tambah Data Provinsi</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="" class="text-uppercase">nama provinsi</label>
                                <input type="text"  id="nama-provinsi" class="form-control">
                            </div>
                        </div> 
                        <div class="card-footer text-right"> 
                            <input type="button" class="btn btn-warning" id="tambah-provinsi" value="Tambah Data Provinsi">
                        </div>
                    </div>
                    <form action="{!! route('provinsiPost') !!}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-header">List Data Provinsi Yang Ditambahkan</div>
                            <div class="card-body">
                               <table class="table table-hover table-bordered" id="tableTambahProvinsi">
                                   <thead>
                                       <tr>
                                           <th class="text-uppercase text-center">#</th>
                                           <th class="text-uppercase text-center">Provinsi</th>
                                           <th class="text-uppercase text-center">Opsi</th>
                                       </tr>
                                   </thead>
                               </table>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-warning btn-block">Simpan Data</button>
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
$(()=>{
    let tables = $('#tableTambahProvinsi').DataTable({
        paging: false,
        lengthChange:false,
        searching: false,
        columnDefs: [
        {"className": "text-center", "targets": "_all"}
      ]
    })
    
    let count = 1
    $('#tambah-provinsi').click(()=>{
        let GetData = $('#nama-provinsi').val()  
        if(GetData != null && GetData != ""){
            tables.row.add([
                `${count}`,
                `${GetData}<input name='provinsi_name[]' type='hidden' value='${GetData}' />`,
                `<button data-id='${count}' data-val='${count}' type='button' class='btn circle btn-danger btn-delete-row'><i class='fa fa-trash'></i></button>`,
            ]).draw(false)
            count++
            $('#nama-provinsi').val('')
        }else{
          alert('Data Tidak Boleh Kosong')
        }
    })
    $('#tableTambahProvinsi tbody').on( 'click', '.btn-delete-row', function () {
        tables
        .row( $(this).parents('tr') )
        .remove()
        .draw();
        count--
    })

})
</script>
@endsection