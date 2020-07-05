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
                    <h1>Kontrak</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li class="breadcrumb-item active">Kontrak</li>
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
                        <div class="card-body text-right">
                            <a href="{!! route('KontrakCreateView') !!}" class="btn btn-warning">Tambah Data Kontrak</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="tableKontrak">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase">#</th>
                                        <th class="text-center text-uppercase">Kode Kontrak</th>
                                        <th class="text-center text-uppercase">Tanggal Kontrak</th>
                                        <th class="text-center text-uppercase">Mulai Kontrak</th>
                                        <th class="text-center text-uppercase">Akhir Kontrak</th>
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
          let tables = $('#tableKontrak').DataTable({
              responsive: true,
              autoWidth: false,
              paging: true,
              lengthChange: true,
              searching: true,
              ajax: "{!! route('KontrakHome') !!}",
              columns:[
                  {data:'DT_RowIndex', className: 'text-center text-uppercase'},
                  {data:'kode_kontrak', className: 'text-center text-uppercase'},
                  {data:'tanggal_kontrak', className: 'text-center text-uppercase'},
                  {data:'tanggal_kontrak_mulai', className: 'text-center text-uppercase'},
                  {data:'tanggal_kontrak_akhir', className: 'text-center text-uppercase'},
                  {data:'action', className: 'text-center text-uppercase'},
              ]
          })
          $('#tableKontrak tbody').on('click', 'button', tables, function () { 
            if(confirm('Anda yakin mau menghapus item ini ?')){
                    const id = $(this).data('name');
                    let url = "{{ route('KontrakDestroy', ':id') }}";
                        url = url.replace(':id', id);
                        document.location.href=url; 
                } 
            })
      })
  </script>
@endsection