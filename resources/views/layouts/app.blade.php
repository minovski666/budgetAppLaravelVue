<!DOCTYPE html>
<html lang="en">
<head>
    <title>Budget App</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- app favicon -->
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <!-- plugin stylesheets -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors.css" />
    <!-- app style -->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css" />

</head>

<body>
<!-- begin app -->
<div class="app">
    <!-- begin app-wrap -->
    <div class="app-wrap">
        <!-- begin pre-loader -->
        <div class="loader">
            <div class="h-100 d-flex justify-content-center">
                <div class="align-self-center">
                    <img src="../assets/img/loader/loader.svg" alt="loader">
                </div>
            </div>
        </div>
        <!-- end pre-loader -->
        <!-- begin app-header -->
        <header class="app-header top-bar">
            <!-- begin navbar -->
            <nav class="navbar navbar-expand-md">

                <!-- begin navbar-header -->
                <div class="navbar-header d-flex align-items-center">
                    <a class="mobile-toggle"><i class="ti ti-align-right"></i></a>
                    <a class="navbar-brand" href="{{url('/records')}}">
                        <img src="../assets/img/logo.png" class="img-fluid logo-desktop" alt="logo" />
                        <img src="../assets/img/logo-icon.png" class="img-fluid logo-mobile" alt="logo" />
                    </a>
                </div>
                <!-- end navbar-header -->
                <!-- begin navigation -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="navigation d-flex">
                        <ul class="navbar-nav nav-left">
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link sidebar-toggle">
                                    <i class="ti ti-align-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- end navigation -->
            </nav>
            <!-- end navbar -->
        </header>
        <!-- end app-header -->
        <!-- begin app-container -->
        <div class="app-container" id="app">
            <!-- begin app-nabar -->
            @include('layouts.side')
            <!-- end app-navbar -->
            <!-- begin app-main -->
{{--            @yield('content')--}}
            <div class="app-main" id="main">
                <!-- begin container-fluid -->
                <div class="container-fluid">
                    <!-- begin row -->
                    <div class="row">
                        <div class="col-md-12 m-b-30">
                            <!-- begin page title -->
                            <div class="d-block d-lg-flex flex-nowrap align-items-center">
                                <div class="page-title mr-4 pr-4 border-right">
                                    <h1>Dashboard</h1>
                                </div>
                                <div class="breadcrumb-bar align-items-center">
                                    <nav>
                                        <ol class="breadcrumb p-0 m-b-0">
                                            <li class="breadcrumb-item">
                                                <a href="index.html"><i class="ti ti-home"></i></a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                Dashboard
                                            </li>
                                            <li class="breadcrumb-item active text-primary" aria-current="page">Default</li>
                                        </ol>
                                    </nav>
                                </div>

                            </div>
                            <!-- end page title -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 m-b-30">
                            <h3>Budget</h3>
                            <router-view></router-view>
                            <flash message="{{ session('flash') }}"></flash>
                        </div>
                    </div>
                </div>
                <!-- end container-fluid -->
            </div>
            <!-- end app-main -->
        </div>
        <!-- end app-container -->
        <!-- begin footer -->
        <footer class="footer">
            <div class="row">
                <div class="col-12 text-center">
                    <p>&copy; Marko Minovski 2020</p>
                </div>
            </div>
        </footer>
        <!-- end footer -->
    </div>
    <!-- end app-wrap -->
</div>
<!-- end app -->

<!-- plugins -->
<script src="../assets/js/vendors.js"></script>

<!-- custom app -->
<script src="../assets/js/app.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
</body>


</html>
