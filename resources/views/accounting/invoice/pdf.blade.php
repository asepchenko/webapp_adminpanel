@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b no-printme">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <h4 class="mg-b-5">Invoice #{{ $no }}</h4>
            @if($invoice->due_date)
            <p class="mg-b-0 tx-color-03">Jatuh Tempo {{ (new \App\Helpers\DateHelper)->getMonthName($invoice->due_date) }}</p>
            @endif
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
          <div class="col-sm-4">
            <!--<label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Dari</label>-->
            <h6 class="tx-15 mg-b-10">PT. Laju Kilau Ekspress</h6>
            <p class="mg-b-0">JL. Raya Kebayunan Tapos No. 88 Kel. Tapos Kec Tapos Depok 1645</p>
            <p class="mg-b-0">Telp : 021 22920 385</p>
            <p class="mg-b-0">Email: finance@lakiekspress.com</p>
          </div><!-- col -->

          <div class="col-sm-4">
          </div><!-- col -->

          <div class="col-sm-4 tx-left">
            <img src="{{ asset('img/logo.jpeg') }}" class="img-fluid" height="180px" width="180px" alt="">
          </div>
          <!--<div class="col-sm-6 tx-right d-none d-md-block">
            <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Nomor Tagihan</label>
            <h1 class="tx-normal tx-color-04 mg-b-10 tx-spacing--2">#{{ $no }}</h1>
          </div>--><!-- col -->
          
          <div class="col-sm-12 tx-center mg-t-40">
            <h5>INVOICE</h5>
          </div>

          <div class="col-sm-4">
            <label>&nbsp;</label>
              <table>
                <tr><th>Invoice Number</th><td>&emsp;{{ $no }}</td></tr>
                <tr><th>Colly / Volume</th><td>&emsp;{{ $invoice->total_colly }} / {{ str_replace(',00','',$invoice->total_volume) }}</td></tr>
                <tr><th>Tgl Invoice</th><td>&emsp;{{ (new \App\Helpers\DateHelper)->getShortMonthName($invoice->invoice_date) }}</td></tr>
                @if($invoice->due_date)
                <tr><th>Jatuh Tempo</th><td>&emsp;{{ (new \App\Helpers\DateHelper)->getShortMonthName($invoice->due_date) ?? '' }}</td></tr>
                @else
                <tr><th>Jatuh Tempo</th><td>&emsp;</td></tr>
                @endif
              </table>
          </div><!-- col -->

          <div class="col-sm-4">
          </div><!-- col -->

          <div class="col-sm-4 tx-left">
            <label><b>Kepada Yth :</b></label>
            <table>
                <tr><th>{{ $invoice->customers->customer_name }}</th></tr>
                <tr><td>{{ $invoice->customers->address }}</td></tr>
                <tr><td>Tlp &emsp;&emsp;: {{ $invoice->customers->phone_number }}</td></tr>
                <tr><td>Email &emsp;: {{ $invoice->customers->email }}</td></tr>
              </table>
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
                <th class="wd-10p">Tujuan</th>
                <th class="wd-5p">Penerima</th>
                <th class="wd-5p">Colly</th>
                <th class="wd-10p">Qty/Volume</th>
                <th class="wd-10p tx-right">Harga</th>
                <th class="wd-10p tx-right">Asuransi</th>
                <th class="wd-10p tx-right">Biaya Packing</th>
                <th class="wd-15p tx-right">Subtotal</th>
              </tr>
            </thead>
            <tbody>
            @php
            $no = 1;
            @endphp
            @foreach($invoice->details as $value)
              <tr>
                <td class="tx-center">{{ $no }}</td>
                <td class="tx-nowrap">{{ (new \App\Helpers\DateHelper)->getShortMonthName($value->orders->pickup_date) ?? '' }}</td>
                <td class="tx-nowrap">{{ $value->orders->awb_no ?? '' }}</td>
                <td class="tx-nowrap">{{ $value->orders->destinations->city_name ?? '' }}</td>
                <td class="tx-nowrap">{{ $value->orders->customer_branchs->branch_name ?? '' }}</td>
                <!--<td class="d-none d-sm-table-cell tx-color-03">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam...</td>
                -->
                <td class="tx-nowrap">{{ $value->orders->total_colly ?? '' }}</td>
                <td class="tx-nowrap">{{ number_format($value->orders->total_kg,2,',','.') ?? '' }}</td>
                <td class="tx-right">Rp {{ str_replace(',00','',$value->orders->costs->price) ?? '' }}</td>
                <td class="tx-right">Rp {{ str_replace(',00','',$value->orders->costs->insurance_fee) ?? '' }}</td>
                <td class="tx-right">Rp {{ str_replace(',00','',$value->orders->costs->packing_cost) ?? '' }}</td>
                <td class="tx-right">Rp {{ number_format(str_replace(',','.',str_replace('.','',$value->orders->costs->price)) * str_replace(',','.',$value->orders->total_kg) + str_replace(',','.',str_replace('.','',$value->orders->costs->insurance_fee)) + str_replace(',','.',str_replace('.','',$value->orders->costs->packing_cost)),2,",",".") ?? '' }}</td>
              </tr>
              @php
                $no++;
              @endphp
            @endforeach
              
            </tbody>
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

        <div class="col-sm-12 col-lg-12 mg-t-40">
            <ul class="list-unstyled lh-7">
              <table>
                <tr><th>Nilai Invoice</th><td>&emsp;Rp. {{ str_replace(',00','',$invoice->grand_total) }}</td></tr>
                <tr><th>Terbilang</th><td>&ensp;{{ (new \App\Helpers\CurrencyHelper)->terbilang(str_replace('.','',str_replace(',00','',$invoice->grand_total))) }} Rupiah</td></tr>
                <tr><th>&nbsp;</th></tr>
              </table>
            </ul>
          </div><!-- col -->

          <div class="col-sm-8 col-lg-8">
            <ul class="list-unstyled lh-7">
              <table>
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
          <br><br><br><br><br><br><br><br>
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