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
                    <h1>List Group Pengguna</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li class="breadcrumb-item active">Group Pengguna</li>
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
                            <h5>Data Group Pengguna</h5>
                        </div>
                        <div class="card-body text-right">
                            {{-- <a href="#" class="btn btn-warning">Tambah Data Group Pengguna</a> --}}
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="tableGroupPengguna"  width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase">#</th>
                                        <th class="text-center text-uppercase">Kelompok Pengguna</th>
                                        <th class="text-center text-uppercase">Opsi</th>
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
      let tables = $("#tableGroupPengguna").DataTable({
        initComplete: function(settings, json){
            $('#tableGroupPengguna').wrap("<div style='overflow:auto; width:100%;position:relative;'></div>")
          }, 
          processing: true,  
          ajax: "{!! route('KelompokPenggunaView') !!}",
          columns:[
              {data: 'DT_RowIndex', className:'text-center text-uppercase'}, 
              {data: 'display_name', className:'text-center text-uppercase'}, 
              {data: 'opsi', className:'text-center'},
          ]
      })
        $('#tableGroupPengguna tbody').on('click', 'button', tables, function () { 
            if(confirm('Anda yakin mau menghapus item ini ?')){
                    const id = $(this).data('name');
                    let url = "{{ route('KelompokPenggunaDestroy', ':id') }}";
                        url = url.replace(':id', id);
                        document.location.href=url; 
                } 
        })   
  })
</script>    
@endsection