@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
                <li class="breadcrumb-item"><a href="#">Order</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">Detail Order #{{ $no }}</h4>
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
                <a class="nav-link active" id="data-tab" data-toggle="tab" href="#data" role="tab" aria-controls="data" aria-selected="true">Order</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="agent-tab" data-toggle="tab" href="#agent" role="tab" aria-controls="ref-agent" aria-selected="false">Agent</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="ref-tab" data-toggle="tab" href="#ref" role="tab" aria-controls="ref-data" aria-selected="false">Referensi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="unit-tab" data-toggle="tab" href="#unit" role="tab" aria-controls="unit-data" aria-selected="false">Colly</a>
            </li>
        </ul>

        <div class="tab-content bd bd-gray-300 bd-t-0 pd-20" id="myTabContent">

            <div class="tab-pane fade show active" id="data" role="tabpanel" aria-labelledby="data-tab">
                @include('transaction.order.edit-tab')
            </div>

            <div class="tab-pane fade" id="agent" role="tabpanel" aria-labelledby="agent-tab">
                @include('transaction.order.agent-tab')
            </div>

            <div class="tab-pane fade" id="ref" role="tabpanel" aria-labelledby="ref-tab">
                @include('transaction.order.ref-tab')
            </div>

            <div class="tab-pane fade" id="unit" role="tabpanel" aria-labelledby="unit-tab">
                @include('transaction.order.unit-tab')
            </div>
        </div><!-- tab content-->
      </div><!-- col -->
    </div><!-- row -->
      
  </div><!-- container -->
</div><!-- content -->
@include('transaction.order.delete-ref-modal')
@include('transaction.order.delete-agent-modal')
@include('transaction.order.delete-unit-modal')

