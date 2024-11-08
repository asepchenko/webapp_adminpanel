@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Gudang</a></li>
                <li class="breadcrumb-item"><a href="#">Trip</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $trip->trip_number }}</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">Detail Trip {{ $trip->trip_number }}</h4>
          </div>
        </div>
      </div><!-- container -->
    </div><!-- content -->

    <div class="content">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
      <div class="row">
        <div class="col-lg-12">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="data-tab" data-toggle="tab" href="#data" role="tab" aria-controls="data" aria-selected="true">Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="hpp-tab" data-toggle="tab" href="#hpp" role="tab" aria-controls="ref-hpp" aria-selected="false">Hitung HPP</a>
            </li>
        </ul>

        <div class="tab-content bd bd-gray-300 bd-t-0 pd-20" id="myTabContent">

            <div class="tab-pane fade show active" id="data" role="tabpanel" aria-labelledby="data-tab">
                @include('warehouse.trip.edit-tab')
            </div>

            <div class="tab-pane fade" id="hpp" role="tabpanel" aria-labelledby="hpp-tab">
                @include('warehouse.trip.calc-hpp-tab')
            </div>
        </div><!-- tab content-->
      </div><!-- col -->
    </div><!-- row -->
        
        
     
      </div><!-- container -->
    </div><!-- content -->
    @include('warehouse.trip.edit-cogs-modal')
@endsection
@section('scripts')
<script src="{{ asset('plugins/jquery.mask.min.js') }}"></script>
@parent
<script>
  function deleteData(data) {
    $("#modal_delete").modal("show");
    $("#hdn_del_id").val(data);
  }

  function editData(data){
    window.location.href = '{{ url("warehouse/trip") }}'+'/'+data;
  }

  function editDataCogs(data){
    var loader = $('#loader');
    loader.show();
    $.ajax({
	    url: '{{ url("warehouse/trip-city") }}'+'/'+data,
        method:"GET",
	      success:function(data){
        loader.hide();
        $('#multiplier_number').val(data.multiplier_number);
        $('#city_id').val(data.city_id);
        $('#trip_city_id').val(data.id);
        $('#frm-modal').modal('show');
	  },
    error: function(data){
        loader.hide();
        console.log(data);
        alert(data);
    }
	  });
  }

$(function(){
  'use strict'
  
  $('#operational_cost').mask("#.##0,00", {reverse: true});
  $('#main_multiplier_number').mask("#.##0,00", {reverse: true});

  
  //Initialize Select2 Elements
  $('.select2bs4').select2({
      theme: 'bootstrap4'
  });

  /*$('#btn_print').click(function(){
    var url = "{{ url('warehouse/trip') }}/{{ $no }}/print-pdf";
    window.open(url,'_blank');
  });*/

  $('#table_data').DataTable({
    dom: 'Bfrtip',
    buttons: [
      {
        extend: 'copyHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file"></i> Copy Data',
        exportOptions: {
          columns: [ 0, 1, 2, 3, 4]
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
          columns: [ 0, 1, 2, 3, 4],
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
  });

  // Select2
  $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

  $('#btn_closing').click(function(){
    if (confirm("Anda yakin ingin closing HPP Trip ini") == true) {
      var action = "{{ route('trip.closing') }}";
      var form_data = new FormData();
      form_data.append('id', $('#trip_id').val());
      form_data.append('trip_number', $('#trip_number').val());
      form_data.append('_token', '{{csrf_token()}}');
      $.ajax({
          type: "POST",
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: action,
          data: form_data,
          //dataType: 'json',
          cache: false,
          processData: false,
          contentType: false,
          beforeSend: function () {
              $('#btn_closing').hide();
              $('#btn_closing_wait').show();
              //showPreloader();
          },
          complete: function () {
              $('#btn_closing').show();
              $('#btn_closing_wait').hide();
              //hidePreloader();
          },
          success: function (result) {
              console.log(result);
              window.location.href = "{{ url('warehouse/trip') }}/"+$('#trip_number').val();
          },
          error: function (jqXHR, exception) {
            console.log(jqXHR);
            alertError(jqXHR.status, exception, jqXHR.responseText);
          }
      });
    }
  });

  $('#btn_save').click(function(e){
    e.preventDefault();
    if (confirm("Anda yakin ingin melakukan perubahan pada Trip ini") == true) {
      var action = "{{ route('trip.update') }}";
      var form_data = new FormData();
      form_data.append('id', $('#trip_id').val());
      form_data.append('trip_number', '{{ $trip->trip_number }}');
      form_data.append('operational_cost', decimalFormat($('#operational_cost').val()) );
      form_data.append('multiplier_number', decimalFormat($('#main_multiplier_number').val()) );
      form_data.append('_token', '{{csrf_token()}}');

      for (var pair of form_data.entries()) {
        console.log(pair[0]+ ', ' + pair[1]); 
      }

      $.ajax({
          type: "POST",
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: action,
          data: form_data,
          //dataType: 'json',
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
              console.log(result);
              window.location.href = "{{ url('warehouse/trip') }}/"+$('#trip_number').val();
          },
          error: function (jqXHR, exception) {
            console.log(jqXHR);
            alertError(jqXHR.status, exception, jqXHR.responseText);
          }
      });
    }
  });

  $('#table_cogs').DataTable({
    dom: 'Bfrtip',
    buttons: [
      {
        extend: 'copyHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file"></i> Copy Data',
        exportOptions: {
          columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8]
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
          columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8],
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
    }
  });

  $("#btn_save_cogs").click(function (e) {
    e.preventDefault();
    var action = "{{ route('trip-city.update') }}";
    
    var form_data = new FormData();
    form_data.append('id', $('#trip_city_id').val());
    form_data.append('city_id', $('#city_id').val());
    form_data.append('multiplier_number', $('#multiplier_number').val() );
    form_data.append('trip_id', $('#trip_id').val());
    form_data.append('trip_number', $('#trip_number').val());
    form_data.append('_token', '{{csrf_token()}}');

    for (var pair of form_data.entries()) {
      console.log(pair[0]+ ', ' + pair[1]); 
    }

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
        $('#btn_save_cogs').hide();
        $('#btn_save_cogs_wait').show();
        //showPreloader();
      },
      complete: function () {
        $('#btn_save_cogs').show();
        $('#btn_save_cogs_wait').hide();
        //hidePreloader();
      },
      success: function (data) {
        console.log(data);
        //$('#table_cogs').DataTable().ajax.reload();
        $('#manifest_number').val('');
        $('#multiplier_number').val('');
        $('#city_id').val('');
        $('#frm-modal').modal('hide');
        //window.location.href = "{{ url('warehouse/trip') }}/"+$('#trip_number').val();
        //calc button update
        $('#btn_save').click();
      },
      error: function (jqXHR, exception) {
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });
});
</script>
@endsection