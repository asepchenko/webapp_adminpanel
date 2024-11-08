@extends('layouts.app')
@section('content')
<div class="content content-fixed">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">LKE</li>
              </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">LKE Dashboard</h4>
          </div>
        </div>

        <div class="row row-xs">
          <div class="col-sm-6 col-lg-3">
            <div class="card card-body">
              <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Customer Baru</h6>
              <div class="d-flex d-lg-block d-xl-flex align-items-end">
                <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1"> {{ $total_new_customer[0]->total }}</h3>
                <!--<p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium tx-success">2% <i class="icon ion-md-arrow-up"></i></span> bulan ini</p>-->
              </div>
            </div>
          </div><!-- col -->
          <div class="col-sm-6 col-lg-3 mg-t-10 mg-sm-t-0">
            <div class="card card-body">
              <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Total Order</h6>
              <div class="d-flex d-lg-block d-xl-flex align-items-end">
                <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">{{ $total_order[0]->total }}</h3>
                <!--<p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium tx-danger">56.7% <i class="icon ion-md-arrow-down"></i></span> bulan ini</p>-->
              </div>
            </div>
          </div><!-- col -->
          <div class="col-sm-6 col-lg-3 mg-t-10 mg-lg-t-0">
            <div class="card card-body">
              <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Order Dalam pengiriman</h6>
              <div class="d-flex d-lg-block d-xl-flex align-items-end">
                <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">{{ $total_order_on_delivery[0]->total }}</h3>
                <!--<p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium tx-danger">0.3% <i class="icon ion-md-arrow-down"></i></span> bulan ini</p>-->
              </div>
            </div>
          </div><!-- col -->
          <div class="col-sm-6 col-lg-3 mg-t-10 mg-lg-t-0">
            <div class="card card-body">
              <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Order Selesai</h6>
              <div class="d-flex d-lg-block d-xl-flex align-items-end">
                <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">{{ $total_order_delivered[0]->total }}</h3>
                <!--<p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium tx-success">2.1% <i class="icon ion-md-arrow-up"></i></span> bulan ini</p>-->
              </div>
            </div>
          </div><!-- col -->


          <div class="col-lg-12 col-xl-12 mg-t-10">
            <div class="card mg-b-10">
              <div class="card-header pd-t-20 d-sm-flex align-items-start justify-content-between bd-b-0 pd-b-0">
                <div>
                  <h6 class="mg-b-5">All Orders</h6>
                  <p class="tx-13 tx-color-03 mg-b-0">Semua order bulan ini dalam grafik</p>
                </div>
                <!--<div class="d-flex mg-t-20 mg-sm-t-0">
                  <div class="btn-group flex-fill">
                    <button class="btn btn-white btn-xs active">Range</button>
                    <button class="btn btn-white btn-xs">Period</button>
                  </div>
                </div>-->
              </div><!-- card-header -->
              <div class="card-body pd-y-30">
                  <!--<div data-label="Example" class="df-example">
                      <div id="flotLine" class="ht-200 ht-sm-300"></div>
                  </div>-->
                  <div class="chart">
                      <canvas id="chart" style="height:170px; min-height:170px"></canvas>
                  </div>
              </div><!-- card-body -->
            </div><!-- card -->

            <!--<div class="card card-body ht-lg-100">
              <div class="media">
                <span class="tx-color-04"><i data-feather="download" class="wd-60 ht-60"></i></span>
                <div class="media-body mg-l-20">
                  <h6 class="mg-b-10">Download your earnings in CSV format.</h6>
                  <p class="tx-color-03 mg-b-0">Open it in a spreadsheet and perform your own calculations, graphing etc. The CSV file contains additional details, such as the buyer location. </p>
                </div>
              </div>
            </div>-->
          </div><!-- col -->

          <div class="col-md-6 col-xl-4 mg-t-10">
            <div class="card ht-100p">
              <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="mg-b-0">Order Terbaru</h6>
                <!--<div class="d-flex tx-18">
                  <a href="" class="link-03 lh-0"><i class="icon ion-md-refresh"></i></a>
                  <a href="" class="link-03 lh-0 mg-l-10"><i class="icon ion-md-more"></i></a>
                </div>-->
              </div>
              <ul class="list-group list-group-flush tx-13">
                @if($new_orders)
                @foreach($new_orders as $order)
                <li class="list-group-item d-flex pd-sm-x-20">
                  <div class="avatar d-none d-sm-block"><span class="avatar-initial rounded-circle bg-teal"><i class="icon ion-md-checkmark"></i></span></div>
                  <div class="pd-sm-l-10">
                    <p class="tx-medium mg-b-0">No STT {{ $order->awb_no }}</p>
                    <small class="tx-12 tx-color-03 mg-b-0">{{ $order->date }}</small>
                  </div>
                  <div class="mg-l-auto text-right">
                    <p class="tx-medium mg-b-0">{{ number_format($order->total_kg,2,",",".") }} kg</p>
                    <small class="tx-12 tx-success mg-b-0">{{ $order->last_status }}</small>
                  </div>
                </li>
                @endforeach
                @endif
              </ul>
              <div class="card-footer text-center tx-13">
                <a href="{{ url('transaction/orders') }}" class="link-03">Lihat Semua Order <i class="icon ion-md-arrow-down mg-l-5"></i></a>
              </div><!-- card-footer -->
            </div><!-- card -->
          </div>
          <div class="col-md-6 col-xl-4 mg-t-10">
            <div class="card ht-100p">
              <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="mg-b-0">Customer Terbaru</h6>
                <!--<div class="d-flex align-items-center tx-18">
                  <a href="" class="link-03 lh-0"><i class="icon ion-md-refresh"></i></a>
                  <a href="" class="link-03 lh-0 mg-l-10"><i class="icon ion-md-more"></i></a>
                </div>-->
              </div>
              <ul class="list-group list-group-flush tx-13">
                @if($new_customers)
                @foreach($new_customers as $customer)
                <li class="list-group-item d-flex pd-sm-x-20">
                  <div class="avatar"><span class="avatar-initial rounded-circle bg-gray-600">{{ substr($customer->customer_name,0,1) }}</span></div>
                  <div class="pd-l-10">
                    <p class="tx-medium mg-b-0">{{ $customer->customer_name }}</p>
                    <small class="tx-12 tx-color-03 mg-b-0">Kode Customer {{ $customer->customer_code }}</small>
                  </div>
                  <div class="mg-l-auto d-flex align-self-center">
                    <nav class="nav nav-icon-only">
                      <!--<a href="" class="nav-link d-none d-sm-block"><i data-feather="mail"></i></a>
                      <a href="" class="nav-link d-none d-sm-block"><i data-feather="slash"></i></a>-->
                      <a href="{{ url('master/customers') }}/{{$customer->id}}" class="nav-link d-none d-sm-block"><i data-feather="user"></i></a>
                      <a href="" class="nav-link d-sm-none"><i data-feather="more-vertical"></i></a>
                    </nav>
                  </div>
                </li>
                @endforeach
                @endif
              </ul>
              <div class="card-footer text-center tx-13">
                <a href="{{ url('master/customers') }}" class="link-03">Lihat Semua Customer <i class="icon ion-md-arrow-down mg-l-5"></i></a>
              </div><!-- card-footer -->
            </div><!-- card -->
          </div>
          <div class="col-md-6 col-xl-4 mg-t-10">
            <div class="card ht-lg-100p">
              <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="mg-b-0">Order Real-Time</h6>
                <ul class="list-inline d-flex mg-b-0">
                  <li class="list-inline-item d-flex align-items-center">
                    <span class="d-block wd-10 ht-10 bg-df-2 rounded mg-r-5"></span>
                    <span class="tx-sans tx-uppercase tx-10 tx-medium tx-color-03">Hari Ini</span>
                  </li>
                  <!--<li class="list-inline-item d-flex align-items-center mg-l-10">
                    <span class="d-block wd-10 ht-10 bg-df-3 rounded mg-r-5"></span>
                    <span class="tx-sans tx-uppercase tx-10 tx-medium tx-color-03">Kemarin</span>
                  </li>-->
                </ul>
              </div><!-- card-header -->
              <div class="card-body pd-b-0">
                <div class="row mg-b-20">
                  <div class="col">
                    <h4 class="tx-normal tx-rubik tx-spacing--1 mg-b-10">Rp {{ number_format($order_realtime[0]->total,0,",",".") }} <!--<small class="tx-11 tx-success letter-spacing--2"><i class="icon ion-md-arrow-up"></i> 0.20%</small> --></h4>
                    <p class="tx-11 tx-uppercase tx-spacing-1 tx-medium tx-color-03">Total Order</p>
                  </div>
                  <div class="col">
                    <h4 class="tx-normal tx-rubik tx-spacing--1 mg-b-10">{{ number_format($order_realtime[0]->kg,2,",",".") }} <!--<small class="tx-11 tx-danger letter-spacing--2"><i class="icon ion-md-arrow-down"></i> 1.04%</small>--></h4>
                    <p class="tx-11 tx-uppercase tx-spacing-1 tx-medium tx-color-03">Total Order Kg</p>
                  </div>
                </div><!-- row -->
              </div><!-- card-body -->
            </div>
          </div>
        </div><!-- row -->
      </div><!-- container -->
    </div><!-- content -->

    <footer class="footer mg-t-auto">
      <div>
        <span>&copy; 2021 yudhatp.com v1.0.0. </span>
        <span>Themes by <a href="http://themepixels.me">ThemePixels</a></span>
      </div>
      <div>
        <nav class="nav">
          <a href="https://themeforest.net/licenses/standard" class="nav-link">Licenses</a>
          <a href="../../change-log.html" class="nav-link">Change Log</a>
          <a href="https://discordapp.com/invite/RYqkVuw" class="nav-link">Get Help</a>
        </nav>
      </div>
    </footer>
