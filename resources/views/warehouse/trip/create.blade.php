@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Gudang</a></li>
                <li class="breadcrumb-item active" aria-current="page">Trip</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">Buat Perjalanan (Trip)</h4>
          </div>
          <div class="mg-t-20 mg-sm-t-0">
            <button class="btn btn-sm btn-danger" type="button" id="btn-create"><i class="fas fa-plus"></i> Submit</button>
          </div>
        </div>
      </div><!-- container -->
    </div><!-- content -->

    <div class="content">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div data-label="Example" class="df-example demo-table">
          <table id="table_data" class="table mg-b-0" width="100%">
            <thead>
                <tr>
                    <th class="wd-5p"></th>
                    <th class="wd-15p">No Manifest</th>
                    <th class="wd-10p">Tgl</th>
                    <th class="wd-15p">Total Colly</th>
                    <th class="wd-15p">Total Kg</th>
                    <th class="wd-25p">STT</th>
                    <th class="wd-15p">Tujuan</th>
                </tr>
              </thead>
        </table>
        </div><!-- df-example -->
      </div><!-- row -->
     
      </div><!-- container -->
    </div><!-- content -->
    @include('warehouse.trip.submit-modal')

@endsection
@section('scripts')
<script src="{{ asset('plugins/jquery.mask.min.js') }}"></script>
@parent
<script>
$(function(){
  'use strict'

  $('#operational_cost').mask("#.##0,00", {reverse: true});
  $('#multiplier_number').mask("#.##0,00", {reverse: true});

  var ids = new Array();
  $("#btn-create").on("click", function() {
    event.preventDefault();
    if (!ids || !ids.length) {
      alert("Pilih dahulu Manifest yang akan dibuat tripnya");
    }else{
      $('#operational_cost').val('');
      $('#multiplier_number').val('');
      $('#frm-modal').modal('show');
    }
  });

  $("#btn_save").on("click", function() {
    event.preventDefault();

        if (!ids || !ids.length) {
            alert("Pilih dahulu Manifest yang akan dibuat tripnya");
        }else{
            //alert(ids);
            console.log(ids);
            var r = confirm("Anda yakin ingin membuat trip baru dengan data Manifest ini ?");
            if (r == true) {
                event.preventDefault();
                //var spinner = $('#loader');
                //spinner.show();
                var form_data = new FormData();
                form_data.append('operational_cost', decimalFormat($('#operational_cost').val()) );
                form_data.append('multiplier_number', decimalFormat($('#multiplier_number').val()) );
                form_data.append('manifest_number', ids);
                form_data.append('_token', '{{csrf_token()}}');
                $.ajax({
                    url: "{{ url('warehouse/trip') }}",
                    method:"POST",
                    data:form_data,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                      $("#btn_save").hide();
                      $("#btn_save_wait").show();
                    },
                    complete: function () {
                      //$("#btn_save").show();
                      //$("#btn_save_wait").hide();
                    },
                    success: function (result) {
                      alert("Berhasil Membuat Trip dengan nomor : "+result.data);
                      window.location.href= "{{ url('warehouse/trip') }}/"+result.data;
                    },
                    error: function (jqXHR, exception) {
                      $("#btn_save").show();
                      $("#btn_save_wait").hide();
                      //console.log(exception);
                      //console.log(jqXHR.responseText);
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
    serverSide: true,
    ajax: {
      url: '{{ url("warehouse/manifest/list") }}',
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
    ],
    columns: [
      { data: null,  defaultContent:'', orderable: false },
      { data: 'manifest_number', name: 'manifest_number' },
      { data: 'manifest_date', name: 'manifest_date' },
      { data: 'total_colly', name: 'total_colly' },
      { data: 'total_kg', name: 'total_kg' },
      {
        data: 'details',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data !== "") {
            var orders = "";
            data.forEach(function (item, index) {
              orders += item.orders.awb_no + ',';
            });
            return orders.slice(0, -1);
            //return '<a class="btn btn-sm btn-brand-02" href="#" onClick="detailData('+ data +');">Detail</a>';
          } else {
            return '';
          }
        }
      },
      { data: 'destinations.city_name', name: 'destinations.city_name' },
      /*{
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
            ids.push(jsonObj[0]['manifest_number']);
        }
    });

    $('#table_data').DataTable().on( 'deselect', function ( e, dt, type, indexes ) {
        if ( type === 'row' ) {
            var rowData = table.rows( indexes ).data().toArray();
            var jsonStringify = JSON.stringify(rowData);
            var jsonObj = JSON.parse(jsonStringify);
            ids.splice( ids.indexOf(jsonObj[0]['manifest_number']), 1 );
        }
    });
});
</script>
@endsection