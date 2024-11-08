@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Laporan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Order</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">Laporan Order by Customer - Oktober 2021</h4>
          </div>
        </div>
      </div><!-- container -->
    </div><!-- content -->

    <div class="content">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="row">
        <div class="col-lg-12">
        
        <div class="table-responsive">
          <table id="table_data" class="table table-striped table-bordered" width="100%">
            <thead class="thead-primary">
                <tr>
                    <th class="wd-10">Kode Customer</th>
                    <th class="wd-30">Nama Customer</th>
                    <th class="wd-20p">Jumlah Order</th>
                    <th class="wd-40p" style="text-align:center">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>CUST001</td>
                    <td>PT AMS</td>
                    <td>200</td>
                    <td style="text-align:center">8.000.000</td>
                </tr>
                <tr>
                    <td>CUST002</td>
                    <td>PT ABC</td>
                    <td>50</td>
                    <td style="text-align:center">2.000.000</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"><b>Total</b></td>
                    <td><b>250</b></td>
                    <td style="text-align:center"><b>10.000.000</b></td>
                </tr>
            </tfoot>
        </table>
        </div><!-- df-example -->
      </div><!-- row -->
     
      </div><!-- container -->
    </div><!-- content -->

    @include('master.truck.create-modal')
    @include('master.truck.delete-modal')

@endsection
@section('scripts')
@parent
<script>
$(function(){
  'use strict'
});
/*function deleteData(data) {
  $("#modal_delete").modal("show");
  $("#hdn_del_id").val(data);
}

function editData(data){
  var loader = $('#loader');
  loader.show();
  $.ajax({
		url: '{{ url("projects") }}'+'/'+data+'/detail',
    method:"GET",
		success:function(data){
      loader.hide();
		  $('#id').val(data.id);
      $('#name').val(data.name);
      $('#location').val(data.location);
      $('#cost').val(data.cost);
      $('#action').val('edit');
      $('#frm-modal').modal('show');
		},
    error: function(data){
      loader.hide();
      alert(data);
    }
	});
}

$(function(){
  'use strict'

  $('#btn-add-new').click(function(){
    $('#id').val('');
    $('#name').val('');
    $('#location').val('');
    $('#cost').val('');
    $('#action').val('add');
		$('#frm-modal').modal('show');
  });

  $('#table_data').DataTable({
    language: {
      searchPlaceholder: 'Search...',
      sSearch: '',
      lengthMenu: '_MENU_ items/page',
    },
    processing: true,
    serverSide: true,
    ajax: {
      url: '{{ url("projects/datatable") }}',
      type: 'GET',
    },
    columns: [
      { data: 'name', name: 'name' },
      { data: 'location', name: 'location' },
      { data: 'cost', name: 'cost' },
      {
        data: 'id',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data !== "") {
            var button = '<div class="dropdown d-inline">';
            button += '<button class="btn btn-sm btn-brand-02 btn-uppercase mg-l-5 dropdown-toggle" type="button" id="btnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select</button>';
            button += '<div class="dropdown-menu">';
            button += '<a class="dropdown-item has-icon" href="#" onClick="editData('+ data +');"><i class="fa fa-edit"></i> Edit</a>';
            button += '<a class="dropdown-item has-icon" href="#" onClick="deleteData('+ data +');"><i class="fa fa-trash-alt"></i> Delete</a>';
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
    if($('#action').val() == "add"){
      var action = "{{ route('projects.store') }}";
    }else{
      var action = "{{ route('projects.update') }}";
    }
    //var action = $(this).attr('action');
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
                success: function (data) {
                  $("#frm-modal").modal("hide");
                  $('#table_data').DataTable().ajax.reload();
                },
                error: function (jqXHR, exception) {
                    //var obj = JSON.parse(jqXHR.responseText);

                    if (jqXHR.status === 0) {
                        alert('Not connect.\n Verify Network.');
                    } else if (jqXHR.status == 404) {
                        alert('Requested page not found. [404]');
                    } else if (jqXHR.status == 500) {
                        alert('Internal Server Error [500].<br>'+jqXHR.responseText);
                    } else if (exception === 'parsererror') {
                        alert('Requested JSON parse failed.');
                    } else if (exception === 'timeout') {
                        alert('Time out error.');
                    } else if (exception === 'abort') {
                        alert('Ajax request aborted.');
                    } else {
                        alert('Uncaught Error.\n' + jqXHR.responseText);
                    }
                }
            });
        });

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
                },
                success: function (data) {
                    $("#modal_delete").modal("hide");
                    $('#table_data').DataTable().ajax.reload();
                },
                error: function (jqXHR, exception) {
                    var obj = JSON.parse(jqXHR.responseText);

                    if (jqXHR.status === 0) {
                        alert('Not connect.\n Verify Network.');
                    } else if (jqXHR.status == 404) {
                        alert('Requested page not found. [404]');
                    } else if (jqXHR.status == 422) {


                    } else if (jqXHR.status == 500) {
                        alert('Internal Server Error [500].');
                    } else if (exception === 'parsererror') {
                        alert('Requested JSON parse failed.');
                    } else if (exception === 'timeout') {
                        alert('Time out error.');
                    } else if (exception === 'abort') {
                        alert('Ajax request aborted.');
                    } else {
                        alert('Uncaught Error.\n' + jqXHR.responseText);
                    }
                }
            });
        });
});*/
</script>
@endsection