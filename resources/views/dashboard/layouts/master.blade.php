<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
    <title>{{ env('APP_NAME') }}</title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="Grocery Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design"/>
    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>
    <!-- //for-mobile-apps -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all"/>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" media="all"/>
    <!-- font-awesome icons -->
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet" type="text/css" media="all"/>
    <!-- //font-awesome icons -->
    <!-- js -->
    <script src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>
    <!-- //js -->
    <link href='//fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic'
          rel='stylesheet' type='text/css'>
    <link
        href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic'
        rel='stylesheet' type='text/css'>
</head>

<body>

<div class="logo_products" style="padding: 1em 0 1em">
    <div class="container">
        <div class="w3ls_logo_products_left">
            <h1><a href="{{ route('home') }}"><span>Grocery</span> Store</a></h1>
        </div>
        <div class="w3ls_logo_products_left1">
            <ul class="special_items">
                <li><a href="events.html">Events</a><i>/</i></li>
                <li><a href="about.html">About Us</a><i>/</i></li>
                <li><a href="products.html">Best Deals</a><i>/</i></li>
                <li><a href="services.html">Services</a></li>
            </ul>
        </div>
        <div class="w3ls_logo_products_left1">
            <ul class="phone_email">
                <li><i class="fa fa-phone" aria-hidden="true"></i>(+0123) 234 567</li>
                <li><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:store@grocery.com">store@grocery.com</a>
                </li>
            </ul>
        </div>

        <div class="clearfix"></div>
    </div>
</div>

<!-- products-breadcrumb -->
<div class="products-breadcrumb">
    <div class="container">
        <div class="wrap">
            <ul>
                @if(request()->route()->named('dashboard.home'))
                    <li><i class="fa fa-home" aria-hidden="true"></i>Dashboard</li>
                @endif
                @if(request()->route()->named('dashboard.categories.*'))
                    <li><i class="fa fa-home" aria-hidden="true"></i><a
                            href="{{ route('dashboard.home') }}">Dashboard</a><span>|</span></li>
                    <li>Categories</li>
                @endif
                @if(request()->route()->named('dashboard.products.*'))
                    <li><i class="fa fa-home" aria-hidden="true"></i><a
                            href="{{ route('dashboard.home') }}">Dashboard</a><span>|</span></li>
                    <li>Products</li>
                @endif
            </ul>

            <div class="w3l_header_right">
                @auth
                    @if(session()->exists('user_name'))
                        <span class="user-name">{{ session('user_name') }}</span>
                    @endif
                @endauth
                <ul>
                    <li class="dropdown profile_details_drop">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"
                                                                                      aria-hidden="true"></i><span
                                class="caret"></span></a>
                        <div class="mega-dropdown-menu">
                            <div class="w3ls_vegetables">
                                <ul class="dropdown-menu drp-mnu">
                                    @auth
                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <input type="submit" value="Log Out">
                                        </form>
                                    @endauth
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- //products-breadcrumb -->
<!-- banner -->
<div class="banner">
    @include('dashboard.includes.left-menu')
    @yield('content')
</div>

@include('dashboard.includes.footer')
<script>
    $(document).ready(function () {
        $(".dropdown").hover(
            function () {
                $('.dropdown-menu', this).stop(true, true).slideDown("fast");
                $(this).toggleClass('open');
            },
            function () {
                $('.dropdown-menu', this).stop(true, true).slideUp("fast");
                $(this).toggleClass('open');
            }
        );
    });
</script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

</body>
</html>

