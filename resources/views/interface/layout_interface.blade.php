<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Farm</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{asset('public/interface')}}/js/jquery-3.3.1.min.js"></script>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->

    <link rel="stylesheet" href="{{asset('public/interface')}}/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/interface')}}/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/interface')}}/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/interface')}}/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/interface')}}/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/interface')}}/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/interface')}}/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/interface')}}/css/style.css" type="text/css">
  
  

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>
        <ul class="offcanvas__widget">
            <li><span class="icon_search search-switch"></span></li>
           
            <li><a href="#"><span class="icon_bag_alt"></span>
                <div class="tip">  
                     @if(Session::has('cart'))
                                    {{count(Session::get('cart'))}}
                                    @else
                                    0
                                    @endif
                                </div>
            </a></li>
        </ul>
        <div class="offcanvas__logo">
         
       

        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
        @if(Auth::check())
        <a href="" class="hover">{{ Auth::user()->fullname }}</a>
        <a href="{{ route('gd.logout') }}" class="">Logout</a>
    @else
        <a href="{{ route('gd.login') }}" class="">Login</a>
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
                    <a href="{{route('gd.home')}}"><img src="{{ asset('public/file/img/img_logo/' . $logoItem->image) }}" alt="" class="img_logo"></a>
                    @endforeach
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7">
                    <nav class="header__menu">
                        <ul class="d-flex justify-content-center">
                            <li class=" {{ request()->routeIs('gd.home') ? 'active' : '' }}" ><a href="{{route('gd.home')}}">Trang chủ</a></li>
                          
                            <li  class="{{ request()->routeIs('gd.product') ? 'active' : '' }}"><a aria-current="page"  href="{{route('gd.product', 0)}}">Sản phẩm</a></li>
                            <!-- <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="./product-details.html">Product Details</a></li>
                                    <li><a href="./shop-cart.html">Shop Cart</a></li>
                                    <li><a href="./checkout.html">Checkout</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li>
                                </ul>
                            </li> -->
                            <li><a href="./blog.html">Blog</a></li>
                            <li><a href="./contact.html">Liên hệ</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">

                    <div class="header__right">
                    <div class="header__right__auth">
                    <div class="header__right__auth">
                        @if(Auth::check())
                            <a href="" class="hover">{{ Auth::user()->fullname }}</a>
                            <a href="{{ route('gd.logout') }}" class="">Logout</a>
                        @else
                            <a href="{{ route('gd.login') }}" class="">Login</a>
                        @endif  
                    </div>

                        <ul class="header__right__widget">
                            <li><span class="icon_search search-switch"></span></li>
                         
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

<!-- Search Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>
<!-- Search End -->

<!-- Js Plugins -->

<script src="{{asset('public/interface')}}/js/bootstrap.min.js"></script>
<script src="{{asset('public/interface')}}/js/jquery.magnific-popup.min.js"></script>
<script src="{{asset('public/interface')}}/js/jquery-ui.min.js"></script>
<script src="{{asset('public/interface')}}/js/mixitup.min.js"></script>
<script src="{{asset('public/interface')}}/js/jquery.countdown.min.js"></script>
<script src="{{asset('public/interface')}}/js/jquery.slicknav.js"></script>
<script src="{{asset('public/interface')}}/js/owl.carousel.min.js"></script>
<script src="{{asset('public/interface')}}/js/jquery.nicescroll.min.js"></script>
<script src="{{asset('public/interface')}}/js/main.js"></script>
@stack('scripts')

</body>

</html>