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
                <h1>Tambah Data Pengguna</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('PenggunaView') !!}">Pengguna</a></li>
                    <li class="breadcrumb-item active">Tambah Data Pengguna</li>
                </ol>
            </div>
        </div>
    </div>
</section>
@endsection

@section('body')
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">Data Pengguna</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="" class="text-uppercase">Nama Pengguna</label>
                                        <input type="text" class="form-control nama-pengguna">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="text-uppercase">password</label>
                                        <input type="password" class="form-control" id="password">
                                    </div>
                                     
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="" class="text-uppercase">Username</label>
                                        <input type="text" class="form-control username" >
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="" class="text-uppercase">Konfirmasi Password</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <span class="text-right" style="font-weight: bold;" id='message'></span>
                                            </div>
                                        </div>
                                        <input type="password" class="form-control" id="confirm_password" >
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">Kantor & Jabatan</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="" class="text-uppercase">kantor</label>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <select class="form-control osp">
                                                    {{-- <option value="">1</option> --}}
                                                </select>
                                            </div>
                                            <div class="col-sm-9">
                                                <select class="form-control kantor">
                                                    {{-- <option value="">2</option> --}}
                                                </select>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-sm-6"> 
                                    <div class="form-group">  
                                        <label for="" class="text-uppercase">Jabatan</label>
                                        <select class="form-control text-uppercase jabatan"></select>     
                                    </div> 
                                </div>
                            </div>
                        </div> 
                    </div>
                </div> 
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">Kelompok Pengguna</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="" class="text-uppercase">Kelompok Pengguna</label>
                                        <label for="" class="text-uppercase">Jabatan</label>
                                        <select class="form-control text-uppercase kabupaten-dari"></select>     
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="button" value="Tambah Pengguna" class="btn btn-warning  btn-block" id="btn-tambag" style="font-weight: bold">
                        </div>
                    </div>
                </div> 
            </div> 
        </div>
    </div>
</section>
@endsection

@section('addtionalJS')
    <script>
        $(()=>{
            $('#password, #confirm_password').on('keyup', function () {
            if ($('#password').val() == $('#confirm_password').val()) {
                $('#message').html('Matching').css('color', 'green');
            } else 
                $('#message').html('Not Matching').css('color', 'red');
            });
        })
    </script>
@endsection