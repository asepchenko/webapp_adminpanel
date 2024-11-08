@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Driver</a></li>
                <li class="breadcrumb-item active" aria-current="page">Jadwal Pengiriman</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">List Jadwal Pengiriman Saya</h4>
          </div>
        </div>
      </div><!-- container -->
    </div><!-- content -->

    <div class="content">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="row">
            <div class="col-lg-9">
                <div id="kalender">
                    <link href="{{ asset('dashforge/lib/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet">
                    <div id="calendar"></div>
                </div><!-- kalender -->
            </div>

            <div class="col-lg-3 mg-t-40 mg-lg-t-0">
            <div class="d-flex align-items-center justify-content-between mg-b-20">
              <h6 class="tx-uppercase tx-semibold mg-b-0">Pengiriman Minggu Ini</h6>
            </div>
            <ul class="list-unstyled media-list mg-b-15">
              <li class="media align-items-center">
                <a href=""><div class="avatar"><img src="https://via.placeholder.com/500" class="rounded-circle" alt=""></div></a>
                <div class="media-body pd-l-15">
                  <h6 class="mg-b-2"><a href="" class="link-01">Manifest #001</a></h6>
                  <span class="tx-13 tx-color-03">25 STT</span>
                </div>
              </li>
              <li class="media align-items-center mg-t-15">
                <a href=""><div class="avatar"><span class="avatar-initial rounded-circle bg-dark">ui</span></div></a>
                <div class="media-body pd-l-15">
                  <h6 class="mg-b-2"><a href="" class="link-01">Manifest #002</a></h6>
                  <span class="tx-13 tx-color-03">55 STT</span>
                </div>
              </li>
            </ul>

          </div><!-- col -->
        </div><!-- row -->
     
      </div><!-- container -->
    </div><!-- content -->

@endsection
@section('scripts')
@parent
<script src="{{ asset('dashforge/lib/fullcalendar/fullcalendar.min.js') }}"></script>
<script>
$(function(){
    'use strict'
    $('#calendar').fullCalendar({
        // put your options and callbacks here
        /*events: events,
        eventClick:  function(event) {
            $('#modalBody').html('No Reg : '+event.noreg+'<br> Nama Pasien : '+event.description);
            $('#eventUrl').attr('href',event.url);
            $('#calendarModal').modal();
        },
        eventTextColor: '#ffffff'*/
    });


        window.darkMode = function(){
          $('.btn-white').addClass('btn-dark').removeClass('btn-white');
        }

        window.lightMode = function() {
          $('.btn-dark').addClass('btn-white').removeClass('btn-dark');
        }

        var hasMode = Cookies.get('df-mode');
        if(hasMode === 'dark') {
          darkMode();
        } else {
          lightMode();
        }

      })
</script>
@endsection
