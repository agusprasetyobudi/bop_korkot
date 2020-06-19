@extends('layouts.adminlte')

@section('navbar')
    @include('layouts.partials.navbar')
@endsection

@section('sidebar')
    @include('layouts.partials.sidebar')
@endsection

@section('addtionalCSS')  
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}">   
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/select2/css/select2.min.css') !!}">    
@endsection

@section('page_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Jabatan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('JabatanView') !!}">Jabatan</a></li>
                        <li class="breadcrumb-item active">Tambah Jabatan</li>
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
                    <form action="{!! route('JabatanEditpost') !!}" method="post">
                        @csrf
                        <input type="hidden"name="urldata" value="{!! Crypt::encrypt($data->id); !!}">
                        <div class="card">
                            <div class="card-header">Tambah Data Jabatan</div>
                            <div class="card-body">
                                <div class="fomr-group">
                                    <label for="" class="text-uppercase">kode jabatan</label>
                                    <input type="text" class="form-control" name="kode_jabatan" value="{!! $data->kode_jabatan !!}">
                                </div>
                                <div class="fomr-group">
                                    <label for="" class="text-uppercase">nama jabatan</label>
                                    <input type="text" class="form-control" name="nama_jabatan" value="{!! $data->nama_jabatan !!}">
                                </div>
                                <div class="fomr-group">
                                    <label for="" class="text-uppercase">posisi kantor</label>
                                    <select class="form-control posisi-kantor text-uppercase" name="posisi_kantor">
                                        <option @if($data->posisi_kantor == "korkot") selected @endif value="korkot" class="text-uppercase">korkot</option>
                                        <option @if($data->posisi_kantor == "askot") selected @endif value="askot" class="text-uppercase">askot</option>
                                        <option @if($data->posisi_kantor == "provinsi") selected @endif value="provinsi" class="text-uppercase">provinsi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-warning btn-add">Tambah Data Jabatan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('addtionalJS') 
<script src="{!! asset('assets/adminlte/plugins/select2/js/select2.full.min.js') !!}"></script>
<script src="{!! asset('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<script>
    $(()=>{ 
        $('.posisi-kantor').select2({  
            width: '100%',
            theme:'bootstrap4',
            containerCssClass: 'text-uppercase',
            dropdownCssClass: 'text-uppercase'
        }) 
    })
</script>    
@endsection