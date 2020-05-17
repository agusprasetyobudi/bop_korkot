@extends('layouts.login')

@section('title ')
    <title>Aplikasi BOP KORKOT</title>    
@endsection

@error('username')
@php
    Alert::error($message);
@endphp
@enderror
@error('password')
@php
    Alert::error($message);
@endphp
@enderror

@section('body')
<div class="login-box">
  <div class="login-logo">
    <div class="pull-left">
      <img src="{!! asset('assets/img/Logo_kemen_PU.jpg') !!}" class="img-circle" style="width:300px; height:290px;" alt="User Image">
    </div>
    <a href="{!! route('login') !!}"><b>BOP </b>Korkot</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="{!! route('login') !!}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Email" name="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
  
      {{-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> --}}
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
@endsection