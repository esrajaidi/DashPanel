<!doctype html>
<html dir="rtl" class="js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <!-- CSRF Token -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('مصرف الأندلس', 'لوحة تحكم ') }}</title>
        <!-- Main Styles -->
        <link href="{{ asset('assets/styles/style.min.css') }}" rel="stylesheet">
    
        <!-- mCustomScrollbar -->
        <link href="{{ asset('assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css') }}" rel="stylesheet">

        <!-- Waves Effect -->
        <link href="{{ asset('assets/plugin/waves/waves.min.css') }}" rel="stylesheet">

        <!-- Sweet Alert -->
        <link href="{{ asset('assets/plugin/sweet-alert/sweetalert.css') }}" rel="stylesheet">
        
        <!-- Percent Circle -->
        <link href="{{ asset('assets/plugin/percircle/css/percircle.css') }}" rel="stylesheet">

        <!-- Chartist Chart -->
        <link href="{{ asset('assets/plugin/chart/chartist/chartist.min.css') }}" rel="stylesheet">

        <!-- FullCalendar -->
        <link href="{{ asset('assets/plugin/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet">

        <link href="{{ asset('assets/plugin/fullcalendar/fullcalendar.print.css') }}" rel="stylesheet">

        	<!-- Data Tables -->
	    <link rel="stylesheet" href="{{ asset('assets/plugin/datatables/media/css/dataTables.bootstrap.min.css') }}" >
	    <link rel="stylesheet" href="{{ asset('assets/plugin/datatables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" >


        <!-- RTL -->
        <link href="{{ asset('assets/styles/style-rtl.min.css') }}" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.14.0/sweetalert2.all.min.js" integrity="sha512-LXVbtSLdKM9Rpog8WtfAbD3Wks1NSDE7tMwOW3XbQTPQnaTrpIot0rzzekOslA1DVbXSVzS7c/lWZHRGkn3Xpg==" crossorigin="anonymous"></script>

    </head>
