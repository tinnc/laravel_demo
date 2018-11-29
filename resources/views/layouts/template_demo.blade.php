<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="https://fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> --}}

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    <!-- Bootstrap core CSS -->
    {{ Html::style ('css/my_style.css') }}
    {{ Html::style ('css/bootstrap.min.css') }}
    {{ Html::style ('css/animate.min.css') }}
    {{ Html::style ('fonts/css/font-awesome.min.css') }}

    <!-- Custom styling plus plugins -->
    {{ Html::style ('css/custom.css') }}
    {{ Html::style ('css/maps/jquery-jvectormap-2.0.3.css') }}
    {{ Html::style ('css/floatexamples.css') }}
    {{ Html::style ('css/icheck/flat/green.css') }}
    {{-- {{ Html::style ('css/default.css') }} --}}
    {{-- {{ Html::style ('css/nivo-slider.css') }} --}}
    {{-- {{ Html::style ('css/style.css') }} --}}
    {{-- {{ Html::style ('css/template.css') }} --}}
    {{ Html::style ('css/jquery.carousel-3d.default.css') }}
    {{ Html::style ('css/jquery-ui.css') }}
    {{ Html::style ('css/bootstrap_custom.css') }}

    {{ Html::script ('js/jquery.js') }}
    {{ Html::script ('js/jquery.nivo.slider.pack.js') }}
    {{-- {{ Html::script ('js/jquery.nivo.slider.js') }} --}}
    {{-- {{ Html::script ('js/jquery.resize.js') }} --}}
    {{ Html::script ('js/jquery.waitforimages.js') }}
    {{-- {{ Html::script ('js/modernizr.js') }} --}}
    {{ Html::script ('js/jquery.carousel-3d.js') }}
    {{ Html::script ('js/jquery-ui.js') }}
    {{ Html::script ('js/slide_banner_script.js') }}
    {{ Html::script ('js/san_pham_ban_chay_script.js') }}
    {{-- {{ Html::script ('js/san_pham_chi_tiet_script.js') }} --}}
    {{ Html::script ('js/jquery.tin_tuc_moi.js') }}

</head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view" tabindex="5000" style="overflow: hidden; outline: none; cursor: -webkit-grab;">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="{{ URL('home') }}" class="site_title"><i class="fa fa-paw"></i> <span>Home</span></a>
                    </div>
                        <div class="clearfix"></div>
                        <!-- menu prile quick info -->
                            <div class="profile">
                                <div class="profile_pic">
                                    <img src="{{URL('images/avatar_1.jpeg')}}" alt="..." class="img-circle profile_img">
                                </div>
                                <div class="profile_info">
                                <!-- Right Side Of Navbar -->
                                    <span>Welcome,</span>
                                    <h2>
                                        <ul class="navbar-nav ml-auto">
                                            <!-- Authentication Links -->
                                                @guest
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                                    </li>
                                                @else
                                                    <li class="nav-item dropdown">
                                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                            {{ Auth::user()->name }}
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="text-align: center;">
                                                            <b>
                                                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                                                onclick="event.preventDefault();
                                                                                document.getElementById('logout-form').submit();">
                                                                    {{ __('Logout') }}
                                                                </a>
                                                            </b>

                                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                                @csrf
                                                            </form>
                                                        </div>
                                                    </li>
                                                @endguest
                                        </ul>
                                    </h2>
                                <!-- /Right Side Of Navbar -->
                                </div>
                            </div>
                        <!-- /menu prile quick info -->
                        <!-- sidebar menu -->
                        <div class="clearfix"></div>
                        <br>
                            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                                <div class="menu_section">
                                    <h3>General</h3>
                                    <ul class="nav side-menu">
                                        <li>
                                            <a id="tab_products"><i class="fa fa-list"></i>Products<span class="fa fa-chevron-down"></span></a>
                                            <ul>
                                                <li id="products" style="display: none;"><a href=""style="color:#FFFFFF">Category Products</a></li>
                                                <li id="products" style="display: none;"><a href="{{ route('product.index') }}"style="color:#FFFFFF">Products</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a id="tab_news"><i class="fa fa-list"></i>News<span class="fa fa-chevron-down" ></span></a>
                                            <ul>
                                                <li id="news" style="display: none;"><a href=""style="color:#FFFFFF">Category News</a></li>
                                                <li id="news" style="display: none;"><a href="{{ route('news.index') }}"style="color:#FFFFFF">News</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a id="tab_users"><i class="fa fa-list"></i>Users<span class="fa fa-chevron-down"></span></a>
                                            <ul>
                                                <li id="users" style="display: none;"><a href=""style="color:#FFFFFF">Category Users</a></li>
                                                <li id="users" style="display: none;"><a href="{{ route('user.index') }}"style="color:#FFFFFF">Users</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        <!-- /sidebar menu -->
                </div>
            </div>
            <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                        </nav>
                    </div>
                </div>
            <div class="clearfix"></div>
            <!-- page content -->
            @yield('content')
            <!-- /page content -->
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        $( "a#tab_products" ).click(function() {
            $("li#products").toggle();
            $("li#news").hide();
            $("li#users").hide();
            $(this).toggleClass('li#products')
        });

        $( "a#tab_news" ).click(function() {
            $("li#news").toggle();
            $("li#products").hide();
            $("li#users").hide();
            $(this).toggleClass('li#news')
        });

        $( "a#tab_users" ).click(function() {
            $("li#users").toggle();
            $("li#products").hide();
            $("li#news").hide();
            $(this).toggleClass('li#users')
        });
    })
</script>
</html>
