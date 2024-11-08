@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Master</a></li>
                <li class="breadcrumb-item"><a href="#">Customer</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
              </ol>
            </nav>
            <h4 class="mg-b-0"> {{ $customer->customer_name }}</h4>
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
                <a class="nav-link" id="brand-tab" data-toggle="tab" href="#brand" role="tab" aria-controls="brand-data" aria-selected="false">Brand</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="branch-tab" data-toggle="tab" href="#branch" role="tab" aria-controls="branch-data" aria-selected="false">Cabang</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="mou-tab" data-toggle="tab" href="#mou" role="tab" aria-controls="mou-data" aria-selected="false">MoU</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pic-tab" data-toggle="tab" href="#pic" role="tab" aria-controls="pic-data" aria-selected="false">PIC</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="price-tab" data-toggle="tab" href="#price" role="tab" aria-controls="price-data" aria-selected="false">Harga</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="trucking-price-tab" data-toggle="tab" href="#trucking-price" role="tab" aria-controls="trucking-price-data" aria-selected="false">Harga Trucking</a>
            </li>
        </ul>

        <div class="tab-content bd bd-gray-300 bd-t-0 pd-20" id="myTabContent">

            <div class="tab-pane fade show active" id="data" role="tabpanel" aria-labelledby="data-tab">
                
                <form method="post" action="{{ route('customers.update') }}" enctype="multipart/form-data" id="frm-add">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{ $id}}">
                    <input type="hidden" id="tax" name="tax" value="{{ $customer->tax }}">
                    <div class="row">
                        <label for="customer_code" class="col-sm-2 col-form-label">Kode Customer</label>
                        <div class="col-sm-4">
                            <input type="text" id="customer_code" name="customer_code" class="form-control-plaintext form-control-sm" value="{{ $customer->customer_code }}" >
                        </div>
                        <label for="customer_name" class="col-sm-2 col-form-label">Nama Customer *</label>
                        <div class="col-sm-4">
                            <input type="text" id="customer_name" name="customer_name" class="form-control form-control-sm" autocomplete="off" value="{{ $customer->customer_name }}" >
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="email" class="col-sm-2 col-form-label">E-mail *</label>
                        <div class="col-sm-4">
                            <input type="text" id="email" name="email" class="form-control form-control-sm" autocomplete="off" value="{{ $customer->email }}" required >
                        </div>
                        <label for="phone_number" class="col-sm-2 col-form-label">No Telpon *</label>
                        <div class="col-sm-4">
                            <input type="text" id="phone_number" name="phone_number" class="form-control form-control-sm" autocomplete="off" value="{{ $customer->phone_number }}" required >
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="tax_number" class="col-sm-2 col-form-label">NPWP *</label>
                        <div class="col-sm-4">
                            <input type="text" id="tax_number" name="tax_number" class="form-control form-control-sm" autocomplete="off" value="{{ $customer->tax_number }}">
                        </div>
                        <label for="asal" class="col-sm-2 col-form-label">PKP ? *</label>
                        <div class="col-sm-2">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-control custom-control-input" id="is_tax" name="is_tax" {{ ( $customer->tax == "Y") ? 'checked' : '' }}>
                            <label class="custom-control-label" for="is_tax"></label>
                          </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="address" class="col-sm-2 col-form-label">Alamat *</label>
                        <div class="col-sm-4">
                            <textarea id="address" name="address" class="form-control form-control-sm" line="3" required>{{ $customer->address }}</textarea>
                        </div>
                        <label for="city_id" class="col-sm-2 col-form-label">Kota *</label>
                        <div class="col-sm-4">
                            <select name="city_id" id="city_id" class="form-control form-control-sm select2bs4" style="width: 100%;" required>
                                <option value="">- Pilih -</option>
                                @foreach($cities as $city)
                                <option value="{{$city->id}}" {{ ( $city->id == $customer->city_id) ? 'selected' : '' }}>{{$city->city_code}} - {{$city->city_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="float-md-right">
                            <a href="{{ url('master/customers') }}" class="btn btn-sm btn-danger" type="button"><i class="fas fa-arrow-left"></i> Kembali</a>
                            @can('master_customer_update')
                            <button type="submit" id="btn_save" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-save"></i> Simpan</button>
                            <button type="button" class="btn btn-sm btn-brand-02" id="btn_save_wait" disabled
                            style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Menyimpan Data...</i>
                            </button>
                            @endcan
                        </span>
                    </div>
                </div>

                <div class="tab-pane fade" id="brand" role="tabpanel" aria-labelledby="brand-tab">
                @include('master.customers.brand-tab')
                </div>

                <div class="tab-pane fade" id="branch" role="tabpanel" aria-labelledby="branch-tab">
                @include('master.customers.branch-tab')
                </div>

                <div class="tab-pane fade" id="mou" role="tabpanel" aria-labelledby="mou-tab">
                @include('master.customers.mou-tab')
                </div>

                <div class="tab-pane fade" id="pic" role="tabpanel" aria-labelledby="pic-tab">
                @include('master.customers.pic-tab')
                </div>

                <div class="tab-pane fade" id="price" role="tabpanel" aria-labelledby="price-tab">
                @include('master.customers.price-tab')
                </div>

                <div class="tab-pane fade" id="trucking-price" role="tabpanel" aria-labelledby="trucking-price-tab">
                @include('master.customers.trucking-price-tab')
                </div>
            </div><!-- tab content-->

            
        </form>
      </div><!-- col -->
    </div><!-- row -->
      
  </div><!-- container -->
</div><!-- content -->

    @include('master.customers.delete-brand-modal')
    @include('master.customers.delete-branch-modal')
    @include('master.customers.delete-pic-modal')
    @include('master.customers.delete-price-modal')
    @include('master.customers.delete-trucking-price-modal')
    @include('master.customers.delete-mou-modal')

@endsection
@section('scripts')
<script src="{{ asset('plugins/jquery.mask.min.js') }}"></script>
@parent
<script>

 function deleteDataMou(data) {
    $("#modal_mou_delete").modal("show");
    $("#hdn_del_mou_id").val(data);
  }

  function editDataMou(data){
    var loader = $('#loader');
    loader.show();
    $.ajax({
	    url: '{{ url("master/customer-mous") }}'+'/'+data,
        method:"GET",
		    success:function(data){
        loader.hide();
          $('#id_mou').val(data.id);
          $('#filename').val(data.mou_file);
          $('#mou_start_date').val(data.mou_start_date);
          $('#mou_end_date').val(data.mou_end_date);
          $('#action-mou').val('edit');
	      },
        error: function(data){
          loader.hide();
          console.log(data);
          alert(data);
        }
	  });
  }

 function deleteDataBrand(data) {
    $("#modal_brand_delete").modal("show");
    $("#hdn_del_brand_id").val(data);
  }

  function editDataBrand(data){
    var loader = $('#loader');
    loader.show();
    $.ajax({
	    url: '{{ url("master/customer-brands") }}'+'/'+data,
        method:"GET",
		    success:function(data){
        loader.hide();
          $('#id_brand').val(data.id);
          $('#brand_code').val(data.brand_code);
          $('#brand_name').val(data.brand_name);
          $('#action-brand').val('edit');
	      },
        error: function(data){
          loader.hide();
          console.log(data);
          alert(data);
        }
	  });
  }

  function deleteDataBranch(data) {
    $("#modal_branch_delete").modal("show");
    $("#hdn_del_branch_id").val(data);
  }

  function editDataBranch(data){
    var loader = $('#loader');
    loader.show();
    $.ajax({
	    url: '{{ url("master/customer-branchs") }}'+'/'+data,
        method:"GET",
		    success:function(data){
        loader.hide();
          $('#id_branch').val(data.id);
          $('#branch_code').val(data.branch_code);
          $('#branch_name').val(data.branch_name);
          $('#customer_brand_id').val(data.customer_brand_id);
          $('#customer_brand_id').trigger('change');
          $('#city_branch_id').val(data.city_id);
          $('#city_branch_id').trigger('change');
          $('#description_branch').val(data.description);
          $('#address_branch').val(data.address);
          if(data.is_active == "Y"){
            $("#is_active_branch").prop("checked", true);
          }else{
            $("#is_active_branch").prop("checked", false);
          }
          $('#action-branch').val('edit');
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
	    url: '{{ url("master/customer-pics") }}'+'/'+data,
        method:"GET",
		    success:function(data){
        loader.hide();
          $('#id_pic').val(data.id);
          $('#pic_name').val(data.name);
          $('#pic_email').val(data.email);
          $('#pic_phone').val(data.phone_number);
          $('#address_pic').val(data.address);
          $('#pic_birthdate').val(data.birthday);
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

  function deleteDataPrice(data) {
    $("#modal_price_delete").modal("show");
    $("#hdn_del_price_id").val(data);
  }

  function editDataPrice(data){
    var loader = $('#loader');
    loader.show();
    $.ajax({
	    url: '{{ url("master/customer-master-prices") }}'+'/'+data,
        method:"GET",
		    success:function(data){
        loader.hide();
          $('#id_price').val(data.id);
          $('#price_code').val(data.price_code);
          $('#cogs_price').val(data.cogs_price);
          $('#code_cogs').val(data.location_id);
          $('#code_cogs').trigger('change');
          $('#location_price_id').val(data.location_id);
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

  function deleteDataTruckingPrice(data) {
    $("#modal_trucking_price_delete").modal("show");
    $("#hdn_del_trucking_price_id").val(data);
  }

  function editDataTruckingPrice(data){
    var loader = $('#loader');
    loader.show();
    $.ajax({
	    url: '{{ url("master/customer-trucking-prices") }}'+'/'+data,
        method:"GET",
		    success:function(data){
        console.log(data);
        loader.hide();
          $('#action-trucking-price').val('edit');
          $('#id_trucking_price').val(data.id);
          $('#trucking_cogs_price').val(data.cogs_price);
          $('#trucking_origin').val(data.origin);
          $('#trucking_origin').trigger('change');
          $('#trucking_destination').val(data.destination);
          $('#trucking_destination').trigger('change');
          $('#truck_type').val(data.truck_type_id);
          $('#truck_type').trigger('change');
          $('#trucking_price_value').val(data.price);
          $('#trucking_origin').prop('disabled', true);
          $('#trucking_destination').prop('disabled', true);
          $('#truck_type').prop('disabled', true);
	      },
        error: function(data){
          loader.hide();
          console.log(data);
          alert(data);
        }
	  });
  }

  function generateBrandSelect(){
        urlnya = "{{ url('master/customer-brands/customer') }}/{{ $id }}";
        $.ajax({
            url: urlnya,
            dataType: 'json',
            success: function( data ) {
              //spinner.hide();
              $('#customer_brand_id').empty();
              $('#customer_brand_id').append('<option value=""> - Pilih - </option>'); 
              for (let i = 0; i < data.length; i++) {
                console.log(data[i]['brand_code']);
                $('#customer_brand_id').append('<option value="' + data[i]['id'] +'">' + data[i]['brand_code'] + ' - ' + data[i]['brand_name'] +'</option>');
              }
              
            }
        });
  }

$(function(){
  'use strict'
  //Initialize Select2 Elements
  $('.select2bs4').select2({
      theme: 'bootstrap4'
  });
  
  generateBrandSelect();

  $('#action-brand').val('add');
  $('#action-branch').val('add');
  $('#action-pic').val('add');
  $('#action-price').val('add');
  $('#action-mou').val('add');
  $('#action-trucking-price').val('add');
  $("#is_active_branch").prop("checked", false);

  $('#is_generate_mou').change(function () {
    if($("#is_generate_mou").prop("checked")){
      $('#mou_file').prop("disabled",true);
      $('#mou_file').val('');
    }else{
      $('#mou_file').prop("disabled",false);
    }
  });

  /*$('#mou_file').change(function () {
    if($('#mou_file').get(0).files.length === 0){
      $("#is_generate_mou").prop("checked", true)
    }else{
      $('#is_generate_mou').prop("checked",false);
    }
  });*/

  //brand
  $('#table_brand').DataTable({
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
      url: '{{ url("master/customer-brands/datatable/customer") }}/{{ $id }}',
      type: 'GET',
    },
    columns: [
      { data: 'brand_code', name: 'brand_code' },
      { data: 'brand_name', name: 'brand_name' },
      {
        data: 'id',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data !== "") {
            var button = '<div class="dropdown d-inline">';
            button += '<button class="btn btn-sm btn-brand-02 btn-uppercase mg-l-5 dropdown-toggle" type="button" id="btnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih</button>';
            button += '<div class="dropdown-menu">';
            button += '<a class="dropdown-item has-icon" href="#" onClick="editDataBrand('+ data +');"><i class="fa fa-edit"></i> Ubah</a>';
            button += '<a class="dropdown-item has-icon" href="#" onClick="deleteDataBrand('+ data +');"><i class="fa fa-trash-alt"></i> Hapus</a>';
            button += '</div></div>';
            return button;
          } else {
            return '';
          }
        }
      },
    ]
  });

  $("#btn_save_brand").click(function (e) {
    e.preventDefault();
    if($('#action-brand').val() == "add"){
      var action = "{{ route('customer-brands.store') }}";
    }else{
      var action = "{{ route('customer-brands.update') }}";
    }
    
    var form_data = new FormData();
    form_data.append('id_brand', $('#id_brand').val());
    form_data.append('brand_code', $('#brand_code').val());
    form_data.append('brand_name', $('#brand_name').val());
    form_data.append('customer_id', '{{ $id }}');
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
        $('#btn_save_brand').hide();
        $('#btn_save_brand_wait').show();
        //showPreloader();
      },
      complete: function () {
        $('#btn_save_brand').show();
        $('#btn_save_brand_wait').hide();
        //hidePreloader();
      },
      success: function (data) {
        $('#table_brand').DataTable().ajax.reload();
        $('#action-brand').val('add');
        $('#id_brand').val('');
        $('#brand_code').val('');
        $('#brand_name').val('');
      },
      error: function (jqXHR, exception) {
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });

  $("#frm_brand_del").submit(function (e) {
    e.preventDefault();
    var action = $(this).attr('action');
    var datas = new FormData($("#frm_brand_del")[0]);
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
        $("#frm_del_brand_submit").hide();
        $("#frm_del_brand_submit_wait").show();
      },
      complete: function () {
        $("#frm_del_brand_submit").show();
        $("#frm_del_brand_submit_wait").hide();
      },
      success: function (data) {
        $("#modal_brand_delete").modal("hide");
        $('#table_brand').DataTable().ajax.reload();
      },
      error: function (jqXHR, exception) {
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });
  
  //branch
  $('#table_branch').DataTable({
    dom: 'Bfrtip',
    buttons: [
      {
        extend: 'copyHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file"></i> Copy Data',
        exportOptions: {
          columns: [ 0, 1, 2, 3, 4, 5, 6]
        }
      },
      {
        extend: 'excelHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file-excel"></i> Export Excel',
        exportOptions: {
          columns: [ 0, 1, 2, 3, 4, 5, 6],
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
      url: '{{ url("master/customer-branchs/datatable/customer") }}/{{ $id }}',
      type: 'GET',
    },
    columns: [
      { data: 'brands.brand_name', name: 'brands.brand_name' },
      { data: 'branch_code', name: 'branch_code' },
      { data: 'branch_name', name: 'branch_name' },
      { data: 'cities.city_name', name: 'cities.city_name' },
      { data: 'address', name: 'address' },
      { data: 'description', name: 'description' },
      {
        data: 'is_active',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data == "Y") {
            return'<span class="badge badge-pill badge-primary"><b>Ya</b></span>';
          } else {
            return'<span class="badge badge-pill badge-danger"><b>Tidak</b></span>';
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
            button += '<a class="dropdown-item has-icon" href="#" onClick="editDataBranch('+ data +');"><i class="fa fa-edit"></i> Ubah</a>';
            button += '<a class="dropdown-item has-icon" href="#" onClick="deleteDataBranch('+ data +');"><i class="fa fa-trash-alt"></i> Hapus</a>';
            button += '</div></div>';
            return button;
          } else {
            return '';
          }
        }
      },
    ]
  });

  $("#btn_save_branch").click(function (e) {
    e.preventDefault();
    if($('#action-branch').val() == "add"){
      var action = "{{ route('customer-branchs.store') }}";
    }else{
      var action = "{{ route('customer-branchs.update') }}";
    }
    
    if($("#is_active_branch").prop("checked")){
      var is_active = 'Y';
    }else{
      var is_active = 'N';
    }

    var form_data = new FormData();
    form_data.append('id_branch', $('#id_branch').val());
    form_data.append('branch_code', $('#branch_code').val());
    form_data.append('branch_name', $('#branch_name').val());
    form_data.append('city_id', $('#city_branch_id').val());
    form_data.append('address', $('#address_branch').val());
    form_data.append('description', $('#description_branch').val());
    form_data.append('is_active', is_active);
    form_data.append('customer_id', '{{ $id }}');
    form_data.append('customer_brand_id', $('#customer_brand_id').val());
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
        $('#btn_save_branch').hide();
        $('#btn_save_branch_wait').show();
        //showPreloader();
      },
      complete: function () {
        $('#btn_save_branch').show();
        $('#btn_save_branch_wait').hide();
        //hidePreloader();
      },
      success: function (data) {
        $('#table_branch').DataTable().ajax.reload();
        $('#action-branch').val('add');
        $('#id_branch').val('');
        $('#branch_code').val('');
        $('#branch_name').val('');
        $('#city_branch_id').val('');
        $('#city_branch_id').trigger('change');
        $('#address_branch').val('');
        $('#description_branch').val('');
        $('#customer_brand_id').val('');
        $('#customer_brand_id').trigger('change');
        $("#is_active_branch").prop("checked", false);
      },
      error: function (jqXHR, exception) {
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });

  $("#frm_branch_del").submit(function (e) {
    e.preventDefault();
    var action = $(this).attr('action');
    var datas = new FormData($("#frm_branch_del")[0]);
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
        $("#frm_del_branch_submit").hide();
        $("#frm_del_branch_submit_wait").show();
      },
      complete: function () {
        $("#frm_del_branch_submit").show();
        $("#frm_del_branch_submit_wait").hide();
      },
      success: function (data) {
        $("#modal_branch_delete").modal("hide");
        $('#table_branch').DataTable().ajax.reload();
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
          columns: [ 0, 1, 2, 3, 4, 5]
        }
      },
      {
        extend: 'excelHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file-excel"></i> Export Excel',
        exportOptions: {
          columns: [ 0, 1, 2, 3, 4, 5],
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
      url: '{{ url("master/customer-pics/datatable/customer") }}/{{ $id }}',
      type: 'GET',
    },
    columns: [
      { data: 'name', name: 'name' },
      { data: 'email', name: 'email' },
      { data: 'phone_number', name: 'phone_number' },
      { data: 'birthday', name: 'birthday' },
      { data: 'address', name: 'address' },
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
            //button += '<a class="dropdown-item has-icon" href="#" onClick="deleteDataPic('+ data +');"><i class="fa fa-trash-alt"></i> Hapus</a>';
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
      var action = "{{ route('customer-pics.store') }}";
    }else{
      var action = "{{ route('customer-pics.update') }}";
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
    form_data.append('phone_number', $('#pic_phone').val());
    form_data.append('birthday', $('#pic_birthdate').val());
    form_data.append('address', $('#address_pic').val());
    form_data.append('approved', is_active);
    form_data.append('customer_id', '{{ $id }}');
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
        $('#pic_phone').val('');
        $('#pic_birthdate').val('');
        $('#address_pic').val('');
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

  //price
  $('#table_price').DataTable({
    dom: 'Bfrtip',
    buttons: [
      {
        extend: 'copyHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file"></i> Copy Data',
        exportOptions: {
          columns: [ 0, 1, 2, 3, 4, 5]
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
          columns: [ 0, 1, 2, 3, 4, 5],
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
      url: '{{ url("master/customer-master-prices/datatable/customer") }}/{{ $id }}',
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
      { data: 'cogs_price', name: 'cogs_price' },
      /*{ data: 'administrative_cost', name: 'administrative_cost' },
      { data: 'insurance_fee', name: 'insurance_fee' },
      { data: 'other_cost', name: 'other_cost' },
      { data: 'margin', name: 'margin' },*/
      {
        data: 'status',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data != "APPROVED") {
            return '<span class="badge badge-pill badge-danger"><b>Not Approved</b></span>';
          } else {
            return '<span class="badge badge-pill badge-primary"><b>Approved</b></span>';
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

  $('#price_value').mask("#.##0,00", {reverse: true});

  $('#code_cogs').on('change', function () {
    var loader = $('#loader');
    loader.show();
    $.ajax({
	    url: '{{ url("master/locations/data") }}'+'/'+$(this).val(),
        method:"GET",
		    success:function(data){
        loader.hide();
        console.log(data);
          $('#price_code').val(data.price_code);
          $('#location_price_id').val(data.id);
          $('#service_price_id').val(data.service_id);
          $('#cogs_price').val(data.sales_bottom);
          /*$('#administrative_cost').val(data.administrative_cost);
          $('#insurance_fee').val(data.insurance_fee);
          $('#other_cost').val(data.other_cost);*/
	      },
        error: function(){
          loader.hide();
          //alert('Tidak ada data hpp');
        }
	  });
  });

  $("#btn_save_price").click(function (e) {
    e.preventDefault();
    if($('#action-price').val() == "add"){
      var action = "{{ route('customer-master-prices.store') }}";
    }else{
      var action = "{{ route('customer-master-prices.update') }}";
    }
    //cleansing data
    var cogs_price = decimalFormat($('#cogs_price').val());
    var price_value = decimalFormat($('#price_value').val());
    /*var administrative_cost = $('#administrative_cost').val().replaceAll(",", "");
    var insurance_fee = $('#insurance_fee').val().replaceAll(",", "");
    var other_cost = $('#other_cost').val().replaceAll(",", "");
    var margin = $('#margin').val().replaceAll(",", "");*/
    $('#cogs_price').val(cogs_price);
    $('#price_value').val(price_value);
    /*$('#administrative_cost').val(administrative_cost);
    $('#insurance_fee').val(insurance_fee);
    $('#other_cost').val(other_cost);
    $('#margin').val(margin);*/

    var form_data = new FormData();
    form_data.append('id_price', $('#id_price').val());
    form_data.append('cogs_price', $('#cogs_price').val());
    form_data.append('price_code', $('#price_code').val());
    form_data.append('location_id', $('#location_price_id').val());
    form_data.append('service_id', $('#service_price_id').val());
    form_data.append('price', $('#price_value').val());
    /*form_data.append('administrative_cost', $('#administrative_cost').val());
    form_data.append('insurance_fee', $('#insurance_fee').val());
    form_data.append('other_cost', $('#other_cost').val());
    form_data.append('margin', $('#margin').val());*/
    form_data.append('customer_id', '{{ $id }}');
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
        $('#code_cogs').val('');
        $('#code_cogs').trigger('change');
        $('#cogs_price').val('');
        $('#price_code').val('');
        $('#location_price_id').val('');
        $('#service_price_id').val('');
        $('#price_value').val('');
        /*$('#administrative_cost').val('');
        $('#insurance_fee').val('');
        $('#other_cost').val('');
        $('#margin').val('');*/
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

  //trucking price
  $('#table_trucking_price').DataTable({
    dom: 'Bfrtip',
    buttons: [
      {
        extend: 'copyHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file"></i> Copy Data',
        exportOptions: {
          columns: [ 0, 1, 2, 3, 4, 5, 6]
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
          columns: [ 0, 1, 2, 3, 4, 5, 6],
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
      url: '{{ url("master/customer-trucking-prices/datatable/customer") }}/{{ $id }}',
      type: 'GET',
    },
    columns: [
      { data: 'price_code', name: 'price_code' },
      { data: 'origins.city_name', name: 'origins.city_name' },
      { data: 'destinations.city_name', name: 'destinations.city_name' },
      { data: 'trucktypes.type_name', name: 'trucktypes.type_name' },
      { data: 'price', name: 'price' },
      { data: 'cogs_price', name: 'cogs_price' },
      {
        data: 'status',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data != "APPROVED") {
            return '<span class="badge badge-pill badge-danger"><b>Not Approved</b></span>';
          } else {
            return '<span class="badge badge-pill badge-primary"><b>Approved</b></span>';
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
            button += '<a class="dropdown-item has-icon" href="#" onClick="editDataTruckingPrice('+ data +');"><i class="fa fa-edit"></i> Ubah</a>';
            button += '<a class="dropdown-item has-icon" href="#" onClick="deleteDataTruckingPrice('+ data +');"><i class="fa fa-trash-alt"></i> Hapus</a>';
            button += '</div></div>';
            return button;
          } else {
            return '';
          }
        }
      },
    ]
  });

  $('#trucking_price_value').mask("#.##0,00", {reverse: true});

  $('#truck_type').on('change', function () {
    var truck_ori = $('#trucking_origin').val();
    var truck_dest = $('#trucking_destination').val();
    var truck = $('#truck_type').val();

    if($('#action-trucking-price').val() != "edit"){
      if(truck_ori == "" || truck_ori == undefined){
        //alert("Kota asal belum dipilih");
      }else if(truck_dest == "" || truck_dest == undefined){
        //alert("Kota tujuan belum dipilih");
      }else if(truck == "" || truck == undefined){
        //alert("Truck belum dipilih");
      }else{
          var loader = $('#loader');
          loader.show();
          $.ajax({
            url: '{{ url("master/trucking-prices/origin") }}'+'/'+truck_ori+'/destination/'+truck_dest+'/type/'+truck,
              method:"GET",
              success:function(data){
              loader.hide();
              console.log(data);
                if(data){
                  $('#trucking_price_code').val(data.origins.city_code+'-'+data.destinations.city_code);
                  $('#trucking_price_value').val(data.price);
                  $('#trucking_cogs_price').val(data.cogs_price);
                }else{
                  alert('Tidak ada data master trucking');
                }
              },
              error: function(){
                loader.hide();
                $('#trucking_price_code').val('');
                $('#trucking_price_value').val('');
                $('#trucking_cogs_price').val('');
                alert('Tidak ada data master trucking');
              }
          });
        }
    }
  });

  $("#btn_save_trucking_price").click(function (e) {
    e.preventDefault();
    if($('#action-trucking-price').val() == "add"){
      var action = "{{ route('customer-trucking-prices.store') }}";
    }else{
      var action = "{{ route('customer-trucking-prices.update') }}";
    }

    if($('#trucking_cogs_price').val() == "" || $('#trucking_cogs_price').val() == undefined){
      alert("data master harga trucking tidak ada");
    }else{
      //cleansing data
      var cogs_price = decimalFormat($('#trucking_cogs_price').val());
      var price_value = decimalFormat($('#trucking_price_value').val());
      $('#trucking_cogs_price').val(cogs_price);
      $('#trucking_price_value').val(price_value);

      var form_data = new FormData();
      form_data.append('id', $('#id_trucking_price').val());
      form_data.append('price_code', $('#trucking_price_code').val());
      form_data.append('origin', $('#trucking_origin').val());
      form_data.append('destination', $('#trucking_destination').val());
      form_data.append('truck_type_id', $('#truck_type').val());
      form_data.append('price', $('#trucking_price_value').val());
      form_data.append('cogs_price', $('#trucking_cogs_price').val());
      form_data.append('customer_id', '{{ $id }}');
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
          $('#btn_save_trucking_price').hide();
          $('#btn_save_trucking_price_wait').show();
          //showPreloader();
        },
        complete: function () {
          $('#btn_save_trucking_price').show();
          $('#btn_save_trucking_price_wait').hide();
          //hidePreloader();
        },
        success: function (data) {
          $('#table_trucking_price').DataTable().ajax.reload();
          $('#action-trucking-price').val('add');
          $('#id_trucking_price').val('');
          $('#trucking_price_code').val('');
          $('#trucking_origin').val('');
          $('#trucking_origin').trigger('change');
          $('#trucking_destination').val('');
          $('#trucking_destination').trigger('change');
          $('#trucking_price_value').val('');
          $('#trucking_cogs_price').val('');
          $('#truck_type').val('');
          $('#truck_type').trigger('change');
          $('#trucking_origin').prop('disabled', false);
          $('#trucking_destination').prop('disabled', false);
          $('#truck_type').prop('disabled', false);
        },
        error: function (jqXHR, exception) {
          alertError(jqXHR.status, exception, jqXHR.responseText);
        }
      });
    }
  });

  $("#frm_trucking_price_del").submit(function (e) {
    e.preventDefault();
    var action = $(this).attr('action');
    var datas = new FormData($("#frm_trucking_price_del")[0]);
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
        $("#frm_del_trucking_price_submit").hide();
        $("#frm_del_trucking_price_submit_wait").show();
      },
      complete: function () {
        $("#frm_del_trucking_price_submit").show();
        $("#frm_del_trucking_price_submit_wait").hide();
      },
      success: function (data) {
        $("#modal_trucking_price_delete").modal("hide");
        $('#table_trucking_price').DataTable().ajax.reload();
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
            alert("NPWP harus di-isi jika customer PKP");
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
            window.location.href = "{{ url('master/customers') }}/"+"{{ $id }}";
        },
        error: function (jqXHR, exception) {
            $('#mou_file').prop("disabled",false);
            alertError(jqXHR.status, exception, jqXHR.responseText);
        }
    });
  });

  //mou
  $('#table_mou').DataTable({
    dom: 'Bfrtip',
    buttons: [
      {
        extend: 'copyHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file"></i> Copy Data',
        exportOptions: {
          columns: [ 0, 2, 3, 4]
        }
      },
      {
        extend: 'excelHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file-excel"></i> Export Excel',
        exportOptions: {
          columns: [ 0, 2, 3, 4],
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
      url: '{{ url("master/customer-mous/datatable/customer") }}/{{ $id }}',
      type: 'GET',
    },
    columns: [
      { data: 'mou_file', name: 'mou_file' },
      {
        data: 'mou_base64',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data !== "") {
            var html_img = '<a download="MoU" href="'+ data +'">Download</a>';
            return html_img;
          } else {
            return '';
          }
        }
      },
      { data: 'mou_number', name: 'mou_number' },
      { data: 'mou_start_date', name: 'mou_start_date' },
      { data: 'mou_end_date', name: 'mou_end_date' },
      {
        data: 'id',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data !== "") {
            var button = '<div class="dropdown d-inline">';
            button += '<button class="btn btn-sm btn-brand-02 btn-uppercase mg-l-5 dropdown-toggle" type="button" id="btnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih</button>';
            button += '<div class="dropdown-menu">';
            //button += '<a class="dropdown-item has-icon" href="#" onClick="editDataMou('+ data +');"><i class="fa fa-edit"></i> Ubah</a>';
            button += '<a class="dropdown-item has-icon" href="#" onClick="deleteDataMou('+ data +');"><i class="fa fa-trash-alt"></i> Hapus</a>';
            button += '</div></div>';
            return button;
          } else {
            return '';
          }
        }
      },
    ]
  });

  $('#mou_start_date').on('change', function () {
      //add one year to date
      var date = new Date($(this).val());
      date.setFullYear(date.getFullYear() + 1);
      $('#mou_end_date').val(date.toISOString().substring(0, 10));
  }); 
  
  $("#btn_save_mou").click(function (e) {
    e.preventDefault();
    if($('#action-mou').val() == "add"){
      var action = "{{ route('customer-mous.store') }}";
    }else{
      var action = "{{ route('customer-mous.update') }}";
    }
    //alert(action);
    var form_data = new FormData();
    form_data.append('id_mou', $('#id_mou').val());
    
    
    if($("#is_generate_mou").prop("checked")){
      form_data.append('is_generate_mou', 'Y');
    }else{
      form_data.append('is_generate_mou', 'N');
      if ($('#mou_file').get(0).files.length > 0) {
        var file_data = $('#mou_file').prop('files')[0];  
        form_data.append('mou_file', file_data);
      }
    }

    form_data.append('mou_start_date', $('#mou_start_date').val());
    form_data.append('mou_end_date', $('#mou_end_date').val());
    form_data.append('customer_id', '{{ $id }}');
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
      contentType: false,
      processData: false,
      beforeSend: function () {
        $('#btn_save_mou').hide();
        $('#btn_save_mou_wait').show();
        //showPreloader();
      },
      complete: function () {
        $('#btn_save_mou').show();
        $('#btn_save_mou_wait').hide();
        //hidePreloader();
      },
      success: function (data) {
        console.log(data);
        $('#table_mou').DataTable().ajax.reload();
        $('#action-mou').val('add');
        $('#id_mou').val('');
        $("#is_generate_mou").prop("checked", false);
        $('#filename').val('');
        $('#mou_file').val('');
        $('#mou_file').prop("disabled",false);
        $('#mou_start_date').val('');
        $('#mou_end_date').val('');
      },
      error: function (jqXHR, exception) {
        console.log(exception);
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });

  $("#frm_mou_del").submit(function (e) {
    e.preventDefault();
    var action = $(this).attr('action');
    var datas = new FormData($("#frm_mou_del")[0]);
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
        $("#frm_del_mou_submit").hide();
        $("#frm_del_mou_submit_wait").show();
      },
      complete: function () {
        $("#frm_del_mou_submit").show();
        $("#frm_del_mou_submit_wait").hide();
      },
      success: function (data) {
        $("#modal_mou_delete").modal("hide");
        $('#table_mou').DataTable().ajax.reload();
      },
      error: function (jqXHR, exception) {
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });
});
</script>
@endsection