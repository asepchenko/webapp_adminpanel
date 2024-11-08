@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Master</a></li>
                <li class="breadcrumb-item"><a href="#">Area</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
              </ol>
            </nav>
            <h4 class="mg-b-0"> {{ $area->area_name }}</h4>
          </div>
        </div>
      </div><!-- container -->
    </div><!-- content -->

    <div class="content">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="row">
        <div class="col-lg-6">
        <form method="post" enctype="multipart/form-data" id="frm-add">
            @csrf
            <input type="hidden" name="id" id="id" value="{{ $id }}"/>
            <div class="row">
                <label for="area_name" class="col-sm-4 col-form-label">Nama Area *</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control form-control-sm" id="area_name" name="area_name" autocomplete="off" value="{{ $area->area_name }}">
                </div>
            </div>
            <div class="mt-2">
                <span class="float-md-right">
                    <a href="{{ url('master/areas') }}" class="btn btn-sm btn-danger" type="button"><i class="fas fa-arrow-left"></i> Batal</a>
                    @can('master_area_update')
                    <button type="button" id="btn_save" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-sm btn-brand-02" id="btn_save_wait" disabled
                            style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Menyimpan Data..</i>
                    </button>
                    @endcan
                </span>  
            </div>
        </form>
      </div><!-- col -->
    </div><!-- row -->


    <div class="row">
      <div class="col-md-12">
        <p><h5>List Cakupan Kota</h5></p>
        <form method="post" enctype="multipart/form-data" id="frm-detail">
            @csrf
            <div class="row">
                <label for="city_id" class="col-sm-2 col-form-label">Kota *</label>
                <div class="col-sm-4">
                    <select name="city_id" id="city_id" class="form-control form-control-sm select2bs4" style="width: 100%;" required>
                        <option value="">- Pilih -</option>
                        @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->city_code}} - {{$city->city_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                <span class="float-md-right">
                    @can('master_area_update')
                    <button type="button" id="btn_save_detail" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-save"></i> Tambah Kota</button>
                    <button type="button" class="btn btn-sm btn-brand-02" id="btn_save_detail_wait" disabled
                            style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Menyimpan Data Kota..</i>
                    </button>
                    @endcan
                </span>  
                </div>
            </div>
        </form>
        <hr>
        <div class="demo-table">
            <table id="table_city" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th class="wd-30p">Kode</th>
                        <th class="wd-65p">Nama Kota</th>
                        <th class="wd-5p">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div><!-- df-example -->
    </div> <!-- col -->
    </div><!-- row -->
      
  </div><!-- container -->
</div><!-- content -->

@endsection
@section('scripts')
@parent
<script>
    function deleteDetail(data){
        var loader = $('#loader');
        loader.show();
        var action = "{{ route('area-cities.delete') }}";
        var form_data = new FormData();
        form_data.append('id', data);
        form_data.append('_token', '{{csrf_token()}}');
        $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: action,
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function () {
            $('#btn_save_detail').hide();
            $('#btn_save_detail_wait').hide();
            //showPreloader();
        },
        complete: function () {
            $('#btn_save_detail').show();
            $('#btn_save_detail_wait').hide();
            loader.hide();
        },
        success: function (data) {
            $('#table_city').DataTable().ajax.reload();
        },
        error: function (jqXHR, exception) {
            loader.hide();
            alertError(jqXHR.status, exception, jqXHR.responseText);
        }
        });
    }
 
$(function(){
  'use strict'

  //Initialize Select2 Elements
  $('.select2bs4').select2({
      theme: 'bootstrap4'
  });

  $("#btn_save").click(function (e) {
    e.preventDefault();
    var action = "{{ route('areas.update') }}";
    var form_data = new FormData();
    form_data.append('id', $('#id').val());
    form_data.append('area_name', $('#area_name').val());
    form_data.append('_token', '{{csrf_token()}}');
    $.ajax({
      type: "POST",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: action,
      data: form_data,
      cache: false,
      contentType: false,
      processData: false,
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
      success: function (data) {
        alert("Berhasil mengubah data");
        window.location.href = "{{ url('master/areas') }}/"+"{{$id}}";
      },
      error: function (jqXHR, exception) {
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });

  $('#table_city').DataTable({
    language: {
      searchPlaceholder: 'Cari Data...',
      sSearch: '',
      lengthMenu: '_MENU_ data/halaman',
      zeroRecords: 'Tidak Ada Data :(',
      info: 'Menampilkan Halaman _PAGE_ dari _PAGES_',
      infoEmpty: '',
      infoFiltered: '(Terfilter dari _MAX_ total data)'
    },
    processing: true,
    serverSide: true,
    ajax: {
      url: '{{ url("master/area-cities/area") }}/{{ $id }}',
      type: 'GET',
    },
    columns: [
      { data: 'cities.city_code', name: 'cities.city_code' },
      { data: 'cities.city_name', name: 'cities.city_name' },
      {
        data: 'id',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data !== "") {
            return '<a class="dropdown-item has-icon" href="#" onClick="deleteDetail('+ data +');"><i class="fa fa-trash-alt"></i> Hapus</a>';
          } else {
            return '';
          }
        }
      },
    ]
  });

  $("#btn_save_detail").click(function (e) {
    e.preventDefault();
    var action = "{{ route('area-cities.store') }}";
    var form_data = new FormData();
    form_data.append('area_id', $('#id').val());
    form_data.append('city_id', $('#city_id').val());
    form_data.append('_token', '{{csrf_token()}}');
    $.ajax({
      type: "POST",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: action,
      data: form_data,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function () {
        $('#btn_save_detail').hide();
        $('#btn_save_detail_wait').show();
        //showPreloader();
      },
      complete: function () {
        $('#btn_save_detail').show();
        $('#btn_save_detail_wait').hide();
        //hidePreloader();
      },
      success: function (data) {
        $('#table_city').DataTable().ajax.reload();
        $('#city_id').val('');
        $('#city_id').trigger('change');
      },
      error: function (jqXHR, exception) {
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });
});
</script>
@endsection