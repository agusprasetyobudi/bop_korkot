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
        <h1>Rekapitulasi Bukti Pengeluaran</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
            <li class="breadcrumb-item active">Rekapitulasi Bukti Pengeluaran</li>
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
                {{-- <a href="{!! route('firmCreateView') !!}" class="btn btn-default">Tambah Data Transfer Firm</a> --}}
              <button type="submit" class="btn btn-warning" id="btn-list">Tambah Rekapitulasi Bukti Pengeluaran</button>
              </div> 
              <div class="card-body"> 
                  {{-- <div class="form-group">
                    <label for=""></label>
                    <input type="text" class="form-control" id="search-box" placeholder="Cari disini">
                  </div>  --}}
                <table id="example2" class="table table-bordered table-hover">
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
                    <th class="text-center text-uppercase">Tanggal diterima</th> 
                    <th class="text-center text-uppercase">Periode</th> 
                    <th class="text-center text-uppercase">implementasi</th> 
                    <th class="text-center text-uppercase">selisih</th> 
                  </tr>
                  </thead>
                  <tbody>  
                  </tbody> 
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

      <div class="modal fade" id="bukti-tf-modal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl">
          <div class="modal-content" style="width: 120%">
            <div class="modal-header">
              <h4 class="modal-title">Pilih Bukti Tranfer</h4>
              <button type="button" class="close close-bukti-transfer" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              {{-- <p>One fine body…</p> --}}
  
              <table class="table table-bordered table-hover" id="tableBuktiTranfer">
                  <thead>
                      <tr>
                          <th class="text-center text-uppercase">#</th>
                          <th class="text-center text-uppercase">no bukti</th>
                          <th class="text-center text-uppercase">tanggal transfer</th>
                          <th class="text-center text-uppercase">nama_penerima</th>
                          <th class="text-center text-uppercase">bank penerima</th>
                          <th class="text-center text-uppercase">no rekening penerima</th>
                          <th class="text-center text-uppercase">nilai kontrak</th>
                          <th class="text-center text-uppercase">jumlah diterima</th>
                          <th class="text-center text-uppercase">selisih</th>
                          <th class="text-center text-uppercase">tanggal terima</th>
                          <th class="text-center text-uppercase">periode</th>
                          <th class="text-center text-uppercase">opsi</th>
                      </tr>
                  </thead>
              </table>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default close-bukti-transfer" data-dismiss="modal">Close</button> 
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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
        let tables = $("#example2").DataTable({
          "scrollX": true,
          "responsive": false,
          "autoWidth": true,
          processing: true,     
          ajax:"{!! route('buktiPengeluaranView') !!}",
          columns:[
            {data: 'DT_RowIndex', className: 'text-center text-uppercase'},
            {data:'bukti_transfer', className:'text-cemter text-uppercase'},
            {data:'nama_penerima', className:'text-cemter text-uppercase'},
            {data:'bank_penerima', className:'text-cemter text-uppercase'},
            {data:'no_rekening', className:'text-cemter text-uppercase'},
            {data:'nilai_kontrak', className:'text-cemter text-uppercase'},
            {data:'jumlah_terima', className:'text-cemter text-uppercase'},
            {data:'selisih', className:'text-cemter text-uppercase'},
            {data:'tanggal_terima', className:'text-cemter text-uppercase'},
            {data:'periode', className:'text-cemter text-uppercase'},
            {data:'implementasi', className:'text-cemter text-uppercase'},
            {data:'selisih', className:'text-cemter text-uppercase'},
            {data:'action', className:'text-cemter text-uppercase'} ,
          ]
        });        
        let tableBuktiTf = $("#tableBuktiTranfer").DataTable({
          responsive: true,
          autoWidth: false, 
          bSort: false, 
          ajax: "{!! route('getApiBuktiTransfer') !!}",
          columns:[
            {data: 'DT_RowIndex', className: 'text-center text-uppercase'},
            {data:'no_bukti', className:'text-cemter text-uppercase'},
            {data:'tanggal_transfer', className:'text-cemter text-uppercase'},
            {data:'nama_penerima', className:'text-cemter text-uppercase'},
            {data:'bank_penerima', className:'text-cemter text-uppercase'},
            {data:'no_rekening', className:'text-cemter text-uppercase'},
            {data:'nilai_kontrak', className:'text-cemter text-uppercase'},
            {data:'jumlah_terima', className:'text-cemter text-uppercase'},
            {data:'selisih', className:'text-cemter text-uppercase'},
            {data:'tanggal_terima', className:'text-cemter text-uppercase'},
            {data:'periode', className:'text-cemter text-uppercase'}, 
            {data:'action', className:'text-cemter text-uppercase'} ,
          ]
        });        
        $('#btn-list').click(function(){
            $('#bukti-tf-modal').modal({backdrop:'static',keyboard:false})
            tableBuktiTf.ajax.reload()
        })
      })
    </script>
@endsection