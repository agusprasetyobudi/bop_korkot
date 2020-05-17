@extends('layouts/adminlte')

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
            <h1>Firm Transfer</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{!! URL::to('/') !!}">Home</a></li>
                <li class="breadcrumb-item active">Firm Transfer</li>
            </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('body')
    <section class="content">
        <div class="container-fluid">
            <form action="" method="post">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6"> 
                                <div class="form-group">
                                  <label class="text-uppercase">no bukti transfer</label>
                                  <input type="email" class="form-control">
                                </div> 
                                <div class="form-group">
                                  <label class="text-uppercase">tanggal transfer</label>
                                  <input type="text" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                  <label class="text-uppercase">jabatan</label>
                                  <input type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                  <label class="text-uppercase">kantor</label>
                                  {{-- <input type="text" class="form-control"> --}}
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <select name="" class="form-control">
                                              <option value="">Test</option>  
                                            </select>
                                        </div>
                                        <div class="col-sm-10">
                                            <select name="" class="form-control">
                                              <option value="">Test</option>  
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label class="text-uppercase">periode</label>
                                  {{-- <input type="text" class="form-control"> --}}
                                <div class="row">
                                    <div class="col-sm-2">
                                        <select name="" class="form-control">
                                            <option value="">Test</option>  
                                        </select>
                                    </div>
                                    <div class="col-sm-10">
                                        <select name="" class="form-control">
                                            <option value="">Test</option>  
                                        </select>
                                    </div>
                                </div>
                                </div> 
                            </div>
                            <div class="col-md-6"> 
                                <div class="form-group">
                                  <label class="text-uppercase">bank penerima</label>
                                  <input type="email" class="form-control">
                                </div> 
                                <div class="form-group">
                                  <label class="text-uppercase">nomor rekening penerima</label>
                                  <input type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                  <label class="text-uppercase">nama penerima</label>
                                  <input type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                  <label class="text-uppercase">jumlah ditransfer</label>
                                  <input type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                  <label class="text-uppercase">keterangan</label>
                                  <textarea name="" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning btn-sm btn-block">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection