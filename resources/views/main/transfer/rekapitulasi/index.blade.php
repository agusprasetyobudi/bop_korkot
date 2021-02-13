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
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/daterangepicker/daterangepicker.css') !!}">
    <style>
      .search{
        width: 100%;
      }
    </style>
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
                    <thead>
                      <tr>
                        <td></td>
                        <td>
                          <div class="form-group">
                            <input type="text" id="1"  class="search form-control">
                          </div>
                        </td>
                        <td>
                          <div class="input-group input-group-sm">
                            <input type="text" class="form-control search" id="datepicker">
                            <span class="input-group-append">
                              <button type="button" class="btn btn-default btn-flat" id="clear-date">X</button>
                            </span>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <input type="text" id="3"  class="search form-control">
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <input type="text" id="4"  class="search form-control">
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <input type="text" id="5"  class="search form-control">
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <input type="text" id="6"  class="search form-control" id="uang">
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <input type="text" id="7"  class="search form-control">
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <input type="text" id="8"  class="search form-control">
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <input type="text" id="9"  class="search form-control">
                          </div>
                        </td>
                        <td></td>
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
<script src="{!! asset('assets/adminlte/plugins/jszip/jszip.min.js') !!}"></script>
<script src="{!! asset('assets/adminlte/plugins/pdfmake/pdfmake.min.js') !!}"></script>
<script src="{!! asset('assets/adminlte/plugins/pdfmake/vfs_fonts.js') !!}"></script>
<script src="{!! asset('assets/adminlte/plugins/datatables-buttons/js/buttons.print.min.js') !!}"></script>
<script src="{!! asset('assets/adminlte/plugins/moment/moment.min.js') !!}"></script>
<script src="{!! asset('assets/adminlte/plugins/daterangepicker/daterangepicker.js') !!}"></script>
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
          title: 'Rekapitulasi Butki Transfer <?= Carbon\Carbon::now()->format("d-m-Y")?>',
          filename: 'rekap-butki-transfer_<?= Carbon\Carbon::now()->format("d-m-Y")?>',
          className: 'btn btn-success text-uppercase',
          exportOptions:{ 
            columns: [0,1,2,3,4,5,6,7,8,9]
          }
        }, 
        { 
          extend:'pdf',
          text: 'pdf',
          title: 'Rekapitulasi Butki Transfer <?= Carbon\Carbon::now()->format("d-m-Y")?>',
          filename: 'rekap-butki-transfer_<?= Carbon\Carbon::now()->format("d-m-Y")?>',
          className: 'btn btn-success text-uppercase',
          exportOptions:{ 
            columns: [0,1,2,3,4,5,6,7,8,9]
          },
          orientation: 'landscape',
          customize: function ( doc ) {
            doc.styles['td:nth-child(2)'] = { 
              width: '100%',
              'max-width': '100%'
            }
            doc.styles['tableHeader'] = {
              bold: true,
              fontSize: 11,
              color: 'black',
              fillColor: '#ffc107',
              alignment: 'center'

            };
            var rowCount = doc.content[1].table.body.length;
            for (i = 1; i < rowCount; i++) {
              doc.content[1].table.body[i][0].alignment  = 'center';
              doc.content[1].table.body[i][1].alignment  = 'center';
              doc.content[1].table.body[i][2].alignment  = 'center';
              doc.content[1].table.body[i][3].alignment  = 'left';
              doc.content[1].table.body[i][4].alignment  = 'left';
              doc.content[1].table.body[i][5].alignment  = 'center';
              doc.content[1].table.body[i][6].alignment  = 'center';
              doc.content[1].table.body[i][7].alignment  = 'center';
              doc.content[1].table.body[i][8].alignment  = 'center';
              doc.content[1].table.body[i][9].fontSize  = '11 '; 
              doc.content[1].table.body[i][9].alignment  = 'left '; 
            }; 
            var objLayout = {}; 
                          objLayout['hLineColor'] = function(i) { return 'black'; };
                          objLayout['vLineColor'] = function(i) { return 'black'; }; 
                          doc.content[1].layout = objLayout;
                          var obj = {};
                          // obj['hLineWidth'] =  function(i) { return .5; };
                          obj['hLineColor'] = function(i) { return 'black'; };
                          // doc.content[1].margin = [ 150, 0, 150, 0 ];
                      
          }
        }, 
        { 
          extend:'print',
          text: 'print',
          title: 'Rekapitulasi Butki Transfer <?= Carbon\Carbon::now()->format("d-m-Y")?>',
          filename: 'rekap-butki-transfer_<?= Carbon\Carbon::now()->format("d-m-Y")?>',
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
        ],
        createdRow: function ( row, data, index ) {  
            if ( data['approval'] == 1 ) {
                $('td', row).eq(1).css({'background-color':'#28a745','color':'white'});
                $('td', row).eq(2).css({'background-color':'#28a745','color':'white'});
                $('td', row).eq(3).css({'background-color':'#28a745','color':'white'});
                $('td', row).eq(4).css({'background-color':'#28a745','color':'white'});
                $('td', row).eq(5).css({'background-color':'#28a745','color':'white'});
                $('td', row).eq(6).css({'background-color':'#28a745','color':'white'});
                $('td', row).eq(7).css({'background-color':'#28a745','color':'white'});
                $('td', row).eq(8).css({'background-color':'#28a745','color':'white'});
                $('td', row).eq(9).css({'background-color':'#28a745','color':'white'});
            }
        }
      });   
      $('.search').keyup(function(){
        let i = $(this).attr('id')
        let v = this.value 
        tables.columns(i).search(v).draw()
      }) 
      $('#datepicker').daterangepicker({  
        singleDatePicker: true,
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear',
            format: 'YYYY-MM-DD'
        } 
      })  

      $('#datepicker').on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('YYYY-MM-DD')); 
          let v = this.value 
          tables.columns(2).search(v).draw()
      });

      $('#datepicker').on('cancel.daterangepicker', function(ev, picker) {
          $(this).val('');
      });
      $('#clear-date').click(function(){
        $('#datepicker').val('')
        
        tables.columns(2).search('').draw()
      })   
  })
</script>
@endsection