@extends('layouts/adminlte')

@section('navbar')
    @include('layouts.partials.navbar')
@endsection

@section('sidebar')
    @include('layouts.partials.sidebar')
@endsection

@section('addtionalCSS')
    {{-- <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css') !!}">     --}}
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/select2/css/select2.min.css') !!}">    
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/daterangepicker/daterangepicker.css') !!}">
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
            <form action="{!! route('firmCreatePost') !!}" method="post">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6"> 
                                <div class="form-group">
                                  <label class="text-uppercase">no bukti transfer</label>
                                  <input type="text" name="no_bukti_trf" class="form-control">
                                </div> 
                                <div class="form-group">
                                  <label class="text-uppercase">tanggal transfer</label>
                                  {{-- <input type="text" name="tanggal_trf" class="form-control" value="{!! $date !!}" readonly> --}}
                                  <input type="text" name="tanggal_trf" class="form-control" id="tanggal-tf">
                                </div>
                                <div class="form-group">
                                  <label class="text-uppercase">jabatan</label>
                                  {{-- <input type="text" class="form-control"> --}}
                                    <select name="jabatan" class="form-control jabatan">
                                        {{-- <option value="">Test</option>   --}}
                                    </select>
                                </div>
                                <div class="form-group">
                                  <label class="text-uppercase">kantor</label>
                                  {{-- <input type="text" class="form-control"> --}}
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <select name="osp" class="form-control osp">
                                              {{-- <option value="">Test</option>   --}}
                                            </select>
                                        </div>
                                        <div class="col-sm-10">
                                            <select name="kantor" class="form-control kantor">
                                              {{-- <option value="">Test</option>   --}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label class="text-uppercase">periode</label>
                                  {{-- <input type="text" class="form-control"> --}}
                                <div class="row">
                                    <div class="col-sm-2">
                                        <select name="periode_month" class="form-control month"> 
                                        </select>
                                    </div>
                                    <div class="col-sm-10">
                                        <select name="periode_year" class="form-control year">
                                            {{-- <option value="">Test</option>   --}}
                                        </select>
                                    </div>
                                </div>
                                </div> 
                            </div>
                            <div class="col-md-6"> 
                                <div class="form-group">
                                  <label class="text-uppercase">bank penerima</label>
                                  <select name="bank" class="form-control bank">
                                    {{-- <option value="">Test</option>   --}}
                                </select>
                                </div> 
                                <div class="form-group">
                                  <label class="text-uppercase">nomor rekening penerima</label>
                                  <input type="text" name="no_rekening" class="form-control">
                                </div>
                                <div class="form-group">
                                  <label class="text-uppercase">nama penerima</label>
                                  <input type="text" name="penerima" class="form-control">
                                </div>
                                <div class="form-group">
                                  <label class="text-uppercase">jumlah ditransfer</label>
                                  <input type="text" class="form-control uang">
                                  <input type="hidden" name="jumlah_transfer" class="form-control uang-replace">
                                </div>
                                <div class="form-group">
                                  <label class="text-uppercase">keterangan</label>
                                  <textarea name="keterangan" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning btn-sm btn-block">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('addtionalJS') 
    <script src="{!! asset('assets/adminlte/plugins/select2/js/select2.full.min.js') !!}"></script>
    <script src="{!! asset('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
    <script src="{!! asset('assets/adminlte/plugins/moment/moment.min.js') !!}"></script>
    <script src="{!! asset('assets/adminlte/plugins/daterangepicker/daterangepicker.js') !!}"></script> 
    <script>
        $(()=>{
            $('.jabatan').select2({
                placeholder: 'Pilih Jabatan',
                theme: 'bootstrap4',
                width: '100%',
                ajax:{
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{!! route('JabatanGetAjax') !!}",
                    dataType: 'json',
                    type: 'POST',
                    data: function(term){
                        return{
                            q: $.trim(term.term)
                        }
                    },
                    processResults: function(data){
                        return{
                            results: $.map(data, function(item){ 
                                return{
                                    text: item.kode_jabatan+' - '+item.nama_jabatan,
                                    id: item.id
                                }
                            })
                        }
                    }
                }
            })
            $('.bank').select2({
                placeholder: 'Pilih Bank',
                theme: 'bootstrap4',
                width: '100%',
                ajax:{
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{!! route('BankGetAjax') !!}",
                    dataType: 'json',
                    type: 'POST',
                    data: function(term){
                        return{
                            q: $.trim(term.term)
                        }
                    },
                    processResults: function(data){
                        return{
                            results: $.map(data, function(item){ 
                                return{
                                    text: item.nama_bank,
                                    id: item.id
                                }
                            })
                        }
                    }
                }
            })
            $('.osp').select2({
                placeholder: 'Pilih OSP',
                theme: 'bootstrap4',
                width: '100%',
                ajax:{
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{!! route('OSPGetAPI') !!}",
                    dataType: 'json',
                    type: 'GET',
                    data: function(term){
                        return{
                            q: $.trim(term.term)
                        }
                    },
                    processResults: function(data){
                        return{
                            results: $.map(data, function(item){ 
                                return{
                                    text: item.nama_osp,
                                    id: item.id
                                }
                            })
                        }
                    }
                }
            })
            $('.kantor').select2({
                placeholder: 'Pilih Kantor',
                theme: 'bootstrap4',
                width: '100%',
                ajax:{
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{!! route('KantorGetAPI') !!}",
                    dataType: 'json',
                    type: 'POST',
                    data: function(term){
                        return{
                            id: $('.osp').find('option:selected').val(), 
                            q: $.trim(term.term)
                        }
                    },
                    processResults: function(data){
                        return{
                            results: $.map(data, function(item){ 
                                return{
                                    text: item.nama_kantor,
                                    // text: item.kode_kantor+' - '+item.nama_kantor,
                                    id: item.id
                                }
                            })
                        }
                    }
                }
            })
            $('.month').select2({
                minimumResultsForSearch: Infinity,
                placeholder: 'Pilih Bulan',
                theme: 'bootstrap4',
                width: '100%',
                ajax:{
                    url: "{!! route('PeriodeMonthList') !!}",
                    dataType: 'json',
                    type: 'GET',
                    processResults: function(data){
                        // console.log(data)
                        return{
                            results: $.map(data, function(item,id){ 
                                // console.log(id)
                                return{
                                    text: item,
                                    id: id
                                }
                            })
                        }
                    }
                }
            })
            $('.year').select2({
                minimumResultsForSearch: Infinity,
                placeholder: 'Pilih Tahun',
                theme: 'bootstrap4',
                width: '100%',
                ajax:{
                    url: "{!! route('PeriodeYearList') !!}",
                    dataType: 'json',
                    type: 'GET',
                    processResults: function(data){
                        return{
                            results: $.map(data, function(item){ 
                                return{
                                    text: item,
                                    id: item
                                }
                            })
                        }
                    }
                }
            }) 
            $('#tanggal-tf').daterangepicker({
                singleDatePicker: true,
                locale:{
                    format: 'DD/MM/YYYY'
                }, 
            })
        })
        $(function(){
        $(".uang").keyup(function(e){
            $('.uang-replace').val($(this).val().replace(/[^0-9.]|\.(?=\d{3,})/g, ""))
            $(this).val(format($(this).val()));
        });
        });
        var format = function(num){
            // $('#uang-replace').val(num)
            var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
            if(str.indexOf(".") > 0) {
                parts = str.split(".");
                str = parts[0];
            }
            str = str.split("").reverse();
            for(var j = 0, len = str.length; j < len; j++) {
                if(str[j] != ",") {
                output.push(str[j]);
                if(i%3 == 0 && j < (len - 1)) {
                    output.push(",");
                }
                i++;
                }
            }
            formatted = output.reverse().join("");
            return("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
            };
    </script>
@endsection