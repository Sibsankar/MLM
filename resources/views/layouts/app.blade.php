<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DMPL') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ url('/')}}/assets/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="{{ url('/')}}/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ url('/')}}/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ url('/')}}/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ url('/')}}/assets/plugins/jqvmap/jqvmap.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ url('/')}}/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ url('/')}}/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ url('/')}}/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/')}}/assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="{{ url('/')}}/assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{ url('/')}}/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="{{ url('/')}}/assets/custom/app.css">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- daterangepicker -->
    <!-- jQuery -->
    <script src="{{ url('/')}}/assets/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ url('/')}}/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="{{ url('/')}}/assets/plugins/moment/moment.min.js"></script>
    <script src="{{ url('/')}}/assets/plugins/daterangepicker/daterangepicker.js"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'MLM') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('registration'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('registration') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            @if (Route::has('registration'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('importUsers') }}">{{ __('Import') }}</a>
                                </li>
                            @endif

                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <a class="dropdown-item border-top" href="{{ route('home') }}">Edit Profile</a>
                                    <a class="dropdown-item border-top" href="{{ route('viewProfile',['id'=>Auth::user()->id]) }}">View Profile</a>
                                    <a class="dropdown-item border-top" href="{{ route('my-associate') }}">My Associates</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
       
        <main class="py-4">
        @auth
        @include('layouts.sidebar')
        @endauth
            @yield('content')
        </main>
        @auth
        @include('layouts.footer')
        @endauth
        
   

 <!-- daterangepicker -->
 <script src="{{ url('/')}}/assets/plugins/jquery/jquery.min.js"></script>
 <!-- jQuery UI 1.11.4 -->
 <script src="{{ url('/')}}/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
     <script src="{{ url('/')}}/assets/plugins/moment/moment.min.js"></script>
     <script src="{{ url('/')}}/assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('/')}}/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="{{ url('/')}}/assets/plugins/select2/js/select2.full.min.js"></script>
<!-- ChartJS -->
<script src="{{ url('/')}}/assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{ url('/')}}/assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{ url('/')}}/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{ url('/')}}/assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{ url('/')}}/assets/plugins/moment/moment.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ url('/')}}/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{ url('/')}}/assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ url('/')}}/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ url('/')}}/assets/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('/')}}/assets/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- DataTables  & Plugins -->
<script src="{{ url('/')}}/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/jszip/jszip.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ url('/')}}/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="{{ url('/')}}/assets/dist/js/pages/dashboard.js"></script>
<script>
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    $('#reservationdate').datetimepicker({
        format:'L',
        dateFormat: 'yy-mm-dd',
        timepicker: false

    });

    $('.select2').select2()
    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
    })

    $(function () {
        $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        });
    });


  
</script>
</body>
</html>
