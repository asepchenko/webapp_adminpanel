@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b no-printme">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <h4 class="mg-b-5">Invoice #{{ $no }}</h4>
            <p class="mg-b-0 tx-color-03">Jatuh Tempo {{ (new \App\Helpers\DateHelper)->getMonthName($invoice->due_date) }}</p>
          </div>
          <div class="mg-t-20 mg-sm-t-0">
            <a href="{{ url('accounting/invoice') }}" class="btn btn-sm btn-danger" type="button"><i class="fas fa-arrow-left"></i> Kembali</a>
            <button class="btn btn-sm btn-white" id="btnPrint"><i data-feather="printer" class="mg-r-5"></i> Cetak</button>
          </div>
        </div>
      </div><!-- container -->
</div><!-- content -->

    <!-- tx-15 = text font 15px -->
    <div class="content tx-15">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="row">
          <div class="col-sm-6">
            <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Dari</label>
            <h6 class="tx-15 mg-b-10">PT. Laju Kilau Ekspress</h6>
            <p class="mg-b-0">JL. Raya Kebayunan Tapos No. 88 Kel. Tapos Kec Tapos Depok 1645</p>
            <p class="mg-b-0">Telp : 021 22920 385</p>
            <p class="mg-b-0">Email: finance@lakiekspress.com</p>
          </div><!-- col -->
          <!--<div class="col-sm-6 tx-right d-none d-md-block">
            <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Nomor Tagihan</label>
            <h1 class="tx-normal tx-color-04 mg-b-10 tx-spacing--2">#{{ $no }}</h1>
          </div>--><!-- col -->
          <div class="col-sm-6 tx-left d-none d-md-block">
            <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Untuk</label>
            <h6 class="tx-15 mg-b-10">{{ $invoice->customers->customer_name }}</h6>
            <p class="mg-b-0">{{ $invoice->customers->address }}</p>
            <p class="mg-b-0">Telp: {{ $invoice->customers->phone_number }}</p>
            <p class="mg-b-0">Email: {{ $invoice->customers->email }}</p>
          </div><!-- col -->
          <div class="col-sm-6 col-lg-4 mg-t-40">
            <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Invoice Information</label>
            <ul class="list-unstyled lh-7">
              <table>
                <tr><th>Invoice Number</th><td>&emsp;{{ $no }}</td></tr>
                <tr><th>Tgl Invoice</th><td>&emsp;{{ (new \App\Helpers\DateHelper)->getMonthName($invoice->invoice_date) }}</td></tr>
                <tr><th>Jatuh Tempo</th><td>&emsp;{{ (new \App\Helpers\DateHelper)->getMonthName($invoice->due_date) }}</td></tr>
              </table>
            </ul>
          </div><!-- col -->
        </div><!-- row -->

        <div class="table-responsive mg-t-40">
          <table class="table table-invoice bd-b">
            <thead>
              <tr>
                <th class="wd-5p">No</th>
                <!--<th class="wd-40p d-none d-sm-table-cell">Description</th>-->
                <th class="wd-10p">Tgl</th>
                <th class="wd-10p">No STT</th>
                <th class="wd-10p">Type - Nopol</th>
                <th class="wd-10p">Driver</th>
                <th class="wd-10p">Pengirim</th>
                <th class="wd-10p">No Trans/DO</th>
                <th class="wd-10p">Penerima - Tujuan</th>
                <th class="wd-10p tx-right">Biaya Bongkar</th>
                <th class="wd-10p tx-right">Harga</th>
                <th class="wd-10p tx-right">PPN {{ $invoice->income_tax_percent }}%</th>
                <th class="wd-10p tx-right">Subtotal</th>
              </tr>
            </thead>
            <tbody>
            @php
                $no = 1;
                $sum_packing = 0;
                $sum_tax = 0;
                $sum_price = 0;
                $sum_subtotal = 0;
            @endphp
            @foreach($invoice->details as $value)
                @php
                    $sum_packing = $sum_packing + (new \Yudhatp\Helpers\Helpers)->calcIDFormatDecimal($value->orders->costs->packing_cost);
                    $sum_tax = $sum_tax + (((new \Yudhatp\Helpers\Helpers)->calcIDFormatDecimal($value->orders->costs->price) + (new \Yudhatp\Helpers\Helpers)->calcIDFormatDecimal($value->orders->costs->packing_cost) + (new \Yudhatp\Helpers\Helpers)->calcIDFormatDecimal($value->orders->costs->insurance_fee)) * $invoice->income_tax_percent / 100);
                    $sum_price = $sum_price + (new \Yudhatp\Helpers\Helpers)->calcIDFormatDecimal($value->orders->costs->price);
                    $sum_subtotal = $sum_subtotal + (new \Yudhatp\Helpers\Helpers)->calcIDFormatDecimal($value->orders->costs->price) + (new \Yudhatp\Helpers\Helpers)->calcIDFormatDecimal($value->orders->costs->packing_cost) + (new \Yudhatp\Helpers\Helpers)->calcIDFormatDecimal($value->orders->costs->insurance_fee);
                @endphp
              <tr>
                <td class="tx-center">{{ $no }}</td>
                <td class="tx-nowrap">{{ (new \App\Helpers\DateHelper)->getShortMonthName($value->orders->pickup_date) ?? '' }}</td>
                <td class="tx-nowrap">{{ $value->orders->awb_no ?? '' }}</td>
                <td>{{ $value->truck_name ?? '' }}</td>
                <td>{{ $value->driver_name ?? '' }}</td>
                <td>{{ $invoice->customers->customer_name ?? '' }}</td>
                <td class="tx-nowrap">{{ $value->ref_no ?? '' }}</td>
                <td>{{ $value->orders->customer_branchs->branch_name ?? '' }} - {{ $value->orders->destinations->city_name ?? '' }}</td>
                <!--<td class="d-none d-sm-table-cell tx-color-03">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam...</td>
                -->
                <td class="tx-right">{{ str_replace(',00','',$value->orders->costs->packing_cost) ?? '' }}</td>
                <td class="tx-right">{{ str_replace(',00','',$value->orders->costs->price) ?? '' }}</td>
                <td class="tx-right">{{ number_format( ((str_replace(',','.',str_replace('.','',$value->orders->costs->price)) + str_replace(',','.',str_replace('.','',$value->orders->costs->packing_cost)) + str_replace(',','.',str_replace('.','',$value->orders->costs->insurance_fee))) * $invoice->income_tax_percent / 100),0,",",".")  }}</td>
                <td class="tx-right">{{ number_format( (str_replace(',','.',str_replace('.','',$value->orders->costs->price)) + str_replace(',','.',str_replace('.','',$value->orders->costs->packing_cost)) + str_replace(',','.',str_replace('.','',$value->orders->costs->insurance_fee))),0,",",".")  }}</td>
              </tr>
              @php
                $no++;
              @endphp
            @endforeach
              
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7"></td>
                    <td class="tx-right"><b>Sub Total</b></td>
                    <td class="tx-right">{{ number_format($sum_packing,0,',','.') }}</td>
                    <td class="tx-right">{{ number_format($sum_price,0,',','.') }}</td>
                    <td class="tx-right">{{ number_format($sum_tax,0,',','.') }}</td>
                    <td class="tx-right">{{ number_format($sum_subtotal,0,',','.') }}</td>
                </tr>
            </tfoot>
          </table>
        </div>

        <div class="row justify-content-between">
          <div class="col-sm-6 col-lg-6 order-2 order-sm-0 mg-t-40 mg-sm-t-0">
            <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Catatan</label>
            <p></p>
          </div><!-- col -->
          <div class="col-sm-6 col-lg-4 order-1 order-sm-0">
            <ul class="list-unstyled lh-7 pd-r-10">
              <li class="d-flex justify-content-between">
                <span>Subtotal</span>
                <span>Rp. {{ str_replace(',00','',$invoice->subtotal) }}</span>
              </li>
              @if($invoice->other_cost > 0)
              <li class="d-flex justify-content-between">
                <span>Lainnya</span>
                <span>Rp. {{ str_replace(',00','',$invoice->other_cost) }}</span>
              </li>
              @endif
              @if($invoice->discount > 0)
              <li class="d-flex justify-content-between">
                <span>Discount</span>
                <span>Rp. ({{ str_replace(',00','',$invoice->discount) }})</span>
              </li>
              @endif
              <li class="d-flex justify-content-between">
                <span>PPN ({{ $invoice->income_tax_percent }}%)</span>
                <span>Rp. {{ str_replace(',00','',$invoice->income_tax) }}</span>
              </li>
              <li class="d-flex justify-content-between">
                <strong>Grand Total</strong>
                <strong>Rp. {{ str_replace(',00','',$invoice->grand_total) }}</strong>
              </li>
            </ul>

            <!--<button class="btn btn-block btn-primary">Pay Now</button>-->
          </div><!-- col -->
        </div><!-- row -->

          <div class="col-sm-8 col-lg-8 mg-t-40">
            <ul class="list-unstyled lh-7">
              <table>
                <tr><th>Nilai Invoice</th><td>&emsp;Rp. {{ str_replace(',00','',$invoice->grand_total) }}</td></tr>
                <tr><th>Terbilang</th><td>&ensp;{{ (new \App\Helpers\CurrencyHelper)->terbilang(str_replace('.','',str_replace(',00','',$invoice->grand_total))) }} Rupiah</td></tr>
                <tr><th>&nbsp;</th></tr>
                <tr><th>Payment</th></tr>
                <tr><th>Account Name</th><td>&emsp;PT. Laju Kilau Ekspress</td></tr>
                <tr><th>BCA</th><td>&emsp;869.441.8888</td></tr>
                <tr><th>Mandiri</th><td>&emsp;125.001.342.3173</td></tr>
                <tr><th>BNI</th><td>&emsp;646.128.370</td></tr>
              </table>
            </ul>
          </div><!-- col -->
          <br>
        
          <div class="col-md-8">
          <p><b>PT. LAJU KILAU EKSPRESS</b></p>
          <br><br><br><br><br><br>
          <p><b>({{ $invoice->user_approval->name ?? '' }})</b></p>

          <br><br>
          <i>Created {{ Carbon\Carbon::parse($invoice->created_at)->format('d/m/Y') }}</i>
        </div>

      </div><!-- container -->
    </div><!-- content -->

@endsection
@section('scripts')
@parent
<script>
$(function(){
  'use strict'
  
  $('#btnPrint').click(function(){
    window.print();
  });
});
</script>
@endsection