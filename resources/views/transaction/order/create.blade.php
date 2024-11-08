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
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">Tambah Order (Buat STT Baru)</h4>
          </div>
        </div>
      </div><!-- container -->
    </div><!-- content -->

    <div class="content">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="row">
        <div class="col-lg-12">
        <form method="post" action="#" enctype="multipart/form-data" id="frm-add">
            @csrf
            <input type="hidden" id="cogs_price" value="0">
            <input type="hidden" id="customer_master_price_id" value="">
            <input type="hidden" id="trucking_price_id" value="">
            <input type="hidden" id="administrative_cost" name="administrative_cost" value="0">
            <input type="hidden" id="insurance_fee" name="insurance_fee" value="0">
            <input type="hidden" id="other_cost" name="other_cost" value="0" >
            <input type="hidden" id="price_code" name="price_code" value="0">
            <input type="hidden" id="real_price" name="real_price" value="0">
            <input type="hidden" id="price" name="price" value="0" >
            <div class="row">
                <label for="awb_no" class="col-sm-2 col-form-label">No STT Manual *</label>
                <div class="col-sm-4">
                    <input type="text" maxlength="11" class="form-control form-control-sm" name="awb_no" id="awb_no" required>
                </div>
                <label for="pickup_date" class="col-sm-1 col-form-label">Tgl Pickup *</label>
                <div class="col-sm-2">
                    <input type="date" class="form-control form-control-sm datetimepicker-input" autocomplete="off" id="pickup_date" required>
                </div>
                <!--<label for="estimation" class="col-sm-1 col-form-label">Estimasi</label>
                <div class="col-sm-2">
                    <input type="number" class="form-control form-control-sm" name="estimation" id="estimation" readonly>
                </div>-->
            </div>
            <div class="row mt-2">
                <label for="customer" class="col-sm-2 col-form-label">Customer *</label>
                <div class="col-sm-4">
                    <select name="customer" id="customer" class="form-control form-control-sm select2bs4" style="width: 100%;" required>
                        <option value="">- Pilih -</option>
                        @foreach($customers as $customer)
                        <option value="{{$customer->id}}">{{$customer->customer_name}}</option>
                        @endforeach
                    </select>
                </div>
                <label for="customer_branch" class="col-sm-1 col-form-label">Cabang *</label>
                <div class="col-sm-5">
                    <select name="customer_branch" id="customer_branch" class="form-control form-control-sm select2bs4" style="width: 100%;" required>
                        <option value="">- Pilih -</option>
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <label for="asal" class="col-sm-2 col-form-label">Asal *</label>
                <div class="col-sm-4">
                    <select name="asal" id="asal" class="form-control form-control-sm  select2bs4" style="width: 100%;" required>
                        <option value="">- Pilih -</option>
                        @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->city_code}} - {{$city->city_name}}</option>
                        @endforeach
                    </select>
                </div>
                <label for="tujuan" class="col-sm-1 col-form-label">Tujuan *</label>
                <div class="col-sm-4">
                    <select name="tujuan" id="tujuan" class="form-control form-control-sm" style="width: 100%;" readonly required>
                        <option value="">-</option>
                    </select>
                </div>
            </div>
            <hr>
            <div class="row mt-2">
                <label for="service_groups" class="col-sm-2 col-form-label">Jenis Layanan *</label>
                <div class="col-sm-4">
                    <select name="service_groups" id="service_groups" class="form-control form-control-sm" style="width: 100%;" required>
                        <option value="">- Pilih -</option>
                        @foreach($service_groups as $service_group)
                        <option value="{{$service_group->id}}">{{$service_group->group_name}}</option>
                        @endforeach
                    </select>
                </div>
                <label for="truck_types" class="col-sm-1 col-form-label">Tipe Truck</label>
                <div class="col-sm-2">
                    <select name="truck_types" id="truck_types" class="form-control form-control-sm select2bs4" style="width: 100%;" " required>
                        <option value="">- Pilih -</option>
                    </select>
                </div>
                <label for="via" class="col-sm-1 col-form-label">Via</label>
                <div class="col-sm-2">
                    <select name="via" id="via" class="form-control form-control-sm select2bs4" style="width: 100%;" " required>
                        <option value="">- Pilih -</option>
                    </select>
                </div>
            </div>
            <!--<div class="row mt-2">
                <label for="weight_type" class="col-sm-2 col-form-label">Jenis Berat *</label>
                <div class="col-sm-2">
                    <select name="weight_type" id="weight_type" class="form-control form-control-sm select2bs4" style="width: 100%;" " required>
                        <option value="">- Pilih -</option>
                        <option value="REAL">Real</option>
                        <option value="KILOGRAM">Kilo</option>
                        <option value="VOLUME">Volume</option>
                    </select>
                </div>
                <label for="length" class="col-sm-1 col-form-label">P (cm)</label>
                <div class="col-sm-1">
                    <input type="number" id="length" name="length" class="form-control form-control-sm" autocomplete="off" value="0" >
                </div>
                <label for="width" class="col-sm-1 col-form-label">L (cm)</label>
                <div class="col-sm-1">
                    <input type="number" id="width" name="width" class="form-control form-control-sm" autocomplete="off"value="0"  >
                </div>
                <label for="height" class="col-sm-1 col-form-label">T (cm)</label>
                <div class="col-sm-1">
                    <input type="number" id="height" name="height" class="form-control form-control-sm" autocomplete="off" value="0" >
                </div>
            </div>-->
            <div class="row mt-2">
                <label for="payment_type" class="col-sm-2 col-form-label">Metode Pembayaran *</label>
                <div class="col-sm-4">
                    <select name="payment_type" id="payment_type" class="form-control form-control-sm select2bs4" style="width: 100%;" " required>
                        <option value="">- Pilih -</option>
                        @foreach($payment_types as $payment_type)
                        <option value="{{$payment_type->payment_name}}">{{$payment_type->payment_name}}</option>
                        @endforeach
                    </select>
                </div>
                <label for="kilogram" class="col-sm-1 col-form-label">Berat (kg) *</label>
                <div class="col-sm-2">
                    <input type="text" id="kilogram" name="kilogram" class="form-control form-control-sm" autocomplete="off" value="0" required>
                </div>
                <label for="total_colly" class="col-sm-1 col-form-label">Colly *</label>
                <div class="col-sm-2">
                    <input type="number" id="total_colly" name="total_colly" class="form-control form-control-sm" autocomplete="off" value="0" required>
                </div>
            </div>

            <hr>

            <!--<div class="row mt-2">
                <label for="agents" class="col-sm-2 col-form-label">Agent *</label>
                <div class="col-sm-4">
                    <select name="agents" id="agents" class="form-control form-control-sm select2bs4" style="width: 100%;" required>
                        <option value="">- Pilih -</option>
                    </select>
                </div>
                <label for="agent_price_code" class="col-sm-1 col-form-label">Kode Tarif</label>
                <div class="col-sm-2">
                    <input type="text" id="agent_price_code" name="agent_price_code" class="form-control form-control-sm" autocomplete="off" value="0" readonly>
                </div>
                <label for="agent_price" class="col-sm-1 col-form-label">Tarif</label>
                <div class="col-sm-2">
                    <input type="text" id="agent_price" name="agent_price" class="form-control form-control-sm" autocomplete="off" value="0" readonly>
                </div>
            </div>

            <hr>

            <div class="row mt-2">
                <label for="discount" class="col-sm-2 col-form-label">Diskon</label>
                <div class="col-sm-1">
                    <input type="text" id="discount" name="discount" class="form-control form-control-sm" autocomplete="off" value="0" >
                </div>
                <label for="package_fee" class="col-sm-2 col-form-label">Biaya Packing</label>
                <div class="col-sm-2">
                    <input type="text" id="package_fee" name="package_fee" class="form-control form-control-sm" autocomplete="off" readonly >
                </div>
                <label for="gross_total" class="col-sm-2 col-form-label">Gross Total</label>
                <div class="col-sm-2">
                    <input type="text" id="gross_total" name="gross_total" class="form-control form-control-sm" autocomplete="off" readonly >
                </div>
            </div>

            <div class="row mt-2">
                <label for="tax" class="col-sm-2 col-form-label">PPN %</label>
                <div class="col-sm-1">
                    <input type="text" id="tax" name="tax" class="form-control form-control-sm" autocomplete="off" value="0" >
                </div>
                <label for="tax_value" class="col-sm-2 col-form-label">Nilai PPN</label>
                <div class="col-sm-2">
                    <input type="text" id="tax_value" name="tax_value" class="form-control form-control-sm" autocomplete="off" readonly >
                </div>
                <label for="grand_total" class="col-sm-2 col-form-label">Grand Total</label>
                <div class="col-sm-2">
                    <input type="text" id="grand_total" name="grand_total" class="form-control form-control-sm" autocomplete="off" readonly >
                </div>
            </div>-->
            <div class="mt-4">
                <span class="float-md-right">
                    <a href="{{ url('transaction/orders') }}" id="btn_cancel" class="btn btn-sm btn-danger" type="button"><i class="fas fa-arrow-left"></i> Batal</a>
                    <button type="submit" id="btn_save" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-sm btn-brand-02" id="btn_save_wait" disabled
                    style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Menyimpan Data...</i>
                    </button>
                </span>
            </div>
        </form>
    </div><!-- col -->
    </div><!-- row -->
      
      </div><!-- container -->
    </div><!-- content -->

