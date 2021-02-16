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
                <h1>Error Reporting</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                <li class="breadcrumb-item active">Error Reporting</li>
            </ol>
            </div>
        </div>
        </div>
    </section>
@endsection

@section('body')
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body text-right">
                            <a href="{!! route('bukuBankCreate') !!}" class="btn btn-default">Tambah Data Buku Bank</a>
                        </div>
                        <div class="card-body">
                            <table id="tableErrorData" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase">#</th>
                                        <th class="text-center text-uppercase">Error Code</th>
                                        <th class="text-center text-uppercase">Message Error</th>
                                        <th class="text-center text-uppercase">Url</th>
                                        <th class="text-center text-uppercase">Has User Error</th> 
                                        <th class="text-center text-uppercase">Action</th>
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
                                        <div class="form-group">
                                          <input type="text" id="2"  class="search form-control">
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
                                      <td></td>
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
        let tables = $("#tableErrorData").DataTable({
            "initComplete": function (settings, json) {  
          $("#example2").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");    
        },
        dom: 'Bfrtip',
        buttons:  [
        { 
          extend:'excel',
          text: 'excel',
          title: 'Firm Transfer <?= Carbon\Carbon::now()->format("d-m-Y")?>',
          filename: 'firm_transfer_<?= Carbon\Carbon::now()->format("d-m-Y")?>',
          className: 'btn btn-success text-uppercase',
          exportOptions:{ 
            columns: [0,1,2,3,4,5,6,7,8,9,10,11]
          }
        }, 
        { 
          extend:'pdf',
          text: 'pdf',
          title: 'Firm Transfer <?= Carbon\Carbon::now()->format("d-m-Y")?>',
          filename: 'firm_transfer_<?= Carbon\Carbon::now()->format("d-m-Y")?>',
          className: 'btn btn-success text-uppercase',
          exportOptions:{ 
            columns: [0,1,2,3,4,5,6,7,8,9,10,11]
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
              doc.content[1].table.body[i][10].alignment  = 'left '; 
              doc.content[1].table.body[i][11].alignment  = 'left '; 
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
          title: 'Firm Transfer <?= Carbon\Carbon::now()->format("d-m-Y")?>',
          filename: 'firm_transfer_<?= Carbon\Carbon::now()->format("d-m-Y")?>',
          className: 'btn btn-success text-uppercase',
          exportOptions:{
            columns: [0,1,2,3,4,5,6,7,8,9]
          }
        }],
        ajax:"{!! route('firmView') !!}",
        columns:[
            {data:'DT_RowIndex', className: 'text-center text-uppercase'},
            {data:'error_code', className: 'text-center text-uppercase'},  
            {data:'message_error', className: 'text-center text-uppercase'},  
            {data:'url', className: 'text-center text-uppercase'},     
            {data:'error_solved', className: 'text-center text-uppercase'},    
            {data:'action', className: 'text-center'},
        ],
        createdRow: function ( row, data, index ) { 
          console.log(data['approval'] == 1);
            if ( data['approval'] == 1 ) {
                $('td', row).eq(1).css({'background-color':'#28a745','color':'white'});
                $('td', row).eq(2).css({'background-color':'#28a745','color':'white'});
                $('td', row).eq(3).css({'background-color':'#28a745','color':'white'});
                $('td', row).eq(4).css({'background-color':'#28a745','color':'white'});
            }
        },
        })
        $('.search').keyup(function(){
            let i = $(this).attr('id')
            let v = this.value 
            tables.columns(i).search(v).draw()
        }) 
      })
  </script>
@endsection