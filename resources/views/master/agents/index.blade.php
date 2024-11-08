@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item active" aria-current="page">Agent</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">List Agent</h4>
          </div>
          @can('master_agent_create')
          <div class="mg-t-20 mg-sm-t-0">
            <a href="{{ url('master/agents/create') }}" class="btn btn-sm btn-brand-02" type="button" id="btn-add-new"><i class="fas fa-plus"></i> Tambah</a>
          </div>
          @endcan
        </div>
      </div><!-- container -->
    </div><!-- content -->

    <div class="content">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="row">
        <div class="col-lg-12">

        <div class="demo-table">
          <table id="table_data" class="table" style="width:100%">
            <thead>
                <tr>
                    <th class="wd-15p">Kode</th>
                    <th class="wd-25p">Nama</th>
                    <th class="wd-10p">Area</th>
					<th class="wd-10p">Kota</th>
                    <th class="wd-15p">MoU</th>
                    <th class="wd-20p">Masa Berlaku MoU</th>
                    <th class="wd-5p">Aksi</th>
                </tr>
            </thead>
        </table>
        </div><!-- df-example -->
      </div><!-- row -->
    </div><!-- container -->
  </div><!-- content -->

    @include('master.agents.delete-modal')

@endsection
@section('scripts')
@parent
<script>
  function deleteData(data) {
    $("#modal_delete").modal("show");
    $("#hdn_del_id").val(data);
  }

  function editData(data){
		window.location.href = '{{ url("master/agents") }}'+'/'+data;
  }

$(function(){
  'use strict'

  $('#table_data').DataTable({
    dom: 'Bfrtip',
    buttons: [
      {
        extend: 'copyHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file"></i> Copy Data',
        exportOptions: {
          columns: [ 0, 1, 2, 3, 5]
        }
      },
      {
        extend: 'excelHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file-excel"></i> Export Excel',
        exportOptions: {
          columns: [ 0, 1, 2, 3, 5],
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
      url: '{{ url("master/agents/datatable") }}',
      type: 'GET',
    },
    columns: [
      { data: 'agent_code', name: 'agent_code' },
      { data: 'agent_name', name: 'agent_name' },
      { data: 'areas.area_name', name: 'areas.area_name' },
	  { data: 'cities.city_name', name: 'cities.city_name' },
      {
        data: 'mou_base64',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data !== "") {
            var html_img = '<a href="'+ data +'" target="_blank">Download</a>';
            return html_img;
          } else {
            return '';
          }
        }
      },
      { data: 'mou_end_date', name: 'mou_end_date' },
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