@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Accounting</a></li>
                <li class="breadcrumb-item"><a href="#">Invoice Agent</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $invoice->bill_number }}</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">Detail Invoice {{ $invoice->bill_number }}</h4>
          </div>
        </div>
      </div><!-- container -->
    </div><!-- content -->

    <div class="content">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="row">
            <div class="col-lg-12">
                <form method="post" action="#" enctype="multipart/form-data" id="frm-edit">
                    @csrf
                    <input type="hidden" id="invoice_id" value="{{ $invoice->id }}">
                    <input type="hidden" id="bill_number" value="{{ $invoice->bill_number }}">
                    <input type="hidden" id="agent_id" value="{{ $invoice->agent_id }}">
                    <div class="row">
                        <label for="agent_name" class="col-sm-2 col-form-label">Nama Agent</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control form-control-sm" id="agent_name" value="{{ $invoice->agents->agent_name }}" readonly>
                        </div>
                        <label for="bill_receipt_date" class="col-sm-2 col-form-label">Tgl Terima Invoice *</label>
                        <div class="col-sm-2">
                            <input type="date" class="form-control form-control-sm datetimepicker-input" id="bill_receipt_date" value="{{ $invoice->bill_receipt_date }}">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="bill_number_manual" class="col-sm-2 col-form-label">No Invoice Agent *</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control form-control-sm" id="bill_number_manual" value="{{ $invoice->bill_number_manual }}">
                        </div>
                        <label for="bill_date" class="col-sm-2 col-form-label">Tgl Invoice *</label>
                        <div class="col-sm-2">
                            <input type="date" class="form-control form-control-sm datetimepicker-input" id="bill_date" name="bill_date" value="{{ $invoice->bill_date }}">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="due_date" class="col-sm-2 col-form-label">Tgl Jatuh Tempo *</label>
                        <div class="col-sm-2">
                            <input type="date" class="form-control form-control-sm datetimepicker-input" id="due_date" name="due_date" value="{{ $invoice->due_date }}">
                        </div>
                        <label for="payment_date" class="col-sm-2 col-form-label">Tgl Dibayar *</label>
                        <div class="col-sm-2">
                            <input type="date" class="form-control form-control-sm" id="payment_date" name="payment_date" value="{{ $invoice->payment_date }}">
                        </div>
                        <label for="subtotal" class="col-sm-2 col-form-label">Subtotal</label>
                        <div class="col-sm-2">
                            <input type="text" id="subtotal" class="form-control form-control-sm" value="{{ $invoice->subtotal }}" readonly>
                        </div>
                    </div>
                    <!--<div class="row mt-2">
                        <label for="total_colly" class="col-sm-2 col-form-label">Total Colly</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control form-control-sm" id="total_colly" value="{{ $invoice->total_colly }}" readonly>
                        </div>
                        <label for="total_volume" class="col-sm-2 col-form-label">Total Kg</label>
                        <div class="col-sm-2">
                            <input type="text" id="total_volume" asal="total_volume" class="form-control form-control-sm" value="{{ $invoice->total_volume }}" readonly>
                        </div>
                        
                    </div>-->
                    <div class="row mt-2">
                        <label for="income_tax" class="col-sm-2 col-form-label">PPN %</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control form-control-sm" id="income_tax" value="{{ $invoice->income_tax_percent }}">
                        </div>
                        <label for="income_taxs" class="col-sm-2 col-form-label">Nilai PPN</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control form-control-sm" id="income_taxs" value="{{ $invoice->income_tax }}" readonly>
                        </div>
                        <label for="dpp" class="col-sm-2 col-form-label">DPP</label>
                        <div class="col-sm-2">
                            <input type="text" id="dpp" class="form-control form-control-sm" value="{{ number_format($invoice->dpp,2,",",".") }}" readonly>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="tax" class="col-sm-2 col-form-label">PPH %</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control form-control-sm" id="tax" value="{{ $invoice->tax_percent }}">
                        </div>
                        <label for="taxs" class="col-sm-2 col-form-label">Nilai PPH</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control form-control-sm" id="taxs" value="{{ $invoice->tax }}" readonly>
                        </div>
                        <label for="grand_total" class="col-sm-2 col-form-label">Grandtotal</label>
                        <div class="col-sm-2">
                            <input type="text" id="grand_total" class="form-control form-control-sm" value="{{ $invoice->grand_total }}" readonly>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <!--<label for="other_cost" class="col-sm-2 col-form-label">Cost Tambahan</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control form-control-sm" id="other_cost" value="{{ $invoice->other_cost }}">
                        </div>-->
                        <label for="discount" class="col-sm-2 col-form-label">Diskon %</label>
                        <div class="col-sm-2">
                            <input type="text" id="discount" class="form-control form-control-sm" value="{{ $invoice->discount_percent }}">
                        </div>
                        <label for="disc" class="col-sm-2 col-form-label">Nilai Diskon</label>
                        <div class="col-sm-2">
                            <input type="text" id="disc" class="form-control form-control-sm" value="{{ $invoice->discount }}" readonly>
                        </div>
                        
                    </div>
                    <div class="row mt-2">
                        <!--<label for="verified_date" class="col-sm-2 col-form-label">Tgl verifikasi Bayar</label>
                        <div class="col-sm-2">
                            <input type="date" class="form-control form-control-sm datetimepicker-input" id="verified_date" name="verified_date" value="{{ $invoice->verified_date }}" readonly>
                        </div>-->
                        <label for="verified_user" class="col-sm-2 col-form-label">Ditandai Bayar Oleh</label>
                        <div class="col-sm-2">
                            <input type="text" id="verified_user" class="form-control form-control-sm" value="{{ $invoice->user_verify->name ?? '' }}" readonly>
                        </div>
                        <label for="last_status" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-2">
                            <input type="text" id="last_status" class="form-control form-control-sm" value="{{ $invoice->last_status }}" readonly>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="float-md-right">
                            <a href="{{ url('accounting/bill') }}" class="btn btn-sm btn-danger" type="button"><i class="fas fa-arrow-left"></i> Kembali</a>

                            @if($invoice->last_status != "Open" && $invoice->last_status != "Verified")
                                @can('acc_bill_update')
                                <button type="submit" id="btn_save" class="btn btn-sm btn-brand-02" ><i class="fas fa-save"></i> Simpan</button>
                                <button type="button" class="btn btn-sm btn-brand-02" id="btn_save_wait" disabled
                                style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Menyimpan Data...</i>
                                </button>
                                @endcan

                                @can('acc_bill_closing')
                                <button type="button" id="btn_closing" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-close"></i> Closing</button>
                                <button type="button" class="btn btn-sm btn-brand-02" id="btn_closing_wait" disabled
                                style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Memproses Data...</i>
                                </button>
                                @endcan
                            @endif

                            @if($invoice->last_status == "Open")
                                @can('acc_bill_update')
                                <button type="button" id="btn_pay" class="btn btn-sm btn-brand-02" ><i class="fas fa-usd"></i> Bayar</button>
                                <button type="button" class="btn btn-sm btn-brand-02" id="btn_pay_wait" disabled
                                style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Menyimpan Data...</i>
                                </button>
                                @endcan
                            @endif 
                        </span>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
            
            @if($invoice->last_status != "Open" && $invoice->last_status != "Verified")
                <button type="button" id="btn_add" class="btn btn-sm btn-brand-02" ><i class="fas fa-plus"></i> Tambah STT</button>
            @endif
        
            <hr>
            <div data-label="Example" class="df-example demo-table">
            <table id="table_data" class="table mg-b-0" width="100%">
                <thead>
                    <tr>
                        <th class="wd-10p">Tgl</th>
                        <th class="wd-10p">No STT</th>
                        <th class="wd-15p">Tujuan</th>
                        <th class="wd-10p">Penerima</th>
                        <th class="wd-5p">Colly</th>
                        <th class="wd-10p">Kg</th>
                        <th class="wd-15p">Harga</th>
                        <th class="wd-15p">Subtotal</th>
                        <th class="wd-5p">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @php
                    $sum_colly = 0;
                    $sum_kg = 0;
                    $grandtotal = 0;
                @endphp
                @foreach($invoice->details as $value)
                    @php 
                        $sum_colly = $sum_colly + $value->orders->total_colly;
                        $sum_kg = $sum_kg + $value->total_kg;
                        $grandtotal = $grandtotal + $value->subtotal;
                    @endphp
                    <tr>
                        <td>{{ $value->orders->pickup_date }}</td>
                        <td>{{ $value->orders->awb_no }}</td>
                        <td>{{ $value->orders->destinations->city_name }}</td>
                        <td>{{ $value->orders->customer_branchs->branch_name }}</td>
                        <td>{{ $value->orders->total_colly }}</td>
                        <td>{{ $value->total_kg }}</td>
                        <td>{{ number_format($value->price,2,",",".") }}</td>
                        <td>{{ number_format($value->subtotal,2,",",".") }}</td>
                        <td>
                            @if($invoice->last_status != "Open" && $invoice->last_status != "Verified")
                            <button type="button" class="btn btn-sm btn btn-sm btn-danger delete-detail" data-id="{{ $value->id }}"><i class="fas fa-trash"></i> Hapus</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4"><b>TOTAL</b></td>
                        <td>@php echo $sum_colly; @endphp</td>
                        <td>@php echo number_format($sum_kg,2,",","."); @endphp</td>
                        <td></td>
                        <td>@php echo number_format($grandtotal,2,",","."); @endphp</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            </div><!-- df-example -->
        </div><!-- col -->
        </div><!-- row -->
        
        
     
    </div><!-- container -->
