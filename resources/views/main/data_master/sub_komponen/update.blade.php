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
                    <h1>Edit Data Sub Komponen Biaya</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('KomponenBiayaView') !!}">List Komponen Biaya</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('SubKomponenView',['id'=>Request::segment('4')]) !!}">List Sub Komponen Biaya</a></li>
                        <li class="breadcrumb-item active">Edit Sub Komponen Biaya</li>
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
                    <form action="{!! route('SubKomponenUpdatePost') !!}" method="post">
                        <input type="hidden" name="urldata" id="" value="{!! $id !!}"> 
                        <input type="hidden" name="sub_urldata" id="" value="{!! $sub_id !!}"> 
                        @csrf 
                        <div class="card">
                            <div class="card-header">Edit Sub Komponen Biaya</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="" class="text-uppercase">Komponen Biaya</label>
                                    <input type="text" name="sub_komponen" id="" class="form-control komponen-biaya" value="{!! $data->komponen_biaya !!}">
                                </div>  
                                <div class="form-group">
                                    <div>
                                        <label for="" class="text-uppercase">P / A / K</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="" type="hidden" name="p" value="0">
                                        <input class="form-check-input" type="checkbox" @if($data->allow_provinsi) checked @endif name="p" value="1">
                                        <label class="form-check-label text-uppercase" for="inlineCheckbox1">p</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="" type="hidden" name="a" value="0">
                                        <input class="form-check-input" type="checkbox" @if($data->allow_assisten) checked @endif name="a" value="1">
                                        <label class="form-check-label text-uppercase" for="inlineCheckbox2">a</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="" type="hidden" name="k" value="0">
                                        <input class="form-check-input" type="checkbox" @if($data->allow_korkot) checked @endif name="k" value="1">
                                        <label class="form-check-label text-uppercase" for="inlineCheckbox3">k</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-warning">Tambah Komponen Biaya</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('addtionalJS') 
@endsection