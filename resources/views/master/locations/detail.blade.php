@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Master</a></li>
                <li class="breadcrumb-item"><a href="#">Lokasi (Tarif Reguler)</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
              </ol>
            </nav>
            <h4 class="mg-b-0"> {{ $location->price_code }}</h4>
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
                <label for="price_code" class="col-sm-2 col-form-label">Kode *</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" id="price_code" name="price_code" autocomplete="off" value="{{ $location->price_code }}" readonly>
                </div>
                <label for="service" class="col-sm-2 col-form-label">Via *</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" id="service" name="service" autocomplete="off" value="{{ $location->services->service_name }}" readonly>
                </div>
            </div>
            <div class="row mt-2">
                <label for="loc" class="col-sm-2 col-form-label">Lokasi *</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="loc" name="loc" autocomplete="off" value="{{ $location->origins->city_name }} - {{ $location->destinations->city_name }}" readonly>
                </div>
            </div>
            <div class="row mt-2">
                <label for="publish_price" class="col-sm-2 col-form-label">Harga Publish *</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" name="publish_price" id="publish_price" value="{{ $location->publish_price }}">
                </div>
                <label for="sales_bottom" class="col-sm-2 col-form-label">Sales Bottom *</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" name="sales_bottom" id="sales_bottom" value="{{ $location->sales_bottom }}">
                </div>
            </div>
            <div class="row mt-2">
                <label for="distance" class="col-sm-2 col-form-label">Jarak (km)</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" name="distance" id="distance" value="{{ $location->distance }}">
                </div>
                <label for="min_days" class="col-sm-2 col-form-label">Min Days</label>
                <div class="col-sm-1">
                    <input type="number" min="0" max="30" class="form-control form-control-sm" name="min_days" id="min_days" value="{{ $location->min_days }}">
                </div>
                <label for="max_days" class="col-sm-2 col-form-label">Max Days</label>
                <div class="col-sm-1">
                    <input type="number" min="0" max="30" class="form-control form-control-sm" name="max_days" id="max_days" value="{{ $location->max_days }}">
                </div>
            </div>
            <div class="mt-2">
                <span class="float-md-right">
                    <a href="{{ url('master/locations') }}" class="btn btn-sm btn-danger" type="button"><i class="fas fa-arrow-left"></i> Batal</a>
                    @can('master_regular_price_update')
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

  $('#publish_price').mask("#.##0,00", {reverse: true});
  $('#sales_bottom').mask("#.##0,00", {reverse: true});

  $("#btn_save").click(function (e) {
    e.preventDefault();
    var action = "{{ route('locations.update') }}";
    var form_data = new FormData();
    form_data.append('id', $('#id').val());
    form_data.append('publish_price', decimalFormat($('#publish_price').val()) );
    form_data.append('sales_bottom', decimalFormat($('#sales_bottom').val()) );
    form_data.append('distance', $('#distance').val());
    form_data.append('min_days', $('#min_days').val());
    form_data.append('max_days', $('#max_days').val());
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
        window.location.href = "{{ url('master/locations') }}/"+"{{$id}}";
      },
      error: function (jqXHR, exception) {
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });
});
</script>
@endsection