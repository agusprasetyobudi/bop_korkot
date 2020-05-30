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
            <div class="row mb2">
                <div class="col-sm-6">
                    <h1>Report Penerimaan Transfer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li class="breadcrumb-item active">Report Penerimaan Transfer</li>
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
                            <h5>Report Penerimaan Transfer</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="text-uppercase">periode (dari)</label>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <select name="" id="" class="form-control">
                                                        <option selected disabled>Pilih Periode Bulan</option>
                                                        <option value="">1</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <select name="" id="" class="form-control">
                                                        <option selected disabled>Pilih Periode Tahun</option>
                                                        <option value="">2</option>
                                                    </select>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="" class="text-uppercase">periode (sampai)</label>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <select name="" id="" class="form-control">
                                                        <option selected disabled>Pilih Periode Bulan</option>
                                                        <option value="">3</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <select name="" id="" class="form-control">
                                                        <option selected disabled>Pilih Periode Tahun</option>
                                                        <option value="">1</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="" class="text-uppercase">OSP dan Kantor</label>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <select name="" id="" class="form-control">
                                                <option value="">1</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <select name="" id="" class="form-control">
                                                <option value="">1</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('addtionalJS')
    
@endsection