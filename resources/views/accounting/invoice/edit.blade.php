@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Accounting</a></li>
                <li class="breadcrumb-item"><a href="#">Invoice</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $invoice->invoice_number }}</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">Detail Invoice {{ $invoice->invoice_number }}</h4>
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
                    <input type="hidden" id="invoice_number" value="{{ $invoice->invoice_number }}">
                    <div class="row">
                        <label for="customer_name" class="col-sm-2 col-form-label">Nama Customer</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control form-control-sm" id="customer_name" value="{{ $invoice->customers->customer_name }}" readonly>
                        </div>
                        <label for="invoice_date" class="col-sm-2 col-form-label">Tgl Invoice *</label>
                        <div class="col-sm-2">
                            <input type="date" class="form-control form-control-sm datetimepicker-input" id="invoice_date" name="invoice_date" value="{{ $invoice->invoice_date }}" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="pay_date" class="col-sm-2 col-form-label">Tgl Dibayar</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control form-control-sm" id="pay_date" name="pay_date" value="{{ $invoice->payment_date }}" readonly>
                        </div>
                        <label for="verified_date" class="col-sm-2 col-form-label">Tgl verifikasi Bayar</label>
                        <div class="col-sm-2">
                            <input type="date" class="form-control form-control-sm datetimepicker-input" id="verified_date" name="verified_date" value="{{ $invoice->verified_date }}" readonly>
                        </div>
                        <label for="total_volume" class="col-sm-2 col-form-label">Termin (hari) *</label>
                        <div class="col-sm-2">
                            <input type="number" id="termin" name="termin" class="form-control form-control-sm" value="{{ $invoice->termin }}" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="due_date" class="col-sm-2 col-form-label">Tgl Kirim</label>
                        <div class="col-sm-2">
                            <input type="date" class="form-control form-control-sm" id="send_date" name="send_date" value="{{ $invoice->send_date }}" readonly>
                        </div>
                        <label for="received_date" class="col-sm-2 col-form-label">Tgl Terima</label>
                        <div class="col-sm-2">
                            <input type="date" class="form-control form-control-sm datetimepicker-input" id="received_date" name="received_date" value="{{ $invoice->received_date }}">
                        </div>
                        <label for="verified_date" class="col-sm-2 col-form-label">Tgl Jatuh Tempo</label>
                        <div class="col-sm-2">
                            <input type="date" class="form-control form-control-sm" id="due_date" name="due_date" value="{{ $invoice->due_date }}" readonly>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="total_colly" class="col-sm-2 col-form-label">Total Colly</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control form-control-sm" id="total_colly" value="{{ $invoice->total_colly }}" readonly>
                        </div>
                        <label for="total_volume" class="col-sm-2 col-form-label">Total Volume</label>
                        <div class="col-sm-2">
                            <input type="text" id="total_volume" asal="total_volume" class="form-control form-control-sm" value="{{ $invoice->total_volume }}" readonly>
                        </div>
                        <label for="subtotal" class="col-sm-2 col-form-label">Subtotal</label>
                        <div class="col-sm-2">
                            <input type="text" id="subtotal" class="form-control form-control-sm" value="{{ $invoice->subtotal }}" readonly>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="income_tax" class="col-sm-2 col-form-label">PPN %</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control form-control-sm" id="income_tax" value="{{ $invoice->income_tax_percent }}" required>
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
                            <input type="text" class="form-control form-control-sm" id="tax" value="{{ $invoice->tax_percent }}" required>
                        </div>
                        <label for="tax" class="col-sm-2 col-form-label">Nilai PPH</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control form-control-sm" id="tax" value="{{ $invoice->tax }}" readonly>
                        </div>
                        <label for="grand_total" class="col-sm-2 col-form-label">Grandtotal</label>
                        <div class="col-sm-2">
                            <input type="text" id="grand_total" class="form-control form-control-sm" value="{{ $invoice->grand_total }}">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <!--<label for="other_cost" class="col-sm-2 col-form-label">Cost Tambahan</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control form-control-sm" id="other_cost" value="{{ $invoice->other_cost }}">
                        </div>-->
                        <label for="is_disc_percent" class="col-sm-2 col-form-label">Disc Percent ?</label>
                        <div class="col-sm-2">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="form-control custom-control-input" id="is_disc_percent" name="is_disc_percent" {{ ( $invoice->is_disc_percent == "Y") ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_disc_percent"></label>
                            </div>
                        </div>
                        <label for="discount" class="col-sm-2 col-form-label">Diskon %</label>
                        <div class="col-sm-2">
                            <input type="text" id="discount" name="discount" class="form-control form-control-sm" value="{{ $invoice->discount_percent }}" {{ ( $invoice->is_disc_percent != "Y") ? '' : '' }}>
                        </div>
                        <label for="disc" class="col-sm-2 col-form-label">Nilai Diskon</label>
                        <div class="col-sm-2">
                            <input type="text" id="disc" name="disc" class="form-control form-control-sm" value="{{ $invoice->discount }}" {{ ( $invoice->is_disc_percent == "Y") ? '' : '' }}>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="approval_user" class="col-sm-2 col-form-label">Approval User</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control form-control-sm" value="{{ $invoice->user_approval->name ?? '' }}" readonly>
                        </div>
                        <label for="verified_user" class="col-sm-2 col-form-label">Diverifikasi Oleh</label>
                        <div class="col-sm-2">
                            <input type="text" id="verified_user" class="form-control form-control-sm" value="{{ $invoice->user_verify->name ?? '' }}" readonly>
                        </div>
                        <label for="last_status" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-2">
                            <input type="text" id="last_status" class="form-control form-control-sm" value="{{ $invoice->last_status }}" readonly>
                        </div>
                    </div>
                    @if($invoice->last_status == "Payment")
                    <div class="row mt-2">
                      <label for="approval_user" class="col-sm-2 col-form-label">Bukti Bayar</label>
                        <div class="col-sm-2">
                          <a href="{{ $invoice->filename_base64 }}" target="_blank" class="btn btn-sm btn-brand-02">Download</a>
                        </div>
                    </div>
                    @endif
                    <div class="mt-4">
                        <span class="float-md-right">
                            <a href="{{ url('accounting/invoice') }}" class="btn btn-sm btn-danger" type="button"><i class="fas fa-arrow-left"></i> Kembali</a>
                            
                            @if($invoice->last_status == "Payment")
                                <button type="button" id="btn_verify" class="btn btn-sm btn-brand-02" ><i class="fas fa-save"></i> Verifikasi</button>
                                <button type="button" class="btn btn-sm btn-brand-02" id="btn_verify_wait" disabled
                                style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Menyimpan Data...</i>
                                </button>
                            @endif 

                            @if($invoice->last_status == "Sent")
                                <button type="button" id="btn_receive" class="btn btn-sm btn-warning" ><i class="fas fa-save"></i> Terima Invoice</button>
                                <button type="button" class="btn btn-sm btn-warning" id="btn_receive_wait" disabled
                                style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Memproses Data...</i>
                                </button>
                            @endif 

                            @if($invoice->last_status == "Process")
                                <button type="button" id="btn_pay" class="btn btn-sm btn-warning" ><i class="fas fa-save"></i> Bayar Invoice</button>
                                <button type="button" class="btn btn-sm btn-warning" id="btn_pay_wait" disabled
                                style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Memproses Data...</i>
                                </button>
                            @endif 

                            @if($invoice->last_status == "Draft")
                                @can('acc_invoice_delete')
                                <button type="button" id="btn_delete" class="btn btn-sm btn-danger btn-uppercase" ><i class="fas fa-trash-alt"></i> Hapus</button>
                                <button type="button" class="btn btn-sm btn-danger" id="btn_delete_wait" disabled
                                style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Menghapus Data...</i>
                                </button>
                                @endcan

                                @can('acc_invoice_update')
                                <button type="submit" id="btn_save" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-save"></i> Simpan</button>
                                <button type="button" class="btn btn-sm btn-brand-02" id="btn_save_wait" disabled
                                style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Menyimpan Data...</i>
                                </button>
                                @endcan

                                @can('acc_invoice_closing')
                                <button type="button" id="btn_closing" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-close"></i> Closing</button>
                                <button type="button" class="btn btn-sm btn-brand-02" id="btn_closing_wait" disabled
                                style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Memproses Data...</i>
                                </button>
                                @endcan
                            @endif

                            @if($invoice->last_status != "Draft")
                                <button type="button" id="btn_print" class="btn btn-sm btn-success" ><i class="fas fa-print"></i> Cetak Invoice</button>
                            @endif 
                        </span>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
            @if($invoice->last_status == "Draft")
                <button type="button" id="btn_add" class="btn btn-sm btn-brand-02" ><i class="fas fa-plus"></i> Tambah STT</button>
            @endif
            <hr>
            <div data-label="Example" class="df-example demo-table">
            <table id="table_data" class="table mg-b-0" width="100%">
                <thead>
                    <tr>
                        <th class="wd-10p">Tgl</th>
                        <th class="wd-10p">No STT</th>
                        <th class="wd-10p">Tujuan</th>
                        <th class="wd-10p">Penerima</th>
                        <th class="wd-10p">Colly</th>
                        <th class="wd-10p">Volume</th>
                        <th class="wd-10p">Harga</th>
                        <th class="wd-10p">Biaya Packing/Bongkar</th>
                        <th class="wd-10p">Asuransi</th>
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
                        $sum_kg = $sum_kg + $value->orders->total_kg;
                        if($invoice->service_group_id == 3){
                          $grandtotal = $grandtotal + (str_replace(',','.',str_replace('.','',$value->orders->costs->price)) + str_replace(',','.',str_replace('.','',$value->orders->costs->packing_cost)) + str_replace(',','.',str_replace('.','',$value->orders->costs->insurance_fee)));
                        }else{
                          $grandtotal = $grandtotal + str_replace(',','.',str_replace('.','',$value->orders->costs->price)) * str_replace(',','.',$value->orders->total_kg) + str_replace(',','.',str_replace('.','',$value->orders->costs->packing_cost)) + str_replace(',','.',str_replace('.','',$value->orders->costs->insurance_fee));
                        }
                    @endphp
                    <tr>
                        <td>{{ $value->orders->pickup_date }}</td>
                        <td>{{ $value->orders->awb_no }}</td>
                        <td>{{ $value->orders->destinations->city_name }}</td>
                        <td>{{ $value->orders->customer_branchs->branch_name }}</td>
                        <td>{{ $value->orders->total_colly }}</td>
                        <td>{{ $value->orders->total_kg }}</td>
                        <td>{{ $value->orders->costs->price }}</td>
                        <td>{{ $value->orders->costs->packing_cost }}</td>
                        <td>{{ $value->orders->costs->insurance_fee }}</td>
                        @if($invoice->service_group_id == 3)
                            <td>{{ number_format((str_replace(',','.',str_replace('.','',$value->orders->costs->price)) + str_replace(',','.',str_replace('.','',$value->orders->costs->packing_cost)) + str_replace(',','.',str_replace('.','',$value->orders->costs->insurance_fee))),2,",",".")  }}</td>
                        @else
                            <td>{{ number_format((str_replace(',','.',str_replace('.','',$value->orders->costs->price)) * str_replace(',','.',$value->orders->total_kg) + str_replace(',','.',str_replace('.','',$value->orders->costs->packing_cost)) + str_replace(',','.',str_replace('.','',$value->orders->costs->insurance_fee))),2,",",".")  }}</td>
                        @endif
                        <td>
                        @if($invoice->last_status == "Draft")
                            <button type="button" class="btn btn-sm btn btn-sm btn-danger delete-detail" data-id="{{ $value->id }}"><i class="fas fa-trash"></i> Hapus</button>
                        @endif
                        </td>
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
                        <td></td>
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
@include('accounting.invoice.add-stt-modal')
@include('accounting.invoice.upload-modal')

@endsection
@section('scripts')
<script src="{{ asset('plugins/jquery.mask.min.js') }}"></script>
@parent
<script>
  function deleteData(data) {
    $("#modal_delete").modal("show");
    $("#hdn_del_id").val(data);
  }

$(function(){
  'use strict'
  
  //Initialize Select2 Elements
  $('.select2bs4').select2({
      theme: 'bootstrap4'
  });

  $('#order_number').select2({
      dropdownParent: $('#frm-add-stt')
  });

  $('#other_cost').mask("#.##0,00", {reverse: true});
  $('#discount').mask("#.##0,00", {reverse: true});
  $('#income_tax').mask("#.##0.0", {reverse: true});
  $('#disc').mask("#.##0,00", {reverse: true});

  $('#btn_print').click(function(){
    window.location.href = "{{ url('accounting/invoice') }}/{{ $no }}/print-pdf";
    //window.open(url,'_blank');
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

  //$('#is_disc_percent').trigger('change');

  $('#is_disc_percent').change(function () {
    if($("#is_disc_percent").prop("checked")){
      $('#discount').prop("disabled",false);
      $('#disc').prop("disabled",true);
      //$('#mou_file').val('');
    }else{
      
      $('#discount').prop("disabled",true);
      $('#disc').prop("disabled",false);
    }
  });

  $("#frm-edit").submit(function (e) {
    e.preventDefault();
    var action = "{{ route('invoice.update') }}";
    var form_data = new FormData();
    form_data.append('id', $('#invoice_id').val());
    form_data.append('invoice_number', $('#invoice_number').val());

    //form_data.append('other_cost', decimalFormat($('#other_cost').val()));
    form_data.append('due_date', $('#due_date').val());
    form_data.append('tax', $('#tax').val());
    form_data.append('termin', $('#termin').val());
    form_data.append('income_tax', $('#income_tax').val());
    if($("#is_disc_percent").prop("checked")){
      form_data.append('is_disc_percent', 'Y');
    }else{
      form_data.append('is_disc_percent', 'N');
    }
    form_data.append('discount_percent', decimalFormat($('#discount').val())); //percentage
    form_data.append('discount', decimalFormat($('#disc').val())); //value
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
            window.location.href = "{{ url('accounting/invoice') }}/"+$('#invoice_number').val();
        },
        error: function (jqXHR, exception) {
          alertError(jqXHR.status, exception, jqXHR.responseText);
        }
    });
  });

  $('#btn_closing').click(function(){
    if (confirm("Anda yakin ingin closing invoice ini") == true) {
      var action = "{{ route('invoice.closing') }}";
      var form_data = new FormData();
      form_data.append('id', $('#invoice_id').val());
      form_data.append('invoice_number', $('#invoice_number').val());
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
              window.location.href = "{{ url('accounting/invoice') }}/"+$('#invoice_number').val();
          },
          error: function (jqXHR, exception) {
            console.log(jqXHR);
            alertError(jqXHR.status, exception, jqXHR.responseText);
          }
      });
    }
  });

  $('#btn_delete').click(function(){
    if (confirm("Anda yakin ingin menghapus invoice ini") == true) {
      var action = "{{ route('invoice.delete') }}";
      var form_data = new FormData();
      form_data.append('id', $('#invoice_id').val());
      form_data.append('invoice_number', $('#invoice_number').val());
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
              alert("Invoice berhasil dihapus");
              window.location.href = "{{ url('accounting/invoice') }}";
          },
          error: function (jqXHR, exception) {
            console.log(jqXHR);
            alertError(jqXHR.status, exception, jqXHR.responseText);
          }
      });
    }
  });

  $('#btn_verify').click(function(){
    if (confirm("Anda yakin ingin verifikasi pembayaran pada invoice ini") == true) {
      var action = "{{ route('invoice.verify') }}";
      var form_data = new FormData();
      form_data.append('id', $('#invoice_id').val());
      form_data.append('invoice_number', $('#invoice_number').val());
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
              $('#btn_verify').hide();
              $('#btn_verify_wait').show();
              //showPreloader();
          },
          complete: function () {
              $('#btn_verify').show();
              $('#btn_verify_wait').hide();
              //hidePreloader();
          },
          success: function (result) {
              console.log(result);
              window.location.href = "{{ url('accounting/invoice') }}/"+$('#invoice_number').val();
          },
          error: function (jqXHR, exception) {
            console.log(jqXHR);
            alertError(jqXHR.status, exception, jqXHR.responseText);
          }
      });
    }
  });

  $('#btn_add').click(function(){
    //get data stt first
    var spinner = $('#loader');
    spinner.show();
    $.ajax({
      url: "{{ url('accounting/invoice/list-stt') }}/{{ $invoice->customer_id }}",
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
            $('#order_number').append('<option value="' + obj.v.order_number +'">' + obj.v.awb_no + ' ' + obj.v.servicegroups.group_name + ' (' + obj.v.customers.customer_name + ' - '+ obj.v.customer_branchs.branch_name + ') </option>');           
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

  $('#btn_add_stt').click(function(){
    if (confirm("Anda yakin ingin menambah STT ke invoice ini") == true) {
      var action = "{{ route('invoice.add-detail') }}";
      var form_data = new FormData();
      form_data.append('order_number', $('#order_number').val());
      form_data.append('id', $('#invoice_id').val());
      form_data.append('invoice_number', $('#invoice_number').val());
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
              window.location.href = "{{ url('accounting/invoice') }}/"+$('#invoice_number').val();
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
      var action = "{{ route('invoice.delete-detail') }}";
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
              window.location.href = "{{ url('accounting/invoice') }}/"+$('#invoice_number').val();
          },
          error: function (jqXHR, exception) {
            console.log(jqXHR);
            alertError(jqXHR.status, exception, jqXHR.responseText);
          }
      });
    }
  });

  $('#btn_receive').click(function(){
    if (confirm("Anda yakin ingin menerima invoice ini") == true) {
      if($('#received_date').val() == "" || $('#received_date').val() == null || $('#received_date').val() === undefined){
        alert("Tanggal terima tidak boleh kosong");
        return false;
      }

      var action = "{{ route('invoice.accept') }}";
      var form_data = new FormData();
      form_data.append('id', $('#invoice_id').val());
      form_data.append('received_date', $('#received_date').val());
      form_data.append('invoice_number', $('#invoice_number').val());
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
              $('#btn_receive').hide();
              $('#btn_receive_wait').show();
              //showPreloader();
          },
          complete: function () {
              $('#btn_receive').show();
              $('#btn_receive_wait').hide();
              //hidePreloader();
          },
          success: function (result) {
              console.log(result);
              window.location.href = "{{ url('accounting/invoice') }}/"+$('#invoice_number').val();
          },
          error: function (jqXHR, exception) {
            console.log(jqXHR);
            alertError(jqXHR.status, exception, jqXHR.responseText);
          }
      });
    }
  });

  $('#btn_pay').click(function(){
    $('#modalUpload').modal('show');
  });

  $("#btn_payment").click(function (e) {
    e.preventDefault();
    var action = "{{ route('invoice.pay') }}";
    var form_data = new FormData();
    
    if ($('#filename').get(0).files.length > 0) {
        var file_data = $('#filename').prop('files')[0];  
        form_data.append('filename', file_data);
    }

    form_data.append('id', $('#id').val());
    form_data.append('payment_date', $('#payment_date').val());
    form_data.append('invoice_number', '{{ $invoice->invoice_number }}');
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
        $('#btn_payment').hide();
        $('#btn_payment_wait').show();
        //showPreloader();
      },
      complete: function () {
        $('#btn_payment').show();
        $('#btn_payment_wait').hide();
        //hidePreloader();
      },
      success: function (data) {
        console.log(data);
        window.location.href = "{{ url('accounting/invoice') }}/"+$('#invoice_number').val();
      },
      error: function (jqXHR, exception) {
        console.log(exception);
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });
});
</script>
@endsection