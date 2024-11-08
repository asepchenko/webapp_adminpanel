@extends('layouts.app')
@section('content')
<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
                <li class="breadcrumb-item"><a href="#">Order</a></li>
                <li class="breadcrumb-item"><a href="#">{{ $no }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Track</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">Tracking Order #{{ $no }} / STT {{ $order->awb_no }}</h4>
          </div>
          <div class="mg-t-20 mg-sm-t-0">
            <a href="{{ url('transaction/orders') }}" class="btn btn-sm btn-brand-02"><i class="fas fa-order"></i> Order List</a>
          </div>
        </div>
      </div><!-- container -->
    </div><!-- content -->

    <div class="content">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="row">
          <div class="col-lg-6">
            <div class="timeline-group tx-13">

              @foreach($track as $trk)
                @if($trk->status_name == "Delivered")
                  <div class="timeline-label">{{ \Carbon\Carbon::parse($trk->status_date)->format('d-M-Y') }}</div>
                  
                  <div class="timeline-item">
                    <div class="timeline-time">{{ \Carbon\Carbon::parse($trk->status_date)->format('H:i') }}</div>
                    <div class="timeline-body">
                      <p>{{ $trk->status_name }} [{{ $trk->cities->city_code }} - {{ $trk->cities->city_name }}]</p>
                      <p>Paket diterima oleh {{ $trk->recipient ?? '-' }}</p>
                      <p>Keterangan : {{ $trk->description ?? '-' }}</p>
                      <a href="#modal{{ $trk->id }}" data-toggle="modal" class="d-block wd-lg-50p"><img src="{{ $trk->filename_base64 }}" class="img-fluid" alt=""></a>
                    </div>
                  </div>

                  <div class="modal fade" id="modal{{ $trk->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel5" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                      <div class="modal-content tx-14">
                        <div class="modal-header">
                          <h6 class="modal-title" id="exampleModalLabel5">{{ $trk->status_name }} ({{ $trk->cities->city_code }} - {{ $trk->cities->city_name }})</h6>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <img class="modal-content" src="{{ $trk->filename_base64 }}"/>
                        </div>
                      </div>
                    </div>
                  </div>
                @elseif($trk->status_name != "Delivered" && $trk->status_name != "On Process Delivery")
                  <div class="timeline-label">{{ \Carbon\Carbon::parse($trk->status_date)->format('d-M-Y') }}</div>
                  
                  <div class="timeline-item">
                    <div class="timeline-time">{{ \Carbon\Carbon::parse($trk->status_date)->format('H:i') }}</div>
                    <div class="timeline-body">
                      <p>{{ $trk->status_name }} [{{ $trk->cities->city_code }} - {{ $trk->cities->city_name }}]</p>
                      <p>Penerima : {{ $trk->recipient ?? '-' }}</p>
                      <p>Keterangan : {{ $trk->description ?? '-' }}</p>
                      <a href="#modal{{ $trk->id }}" data-toggle="modal" class="d-block wd-lg-50p"><img src="{{ $trk->filename_base64 }}" class="img-fluid" alt=""></a>
                    </div>
                  </div>

                  <div class="modal fade" id="modal{{ $trk->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel5" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                      <div class="modal-content tx-14">
                        <div class="modal-header">
                          <h6 class="modal-title" id="exampleModalLabel5">{{ $trk->status_name }} ({{ $trk->cities->city_code }} - {{ $trk->cities->city_name }})</h6>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <img class="modal-content" src="{{ $trk->filename_base64 }}"/>
                        </div>
                      </div>
                    </div>
                  </div>
                @else
                <div class="timeline-label">{{ \Carbon\Carbon::parse($trk->status_date)->format('d-M-Y') }}</div>
                <div class="timeline-item">
                  <div class="timeline-time">{{ \Carbon\Carbon::parse($trk->status_date)->format('H:i') }}</div>
                  <div class="timeline-body">
                    <p>{{ $trk->status_name }} [{{ $trk->cities->city_code }} - {{ $trk->cities->city_name }}]</p>
                  </div><!-- timeline-body -->
                </div><!-- timeline-item -->
                @endif
              @endforeach
              
            </div><!-- timeline-group -->

          </div><!-- col -->

          @if($order->last_status != "Delivered")
          @can('order_tracking_update')
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
                                  <option value="{{$agent->id}}-{{$agent->agent_name}}">{{$agent->sequence}} - {{$agent->agent_name}}</option>
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
                          <label for="tracking_date" class="col-sm-4 col-form-label">Tanggal & jam</label>
                          <div class="col-sm-5">
                            <input type="date" id="tracking_date" name="tracking_date" class="form-control form-control-sm datetimepicker-input" autocomplete="off" >
                          </div>
                          <div class="col-sm-3">
                            <input type="text" id="tracking_time" name="tracking_time" class="form-control form-control-sm" autocomplete="off" >
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
                            <label>Foto disarankan landscape</label>
                            <img id="preview" src="{{ asset('img/placehold.jpg') }}" alt="your image" width="300px" height="200px" />
                          </div>
                        </div>
                      </form>
                      <div class="mt-4">
                          <span class="float-md-right">
                              <a href="{{ url('transaction/orders') }}" class="btn btn-sm btn-danger" type="button"><i class="fas fa-arrow-left"></i> kembali</a>
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
        @endcan
        @endif

        </div><!-- row -->
      </div><!-- container -->
    </div><!-- content -->

    
@endsection
@section('scripts')
<script src="{{ asset('js/resize-image.js') }}"></script>
@parent
<script>
  function readURL(input) {
    var loader = $('#loader');
    loader.show();
    var f = input.files[0];
        var img = new Image();
        img.src = URL.createObjectURL(f);
        img.onload = function(){
            var canvas = document.createElement('canvas');
            const [newWidth, newHeight] = calculateSize(img, 1280, 720);
            canvas.width = newWidth;
            canvas.height = newHeight;
            //canvas.width = img.width;
            //canvas.height = img.height;
            var ctx = canvas.getContext('2d');
            ctx.drawImage(img, 0, 0, newWidth, newHeight);
            canvas.toBlob(function(blob){
                    console.info(blob.size);
                    console.log(blob);
                    //blob to base64
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function() {
                        var base64data = reader.result;
                        loader.hide();
                        $('#preview').attr('src', base64data);
                    }
            }, 'image/jpeg', 0.5);
        }

    /*if (input.files && input.files[0]) {
        var reader = new FileReader();
        $('#preview').attr('src', e.target.result);
        reader.readAsDataURL(input.files[0]);
    }*/
  }

$(function(){
  'use strict'

  $("#filename").change(function(){
    readURL(this);
  });

  $('.select2bs4').select2({
      theme: 'bootstrap4'
  });

  $('#tracking_time').timepicker({
    showMeridian: false
  });

  var todayDate = getTodayDate();

  $('#tracking_date').attr("value", todayDate);

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

    var action = "{{ route('order-trackings.store') }}";
    var form_data = new FormData();

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
    form_data.append('tracking_date', $('#tracking_date').val());
    form_data.append('tracking_time', $('#tracking_time').val());
    form_data.append('transit_city_id', $('#transit_city_id').val());
    form_data.append('agent', $('#agent').val());
    form_data.append('recipient', $('#recipient').val());
    form_data.append('description', $('#description').val());
    form_data.append('order_number', '{{ $no }}');
    form_data.append('_token', '{{csrf_token()}}');

    for (var pair of form_data.entries()) {
        console.log(pair[0]+ ', ' + pair[1]); 
    }

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
        window.location.href = '{{ url("transaction/orders") }}'+'/{{ $no }}/track';
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