<body>
    @include('sweetalert::alert')

    <div class="main-menu">
        <header class="header">
            <a href="{{route('home')}}" class="logo">مصرف الأندلس</a>
            <button type="button" class="button-close fa fa-times js__menu_close"></button>
            <div class="user">
                @if(Auth::user()->image==null)
                <a href="#" class="avatar"><img src="http://placehold.it/80x80" alt=""><span class="status online"></span></a>

                @else
                <a href="#" class="avatar">  <img src="{{asset('public/images/users/files_'.Auth::user()->username)}}/{{ Auth::user()->image }}" alt=""  style="width: 70px;height:70px"><span class="status online"></span></a>
                @endif
                <h5 class="name"><a href="{{route('home')}}">
                    {{ Auth::user()->username }}
                </a></h5>
                <h5 class="position">{{ Auth::user()->email}}</h5>
                <!-- /.name -->
                <div class="control-wrap js__drop_down">
                    <i class="fa fa-caret-down js__drop_down_button"></i>
                    <div class="control-list">
                        <div class="control-item"><a href={{ route('users/profile',encrypt(Auth::user()->id)) }}><i class="fa fa-user"></i> الملف الشخصي</a></div>
                        <div class="control-item"><a href="{{route('change-password')}}"><i class="fa fa-gear"></i> تغير كلمةالمرور</a></div>
                    <!-- /.control-list -->
                </div>
                <!-- /.control-wrap -->
            </div>
            <!-- /.user -->
        </header>
        <!-- /.header -->
        <div class="content mCustomScrollbar _mCS_1 mCS-dir-rtl"><div id="mCSB_1" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" style="max-height: none;" tabindex="0"><div id="mCSB_1_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="rtl">
    
            <div class="navigation">
                {{-- <h5 class="title"></h5> --}}
                <!-- /.title -->
                <ul class="menu js__accordion">
                    <li class="{{ Request::is('/') ? 'current' : '' }} ">
                        <a class="waves-effect" href="{{ route('home') }}"><i class="menu-icon fa fa-home"></i><span>الرئسية</span></a>
                    </li>
                    @canany(['user-list', 'user-create' ,'user-edit','user-delete','user-changestatus'])

                    <li class="{{ Request::is('users*') ? 'current' : '' }} ">
                        <a class="waves-effect " href="{{ route('users') }}"><i class="menu-icon fa fa-users"></i><span>إدارة المستخدمين</span></a>
                    </li>
                    @endcanany
                    @canany(['role-list', 'role-create' ,'role-edit','role-delete'])
                    <li class="{{ Request::is('roles*') ? 'current' : '' }} ">
                        <a class="waves-effect" href="{{ route('roles') }}"><i class="menu-icon fa  fa-key"></i><span>إدارة الصلاحيات</span></a>
                    </li>
                    @endcanany
                    @canany(['branche-list', 'branche-create' ,'branche-edit','branche-delete'])
                    <li class="{{ Request::is('branches*') ? 'current' : '' }} ">
                        <a class="waves-effect" href="{{ route('branches') }}"><i class="menu-icon fa fa-building"></i><span>إدارة الفرع</span></a>
                    </li>
                    @endcanany
                   
                   
                    @canany(['sms-messages','send-sms-messages','bulk-send-sms-messages'])
                    <li class="{{ Request::is('sms_messages') ? 'current' : '' }} ">
                        <a class="waves-effect" href="{{ route('sms_messages') }}"><i class="menu-icon  fa fa-comment-o"></i><span>إدارة الرسائل  </span></a>
                    </li>
                   @endcanany
                   @canany(['local_block_lists','local_block_lists_uplode','local_block_lists-create'
                   ,'local_block_lists-edit','local_block_lists-export'])

                   <li class="{{ Request::is('local_block_lists') ? 'current' : '' }} ">
                    <a class="waves-effect" href="{{ route('local_block_lists') }}"><i class="menu-icon  fa fa-list-ul"></i><span>قوائم الحظر المحلية  </span></a>
                </li>
                  
                @endcanany
                </ul>
               
               
                <!-- /.menu js__accordion -->
            </div>
            <!-- /.navigation -->
        </div><div id="mCSB_1_scrollbar_vertical" class="mCSB_scrollTools mCSB_1_scrollbar mCS-light mCSB_scrollTools_vertical" style="display: block;"><div class="mCSB_draggerContainer"><div id="mCSB_1_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; display: block; height: 37px; max-height: 157px; top: 0px;"><div class="mCSB_dragger_bar" style="line-height: 30px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></div>
        <!-- /.content -->
    </div>
    <!-- /.main-menu -->
    
    <div class="fixed-navbar">
        <div class="pull-left">
            <button type="button" class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button>
            <h1 class="page-title"> @yield('title')</h1>
            <!-- /.page-title -->
        </div>
        <!-- /.pull-left -->
        <div class="pull-right">
            
            <div class="ico-item fa fa-arrows-alt js__full_screen"></div>
            <!-- /.ico-item fa fa-fa-arrows-alt -->
           
            {{-- <a href="#" class="ico-item fa fa-envelope notice-alarm js__toggle_open" data-target="#message-popup"></a> --}}
            {{-- <a href="#" class="ico-item pulse"><span class="ico-item fa fa-bell notice-alarm js__toggle_open" data-target="#notification-popup"></span></a> --}}
            {{-- <a  class="ico-item fa fa-power-off js__logout" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
         </a> --}}
         <a  class="ico-item fa fa-power-off js__logout" >
        </a>
         {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
             @csrf
         </form> --}}
        </div>
        <!-- /.pull-right -->
    </div>
    <!-- /.fixed-navbar -->
    
    {{-- <div id="notification-popup" class="notice-popup js__toggle" data-space="75" style="height: 277px;">
        <h2 class="popup-title">Your Notifications</h2>
        <!-- /.popup-title -->
        <div class="content mCustomScrollbar _mCS_2 mCS-dir-rtl"><div id="mCSB_2" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" tabindex="0" style="max-height: none;"><div id="mCSB_2_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="rtl">
            <ul class="notice-list">
                <li>
                    <a href="#">
                        <span class="avatar"><img src="http://placehold.it/80x80" alt="" class="mCS_img_loaded"></span>
                        <span class="name">John Doe</span>
                        <span class="desc">Like your post: “Contact Form 7 Multi-Step”</span>
                        <span class="time">10 min</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar"><img src="http://placehold.it/80x80" alt="" class="mCS_img_loaded"></span>
                        <span class="name">Anna William</span>
                        <span class="desc">Like your post: “Facebook Messenger”</span>
                        <span class="time">15 min</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar bg-warning"><i class="fa fa-warning"></i></span>
                        <span class="name">Update Status</span>
                        <span class="desc">Failed to get available update data. To ensure the please contact us.</span>
                        <span class="time">30 min</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar"><img src="http://placehold.it/128x128" alt="" class="mCS_img_loaded"></span>
                        <span class="name">Jennifer</span>
                        <span class="desc">Like your post: “Contact Form 7 Multi-Step”</span>
                        <span class="time">45 min</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar"><img src="http://placehold.it/80x80" alt="" class="mCS_img_loaded"></span>
                        <span class="name">Michael Zenaty</span>
                        <span class="desc">Like your post: “Contact Form 7 Multi-Step”</span>
                        <span class="time">50 min</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar"><img src="http://placehold.it/80x80" alt="" class="mCS_img_loaded"></span>
                        <span class="name">Simon</span>
                        <span class="desc">Like your post: “Facebook Messenger”</span>
                        <span class="time">1 hour</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar bg-violet"><i class="fa fa-flag"></i></span>
                        <span class="name">Account Contact Change</span>
                        <span class="desc">A contact detail associated with your account has been changed.</span>
                        <span class="time">2 hours</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar"><img src="http://placehold.it/80x80" alt="" class="mCS_img_loaded"></span>
                        <span class="name">Helen 987</span>
                        <span class="desc">Like your post: “Facebook Messenger”</span>
                        <span class="time">Yesterday</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar"><img src="http://placehold.it/128x128" alt="" class="mCS_img_loaded"></span>
                        <span class="name">Denise Jenny</span>
                        <span class="desc">Like your post: “Contact Form 7 Multi-Step”</span>
                        <span class="time">Oct, 28</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar"><img src="http://placehold.it/80x80" alt="" class="mCS_img_loaded"></span>
                        <span class="name">Thomas William</span>
                        <span class="desc">Like your post: “Facebook Messenger”</span>
                        <span class="time">Oct, 27</span>
                    </a>
                </li>
            </ul>
            <!-- /.notice-list -->
            <a href="#" class="notice-read-more">See more messages <i class="fa fa-angle-down"></i></a>
        </div><div id="mCSB_2_scrollbar_vertical" class="mCSB_scrollTools mCSB_2_scrollbar mCS-light mCSB_scrollTools_vertical" style="display: block;"><div class="mCSB_draggerContainer"><div id="mCSB_2_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; display: block; height: 64px; max-height: 217px; top: 0px;"><div class="mCSB_dragger_bar" style="line-height: 30px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></div>
        <!-- /.content -->
    </div> --}}
    <!-- /#notification-popup -->
    
    {{-- <div id="message-popup" class="notice-popup js__toggle" data-space="75" style="height: 277px;">
        <h2 class="popup-title">Recent Messages<a href="#" class="pull-left text-danger">New message</a></h2>
        <!-- /.popup-title -->
        <div class="content mCustomScrollbar _mCS_3 mCS-dir-rtl"><div id="mCSB_3" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" tabindex="0" style="max-height: none;"><div id="mCSB_3_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="rtl">
            <ul class="notice-list">
                <li>
                    <a href="#">
                        <span class="avatar"><img src="http://placehold.it/80x80" alt="" class="mCS_img_loaded"></span>
                        <span class="name">John Doe</span>
                        <span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
                        <span class="time">10 min</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar"><img src="http://placehold.it/80x80" alt="" class="mCS_img_loaded"></span>
                        <span class="name">Harry Halen</span>
                        <span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
                        <span class="time">15 min</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar"><img src="http://placehold.it/80x80" alt="" class="mCS_img_loaded"></span>
                        <span class="name">Thomas Taylor</span>
                        <span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
                        <span class="time">30 min</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar"><img src="http://placehold.it/128x128" alt="" class="mCS_img_loaded"></span>
                        <span class="name">Jennifer</span>
                        <span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
                        <span class="time">45 min</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar"><img src="http://placehold.it/80x80" alt="" class="mCS_img_loaded"></span>
                        <span class="name">Helen Candy</span>
                        <span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
                        <span class="time">45 min</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar"><img src="http://placehold.it/128x128" alt="" class="mCS_img_loaded"></span>
                        <span class="name">Anna Cavan</span>
                        <span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
                        <span class="time">1 hour ago</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar bg-success"><i class="fa fa-user"></i></span>
                        <span class="name">Jenny Betty</span>
                        <span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
                        <span class="time">1 day ago</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar"><img src="http://placehold.it/128x128" alt="" class="mCS_img_loaded"></span>
                        <span class="name">Denise Peterson</span>
                        <span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
                        <span class="time">1 year ago</span>
                    </a>
                </li>
            </ul>
            <!-- /.notice-list -->
            <a href="#" class="notice-read-more">See more messages <i class="fa fa-angle-down"></i></a>
        </div><div id="mCSB_3_scrollbar_vertical" class="mCSB_scrollTools mCSB_3_scrollbar mCS-light mCSB_scrollTools_vertical" style="display: block;"><div class="mCSB_draggerContainer"><div id="mCSB_3_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; height: 78px; top: 0px; display: block; max-height: 217px;"><div class="mCSB_dragger_bar" style="line-height: 30px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></div>
        <!-- /.content -->
    </div> --}}
    <!-- /#message-popup -->
  
    
    <div id="wrapper">
        <div class="main-content">
            @yield('content')

            <!-- /.row -->		
            <footer class="footer">
                <ul class="list-inline">
                    <li>2023  © مصرف الأندلس.</li>
                    {{-- <li><a href="#">Privacy</a></li>
                    <li><a href="#">Terms</a></li>
                    <li><a href="#">Help</a></li> --}}
                </ul>
            </footer>
        </div>
        <!-- /.main-content -->
    </div><!--/#wrapper -->
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="assets/script/html5shiv.min.js"></script>
            <script src="assets/script/respond.min.js"></script>
        <![endif]-->
        <!-- 
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->

        <script src="{{ asset('assets/scripts/jquery.min.js') }}" ></script>
        <script src="{{ asset('assets/scripts/modernizr.min.js') }}" ></script>
         <script src="{{ asset('assets/plugin/bootstrap/js/bootstrap.min.js') }}" ></script>
         <script src="{{ asset('assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js') }}" ></script>
         <script src="{{ asset('assets/plugin/nprogress/nprogress.js') }}" ></script>
         <script src="{{ asset('assets/plugin/sweet-alert/sweetalert.min.js') }}" ></script>

         <script src="{{ asset('assets/plugin/waves/waves.min.js') }}" ></script>

        <!-- Full Screen Plugin -->
        <script src="{{ asset('assets/plugin/fullscreen/jquery.fullscreen-min.js') }}" ></script>


        <!-- Data Tables -->
        <script src="{{ asset('assets/plugin/datatables/media/js/jquery.dataTables.min.js') }}" ></script>
        <script src="{{ asset('assets/plugin/datatables/media/js/dataTables.bootstrap.min.js') }}" ></script>
        <script src="{{ asset('assets/plugin/datatables/extensions/Responsive/js/dataTables.responsive.min.js') }}" ></script>
        <script src="{{ asset('assets/plugin/datatables/extensions/Responsive/js/responsive.bootstrap.min.js') }}" ></script>
        <script src="{{ asset('assets/scripts/datatables.demo.min.js') }}" ></script>
        <!-- Percent Circle -->
        <script src="{{ asset('assets/plugin/percircle/js/percircle.js') }}" ></script>

    
    
        <!-- FullCalendar -->
        <script src="{{ asset('assets/plugin/moment/moment.js') }}" ></script>
        <script src="{{ asset('assets/plugin/fullcalendar/fullcalendar.min.js') }}" ></script>
        <script src="{{ asset('assets/scripts/fullcalendar.init.js') }}" ></script>
        <script src="{{ asset('assets/scripts/main.min.js') }}" ></script>

    

    </body>
</html>