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
                    <h1>Update Data Kabupaten/Kota</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('KabupatenKotaView') !!}">Kabupaten/Kota</a></li>
                        <li class="breadcrumb-item active">Update Kabupaten/Kota</li>
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
                        <form action="{!! route('KabupatenKotaEditpost') !!}" method="post">
                            @csrf
                            <div class="card-header">Update Data Kabupaten/Kota</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="" class="text-uppercase">Nama Kabupaten/Kota</label>
                                    <input type="text" name="nama-kota-kabupaten" class="form-control" value="{!! $kabupaten->kabupaten_name !!}">
                                    <input type="hidden" name="urlData" class="form-control" value="{!! Request::segment(4) !!}">
                                </div>
                                <div class="form-group">
                                    <label for="" class="text-uppercase">Nama Provinsi</label>
                                    <select name="nama-provinsi" id="nama-provinsi" class="form-control nama-provinsi-select2">
                                        <option selected disabled value>Pilih Provinsi</option>
                                        @foreach ($province as $item)
                                            <option value="{!! $item->id !!}" @if($kabupaten->provinsi_id == $item->id) selected @endif>{!! $item->provinsi_name !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-warning">Update Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('addtionalJS')
<script src="{!! asset('assets/adminlte/plugins/select2/js/select2.full.min.js') !!}"></script>
    <script>
         $(".nama-provinsi-select2").select2({
            theme: 'bootstrap4'
         })
    </script>
@endsection