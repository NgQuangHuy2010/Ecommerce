<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Farm</title>
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('public')}}/file/img/img_logo/1713069730_share_fb_home.png ">

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{asset('public/interface')}}/js/jquery-3.3.1.min.js"></script>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('public/interface')}}/css/animate.css" type="text/css">

    <link rel="stylesheet" href="{{asset('public/interface')}}/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/interface')}}/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/interface')}}/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/interface')}}/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/interface')}}/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/interface')}}/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/interface')}}/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/interface')}}/css/style.css" type="text/css">




</head>
<style>

</style>

<body>

    <!-- Page Preloder -->

    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>

        <div class="offcanvas__logo d-flex align-items-center justify-content-center">
            @foreach($logo as $logoItem)
                <a href="{{route('gd.home')}}"><img src="{{ asset('public/file/img/img_logo/' . $logoItem->image) }}" alt=""
                        class="img_logo"></a>
            @endforeach
        </div>
        <ul class="offcanvas__widget d-flex">
            <!-- <li><span class="icon_search search-switch"></span></li> -->

            <li><a href="{{route('gd.cart')}}"><span class="icon_cart_alt"></span>
                    <div class="tip">
                        @if(Session::has('cart'))
                            {{count(Session::get('cart'))}}
                        @else
                            0
                        @endif
                    </div>
                </a></li>
        </ul>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
            @if(Auth::check())
                <div class="dropdown ">
                    <button class="btn dropdown-toggle px-0" data-toggle="dropdown">
                        <a class="hover"><i class="fa fa-user mr-2" aria-hidden="true"></i>{{ Auth::user()->fullname }}</a>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('gd.history')}}"><i class="fa fa-history mr-2"
                                aria-hidden="true"></i>Lịch sử đặt hàng</a>
                        <a class="dropdown-item" href="{{ route('gd.logout') }}"><i class="fa fa-sign-out mr-2"
                                aria-hidden="true"></i>Thoát</a>

                    </div>
                </div>
            @else

            <button type="button" class="px-0 btn btn-link link-login" data-toggle="modal" data-target="#loginModal"><i
                    class="fa fa-sign-in mr-2" aria-hidden="true"></i>
                Đăng nhập</button>
            <!-- Button to Open Registration Modal -->
            @endif          
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-2">
                    <div class="header__logo">
                        @foreach($logo as $logoItem)
                            <a class="" href="{{route('gd.home')}}"><img
                                    src="{{ asset('public/file/img/img_logo/' . $logoItem->image) }}" alt=""
                                    class="img_logo"></a>
                        @endforeach
                    </div>
                </div>

                <li class="d-flex align-items-center justify-content-center col-xl-6 col-lg-6 list-unstyled">
                                <form class="d-flex" action="{{route("gd.search")}}" method="GET">
                                    <div class="search input-group">
                                        <div class="search-box">
                                            <div class="search-field ">
                                                <input placeholder="Tìm kiếm sản phẩm..." name="keyword" class="input"
                                                    type="text" class="form-control">
                                                <div class="search-box-icon input-group-append">
                                                    <button class=" btn-icon-content" type="submit">
                                                        <i class="search-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                                viewBox="0 0 512 512">
                                                                <path
                                                                    d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"
                                                                    fill="#228b22"></path>
                                                            </svg>
                                                        </i>
                                                    </button>
                                                </div>

                                            </div>
                                        </div>

                                </form>
                </li>
                <div class="col-lg-3">
                    <div class="header__right">
                        <div class="header__right__auth">


                            @if(Auth::check())
                                <div class="dropdown ">
                                    <button class="btn " data-toggle="dropdown">
                                        <a class="hover"><i class="fa fa-user mr-2"
                                                aria-hidden="true"></i>{{ Auth::user()->fullname }}</a>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{route('gd.history')}}"><i
                                                class="fa fa-history mr-2" aria-hidden="true"></i>Lịch sử đặt hàng</a>
                                        <a class="dropdown-item" href="{{ route('gd.logout') }}"><i
                                                class="fa fa-sign-out mr-2" aria-hidden="true"></i>Thoát</a>

                                    </div>
                                </div>


                            @else

                            <button type="button" class="btn btn-link link-login " data-toggle="modal"
                                data-target="#loginModal"><i class="fa fa-sign-in mr-2" aria-hidden="true"></i>Đăng
                                nhập</button>
                            <!-- Button to Open Registration Modal -->
                            @endif                          
                        </div>

                        <ul class="header__right__widget">
                            <!-- <li><span class="icon_search search-switch"></span></li> -->

                            <li><a href="{{route('gd.cart')}}"><span class="icon_cart_alt"></span>
                                    <div class="tip">
                                        @if(Session::has('cart'))
                                            {{count(Session::get('cart'))}}
                                        @else
                                            0
                                        @endif
                                    </div>
                                </a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div >
                <div class="col-xl-12 col-lg-7 d-flex align-items-center justify-content-center">
                    <nav class="header__menu">
                        <ul class="m-auto">
                          
                            <li class=" {{ request()->routeIs('gd.home') ? 'active' : '' }}"><a
                                    href="{{route('gd.home')}}">Trang chủ</a></li>

                            <li class="{{ request()->routeIs('gd.product') ? 'active' : '' }}"><a aria-current="page"
                                    href="{{route('gd.product', 0)}}">Sản phẩm</a></li>
                            <!-- <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="./product-details.html">Product Details</a></li>
                                    <li><a href="./shop-cart.html">Shop Cart</a></li>
                                    <li><a href="./checkout.html">Checkout</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li>
                                </ul>
                            </li> -->
                            <!-- <li><a href="./blog.html">Blog</a></li> -->
                            <li><a href="./contact.html">Liên hệ</a></li>
                           

                        </ul>
                    </nav>
                </div>
                </div>


            <div class="canvas__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->


    @yield('content')
    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-7">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="./index.html"><img src="img/logo.png" alt=""></a>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                            cilisis.</p>
                        <div class="footer__payment">
                            <a href="#"><img src="img/payment/payment-1.png" alt=""></a>
                            <a href="#"><img src="img/payment/payment-2.png" alt=""></a>
                            <a href="#"><img src="img/payment/payment-3.png" alt=""></a>
                            <a href="#"><img src="img/payment/payment-4.png" alt=""></a>
                            <a href="#"><img src="img/payment/payment-5.png" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-5">
                    <div class="footer__widget">
                        <h6>Quick links</h6>
                        <ul>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Blogs</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">FAQ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <div class="footer__widget">
                        <h6>Account</h6>
                        <ul>
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Orders Tracking</a></li>
                            <li><a href="#">Checkout</a></li>
                            <li><a href="#">Wishlist</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 col-sm-8">
                    <div class="footer__newslatter">
                        <h6>NEWSLETTER</h6>
                        <form action="#">
                            <input type="text" placeholder="Email">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </footer>
    <!-- Footer Section End -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Js Plugins -->
    <script src="{{asset('public/interface')}}/js/wow.min.js"></script>
    <script>
        //khởi tạo wow
        new WOW().init();
    </script>

    <script>
        $(document).ready(function () {
            @if ($errors->login->any())
                $('#loginModal').modal('show');
            @endif

            @if ($errors->register->any())
                $('#registerModal').modal('show');
            @endif

            @if (session('registration_success'))
                $('#loginModal').modal('show');
            @endif
        });
    </script>


    @include('interface.pages.login')
    @include('interface.pages.register')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="{{asset('public/interface')}}/js/bootstrap.min.js"></script>
    <script src="{{asset('public/interface')}}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{asset('public/interface')}}/js/jquery-ui.min.js"></script>
    <script src="{{asset('public/interface')}}/js/mixitup.min.js"></script>
    <script src="{{asset('public/interface')}}/js/jquery.countdown.min.js"></script>
    <script src="{{asset('public/interface')}}/js/jquery.slicknav.js"></script>
    <script src="{{asset('public/interface')}}/js/owl.carousel.min.js"></script>
    <script src="{{asset('public/interface')}}/js/jquery.nicescroll.min.js"></script>
    <script src="{{asset('public/interface')}}/js/main.js"></script>
    <script src="{{asset('public/interface')}}/js/login.js"></script>

    @stack('scripts')

</body>

</html>