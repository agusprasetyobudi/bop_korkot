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
                    <h1>Tambah Data OSP</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('OSPView') !!}">OSP</a></li>
                        <li class="breadcrumb-item active">Tambah Data OSP</li>
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
                        <div class="card-header">Tambah Data OSP</div> 
                        <div class="card-body">
                            <div class="form-group">
                                <label for="" class="text-center text-uppercase">nama osp</label>
                                <input type="text" name="nama-osp" class="form-control nama-osp">
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-warning btn-nama-osp">Tambah Data</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">Tambah Data OSP</div>
                    <form action="{!! route('OSPPost') !!}" method="post">
                        @csrf
                        <div class="card-body">
                            <table class="table table-hover table-bordered" id="tableTambahOSP">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase">#</th>
                                        <th class="text-center text-uppercase">nama OSP</th>
                                        <th class="text-center text-uppercase">opsi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-warning btn-block">Tambah Data</button>
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
<script>
    $(()=>{
        let tables = $('#tableTambahOSP').DataTable({
            paging: false,
            lengthChange:false,
            searching:false,
            columnDefs: [
        {"className": "text-center", "targets": "_all"}
      ]});
      let count = 1
      $('.btn-nama-osp').click(()=>{
        let GetNama = $('.nama-osp').val()
        if(GetNama){
             tables.row.add([
                 `${count}`,
                 `${GetNama}<input name='osp_name[]' type='hidden' value='${GetNama}'/>`,
                 `<button data-id='${count}' data-val='${count}' type='button' class='btn circle btn-danger btn-delete-row'><i class='fa fa-trash'></i></button>`,
             ]).draw(false) 
        }else{
            alert('Nama OSP Tidak Boleh Kosong')
        }
        count++
        $('.nama-osp').val(null)
      })
      $('#tableTambahOSP tbody').on('click', '.btn-delete-row',function (){ 
          tables
          .row($(this).parents('tr'))
          .remove()
          .draw()
          count--
      }) 
    })
</script>
    
@endsection