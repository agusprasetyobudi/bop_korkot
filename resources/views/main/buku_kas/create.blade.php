@extends('layouts.adminlte')

@section('navbar')
    @include('layouts.partials.navbar')
@endsection

@section('sidebar')
    @include('layouts.partials.sidebar')
@endsection

@section('addtionalCSS')
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    
@endsection

@section('page_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Data Buku Kas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Buku Kas</a></li>
                        <li class="breadcrumb-item active">Tambah Data Buku Kas</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('body')
    <section class="content">
        <div class="row">
            <!-- Search Data -->
            <div class="col-lg-12">
                <div class="card">
                    <form class="search-forms">
                        <div class="card-header">
                            <h5>Form Buku Kas</h5> 
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for=""> KOTA (KABUPATEN) / NAMA KORKOT</label>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="text" name="lokasiKotaKab" class="form-control kota-korkot" value="Kota Bekasi" readonly>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" name="name_user" class="form-control" readonly value="{!! Auth::user()->name !!}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">BULAN / TAHUN</label>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                {{-- <input type="text" name="" class="form-control"> --}}
                                                <select name="bulan" id="" class="form-control bulan-korkot" required>
                                                    <option selected disabled>Pilih Bulan</option>
                                                    <option value="02">02</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                {{-- <input type="text" name="" class="form-control"> --}}
                                                <select name="tahun" id="" class="form-control tahun-korkot" required>
                                                    <option selected disableb>Pilih Tahun</option>
                                                    <option value="2020">2020</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div> 
                        </div>
                        <div class="card-footer">
                            {{-- <button type="submit" class="btn btn-warning search-data">Search Data</button> --}}
                            <input type="button" class="btn btn-warning search-data" value="Seach Data">
                        </div>
                    </form>
                </div>
            </div>
            <!-- Form Submitted To Database -->
            <div class="col-lg-12">
                <form action="{!! route('bukuKasStore') !!}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5>transaksi kredit</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6"> 
                                    <div class="form-group">
                                        <label for="" class="text-uppercase">kredit</label>
                                        <input type="text" name="kredit" id="" class="form-control" required>
                                    </div> 
                                    <div class="form-group">
                                        <label for="" class="text-uppercase">tanggal</label>
                                        <input type="text" name="tanggal" id="" class="form-control tanggal" required>
                                    </div> 
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="" class="text-uppercase">no bukti</label>
                                        <input type="text" name="no_bukti" id="" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="text-uppercase">komponen biaya</label> 
                                        <select name="komponen_biaya" id="" class="form-control" required>
                                            <option disable selected class="text-uppercase">pilih komponen biaya</option>
                                            <option value="0">Test</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-warning btn-lg btn-block">Tambah Data</button>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </section>
@endsection

@section('addtionalJS')
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script>
        $(()=>{
            let today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
            $('.tanggal').datepicker({
                setDate: new Date(),
                format: 'yyyy-mm-dd hh:mm',
                uiLibrary: 'bootstrap4',
                miDate: today
            })
            $('.search-data').click(()=>{
                let bulan = $('.bulan-korkot').children("option:selected").val(),
                tahun = $('.tahun-korkot').children("option:selected").val(),
                pushed = { 
                    id_user: {{ Auth::user()->id}},
                    kota_id: 1,
                    bulan : bulan,
                    tahun: tahun
                }
                console.log(pushed) 
                $.ajax({
                    type: 'POST',
                    url:"{!! route('bukuKasStore') !!}",
                    headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
                    dataType: 'json',
                    data : pushed
                })
            })
        })
    </script>
@endsection