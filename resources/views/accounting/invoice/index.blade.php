@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Accounting</a></li>
                <li class="breadcrumb-item active" aria-current="page">Invoice</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">List Invoice</h4>
          </div>
          @can('acc_invoice_create')
          <div class="mg-t-20 mg-sm-t-0">
            <!--<button class="btn btn-sm btn-brand-02" type="button" id="btn-add-new"><i class="fas fa-file-excel"></i> Excel</button>-->
            <a href="{{ url('accounting/invoice/create') }}" class="btn btn-sm btn-brand-02"><i class="fas fa-plus"></i> Tambah</a>
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
          <table id="table_data" class="table mg-b-0" width="100%">
            <thead>
                <tr>
                    <th class="wd-20p">No Invoice</th>
                    <th class="wd-10p">Tgl</th>
                    <th class="wd-15p">Jatuh Tempo</th>
                    <th class="wd-10p">Tgl Bayar</th>
                    <th class="wd-30p">Customer</th>
                    <th class="wd-10p">Total</th>
                    <th class="wd-10p">Status</th>
                    <th class="wd-5p">Aksi</th>
                </tr>
              </thead>
        </table>
        </div><!-- df-example -->
      </div><!-- row -->
     
      </div><!-- container -->
    </div><!-- content -->

    @include('accounting.invoice.delete-modal')

@endsection
@section('scripts')
@parent
<script>
  function deleteData(data) {
    $("#modal_delete").modal("show");
    $("#invoice_number").val(data);
  }

  function editData(data){
    window.location.href = '{{ url("accounting/invoice") }}'+'/'+data;
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
          columns: [ 0, 1, 2, 3, 4, 5, 6 ]
        }
      },
      {
        extend: 'excelHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file-excel"></i> Export Excel',
        exportOptions: {
          columns: [ 0, 1, 2, 3, 4, 5, 6 ],
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
    //serverSide: true,
    ajax: {
      url: '{{ url("accounting/invoice/datatable") }}',
      type: 'GET',
    },
    columns: [
      { data: 'invoice_number', name: 'invoice_number' },
      { data: 'invoice_date', name: 'invoice_date' },
      { data: 'due_date', name: 'due_date' },
      { data: 'payment_date', name: 'payment_date' },
      { data: 'customers.customer_name', name: 'customers.customer_name' },
      { data: 'grand_total', name: 'grand_total' },
      {
        data: 'last_status',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data != "Verify") {
            return '<span class="badge badge-pill badge-danger"><b>'+data+'</b></span>';
          } else {
            return '<span class="badge badge-pill badge-primary"><b>'+data+'</b></span>';
          }
        }
      },
      {
        data: 'invoice_number',
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
        window.location.href = '{{ url("accounting/invoice") }}';
      },
      error: function (jqXHR, exception) {
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });
});
</script>
@endsection