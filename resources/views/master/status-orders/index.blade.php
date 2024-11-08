@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item active" aria-current="page">Status Order</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">List Status Order</h4>
          </div>
          <div class="mg-t-20 mg-sm-t-0">
            <button class="btn btn-sm btn-brand-02" type="button" id="btn-add-new"><i class="fas fa-plus"></i> Tambah</button>
          </div>
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
                    <th class="wd-25p">Nama Status</th>
                    <th class="wd-25p">Tgl Ubah</th>
                    <th class="wd-25p">Diubah Oleh</th>
                    <th class="wd-25p">Aksi</th>
                </tr>
            </thead>
        </table>
        </div><!-- df-example -->
      </div><!-- row -->
      </div><!-- container -->
    </div><!-- content -->

    @include('master.status-orders.create-modal')
    @include('master.status-orders.delete-modal')

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
		  url: '{{ url("master/status-orders") }}'+'/'+data,
      method:"GET",
		  success:function(data){
        loader.hide();
        $('#id').val(data.id);
        $('#status_name').val(data.status_name);
        $('#action').val('edit');
        $('#modal_title').text('Ubah Status Order');
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
  
  $('#btn-add-new').click(function(){
    $('#modal_title').text('Tambah Status Order');
    $('#id').val('');
    $('#status_name').val('');
    $('#action').val('add');
		$('#frm-modal').modal('show');
  });

  $('#table_data').DataTable({
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
      url: '{{ url("master/status-orders/datatable") }}',
      type: 'GET',
    },
    columns: [
      { data: 'status_name', name: 'status_name' },
      { data: 'updated_at', name: 'updated_at' },
      { data: 'users.name', name: 'users.name' },
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
      var action = "{{ route('status-orders.store') }}";
    }else{
      var action = "{{ route('status-orders.update') }}";
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
        $('#table_data').DataTable().ajax.reload();
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
        $('#table_data').DataTable().ajax.reload();
      },
      error: function (jqXHR, exception) {
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });
});
</script>
@endsection