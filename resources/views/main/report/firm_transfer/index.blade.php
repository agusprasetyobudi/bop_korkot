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
                    <h1>Report Firm Transfer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{!! URL::to('/') !!}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Report Firm Transfer
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('addtionalCSS')
    
@endsection

@section('body')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            Report Bukti Transfer
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <select name="" id="" class="form-control">
                                        <option value="">1</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="" id="" class="form-control">
                                        <option value="">2</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="" id="" class="form-control">
                                        <option value="">3</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="" id="" class="form-control">
                                        <option value="">4</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>List Bukti Transfer</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="tableReportFirmTransfer">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="card-footer">
                            <input type="button" class="btn btn-warning" value="Excel">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('addtionalJS')
    
@endsection