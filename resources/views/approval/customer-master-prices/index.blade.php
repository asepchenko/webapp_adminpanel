@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Approval</a></li>
                <li class="breadcrumb-item active" aria-current="page">Harga Customer</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">List Pending Harga Customer</h4>
          </div>
          <div class="mg-t-20 mg-sm-t-0">
            <button class="btn btn-sm btn-brand-02" type="button" id="btn-create"><i class="fas fa-plus"></i> Mass Approve</button>
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
                    <th class="wd-5p"></th>
                    <th class="wd-35p">Nama Customer</th>
                    <th class="wd-10p">Lokasi</th>
                    <th class="wd-10p">Harga</th>
                    <th class="wd-20p">Sales Bottom</th>
                    <th class="wd-10p">Margin</th>
                    <th class="wd-10p">Aksi</th>
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
  function approveData(data){
    if (confirm("Anda yakin ingin melakukan approve pada data ini?") == true) {
      var loader = $('#loader');
      loader.show();
      var form_data = new FormData();
      form_data.append('id', data);
      form_data.append('_token', '{{csrf_token()}}');
      $.ajax({
        url: '{{ url("approval/customer-master-prices/approve") }}',
        type: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: form_data,
        dataType: 'json',
        cache: false,
        processData: false,
        contentType: false,
        success:function(data){
          loader.hide();
          alert("Berhasil melakukan approve");
          window.location.href = "{{ url('approval/customer-master-prices') }}";
        },
        error: function(data){
          loader.hide();
          alert(data);
        }
      });
    }
  }

$(function(){
  'use strict'
  var ids = new Array();
  $("#btn-create").on("click", function() {
        event.preventDefault();

        if (!ids || !ids.length) {
            alert("Pilih dahulu datanya");
        }else{
            //alert(ids);
            //return false;
            console.log(ids);
            var r = confirm("Anda yakin ingin melakukan mass approve ini ?");
            if (r == true) {
                event.preventDefault();
                var spinner = $('#loader');
                spinner.show();
                var form_data = new FormData();
                form_data.append('ids', ids);
                form_data.append('_token', '{{csrf_token()}}');
                $.ajax({
                    url: "{{ url('approval/customer-master-prices/mass-approve') }}",
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
                      alert("Berhasil Melakukan Approve Massal");
                      window.location.href= "{{ url('approval/customer-master-prices') }}";
                    },
                    error: function (jqXHR, exception) {
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
      searchPlaceholder: 'Cari Data...',
      sSearch: '',
      lengthMenu: '_MENU_ data/halaman',
      zeroRecords: 'Tidak Ada Data :(',
      info: '',
      infoEmpty: '',
      infoFiltered: '(Terfilter dari _MAX_ total data)'
    },
    processing: true,
	paging: false,
    //serverSide: true,
    ajax: {
      url: '{{ url("approval/customer-master-prices/datatable") }}',
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
        },
        action: function(e, dt) {
          e.preventDefault()
          dt.rows().deselect();
          //ids.push(dt.rows( { selected: true } ).data()[0][0]);
          dt.rows().every(function(rowIdx, tableLoop, rowLoop) {
            var rowData = table.rows( rowIdx ).data().toArray();
            var jsonStringify = JSON.stringify(rowData);
            var jsonObj = JSON.parse(jsonStringify);
            ids.push(jsonObj[0]['id']);
            //ids.push(this.data()[0][0]);
            //dt.rows().select();
            //console.log(rowIdx);
          });
          dt.rows({ search: 'applied' }).select();
        }
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
          columns: [ 1, 2, 3, 4, 5]
        }
      },
      {
        extend: 'excelHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file-excel"></i> Export Excel',
        exportOptions: {
          format: {
              body: function(data, row, column, node) {
                  data = $('<p>' + data + '</p>').text();
                  data = $.isNumeric(data.replace(',', '.')) ? data.replace(',', '.') : data;
                  //data = data.replace('.', ',');
                  return data;
              }
          },
          columns: [ 1, 2, 3, 4, 5],
          orthogonal: 'export'
        }
      },
    ],
    columns: [
      { data: null,  defaultContent:'', orderable: false },
      { data: 'customers.customer_name', name: 'customers.customer_name' },
      { data: null,
          render: function ( data, type, row ) {
			  var ori = "";
			  var dest = "";
			  if(row.locations.origins != ""){
				ori = row.locations.origins.city_code;
			  }
			  
			  if(row.locations.destinations != ""){
				 dest = row.locations.destinations.city_code
			  }
			  
			  return ori + '-' + dest;
          },
      },
      { data: 'price', name: 'price' },
      { data: 'cogs_price', name: 'cogs_price' },
      { data: 'margin', name: 'margin' },
      {
        data: 'id',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data !== "") {
            return '<a class="dropdown-item has-icon" href="#" onClick="approveData('+ data +');"><i class="fa fa-edit"></i> Approve</a>';
          } else {
            return '';
          }
        }
      },
    ]
  });

  // Select2
  $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

  $('#table_data').DataTable().on( 'select', function ( e, dt, type, indexes ) {
        if ( type === 'row' ) {
            var rowData = table.rows( indexes ).data().toArray();
            var jsonStringify = JSON.stringify(rowData);
            var jsonObj = JSON.parse(jsonStringify);
            ids.push(jsonObj[0]['id']);
        }
    });

    $('#table_data').DataTable().on( 'deselect', function ( e, dt, type, indexes ) {
        if ( type === 'row' ) {
            var rowData = table.rows( indexes ).data().toArray();
            var jsonStringify = JSON.stringify(rowData);
            var jsonObj = JSON.parse(jsonStringify);
            ids.splice( ids.indexOf(jsonObj[0]['id']), 1 );
        }
    });
});
</script>
@endsection