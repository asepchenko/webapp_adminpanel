@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item active" aria-current="page">Driver</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">List Driver</h4>
          </div>
          @can('master_driver_create')
          <div class="mg-t-20 mg-sm-t-0">
            <button class="btn btn-sm btn-brand-02" type="button" id="btn-add-new"><i class="fas fa-plus"></i> Tambah</button>
          </div>
          @endcan
        </div>
      </div><!-- container -->
    </div><!-- content -->

    <div class="content">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="row">
        <div class="col-lg-12">

        <div data-label="Example" class="df-example demo-table">
          <table id="table_data" class="table">
            <thead>
                <tr>
                    <th class="wd-20p">Nama</th>
                    <th class="wd-15p">No SIM</th>
                    <th class="wd-10p">Jenis SIM</th>
                    <th class="wd-20p">Masa Berlaku SIM</th>
                    <th class="wd-15p">No Rekening</th>
                    <th class="wd-15p">Bank</th>
                    <th class="wd-5p">Aksi</th>
                </tr>
            </thead>
        </table>
      </div><!-- df-example -->
    </div><!-- row -->
  </div><!-- container -->
</div><!-- content -->

@include('master.drivers.create-modal')
@include('master.drivers.delete-modal')

@endsection
@section('scripts')
@parent
<script>
  function deleteData(data) {
    $("#modal_delete").modal("show");
    $("#hdn_del_id").val(data);
  }

  function editData(data){
    var loader = $('#loader');
    loader.show();
    $.ajax({
		  url: '{{ url("master/drivers") }}'+'/'+data,
      method:"GET",
		  success:function(data){
        loader.hide();
        $('#id').val(data.id);
        $('#driver_name').val(data.driver_name);
        $('#driver_license').val(data.driver_license);
        $('#driver_license_type').val(data.driver_license_type);
        $('#driver_license_exp_date').val(data.driver_license_exp_date);
        $('#bank_id').val(data.bank_id);
        $('#bank_id').trigger('change');
        $('#account_number').val(data.account_number);
        $('#action').val('edit');
        $('#modal_title').text('Ubah Driver');
        $('#frm-modal').modal('show');
		  },
      error: function(data){
        loader.hide();
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

  $('#bank_id').select2({
      dropdownParent: $('#frm-add')
  });

  $('#btn-add-new').click(function(){
    $('#modal_title').text('Tambah Driver');
    $('#id').val('');
    $('#driver_name').val('');
    $('#driver_license').val('');
    $('#driver_license_type').val('');
    $('#driver_license_exp_date').val('');
    $('#account_number').val('');
    $('#bank_id').val('');
    $('#bank_id').trigger('change');
    $('#action').val('add');
		$('#frm-modal').modal('show');
  });

  $('#table_data').DataTable({
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
    //serverSide: true,
    ajax: {
      url: '{{ url("master/drivers/datatable") }}',
      type: 'GET',
    },
    columns: [
      { data: 'driver_name', name: 'driver_name' },
      { data: 'driver_license', name: 'driver_license' },
      { data: 'driver_license_type', name: 'driver_license_type' },
      { data: 'driver_license_exp_date', name: 'driver_license_exp_date' },
      { data: 'account_number', name: 'account_number' },
      { data: 'banks.bank_name', name: 'banks.bank_name' },
      {
        data: 'id',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data !== "") {
            var button = '<div class="dropdown d-inline">';
            button += '<button class="btn btn-sm btn-brand-02 btn-uppercase mg-l-5 dropdown-toggle" type="button" id="btnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih</button>';
            button += '<div class="dropdown-menu">';
            button += '<a class="dropdown-item has-icon" href="#" onClick="editData('+ data +');"><i class="fa fa-edit"></i> Ubah</a>';
            button += '<a class="dropdown-item has-icon" href="#" onClick="deleteData('+ data +');"><i class="fa fa-trash-alt"></i> Hapus</a>';
            button += '</div></div>';
            return button;
          } else {
            return '';
          }
        }
      },
    ]
  });

  // Select2
  $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
       
  $("#frm-add").submit(function (e) {
    e.preventDefault();
    if($('#action').val() == "add"){
      var action = "{{ route('drivers.store') }}";
    }else{
      var action = "{{ route('drivers.update') }}";
    }
    
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
        //$('#table_data').DataTable().ajax.reload();
        window.location.href = "{{ url('master/drivers') }}";
      },
      error: function (jqXHR, exception) {
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });

  $("#frm_del").submit(function (e) {
    e.preventDefault();
    var action = $(this).attr('action');
    var datas = new FormData($("#frm_del")[0]);
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
        $("#frm_del_submit").hide();
        $("#frm_del_submit_wait").show();
      },
      complete: function () {
        $("#frm_del_submit").show();
        $("#frm_del_submit_wait").hide();
      },
      success: function (data) {
        $("#modal_delete").modal("hide");
        //$('#table_data').DataTable().ajax.reload();
        window.location.href = "{{ url('master/drivers') }}";
      },
      error: function (jqXHR, exception) {
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });
});
</script>
@endsection