
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
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link href="{{ asset('assets/css/toastr.css') }}" rel="stylesheet"/>


  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet">
  
  <!-- CSS Files -->
  <link href="{{ asset('assets/css/black-dashboard.css?v=1.0.0') }}" rel="stylesheet">

  <link href="{{ asset('assets/demo/demo.css') }}"  rel="stylesheet">
  @yield('css')
</head>

<body class="">
  <div class="wrapper">
    <div class="sidebar">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
    -->
      <div class="sidebar-wrapper">
        <div class="logo">
          <a href="javascript:void(0)" class="simple-text logo-mini">
           CRM
          </a>
          <a href="javascript:void(0)" class="simple-text logo-normal">
          <p></p>
          </a>
        </div>
        <ul class="nav">
          <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }} ">
            <a href="{{ route('dashboard') }}">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="{{ request()->routeIs('lead.index') ? 'active' : '' }}">
            <a href="{{ route('lead.index') }}">
              <i class="tim-icons icon-atom"></i>
              <p>Leads</p>
            </a>
          </li>
          {{-- <li>
            <a href="./map.html">
              <i class="tim-icons icon-pin"></i>
              <p>Maps</p>
            </a>
          </li> --}}
          <li class="{{ request()->routeIs('account.index') ? 'active' : '' }}">
            <a href="{{ route('account.index') }}">
              <i class="tim-icons icon-badge"></i>
              <p>Accounts</p>
            </a>
          </li>

          <li class="{{ request()->routeIs('contact.index') ? 'active' : '' }}">
            <a href="{{ route('contact.index') }}">
              <i class="tim-icons icon-email-85"></i>
              <p> Contacts</p>
            </a>
          </li>

          <li class="{{ request()->routeIs('deal.index') ? 'active' : '' }}">
            <a href="{{ route('deal.index') }}">
              <i class="tim-icons icon-puzzle-10"></i>
              <p>Deals</p>
            </a>
          </li>

            <li class="{{ request()->routeIs('profile.edit') ? 'active ' : '' }}">
            <a href="{{ route('profile.edit') }}">
              <i class="tim-icons icon-single-02"></i>
              <p>User Profile</p>
            </a>
          </li>
          
        
           {{-- <li>
            <a href="./rtl.html">
              <i class="tim-icons icon-world"></i>
              <p>RTL Support</p>
            </a>
          </li> --}}
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle d-inline">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:void(0)">CRM DashBoard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav ml-auto">
              <li class="search-bar input-group">
                <button class="btn btn-link" id="search-button" data-toggle="modal" data-target="#searchModal"><i class="tim-icons icon-zoom-split" ></i>
                  <span class="d-lg-none d-md-block">Search</span>
                </button>
              </li>
              <li class="dropdown nav-item">
                <a href="javascript:void(0)" class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <div class="{{ auth()->user()->notifications->isNotEmpty() && auth()->user()->unreadNotifications->isNotEmpty() ? 'notification' : '' }} d-none d-lg-block d-xl-block"></div>
                  <i class="tim-icons icon-bell-55"></i>
                  <p class="d-lg-none">
                    Notifications
                  </p>
                </a>
                <ul class="dropdown-menu dropdown-menu-right dropdown-navbar align-content-center">

                  @foreach(auth()->user()->notifications as $notification)

                  @if(!empty(($notification->data['deal_id'])))

                  <li class="nav-link d-flex justify-content-around">
                    <a href="{{ route('deleteNotification',$notification->id) }}">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-x mt-3 p-0" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                      </svg>
                    </a>

                    @php
                      $dealExists = \App\Models\Deal::find($notification->data['deal_id']);  
                    @endphp

                    @if($dealExists)
                    <a href="{{  route('deal.show', $notification->data['deal_id'])  }}" class="nav-item dropdown-item">{{ $notification->data['message'] }}</a> 
                    @else
                    <span class="nav-item dropdown-item">{{ $notification->data['message'] }}</span> 
                    @endif

                    @if(!$notification->read_at)
                    <a href="{{ route('notificationMarkAsRead',$notification->id) }}">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mt-2" viewBox="0 0 24 24" width="24px" height="24px">
                        <path d="M20 4H4C2.897 4 2 4.897 2 6v12c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm0 2v.511l-8 5.333-8-5.333V6h16zM4 18V8.264l7.28 4.854a1.001 1.001 0 0 0 1.439 0L20 8.264V18H4z"/>
                    </svg>
                    </a>

                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" class=" mt-2 " viewBox="0 0 24 24" width="24px" height="24px">
                      <path d="M12 12.713L.015 6.013 12 1.75l11.985 4.263L12 12.713zm0 2.285l12-6.856V18.5c0 1.379-1.121 2.5-2.5 2.5h-19C1.121 21 0 19.879 0 18.5V8.142l12 6.856z"/>
                  </svg>
                  @endif
                  </li>

                  @elseif(!empty($notification->data['lead_id']))
                  <li class="nav-link d-flex justify-content-around">
                    <a href="{{ route('deleteNotification',$notification->id) }}">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-x mt-3 p-0" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                      </svg>
                    </a>

                    @php
                      $leadExists = \App\Models\Lead::find($notification->data['lead_id']);  
                    @endphp

                    @if($leadExists)
                    <a href="{{  route('lead.show', $notification->data['lead_id'])  }}" class="nav-item dropdown-item">{{ $notification->data['message'] }}</a> 
                    @else
                    <span class="nav-item dropdown-item">{{ $notification->data['message'] }}</span> 
                    @endif

                    @if(!$notification->read_at)
                    <a href="{{ route('notificationMarkAsRead',$notification->id) }}">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mt-2" viewBox="0 0 24 24" width="24px" height="24px">
                        <path d="M20 4H4C2.897 4 2 4.897 2 6v12c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm0 2v.511l-8 5.333-8-5.333V6h16zM4 18V8.264l7.28 4.854a1.001 1.001 0 0 0 1.439 0L20 8.264V18H4z"/>
                    </svg>
                    </a>

                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" class=" mt-2 " viewBox="0 0 24 24" width="24px" height="24px">
                      <path d="M12 12.713L.015 6.013 12 1.75l11.985 4.263L12 12.713zm0 2.285l12-6.856V18.5c0 1.379-1.121 2.5-2.5 2.5h-19C1.121 21 0 19.879 0 18.5V8.142l12 6.856z"/>
                  </svg>
                  @endif
                  </li>
                  


                  @elseif(!empty($notification->data['account_id']))
                  <li class="nav-link d-flex justify-content-around">
                    <a href="{{ route('deleteNotification',$notification->id) }}">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-x mt-3 p-0" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                      </svg>
                    </a>

                    @php
                      $AccountExists = \App\Models\Account::find($notification->data['account_id']);  
                    @endphp

                    @if($AccountExists)
                    <a href="{{  route('account.show', $notification->data['account_id'])  }}" class="nav-item dropdown-item">{{ $notification->data['message'] }}</a> 
                    @else
                    <span class="nav-item dropdown-item">{{ $notification->data['message'] }}</span> 
                    @endif

                    @if(!$notification->read_at)
                    <a href="{{ route('notificationMarkAsRead',$notification->id) }}">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mt-2" viewBox="0 0 24 24" width="24px" height="24px">
                        <path d="M20 4H4C2.897 4 2 4.897 2 6v12c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm0 2v.511l-8 5.333-8-5.333V6h16zM4 18V8.264l7.28 4.854a1.001 1.001 0 0 0 1.439 0L20 8.264V18H4z"/>
                    </svg>
                    </a>

                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" class=" mt-2 " viewBox="0 0 24 24" width="24px" height="24px">
                      <path d="M12 12.713L.015 6.013 12 1.75l11.985 4.263L12 12.713zm0 2.285l12-6.856V18.5c0 1.379-1.121 2.5-2.5 2.5h-19C1.121 21 0 19.879 0 18.5V8.142l12 6.856z"/>
                  </svg>
                  @endif
                  </li>
                  

                  
                  @elseif(!empty($notification->data['contact_id']))
                  <li class="nav-link d-flex justify-content-around">
                    <a href="{{ route('deleteNotification',$notification->id) }}">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-x mt-3 p-0" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                      </svg>
                    </a>

                    @php
                      $AccountExists = \App\Models\Account::find($notification->data['contact_id']);  
                    @endphp

                    @if($AccountExists)
                    <a href="{{  route('contact.show', $notification->data['contact_id'])  }}" class="nav-item dropdown-item">{{ $notification->data['message'] }}</a> 
                    @else
                    <span class="nav-item dropdown-item">{{ $notification->data['message'] }}</span> 
                    @endif

                    @if(!$notification->read_at)
                    <a href="{{ route('notificationMarkAsRead',$notification->id) }}">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mt-2" viewBox="0 0 24 24" width="24px" height="24px">
                        <path d="M20 4H4C2.897 4 2 4.897 2 6v12c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm0 2v.511l-8 5.333-8-5.333V6h16zM4 18V8.264l7.28 4.854a1.001 1.001 0 0 0 1.439 0L20 8.264V18H4z"/>
                    </svg>
                    </a>

                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" class=" mt-2 " viewBox="0 0 24 24" width="24px" height="24px">
                      <path d="M12 12.713L.015 6.013 12 1.75l11.985 4.263L12 12.713zm0 2.285l12-6.856V18.5c0 1.379-1.121 2.5-2.5 2.5h-19C1.121 21 0 19.879 0 18.5V8.142l12 6.856z"/>
                  </svg>
                  @endif
                  </li>

                  @endif
                  @endforeach
                </ul>
              </li>
              <li class="dropdown nav-item">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                  {{ auth()->user()->name }}
                  <div class="photo">
                    @if(!empty(auth()->user()->profile->profile))
                    <img src="{{ asset("storage/user_profile/".Auth::user()->profile->profile) }}" alt="Profile Photo">
                    @else
                    <img src="https://via.placeholder.com/350x150" alt="...">
                    @endif
                  </div>
                  <b class="caret d-none d-lg-block d-xl-block"></b>
                  <p class="d-lg-none">
                    Log out
                  </p>
                </a>
                <ul class="dropdown-menu dropdown-navbar">
                  <li class="nav-link"><a href="{{ route('profile.edit') }}" class="nav-item dropdown-item">Profile</a></li>
                  <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">Settings</a></li>
                  <li class="dropdown-divider"></li>
                  <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <li class="nav-link"><button type="submit" class="nav-item dropdown-item">Log out</button></li>
                  </form>
                </ul>
              </li>
              <li class="separator d-lg-none"></li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- End Navbar -->
      <div class="content">
      {{-- {{ Content }} --}}
      @yield('content')
      {{-- {{ Content }} --}}
     
    </div>
  </div>
  {{-- <div class="fixed-plugin">
    <div class="dropdown show-dropdown">
      <a href="#" data-toggle="dropdown">
        <i class="fa fa-cog fa-2x"> </i>
      </a>
      <ul class="dropdown-menu">
        <li class="header-title"> Sidebar Background</li>
        <li class="adjustments-line">
          <a href="javascript:void(0)" class="switch-trigger background-color">
            <div class="badge-colors text-center">
              <span class="badge filter badge-primary active" data-color="primary"></span>
              <span class="badge filter badge-info" data-color="blue"></span>
              <span class="badge filter badge-success" data-color="green"></span>
            </div>
            <div class="clearfix"></div>
          </a>
        </li>
        <li class="adjustments-line text-center color-change">
          <span class="color-label">LIGHT MODE</span>
          <span class="badge light-badge mr-2"></span>
          <span class="badge dark-badge ml-2"></span>
          <span class="color-label">DARK MODE</span>
        </li>
      </ul>
    </div>
  </div> --}}
  
</body>
@yield('scripts')
<!--   Core JS Files   -->
  <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
  <!--  Google Maps Plugin    -->
  <!-- Place this tag in your head or just before your close body tag. -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{ asset('assets/js/plugins/bootstrap-notify.js') }}"></script>

  <script src="{{ asset('assets/js/black-dashboard.min.js?v=1.0.0') }}"></script><!-- Black Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{ asset('assets/demo/demo.js') }}"></script>
 
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

    });
  </script>

<script src="{{ asset('assets/js/toastr.js') }}"></script>

</html>