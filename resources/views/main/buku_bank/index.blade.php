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
                <h1>Buku Bank</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                <li class="breadcrumb-item active">Buku Bank</li>
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
                            <table id="tableBukuBank" class="table table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase">#</th>
                                        <th class="text-center text-uppercase">no bukti transfer</th>
                                        <th class="text-center text-uppercase">tanggal</th>
                                        <th class="text-center text-uppercase">uraian</th>
                                        <th class="text-center text-uppercase">no bukti</th>
                                        <th class="text-center text-uppercase">transaksi debet</th>
                                        <th class="text-center text-uppercase">transaksi kredit</th>
                                        <th class="text-center text-uppercase">saldo debet</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>123456789</td>
                                        <td>{!! now() !!}</td>
                                        <td>Test</td>
                                        <td>12345678911</td>
                                        <td>{!! number_format(123456789,2) !!}</td>
                                        <td>{!! number_format(123456789,2) !!}</td>
                                        <td>{!! number_format(123456789,2) !!}</td>
                                    </tr>
                                </tbody>
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
          let tables = $("#tableBukuBank").DataTable({
            initComplete: function(settings, json){
            $('#tableBukuBank').wrap("<div style='overflow:auto; width:100%;position:relative;'></div>")
            }, 
            processing: true,  
            ajax: "{!! route('bukuBankView') !!}",
            columns:[
                {data: 'DT_RowIndex', className:'text-center text-uppercase'},
                {data: 'name', className:'text-center text-uppercase'},
                {data: 'username', className:'text-center text-uppercase'},
                {data: 'osp', className:'text-center text-uppercase'},
                {data: 'kantor', className:'text-center text-uppercase'},
                {data: 'jabatan', className:'text-center text-uppercase'},
                {data: 'groups', className:'text-center text-uppercase'},
                {data: 'opsi', className:'text-center'},
            ],
            createdRow: function ( row, data, index ) {
                $('td', row).eq(4).css({'width':'20%'});
                $('td', row).eq(7).css({'width':'50%'});
            }
          })
      })
  </script>
@endsection