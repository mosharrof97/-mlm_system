<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard </title>

    {{-- Font Awesome CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- Font Awesome CDN --}}

    {{-- Bootstrap --}}
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />
    {{-- Bootstrap --}}

    {{-- Custome CSS --}}
    <link href="{{ asset('assets/css/dashboard.styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/styles.min.css') }}" rel="stylesheet" />
    {{-- Custome CSS --}}

 {{-- ------ Custome Css ----- --}}
 <link href="{{ asset('assets/css/user_dashboard.style.css') }}" rel="stylesheet" />
 {{-- ------ Custome Css ----- --}}

  {{-- -------Dashboard jQuery ------ --}}
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  {{-- -------Dashboard jQuery ------ --}}
    
  

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    
</head>

<body class="sb-nav-fixed">

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
                                <a href="{{ url('admin/dashboard') }}"
                                    class="btn btn-toggle d-inline-flex align-items-center rounded border-0 ">
                                    <i class="fa-solid fa-gauge btn-icon"></i><span> Dashboard</span>
                                </a>
                            </li>

                            <li class="sidebar-item custom-border ps-2">
                                <a href="{{ url('admin/dashboard') }}"
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
                                        <li><a href="#"
                                                class="list-color  d-inline-flex align-items-center text-decoration-none rounded">
                                                <i class="fa-solid fa-angle-right btn-icon-child "></i><span>Product
                                                    Subscription</span></a>
                                        </li>

                                        <li><a href="#"
                                                class="list-color  d-inline-flex align-items-center text-decoration-none rounded">
                                                <i class="fa-solid fa-angle-right btn-icon-child "></i><span>My Orders</span></a>
                                        </li>

                                    </ul>
                                </div>
                            </li>

                            <li class="sidebar-item custom-border ps-2">
                                <a href="{{ url('admin/network') }}"
                                    class="btn btn-toggle d-inline-flex align-items-center rounded border-0 ">
                                    <i class="fa-solid fa-gauge btn-icon"></i><span> Network</span>
                                </a>
                            </li>

                            <li class="sidebar-item custom-border ps-2">
                                <a href="{{ url('admin/dashboard') }}"
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
                                        <li><a href="{{route('admin_e_wallet')}}"
                                                class="list-color  d-inline-flex align-items-center text-decoration-none rounded">
                                                <i class="fa-solid fa-angle-right btn-icon-child "></i><span>My E  Wallet</span></a>
                                        </li>

                                        <li><a href="{{url('admin/deposit-wallet')}}"
                                                class="list-color  d-inline-flex align-items-center text-decoration-none rounded">
                                                <i class="fa-solid fa-angle-right btn-icon-child "></i><span>Deposit Wallet</span></a>
                                        </li>

                                        <li><a href="{{route('admin_view_transfer')}}"
                                                class="list-color  d-inline-flex align-items-center text-decoration-none rounded">
                                                <i class="fa-solid fa-angle-right btn-icon-child "></i><span>Fund  Transfer</span></a>
                                        </li>

                                        <li><a href="{{route('admin-withdraw')}}"
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


                            {{-- <li class="sidebar-item custom-border">
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
                            </li> --}}


                            <li class="sidebar-item custom-border ps-2">
                                <a href="{{ url('admin/dashboard') }}"
                                    class="btn btn-toggle d-inline-flex align-items-center rounded border-0 ">
                                    <i class="fa-solid fa-gauge btn-icon"></i><span> Income Report</span>
                                </a>
                            </li>

                            {{-- <li class="sidebar-item custom-border ps-2">
                                <a href="{{ url('admin/dashboard') }}"
                                    class="btn btn-toggle d-inline-flex align-items-center rounded border-0 ">
                                    <i class="fa-solid fa-gauge btn-icon"></i><span> Notice</span>
                                </a>
                            </li> --}}

                            <li class="sidebar-item custom-border">
                                <button
                                    class="  custom-padding btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                                    data-bs-toggle="collapse" data-bs-target="#notice" aria-expanded="false">
                                    <div class=" d-flex justify-content-between">
                                        <div><i class="fa-solid fa-gauge btn-icon"></i><span> Notice</span></div>
                                    </div> 
                                </button>
                                <div class="collapse" id="notice" style="">
                                    <ul class="list-bg-color btn-toggle-nav list-unstyled fw-normal pb-1 ps-4 small">
                                        <li>
                                            <a href="{{route('admin-allNotice')}}"
                                                class="list-color  d-inline-flex align-items-center text-decoration-none rounded"><i
                                                    class="fa-solid fa-angle-right btn-icon-child "></i><span>All Notice</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('admin-addNotice')}}"
                                                class="list-color  d-inline-flex align-items-center text-decoration-none rounded"><i
                                                    class="fa-solid fa-angle-right btn-icon-child "></i><span>Add Notice</span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>

                            <li class="sidebar-item custom-border">
                                <button
                                    class="  custom-padding btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                                    data-bs-toggle="collapse" data-bs-target="#user" aria-expanded="false">
                                    <div class=" d-flex justify-content-between">
                                        <div><i class="fas fa-users btn-icon"></i><span> User</span></div>
                                    </div> 
                                </button>
                                <div class="collapse" id="user" style="">
                                    <ul class="list-bg-color btn-toggle-nav list-unstyled fw-normal pb-1 ps-4 small">
                                        <li>
                                            <a href="#"
                                                class="list-color  d-inline-flex align-items-center text-decoration-none rounded"><i
                                                    class="fa-solid fa-angle-right btn-icon-child "></i><span>All User</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ url('/register') }}"
                                                class="list-color  d-inline-flex align-items-center text-decoration-none rounded"><i
                                                    class="fa-solid fa-angle-right btn-icon-child "></i><span>Add User</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#"
                                                class="list-color  d-inline-flex align-items-center text-decoration-none rounded"><i
                                                    class="fa-solid fa-angle-right btn-icon-child "></i><span>Role</span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>

                            <li class="sidebar-item custom-border ps-2">
                                <a href="{{ route('admin_profile') }}"
                                    class="btn btn-toggle d-inline-flex align-items-center rounded border-0 ">
                                    <i class="fa-solid fa-gauge btn-icon"></i><span> My Profile</span>
                                </a>
                            </li>

                            <li class="sidebar-item custom-border ps-2">
                                <a href="{{ url('admin/dashboard') }}"
                                    class="btn btn-toggle d-inline-flex align-items-center rounded border-0 ">
                                    <i class="fa-solid fa-gauge btn-icon"></i><span> Help Center</span>
                                </a>
                            </li>

                            <li class="sidebar-item custom-border ps-2">
                                <a href="{{ url('admin/dashboard') }}"
                                    class="btn btn-toggle d-inline-flex align-items-center rounded border-0 ">
                                    <i class="fa-solid fa-gauge btn-icon"></i><span> Blogs</span>
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
                                    @if (Auth::user()->image !== null)
                                        <img src="{{ asset('upload/BlogImage/'.Auth::user()->image) }}" alt="Mosharrof" width="35" height="35"
                                        class="rounded-circle">
                                    @else
                                        <img src="https://static.vecteezy.com/system/resources/previews/020/765/399/non_2x/default-profile-account-unknown-icon-black-silhouette-free-vector.jpg" alt="Mosharrof" width="35" height="35"
                                        class="rounded-circle" style="border: 2px solid black;  ">
                                    @endif

                                    
                                </a>
                            </li>

                            {{-- <li class="nav-item ">
                                <a class="profile">
                                    <span class="profile-name">My Profile</span>
                                </a>
                            </li> --}}

                            <li class="nav-item ">
                                <a class="profile">
                                    <span class="profile-name">{{Auth::user()->name}}</span>
                                </a>
                            </li>

                            <li>
                                {{-- <a class="btn  btn-auth mx-3" href="{{ route('logout')}}">Log out</a> --}}
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
            <div class="container-fluid">
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

    {{--------- Custom Js Start ------ --}}
    <script src="{{ asset('assets\js\dashboard.scripts.js') }}"></script>
    {{--------- Custom Js End --- --}}

    {{--------- Dashboard Datatables Js Start ------}}
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/dashboard.datatables-simple-demo.js') }}"></script>
    {{--------- Dashboard Datatables Js End ------}}

</body>

</html>