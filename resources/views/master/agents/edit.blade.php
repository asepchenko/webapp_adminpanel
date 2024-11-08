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
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">{{ $agents->agent_name }}</h4>
          </div>
        </div>
      </div><!-- container -->
    </div><!-- content -->

    <div class="content">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="row">
        <div class="col-lg-12">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="data-tab" data-toggle="tab" href="#data" role="tab" aria-controls="data" aria-selected="true">Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="price-tab" data-toggle="tab" href="#price" role="tab" aria-controls="pic-data" aria-selected="false">Harga</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pic-tab" data-toggle="tab" href="#pic" role="tab" aria-controls="pic-data" aria-selected="false">PIC</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="city-tab" data-toggle="tab" href="#city" role="tab" aria-controls="pic-data" aria-selected="false">Kota Cakupan</a>
            </li>
        </ul>

        <div class="tab-content bd bd-gray-300 bd-t-0 pd-20" id="myTabContent">

            <div class="tab-pane fade show active" id="data" role="tabpanel" aria-labelledby="data-tab">
                
                <form method="post" action="{{ route('agents.update') }}" enctype="multipart/form-data" id="frm-add">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{ $agents->id }}">
                    <input type="hidden" id="tax" name="tax" value="{{ $agents->tax }}">
                    <div class="row">
                        <label for="agent_code" class="col-sm-2 col-form-label">Kode Agent</label>
                        <div class="col-sm-4">
                        <input type="text" id="agent_code" name="agent_code" class="form-control-plaintext form-control-sm" value="{{ $agents->agent_code }}" >
                        </div>
                    </div>
                    <div class="row mt-2">
                      <label for="agent_name" class="col-sm-2 col-form-label">Nama Agent *</label>
                      <div class="col-sm-4">
                        <input type="text" id="agent_name" name="agent_name" class="form-control form-control-sm" autocomplete="off" value="{{ $agents->agent_name }}" required >
                      </div>
                      <!--<label for="email" class="col-sm-2 col-form-label">E-mail *</label>
                      <div class="col-sm-4">
                          <input type="text" id="email" name="email" class="form-control form-control-sm" autocomplete="off" required >
                      </div>-->
                      <label for="phone_number" class="col-sm-2 col-form-label">No Telpon *</label>
                      <div class="col-sm-4">
                        <input type="text" id="phone_number" name="phone_number" class="form-control form-control-sm" autocomplete="off" value="{{ $agents->phone_number }}" required >
                      </div>
                  </div>
                  <div class="row mt-2">
                      <label for="city_id" class="col-sm-2 col-form-label">Kota *</label>
                      <div class="col-sm-4">
                          <select name="city_id" id="city_id" class="form-control form-control-sm select2bs4" style="width: 100%;" required>
                              <option value="">- Pilih -</option>
                              @foreach($cities as $city)
                              <option value="{{$city->id}}" {{ ( $city->id == $agents->city_id) ? 'selected' : '' }}>{{$city->city_name}}</option>
                              @endforeach
                          </select>
                      </div>
                      <label for="address" class="col-sm-2 col-form-label">Alamat *</label>
                      <div class="col-sm-4">
                          <textarea id="address" name="address" class="form-control form-control-sm" line="3" required>{{ $agents->address }}</textarea>
                      </div>
                  </div>
                  <div class="row mt-2">
                      <label for="area_id" class="col-sm-2 col-form-label">Area</label>
                      <div class="col-sm-4">
                          <select name="area_id" id="area_id" class="form-control form-control-sm select2bs4" style="width: 100%;">
                              <option value="">- Pilih -</option>
                              @foreach($areas as $area)
                              <option value="{{$area->id}}" {{ ( $area->id == $agents->area_id) ? 'selected' : '' }}>{{$area->area_name}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                  <div class="row mt-2">
                      <label for="tax_number" class="col-sm-2 col-form-label">NPWP *</label>
                      <div class="col-sm-4">
                          <input type="text" id="tax_number" name="tax_number" class="form-control form-control-sm" autocomplete="off" value="{{ $agents->tax_number }}">
                      </div>
                      <label for="is_tax" class="col-sm-2 col-form-label">PKP</label>
                      <div class="col-sm-4">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="form-control custom-control-input" id="is_tax" name="is_tax" {{ ( $agents->tax == "Y") ? 'checked' : '' }}>
                          <label class="custom-control-label" for="is_tax"></label>
                        </div>
                      </div>
                  </div>
                  <div class="row mt-2">
                    <label for="filename" class="col-sm-2 col-form-label">MoU File</label>
                      <div class="col-sm-4">
                          <input type="text" class="form-control form-control-sm" value="{{ $agents->mou_file }}" readonly>
                      </div>
                      <label for="mou_file" class="col-sm-2 col-form-label">Upload MoU</label>
                      <div class="col-sm-4">
                          <input type="file" id="mou_file" name="mou_file" accept=".doc,.docx,.pdf">
                      </div>
                  </div>
                  <div class="row mt-2">
                      <label for="mou_start_date" class="col-sm-2 col-form-label">Tgl Efektif MoU *</label>
                      <div class="col-sm-4">
                        <input type="date" class="form-control datetimepicker-input" autocomplete="off" id="mou_start_date" name="mou_start_date" value="{{ $agents->mou_start_date }}" required>
                      </div>
                      <label for="mou_end_date" class="col-sm-2 col-form-label">Tgl Berakhir MoU *</label>
                      <div class="col-sm-4">
                        <input type="date" class="form-control datetimepicker-input" autocomplete="off" id="mou_end_date" name="mou_end_date" value="{{ $agents->mou_end_date }}" required>
                      </div>
                  </div>
                    <div class="mt-4">
                        <span class="float-md-right">
                            <a href="{{ url('master/agents') }}" class="btn btn-sm btn-danger" type="button"><i class="fas fa-arrow-left"></i> Batal</a>
                            @can('master_agent_update')
                            <button type="submit" id="btn_save" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-save"></i> Simpan</button>
                            <button type="button" class="btn btn-sm btn-brand-02" id="btn_save_wait" disabled
                            style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i> Menyimpan Data...</i>
                            </button>
                            @endcan
                        </span>
                    </div>
                </div>
                </form>

                <div class="tab-pane fade" id="price" role="tabpanel" aria-labelledby="pricr-tab">
                @include('master.agents.price-tab')
                </div>

                <div class="tab-pane fade" id="pic" role="tabpanel" aria-labelledby="pic-tab">
                @include('master.agents.pic-tab')
                </div>

                <div class="tab-pane fade" id="city" role="tabpanel" aria-labelledby="city-tab">
                @include('master.agents.city-tab')
                </div>
            </div><!-- tab content-->

        
    </div><!-- col -->
    </div><!-- row -->
      
</div><!-- container -->
</div><!-- content -->

@include('master.agents.delete-price-modal')
@include('master.agents.delete-pic-modal')
@include('master.agents.delete-city-modal')

@endsection
@section('scripts')
<script src="{{ asset('plugins/jquery.mask.min.js') }}"></script>
@parent
<script>

function deleteDataCity(data) {
    $("#modal_city_delete").modal("show");
    $("#hdn_del_city_id").val(data);
  }

  function deleteDataPrice(data) {
    $("#modal_price_delete").modal("show");
    $("#hdn_del_price_id").val(data);
  }

  function editDataPrice(data){
    var loader = $('#loader');
    loader.show();
    $.ajax({
	    url: '{{ url("master/agent-master-prices") }}'+'/'+data,
        method:"GET",
		    success:function(data){
        loader.hide();
          $('#id_price').val(data.id);
          $('#price_code').val(data.price_code);
          $('#location_price_id').val(data.location_id);
          $('#location_price_id').trigger('change');
          $('#service_price_id').val(data.service_id);
          $('#price_value').val(data.price);
          $('#administrative_cost').val(data.administrative_cost);
          $('#insurance_fee').val(data.insurance_fee);
          $('#other_cost').val(data.other_cost);
          $('#margin').val(data.margin);
          $('#action-price').val('edit');
	      },
        error: function(data){
          loader.hide();
          console.log(data);
          alert(data);
        }
	  });
  }

  function deleteDataPic(data) {
    $("#modal_pic_delete").modal("show");
    $("#hdn_del_pic_id").val(data);
  }

  function editDataPic(data){
    var loader = $('#loader');
    loader.show();
    $.ajax({
	    url: '{{ url("master/agent-pics") }}'+'/'+data,
        method:"GET",
		    success:function(data){
        loader.hide();
          $('#id_pic').val(data.id);
          $('#pic_name').val(data.name);
          $('#pic_email').val(data.email);
          $('#pic_phone_number').val(data.phone_number);
          if(data.approved == "1"){
            $("#is_active_pic").prop("checked", true);
          }else{
            $("#is_active_pic").prop("checked", false);
          }
          $('#action-pic').val('edit');
	      },
        error: function(data){
          loader.hide();
          console.log(data);
          alert(data);
        }
	  });
  }

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
  
  $('#price_value').mask("#.##0,00", {reverse: true});

  $('#action-price').val('add');
  $('#action-pic').val('add');

  //price
  $('#table_price').DataTable({
    dom: 'Bfrtip',
    buttons: [
      {
        extend: 'copyHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file"></i> Copy Data',
        exportOptions: {
          columns: [ 0, 1, 2, 3]
        }
      },
      {
        extend: 'excelHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file-excel"></i> Export Excel',
        exportOptions: {
          format: {
              body: function(data, row, column, node) {
                  data = $('<p>' + data + '</p>').text();
                  data = $.isNumeric(data.replace(',', '.')) ? data.replace(',', '.') : data;
                  //data = data.replace('.', ',');
                  return data;
              }
          },
          columns: [ 0, 1, 2, 3],
          orthogonal: 'export'
        }
      },
    ],
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
      url: '{{ url("master/agent-master-prices/datatable/agent") }}/{{ $id }}',
      type: 'GET',
    },
    columns: [
      { data: 'price_code', name: 'price_code' },
      { data: null,
          render: function ( data, type, row ) {
          return row.locations.origins.city_code + '-' + row.locations.destinations.city_code;
          },
      },
      { data: 'services.service_name', name: 'services.service_name' },
      { data: 'price', name: 'price' },
      /*{ data: 'administrative_cost', name: 'administrative_cost' },
      { data: 'insurance_fee', name: 'insurance_fee' },
      { data: 'other_cost', name: 'other_cost' },
      { data: 'margin', name: 'margin' },
      { data: 'updated_at', name: 'updated_at' },
      { data: 'users.name', name: 'users.name' },*/
      {
        data: 'id',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data !== "") {
            var button = '<div class="dropdown d-inline">';
            button += '<button class="btn btn-sm btn-brand-02 btn-uppercase mg-l-5 dropdown-toggle" type="button" id="btnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih</button>';
            button += '<div class="dropdown-menu">';
            button += '<a class="dropdown-item has-icon" href="#" onClick="editDataPrice('+ data +');"><i class="fa fa-edit"></i> Ubah</a>';
            button += '<a class="dropdown-item has-icon" href="#" onClick="deleteDataPrice('+ data +');"><i class="fa fa-trash-alt"></i> Hapus</a>';
            button += '</div></div>';
            return button;
          } else {
            return '';
          }
        }
      },
    ]
  });

  $("#btn_save_price").click(function (e) {
    e.preventDefault();
    if($('#action-price').val() == "add"){
      var action = "{{ route('agent-master-prices.store') }}";
    }else{
      var action = "{{ route('agent-master-prices.update') }}";
    }
    //cleansing data
    /*var price_value = $('#price_value').val().replaceAll(",", "");
    var administrative_cost = $('#administrative_cost').val().replaceAll(",", "");
    var insurance_fee = $('#insurance_fee').val().replaceAll(",", "");
    var other_cost = $('#other_cost').val().replaceAll(",", "");
    var margin = $('#margin').val().replaceAll(",", "");
    $('#price_value').val(price_value);
    $('#administrative_cost').val(administrative_cost);
    $('#insurance_fee').val(insurance_fee);
    $('#other_cost').val(other_cost);
    $('#margin').val(margin);*/

    var form_data = new FormData();
    form_data.append('id_price', $('#id_price').val());
    form_data.append('location_id', $('#location_price_id').val());
    form_data.append('service_id', $('#service_price_id').val());
    /*form_data.append('price_code', $('#price_code').val());
    
    form_data.append('price', $('#price_value').val());
    form_data.append('administrative_cost', $('#administrative_cost').val());
    form_data.append('insurance_fee', $('#insurance_fee').val());
    form_data.append('other_cost', $('#other_cost').val());
    form_data.append('margin', $('#margin').val());*/
    form_data.append('price', decimalFormat($('#price_value').val()) );
    form_data.append('agent_id', '{{ $id }}');
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
        $('#btn_save_price').hide();
        $('#btn_save_price_wait').show();
        //showPreloader();
      },
      complete: function () {
        $('#btn_save_price').show();
        $('#btn_save_price_wait').hide();
        //hidePreloader();
      },
      success: function (data) {
        $('#table_price').DataTable().ajax.reload();
        $('#action-price').val('add');
        $('#id_price').val('');
        $('#price_code').val('');
        $('#location_price_id').val('');
        $('#location_price_id').trigger('change');
        $('#service_price_id').val('');
        $('#price_value').val('');
        $('#administrative_cost').val('');
        $('#insurance_fee').val('');
        $('#other_cost').val('');
        $('#margin').val('');
      },
      error: function (jqXHR, exception) {
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });

  $("#frm_price_del").submit(function (e) {
    e.preventDefault();
    var action = $(this).attr('action');
    var datas = new FormData($("#frm_price_del")[0]);
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
        $("#frm_del_price_submit").hide();
        $("#frm_del_price_submit_wait").show();
      },
      complete: function () {
        $("#frm_del_price_submit").show();
        $("#frm_del_price_submit_wait").hide();
      },
      success: function (data) {
        $("#modal_price_delete").modal("hide");
        $('#table_price').DataTable().ajax.reload();
      },
      error: function (jqXHR, exception) {
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });

