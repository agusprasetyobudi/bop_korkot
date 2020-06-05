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
                    <h5>Update Data Provinsi</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('provinsiView') !!}">Provinsi</a></li>
                        <li class="breadcrumb-item active">Update Provinsi</li>
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
                    <form action="{!! route('provinsiEditpost') !!}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-header">Form Update Data Provinsi</div>
                            <div class="card-body">
                                    <div class="form-group">
                                        <label for="" class="text-uppercase">Nama Provinsi</label>
                                        <input type="text" name="provinsi_name" id="" class="form-control" value="{!! $data->provinsi_name !!}">
                                        <input type="hidden" name="url_data" id="" class="form-control" value="{!! Request::segment(4) !!}">
                                    </div>
                                </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-warning">Update Data</button>
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