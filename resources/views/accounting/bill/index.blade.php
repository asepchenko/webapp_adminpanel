@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Accounting</a></li>
                <li class="breadcrumb-item active" aria-current="page">Invoice Agent</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">List Invoice Agent</h4>
          </div>
          @can('acc_bill_access')
          <div class="mg-t-20 mg-sm-t-0">
            <!--<a href="{{ url('accounting/bill/create') }}" class="btn btn-sm btn-brand-02"><i class="fas fa-plus"></i> Tambah</a>-->
            <button class="btn btn-sm btn-brand-02" type="button" id="btn-create"><i class="fas fa-plus"></i> Tambah</button>
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
                    <th class="wd-10p">No Invoice</th>
                    <th class="wd-10p">No Manual</th>
                    <th class="wd-10p">Tgl</th>
                    <th class="wd-15p">Jatuh Tempo</th>
                    <th class="wd-15p">Tgl Bayar</th>
                    <th class="wd-20p">Agent</th>
                    <th class="wd-15p">Total</th>
                    <th class="wd-10p">Status</th>
                    <th class="wd-5p">Aksi</th>
                </tr>
              </thead>
        </table>
        </div><!-- df-example -->
      </div><!-- row -->
     
      </div><!-- container -->
    </div><!-- content -->

    @include('accounting.bill.create-modal')

@endsection
@section('scripts')
@parent
<script>

  function editData(data){
    window.location.href = '{{ url("accounting/bill") }}'+'/'+data+'/detail';
  }

$(function(){
  'use strict'

  //Initialize Select2 Elements
  $('.select2bs4').select2({
      theme: 'bootstrap4'
  });

  $('#agent_id').select2({
      dropdownParent: $('#frm-add')
  });

  $("#btn-create").on("click", function() {
    $('#modal_title').text('Tambah Invoice Agent');
    $('#agent_id').val('');
    $('#bill_number_manual').val('');
    $('#bill_date').val('');
    $('#bill_receipt_date').val('');
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
          columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
        }
      },
      {
        extend: 'excelHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file-excel"></i> Export Excel',
        exportOptions: {
          columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ],
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
      url: '{{ url("accounting/bill/datatable") }}',
      type: 'GET',
    },
    columns: [
      { data: 'bill_number', name: 'bill_number' },
      { data: 'bill_number_manual', name: 'bill_number_manual' },
      { data: 'bill_date', name: 'bill_date' },
      { data: 'due_date', name: 'due_date' },
      { data: 'payment_date', name: 'payment_date' },
      { data: 'agents.agent_name', name: 'agents.agent_name' },
      { data: 'grand_total', name: 'grand_total' },
      {
        data: 'last_status',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data != "Close") {
            return '<span class="badge badge-pill badge-danger"><b>'+data+'</b></span>';
          } else {
            return '<span class="badge badge-pill badge-primary"><b>'+data+'</b></span>';
          }
        }
      },
      {
        data: 'bill_number',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data !== "") {
            var button = '<div class="dropdown d-inline">';
            button += '<button class="btn btn-sm btn-brand-02 btn-uppercase mg-l-5 dropdown-toggle" type="button" id="btnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">PILIH</button>';
            button += '<div class="dropdown-menu">';
            button += '<a class="dropdown-item has-icon" href="#" onClick="editData(\''+ data +'\');"><i class="fa fa-edit"></i> Detail</a>';
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
    var action = "{{ route('bill.store') }}";
    
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
      success: function (result) {
        $("#frm-modal").modal("hide");
        alert("Berhasil Membuat Invoice Agent dengan nomor : "+result.data);
        window.location.href = "{{ url('accounting/bill') }}/"+result.data+"/detail";
      },
      error: function (jqXHR, exception) {
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });
});
</script>
@endsection