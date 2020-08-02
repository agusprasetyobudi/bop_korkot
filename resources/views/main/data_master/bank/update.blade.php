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
                    <h1>Update Bank</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('BankView') !!}">Bank</a></li>
                        <li class="breadcrumb-item active">Update Bank</li>
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
                    <form action="{!! route('BankEditpost') !!}" method="post">
                        @csrf
                        <input type="hidden"name="urldata" value="{!! Crypt::encrypt($data->id); !!}">
                        <div class="card">
                            <div class="card-header">Update Data Bank</div>
                            <div class="card-body">
                                <div class="fomr-group">
                                    <label for="" class="text-uppercase">Nama Bank</label>
                                    <input type="text" class="form-control" name="nama_bank" value="{!! $data->nama_bank !!}">
                                </div> 
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-warning btn-add">Update Data Bank</button>
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