
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
  <title>
    @yield('title')
  </title>
  <!--     Fonts and icons     -->
  <link href="{{ asset('assets/css/fontawesome.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/toastr.css') }}" rel="stylesheet"/>
  


  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet">
  
  <!-- CSS Files -->
  <link href="{{ asset('assets/css/black-dashboard.css?v=1.0.0') }}" rel="stylesheet">

  <link href="{{ asset('assets/demo/demo.css') }}"  rel="stylesheet">

  <style>
    .active{
       background-color: #3d5785;
       color: white !important;
       border-radius: 5px;
       padding: 10px;
       font-weight: 600;
    }
  </style>

  @yield('css')
</head>

<body>
  <div class="wrapper">
    <div class="main-panel">

     
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
          <div class="container-fluid">
            <a class="navbar-brand" href="#"> <x-application-logo style="width: 40px; fill:white"/> </a>
            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
             
              <i class="tim-icons icon-bullet-list-67"></i>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
              <ul class="navbar-nav m-auto mb-2 mb-lg-0 ">

                <li class="nav-item   ">
                  <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}" aria-current="page" href="{{ route('register') }}"> Register </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }} " aria-current="page" href="{{ route('home') }}"> Home</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }} " aria-current="page" href="{{ route('login') }}"> Login </a>
                </li>
              </ul>
              
            </div>
          </div>
        </nav>
    
      


      {{-- {{ Content }} --}}
      @yield('content')
      {{-- {{ Content }} --}}
     
   
  </div>

  @yield('scripts')
<!--   Core JS Files   -->
  <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
  <!-- Chart JS -->
  <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{ asset('assets/js/plugins/bootstrap-notify.js') }}"></script>

  <script src="{{ asset('assets/js/black-dashboard.min.js?v=1.0.0') }}"></script>
  <script src="{{ asset('assets/demo/demo.js') }}"></script>
 

<script src="{{ asset('assets/js/toastr.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>

</body>

</html>