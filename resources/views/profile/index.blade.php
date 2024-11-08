@extends('layouts.app')
@section('content')

<div class="content content-fixed content-profile">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="media d-block d-lg-flex">
          <div class="profile-sidebar pd-lg-r-25">
            <div class="row">
              <div class="col-sm-3 col-md-2 col-lg">
                  <div class="avatar avatar-xxl avatar-online"><span class="avatar-initial rounded-circle bg-dark">
                    {{ substr(Session::get('user')->name,0,1) }}
                  </span></div>
              </div><!-- col -->
              <div class="col-sm-8 col-md-7 col-lg mg-t-20 mg-sm-t-0 mg-lg-t-25">
                <h5 class="mg-b-2 tx-spacing--1">{{ $user->name }}</h5>
                <p class="tx-color-03 mg-b-25">NIK : {{ Session::get('user')->nik }}</p>
                <div class="d-flex mg-b-25">
                  <button type="button" class="btn btn-xs btn-white flex-fill" id="btnChangePass">Ganti Password</button>
                  <button type="button" class="btn btn-xs btn-primary flex-fill mg-l-10" id="btnEdit">Ubah</button>
                </div>

                <!--<p class="tx-13 tx-color-02 mg-b-25">lorem ipsum.</p>-->

              </div><!-- col -->

              <div class="col-sm-6 col-md-5 col-lg mg-t-40">
                <label class="tx-sans tx-10 tx-semibold tx-uppercase tx-color-01 tx-spacing-1 mg-b-15">Informasi</label>
                <ul class="list-unstyled profile-info-list">
                  <li><i data-feather="home"></i> <span class="tx-color-03">{{ $user->branch->branch_name ?? '' }}</span></li>
                  <li><i data-feather="mail"></i> <a href="">{{ $user->email }}</a></li>
                </ul>
              </div><!-- col -->
            </div><!-- row -->

          </div><!-- profile-sidebar -->

          <div class="media-body mg-t-40 mg-lg-t-0 pd-lg-x-10">
          
            
            <div class="card mg-b-20 mg-lg-b-25">
              <div class="card-header pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
                <h6 class="tx-uppercase tx-semibold mg-b-0">Order Terakhir Saya</h6>
                <!--<nav class="nav nav-icon-only">
                  <a href="" class="nav-link"><i data-feather="more-horizontal"></i></a>
                </nav>-->
              </div>
              @if($orders)
              @foreach($orders as $order)
              <div class="card-body pd-20 pd-lg-25">
                <div class="media align-items-center mg-b-20">
                  <div class="avatar">
                  <span class="avatar-initial rounded-circle bg-dark">
                    {{ substr($order->servicegroups->group_name,0,1) }}
                  </span>
                  </div>
                  <div class="media-body pd-l-15">
                    <h6 class="mg-b-3">Status Terakhir {{ $order->last_status }}</h6>
                    <span class="d-block tx-13 tx-color-03">{{ $order->awb_no }}</span>
                  </div>
                  <span class="d-none d-sm-block tx-12 tx-color-03 align-self-start">{{ \Carbon\Carbon::parse($order->updated_at)->diffForHumans() }}</span>
                </div>
                <p class="mg-b-20">
                  Asal - Tujuan : {{ $order->origins->city_name }} - {{ $order->destinations->city_name }} <br>
                  Layanan : {{ $order->servicegroups->group_name }} 
                  via {{ $order->services->service_name }} <br>
                  <a href="{{ url('transaction/orders') }}/{{ $order->order_number }}">#{{ $order->customers->customer_name }}</a>
                </p>
                
              </div>
              @endforeach
              @else
              <div class="card-body pd-20 pd-lg-25">
                  <div class="media align-items-center mg-b-20">
                  <div class="media-body pd-l-15">
                    <p> Tidak ada order terakhir </p>
                  </div>
                </div>
              </div>
              @endif
            </div><!-- card -->
            
            

          </div><!-- media-body -->
          <div class="profile-sidebar mg-t-40 mg-lg-t-0 pd-lg-l-25">
            <div class="row">
              <div class="col-sm-6 col-md-5 col-lg">
                <div class="d-flex align-items-center justify-content-between mg-b-20">
                  <h6 class="tx-13 tx-spacng-1 tx-uppercase tx-semibold mg-b-0">Hak Akses</h6>
                </div>
                <ul class="list-unstyled media-list mg-b-15">
                  <li class="media align-items-center">
                    <a href=""><div class="avatar"><span class="avatar-initial rounded-circle bg-dark">
                    {{ substr($user->roleuser->roles->title,0,1) }}
                    </span></div></a>
                    <div class="media-body pd-l-15">
                      <p class="tx-medium mg-b-0"><a href="" class="link-01">{{ $user->roleuser->roles->title }}</a></p>
                    </div>
                  </li>
                </ul>
               </div><!-- col -->
            </div><!-- row -->
          </div><!-- profile-sidebar -->
        </div><!-- media -->
      </div><!-- container -->
    </div><!-- content -->

    @include('profile.edit-modal')
    @include('profile.change-password-modal')

@endsection
@section('scripts')
@parent
<script>
$(function(){
  'use strict'

  $('#btnEdit').click(function(){
    $('#modalEdit').modal('show');
  });

  $('#btnChangePass').click(function(){
    $('#modalChangePass').modal('show');
  });

  $("#frm_cpass").submit(function (e) {
    e.preventDefault();
    var action = $(this).attr('action');
    var datas = new FormData($("#frm_cpass")[0]);
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
        $("#frm_cpass_submit").hide();
        $("#frm_cpass_submit_wait").show();
      },
      complete: function () {
        $("#frm_cpass_submit").show();
        $("#frm_cpass_submit_wait").hide();
      },
      success: function (data) {
        alert("Berhasil mengubah password");
        $('#modalChangePass').modal('hide');
      },
      error: function (jqXHR, exception) {
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });

  $("#frm_cprofile").submit(function (e) {
    e.preventDefault();
    var action = $(this).attr('action');
    var datas = new FormData($("#frm_cprofile")[0]);
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
        $("#frm_cprofile_submit").hide();
        $("#frm_cprofile_submit_wait").show();
      },
      complete: function () {
        $("#frm_cprofile_submit").show();
        $("#frm_cprofile_submit_wait").hide();
      },
      success: function (data) {
        alert("Berhasil mengubah profile");
        window.location.href = "{{ url('profile') }}";
      },
      error: function (jqXHR, exception) {
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });
});
</script>
@endsection