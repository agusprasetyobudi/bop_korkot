@extends('layouts.adminlte')

@section('navbar')
    @include('layouts.partials.navbar')
@endsection

@section('sidebar')
    @include('layouts.partials.sidebar')
@endsection

@section('addtionalCSS')
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/daterangepicker/daterangepicker.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/select2/css/select2.min.css') !!}">    
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}">
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
                    <h1>Tambah Rekapitulasi Bukti Transfer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <ol class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></ol>
                        <ol class="breadcrumb-item"><a href="{!! route('buktiTransferView') !!}">Rekapitulasi Bukti Transfer</a></ol>
                        <ol class="breadcrumb-item active">Tambah Rekapitulasi Bukti Transfer</ol>
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
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="" class="text-uppercase">No. Bukti Transfer</label>
                                <div class="row">
                                    <div class="col-md-10">
                                        <input type="text" name="bukti_transfer" class="form-control bukti-tranfer" readonly>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-warning btn-block" id="bukti-transfer">Pilih</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="text-uppercase">tanggal transfer</label>
                                <input type="text" name="tanggal_transfer" id="" class="form-control tanggal-tranfer" readonly>
                            </div> 
                            <div class="form-group">
                                <label for="" class="text-uppercase">jabatan</label>
                                <input type="text" name="jabatan" id="" class="form-control jabatan" readonly>
                            </div>
                            <div class="form-group">
                                <label for="" class="text-uppercase">Kantor</label>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <input type="text" name="osp" id="" class="form-control osp" readonly>
                                        <input type="hidden" name="id_osp" id="">
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" name="nama_kantor" id="" class="form-control nama-kantor" readonly>
                                        <input type="hidden" name="id_kantor" id="kantor">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="text-uppercase">periode</label>
                                <input type="text" name="periode_nama" id="" class="form-control periode" readonly>
                                <input type="hidden" name="" id="periode-by-dates" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="" class="text-uppercase">bank penerima</label>
                                <input type="text" name="bank_penerima" id="" class="form-control nama-bank" readonly>
                            </div> 
                            <div class="form-group">
                                <label for="" class="text-uppercase">nomor rekening penerima</label>
                                <input type="text" name="nomor_rek_penerima" id="" class="form-control no-rek-penerima" readonly>
                            </div> 
                            <div class="form-group">
                                <label for="" class="text-uppercase">nama penerima</label>
                                <input type="text" name="nama_penerima" id="" class="form-control nama-penerima" readonly>
                            </div> 
                            <div class="form-group">
                                <label for="" class="text-uppercase">diterima tanggal</label>
                                <input type="text" name="tanggal_diterima" id="tanggal-terima" class="form-control" readonly>
                            </div> 
                            <div class="form-group">
                                <label for="" class="text-uppercase">jumlah diterima </label> <b style="color:red; padding-left:10%; text-transform: uppercase;" class="money-notify"></b>
                                <input type="number" name="jumlah_diterima" id="" class="form-control input-uang" readonly>
                                <input type="hidden" name="jumlah_diterima" id="" class="form-control uang-kontrak">
                            </div>  
                        </div>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-lg-12">
                       <div class="card">
                            <div class="card-header">
                                <h5 style="font-weight: bold">Komponen Biaya</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <select name="" id="select-komponen-biaya" class="form-control"></select>
                                    </div>
                                    <div class="col-lg-3">
                                        <select name="" id="select-sub-komponen" class="form-control"></select>
                                    </div>
                                    <div class="col-lg-3">
                                        <select name="" id="select-aktifitas" class="form-control"></select>
                                    </div>
                                    <div class="col-lg-3">
                                        <button class="btn btn-block btn-info" id="komponen-biaya" hidden>Cari</button>
                                    </div>
                                </div>
                            </div>
                    <form action="{!! route('buktiTransferPost') !!}" id="form-submit" method="post">
                        @csrf
                        <input type="hidden" name="firm" id="firm">
                        <input type="text" name="tanggal_terima" id="tanggal-terima-val">
                            <div class="card-body"> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table class="table table-bordered" id="tableKomponenKontrak">
                                            <thead>
                                                <tr>
                                                    <th class="text-center text-uppercase">#</th>
                                                    <th class="text-center text-uppercase">komponen</th>
                                                    <th class="text-center text-uppercase">subkomponen/aktifitas</th>
                                                    <th class="text-center text-uppercase">nilai kontrak</th>
                                                    <th class="text-center text-uppercase">alokasi dana</th>
                                                    <th class="text-center text-uppercase">opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="4">Total</th>
                                                    <th colspan="2"><input type="text" class="form-control" name="total_dana" id="total-dana" style="background-color:transparent;border: 0;font-size: 1em;" value="0" readonly></th> 
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-block btn-warning" id="save-data">Simpan Data</button>
                            </div>
                        </div>
                   </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Bukti Transfer -->
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
                        <th class="text-center text-uppercase">kantor</th>
                        <th class="text-center text-uppercase">tanggal transfer</th>
                        <th class="text-center text-uppercase">jabatan</th>
                        <th class="text-center text-uppercase">bank penerima</th>
                        <th class="text-center text-uppercase">no rekening penerima</th>
                        <th class="text-center text-uppercase">jumlah transfer</th>
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
    <!-- Modal Komponen Biaya -->
    <div class="modal fade" id="komponen-biaya-modal" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-xl">
        <div class="modal-content" style="width: 120%">
          <div class="modal-header">
            <h4 class="modal-title">Pilih Aktifitas</h4>
            <button type="button" class="close close-aktifitas" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          {{-- <div class="modal-body">
              <div class="row">
                  <div class="col-sm-2">
                        <select name="aktifitas" id="aktifitas" class="form-control"></select>
                  </div>
              </div>
          </div> --}}
          <div class="modal-body">
            <table class="table table-bordered table-hover" id="tableKomponenBiaya">
                <thead>
                    <tr>
                        <th class="text-center text-uppercase">#</th>
                        <th class="text-center text-uppercase">kode kontrak</th>
                        <th class="text-center text-uppercase">aktifitas</th>
                        <th class="text-center text-uppercase">nominal</th>
                        <th class="text-center text-uppercase">dari</th>
                        <th class="text-center text-uppercase">ke</th>
                        <th class="text-center text-uppercase">opsi</th>
                    </tr>
                </thead>
            </table>
          </div>
          {{-- <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div> --}}
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
@endsection

