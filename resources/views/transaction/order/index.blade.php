@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Order</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">List Semua Order</h4>
          </div>
          @can('order_create')
          <div class="mg-t-20 mg-sm-t-0">
            <!--<button class="btn btn-sm btn-brand-02" type="button" id="btn-add-new"><i class="fas fa-file-excel"></i> Excel</button>-->
            <a href="{{ url('transaction/orders/create') }}" class="btn btn-sm btn-brand-02"><i class="fas fa-plus"></i> Tambah</a>
          </div>
          @endcan
        </div>
      </div><!-- container -->
    </div><!-- content -->

    <div class="content">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="row">
        <div class="col-lg-12">
        <a class="btn btn-sm btn-brand-02" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-filter"></i> Filter</a>

        <div class="collapse mg-t-5" id="collapseExample">
            <form>
                <div class="row mt-1">
                    <label for="start_date" class="col-sm-2 col-form-label">Tgl Awal</label>
                      <div class="col-sm-4">
                        <input type="date" id="start_date" name="start_date" class="form-control form-control-sm datetimepicker-input" autocomplete="off" >
                      </div>

                      <label for="end_date" class="col-sm-2 col-form-label">Tgl Akhir</label>
                      <div class="col-sm-4">
                        <input type="date" id="end_date" name="end_date" class="form-control form-control-sm datetimepicker-input" autocomplete="off" >
                      </div>
                </div>
                <div class="row mt-1">
                    <label for="csutomer" class="col-sm-2 col-form-label">Customer</label>
                    <div class="col-sm-4">
                      <select name="customer" id="customer" class="form-control form-control-sm select2bs4" style="width: 100%;">
                          <option value="">- Semua -</option>
                          @foreach($customers as $customer)
                          <option value="{{$customer->customer_name}}">{{$customer->customer_name}}</option>
                          @endforeach
                      </select>
                    </div>
                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-4">
                      <select class="form-control form-control-sm" name="status" id="status">
                        <option value=""> - Semua -</option>
                        <option value="Open">Open</option>
                        <option value="Closing">Closing</option>
                        <option value="Cancel">Cancel</option>
                        <option value="Manifested">Manifested</option>
                        <option value="On Process Delivery">On Process Delivery</option>
                        <option value="Transit">Transit</option>
                        <option value="Delivered">Delivered</option>
                      </select>
                    </div>
                </div>
            </form>
        </div>
        <hr>
        <div data-label="Example" class="df-example demo-table">
          <table id="table_data" class="table mg-b-0" width="100%">
            <thead>
                <tr>
                    <th class="wd-7p">No STT</th>
                    <th class="wd-10p">Tgl Pickup</th>
                    <th class="wd-11p">Nama Customer</th>
                    <th class="wd-7p">Cabang</th>
                    <th class="wd-10p">Asal - Tujuan</th>
                    <th class="wd-7p">Service</th>
                    <th class="wd-5p">Status</th>
                    <th class="wd-10p">Tgl Terima</th>
                    <th class="wd-8p">Penerima</th>
                    <th class="wd-5p">Aksi</th>
                </tr>
            </thead>
        </table>
        </div><!-- df-example -->
      </div><!-- row -->
     
      </div><!-- container -->
    </div><!-- content -->

    @include('transaction.order.delete-modal')

@endsection
@section('scripts')
@parent
<script>
  function deleteData(data) {
    $("#modal_delete").modal("show");
    $("#hdn_del_id").val(data);
  }

  function editData(data){
    window.location.href = '{{ url("transaction/orders") }}'+'/'+data;
  }

  function trackingData(data){
    window.location.href = '{{ url("transaction/orders") }}'+'/'+data+'/track';
  }

