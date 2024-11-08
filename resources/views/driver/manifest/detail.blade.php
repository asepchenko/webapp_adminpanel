@extends('layouts.app')
@section('content')
<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Driver</a></li>
                <li class="breadcrumb-item"><a href="#">Manifest</a></li>
                <li class="breadcrumb-item"><a href="#">{{ $no }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tracking</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">Update Tracking #{{ $no }}</h4>
          </div>
          <div class="mg-t-20 mg-sm-t-0">
            <a href="{{ url('driver/manifest') }}" class="btn btn-sm btn-brand-02"><i class="fas fa-order"></i> Manifest List</a>
          </div>
        </div>
      </div><!-- container -->
    </div><!-- content -->

    <div class="content">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <p> <b>No Manifest</b> : {{ $manifest->manifest_number }}</p>
                    <p> <b>Tgl</b> : {{ $manifest->manifest_date }}</p>
                    <p> <b>Tujuan</b> : {{ $manifest->destinations->city_name }}</p>
                    <p> <b>Status Terakhir</b> : {{ $manifest->last_tracking }}</p>
                </div>
            </div>
          </div><!-- col -->

          @if($manifest->last_tracking != "Delivered")
          <div class="col-lg-6">
              <div class="card">
                  <div class="card-body">
                    <form method="post" action="#" enctype="multipart/form-data" id="frm-add">
                      @csrf
                        <div class="row">
                          <label for="status" class="col-sm-4 col-form-label">Status *</label>
                          <div class="col-sm-8">
                              <select name="status" id="status" class="form-control form-control-sm" style="width: 100%;" required>
                                  <option value="">- Pilih -</option>
                                    <option value="Transit">TRANSIT</option>
                                    <option value="Delivered">DELIVERED</option>
                              </select>
                          </div>
                        </div>
                        @if($agents)
                        <div class="row mt-2">
                        <label for="agent" class="col-sm-4 col-form-label">Agent *</label>
                          <div class="col-sm-8">
                              <select name="agent" id="agent" class="form-control form-control-sm select2bs4" style="width: 100%;" required>
                                  <option value="">- Pilih -</option>
                                  @foreach($agents as $agent)
                                  <option value="{{$agent->id}}-{{$agent->agent_name}}">{{$agent->agent_name}} - {{$agent->city_name}}</option>
                                  @endforeach
                              </select>
                          </div>
                        </div>
                        @else
                          <input type="hidden" name="agent" id="agent" value="-"/>
                        @endif
                        <div class="row mt-2">
                        <label for="transit_city_id" class="col-sm-4 col-form-label">Kota Transit</label>
                          <div class="col-sm-8">
                              <select name="transit_city_id" id="transit_city_id" class="form-control form-control-sm select2bs4" style="width: 100%;" required>
                                  <option value="">- Pilih -</option>
                                  @foreach($cities as $city)
                                  <option value="{{$city->id}}">{{$city->city_name}}</option>
                                  @endforeach
                              </select>
                          </div>
                        </div>
                        <div class="row mt-2">
                          <label for="recipient" class="col-sm-4 col-form-label">Diterima oleh</label>
                          <div class="col-sm-8">
                            <input type="text" id="recipient" name="recipient" class="form-control form-control-sm" autocomplete="off" required>
                          </div>
                        </div>
                        <div class="row mt-2">
                          <label for="description" class="col-sm-4 col-form-label">Keterangan</label>
                          <div class="col-sm-8">
                            <textarea lines="3" id="description" name="description" class="form-control form-control-sm" autocomplete="off" ></textarea>
                          </div>
                        </div>
                        <div class="row mt-2">
                          <label for="filename" class="col-sm-4 col-form-label">Foto *</label>
                          <div class="col-sm-8">
                            <button type="button" class="btn btn-sm btn-brand-02 btn-block" onclick="document.getElementById('filename').click()">Ambil Foto</button>
                            <input type="file" id="filename" name="filename" accept="image/*" capture="user" style="display:none">
                            <hr>
                            <img id="preview" src="{{ asset('img/placehold.jpg') }}" alt="your image" width="300px" height="200px" />
                          </div>
                        </div>
                      </form>
                      <div class="mt-4">
                          <span class="float-md-right">
                              <a href="{{ url('driver/manifest') }}" class="btn btn-sm btn-danger" type="button"><i class="fas fa-arrow-left"></i> kembali</a>
                              <button type="submit" id="btn_save" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-save"></i> Simpan</button>
                              <button type="button" class="btn btn-sm btn-brand-02" id="btn_save_wait" disabled
                              style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Menyimpan Data...</i>
                              </button>
                          </span>
                      </div>
                  </div>
              </div>
          </div>
        </div><!-- col -->
        @endif

        </div><!-- row -->
      </div><!-- container -->
    </div><!-- content -->

@endsection
@section('scripts')
@parent
<script>
  function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
  }

  function b64toBlob(dataURI) {
    
    var byteString = atob(dataURI.split(',')[1]);
    var ab = new ArrayBuffer(byteString.length);
    var ia = new Uint8Array(ab);
    
    for (var i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
    }
    return new Blob([ab], { type: 'image/jpeg' });
  }

$(function(){
  'use strict'

  $("#filename").change(function(){
    readURL(this);
  });

  $('.select2bs4').select2({
      theme: 'bootstrap4'
  });

  /*$('#status').on('change', function () {
    if($(this).val() == "Delivered"){
      $('#recipient').attr('required', true);
      $('#filename').attr('required', true);

      $('#recipient').prop('disabled', false);
      $('#filename').prop('disabled', false);
    }else{
      $('#recipient').attr('required', false);
      $('#filename').attr('required', false);

      $('#recipient').prop('disabled', true);
      $('#filename').prop('disabled', true);
    }
  });*/

  $("#btn_save").click(function (e) {
    e.preventDefault();
    var action = "{{ route('driver-manifest.update') }}";
    var form_data = new FormData();

    //check upload file
    var file_data = $('#filename').prop('files')[0];  
    if ($('#filename').get(0).files.length > 0) {
        //form_data.append('filename', file_data);
        var base64image = $('#preview').attr('src');
        form_data.append('filename', base64image);
    }else{
      form_data.append('filename', '');
    }

    
    //var form_data = new FormData();
    form_data.append('status', $('#status').val());
    form_data.append('agent', $('#agent').val());
    form_data.append('transit_city_id', $('#transit_city_id').val());
    form_data.append('recipient', $('#recipient').val());
    form_data.append('description', $('#description').val());
    form_data.append('manifest_number', '{{ $no }}');
    form_data.append('_token', '{{csrf_token()}}');
    $.ajax({
      type: "POST",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: action,
      data: form_data,
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
        console.log(data);
        window.location.href = '{{ url("driver/manifest") }}';
      },
      error: function (jqXHR, exception) {
        console.log(exception);
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });
});
</script>
@endsection