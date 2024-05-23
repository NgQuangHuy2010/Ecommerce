<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Farm Admin </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('public')}}/file/img/img_logo/1713069730_share_fb_home.png ">


    <link href="{{asset('public')}}/webadmin/assets/css/style.css" rel="stylesheet">


    <link href="{{asset('public')}}/webadmin/assets/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="{{asset('public')}}/editor/ckeditor/ckeditor.js"></script>

</head>

<body>
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

    <div id="main-wrapper">


        <div class="nav-header ">
            <a href="index.html" class="brand-logo d-flex justify-content-center mx-0">

                <?php foreach ($logo as $value) { ?>
                <img class="brand-title " src="{{ asset('public/file/img/img_logo/' . $value->image) }}" alt="">

                <?php } ?>
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <div class="header">
                <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form>
                                        <input class="form-control" type="search" placeholder="Search"
                                            aria-label="Search">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-bell"></i>
                                    <div class="pulse-css"></div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="list-unstyled">
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-user"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Martin</strong> has added a <strong>customer</strong>
                                                        Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-shopping-cart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Jennifer</strong> purchased Light Dashboard 2.0.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="danger"><i class="ti-bookmark"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Robin</strong> marked a <strong>ticket</strong> as
                                                        unsolved.
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-heart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>David</strong> purchased Light Dashboard 1.0.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-image"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong> James.</strong> has added a<strong>customer</strong>
                                                        Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                    </ul>
                                    <a class="all-notification" href="#">See all notifications <i
                                            class="ti-arrow-right"></i></a>
                                </div>
                            </li>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{asset('public')}}/webadmin/assets/app-profile.html"
                                        class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="{{asset('public')}}/webadmin/assets/email-inbox.html"
                                        class="dropdown-item">
                                        <i class="icon-envelope-open"></i>
                                        <span class="ml-2">Inbox </span>
                                    </a>
                                    <a href="{{asset('public')}}/webadmin/assets/page-login.html" class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li><a href="{{route('ht.logo')}}" aria-expanded="false"><i class="fa fa-user "></i><span class="nav-text">Quản lý
                                user</span></a></li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class=" fa fa-list"></i><span class="nav-text">Danh sách sản phẩm</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('ht.categorie')}}">Danh mục</a></li>
                            <li><a href="{{route('ht.products')}}">Sản phẩm</a></li>
                        </ul>
                    </li>
                    <li><a href="{{route('ht.logo')}}" aria-expanded="false"><i class="fa fa-address-card "></i><span
                                class="nav-text">Logo</span></a></li>

                    <li><a href="{{route('ht.banner')}}" aria-expanded="false"><i class="fa fa-file-image-o "></i><span
                                class="nav-text">Banner</span></a></li>
                    <li><a href="{{route('ht.order')}}" aria-expanded="false"><i class="fa fa-line-chart "></i><span
                                class="nav-text">Đơn hàng</span></a></li>
                </ul>
            </div>
        </div>
        @yield('content')
    </div>
    <!-- Required vendors -->
    <script src="{{asset('public')}}/webadmin/assets/vendor/global/global.min.js"></script>
    <script src="{{asset('public')}}/webadmin/assets/js/quixnav-init.js"></script>
    <script src="{{asset('public')}}/webadmin/assets/js/custom.min.js"></script>
    <script src="{{asset('public')}}/webadmin/assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('public')}}/webadmin/assets/js/plugins-init/datatables.init.js"></script>
</body>

</html>