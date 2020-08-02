@extends('layouts/adminlte')
 

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
            <h1>Firm Transfer</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                <li class="breadcrumb-item active">Firm Transfer</li>
            </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('body') 
  <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row"> 
          <div class="col-lg-12">
            <div class="card"> 
              <!-- /.card-header -->
              <div class="card-body text-right">
                <a href="{!! route('firmCreateView') !!}" class="btn btn-default">Tambah Data Transfer Firm</a>
              </div> 
              <div class="card-body"> 
                  {{-- <div class="form-group">
                    <label for=""></label>
                    <input type="text" class="form-control" id="search-box" placeholder="Cari disini">
                  </div>  --}}
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr> 
                    <th class="text-center">#</th>
                    <th class="text-center">No Bukti Transfer</th>
                    <th class="text-center">OSP</th> 
                    <th class="text-center">Nama Kantor</th> 
                    <th class="text-center">Tanggal Transfer</th> 
                    <th class="text-center">Jabatan</th> 
                    <th class="text-center">Bank Penerima</th> 
                    <th class="text-center">No. Rekening Penerima</th> 
                    <th class="text-center">Nama Penerima</th> 
                    <th class="text-center">Jumlah Transfer</th> 
                    <th class="text-center">Periode</th> 
                    <th class="text-center">Keterangan</th> 
                    <th class="text-center">Opsi</th> 
                  </tr>
                  </thead> 
                </table>
              </div>
              <!-- ./card-body -->              
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
      
        <!-- /.row -->
      </div><!--/. container-fluid -->
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
      let tables = $("#example2").DataTable({
        responsive: true,
        autoWidth: false,
        pagging: true,
        lengthChange:true,
        searching: true,
        ajax:"{!! route('firmView') !!}",
        columns:[
            {data:'DT_RowIndex', className: 'text-center text-uppercase'},
            {data:'no_bukti', className: 'text-center text-uppercase'},  
            {data:'osp', className: 'text-center text-uppercase'},  
            {data:'kantor', className: 'text-center text-uppercase'},  
            {data:'tanggal_tf', className: 'text-center text-uppercase'},  
            {data:'jabatan', className: 'text-center text-uppercase'},  
            {data:'bank', className: 'text-center text-uppercase'},  
            {data:'bank_account_number', className: 'text-center text-uppercase'},  
            {data:'nama_penerima', className: 'text-center text-uppercase'},  
            {data:'amount_tf', className: 'text-center text-uppercase'},  
            {data:'periode', className: 'text-center text-uppercase'},  
            {data:'description', className: 'text-center text-uppercase'},   
            {data:'action', className: 'text-center'},
        ]
      });   
      $('#example2 tbody').on('click', 'button', tables, function () { 
            if(confirm('Anda yakin mau menghapus item ini ?')){
                    const id = $(this).data('name');
                    let url = "{{ route('firmDestroy', ':id') }}";
                        url = url.replace(':id', id);
                        document.location.href=url; 
                } 
    })   
    })
  </script>
@endsection