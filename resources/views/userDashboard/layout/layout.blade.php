<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    {{-- -------- CDN Link ------- --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- -------- CDN Link ------- --}}

    {{-- -------- Bootstrap ------- --}}
    <link href="{{ asset('assets\bootstrap\css\bootstrap.min.css') }}" rel="stylesheet" />
    {{-- -------- Bootstrap ------- --}}

    {{-- ------ Custome Css ----- --}}
    <link href="{{ asset('assets/css/user_dashboard.style.css') }}" rel="stylesheet" />
    {{-- ------ Custome Css ----- --}}

    {{-- -------Dashboard Css ------ --}}
    {{-- <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png') }}"  /> --}}
    <link href="{{ asset('assets/css/styles.min.css') }}" rel="stylesheet" />
    {{-- -------Dashboard Css ------ --}}

     {{-- -------Dashboard jQuery ------ --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
     {{-- -------Dashboard jQuery ------ --}}

    <title>User Dashboard</title>


</head>

<body id="body">
    {{-- Body Wrapper  --}}
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
         data-header-position="fixed">
        {{-- Sidebar Start  --}}
        <section class="left-sidebar">

            {{-- Sidebar scroll --}}
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="{{ url('admin/dashboard') }}" class="text-nowrap logo-img d-flex justify-content-center align-items-center">
                       
                        <img class="me-2 " src="{{asset('frontend/assets/img/logo.png')}}" width="55" height="55" alt="School">
                        <span class="text-black h4">MLM System</span>

                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i> 
                    </div>
                </div>

                {{-- Sidebar navigation --}}
                <div class="sidebar-nav mt-3">
                    <nav class="scroll-sidebar" data-simplebar="">

                        <ul id="sidebarnav">

                            <li class="nav-small-cap custom-border">
                                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                                <span class="hide-menu">Dashboard</span>
                            </li>

                            <li class="sidebar-item custom-border ps-2">
                                <a href="{{ url('/user-dashboard') }}"
                                    class="btn btn-toggle d-inline-flex align-items-center rounded border-0 ">
                                    <i class="fa-solid fa-gauge btn-icon"></i><span> Dashboard</span>
                                </a>
                            </li>

                            <li class="sidebar-item custom-border ps-2">
                                <a href="{{ url('/affiliate-dashboard') }}"
                                    class="btn btn-toggle d-inline-flex align-items-center rounded border-0 ">
                                    <i class="fa-solid fa-gauge btn-icon"></i><span> Affiliate Dashboard</span>
                                </a>
                            </li>

                            <li class="nav-small-cap custom-border">
                                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                                <span class="hide-menu">UI COMPONENTS</span>
                            </li>

                            <li class="sidebar-item custom-border">
                                <button
                                    class="custom-padding btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                                    data-bs-toggle="collapse" data-bs-target="#online-store" aria-expanded="false">
                                    <i class="fa-solid fa-graduation-cap btn-icon"></i><span> Online Store</span>
                                </button>
                                <div class="collapse" id="online-store" style="">
                                    <ul class="list-bg-color btn-toggle-nav list-unstyled fw-normal pb-1 ps-4 small">
                                        <li>
                                            <a href="#"
                                                class="list-color  d-inline-flex align-items-center text-decoration-none rounded">
                                                <i class="fa-solid fa-angle-right btn-icon-child  "></i><span>Product Subscription</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#"
                                                class="list-color  d-inline-flex align-items-center text-decoration-none rounded">
                                                <i class="fa-solid fa-angle-right btn-icon-child "></i><span>My
                                                    Orders</span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>

                            <li class="sidebar-item custom-border ps-2">
                                <a href="{{ url('/usernetwork') }}"
                                    class="btn btn-toggle d-inline-flex align-items-center rounded border-0 ">
                                    <i class="fa-solid fa-gauge btn-icon"></i><span> Network</span>
                                </a>
                            </li>

                            <li class="sidebar-item custom-border ps-2">
                                <a href="#"
                                    class="btn btn-toggle d-inline-flex align-items-center rounded border-0 ">
                                    <i class="fa-solid fa-gauge btn-icon"></i><span> My Subscription</span>
                                </a>
                            </li>

                            <li class="sidebar-item custom-border">
                                <button
                                    class="custom-padding btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                                    data-bs-toggle="collapse" data-bs-target="#financial-collapse" aria-expanded="false">
                                    <i class="fa-solid fa-graduation-cap btn-icon"></i><span> Financial</span>
                                </button>
                                <div class="collapse" id="financial-collapse" style="">
                                    <ul class="list-bg-color btn-toggle-nav list-unstyled fw-normal pb-1 ps-4 small">
                                        <li><a href="{{ url('/my-e-wallet')}}"
                                                class="list-color  d-inline-flex align-items-center text-decoration-none rounded">
                                                <i class="fa-solid fa-angle-right btn-icon-child "></i><span>My E  Wallet</span></a>
                                        </li>

                                        <li><a href="{{ url('/deposit-wallet')}}"
                                                class="list-color  d-inline-flex align-items-center text-decoration-none rounded">
                                                <i class="fa-solid fa-angle-right btn-icon-child "></i><span>Deposit Wallet</span></a>
                                        </li>

                                        <li><a href="{{url('/fund-transfer')}}"
                                                class="list-color  d-inline-flex align-items-center text-decoration-none rounded">
                                                <i class="fa-solid fa-angle-right btn-icon-child "></i><span>Fund  Transfer</span></a>
                                        </li>

                                        <li><a href="{{ route('withdraw') }}"
                                            class="list-color  d-inline-flex align-items-center text-decoration-none rounded">
                                            <i class="fa-solid fa-angle-right btn-icon-child "></i><span>Withdraw</span></a>
                                        </li>

                                        <li><a href="#"
                                                class="list-color  d-inline-flex align-items-center text-decoration-none rounded">
                                                <i class="fa-solid fa-angle-right btn-icon-child "></i><span>Request Payout</span></a>
                                        </li>

                                    </ul>
                                </div>
                            </li>
                            
                            <li class="sidebar-item custom-border">
                                <button
                                    class="  custom-padding btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                                    data-bs-toggle="collapse" data-bs-target="#business-builder" aria-expanded="false">
                                    <div class=" d-flex justify-content-between">
                                        <div><i class="fas fa-users btn-icon"></i><span> Business Builder</span></div>
                                    </div> 
                                </button>
                                <div class="collapse" id="business-builder" style="">
                                    <ul class="list-bg-color btn-toggle-nav list-unstyled fw-normal pb-1 ps-4 small">
                                        <li>
                                            <a href="#"
                                                class="list-color  d-inline-flex align-items-center text-decoration-none rounded"><i
                                                    class="fa-solid fa-angle-right btn-icon-child "></i><span>Subscriptions</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#"
                                                class="list-color  d-inline-flex align-items-center text-decoration-none rounded"><i
                                                    class="fa-solid fa-angle-right btn-icon-child "></i><span>Materials</span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>

                            <li class="sidebar-item custom-border ps-2">
                                <a href="{{ url('/income-report') }}"
                                    class="btn btn-toggle d-inline-flex align-items-center rounded border-0 ">
                                    <i class="fa-solid fa-gauge btn-icon"></i><span> Income Report</span>
                                </a>
                            </li>

                            <li class="sidebar-item custom-border ps-2">
                                <a href="{{ url('/my-profile') }}"
                                    class="btn btn-toggle d-inline-flex align-items-center rounded border-0 ">
                                    <i class="fa-solid fa-gauge btn-icon"></i><span> My Profile</span>
                                </a>
                            </li>

                            <li class="sidebar-item custom-border ps-2">
                                <a href="{{ url('/user-dashboard') }}"
                                    class="btn btn-toggle d-inline-flex align-items-center rounded border-0 ">
                                    <i class="fa-solid fa-gauge btn-icon"></i><span> Help Center</span>
                                </a>
                            </li>

                        </ul>

                    </nav>
                </div>
                {{-- -- End Sidebar navigation --}}
            </div>
            {{-- -- End Sidebar scroll --}}
        </section>
        {{-- --  Sidebar End --}}


        {{-- --  Main wrapper --}}
        <div class="body-wrapper">
            {{-- --  Header Start --}}
            <header class="app-header ">
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover text-black" id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="fa-solid fa-bars"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-icon-hover text-black" href="javascript:void(0)">
                                <i class="fa-regular fa-bell"></i>
                                <div class="notification  rounded-circle"></div>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

                            <li class="nav-item ">
                                <a class="profile ">
                                    <img src="{{ asset('upload/BlogImage/'.Auth::user()->image) }}" alt="Mosharrof" width="35" height="35"
                                        class="rounded-circle">
                                </a>
                            </li>
                            {{-- {{asset('upload/BlogImage/'.$data->blog_img)}} --}}
                            {{-- <li class="nav-item ">
                                <a class="profile">
                                    <span class="profile-name">My Profile</span>
                                </a>
                            </li> --}}

                            <li class="nav-item ">
                                <a class="profile">
                                    <span class="profile-name">{{ Auth::user()->name }}</span>
                                </a>
                            </li>

                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="btn  btn-auth mx-3" href="{{ route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();">Log out</a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            {{-- --  Header End --}}
            <div class="container-fluid bg-body-tertiary">
                {{-- --  Row 1 --}}

                @yield('content')


            </div>
        </div>
    </div>

    {{-- ----- Js CDN Start ---- --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    {{-- ----- Js CDN End ---- --}}

    {{-- ------- Chart CSS ---------- --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets\assets\demo\chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets\assets\demo\chart-bar-demo.js') }}"></script>
    <script src="{{ asset('assets\assets\demo\chart-pie-demo.js') }}"></script>
    {{-- ------- Chart CSS ---------- --}}

    {{-- ------- Bootstrap Js Start ------ --}}
    <script src="{{ asset('assets\bootstrap\js\bootstrap.bundle.min.js') }} "></script>
    <script src="{{ asset('assets\bootstrap\js\bootstrap.min.js') }} "></script>
    {{-- ------- Bootstrap Js Start ------ --}}


    {{-- ------- Custom Js Start ------ --}}
    <script src="{{ asset('assets\js\dashboard.scripts.js') }}"></script>
    {{-- ------- Custom Js End --- --}}
   
   

</body>

</html>