$(function(){
  'use strict'
  //var minDateFilter = "";
  //var maxDateFilter = "";

  //Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  });

  var firstDate = getFirstDateOfMonth();
  var lastDate = getLastDateOfMonth();

  $('#start_date').attr("value", firstDate);
  $('#end_date').attr("value", lastDate);
  //alert(firstDate);

  $('#customer').on('change',function(){ 
    var selectedValue = $(this).val(); 
    dataTable.column( 2 ) .search( selectedValue ) .draw(); 
  });

  $('#status').on('change',function(){ 
    var selectedValue = $(this).val(); 
    dataTable.column( 6 ) .search( selectedValue ) .draw(); 
  });

  $('#start_date').on('change',function(){ 
    //alert(this.value);
    //minDateFilter = new Date(this.value).getTime();
    //dataTable.draw();
    $('#table_data').DataTable().draw(true);
  });

  $('#end_date').on('change',function(){ 
    //alert(this.value);
    //maxDateFilter = new Date(this.value).getTime();
    //dataTable.draw();
    $('#table_data').DataTable().draw(true);
  });

  var dataTable = $('#table_data').DataTable({
    dom: 'Blfrtip',
    lengthMenu: [ 
      [10,50,100,1000, -1], ["10 Data", "50 Data", "100 Data", "1000 Data", "Semua Data"]
    ],
    buttons: [
      {
        extend: 'copyHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file"></i> Copy Data',
        exportOptions: {
          columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
        }
      },
      {
        extend: 'excelHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file-excel"></i> Export Excel',
        exportOptions: {
          columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ],
          orthogonal: 'export'
        }
      },
    ],
    language: {
      searchPlaceholder: 'Cari Data...',
      sSearch: '',
      lengthMenu: '_MENU_',
      zeroRecords: 'Tidak Ada Data :(',
      info: 'Menampilkan Halaman _PAGE_ dari _PAGES_',
      infoEmpty: '',
      infoFiltered: '(Terfilter dari _MAX_ total data)'
    },
    processing: true,
    serverSide: true,
    ajax: {
      url: '{{ url("transaction/orders/datatable") }}',
      type: 'GET',
      data: function (d) {
        d.start_date = $("#start_date").val(),
        d.end_date = $("#end_date").val()
      }
    },
    columns: [
      { data: 'awb_no', name: 'awb_no' },
      { data: 'pickup_date', name: 'pickup_date' },
      { data: 'customer_name', name: 'customer_name' },
      { data: 'branch_name', name: 'branch_name' },
      { data: null,
        render: function ( data, type, row ) {
          return row.origin + ' - ' + row.destination;
        }
      },
      { data: 'service_name', name: 'service_name' },
      {
        data: 'last_status',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data == "Open") {
            return '<span class="badge badge-pill badge-danger"><b>'+data+'</b></span>';
          } else if (data == "Delivered") {
            return '<span class="badge badge-pill badge-success"><b>'+data+'</b></span>';
          } else {
            return '<span class="badge badge-pill badge-primary"><b>'+data+'</b></span>';
          }
        }
      },
      { data: 'delivered_date', name: 'delivered_date' },
      { data: 'recipient', name: 'recipient' },
      {
        data: 'order_number',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data !== "") {
            var button = '<div class="dropdown d-inline">';
            button += '<button class="btn btn-sm btn-brand-02 btn-uppercase mg-l-5 dropdown-toggle" type="button" id="btnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih</button>';
            button += '<div class="dropdown-menu">';
            button += '<a class="dropdown-item has-icon" href="#" onClick="editData(\''+ data +'\');"><i class="fa fa-edit"></i> Ubah</a>';
            button += '<a class="dropdown-item has-icon" href="#" onClick="trackingData(\''+ data +'\');"><i class="fa fa-history"></i> Tracking</a>';
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

  $('div.dataTables_length select').addClass("form-control-sm");
  /*$.fn.dataTableExt.afnFiltering.push(
    function(oSettings, aData, iDataIndex) {
      if (typeof aData._date == 'undefined') {
        aData._date = new Date(aData[1]).getTime();
      }
      
      if (minDateFilter && !isNaN(minDateFilter)) {
        if (aData._date < minDateFilter) {
          return false;
        }
      }

      if (maxDateFilter && !isNaN(maxDateFilter)) {
        if (aData._date > maxDateFilter) {
          return false;
        }
      }

      return true;
    }
  );*/

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