@section('addtionalJS')
    <!-- DataTables -->
    <script src="{!! asset('assets/adminlte/plugins/datatables/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') !!}"></script>
    <script src="{!! asset('assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') !!}"></script>
    <script src="{!! asset('assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') !!}"></script>
    <script src="{!! asset('assets/adminlte/plugins/moment/moment.min.js') !!}"></script>
    <script src="{!! asset('assets/adminlte/plugins/daterangepicker/daterangepicker.js') !!}"></script>
    <script src="{!! asset('assets/adminlte/plugins/select2/js/select2.full.min.js') !!}"></script>


    <script>
        $(()=>{ 
            let tableKomponenKontrak = $('#tableKomponenKontrak').DataTable({
                // responsive: true,
                autoWidth: false,
                paging: false,
                searching: false,
                bSort: false, 
                columnDefs: [
                               {"className": "text-center", "targets": "_all"}
                            ],
            })            
            let tableBuktiTransfer = $('#tableBuktiTranfer').DataTable({
                responsive: true,
                autoWidth: false, 
                bSort: false, 
                ajax: "{!! route('firmAPI') !!}",
                columns:[
                    {data:'DT_RowIndex', className: 'text-center text-uppercase'},
                    {data:'no_bukti', className: 'text-center text-uppercase'},
                    {data:'kantor', className: 'text-center text-uppercase'},
                    {data:'tanggal_tf', className: 'text-center text-uppercase'},
                    {data:'jabatan', className: 'text-center text-uppercase'},
                    {data:'nama_bank', className: 'text-center text-uppercase'},
                    {data:'bank_account_number', className: 'text-center text-uppercase'},
                    {data:'amount', className: 'text-center text-uppercase'},
                    {data:'periode', className: 'text-center text-uppercase'},
                    {data:'action', className: 'text-center text-uppercase'},
                ]

            }) 
            let tableKomponenBiaya = $('#tableKomponenBiaya').DataTable({
                responsive: true,
                autoWidth: false,
                bSort: false,
                bDestroy: true,  
                ajax: {
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{!! route('GetSubAktifitasAPI') !!}", 
                    type: 'POST',
                    dataType: 'json',
                    data:function(d){
                        d.kantor = $('#kantor').val()
                        d.sub_komponen = $('#select-sub-komponen').val()
                        d.aktifitas = $('#select-aktifitas').val()
                        d.periode_date = $('#periode-by-dates').val()
                    }
                },
                columns:[
                    {data:'DT_RowIndex', className: 'text-center text-uppercase'},
                    {data:'kode_kontrak', className: 'text-center text-uppercase'},
                    {data:'aktifitas', className: 'text-center text-uppercase'}, 
                    {data:'nominal', className: 'text-center text-uppercase'}, 
                    {data:'asal', className: 'text-center text-uppercase'}, 
                    {data:'tujuan', className: 'text-center text-uppercase'}, 
                    {data:'action', className: 'text-center text-uppercase'},
                ]

            })
            $('#bukti-transfer').click(()=>{
                // alert('tadaaa')
                $('#bukti-tf-modal').modal({backdrop: 'static', keyboard: false})  
                tableBuktiTransfer.ajax.reload()
            })
            $('#komponen-biaya').click(()=>{ 
                $('#komponen-biaya-modal').modal({backdrop: 'static', keyboard: false})  
                tableKomponenBiaya.ajax.reload()
            })
            $('.close-aktifitas').click(()=>{
                tableKomponenBiaya.clear();
                tableKomponenBiaya.search('').draw();
            })
            $('.close-bukti-transfer').click(()=>{
                tableBuktiTransfer.clear();
                tableBuktiTransfer.search('').draw();
            })
            $('#tableBuktiTranfer tbody').on('click', 'button', tableBuktiTransfer, function(){
                // alert($(this).data('name'))
                $('#firm').val($(this).data('name'))
                $.ajax({
                    url: "{!! route('firmAPI') !!}",
                    method: 'GET',
                    data:{'from_rekap':$(this).data('name')},
                    cache:false,
                    success: function(res){
                        console.log(res)
                        // console.log($('.input-uang').val())
                        $('.uang-kontrak').val(res.amount_tf)
                        $('.bukti-tranfer').val(res.no_bukti)
                        $('.tanggal-tranfer').val(res.tanggal)
                        $('.jabatan').val(res.jabatan)
                        $('.osp').val(res.osp)
                        $('.nama-kantor').val(res.kantor)
                        $('#kantor').val(res.id_kantor)
                        $('.periode').val(res.periode)
                        $('#periode-by-dates').val(res.periode_by_date)
                        $('.nama-bank').val(res.nama_bank)
                        $('.no-rek-penerima').val(res.account_bank)
                        $('.nama-penerima').val(res.nama_penerima) 
                        $('#bukti-tf-modal').modal('hide')
                        $('.input-uang').attr("readonly", false)
                        $('#tanggal-terima').attr("readonly", false) 
                        if($('.input-uang').val() != ''){    
                            $('.input-uang').val(null)
                            $('.uang-kontrak').val("")
                        }
                    }
                })
            })
            let count = 1
            $('#tableKomponenBiaya tbody').on('click', 'button', tableKomponenBiaya, function(){
                // alert($(this).data('name'))
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{!! route('GetSubAktifitasAPI') !!}",
                    method: 'POST',
                    data:{'kontrak':$(this).data('name')}, 
                    cache:false,
                    success: function(res){ 
                        console.log(res)
                        tableKomponenKontrak.row.add([
                            `${count}`,
                            `${res.nama_komponen}`,
                            `${res.sub_komponen} / ${res.aktifitas}`,
                            `${res.nominalParse}`,
                            `<input type='hidden' name='item_kontrak[]' value='${res.id_kontrak}'><input type='text' name='alokasi_dana[]' class='form-control item-dana' value='${format(res.nominal)}'>`,
                            `<button data-id='${count}' data-val='${count}' type='button' class='btn circle btn-danger btn-delete-row'><i class='fa fa-trash'></i></button>`
                        ]).draw(false)
                        let uangFinal = totalUang(res.nominal)
                        $('#total-dana').val(format(uangFinal))                         

                        $('#komponen-biaya-modal').modal('hide')
                        tableBuktiTransfer.clear(); 
                        tableKomponenBiaya.search('').draw();
                        tableKomponenBiaya.ajax.reload()
                    }
                })
            })
            $('#tanggal-terima').daterangepicker({
                singleDatePicker: true,
                locale:{
                    format: 'DD/MM/YYYY'
                },
                minDate: moment().format('DD/MM/YYYY')
            })
            $('#tanggal-terima').change(function(){ 
                $('#tanggal-terima-val').val(this.value)
            })
            $('#save-data').click(function(e){ 
                e.preventDefault()
                $('#tanggal-terima-val').val($('#tanggal-terima').val())
                $('#form-submit').trigger('submit')
            })
            let timerTimeout
            $('.input-uang').keyup(()=>{ 
                if($('.input-uang').val() == 0 || $('.input-uang') == null ){
                    $('.money-notify').html('Uang Tidak Boleh Kosong')
                }else if($('.uang-kontrak').val() !=  $('.input-uang').val()){
                    clearTimeout(timerTimeout)
                    timerTimeout = setTimeout($('.input-uang').val(), 5000) 
                    console.log($('.input-uang').val())
                    $('.money-notify').html('Uang Tidak Sesuai') 
                }else{
                    $('.money-notify').html('')
                }
            })
            $('#select-komponen-biaya').select2({
                placeholder: 'Pilih Komponen Biaya',
                theme: 'bootstrap4',
                width: '100%',
                ajax:{
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{!! route('GetKomponenAPI') !!}",
                    dataType: 'json',
                    type: 'GET',
                    processResults: function(data){
                        return {
                            results: $.map(data, function(item){
                                return {
                                    text: item.nama_komponen,
                                    id: item.id
                                }
                            })
                        }
                    }
                }
            })
            $('#select-sub-komponen').select2({
                placeholder: 'Pilih Sub Komponen',
                theme: 'bootstrap4',
                width: '100%',
                ajax:{
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{!! route('GetSubKomponenAPI') !!}",
                    dataType: 'json',
                    type: 'POST',
                    data: function(params) {
                        return {
                            q: $.trim(params.term),
                            id: $('#select-komponen-biaya').val()
                        }
                    },
                    processResults: function(data){
                        return {
                            results: $.map(data, function(item){
                                return {
                                    text: item.nama_komponen,
                                    id: item.id
                                }
                            })
                        }
                    }
                }
            })
            $('#select-aktifitas').select2({
                placeholder: 'Pilih Aktifitas',
                theme: 'bootstrap4',
                width: '100%',
                ajax:{
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{!! route('GetSubAktifitasAPI') !!}",
                    dataType: 'json',
                    data: function(params) {
                        return {
                            q: $.trim(params.term),
                            id: $('#select-sub-komponen').val(), 
                        }
                    },
                    type: 'POST',
                    processResults: function(data){
                        return {
                            results: $.map(data, function(item){
                                // alert('Got It')
                                // console.log(item)
                                return {
                                    text: item.nama_aktifitas,
                                    id: item.id
                                }
                            })
                        }
                    }
                }
            }) 
            $('#select-aktifitas').on("select2:selecting", function(e) { 
                $('#komponen-biaya').attr('hidden',false)
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
            // var total = 0
            let totalUang = (data)=>{
                let val = $('#total-dana').val()
                val = val.replace(/,/g,'');
                var num = parseFloat(val);
                let total = num + parseInt(data)  
                return total
            } 
            $('#tableKomponenKontrak tbody').on('keyup','.item-dana',function(e){
                var val = $(this).val();
                val = val.replace(/,/g,'');
                var num = parseFloat(val);
                $(this).val(format(num));
                
                total = 0;
                $(".item-dana").each(function(){
                    var val = $(this).val();
                    val = val.replace(/,/g,'');
                    var num = parseFloat(val);
                    total = total + num;
                });
                // console.log(total)
                $("#total-dana").val(format(total));
            })
            $('#tableKomponenKontrak tbody').on('change','.item-dana',function(){
                var val = $(this).val();
                val = val.replace(/,/g,'');
                var num = parseFloat(val);
                $(this).val(format(num));
                
                total = 0;
                $(".item-dana").each(function(){
                    var val = $(this).val();
                    val = val.replace(/,/g,'');
                    var num = parseFloat(val);
                    total = total + num;
                });
                console.log(total)
                $("#total-dana").val(format(total));
            });
        })
    </script>
@endsection