@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Gudang</a></li>
                <li class="breadcrumb-item"><a href="#">Manifest</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $manifest->manifest_number }}</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">Detail Manifest {{ $manifest->manifest_number }}</h4>
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
            <!--<li class="nav-item">
                <a class="nav-link" id="hpp-tab" data-toggle="tab" href="#hpp" role="tab" aria-controls="ref-hpp" aria-selected="false">Hitung HPP</a>
            </li>-->
        </ul>

        <div class="tab-content bd bd-gray-300 bd-t-0 pd-20" id="myTabContent">

            <div class="tab-pane fade show active" id="data" role="tabpanel" aria-labelledby="data-tab">
                @include('warehouse.manifest.edit-tab')
            </div>
            
        </div><!-- tab content-->
      </div><!-- col -->
    </div><!-- row -->
        
        
     
      </div><!-- container -->
    </div><!-- content -->

    @include('warehouse.manifest.add-stt-modal')

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
  
  //Initialize Select2 Elements
  $('.select2bs4').select2({
      theme: 'bootstrap4'
  });

  $('#btn_print').click(function(){
    var url = "{{ url('warehouse/manifest') }}/{{ $no }}/print-pdf";
    window.open(url,'_blank');
  });

  $('#btn_print_stt').click(function(){
    var url = "{{ url('warehouse/manifest') }}/{{ $no }}/print-stt";
    window.open(url,'_blank');
  });

  $(".delete-detail").on("click", function(e) {
    //alert($(this).data("id") );
    if (confirm("Anda yakin ingin menghapus STT ini") == true) {
      var action = "{{ route('manifest.delete-detail') }}";
      var spinner = $('#loader');
      spinner.show();
      var form_data = new FormData();
      form_data.append('id', $(this).data("id"));
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
          complete: function () {
              spinner.hide();
          },
          success: function (result) {
              console.log(result);
              window.location.href = "{{ url('warehouse/manifest') }}/"+$('#manifest_number').val();
          },
          error: function (jqXHR, exception) {
            console.log(jqXHR);
            alertError(jqXHR.status, exception, jqXHR.responseText);
          }
      });
    }
  });

  $('#order_number').select2({
      dropdownParent: $('#frm-stt-modal')
  });

  $('#btn_add').click(function(){
    //get data stt first
    var spinner = $('#loader');
    spinner.show();
    $.ajax({
      url: "{{ url('warehouse/manifest/list-stt') }}/{{ $no }}",
      dataType: 'json',
      success: function( data ) {
        spinner.hide();
        if(data.length > 0){
          console.log(data);
          var temp = [];
          $.each(data, function(key, value) {
            temp.push({v:value, k: key});
          });      

          $('#order_number').empty();
          $('#order_number').append('<option value=""> - Pilih - </option>'); 
          $.each(temp, function(key, obj) {
            $('#order_number').append('<option value="' + obj.v.order_number +'">' + obj.v.awb_no + ' (' + obj.v.customer_name + ' - '+ obj.v.branch_name + ') </option>');           
          });

          $('#modal_title').text('Tambah STT');
          $('#manifest_number_add').val('{{ $manifest->manifest_number }}');
          $('#order_number').val('');
          $('#order_number').val('').trigger("change");
          $('#frm-stt-modal').modal('show');

        }else{
          alert('Gagal mendapatkan data STT');
        }
      },
      error: function (jqXHR, exception) {
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
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
  });

  // Select2
  $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

  $("#frm-edit").submit(function (e) {
    e.preventDefault();
    var action = "{{ route('manifest.update') }}";
    var form_data = new FormData();
    form_data.append('id', $('#manifest_id').val());
    form_data.append('destination', $('#destination').val());
    form_data.append('manifest_date', $('#manifest_date').val());
    form_data.append('truck_id', $('#truck_id').val());
    form_data.append('driver_id', $('#driver_id').val());
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
            window.location.href = "{{ url('warehouse/manifest') }}/"+$('#manifest_number').val();
        },
        error: function (jqXHR, exception) {
          alertError(jqXHR.status, exception, jqXHR.responseText);
        }
    });
  });

  $('#btn_closing').click(function(){
    if (confirm("Anda yakin ingin closing manifest ini") == true) {
      var action = "{{ route('manifest.closing') }}";
      var form_data = new FormData();
      form_data.append('id', $('#manifest_id').val());
      form_data.append('manifest_number', $('#manifest_number').val());
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
              window.location.href = "{{ url('warehouse/manifest') }}/"+$('#manifest_number').val();
          },
          error: function (jqXHR, exception) {
            console.log(jqXHR);
            alertError(jqXHR.status, exception, jqXHR.responseText);
          }
      });
    }
  });

  $('#btn_delete').click(function(){
    if (confirm("Anda yakin ingin menghapus manifest ini") == true) {
      var action = "{{ route('manifest.delete') }}";
      var form_data = new FormData();
      form_data.append('id', $('#manifest_number').val());
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
              $('#btn_delete').hide();
              $('#btn_delete_wait').show();
              //showPreloader();
          },
          complete: function () {
              $('#btn_delete').show();
              $('#btn_delete_wait').hide();
              //hidePreloader();
          },
          success: function (result) {
              console.log(result);
              window.location.href = "{{ url('warehouse/manifest') }}";
          },
          error: function (jqXHR, exception) {
            console.log(jqXHR);
            alertError(jqXHR.status, exception, jqXHR.responseText);
          }
      });
    }
  });

  $('#btn_add_stt').click(function(){
    if (confirm("Anda yakin ingin menambah STT ke manifest ini") == true) {
      var action = "{{ route('manifest.add-detail') }}";
      var form_data = new FormData();
      form_data.append('order_number', $('#order_number').val());
      form_data.append('manifest_number', $('#manifest_number').val());
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
              $('#btn_add_stt').hide();
              $('#btn_add_stt_wait').show();
              //showPreloader();
          },
          complete: function () {
              $('#btn_add_stt').show();
              $('#btn_add_stt_wait').hide();
              //hidePreloader();
          },
          success: function (result) {
              console.log(result);
              window.location.href = "{{ url('warehouse/manifest') }}/"+$('#manifest_number').val();
          },
          error: function (jqXHR, exception) {
            console.log(jqXHR);
            alertError(jqXHR.status, exception, jqXHR.responseText);
          }
      });
    }
  });
});
</script>
@endsection