@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item">Accounting</li>
                <li class="breadcrumb-item">Invoice Agent</li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">Tambah Invoice Agent</h4>
          </div>
          @can('acc_bill_crate')
          <div class="mg-t-20 mg-sm-t-0">
            <button class="btn btn-sm btn-brand-02" type="button" id="btn-create"><i class="fas fa-plus"></i> Buat Invoice</button>
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
                    <th class="wd-5p"></th>
                    <th class="wd-10p">No STT</th>
                    <th class="wd-20p">Nama Customer</th>
                    <th class="wd-10p">Agent</th>
                    <th class="wd-15p">Via</th>
                    <th class="wd-10p">Tujuan</th>
                    <th class="wd-15p">Tgl Sampai</th>
                    <th class="wd-15p">Total Kg</th>
                    <!--<th class="wd-5p">Aksi</th>-->
                </tr>
            </thead>
        </table>
        </div><!-- df-example -->
      </div><!-- row -->
     
      </div><!-- container -->
    </div><!-- content -->

@endsection
@section('scripts')
@parent
<script>
$(function(){
  'use strict'
  var ids = new Array();
  $("#btn-create").on("click", function() {
        event.preventDefault();

        if (!ids || !ids.length) {
            alert("Pilih dahulu Order yang akan dibuat invoicenya");
        }else{
            //alert(ids);
            console.log(ids);
            var r = confirm("Anda yakin ingin membuat invoice agent dengan data STT ini ?");
            if (r == true) {
                event.preventDefault();
                var spinner = $('#loader');
                spinner.show();
                var form_data = new FormData();
                form_data.append('order_number', ids);
                form_data.append('_token', '{{csrf_token()}}');
                $.ajax({
                    url: "{{ url('agent/invoice') }}",
                    method:"POST",
                    data:form_data,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                      //$("#frm_del_agent_submit").hide();
                      //$("#frm_del_agent_submit_wait").show();
                    },
                    complete: function () {
                      spinner.hide();
                      //$("#frm_del_agent_submit").show();
                      //$("#frm_del_agent_submit_wait").hide();
                    },
                    success: function (result) {
                      //console.log(result);
                      alert("Berhasil Membuat Invoice dengan nomor : "+result.data);
                      window.location.href= "{{ url('accounting/bill') }}/"+result.data+"/detail";
                    },
                    error: function (jqXHR, exception) {
                      //console.log(jqXHR);
                      spinner.hide();
                      alertError(jqXHR.status, exception, jqXHR.responseText);
                    }
                });
            }
        }
    });

  var table = $('#table_data').DataTable({
    dom: 'Bfrtip',
    language: {
      searchPlaceholder: 'Search...',
      sSearch: '',
      lengthMenu: '_MENU_ items/page',
    },
    processing: true,
    //serverSide: true,
    ajax: {
      url: '{{ url("accounting/bill/bills-order-list") }}',
      type: 'GET',
    },
    columnDefs: [ 
      {
        orderable: false,
        className: 'select-checkbox',
        targets: 0
      },
      /*{
        targets: 1,
        visible: false,
        searchable: false
      }*/
    ],
    select: {
      style:    'multi',
      selector: 'td:first-child'
    },
    buttons: [
      {
        extend: 'selectAll',
        className: 'btn-sm btn-sm btn-brand-02',
        text: 'Pilih Semua',
        exportOptions: {
          columns: ':visible'
        }/*,
        action: function(e, dt) {
          e.preventDefault()
          dt.rows().deselect();
          dt.rows({ search: 'applied' }).select();
        }*/
      },
      {
        extend: 'selectNone',
        className: 'btn-sm btn-sm btn-danger',
        text: 'Batal Pilih Semua',
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'copyHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file"></i> Copy Data',
        exportOptions: {
          columns: [ 1, 2, 3, 4, 5, 6 ]
        }
      },
      {
        extend: 'excelHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file-excel"></i> Export Excel',
        exportOptions: {
          columns: [ 1, 2, 3, 4, 5, 6 ],
          orthogonal: 'export'
        }
      },
    ],
    columns: [
      { data: null,  defaultContent:'', orderable: false },
      { data: 'awb_no', name: 'awb_no' },
      { data: 'customer_name', name: 'customer_name' },
      { data: 'customer_name', name: 'customer_name' },
      { data: 'service_name', name: 'service_name' },
      { data: 'destination', name: 'destination' },
      { data: 'delivered_date', name: 'delivered_date' },
      { data: 'total_kg_agent', name: 'total_kg_agent' },
      /*{
        data: 'id',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data !== "") {
            return '<a class="btn btn-sm btn-brand-02" href="#" onClick="detailData('+ data +');">Detail</a>';
          } else {
            return '';
          }
        }
      },*/
    ]
  });

  // Select2
  $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
    
  $('#table_data').DataTable().on( 'select', function ( e, dt, type, indexes ) {
        if ( type === 'row' ) {
            var rowData = table.rows( indexes ).data().toArray();
            var jsonStringify = JSON.stringify(rowData);
            var jsonObj = JSON.parse(jsonStringify);
            ids.push(jsonObj[0]['order_number']);
        }
    });

    $('#table_data').DataTable().on( 'deselect', function ( e, dt, type, indexes ) {
        if ( type === 'row' ) {
            var rowData = table.rows( indexes ).data().toArray();
            var jsonStringify = JSON.stringify(rowData);
            var jsonObj = JSON.parse(jsonStringify);
            ids.splice( ids.indexOf(jsonObj[0]['order_number']), 1 );
        }
    });
});
</script>
@endsection