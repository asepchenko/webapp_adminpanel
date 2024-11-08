@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Laporan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Agent</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">Laporan Agent</h4>
          </div>
        </div>
      </div><!-- container -->
    </div><!-- content -->

    <div class="content">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="row">
        <div class="col-lg-12">
            <form>
                <div class="row mt-1">
                    <label for="name" class="col-sm-2 col-form-label">Tgl Awal</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" placeholder="Pilih Tanggal" id="datepicker1">
                      </div>

                      <label for="name" class="col-sm-2 col-form-label">Tgl Akhir</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" placeholder="Pilih Tanggal" id="datepicker2">
                      </div>
                </div>
                <div class="row mt-2">
                    <label for="name" class="col-sm-2 col-form-label">Bulan</label>
                      <div class="col-sm-4">
                        <select class="form-control">
                            <option label="- Pilih -"></option>
                            <option value="Firefox">Januari</option>
                            <option value="Safari">Februari</option>
                            <option value="Opera">Maret</option>
                            <option value="Opera">April</option>
                            <option value="Opera">Mei</option>
                            <option value="Opera">Juni</option>
                            <option value="Opera">Juli</option>
                            <option value="Opera">Agustus</option>
                            <option value="Opera">September</option>
                            <option value="Opera">Oktober</option>
                            <option value="Opera">November</option>
                            <option value="Opera">Desember</option>
                        </select>
                      </div>
                </div>
            </form>
            <div class="mt-4">
                <span class="float-md-right">
                    <a href="{{ url('report/agent/view') }}" class="btn btn-sm btn-brand-02" type="button"><i class="fas fa-arrow-right"></i> Tampilkan</a>
                    <!--<button type="submit" id="btn_save" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-save"></i> Tampilkan</button>
                    <button type="button" class="btn btn-sm btn-brand-02" id="btn_save_wait" disabled
                    style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>processing...</i>
                    </button>-->
                </span>
            </div>
        </div>
        
      </div><!-- row -->
     
      </div><!-- container -->
    </div><!-- content -->


@endsection
@section('scripts')
<script src="{{ asset('dashforge/lib/jqueryui/jquery-ui.min.js') }}"></script>
@parent
<script>
$(function(){
  'use strict'
  $('#datepicker1').datepicker();
  $('#datepicker2').datepicker();
});
</script>
@endsection