@extends('layouts.adminlte')

@section('navbar')
    @include('layouts.partials.navbar')
@endsection

@section('sidebar')
    @include('layouts.partials.sidebar')
@endsection

@section('addtionalCSS')
    <link rel="stylesheet" href="{!! asset('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css') !!}">
    <link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">
@endsection

@section('page_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List Pengguna</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! URL::to('/')!!}">Home</a></li>
                        <li class="breadcrumb-item active">List Pengguna</li>
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
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5>Data Pengguna</h5>
                                </div>
                                <div class="col-lg-6 text-right">
                                    <a href="{!! route('PenggunaCreate') !!}" class="btn btn-warning">Tambah Data Pengguna</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-bordered" id="tableDataPengguna">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase">#</th>
                                        <th class="text-center text-uppercase">name</th>
                                        <th class="text-center text-uppercase">username</th>
                                        <th class="text-center text-uppercase">osp</th>
                                        <th class="text-center text-uppercase">kantor</th>
                                        <th class="text-center text-uppercase">jabatan</th>
                                        <th class="text-center text-uppercase">group</th>
                                        <th class="text-center text-uppercase">opsi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-open" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                  <h4>Change Password</h4>
              </div>
              <div class="modal-body"> 
                  <input type="hidden" id="another-value">
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Confirm Password</label>
                        <input type="password" name="" id="confirm-password" class="form-control">
                    </div> 
              </div>
              <div class="modal-footer">
                  <div class="row">
                      <div class="col-md-6">
                          {{-- <input type="button" value="Reset" class="btn btn-default" id="btn-reset"> --}}
                          <button type="button" class="btn btn-outline-light btn-default" data-dismiss="modal">Close</button>
                      </div>
                      <div class="col-md-6">
                          <input type="button" value="Simpan" class="btn btn-warning" id="btn-submit">
                      </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
    </section>
@endsection

@section('addtionalJS')
<script src="{{ $cdn?? asset('vendor/sweetalert/sweetalert.all.js')  }}"></script>
<!-- DataTables -->
<script src="{!! asset('assets/adminlte/plugins/datatables/jquery.dataTables.min.js') !!}"></script>
<script src="{!! asset('assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') !!}"></script>
<script src="{!! asset('assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') !!}"></script>
<script src="{!! asset('assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') !!}"></script>
<script>
  $(()=>{
      let tables = $("#tableDataPengguna").DataTable({ 
            "scrollX": true, 
            responsive: true,
            autoWidth: false,
            paging: true,
            lengthChange: true,
            searching: true,
            processing: true,  
          ajax: "{!! route('PenggunaView') !!}",
          columns:[
              {data: 'DT_RowIndex', className:'text-center text-uppercase'},
              {data: 'name', className:'text-center text-uppercase'},
              {data: 'username', className:'text-center text-uppercase'},
              {data: 'osp', className:'text-center text-uppercase'},
              {data: 'kantor', className:'text-center text-uppercase'},
              {data: 'jabatan', className:'text-center text-uppercase'},
              {data: 'groups', className:'text-center text-uppercase'},
              {data: 'opsi', className:'text-center'},
          ]
      })
      $('#tableDataPengguna tbody').on('click', '#delete-confirm', tables, function () { 
            if(confirm('Anda yakin mau menghapus Pengguna ini ?')){
                    const id = $(this).data('name');
                    let url = "{{ route('PenggunaDestroy', ':id') }}";
                        url = url.replace(':id', id);
                        document.location.href=url; 
                } 
    })   
    $('#tableDataPengguna tbody').on('click','#change-password', tables, function() {
        const data = $(this).data('name')
        // alert(data)
        $('#modal-open').modal('show')
        $('#another-value').val(data)
        $('#password').val('')
        $('#confirm-password').val('')
        
    })
    $('#btn-submit').click(function(){
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{!! route('KelompokPenggunaResetPassword') !!}",
            dataType: 'json',
            type: 'POST',  
            data:{
                data: $('#another-value').val(),
                password: $('#password').val(),
                password_confirmation : $('#confirm-password').val()
            },
            success: function(params){
            $('#modal-open').modal('hide')
            $('#password').val('')
            $('#confirm-password').val('')
            Swal.fire({
                icon: 'success',
                title: 'Yeay',
                text: params.message, 
            })
            },
            error: function(xhr, status, error) {
            $('#modal-open').modal('hide')
            $('#password').val('')
            $('#confirm-password').val('')
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: xhr.responseJSON.message, 
            })
            }
        })
    })
  })
</script>    
@endsection