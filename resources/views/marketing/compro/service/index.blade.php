@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Marketing</a></li>
                <li class="breadcrumb-item"><a href="#">Company Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">Layanan</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">List Layanan</h4>
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
                    <th class="wd-20p">Nama</th>
                    <th class="wd-30p">Deskripsi</th>
                    <th class="wd-40p">Gambar</th>
                    <th class="wd-10p">Aktif</th>
                    <th class="wd-5p">Status</th>
                </tr>
            </thead>
        </table>
        </div><!-- df-example -->
      </div><!-- row -->
      </div><!-- container -->
    </div><!-- content -->

    @include('marketing.compro.service.create-modal')
    @include('marketing.compro.service.delete-modal')

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
	  url: '{{ url("marketing/compro-service") }}'+'/'+data,
    method:"GET",
    success:function(data){
      loader.hide();
        $('#id').val(data.id);
        $('#title').val(data.title);
        $('#description').val(data.description);
        $('#image').val('');
        $('#preview-image').attr('src', data.image_base64);
        if(data.is_active == "Y"){
          $("#is_active_service").prop("checked", true);
        }else{
          $("#is_active_service").prop("checked", false);
        }
        $('#action').val('edit');
        $('#modal_title').text('Ubah Layanan');
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

  $('#image').change(function(){
    var file = this.files[0];
    if(file.type != "image/png" && file.type != "image/jpeg" && file.type != "image/gif")
    {
        alert("Please choose png, jpeg or gif files");
        return false;
    }
    var reader = new FileReader();
    reader.onload = function(e) {
        $('#preview-image').attr('src', e.target.result);
    }
    reader.readAsDataURL(file);
  });

  $("#description").keypress(function(){
    if(this.value.length > 128){
        return false;
    }
    $("#remaining").html("Sisa karakter : " + (128 - this.value.length));
  });

  $('#btn-add-new').click(function(){
    $('#modal_title').text('Tambah Layanan');
    $('#id').val('');
    $('#title').val('');
    $('#description').val('');
    $('#image').val('');
    $('#preview-image').attr('src', '{{ asset("img/placehold.jpg") }}');
    $("#is_active_service").prop("checked", false);
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
          columns: [ 0, 1, 3]
        }
      },
      {
        extend: 'excelHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file-excel"></i> Export Excel',
        exportOptions: {
          columns: [ 0, 1, 3],
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
      url: '{{ url("marketing/compro-service/datatable") }}',
      type: 'GET',
    },
    columns: [
      { data: 'title', name: 'title' },
      { data: 'description', name: 'description' },
      {
        data: 'image_base64',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data !== "") {
            var html_img = '<img src="'+ data +'" width="150px" height="100px"></img>';
            return html_img;
          } else {
            return '';
          }
        }
      },
      {
        data: 'is_active',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data != "Y") {
            return '<span class="badge badge-pill badge-danger"><b>Nonaktif</b></span>';
          } else {
            return '<span class="badge badge-pill badge-primary"><b>Aktif</b></span>';
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
      var action = "{{ route('compro-service.store') }}";
    }else{
      var action = "{{ route('compro-service.update') }}";
    }
    
    if($("#is_active_service").prop("checked")){
      $("#is_active").val("Y");
    }else{
      $("#is_active").val("T");
    }

    var datas = new FormData($("#frm-add")[0]);
    /*for (var pair of datas.entries()) {
        console.log(pair[0]+ ', ' + pair[1]); 
    }
    console.log($('#is_active').val());*/
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
        console.log(data);
        $("#frm-modal").modal("hide");
        $('#table_data').DataTable().ajax.reload();
      },
      error: function (jqXHR, exception) {
        console.log(jqXHR);
        console.log(exception);
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