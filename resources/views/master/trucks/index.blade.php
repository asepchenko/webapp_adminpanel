@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item active" aria-current="page">Armada</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">List Armada</h4>
          </div>
          @can('master_truck_create')
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
                    <th class="wd-15p">Jenis Armada</th>
                    <th class="wd-10p">No Polisi</th>
                    <th class="wd-10p">Tahun Produksi</th>
                    <th class="wd-20p">Masa Berlaku STNK</th>
                    <th class="wd-20p">Masa Berlaku Pajak</th>
                    <th class="wd-20p">Masa Berlaku KIR</th>
                    <th class="wd-5p">Aksi</th>
                </tr>
            </thead>
        </table>
        </div><!-- df-example -->
      </div><!-- row -->
      
      </div><!-- container -->
    </div><!-- content -->

    @include('master.trucks.create-modal')
    @include('master.trucks.delete-modal')

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
		  url: '{{ url("master/trucks") }}'+'/'+data,
      method:"GET",
		  success:function(data){
        loader.hide();
        $('#id').val(data.id);
        $('#truck_type_id').val(data.truck_type_id);
        $('#police_number').val(data.police_number);
        $('#production_year').val(data.production_year);
        $('#reg_exp_date').val(data.reg_exp_date);
        $('#reg_tax_exp_date').val(data.reg_tax_exp_date);
        $('#examination_exp_date').val(data.examination_exp_date);
        $('#action').val('edit');
        $('#modal_title').text('Ubah Armada');
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
    $('#modal_title').text('Tambah Armada');
    $('#id').val('');
    $('#truck_type_id').val('');
    $('#police_number').val('');
    $('#production_year').val('');
    $('#reg_exp_date').val('');
    $('#reg_tax_exp_date').val('');
    $('#examination_exp_date').val('');
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
          columns: [ 0, 1, 2, 3, 4, 5],
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
      url: '{{ url("master/trucks/datatable") }}',
      type: 'GET',
    },
    columns: [
      { data: 'trucktypes.type_name', name: 'trucktypes.type_name' },
      { data: 'police_number', name: 'police_number' },
      { data: 'production_year', name: 'production_year' },
      { data: 'reg_exp_date', name: 'reg_exp_date' },
      { data: 'reg_tax_exp_date', name: 'reg_tax_exp_date' },
      { data: 'examination_exp_date', name: 'examination_exp_date' },
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
      var action = "{{ route('trucks.store') }}";
    }else{
      var action = "{{ route('trucks.update') }}";
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
        window.location.href = "{{ url('master/trucks') }}";
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
        window.location.href = "{{ url('master/trucks') }}";
      },
      error: function (jqXHR, exception) {
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });
});
</script>
@endsection