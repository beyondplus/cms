<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="url" content="{{ url('/') }}">

    <title>Beyond Plus CMS | Admin Panel </title>

    <link href="{{ url('public/css/app.css')}}" rel="stylesheet" />
    <!-- Bootstrap -->
    <link href="{{ url('node_modules/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ url('node_modules/gentelella/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <!-- <link href="{{ url('node_modules/gentelella/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet"> -->
    <!-- bootstrap-progressbar -->
    {{-- <link href="{{ url('node_modules/gentelella/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet"> --}}
    <!-- jVectorMap -->
   {{--  <link href="{{ url('node_modules/gentelella/production/css/maps/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet"/> --}}

    <!-- Custom Theme Style -->
    <link href="{{ url('node_modules/gentelella/build/css/custom.min.css') }}" rel="stylesheet">

<!-- include libraries(jQuery, bootstrap) -->
<!-- <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet"> -->
  </head>

  <body class="nav-md">
    <div class="container body" id="app">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{ url('/')}}" class="site_title">
                <!-- <i class="fa fa-paw"></i> -->
                 <span>Admin Panel</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <!-- <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div> -->
              <!-- <div class="profile_info">

              </div> -->
              <div class="input-group">

                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                  <button class="btn btn-default" type="button"> <span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                </span>
              </div>

            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section active">
                <h3>General</h3>
                <ul class="nav side-menu">
                  @foreach(module(0) as $key => $value)
                      @if(count($value->child) > 0) 
                      <li class="active" id="{{ $value->module_link }}" v-on:click="shutterAction('{{ $value->module_link }}')"><a><i class="fa fa-home"></i> {{ $value->module_name }}  <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu display" >
                          @foreach($value->child as $child)
                            <li><a href="javascript:void(0)" v-on:click="menu('{{ $child->module_link }}')">{{ $child->module_name }}</a></li>
                          @endforeach
                        </ul>
                      </li> 
                      @else
                        <li id="{{ $value->module_link }}" v-on:click="menu('{{ $value->module_link }}')">
                        <a><i class="{{ $value->module_icon }}"></i> {{ $value->module_name }}<span class="fa fa-chevron-right"></span></a>
                        </li>
                      @endif
                  @endforeach
                </ul>
              </div>
              <div class="menu_section">
                <h3>Manage</h3>
                <ul class="nav side-menu">
                  @foreach(module(1) as $key => $value)
                      @if(count($value->child) > 0 || $value->module_link == 'custom') 
                        <li id="{{ $value->module_link }}" v-on:click="shutterAction('{{ $value->module_link }}')"><a><i class="fa fa-home"></i> {{ $value->module_name }}  <span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu" >
                            @if($value->module_link == 'custom')
                              @foreach(custom() as $child)
                                <li><a href="{{ url('bp-admin/custom/'.$child->custom_link) }}">{{ $child->custom_name}}</a></li>
                              @endforeach
                            @else
                              @foreach($value->child as $child)
                              <li><a href="javascript:void(0)" v-on:click="menu('{{ $child->module_link }}')">{{ $child->module_name }}</a></li>
                              @endforeach
                            @endif
                          </ul>
                        </li> 
                      @else
                        <li id="{{ $value->module_link }}" v-on:click="menu('{{ $value->module_link }}')">
                        <a><i class="{{ $value->module_icon }}"></i> {{ $value->module_name }}<span class="fa fa-chevron-right"></span></a>
                        </li>
                      @endif
                  @endforeach
                  {{-- <li id="addCustom" v-on:click="shutterAction('addCustom')"><a><i class="fa fa-sitemap"></i> Add Custom<span class="fa fa-chevron-right"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#level1_1">New Custom</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="level2.html">Level Two</a>
                            </li>
                            <li><a href="#level2_1">Level Two</a>
                            </li>
                            <li><a href="#level2_2">Level Two</a>
                            </li>
                          </ul>
                        </li>
                        {{-- <li><a href="#level1_2">Level One</a>
                       {{--  </li>
                    </ul> 
                  </li> --}}
                  <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Module Store <span class="label label-success pull-right">Coming Soon</span></a></li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <!-- <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a> -->
              <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();" data-toggle="tooltip" data-placement="top" title="Logout">
                           <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
               <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                   {{ csrf_field() }}
               </form>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav class="" role="navigation">
              <div class="nav toggle">
                <a id="menu_toggle" href="javascript:void(0)" v-on:click="navClick"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('public/img/avatar.png') }}" alt="">
                      @if(Auth::check())
                        {{ Auth::user()->name }}
                      @endif
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li>
                      <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();" data-toggle="tooltip" data-placement="top" title="Logout">
                                   <i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="{{ asset('public/img/avatar.png') }}" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="{{ asset('public/img/avatar.png') }}" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="{{ asset('public/img/avatar.png') }}" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="{{ asset('public/img/avatar.png') }}" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" >
          <ul class="breadcrumb"> 
              <li><a href="#">Home</a></li>
              <li><a href="#">@{{ currentView | reg  }} </a></li>
          </ul>
          @yield('content')
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Powered by <a href="http://beyondplus.net">Beyond Plus Developers</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    {{-- 
    <script src="{{ url('node_modules/gentelella/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js') }}"></script>
    <script src="{{ url('node_modules/gentelella/vendors/jquery.hotkeys/jquery.hotkeys.js') }}"></script> --}}
    <!-- jQuery -->
    <!-- Bootstrap -->

    <!-- FastClick -->
    <script src="{{ url('node_modules/gentelella/vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ url('node_modules/gentelella/vendors/nprogress/nprogress.js') }}"></script>
    <!-- Chart.js -->
    {{-- <script src="{{ url('node_modules/gentelella/vendors/Chart.js/dist/Chart.min.js') }}"></script> --}}
    <!-- gauge.js -->
    <script src="{{ url('node_modules/gentelella/vendors/bernii/gauge.js/dist/gauge.min.js') }}"></script>
    <!-- bootstrap-progressbar -->
    <!-- <script src="{{ url('node_modules/gentelella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script> -->
    <!-- iCheck -->
    <!-- <script src="{{ url('node_modules/gentelella/vendors/iCheck/icheck.min.js') }}"></script> -->
    <!-- Skycons -->
    <script src="{{ url('node_modules/gentelella/vendors/skycons/skycons.js') }}"></script>


    <!-- jVectorMap -->
    <!-- <script src="{{ url('node_modules/gentelella/production/js/maps/jquery-jvectormap-2.0.3.min.js' ) }}"></script> -->
    <!-- bootstrap-daterangepicker -->
    <!-- <script src="{{ url('node_modules/gentelella/production/js/moment/moment.min.js') }}"></script> -->
    {{-- <script src="{{ url('node_modules/gentelella/production/js/datepicker/daterangepicker.js' ) }}"></script> --}}

    <!-- Custom Theme Scripts -->
    <script sc="{{ url('node_modules/gentelella/build/js/custom.min.js' ) }}"></script>

    @stack('scripts')
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script src="{{ asset('public/js/app.js') }}" type="text/javascript"></script>
    
  </body>
</html>
