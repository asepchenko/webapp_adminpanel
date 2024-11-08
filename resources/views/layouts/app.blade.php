<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}" defer></script>-->

        <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="DashForge">
    <meta name="twitter:description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="twitter:image" content="http://themepixels.me/dashforge/img/dashforge-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/dashforge">
    <meta property="og:title" content="DashForge">
    <meta property="og:description" content="Responsive Bootstrap 4 Dashboard Template">

    <meta property="og:image" content="http://themepixels.me/dashforge/img/dashforge-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/dashforge/img/dashforge-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="ThemePixels">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('dashforge/assets/img/favicon.png') }}">

    <!-- vendor css -->
    <link rel="stylesheet preload prefetch" as="style" href="{{ asset('dashforge/lib/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet preload prefetch" as="style" href="{{ asset('dashforge/lib/ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet preload prefetch" as="style" href="{{ asset('dashforge/lib/typicons.font/typicons.css') }}">
    <link href="{{ asset('dashforge/lib/prismjs/themes/prism-vs.css') }}" rel="stylesheet">
    <link href="{{ asset('dashforge/lib/datatables.net-dt/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashforge/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashforge/lib/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2-bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dashforge/lib/quill/quill.core.css') }}" rel="stylesheet">
    <link href="{{ asset('dashforge/lib/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('dashforge/lib/quill/quill.bubble.css') }}" rel="stylesheet">
   <!--<link href="{{ asset('dashforge/lib/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">
-->
    <!-- DashForge CSS -->
    <link rel="stylesheet preload prefetch" as="style" href="{{ asset('dashforge/assets/css/dashforge.css') }}">
    <link rel="stylesheet preload prefetch" as="style" href="{{ asset('dashforge/assets/css/dashforge.auth.css') }}">
	<link rel="stylesheet" href="{{ asset('dashforge/assets/css/dashforge.profile.css') }}">
    <!--<link href="{{ asset('dashforge/lib/datatables.net/css/select.dataTables.min.css') }}" rel="stylesheet">
-->
    <link rel="stylesheet" href="{{ asset('dashforge/assets/css/dashforge.calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-timepicker.css') }}">
    @yield('styles')
    <style>
        .badge{
            font-size:12px!important;
        }

        @media print {
            .no-printme  {
                display: none;
            }
            .printme  {
                display: block;
            }
        }
        
      #loader {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        background: rgba(0,0,0,0.75) url("{{ asset('img/spinner.gif') }}") no-repeat center center;
        z-index: 10000;
      }
    </style>
    </head>
    <body class="font-sans antialiased">
        <div id="loader"></div>
        @include('partials.header')
        @yield('content')

    <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>

    <script src="{{ asset('dashforge/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dashforge/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dashforge/lib/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('dashforge/lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <script src="{{ asset('dashforge/lib/prismjs/prism.js') }}"></script>
    <script src="{{ asset('dashforge/lib/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashforge/lib/datatables.net-dt/js/dataTables.dataTables.min.js') }}"></script>
    <!--<script src="{{ asset('dashforge/lib/datatables.net/js/dataTables.select.min.js') }}"></script>-->
        <!--<script src="{{ asset('dashforge/lib/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('dashforge/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js') }}"></script>-->
    <script src="{{ asset('dashforge/lib/select2/js/select2.min.js') }}"></script>
        <!--<script src="{{ asset('js/select2.full.min.js') }}"></script>-->
    

    <script src="{{ asset('dashforge/lib/moment/min/moment.min.js') }}"></script>
        
        <!--<script src="{{ asset('dashforge/lib/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
    -->
    <script src="{{ asset('dashforge/assets/js/dashforge.js') }}"></script>
        <!--<script src="{{ asset('dashforge/assets/js/calendar-events.js') }}"></script>
        <script src="{{ asset('dashforge/assets/js/dashforge.calendar.js') }}"></script>-->

       <!-- append theme customizer -->
    <script src="{{ asset('dashforge/lib/js-cookie/js.cookie.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <!--<script src="{{ asset('dashforge/assets/js/dashforge.settings.js') }}"></script>-->
    <!-- custom js -->
    <script src="{{ asset('js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('js/helper.js') }}"></script>
    <script src="{{ asset('js/dataTables.select.min.js') }}"></script>
    <!--<script src="{{ asset('js/buttons.bootstrap4.min.js') }}"></script>-->
    <!--<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>-->
    <script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/buttons.html5.min.js') }}"></script>
    @yield('scripts')
    <script>
        //get list notification
          $.ajax({
            url: "{{ url('notification') }}",
            dataType: 'json',
            success: function( data ) {
              //spinner.hide();
              if(data.length > 0){
                var temp = [];
                $('#notifCount').text(data.length);
                $.each(data, function(key, value) {
                  temp.push({v:value, k: key});
                }); 
                $.each(temp, function(key, obj) {
                 $('#notif').append("<a href='"+obj.v.url+"' class='dropdown-item'>"+
                    "<div class='media'>"+
                    "<div class='avatar avatar-sm'><img src='https://via.placeholder.com/350' class='rounded-circle'></div>"+
                    "<div class='media-body mg-l-15'>"+
                    "<p><strong>"+obj.v.title+"</strong><br>"+obj.v.content+"</p>"+
                    "<span>"+obj.v.created_at+"</span>"+
                    "</div></div></a>");
                 //<option value="B' + obj.v.id +'">' + obj.v.branch_code + ' - ' + obj.v.branch_name + '</option>');           
                });
              }
            },
            error: function (jqXHR, exception) {
              //spinner.hide();
              alertError(jqXHR.status, exception, jqXHR.responseText);
            }
          });
    </script>
    </body>
</html>
