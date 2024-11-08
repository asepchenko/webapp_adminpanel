@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Master</a></li>
                <li class="breadcrumb-item"><a href="#">Agent</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">Tambah Agent</h4>
          </div>
        </div>
      </div><!-- container -->
    </div><!-- content -->

    <div class="content">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="row">
        <div class="col-lg-12">
        <form method="post" action="{{ route('agents.store') }}" enctype="multipart/form-data" id="frm-add">
            @csrf
            <input type="hidden" id="tax" name="tax" value="">
            <div class="row mt-2">
                <label for="agent_name" class="col-sm-2 col-form-label">Nama Agent *</label>
                <div class="col-sm-4">
                  <input type="text" id="agent_name" name="agent_name" class="form-control form-control-sm" autocomplete="off" required >
                </div>
                <!--<label for="email" class="col-sm-2 col-form-label">E-mail *</label>
                <div class="col-sm-4">
                    <input type="text" id="email" name="email" class="form-control form-control-sm" autocomplete="off" required >
                </div>-->
                <label for="phone_number" class="col-sm-2 col-form-label">No Telpon *</label>
                <div class="col-sm-4">
                  <input type="text" id="phone_number" name="phone_number" class="form-control form-control-sm" autocomplete="off" required >
                </div>
            </div>
            <div class="row mt-2">
                <label for="city_id" class="col-sm-2 col-form-label">Kota *</label>
                <div class="col-sm-4">
                  <select name="city_id" id="city_id" class="form-control form-control-sm select2bs4" style="width: 100%;" required>
                    <option value="">- Pilih -</option>
                    @foreach($cities as $city)
                    <option value="{{$city->id}}">{{$city->city_name}}</option>
                    @endforeach
                  </select>
                </div>
                <label for="address" class="col-sm-2 col-form-label">Alamat *</label>
                <div class="col-sm-4">
                    <textarea id="address" name="address" class="form-control form-control-sm" line="3" required></textarea>
                </div>
            </div>
            <div class="row mt-2">
                <label for="area_id" class="col-sm-2 col-form-label">Area</label>
                <div class="col-sm-4">
                    <select name="area_id" id="area_id" class="form-control form-control-sm select2bs4" style="width: 100%;">
                        <option value="">- Pilih -</option>
                        @foreach($areas as $area)
                        <option value="{{$area->id}}">{{$area->area_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <label for="tax_number" class="col-sm-2 col-form-label">NPWP *</label>
                <div class="col-sm-4">
                    <input type="text" id="tax_number" name="tax_number" class="form-control form-control-sm" autocomplete="off" >
                </div>
                <label for="is_tax" class="col-sm-2 col-form-label">PKP</label>
                <div class="col-sm-4">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="form-control custom-control-input" id="is_tax" name="is_tax">
                    <label class="custom-control-label" for="is_tax"></label>
                  </div>
                </div>
            </div>
            <div class="row mt-2">
                <label for="mou_file" class="col-sm-2 col-form-label">MoU *</label>
                <div class="col-sm-4">
                    <input type="file" id="mou_file" name="mou_file" accept=".doc,.docx,.pdf" required>
                </div>
            </div>
            <div class="row mt-2">
                <label for="mou_start_date" class="col-sm-2 col-form-label">Tgl Efektif MoU *</label>
                <div class="col-sm-4">
                  <input type="date" class="form-control datetimepicker-input" autocomplete="off" id="mou_start_date" name="mou_start_date" required>
                </div>
                <label for="mou_end_date" class="col-sm-2 col-form-label">Tgl Berakhir MoU *</label>
                <div class="col-sm-4">
                  <input type="date" class="form-control datetimepicker-input" autocomplete="off" id="mou_end_date" name="mou_end_date" required>
                </div>
            </div>

            <div class="mt-4">
                <span class="float-md-right">
                    <a href="{{ url('master/agents') }}" class="btn btn-sm btn-danger" type="button"><i class="fas fa-arrow-left"></i> Batal</a>
                    @can('master_agent_create')
                    <button type="submit" id="btn_save" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-sm btn-brand-02" id="btn_save_wait" disabled
                    style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i> Menyimpan Data...</i>
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
  });

  $('#mou_start_date').on('change', function () {
      //add one year to date
      var date = new Date($(this).val());
      date.setFullYear(date.getFullYear() + 1);
      $('#mou_end_date').val(date.toISOString().substring(0, 10));
  }); 

  $("#frm-add").submit(function (e) {
    e.preventDefault();
    if($("#is_tax").prop("checked")){
        if($('#tax_number').val() == "" || $('#tax_number').val() === undefined){
            alert("NPWP harus di-isi jika agent PKP");
            return false;
        }else{
            $('#tax').val('Y');
        }
    }else{
        $('#tax').val('N');
    }
    
    var action = $(this).attr('action');
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
        success: function (data) {
            $("#frm-modal").modal("hide");
            window.location.href = "{{ url('master/agents') }}";
        },
        error: function (jqXHR, exception) {
            alertError(jqXHR.status, exception, jqXHR.responseText);
        }
    });
  });

});
</script>
@endsection