</div><!-- content -->

@include('accounting.bill.add-stt-modal')

@endsection
@section('scripts')
<script src="{{ asset('plugins/jquery.mask.min.js') }}"></script>
@parent
<script>
$(function(){
  'use strict'
  //$('#discount').mask("#.##0,00", {reverse: true});

  $('#order_number').select2({
      dropdownParent: $('#frm-add-stt')
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
    var action = "{{ route('bill.update') }}";
    var form_data = new FormData();
    form_data.append('id', $('#invoice_id').val());
    form_data.append('bill_number', $('#bill_number').val());
    form_data.append('bill_number_manual', $('#bill_number_manual').val());
    form_data.append('bill_date', $('#bill_date').val());
    form_data.append('bill_receipt_date', $('#bill_receipt_date').val());
    form_data.append('due_date', $('#due_date').val());

    /*
    form_data.append('tax', decimalFormat($('#tax').val()));
    form_data.append('income_tax', decimalFormat($('#income_tax').val()));
    form_data.append('discount', decimalFormat($('#discount').val()));
    */

    form_data.append('tax', $('#tax').val());
    form_data.append('income_tax', $('#income_tax').val());
    form_data.append('discount', $('#discount').val());

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
            window.location.href = "{{ url('accounting/bill') }}/"+$('#bill_number').val()+'/detail';
        },
        error: function (jqXHR, exception) {
          alertError(jqXHR.status, exception, jqXHR.responseText);
        }
    });
  });

  $('#btn_add').click(function(){
    //get data stt first
    var spinner = $('#loader');
    spinner.show();
    $.ajax({
      url: "{{ url('accounting/bill/list-stt') }}/{{ $invoice->agent_id }}",
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
            $('#order_number').append('<option value="' + obj.v.order_number +'">' + obj.v.awb_no + ' (' + obj.v.customers.customer_name + ' - '+ obj.v.customer_branchs.branch_name + ') </option>');           
          });

          $('#modal_title').text('Tambah STT');
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

  $('#btn_pay').click(function(){
    if (confirm("Anda yakin ingin melakukan pembayaran pada invoice ini") == true) {

        if($('#payment_date').val() == "" || $('#payment_date').val() == null){
            alert("Tanggal Pembayaran harus diisi");
            return false;
        }

      var action = "{{ route('bill.pay') }}";
      var form_data = new FormData();
      form_data.append('id', $('#invoice_id').val());
      form_data.append('bill_number', $('#bill_number').val());
      form_data.append('payment_date', $('#payment_date').val());
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
              $('#btn_pay').hide();
              $('#btn_pay_wait').show();
              //showPreloader();
          },
          complete: function () {
              $('#btn_pay').show();
              $('#btn_pay_wait').hide();
              //hidePreloader();
          },
          success: function (result) {
              console.log(result);
              window.location.href = "{{ url('accounting/bill') }}/"+$('#bill_number').val()+'/detail';
          },
          error: function (jqXHR, exception) {
            console.log(jqXHR);
            alertError(jqXHR.status, exception, jqXHR.responseText);
          }
      });
    }
  });

  $('#btn_add_stt').click(function(){
    if (confirm("Anda yakin ingin menambah STT ke invoice ini") == true) {
      var action = "{{ route('bill.add-detail') }}";
      var form_data = new FormData();
      form_data.append('order_number', $('#order_number').val());
      form_data.append('agent_id', $('#agent_id').val());
      form_data.append('id', $('#invoice_id').val());
      form_data.append('bill_number', $('#bill_number').val());
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
              window.location.href = "{{ url('accounting/bill') }}/"+$('#bill_number').val()+'/detail';
          },
          error: function (jqXHR, exception) {
            console.log(jqXHR);
            alertError(jqXHR.status, exception, jqXHR.responseText);
          }
      });
    }
  });

  $(".delete-detail").on("click", function(e) {
    //alert($(this).data("id") );
    if (confirm("Anda yakin ingin menghapus STT ini") == true) {
      var action = "{{ route('bill.delete-detail') }}";
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
              window.location.href = "{{ url('accounting/bill') }}/"+$('#bill_number').val()+'/detail';
          },
          error: function (jqXHR, exception) {
            console.log(jqXHR);
            alertError(jqXHR.status, exception, jqXHR.responseText);
          }
      });
    }
  });

  $('#btn_closing').click(function(){
    if (confirm("Anda yakin ingin closing invoice ini") == true) {
      var action = "{{ route('bill.closing') }}";
      var form_data = new FormData();
      form_data.append('id', $('#invoice_id').val());
      form_data.append('bill_number', $('#bill_number').val());
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
              window.location.href = "{{ url('accounting/bill') }}/"+$('#bill_number').val()+'/detail';
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