//pic
$('#table_pic').DataTable({
  dom: 'Bfrtip',
    buttons: [
      {
        extend: 'copyHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file"></i> Copy Data',
        exportOptions: {
          columns: [ 0, 1, 2, 3]
        }
      },
      {
        extend: 'excelHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file-excel"></i> Export Excel',
        exportOptions: {
          columns: [ 0, 1, 2, 3],
          orthogonal: 'export'
        }
      },
    ],
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
      url: '{{ url("master/agent-pics/datatable/agent") }}/{{ $id }}',
      type: 'GET',
    },
    columns: [
      { data: 'name', name: 'name' },
      { data: 'email', name: 'email' },
      { data: 'phone_number', name: 'phone_number' },
      {
        data: 'approved',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data == "1") {
            return'<span class="badge badge-pill badge-primary"><b>Aktif</b></span>';
          } else {
            return'<span class="badge badge-pill badge-danger"><b>Nonaktif</b></span>';
          }
        }
      },
      {
        data: 'id',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data !== "") {
            var button = '<div class="dropdown d-inline">';
            button += '<button class="btn btn-sm btn-brand-02 btn-uppercase mg-l-5 dropdown-toggle" type="button" id="btnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih</button>';
            button += '<div class="dropdown-menu">';
            button += '<a class="dropdown-item has-icon" href="#" onClick="editDataPic('+ data +');"><i class="fa fa-edit"></i> Ubah</a>';
            button += '<a class="dropdown-item has-icon" href="#" onClick="deleteDataPic('+ data +');"><i class="fa fa-trash-alt"></i> Hapus</a>';
            button += '</div></div>';
            return button;
          } else {
            return '';
          }
        }
      },
    ]
  });

  $("#btn_save_pic").click(function (e) {
    e.preventDefault();
    if($('#action-pic').val() == "add"){
      var action = "{{ route('agent-pics.store') }}";
    }else{
      var action = "{{ route('agent-pics.update') }}";
    }
    
    if($("#is_active_pic").prop("checked")){
      var is_active = '1';
    }else{
      var is_active = '0';
    }

    var form_data = new FormData();
    form_data.append('id_pic', $('#id_pic').val());
    form_data.append('name', $('#pic_name').val());
    form_data.append('email', $('#pic_email').val());
    form_data.append('phone_number', $('#pic_phone_number').val());
    form_data.append('approved', is_active);
    form_data.append('agent_id', '{{ $id }}');
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
        $('#btn_save_pic').hide();
        $('#btn_save_pic_wait').show();
        //showPreloader();
      },
      complete: function () {
        $('#btn_save_pic').show();
        $('#btn_save_pic_wait').hide();
        //hidePreloader();
      },
      success: function (data) {
        $('#table_pic').DataTable().ajax.reload();
        $('#action-pic').val('add');
        $('#id_pic').val('');
        $('#pic_name').val('');
        $('#pic_email').val('');
        $('#pic_phone_number').val('');
        $("#is_active_pic").prop("checked", false);
      },
      error: function (jqXHR, exception) {
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });

  $("#frm_pic_del").submit(function (e) {
    e.preventDefault();
    var action = $(this).attr('action');
    var datas = new FormData($("#frm_pic_del")[0]);
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
        $("#frm_del_pic_submit").hide();
        $("#frm_del_pic_submit_wait").show();
      },
      complete: function () {
        $("#frm_del_pic_submit").show();
        $("#frm_del_pic_submit_wait").hide();
      },
      success: function (data) {
        $("#modal_pic_delete").modal("hide");
        $('#table_pic').DataTable().ajax.reload();
      },
      error: function (jqXHR, exception) {
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
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

    //check mou file
    if ($('#mou_file').get(0).files.length === 0) {
        $('#mou_file').prop("disabled",true);
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
            alert("Berhasil mengubah data");
            window.location.href = "{{ url('master/agents') }}/"+"{{ $id }}";
        },
        error: function (jqXHR, exception) {
            alertError(jqXHR.status, exception, jqXHR.responseText);
        }
    });
  });

  //city
  $('#table_city').DataTable({
  dom: 'Bfrtip',
    buttons: [
      {
        extend: 'copyHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file"></i> Copy Data',
        exportOptions: {
          columns: [ 0, 1]
        }
      },
      {
        extend: 'excelHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file-excel"></i> Export Excel',
        exportOptions: {
          columns: [ 0, 1],
          orthogonal: 'export'
        }
      },
    ],
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
      url: '{{ url("master/agent-cities/datatable/agent") }}/{{ $id }}',
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
            var button = '<div class="dropdown d-inline">';
            button += '<button class="btn btn-sm btn-brand-02 btn-uppercase mg-l-5 dropdown-toggle" type="button" id="btnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih</button>';
            button += '<div class="dropdown-menu">';
            //button += '<a class="dropdown-item has-icon" href="#" onClick="editDataPic('+ data +');"><i class="fa fa-edit"></i> Ubah</a>';
            button += '<a class="dropdown-item has-icon" href="#" onClick="deleteDataCity('+ data +');"><i class="fa fa-trash-alt"></i> Hapus</a>';
            button += '</div></div>';
            return button;
          } else {
            return '';
          }
        }
      },
    ]
  });

  $("#btn_save_city").click(function (e) {
    e.preventDefault();
    //if($('#action-pic').val() == "add"){
      var action = "{{ route('agent-cities.store') }}";
    //}else{
    //  var action = "{{ route('agent-pics.update') }}";
    //}

    var form_data = new FormData();
    form_data.append('city_id', $('#agent_city_id').val());
    form_data.append('agent_id', '{{ $id }}');
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
        $('#btn_save_city').hide();
        $('#btn_save_city_wait').show();
        //showPreloader();
      },
      complete: function () {
        $('#btn_save_city').show();
        $('#btn_save_city_wait').hide();
        //hidePreloader();
      },
      success: function (data) {
        $('#table_city').DataTable().ajax.reload();
        $('#agent_city_id').val('');
        $('#agent_city_id').trigger('change');
      },
      error: function (jqXHR, exception) {
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });

  $("#frm_city_del").submit(function (e) {
    e.preventDefault();
    var action = $(this).attr('action');
    var datas = new FormData($("#frm_city_del")[0]);
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
        $("#frm_del_city_submit").hide();
        $("#frm_del_city_submit_wait").show();
      },
      complete: function () {
        $("#frm_del_city_submit").show();
        $("#frm_del_city_submit_wait").hide();
      },
      success: function (data) {
        $("#modal_city_delete").modal("hide");
        $('#table_city').DataTable().ajax.reload();
      },
      error: function (jqXHR, exception) {
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });
});
</script>
@endsection