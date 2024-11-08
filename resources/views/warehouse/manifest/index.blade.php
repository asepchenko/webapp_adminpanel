@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Gudang</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manifest</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">List Manifest</h4>
          </div>
          <div class="mg-t-20 mg-sm-t-0">
            <a href="{{ url('warehouse/order') }}" class="btn btn-sm btn-brand-02"><i class="fas fa-plus"></i> Tambah Manifest</a>
          </div>
        </div>
      </div><!-- container -->
    </div><!-- content -->

    <div class="content">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="row">
        <div class="col-lg-12">
        <!--<a class="btn btn-sm btn-brand-02" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-filter"></i> Filter</a>

        <div class="collapse mg-t-5" id="collapseExample">
            <form>
                <div class="row mt-1">
                    <label for="name" class="col-sm-2 col-form-label">Tgl Awal</label>
                      <div class="col-sm-4">
                        <input type="text" id="name" name="name" class="form-control form-control-sm" autocomplete="off" >
                      </div>

                      <label for="name" class="col-sm-2 col-form-label">Tgl Akhir</label>
                      <div class="col-sm-4">
                        <input type="text" id="name" name="name" class="form-control form-control-sm" autocomplete="off" >
                      </div>
                </div>
                <div class="row mt-1">
                    <label for="location" class="col-sm-2 col-form-label">Customer</label>
                    <div class="col-sm-4">
                        <input type="text" id="location" name="location" class="form-control form-control-sm" autocomplete="off" >
                    </div>
                    <label for="location" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-4">
                        <input type="text" id="location" name="location" class="form-control form-control-sm" autocomplete="off" >
                    </div>
                </div>
            </form>
        </div>
        <hr>-->
        <div data-label="Example" class="df-example demo-table">
          <table id="table_data" class="table mg-b-0" width="100%">
            <thead>
                <tr>
                    <th class="wd-20p">No Manifest</th>
                    <th class="wd-10p">Tgl</th>
                    <th class="wd-15p">Total Colly</th>
                    <th class="wd-30p">STT</th>
                    <th class="wd-10p">Tujuan</th>
                    <th class="wd-10p">Status</th>
                    <th class="wd-5p">Aksi</th>
                </tr>
              </thead>
        </table>
        </div><!-- df-example -->
      </div><!-- row -->
     
      </div><!-- container -->
    </div><!-- content -->

    @include('warehouse.manifest.delete-modal')

@endsection
@section('scripts')
@parent
<script>
  function deleteData(data) {
    $("#modal_delete").modal("show");
    $("#hdn_del_id").val(data);
  }

  function editData(data){
    window.location.href = '{{ url("warehouse/manifest") }}'+'/'+data;
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
          columns: [ 0, 1, 2, 3, 4, 5 ]
        }
      },
      {
        extend: 'excelHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file-excel"></i> Export Excel',
        exportOptions: {
          columns: [ 0, 1, 2, 3, 4, 5 ],
          orthogonal: 'export'
        }
      },
    ],
    language: {
      searchPlaceholder: 'Search...',
      sSearch: '',
      lengthMenu: '_MENU_ items/page',
    },
    processing: true,
    serverSide: true,
    ajax: {
      url: '{{ url("warehouse/manifest/datatable") }}',
      type: 'GET',
    },
    columns: [
      { data: 'manifest_number', name: 'manifest_number' },
      { data: 'manifest_date', name: 'manifest_date' },
      { data: 'total_colly', name: 'total_colly' },
      {
        data: 'details',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data !== "") {
            var orders = "";
            data.forEach(function (item, index) {
              //orders += item.orders.awb_no + ',';
              orders += '<span class="badge badge-pill badge-primary"><b>'+item.orders.awb_no+'</b></span>&nbsp;';
            });
            return orders; //orders.slice(0, -1);
            //return '<a class="btn btn-sm btn-brand-02" href="#" onClick="detailData('+ data +');">Detail</a>';
          } else {
            return '';
          }
        }
      },
      { data: 'destinations.city_name', name: 'destinations.city_name' },
      { data: 'last_status', name: 'last_status' },
      {
        data: 'manifest_number',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data !== "") {
            var button = '<div class="dropdown d-inline">';
            button += '<button class="btn btn-sm btn-brand-02 btn-uppercase mg-l-5 dropdown-toggle" type="button" id="btnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">PILIH</button>';
            button += '<div class="dropdown-menu">';
            button += '<a class="dropdown-item has-icon" href="#" onClick="editData(\''+ data +'\');"><i class="fa fa-edit"></i> Detail</a>';
            button += '<a class="dropdown-item has-icon" href="#" onClick="deleteData(\''+ data +'\');"><i class="fa fa-trash-alt"></i> Hapus</a>';
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
        $("#modal_delete").modal("hide");
      },
      success: function (data) {
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