@endsection
@section('scripts')
<script src="{{ asset('plugins/jquery.mask.min.js') }}"></script>
@parent
<script>
    function clearDataPrice(){
        $('#customer_master_price_id').val('');
        $('#price_code').val('-');
        $('#cogs_price').val('');
        $('#price').val('');
        $('#real_price').val('');
        $('#administrative_cost').val('');
        $('#insurance_fee').val('');
        $('#other_cost').val('');
        $('#margin').val('');
    }

$(function(){
  'use strict'

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  $('#kilogram').mask("#.##0,00", {reverse: true});

  /*$("#kilogram").on("input", function(e) {
    var input = $(this);
    var val = input.val();

    if (input.data("lastval") != val) {
        input.data("lastval", val);

        //your change action goes here 
        console.log(val);
        if($('#service_groups').val() == 1){
            //reguler
            var result = decimalCalc($('#real_price').val()) * decimalCalc(val);
        }else{
            var result = decimalCalc($('#real_price').val());
        }
        result = decimalNormalize(result);
        console.log('real price:'+$('#real_price').val());
        console.log('result:'+result);
        $("#price").val(result);
        $('#price').mask("#.##0,00", {reverse: true});
        $('#price').change(function()
        {
        //alert("value changed"); //ignored
        });
    }
  });*/

  $('#asal').on('change', function () {
    //call via on change
    if($("#via").val() != ""){
        $("#via").trigger("change");
    }
  });

  $('#customer').on('change', function () {
    var spinner = $('#loader');
    spinner.show();
    $.ajax({
        url: "{{ url('master/customer-branchs') }}" + "/customer/" + $(this).val(),
        dataType: 'json',
        success: function( data ) {
            spinner.hide();
            $('#customer_branch').empty();
            $('#customer_branch').append('<option value="0"> - Pilih - </option>'); 
            if(data.length > 0){
                var temp = [];
                $.each(data, function(key, value) {
                    temp.push({v:value, k: key});
                });         
                $.each(temp, function(key, obj) {
                  $('#customer_branch').append('<option value="' + obj.v.id +'">' + obj.v.branch_code + ' - ' + obj.v.branch_name + '</option>');           
                });
              }else{
                alert('Customer ini belum memiliki data cabang');
              }
            }
        });
      
    });

    $('#customer_branch').on('change', function () {
    var spinner = $('#loader');
    spinner.show();
    $.ajax({
        url: "{{ url('master/customer-branchs') }}" + "/" + $(this).val(),
        dataType: 'json',
        success: function( data ) {
            spinner.hide();
            if(data){     
                $('#tujuan').empty();
                $('#tujuan').append('<option value="' + data.city_id +'">' + data.cities.city_code + ' - ' + data.cities.city_name + '</option>');    

                //get tarif lagi jika sudah dipilih sebelumnya
                if($('#service_groups').val() != "" && $('#asal').val() != ""){
                    $('#via').trigger('change');
                }
                //get list agent based area
                /*var agents_url = "{{ url('master/agents/city') }}/" + data.city_id;
                $.ajax({
                url: agents_url,
                dataType: 'json',
                    success: function( data ) {
                        spinner.hide();
                        console.log(agents_url);
                        console.log(data);
                        if(data.length > 0){
                            var temp = [];
                            $.each(data, function(key, value) {
                                temp.push({v:value, k: key});
                            }); 
                            $('#agents').empty();        
                            $('#agents').append('<option value="0"> - Pilih - </option>'); 
                            $.each(temp, function(key, obj) {
                                $('#agents').append('<option value="' + obj.v.id +'">' + obj.v.agent_code + ' - ' + obj.v.agent_name + '</option>');           
                            });
                        }else{
                            alert('Gagal mendapatkan data master agents');
                        }
                    }
                });*/
              }else{
                alert('Gagal mendapatkan data kota tujuan customer cabang');
              }
            }
        });
      
    });

    $('#service_groups').on('change', function () {
        var spinner = $('#loader');
        spinner.show();
        if($(this).val() == 1){
            //reguler
            $('#truck_types').empty();
            $('#truck_types').append('<option value="0"> - Pilih - </option>'); 
            $('#truck_types').prop('disabled', true);
            $.ajax({
                url: "{{ url('master/services/data') }}",
                dataType: 'json',
                success: function( data ) {
                    spinner.hide();
                    if(data.length > 0){
                        var temp = [];
                        $.each(data, function(key, value) {
                            temp.push({v:value, k: key});
                        }); 
                        $('#via').prop('disabled', false);
                        $('#via').empty();        
                        $('#via').append('<option value="0"> - Pilih - </option>'); 
                        $.each(temp, function(key, obj) {
                            $('#via').append('<option value="' + obj.v.id +'">' + obj.v.service_name + '</option>');           
                        });
                    }else{
                        alert('Gagal mendapatkan data master layanan');
                    }
                }
            });
        }else{
            //trucking
            $('#via').empty();
            $('#via').append('<option value="0"> - Pilih - </option>'); 
            $('#via').prop('disabled', true);
            $.ajax({
                url: "{{ url('master/truck-types/data') }}",
                dataType: 'json',
                success: function( data ) {
                    spinner.hide();
                    if(data.length > 0){
                        var temp = [];
                        $.each(data, function(key, value) {
                            temp.push({v:value, k: key});
                        }); 
                        $('#truck_types').prop('disabled', false);
                        $('#truck_types').empty();        
                        $('#truck_types').append('<option value="0"> - Pilih - </option>'); 
                        $.each(temp, function(key, obj) {
                            $('#truck_types').append('<option value="' + obj.v.id +'">' + obj.v.type_name + '</option>');           
                        });
                    }else{
                        alert('Gagal mendapatkan data master trucking');
                    }
                }
            });
        }
    });

    $('#truck_types').on('change', function () {
        if($('#asal').val() == "" || $('#asal').val() === undefined){
            alert('Pilih Customer dan Cabangnya dahulu');
        }else{
            clearDataPrice();
            var spinner = $('#loader');
            spinner.show();
            $.ajax({
                url: "{{ url('master/customer-trucking-prices') }}" + "/customer/" + $('#customer').val() + "/origin/" + $('#asal').val() + "/destination/" + $('#tujuan').val() + "/truck/" + $('#truck_types').val(),
                dataType: 'json',
                success: function( data ) {
                spinner.hide();
                    if(data != ""){  
                        $('#trucking_price_id').val(data.id);
                        //$('#price_code').val(data.price_code);
                        $('#price').val(decimalNormalize(data.price));
                        $('#cogs_price').val(decimalNormalize(data.cogs_price));
                        $('#real_price').val(decimalNormalize(data.price));
                        //$('#margin').val(decimalNormalize(data.margin));
                    }else{
                        alert('Gagal mendapatkan data master harga trucking');
                    }
                }
            });
        }
    });

    $('#via').on('change', function () {
        //alert($('#via').val());
        if($('#via').val() == "" || $('#via').val() == null || $('#via').val() === undefined){
            return false;
        }else{

        if($('#asal').val() == "" || $('#asal').val() === undefined){
            alert('Pilih Customer dan Cabangnya dahulu');
        }else{

            if($('#service_groups').val() == "1"){
                //reguler
                clearDataPrice();
                var spinner = $('#loader');
                spinner.show();
                $.ajax({
                url: "{{ url('master/customer-master-prices') }}" + "/customer/" + $('#customer').val() + "/origin/" + $('#asal').val() + "/destination/" + $('#tujuan').val() + "/service/" + $('#via').val(),
                dataType: 'json',
                success: function( data ) {
                    spinner.hide();
                    if(data != ""){   
                        if(data.status == "APPROVED"){
                            $('#customer_master_price_id').val(data.id);
                            $('#price_code').val(data.price_code);
                            $('#price').val(decimalNormalize(data.price));
                            $('#cogs_price').val(decimalNormalize(data.cogs_price));
                            $('#real_price').val(decimalNormalize(data.price));

                            //console.log(decimalNormalize(data.price));
                            /*$('#administrative_cost').val(data.administrative_cost);
                            $('#insurance_fee').val(data.insurance_fee);
                            $('#other_cost').val(data.other_cost);*/
                            $('#margin').val(decimalNormalize(data.margin));
                        }else{
                            
                            alert("Data tidak bisa dilanjutkan, data tarif ini belum disetujui");
                            $('#via').val('');
                            $('#via').trigger('change');
                        }
                    }else{
                        alert('Gagal mendapatkan data master harga reguler');
                    }
                    }
                });
            }else if($('#service_groups').val() == "3"){
                //trucking
            }else{
                //direct
            }
            
          }
        }
    });

    /*$('#agents').on('change', function () {
        var spinner = $('#loader');
        spinner.show();
        $.ajax({
        url: "{{ url('master/agent-master-prices') }}" + "/agent/" + $(this).val() + "/origin/" + $('#asal').val() + "/destination/" + $('#tujuan').val() + "/service/" + $("#via").val(),
        dataType: 'json',
        success: function( data ) {
            spinner.hide();
            console.log(data);
            if(data){    
                $('#agent_price_code').val(data.price_code);
                $('#agent_price').val(data.price);
              }else{
                alert('Gagal mendapatkan data master harga');
                $('#agent_price_code').val('-');
                $('#agent_price').val('');
              }
            }
        });
      
    });*/
  
  $("#frm-add").submit(function (e) {
    e.preventDefault();
    if($('#price').val() == ""){
        alert('Data belum lengkap, asal & tujuan belum memiliki harga');
        return false;
    }

    if($('#kilogram').val() == "" || $('#kilogram').val() == "0"){
        alert('Berat (kg) tidak boleh kosong');
        return false;
    }

    if($('#total_colly').val() == "" || $('#total_colly').val() == "0"){
        alert('Colly tidak boleh kosong');
        return false;
    }

    var action = "{{ route('orders.store') }}";
    //var datas = new FormData($("#frm-add")[0]);
    var form_data = new FormData();
    //var pickup_date = moment(new Date($('#pickup_date').val()).toISOString()).format("YYYY-MM-DD"); 
    form_data.append('pickup_date', $('#pickup_date').val());
    form_data.append('awb_no', $('#awb_no').val());
    form_data.append('customer_id', $('#customer').val());
    form_data.append('customer_branch_id', $('#customer_branch').val());
    form_data.append('service_id', $('#via').val());
    form_data.append('service_group_id', $('#service_groups').val());
    form_data.append('truck_type_id', $('#truck_types').val());
    form_data.append('origin', $('#asal').val());
    form_data.append('destination', $('#tujuan').val());
    form_data.append('customer_master_price_id', $('#customer_master_price_id').val());
    form_data.append('trucking_price_id', $('#trucking_price_id').val());
    form_data.append('total_kg', decimalFormat($('#kilogram').val()) );
    form_data.append('total_colly', $('#total_colly').val());
    form_data.append('payment_type', $('#payment_type').val());

    //order costs
    form_data.append('price', decimalFormat($('#price').val()) );
    form_data.append('cogs_price', decimalFormat($('#cogs_price').val()) );
    /*form_data.append('administrative_cost', $('#administrative_cost').val().replaceAll(",", ""));
    form_data.append('insurance_fee', $('#insurance_fee').val().replaceAll(",", ""));
    form_data.append('other_cost', $('#other_cost').val().replaceAll(",", ""));*/
    
    //order units
    /*form_data.append('weight_type', $('#weight_type').val());
    form_data.append('length', $('#length').val());
    form_data.append('width', $('#width').val());
    form_data.append('height', $('#height').val());*/
    

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
            //$('#btn_save').show();
            //$('#btn_save_wait').hide();
            //hidePreloader();
        },
        success: function (result) {
            //console.log(result);
            window.location.href = "{{ url('transaction/orders') }}/"+result.data;
        },
        error: function (jqXHR, exception) {
            $('#btn_save').show();
            $('#btn_save_wait').hide();
            alertError(jqXHR.status, exception, jqXHR.responseText);
        }
    });
  });

});
</script>
@endsection