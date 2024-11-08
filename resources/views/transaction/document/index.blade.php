@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dokumen</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">List Dokumen</h4>
          </div>
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
                    <th class="wd-20p">No Dokumen</th>
                    <th class="wd-10p">Tgl Kirim</th>
                    <th class="wd-15p">Nama Agent</th>
                    <th class="wd-30p">No STT</th>
                    <th class="wd-10p">Tgl Terima</th>
                    <th class="wd-10p">Penerima</th>
                    <th class="wd-5p">Aksi</th>
                </tr>
              </thead>
        </table>
        </div><!-- df-example -->
      </div><!-- row -->
     
      </div><!-- container -->
    </div><!-- content -->

    @include('transaction.document.delete-modal')

@endsection
@section('scripts')
@parent
<script>
  function deleteData(data) {
    $("#modal_delete").modal("show");
    $("#hdn_del_id").val(data);
  }

  function terimaData(data){
    //e.preventDefault();
    if (confirm("Anda yakin ingin menerima dokumen ini") == true) {
      var loader = $('#loader');
      loader.show();
      var action = "{{ route('documents.accept') }}";
      var form_data = new FormData();
      form_data.append('id', data);
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
          //$('#btn_save_ref').hide();
          //$('#btn_save_ref_wait').show();
          //showPreloader();
        },
        complete: function () {
          //$('#btn_save_ref').show();
          //$('#btn_save_ref_wait').hide();
          //hidePreloader();
          loader.hide();
        },
        success: function (data) {
          console.log(data);
          alert("Berhasil melakukan accept dokumen");
          window.location.href = "{{ route('documents.all') }}";
        },
        error: function (jqXHR, exception) {
          alertError(jqXHR.status, exception, jqXHR.responseText);
        }
      });
    }
  }

$(function(){
  'use strict'

  $('#table_data').DataTable({
    language: {
      searchPlaceholder: 'Search...',
      sSearch: '',
      lengthMenu: '_MENU_ items/page',
    },
    processing: true,
    serverSide: true,
    ajax: {
      url: '{{ url("transaction/documents/datatable") }}',
      type: 'GET',
    },
    columns: [
      { data: 'document_no', name: 'document_no' },
      { data: 'sent_date', name: 'sent_date' },
      { data: 'agent.agent_name', name: 'agent.agent_name' },
      {
        data: 'details',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data !== "") {
            var orders = "";
            data.forEach(function (item, index) {
              //orders += item.orders.awb_no + ',';
              orders += '<span class="badge badge-pill badge-primary"><b>'+item.awb_no+'</b></span>&nbsp;';
            });
            return orders; //orders.slice(0, -1);
            //return '<a class="btn btn-sm btn-brand-02" href="#" onClick="detailData('+ data +');">Detail</a>';
          } else {
            return '';
          }
        }
      },
      { data: 'recipient_date', name: 'recipient_date' },
      { data: 'users.name', name: 'users.name' },
      {
        data: 'id',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data !== "") {
            var button = '<div class="dropdown d-inline">';
            button += '<button class="btn btn-sm btn-brand-02 btn-uppercase mg-l-5 dropdown-toggle" type="button" id="btnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">PILIH</button>';
            button += '<div class="dropdown-menu">';
            button += '<a class="dropdown-item has-icon" href="#" onClick="terimaData(\''+ data +'\');"><i class="fa fa-edit"></i> Terima</a>';
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