@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Master</a></li>
                <li class="breadcrumb-item"><a href="#">Tarif Trucking</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">Tarif {{ $trucking->trucktypes->type_name }}
              | {{ $trucking->origins->city_code }}-{{ $trucking->destinations->city_code }}
            </h4>
          </div>
        </div>
      </div><!-- container -->
    </div><!-- content -->

    <div class="content">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="row">
        <div class="col-lg-12">
        <form method="post" enctype="multipart/form-data" id="frm-pic">
            @csrf
            <input type="hidden" name="id" id="id" value="{{ $id }}"/>
            <div class="row">
                <label for="truck_type_id" class="col-sm-2 col-form-label">Tipe Truck *</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" id="truck_type_id" name="truck_type_id" autocomplete="off" value="{{ $trucking->trucktypes->type_name }}" readonly>
                </div>
            </div>
            <div class="row mt-2">
                <label for="loc" class="col-sm-2 col-form-label">Lokasi *</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="loc" name="loc" autocomplete="off" value="{{ $trucking->origins->city_name }} - {{ $trucking->destinations->city_name }}" readonly>
                </div>
            </div>
            <div class="row mt-2">
                <label for="price" class="col-sm-2 col-form-label">Harga Publish *</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" name="price" id="price" value="{{ $trucking->price }}">
                </div>
                <label for="cogs_price" class="col-sm-2 col-form-label">Sales Bottom *</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" name="cogs_price" id="cogs_price" value="{{ $trucking->cogs_price }}">
                </div>
            </div>
            <div class="mt-2">
                <span class="float-md-right">
                    <a href="{{ url('master/trucking-prices') }}" class="btn btn-sm btn-danger" type="button"><i class="fas fa-arrow-left"></i> Batal</a>
                    @can('master_trucking_price_update')
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
      
  </div><!-- container -->
</div><!-- content -->

@endsection
@section('scripts')
<script src="{{ asset('plugins/jquery.mask.min.js') }}"></script>
@parent
<script>
 
$(function(){
  'use strict'

  $('#price').mask("#.##0,00", {reverse: true});
  $('#cogs_price').mask("#.##0,00", {reverse: true});

  $("#btn_save").click(function (e) {
    e.preventDefault();
    var action = "{{ route('trucking-prices.update') }}";
    var form_data = new FormData();
    form_data.append('id', $('#id').val());
    form_data.append('price', decimalFormat($('#price').val()) );
    form_data.append('cogs_price', decimalFormat($('#cogs_price').val()) );
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
        window.location.href = "{{ url('master/trucking-prices') }}/"+"{{$id}}";
      },
      error: function (jqXHR, exception) {
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });
});
</script>
@endsection