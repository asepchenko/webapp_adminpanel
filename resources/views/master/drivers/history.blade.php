@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item">Driver</li>
                <li class="breadcrumb-item active" aria-current="page">History</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">Rudi - History</h4>
          </div>
        </div>
      </div><!-- container -->
    </div><!-- content -->

    <div class="content">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="row">
        <div class="col-lg-12">

        <div data-label="Example" class="df-example demo-table">
          <table id="table_data" class="table">
            <thead>
                <tr>
                    <th class="wd-25p">Nama</th>
                    <th class="wd-15p">Tanggal</th>
                    <th class="wd-10p">No STT</th>
                    <th class="wd-30p">Asal - Tujuan</th>
                    <th class="wd-20p">Status Terakhir</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Budi - Fuso (B 1234 LKE)</td>
                    <td>1 Oktober 2021</td>
                    <td>STT #001</td>
                    <td>JAKARTA - BOGOR (+30 km)</td>
                    <td><span class="badge badge-pill badge-secondary"><b>PROCESS</b></span></td>
                </tr>
                <tr>
                    <td>Budi - Fuso (B 1234 LKE)</td>
                    <td>12 September 2021</td>
                    <td>STT #001</td>
                    <td>JAKARTA - BANDUNG (+300 km)</td>
                    <td><span class="badge badge-pill badge-secondary"><b>DONE</b></span></td>
                </tr>
            </tbody>
        </table>
        </div><!-- df-example -->
        <div class="mt-4">
            <span class="float-md-left">
                <a href="{{ url('master/driver') }}" class="btn btn-sm btn-danger" type="button"><i class="fas fa-arrow-left"></i> Kembali</a>
            </span>
        </div>
      </div><!-- row -->
      
      </div><!-- container -->
    </div><!-- content -->

    @include('master.driver.create-modal')
    @include('master.driver.delete-modal')

@endsection
@section('scripts')
@parent
<script>
$(function(){
  'use strict'

  $('#table_data').DataTable({
    language: {
      searchPlaceholder: 'Cari...',
      sSearch: '',
      lengthMenu: '_MENU_ items/page',
    }
  });
});
</script>
@endsection