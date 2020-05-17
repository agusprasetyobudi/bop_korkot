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
            <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right"> 
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('body') 
<section class="content">
    <div class="container-fluid">
      <!-- Info boxes -->
      <div class="row"> 
        <div class="col-md-12">
          <div class="card"> 
            <!-- /.card-header --> 
            <div class="card-body">
               <div class="text-center">
                {{-- <div class="pull-left"> --}}
                  <img src="{!! asset('assets/img/Logo_kemen_PU.jpg') !!}" style="width:300px; height:290px;border-radius:50%;box-shadow: 0px 5px 8px #888888;" alt="User Image">
                {{-- </div> --}}
               </div>
               <div class="card-body">
                <div class="text-center">
                  {{-- <p class="h2">Selamat Datang {!! Auth::user()->name !!}</p> --}}
                  <p class="h1">{!! env('APP_NAMES') !!}</p> 

 
                </div>
               </div>
            </div>
            <!-- ./card-body -->              
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Main row -->
     
      <!-- /.row -->
    </div><!--/. container-fluid -->
</section>
@endsection