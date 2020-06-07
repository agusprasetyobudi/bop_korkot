@extends('layouts.adminlte')

@section('navbar')
    @include('layouts.partials.navbar')
@endsection

@section('sidebar')
    @include('layouts.partials.sidebar')
@endsection
 

@section('page_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Data OSP</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('OSPView') !!}">OSP</a></li>
                        <li class="breadcrumb-item active">Tambah Data OSP</li>
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
                    <form action="{!! route('OSPEditpost') !!}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-header">Tambah Data OSP</div> 
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="" class="text-center text-uppercase">nama osp</label>
                                    <input type="text" name="nama-osp" class="form-control nama-osp" value="{!! $data->osp_name !!}">
                                    <input type="hidden" name="urlData" class="form-control nama-osp" value="{!! Request::segment(4) !!}">
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-warning btn-nama-osp">Tambah Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
 