@endsection
@section('scripts')
@parent

  <script src="{{ asset('dashforge/lib/jquery.flot/jquery.flot.js') }}"></script>
  <script src="{{ asset('dashforge/lib/jquery.flot/jquery.flot.stack.js') }}"></script>
  <script src="{{ asset('dashforge/lib/jquery.flot/jquery.flot.resize.js') }}"></script>
  <script src="{{ asset('dashforge/lib/chart.js/Chart.bundle.min.js') }}"></script>
  <script src="{{ asset('dashforge/lib/jqvmap/jquery.vmap.min.js') }}"></script>
  <script src="{{ asset('dashforge/lib/jqvmap/maps/jquery.vmap.usa.js') }}"></script>

  <script src="{{ asset('dashforge/assets/js/dashforge.sampledata.js') }}"></script>
  <script src="{{ asset('dashforge/assets/js/dashboard-one.js') }}"></script>

  <script src="{{ asset('dashforge/assets/js/chart.flot.sampledata.js') }}"></script>
  <script src="{{ asset('dashforge/assets/js/chart.flot.js') }}"></script>
  <!--<script src="{{ asset('dashforge/assets/js/chart.chartjs.js') }}"></script>-->

  <script src="{{ asset('plugins/chartjs/Chart.min.js') }}"></script>
  <script>
  $(document).ready(function(){
  //data chart
    var ChartData = {
      labels: <?php echo json_encode(array_keys($charts)); ?>,
      datasets: [
        {
          label: 'Orders',
          backgroundColor     : '#007bff',
          borderColor         : '#007bff',
          pointRadius         : false,
          pointColor          : '#007bff',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data: <?php echo json_encode(array_values($charts)); ?>
        }
      ]
    }

    var aChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    var ChartOptions = {
      responsive: true,
      tooltips: {
        mode: 'index',
        intersect: false,
      },
      hover: {
        mode: 'nearest',
        intersect: true
      },
      scales: {
        xAxes: [{
          display: true,
          scaleLabel: {
          display: true,
          labelString: 'Tanggal'
          }
        }],
        yAxes: [{
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Jumlah Order'
          }
        }]
		  }
    }

    var lineChartCanvas = $('#chart').get(0).getContext('2d')
    var lineChartOptions = jQuery.extend(true, {}, ChartOptions)
    var lineChartData = jQuery.extend(true, {}, ChartData)
    lineChartData.datasets[0].fill = false;
    //lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, { 
      type: 'line',
      data: lineChartData, 
      options: lineChartOptions
    });
  });
</script>
@endsection