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
                <li class="breadcrumb-item active" aria-current="page">Ubah</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">Ubah User</h4>
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
            <input type="hidden" id="id" name="id" value="{{ $user->id }}">
            <input type="hidden" id="approved" name="approved" value="{{ $user->approved }}">
            <div class="row">
                <label for="nik" class="col-sm-2 col-form-label">NIK *</label>
                <div class="col-sm-4">
                  <input type="text" id="nik" name="nik" class="form-control form-control-sm" autocomplete="off" value="{{ $user->nik }}" required>
                </div>
                <label for="branch_id" class="col-sm-2 col-form-label">Cabang *</label>
                <div class="col-sm-4">
                  <select name="branch_id" id="branch_id" class="form-control form-control-sm select2bs4" style="width: 100%;" required>
                      <option value="">- Pilih -</option>
                      @foreach($branchs as $branch)
                        <option value="{{$branch->id}}" {{ ( $user->branch->id == $branch->id) ? 'selected' : '' }}>{{$branch->branch_code}} - {{$branch->branch_name}}</option>
                      @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <label for="name" class="col-sm-2 col-form-label">Nama *</label>
                <div class="col-sm-4">
                  <input type="text" id="name" name="name" class="form-control form-control-sm" autocomplete="off" value="{{ $user->name }}" required>
                </div>
                <label for="email" class="col-sm-2 col-form-label">E-mail *</label>
                <div class="col-sm-4">
                    <input type="email" id="email" name="email" class="form-control form-control-sm" autocomplete="off" value="{{ $user->email }}" required>
                </div>
            </div>
            <div class="row mt-2">
                <label for="departemen_id" class="col-sm-2 col-form-label">Departemen *</label>
                <div class="col-sm-4">
                  <select name="departemen_id" id="departemen_id" class="form-control form-control-sm select2bs4" style="width: 100%;" required>
                      <option value="">- Pilih -</option>
                      @foreach($departemens as $departemen)
                        <option value="{{$departemen->id}}" {{ ( $user->departemenuser->departemen_id == $departemen->id) ? 'selected' : '' }}>{{$departemen->departemen_code}} - {{$departemen->departemen_name}}</option>
                      @endforeach
                    </select>
                </div>
                <label for="role_id" class="col-sm-2 col-form-label">Hak Akses</label>
                <div class="col-sm-4">
                    <select name="role_id" id="role_id" class="form-control form-control-sm select2bs4" style="width: 100%;" required>
                      <option value="">- Pilih -</option>
                      @foreach($roles as $role)
                        <option value="{{$role->id}}" {{ ( $user->roleuser->role_id == $role->id) ? 'selected' : '' }}>{{$role->title}}</option>
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
                        <option value="{{$driver->id}}"  {{ ( $user->driver_id == $driver->id) ? 'selected' : '' }}>{{$driver->driver_name}}</option>
                      @endforeach
                    </select>
                </div>
                <label for="verified" class="col-sm-2 col-form-label">Aktif ? *</label>
                <div class="col-sm-2">
                  <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="form-control custom-control-input" id="is_approved" name="is_approved" {{ ( $user->approved == "1") ? 'checked' : '' }}>
                      <label class="custom-control-label" for="is_approved"></label>
                  </div>
                </div>
            </div>

            <div class="mt-4">
                <span class="float-md-right">
                    <a href="{{ url('setting/users') }}" class="btn btn-sm btn-danger" type="button"><i class="fas fa-arrow-left"></i> Batal</a>
                    @can('user_update')
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
<script src="{{ asset('dashforge/lib/jqueryui/jquery-ui.min.js') }}"></script>
@parent
<script>
$(function(){
  'use strict'
   // Basic with search
    $('.select2').select2({
        placeholder: 'Pilih..',
        searchInputPlaceholder: 'Search options'
    });
  
    $("#frm-add").submit(function (e) {
    e.preventDefault();
    if($("#is_approved").prop("checked")){
        $('#approved').val('1');
    }else{
        $('#approved').val('0');
    }
    
    var action = "{{ route('user-settings.update') }}";
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