@endsection
@section('scripts')
<script src="{{ asset('plugins/jquery.mask.min.js') }}"></script>
@parent
<script>

  function deleteDataAgent(data) {
    $("#modal_agent_delete").modal("show");
    $("#hdn_del_agent_id").val(data);
  }

  function deleteDataRef(data) {
    $("#modal_ref_delete").modal("show");
    $("#hdn_del_ref_id").val(data);
  }

  function deleteDataUnit(data) {
    $("#modal_unit_delete").modal("show");
    $("#hdn_del_unit_id").val(data);
  }

  function editDataRef(data){
    var loader = $('#loader');
    loader.show();
    $.ajax({
	    url: '{{ url("transaction/order-references") }}'+'/'+data,
      method:"GET",
		  success:function(data){
        loader.hide();
        $('#id_ref').val(data.id);
        $('#reference_number').val(data.reference_number);
        $('#colly_ref').val(data.colly);
        $('#description_ref').val(data.description);
        $('#action-ref').val('edit');
	    },
      error: function(data){
        loader.hide();
        console.log(data);
        alert(data);
      }
	  });
  }

  function editDataUnit(data){
    var loader = $('#loader');
    loader.show();
    $.ajax({
	    url: '{{ url("transaction/order-units") }}'+'/'+data,
      method:"GET",
		  success:function(data){
        loader.hide();
        $('#id_unit').val(data.id);
        $('#colly_unit').val(data.colly);
        $('#length_unit').val(data.length);
        $('#width_unit').val(data.width);
        $('#height_unit').val(data.height);
        $('#kg_unit').val(data.kilogram);
        $('#volume_unit').val(data.volume);
        $('#divider_unit').val(data.divider);
        $('#action-unit').val('edit');
	    },
      error: function(data){
        loader.hide();
        console.log(data);
        alert(data);
      }
	  });
  }

  /*function getListAgent()
  {
    var spinner = $('#loader');
    spinner.show();
    //get list agent based area
    var agents_url = "{{ url('master/agents/city') }}/" + "{{ $order->destinations->id}}";
    $.ajax({
      url: agents_url,
      dataType: 'json',
      success: function( data ) {
        if(data.length > 0){
          var temp = [];
          $.each(data, function(key, value) {
            temp.push({v:value, k: key});
          }); 
          $('#order_agent').empty();        
          $('#order_agent').append('<option value="0"> - Pilih - </option>'); 
          $.each(temp, function(key, obj) {
            $('#order_agent').append('<option value="A' + obj.v.id +'">' + obj.v.agent_name + '</option>');           
          });

          //get list branchs by city
          var branchs_url = "{{ url('master/branchs/city') }}/" + "{{ $order->destinations->id}}";
          $.ajax({
            url: branchs_url,
            dataType: 'json',
            success: function( data ) {
              spinner.hide();
              if(data.length > 0){
                var temp = [];
                $.each(data, function(key, value) {
                  temp.push({v:value, k: key});
                }); 
                $.each(temp, function(key, obj) {
                  $('#order_agent').append('<option value="B' + obj.v.id +'">' + obj.v.branch_code + ' - ' + obj.v.branch_name + '</option>');           
                });
                $('divx').hide();
              }else{
                spinner.hide();
                $('#agentInfo').text('Tidak ada data master cabang yang cocok di kota tujuan STT ini');
                //alert('Gagal mendapatkan data master cabang');
              }
            },
            error: function (jqXHR, exception) {
              spinner.hide();
              alertError(jqXHR.status, exception, jqXHR.responseText);
            }
          });
          $('divx').hide();
        }else{
          spinner.hide();
          $('#agentInfo').text('Tidak ada data master agent yang cocok di kota tujuan STT ini');
          //alert('Gagal mendapatkan data master agents');
        }
      },
      error: function (jqXHR, exception) {
        spinner.hide();
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  }*/

  /*function getListAgentOrigin()
  {
    var spinner = $('#loader');
    spinner.show();
    //get list agent based area
    var agents_url = "{{ url('master/agents/city') }}/" + "{{ $order->origins->id}}";
    //alert(agents_url);
    $.ajax({
      url: agents_url,
      dataType: 'json',
      success: function( data ) {
        if(data.length > 0){
          var temp = [];
          $.each(data, function(key, value) {
            temp.push({v:value, k: key});
          }); 
          $('#order_agent').empty();        
          $('#order_agent').append('<option value="0"> - Pilih - </option>'); 
          $.each(temp, function(key, obj) {
            $('#order_agent').append('<option value="A' + obj.v.id +'">' + obj.v.agent_code + ' - ' + obj.v.agent_name + '  (' + obj.v.areas.area_name + ')</option>');           
          });

          //get list branchs by city
          var branchs_url = "{{ url('master/branchs/city') }}/" + "{{ $order->origins->id}}";
          $.ajax({
            url: branchs_url,
            dataType: 'json',
            success: function( data ) {
              spinner.hide();
              if(data.length > 0){
                var temp = [];
                $.each(data, function(key, value) {
                  temp.push({v:value, k: key});
                }); 
                $.each(temp, function(key, obj) {
                  $('#order_agent').append('<option value="B' + obj.v.id +'">' + obj.v.branch_code + ' - ' + obj.v.branch_name + '</option>');           
                });
                $('divx').hide();
              }else{
                spinner.hide();
                $('#agentInfo').text('Tidak ada data master cabang yang cocok di kota asal STT ini');
                //alert('Gagal mendapatkan data master cabang asal');
              }
            },
            error: function (jqXHR, exception) {
              spinner.hide();
              alertError(jqXHR.status, exception, jqXHR.responseText);
            }
          });
          $('divx').hide();
        }else{
          spinner.hide();
          $('#agentInfo').text('Tidak ada data master agent yang cocok di kota asal STT ini');
          //alert('Gagal mendapatkan data master agents asal');
        }
      },
      error: function (jqXHR, exception) {
        spinner.hide();
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  }*/

  function getListAgentByCityID(city_id)
  {
    var spinner = $('#loader');
    spinner.show();
    //get list agent based area
    var agents_url = "{{ url('master/agents/city') }}/" + city_id; //+ "/address";
    //alert(agents_url);
    $.ajax({
      url: agents_url,
      dataType: 'json',
      success: function( data ) {
        $('#order_agent').empty();        
        $('#order_agent').append('<option value="0"> - Pilih - </option>'); 
        
        if(data.length > 0){
          //$('#origin_agent').val($('#city_agent').val());
          //$('#origin_agent').trigger('change');

          var temp = [];
          $.each(data, function(key, value) {
            temp.push({v:value, k: key});
          }); 
          
          $.each(temp, function(key, obj) {
            $('#order_agent').append('<option value="A' + obj.v.id +'">' + obj.v.agent_name + '</option>');           
          });

          //get list branchs by city
          var branchs_url = "{{ url('master/branchs/city') }}/" + city_id;
          $.ajax({
            url: branchs_url,
            dataType: 'json',
            success: function( data ) {
              spinner.hide();
              if(data.length > 0){
                var temp = [];
                $.each(data, function(key, value) {
                  temp.push({v:value, k: key});
                }); 
                $.each(temp, function(key, obj) {
                  $('#order_agent').append('<option value="B' + obj.v.id +'">' + obj.v.branch_code + ' - ' + obj.v.branch_name + '</option>');           
                });
                $('divx').hide();
              }else{
                spinner.hide();
                $('#agentInfo').text('Tidak ada data master cabang yang cocok di kota terpilih');
                //alert('Gagal mendapatkan data master cabang');
              }
            },
            error: function (jqXHR, exception) {
              spinner.hide();
              alertError(jqXHR.status, exception, jqXHR.responseText);
            }
          });
          $('divx').hide();
        }else{
          spinner.hide();
          $('#agentInfo').text('Tidak ada data master agent yang cocok di kota terpilih');
          //alert('Gagal mendapatkan data master agent');
        }
      },
      error: function (jqXHR, exception) {
        spinner.hide();
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  }

  function getListAgentCities(agent_id)
  {
    if(agent_id ==  "" || agent_id == null || agent_id === undefined ){
      return false;
    }else{
      var spinner = $('#loader');
      spinner.show();
      var cities_url = "{{ url('master/agent-cities/agent') }}/" + agent_id.substring(1);
      //alert(cities_url);
      $.ajax({
        url: cities_url,
        dataType: 'json',
        success: function( data ) {
          $('#origin_agent').empty();        
          $('#origin_agent').append('<option value=""> - Pilih - </option>'); 
          
          $('#destination_agent').empty();        
          $('#destination_agent').append('<option value=""> - Pilih - </option>'); 
          spinner.hide();
          if(data.length > 0){
            var temp = [];
            $.each(data, function(key, value) {
              temp.push({v:value, k: key});
            }); 
            
            $.each(temp, function(key, obj) {
              $('#origin_agent').append('<option value="' + obj.v.city_id +'">' + obj.v.cities.city_name + '</option>');
              $('#destination_agent').append('<option value="' + obj.v.city_id +'">' + obj.v.cities.city_name + '</option>');           
            });
          }else{
            spinner.hide();
            $('#agentInfo').text('Tidak ada data kota cakupan agent');
          }
        },
        error: function (jqXHR, exception) {
          spinner.hide();
          alertError(jqXHR.status, exception, jqXHR.responseText);
        }
      });
    }
  }

  function calcVolume(){
    var length = decimalCalc($('#length_unit').val());
    length = (length * 10) / 10;
    console.log(length);

    var width = decimalCalc($('#width_unit').val());
    width = (width * 10) / 10;
    console.log(width);

    var height = decimalCalc($('#height_unit').val());
    height = (height * 10) / 10;
    console.log(height);

    var divider = decimalCalc($('#divider_unit').val());
    divider = (divider * 10) / 10;
    console.log(divider);

    var result = (length * width * height / divider);
    result = (result * 10) / 10;
    result = replaceWithComma(result);
    console.log(result);
    $('#volume_unit').val(result);
  }

$(function(){
  'use strict'

  var ord_status = <?php echo "'".$order->last_status."'"; ?>;
  var ord_status_acc = <?php echo "'".$order->last_status_acc."'"; ?>;

  $('#asal').on('change', function () {
    //call via on change
    if($("#via").val() != ""){
        $("#via").trigger("change");
    }
  });

  /*$('#retur').change(function () {
    if($("#retur").prop("checked")){
      getListAgentOrigin();
    }else{
      getListAgent();
    }
  });*/

  //$("#by_area").prop("checked",true);

  /*$('#by_area').change(function () {
    if($("#by_area").prop("checked")){
      getListAgent();
    }
  });*/

  $('#city_agent').on('change', function () {
    if($("#city_agent").val() != ""){
      getListAgentByCityID($("#city_agent").val());
      //$("#by_area").prop("checked",false);
    }
  });

  $('#order_agent').on('change', function () {
    if($("#order_agent").val() != ""){
      getListAgentCities($("#order_agent").val());
    }
  });

  //normalize data
  $('#cogs_price').val(decimalFormat($('#cogs_price').val()));
  $('#real_price').val(decimalFormat($('#real_price').val()));
  $('#price').val(decimalFormat($('#price').val()));
  //alert($('#real_price').val());

  /*if(ord_status_acc != "Sales"){
    getListAgent();
  }*/

  $('#packing_cost').mask("#.##0,00", {reverse: true});
  $('#insurance_fee').mask("#.##0,00", {reverse: true});
  $('#total_kg').mask("#.##0,00", {reverse: true});

  $('#length_unit').mask("#.##0,00", {reverse: true});
  $('#width_unit').mask("#.##0,00", {reverse: true});
  $('#height_unit').mask("#.##0,00", {reverse: true});
  $('#kg_unit').mask("#.##0,00", {reverse: true});
  $('#volume_unit').mask("#.##0,00", {reverse: true});

  //Initialize Select2 Elements
  $('.select2bs4').select2({
      theme: 'bootstrap4'
  });

  $('#action-ref').val('add');
  $('#action-agent').val('add');
  $('#action-unit').val('add');

  $("#total_kg").on("input", function(e) {
    var input = $(this);
    var val = input.val();

    if (input.data("lastval") != val) {
        input.data("lastval", val);

        //your change action goes here 
        //console.log(val);
        if($('#service_groups').val() == 1){
            //reguler
            var result = decimalCalc($('#real_price').val()) * decimalCalc(val);
        }else{
            var result = decimalCalc($('#real_price').val());
        }

        console.log('real price:'+$('#real_price').val());
        console.log('result:'+result);
        $("#price").val(result);
        $('#price').mask("#.##0,00", {reverse: true});
        $('#price').change(function()
        {
        //alert("value changed"); //ignored
        });
    }
  });

  $("#length_unit").on("input", function(e) {
    var input = $(this);
    var val = input.val();

    if (input.data("lastval") != val) {
        input.data("lastval", val);

        //your change action goes here 
        console.log(val);
        calcVolume();
    }
  });

  $("#width_unit").on("input", function(e) {
    var input = $(this);
    var val = input.val();

    if (input.data("lastval") != val) {
        input.data("lastval", val);

        //your change action goes here 
        console.log(val);
        calcVolume();
    }
  });

  $("#height_unit").on("input", function(e) {
    var input = $(this);
    var val = input.val();

    if (input.data("lastval") != val) {
        input.data("lastval", val);

        //your change action goes here 
        console.log(val);
        calcVolume();
    }
  });

  $("#divider_unit").on("input", function(e) {
    var input = $(this);
    var val = input.val();

    if (input.data("lastval") != val) {
        input.data("lastval", val);

        //your change action goes here 
        console.log(val);
        calcVolume();
    }
  });

  $('#btn_print').click(function(){
    var url = "{{ url('transaction/orders') }}/{{ $no }}/print-pdf";
    window.open(url,'_blank');
  });

  $('#btn_print_colly').click(function(){
    var url = "{{ url('transaction/orders') }}/{{ $no }}/print-pdf-colly";
    window.open(url,'_blank');
  });

  $('#btn_print_list_colly').click(function(){
    var url = "{{ url('transaction/orders') }}/{{ $no }}/print-pdf-list-colly";
    window.open(url,'_blank');
  });

  //referensi
  $('#table_ref').DataTable({
    dom: 'Bfrtip',
    buttons: [
      {
        extend: 'copyHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file"></i> Copy Data',
        exportOptions: {
          columns: [ 0, 1, 2 ]
        }
      },
      {
        extend: 'excelHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file-excel"></i> Export Excel',
        exportOptions: {
          columns: [ 0, 1, 2 ],
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
    },
    processing: true,
    serverSide: true,
    ajax: {
      url: '{{ url("transaction/order-references/datatable") }}/{{ $no }}',
      type: 'GET',
    },
    columns: [
      { data: 'reference_number', name: 'reference_number' },
      { data: 'colly', name: 'colly' },
      { data: 'description', name: 'description' },
      {
        data: 'id',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data !== "") {
            var button = '<div class="dropdown d-inline">';
            button += '<button class="btn btn-sm btn-brand-02 btn-uppercase mg-l-5 dropdown-toggle" type="button" id="btnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih</button>';
            button += '<div class="dropdown-menu">';
            button += '<a class="dropdown-item has-icon" href="#" onClick="editDataRef('+ data +');"><i class="fa fa-edit"></i> Ubah</a>';
            button += '<a class="dropdown-item has-icon" href="#" onClick="deleteDataRef('+ data +');"><i class="fa fa-trash-alt"></i> Hapus</a>';
            button += '</div></div>';
            return button;
          } else {
            return '';
          }
        }
      },
    ]
  });

  $("#btn_save_ref").click(function (e) {
    e.preventDefault();
    if($('#action-ref').val() == "add"){
      var action = "{{ route('order-references.store') }}";
    }else{
      var action = "{{ route('order-references.update') }}";
    }

    var form_data = new FormData();
    form_data.append('reference_number', $('#reference_number').val());
    form_data.append('colly', $('#colly_ref').val());
    form_data.append('description', $('#description_ref').val());
    form_data.append('order_number', '{{ $no }}');
    form_data.append('id_ref', $('#id_ref').val());
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
        $('#btn_save_ref').hide();
        $('#btn_save_ref_wait').show();
        //showPreloader();
      },
      complete: function () {
        $('#btn_save_ref').show();
        $('#btn_save_ref_wait').hide();
        //hidePreloader();
      },
      success: function (data) {
        console.log(data);
        $('#table_ref').DataTable().ajax.reload();
        $('#action-ref').val('add');
        $('#id_ref').val('');
        $('#colly_ref').val('');
        $('#reference_number').val('');
        $('#description_ref').val('');
      },
      error: function (jqXHR, exception) {
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });

  $("#frm_ref_del").submit(function (e) {
    e.preventDefault();
    var action = $(this).attr('action');
    var datas = new FormData($("#frm_ref_del")[0]);
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
        $("#frm_del_ref_submit").hide();
        $("#frm_del_ref_submit_wait").show();
      },
      complete: function () {
        $("#frm_del_ref_submit").show();
        $("#frm_del_ref_submit_wait").hide();
      },
      success: function (data) {
        $("#modal_ref_delete").modal("hide");
        $('#table_ref').DataTable().ajax.reload();
      },
      error: function (jqXHR, exception) {
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });

  //agent
  $('#table_agent').DataTable({
    dom: 'Bfrtip',
    buttons: [
      {
        extend: 'copyHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file"></i> Copy Data',
        exportOptions: {
          columns: [ 0, 1, 2 ]
        }
      },
      {
        extend: 'excelHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file-excel"></i> Export Excel',
        exportOptions: {
          columns: [ 0, 1, 2 ],
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
    },
    processing: true,
    serverSide: true,
    ajax: {
      url: '{{ url("transaction/order-agents/datatable") }}/{{ $no }}',
      type: 'GET',
    },
    columns: [
      { data: 'agent_code', name: 'agent_code' },
      { data: 'agent_name', name: 'agent_name' },
      { data: null,
        render: function ( data, type, row ) {
          return row.origin + ' - ' + row.destination;
        }
      },
      { data: 'sequence', name: 'sequence' },
      {
        data: 'id',
        orderable: false,
        mRender: function (data, type, obj) {
          //if (data !== "" && ord_status_acc != "Sales") {
          if (data !== "" && ord_status == "Open") {
            var button = '<div class="dropdown d-inline">';
            button += '<button class="btn btn-sm btn-brand-02 btn-uppercase mg-l-5 dropdown-toggle" type="button" id="btnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih</button>';
            button += '<div class="dropdown-menu">';
            //button += '<a class="dropdown-item has-icon" href="#" onClick="editDataAgent('+ data +');"><i class="fa fa-edit"></i> Ubah</a>';
            button += '<a class="dropdown-item has-icon" href="#" onClick="deleteDataAgent('+ data +');"><i class="fa fa-trash-alt"></i> Hapus</a>';
            button += '</div></div>';
            return button;
          } else {
            return '';
          }
        }
      },
    ]
  });

  $("#btn_save_agent").click(function (e) {
    e.preventDefault();
    if($('#action-agent').val() == "add"){
      var action = "{{ route('order-agents.store') }}";
    }else{
      var action = "{{ route('order-agents.update') }}";
    }

    if($('#order_agent').val() == "" || $('#order_agent').val() === undefined){
      alert("Agent harus di-pilih");
    }else if($('#sequence').val() == "" || $('#sequence').val() === undefined || $('#sequence').val() == "0"){
      alert("Nomor urutan harus di-isi");
    }else {

      var form_data = new FormData();
      form_data.append('agent_id', $('#order_agent').val());
      form_data.append('order_number', '{{ $no }}');
      form_data.append('id_agent', $('#id_agent').val());
      form_data.append('origin', $('#origin_agent').val());
      form_data.append('destination', $('#destination_agent').val());
      form_data.append('sequence', $('#sequence').val());
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
          $('#btn_save_agent').hide();
          $('#btn_save_agent_wait').show();
          //showPreloader();
        },
        complete: function () {
          $('#btn_save_agent').show();
          $('#btn_save_agent_wait').hide();
          //hidePreloader();
        },
        success: function (data) {
          console.log(data);
          $('#table_agent').DataTable().ajax.reload();
          $('#action-agent').val('add');
          $('#id_agent').val('');
          $('#sequence').val('');
          $('#order_agent').val('');
          $('#order_agent').trigger('change');
          $('#city_agent').val('');
          $('#city_agent').trigger('change');
          $('#origin_agent').val('');
          $('#origin_agent').trigger('change');
          $('#destination_agent').val('');
          $('#destination_agent').trigger('change');
          //$("#by_area").prop("checked",true);
        },
        error: function (jqXHR, exception) {
          alertError(jqXHR.status, exception, jqXHR.responseText);
        }
      });
    }
  });
  
  $("#frm_agent_del").submit(function (e) {
    e.preventDefault();
    var action = $(this).attr('action');
    var datas = new FormData($("#frm_agent_del")[0]);
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
        $("#frm_del_agent_submit").hide();
        $("#frm_del_agent_submit_wait").show();
      },
      complete: function () {
        $("#frm_del_agent_submit").show();
        $("#frm_del_agent_submit_wait").hide();
      },
      success: function (data) {
        $("#modal_agent_delete").modal("hide");
        $('#table_agent').DataTable().ajax.reload();
      },
      error: function (jqXHR, exception) {
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });

  //$('#service_groups').on('change', function () {

  $("#frm-edit").submit(function (e) {
    e.preventDefault();
    /*if($('#price').val() == ""){
        alert('Data belum lengkap, asal & tujuan belum memiliki harga');
        return false;
    }*/

    if($('#total_kg').val() == "" || $('#total_kg').val() == "0"){
        alert('Berat (kg) tidak boleh kosong');
        return false;
    }

    if($('#total_colly').val() == "" || $('#total_colly').val() == "0"){
        alert('Colly tidak boleh kosong');
        return false;
    }

    var action = "{{ route('orders.update') }}";
    //var datas = new FormData($("#frm-add")[0]);
    var form_data = new FormData();
    form_data.append('id', $('#order_id').val());
    form_data.append('order_number', $('#order_number').val());
    form_data.append('awb_no', $('#awb_no').val());
    form_data.append('total_kg', decimalFormat($('#total_kg').val()) );
    form_data.append('total_colly', $('#total_colly').val());
    form_data.append('description', $('#description').val());
    form_data.append('contains', $('#contains').val());
    /*form_data.append('customer_id', $('#customer').val());
    form_data.append('customer_branch_id', $('#customer_branch').val());
    form_data.append('service_id', $('#via').val());
    form_data.append('origin', $('#asal').val());
    form_data.append('destination', $('#tujuan').val());
    */
    form_data.append('service_id', $('#via').val());
    form_data.append('service_group_id', $('#service_groups').val());
    form_data.append('truck_type_id', $('#truck_types').val());
    form_data.append('trucking_price_id', $('#trucking_price_id').val());
    form_data.append('customer_master_price_id', $('#customer_master_price_id').val());
    //order costs
    form_data.append('price', $('#price').val() );
    form_data.append('cogs_price', $('#cogs_price').val() );
    //form_data.append('tax', $('#tax').val());
    form_data.append('insurance_fee', decimalFormat($('#insurance_fee').val()) );
    //form_data.append('discount', $('#discount').val());
    form_data.append('packing_cost', decimalFormat($('#packing_cost').val()) );

    form_data.append('_token', '{{csrf_token()}}');

    //for (var pair of form_data.entries()) {
    //    console.log(pair[0]+ ', ' + pair[1]); 
    //}

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
            alert("Berhasil mengupdate data");
            //console.log(result);
            //window.location.href = "{{ url('transaction/orders') }}/"+$('#order_number').val();
        },
        error: function (jqXHR, exception) {
          alertError(jqXHR.status, exception, jqXHR.responseText);
        }
    });
  });

  $('#btn_closing').click(function(){
    if (confirm("Anda yakin ingin closing transaksi ini") == true) {
      var action = "{{ route('orders.closing') }}";
      var form_data = new FormData();
      form_data.append('id', $('#order_id').val());
      form_data.append('order_number', $('#order_number').val());
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
              window.location.href = "{{ url('transaction/orders') }}/"+$('#order_number').val();
          },
          error: function (jqXHR, exception) {
            alertError(jqXHR.status, exception, jqXHR.responseText);
          }
      });
    }
  });

  var ord_status = <?php echo "'".$order->last_status."'"; ?>;
  //alert(ord_status);
  //unit
  $('#table_unit').DataTable({
    dom: 'Bfrtip',
    buttons: [
      {
        extend: 'copyHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file"></i> Copy Data',
        exportOptions: {
          columns: [ 0, 1, 2, 3, 4, 5, 6]
        }
      },
      {
        extend: 'excelHtml5',
        className: 'btn-sm btn-sm btn-brand-02',
        text: '<i class="fas fa-file-excel"></i> Export Excel',
        exportOptions: {
          columns: [ 0, 1, 2, 3, 4, 5, 6],
          format: {
              body: function(data, row, column, node) {
                  data = $('<p>' + data + '</p>').text();
                  data = $.isNumeric(data.replace(',', '.')) ? data.replace(',', '.') : data;
                  //data = data.replace('.', ',');
                  return data;
              }
          },
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
    },
    processing: true,
    serverSide: true,
    ajax: {
      url: '{{ url("transaction/order-units/datatable") }}/{{ $no }}',
      type: 'GET',
    },
    columns: [
      { data: 'colly', name: 'colly' },
      { data: 'kilogram', name: 'kilogram' },
      { data: 'volume', name: 'volume' },
      { data: 'divider', name: 'divider' },
      { data: 'length', name: 'length' },
      { data: 'width', name: 'width' },
      { data: 'height', name: 'height' },
      {
        data: 'id',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data !== "" && ord_status == "Open" && ord_status_acc != "Sales") {
            var button = '<div class="dropdown d-inline">';
            button += '<button class="btn btn-sm btn-brand-02 btn-uppercase mg-l-5 dropdown-toggle" type="button" id="btnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih</button>';
            button += '<div class="dropdown-menu">';
            button += '<a class="dropdown-item has-icon" href="#" onClick="editDataUnit('+ data +');"><i class="fa fa-edit"></i> Ubah</a>';
            button += '<a class="dropdown-item has-icon" href="#" onClick="deleteDataUnit('+ data +');"><i class="fa fa-trash-alt"></i> Hapus</a>';
            button += '</div></div>';
            return button;
          } else {
            return '';
          }
        }
      },
    ]
  });

  $("#btn_save_unit").click(function (e) {
    e.preventDefault();
    if($('#action-unit').val() == "add"){
      var action = "{{ route('order-units.store') }}";
    }else{
      var action = "{{ route('order-units.update') }}";
    }

    var form_data = new FormData();
    form_data.append('colly', $('#colly_unit').val());
    form_data.append('length', decimalFormat($('#length_unit').val()) );
    form_data.append('width', decimalFormat($('#width_unit').val()) );
    form_data.append('height', decimalFormat($('#height_unit').val()) );
    form_data.append('kilogram', decimalFormat($('#kg_unit').val()) );
    form_data.append('volume', decimalFormat($('#volume_unit').val()) );
    form_data.append('divider', decimalFormat($('#divider_unit').val()) );
    form_data.append('order_number', '{{ $no }}');
    form_data.append('id_unit', $('#id_unit').val());
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
        $('#btn_save_unit').hide();
        $('#btn_save_unit_wait').show();
        //showPreloader();
      },
      complete: function () {
        $('#btn_save_unit').show();
        $('#btn_save_unit_wait').hide();
        //hidePreloader();
      },
      success: function (data) {
        console.log(data);
        $('#table_unit').DataTable().ajax.reload();
        $('#action-unit').val('add');
        $('#id_unit').val('');
        $('#colly_unit').val('');
        $('#length_unit').val('');
        $('#width_unit').val('');
        $('#height_unit').val('');
        $('#kg_unit').val('');
        $('#volume_unit').val('');
        $('#divider_unit').val('');
      },
      error: function (jqXHR, exception) {
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });

  $("#frm_unit_del").submit(function (e) {
    e.preventDefault();
    var action = $(this).attr('action');
    var datas = new FormData($("#frm_unit_del")[0]);
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
        $("#frm_del_unit_submit").hide();
        $("#frm_del_unit_submit_wait").show();
      },
      complete: function () {
        $("#frm_del_unit_submit").show();
        $("#frm_del_unit_submit_wait").hide();
      },
      success: function (data) {
        $("#modal_unit_delete").modal("hide");
        $('#table_unit').DataTable().ajax.reload();
      },
      error: function (jqXHR, exception) {
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });

  $("#btn_import_ref").click(function (e) {
    e.preventDefault();
    var action = "{{ route('order-references.importExcel') }}";
    var form_data = new FormData();
    if ($('#file').get(0).files.length > 0) {
      var file_data = $('#file').prop('files')[0];  
      form_data.append('file', file_data);
    }else{
      alert('File tidak boleh kosong');
      return false;
    }
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
        $('#btn_import_ref').hide();
        $('#btn_import_ref_wait').show();
        //showPreloader();
      },
      complete: function () {
        $('#btn_import_ref').show();
        $('#btn_import_ref_wait').hide();
        //hidePreloader();
      },
      success: function (data) {
        console.log(data);
        $('#table_ref').DataTable().ajax.reload();
        $('#action-ref').val('add');
        $('#id_ref').val('');
        $('#colly_ref').val('');
        $('#reference_number').val('');
        $('#description_ref').val('');
      },
      error: function (jqXHR, exception) {
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });
});
</script>
@endsection