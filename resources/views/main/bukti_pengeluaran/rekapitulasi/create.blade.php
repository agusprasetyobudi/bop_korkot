@extends('layouts.adminlte')

@section('navbar')
    @include('layouts.partials.navbar')
@endsection

@section('sidebar')
    @include('layouts.partials.sidebar')
@endsection

@section('addtionalCSS')
<link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css') !!}">
<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }
    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }
</style>
@endsection

@section('page_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Rekapitulasi Bukti Pengeluaran</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('buktiPengeluaranView') !!}">Rekapitulasi Butki Pengeluaran</a></li>
                        <li class="breadcrumb-item active">Tambah Bukti Pengeluaran </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('body')
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">Form Rekapitulasi Bukti Transfer</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="" class="text-uppercase">no bukti</label>
                                            <input type="text" class="form-control" id="no-bukti" readonly value="{!! $data->no_bukti !!}">
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal-tf" class="text-uppercase">tanggal transfer</label>
                                            <input type="text" class="form-control" id="tanggal-tf" readonly value="{!! $data->tanggal_transfer !!}">
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="text-uppercase">jabatan</label>
                                            <input type="text" class="form-control" id="jabatan" readonly value="{!! $data->jabatan !!}">
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="text-uppercase">Kantor</label>
                                            <div class="form-row">
                                                <div class="col">
                                                    <input type="text" id="osp" class="form-control" value="{!! $data->osp !!}" readonly>
                                                </div>
                                                <div class="col">
                                                    <input type="text" id="nama-kantor" class="form-control" value="{!! $data->kantor !!}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="text-uppercase">periode</label>
                                            <input type="text" id="periode" class="form-control" value="{!! $data->periode !!}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="" class="text-uppercase">Bank Penerima</label>
                                            <input type="text" id="bank" class="form-control" value="{!! $data->bank !!}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="text-uppercase">Nomor Rekening Penerima</label>
                                            <input type="text" id="no-rekening" class="form-control" value="{!! $data->nama_penerima !!}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="text-uppercase">Nama Penerima</label>
                                            <input type="text" id="nama-penerima" class="form-control" value="{!! $data->no_rekening !!}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="text-uppercase">Tanggal Terima</label>
                                            <input type="text" id="tanggal-terima" class="form-control" value="{!! $data->tanggal_terima !!}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="text-uppercase">Jumlah Terima</label>
                                            <input type="text" id="jumlah-terima" class="form-control" value="{!! $data->jumlah_terima !!}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <form action="{!! route('buktiPengeluaranPost') !!}" method="post">
                        <div class="row">
                                @csrf
                                <input type="hidden" name="something_like_this" value="{!! $data->id !!}">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">Komponen Biaya</div>
                                        <div class="card-body">
                                            <table id="tableKomponenBiaya" class="table tabl-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-uppercase">No</th>
                                                        <th class="text-uppercase">Komponen</th>
                                                        <th class="text-uppercase">Sub komponen / Akitifitas</th>
                                                        <th class="text-uppercase">nilai kontrak</th>
                                                        <th class="text-uppercase">alokasi</th>
                                                        <th class="text-uppercase">implementasi</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="4">Total</th>
                                                        <th>Total</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-block btn-warning text-uppercase" id="save-data">Simpan Data</button>
                                        </div>
                                    </div>
                                </div>
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
        $(function(){
            $('#tableKomponenBiaya').DataTable({
                autoWidth: false,
                paging: false,
                searching: false,
                bSort: false,
                ajax:{
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{!! route('getApiBuktiTransfer') !!}",
                    type: 'get',
                    dataType: 'json',
                    data: function(params) {
                        params.id = '{!! $kontrak->id !!}'
                    }
                },
                columns:[
                    {data:'DT_RowIndex', className: 'text-uppercase'},
                    {data:'komponen', className: 'text-uppercase'},
                    {data:'sub_komponen', className: 'text-uppercase'},
                    {data:'nilai_kontrak', className: 'text-uppercase'},
                    {data:'alokasi', className: 'text-uppercase'},
                    {data:'implementasi', className: 'text-uppercase'},
                ]
            })
        })
    </script>
@endsection