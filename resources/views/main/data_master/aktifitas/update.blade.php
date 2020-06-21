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
                    <h1>Tambah Data Aktifitas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('AktifitasView') !!}">List Aktifitas</a></li>
                        <li class="breadcrumb-item active">Tambah Aktifitas</li>
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
                    <form action="{!! route('AktifitasEditpost') !!}" method="post">
                        @csrf
                        <input type="hidden" name="urldata" value="{!! Request::segment(4) !!}">
                        <div class="card">
                            <div class="card-header">
                                Tambah Data Aktifitas
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="" class="text-uppercase">nama aktifitas</label>
                                    <input type="text" name="nama_aktifitas" id="" class="form-control nama-aktifitas" value="{!! $data->nama_aktifitas !!}">
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-warning btn-add">Tambah Data Aktifitas</button>
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