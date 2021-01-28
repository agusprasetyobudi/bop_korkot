@extends('layouts.adminlte')

@section('navbar')
    @include('layouts.partials.navbar')
@endsection

@section('sidebar')
    @include('layouts.partials.sidebar')
@endsection

@section('addtionalCSS')
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.css') !!}">
@endsection

@section('page_header')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Rekapitulasi Bukti Transfer</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
            <li class="breadcrumb-item active">Rekapitulasi Bukti Transfer</li>
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
              <a href="{!! route('buktiTransferCreate') !!}" class="btn btn-default">Tambah Data Rekapitulasi Transfer</a>
            </div> 
            <div class="card-body"> 
                {{-- <div class="form-group">
                  <label for=""></label>
                  <input type="text" class="form-control" id="search-box" placeholder="Cari disini">
                </div>  --}}
                <div class="table-responsive">
                  <table id="example2" class="table table-bordered table-hover" width="100%">
                    <thead>
                    <tr> 
                      <th class="text-center text-uppercase">#</th>
                      <th class="text-center text-uppercase">No Bukti Transfer</th> 
                      <th class="text-center text-uppercase">Tanggal Transfer</th> 
                      <th class="text-center text-uppercase">Nama Penerima</th> 
                      <th class="text-center text-uppercase">Bank Penerima</th> 
                      <th class="text-center text-uppercase">No. Rekening Penerima</th> 
                      <th class="text-center text-uppercase">Nilai Kontrak</th> 
                      <th class="text-center text-uppercase">Jumlah Diterima</th> 
                      <th class="text-center text-uppercase">selisih</th> 
                      <th class="text-center text-uppercase">Periode</th> 
                      <th class="text-center text-uppercase">opsi</th> 
                    </tr>
                    </thead> 
                  </table>
                </div>
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
{{-- <script src="{!! asset('assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') !!}"></script> --}}
<script src="{!! asset('assets/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') !!}"></script>
<script src="{!! asset('assets/adminlte/plugins/datatables-buttons/js/buttons.html5.js') !!}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="{!! asset('assets/adminlte/plugins/datatables-buttons/js/buttons.print.min.js') !!}"></script>
<script> 
  $(()=>{
    let tables = $("#example2").DataTable({     
      "initComplete": function (settings, json) {  
        $("#example2").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
      },
      dom: 'Bfrtip',
    buttons:  [
    { 
      extend:'excel',
      text: 'excel',
      title: 'Rekapitulasi Butki Transfer <?= Carbon\Carbon::now()->format("d-m-y")?>',
      filename: 'rekap-butki-transfer_<?= Carbon\Carbon::now()->format("d-m-y")?>',
      className: 'btn btn-success text-uppercase',
      exportOptions:{ 
        columns: [0,1,2,3,4,5,6,7,8,9]
      }
    }, 
    { 
      extend:'pdf',
      text: 'pdf',
      title: 'Rekapitulasi Butki Transfer <?= Carbon\Carbon::now()->format("d-m-y")?>',
      filename: 'rekap-butki-transfer_<?= Carbon\Carbon::now()->format("d-m-y")?>',
      className: 'btn btn-success text-uppercase',
      exportOptions:{ 
        columns: [0,1,2,3,4,5,6,7,8,9]
      }
    }, 
    { 
      extend:'print',
      text: 'print',
      title: 'Rekapitulasi Butki Transfer <?= Carbon\Carbon::now()->format("d-m-y")?>',
      filename: 'rekap-butki-transfer_<?= Carbon\Carbon::now()->format("d-m-y")?>',
      className: 'btn btn-success text-uppercase',
      exportOptions:{
        columns: [0,1,2,3,4,5,6,7,8,9]
      }
    }],
      processing: true,     
      ajax:"{!! route('buktiTransferView') !!}",
      columns:[
        {data: 'DT_RowIndex', className: 'text-center text-uppercase'},
        {data: 'no_bukti', className: 'text-center text-uppercase'},
        {data: 'tanggal_terima', className: 'text-center text-uppercase'},
        {data: 'nama_penerima', className: 'text-center text-uppercase'},
        {data: 'bank_penerima', className: 'text-center text-uppercase'},
        {data: 'no_rekening', className: 'text-center text-uppercase'},
        {data: 'nilai_kontrak', className: 'text-center text-uppercase'},
        {data: 'jumlah_diterima', className: 'text-center text-uppercase'},
        {data: 'selisih', className: 'text-center text-uppercase'},
        {data: 'periode', className: 'text-center text-uppercase'},
        {data: 'action', className: 'text-center text-uppercase'},
      ]
    });      
  })
</script>
@endsection