@extends('layouts.adminlte')

@section('navbar')
    @include('layouts.partials.navbar')
@endsection

@section('sidebar')
    @include('layouts.partials.sidebar')
@endsection

@section('addtionalCSS')
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/select2/css/select2.min.css') !!}">    
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}">
@endsection

@section('page_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Kantor</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('KantorView') !!}">Kantor</a></li>
                        <li class="breadcrumb-item active">Update Kantor</li>
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
                        <div class="card-header">
                            Tambah Data Kantor
                        </div>
                       <form action="{!! route('KantorEditpost') !!}" method="post">
                        @csrf
                        <input type="hidden"name="urldata" value="{!! Crypt::encrypt($data->id); !!}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="" class="text-uppercase">kode kantor</label>
                                    <input type="text" id="kode_kantor" name="kode_kantor" class="form-control" value="{!! $data->kode_kantor !!}">
                                </div>
                                <div class="form-group">
                                    <label class="text-uppercase">osp</label>
                                    <select id="osp" class="form-control osp-select" name="osp">
                                        <option disabled selected>Pilih OSP</option>
                                        @foreach ($osp as $item)
                                            <option value="{!! $item->id !!}" @if ($data->id_osp == $item->id) selected @endif>{!! $item->osp_name !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="text-uppercase">provinsi</label>
                                    <select id="provinsi" class="form-control provinsi-select" name="provinsi">
                                        <option disabled selected>Pilih Provinsi</option>
                                        @foreach ($provinsi as $item)
                                            <option value="{!! $item->id !!}" @if ($data->id_provinsi == $item->id) selected @endif>{!! $item->provinsi_name !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="text-uppercase">kabupaten</label>
                                    <select id="kabupaten" class="form-control kabupaten-select" name="kabupaten">
                                        <option value="{!! $data->id_kabupaten!!}" selected>{!! $data->kabupaten->kabupaten_name !!}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="" class="text-uppercase">nama kantor</label>
                                    <input type="text" id="nama_kantor" name="nama_kantor" class="form-control" value="{!! $data->nama_kantor !!}">
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-warning btn-add-kantor">Tambah Data Kantor</button>
                            </div>  
                       </form>
                    </div>
                </div> 
            </div>
        </div>
    </section>
@endsection

@section('addtionalJS') 
<script src="{!! asset('assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') !!}"></script>
<script src="{!! asset('assets/adminlte/plugins/select2/js/select2.full.min.js') !!}"></script>
<script src="{!! asset('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<script>
    $(()=>{ 
        $('.osp-select').select2({
            theme: 'bootstrap4'
        })

        $('.provinsi-select').select2({
         theme: 'bootstrap4'
        })  
        $('.kabupaten-select').select2({ 
        theme: 'bootstrap4',
        ajax:{
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{!! route('GetKabupatenKota') !!}",
            dataType: 'json',
            type: 'POST',
            data:function(term){ 
                return {
                    id: $('.provinsi-select').find('option:selected').val()
                }
            },
            processResults: function (data) { 
                return {
                    results: $.map(data, function (item) {
                        // console.log(item)
                        return {
                            text: item.kabupaten_name,
                            id: item.id
                        }
                    })
                };
            }
        }
        })
 
    })
</script>
@endsection