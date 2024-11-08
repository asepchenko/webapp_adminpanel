@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Setting</a></li>
                <li class="breadcrumb-item"><a href="#">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">Tambah User</h4>
          </div>
        </div>
      </div><!-- container -->
    </div><!-- content -->

    <div class="content">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="row">
        <div class="col-lg-12">
        <form method="post" action="#" enctype="multipart/form-data" id="frm-add">
            @csrf
            <div class="row">
                <label for="nik" class="col-sm-2 col-form-label">NIK *</label>
                <div class="col-sm-4">
                  <input type="text" id="nik" name="nik" class="form-control form-control-sm" autocomplete="off" required>
                </div>
                <label for="branch_id" class="col-sm-2 col-form-label">Cabang *</label>
                <div class="col-sm-4">
                  <select name="branch_id" id="branch_id" class="form-control form-control-sm select2bs4" style="width: 100%;" required>
                      <option value="">- Pilih -</option>
                      @foreach($branchs as $branch)
                        <option value="{{$branch->id}}">{{$branch->branch_code}} - {{$branch->branch_name}}</option>
                      @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <label for="name" class="col-sm-2 col-form-label">Nama *</label>
                <div class="col-sm-4">
                  <input type="text" id="name" name="name" class="form-control form-control-sm" autocomplete="off" required>
                </div>
                <label for="email" class="col-sm-2 col-form-label">E-mail *</label>
                <div class="col-sm-4">
                    <input type="email" id="email" name="email" class="form-control form-control-sm" autocomplete="off" required>
                </div>
            </div>
            <div class="row mt-2">
                <label for="departemen_id" class="col-sm-2 col-form-label">Departemen *</label>
                <div class="col-sm-4">
                  <select name="departemen_id" id="departemen_id" class="form-control form-control-sm select2bs4" style="width: 100%;" required>
                      <option value="">- Pilih -</option>
                      @foreach($departemens as $departemen)
                        <option value="{{$departemen->id}}">{{$departemen->departemen_code}} - {{$departemen->departemen_name}}</option>
                      @endforeach
                    </select>
                </div>
                <label for="role_id" class="col-sm-2 col-form-label">Hak Akses</label>
                <div class="col-sm-4">
                    <select name="role_id" id="role_id" class="form-control form-control-sm select2bs4" style="width: 100%;" required>
                      <option value="">- Pilih -</option>
                      @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->title}}</option>
                      @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-2">
              <label for="driver_id" class="col-sm-2 col-form-label">Driver ID</label>
                <div class="col-sm-4">
                    <select name="driver_id" id="driver_id" class="form-control form-control-sm select2bs4" style="width: 100%;">
                      <option value="">- Pilih -</option>
                      @foreach($drivers as $driver)
                        <option value="{{$driver->id}}">{{$driver->driver_name}}</option>
                      @endforeach
                    </select>
                </div>
                <label for="verified" class="col-sm-2 col-form-label">Aktif ? *</label>
                <div class="col-sm-2">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="verified">
                    <label class="custom-control-label" for="verified"></label>
                </div>
                </div>
            </div>

            <div class="mt-4">
                <span class="float-md-right">
                    <a href="{{ url('setting/users') }}" class="btn btn-sm btn-danger" type="button"><i class="fas fa-arrow-left"></i> Batal</a>
                    @can('user_create')
                    <button type="submit" id="btn_save" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-sm btn-brand-02" id="btn_save_wait" disabled
                    style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Menyimpan Data...</i>
                    </button>
                    @endcan
                </span>
            </div>
        </form>
    </div><!-- col -->
    </div><!-- row -->
      
      </div><!-- container -->
    </div><!-- content -->

@endsection
@section('scripts')
@parent
<script>
$(function(){
  'use strict'
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  
    $('#driver_id').on('change', function () {
      var driver_id = $(this).val();
      if(driver_id != ""){
        $('#role_id').val(9); //driver
        $('#role_id').trigger('change');
        $('#departemen_id').val(2); //operation
        $('#departemen_id').trigger('change');
        $('#name').val($('#driver_id option:selected').text()); 

        //$('#role_id').select2('destroy').prop("readonly", true);
        //$('#departemen_id').select2('destroy').prop("readonly", true);
        //$('#name').prop('readonly', true);
      }else{
        $('#role_id').val("");
        $('#role_id').trigger('change');
        $('#departemen_id').val("");
        $('#departemen_id').trigger('change');
        $('#name').val("");

        //$('#role_id').select2('disabled', false);
        //$('#departemen_id').select2('disabled', false);
        //$('#name').prop('disabled', false);
      }
    });

    $("#frm-add").submit(function (e) {
    e.preventDefault();
    var action = "{{ route('user-settings.store') }}";
    var datas = new FormData($("#frm-add")[0]);
    $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: action,
        data: datas,
        dataType: 'json',
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function () {
            $('#btn_save').hide();
            $('#btn_save_wait').show();
            //showPreloader();
        },
        complete: function () {
            $('#btn_save').show();
            $('#btn_save_wait').hide();
            //hidePreloader();
        },
        success: function (result) {
            console.log(result);
            window.location.href = "{{ url('setting/users') }}";
        },
        error: function (jqXHR, exception) {
            alertError(jqXHR.status, exception, jqXHR.responseText);
        }
    });
  });

});
</script>
@endsection