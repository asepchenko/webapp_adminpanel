@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Akunting</a></li>
                <li class="breadcrumb-item active" aria-current="page">Account Payable</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">List Account Payable (Invoice)</h4>
          </div>
          <div class="mg-t-20 mg-sm-t-0">
            <!--<button class="btn btn-sm btn-brand-02" type="button" id="btn-add-new"><i class="fas fa-file-excel"></i> Excel</button>-->
            <a href="{{ url('accounting/account-payable/create') }}" class="btn btn-sm btn-brand-02"><i class="fas fa-plus"></i> Tambah</a>
          </div>
        </div>
      </div><!-- container -->
    </div><!-- content -->

    <div class="content">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="row">
        <div class="col-lg-12">
        <!--<a class="btn btn-sm btn-brand-02" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-filter"></i> Filter</a>

        <div class="collapse mg-t-5" id="collapseExample">
            <form>
                <div class="row mt-1">
                    <label for="name" class="col-sm-2 col-form-label">Tgl Awal</label>
                      <div class="col-sm-4">
                        <input type="text" id="name" name="name" class="form-control form-control-sm" autocomplete="off" >
                      </div>

                      <label for="name" class="col-sm-2 col-form-label">Tgl Akhir</label>
                      <div class="col-sm-4">
                        <input type="text" id="name" name="name" class="form-control form-control-sm" autocomplete="off" >
                      </div>
                </div>
                <div class="row mt-1">
                    <label for="location" class="col-sm-2 col-form-label">Customer</label>
                    <div class="col-sm-4">
                        <input type="text" id="location" name="location" class="form-control form-control-sm" autocomplete="off" >
                    </div>
                    <label for="location" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-4">
                        <input type="text" id="location" name="location" class="form-control form-control-sm" autocomplete="off" >
                    </div>
                </div>
            </form>
        </div>
        <hr>-->
        <div data-label="Example" class="df-example demo-table">
          <table id="table_data" class="table mg-b-0" width="100%">
            <thead>
                <tr>
                    <th class="wd-20p">Tanggal</th>
                    <th class="wd-20p">Jatuh Tempo</th>
                    <th class="wd-20p">No Invoice</th>
                    <th class="wd-20p">Nama Agent</th>
                    <th class="wd-20p" style="text-align:right">Jumlah (Rp)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                  <td style="color:white" class="bg-warning" colspan="7">Aging 30 Hari</td>
                </tr>
                <tr>
                    <td>10 Okt 2021</td>
                    <td>31 Okt 2021</td>
                    <td><a href="{{ url('transaction/order') }}/STT123/detail">#INVC 001</a></td>
                    <td>Agent A</td>
                    <td style="text-align:right"><b>1.500.000</b></td>
                </tr>
                <tr>
                    <td>10 Aug 2021</td>
                    <td>31 Aug 2021</td>
                    <td><a href="{{ url('transaction/order') }}/STT123/detail">#INVC 002</a></td>
                    <td>Agent B</td>
                    <td style="text-align:right"><b>500.000</b></td>
                </tr>
                <tr>
                    <td colspan="4"><b>TOTAL</b></td>
                    <td style="text-align:right"><b>2.000.000</b></td>
                </tr>
                <tr>
                  <td style="color:white" class="bg-danger" colspan="7">Aging 90 Hari</td>
                </tr>
                <tr>
                    <td>10 Jul 2021</td>
                    <td>30 Jul 2021</td>
                    <td><a href="{{ url('transaction/order') }}/STT123/detail">#INVC 001</a></td>
                    <td>Agent X</td>
                    <td style="text-align:right"><b>800.000</b></td>
                </tr>
                <tr>
                    <td colspan="4"><b>TOTAL</b></td>
                    <td style="text-align:right"><b>800.000</b></td>
                </tr>
            </tbody>
        </table>
        </div><!-- df-example -->
      </div><!-- row -->
     
      </div><!-- container -->
    </div><!-- content -->

@endsection
@section('scripts')
@parent
<script>
$(function(){
  'use strict'

  
});
</script>
@endsection