@extends('layouts.adminlte')

@section('navbar')
    @include('layouts.partials.navbar')
@endsection

@section('sidebar')
    @include('layouts.partials.sidebar')
@endsection

@section('addtionalCSS') 
@endsection

@section('page_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Data Komponen Biaya</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('KomponenBiayaView') !!}">Komponen Biaya</a></li>
                        <li class="breadcrumb-item active">Update Komponen Biaya</li>
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
                    <form action="{!! route('KomponenBiayaEditpost') !!}" method="post">
                        @csrf
                        <input type="hidden" name="urldata" value="{!! Request::segment(4) !!}">
                        <div class="card">
                            <div class="card-header">Update Data Komponen Biaya</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="" class="text-uppercase">Komponen Biaya</label>
                                    <input type="text" name="komponen_biaya" class="form-control komponen-biaya" value="{!! $data->komponen_biaya !!}">                                    
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-warning btn-add">Update Komponen Biaya</button>
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