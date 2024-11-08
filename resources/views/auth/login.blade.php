@extends('layouts.auth')
@section('content')
<div class="content content-fixed content-auth">
      <div class="container">
        <div class="media align-items-stretch justify-content-center ht-100p pos-relative">
          <div class="media-body align-items-center d-none d-lg-flex">
            <div class="mx-wd-600">
              <img src="{{ asset('img/logo.jpeg') }}" class="img-fluid" alt="">
            </div>
            <div class="pos-absolute b-0 l-0 tx-12 tx-center">
              Copyright (c) 2021 <a href="lakiekspress.com" target="_blank">lakiekspress.com</a>
            </div>
          </div><!-- media-body -->

          <form method="POST" action="{{ route('login') }}" id="frm_login">
            @csrf
          <div class="sign-wrapper mg-lg-l-50 mg-xl-l-60">
            <div class="wd-100p">
              <h3 class="tx-color-01 mg-b-5"><b>LKE</b> Web Apps</h3>
              <p class="tx-color-03 tx-16 mg-b-40">Selamat Datang, silahkan masuk untuk melanjutkan.</p>

              <div class="form-group">
                <label>NIK</label>
                <input type="text" name="nik" class="form-control" autocomplete="off">
              </div>
              <div class="form-group">
                <div class="d-flex justify-content-between mg-b-5">
                  <label class="mg-b-0-f">Password</label>
                  <!--<a href="" class="tx-13">Lupa password?</a>-->
                </div>
                <input type="password" name="password" class="form-control" placeholder="Enter your password">
              </div>
              <button type="submit" class="btn btn-brand-02 btn-block" id="btn_sign">Masuk</button>
              <button type="button" class="btn btn-brand-02 btn-block" id="btn_sign_wait" disabled
              style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Mohon tunggu...</i></button>
            </div>
          </div><!-- sign-wrapper -->
          </form>
        </div><!-- media -->
      </div><!-- container -->
    </div><!-- content -->
@endsection
@section('scripts')
@parent
<script>
$(function(){
  'use strict'

  $("#frm_login").submit(function (e) {
  e.preventDefault();
  var action = $(this).attr('action');
  var datas = new FormData($("#frm_login")[0]);
  
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
                    $("#btn_sign").hide();
                    $("#btn_sign_wait").show();
                },
                complete: function () {
                    $("#btn_sign").show();
                    $("#btn_sign_wait").hide();
                },
                success: function (data) {
                    window.location.href = "{{ url('dashboard') }}";
                },
                error: function (jqXHR, exception) {
                    if(exception == "timeout"){
                      alert('Koneksi terputus, silahkan coba lagi!');
                    }else if(jqXHR.responseJSON === undefined){
                      alert('Terjadi kesalahan, silahkan coba lagi!');
                    }else{
                      alert(jqXHR.responseJSON.message);
                    }
                    console.log(jqXHR);
                    console.log(jqXHR.responseJSON);
                    console.log(exception);
                  //}
                  
                  //alertError(jqXHR.status, exception, jqXHR.responseText);
                },
                timeout: 15000 // sets timeout to 15 seconds
            });
        });
});
</script>
@endsection