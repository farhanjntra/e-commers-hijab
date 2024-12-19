<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content='IE=edge' http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Panel</title>
    <link rel="shortcut icon" type="image/png" href="#">

    <!-- Core Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/line-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.mCustomScrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-slider.css') }}">

    <!-- Custom Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.min.css') }}">
</head>

<body>
    <!-- Setting Box -->
    <div class="theme-setting-wrapper">
        <button type="button" id="settings-trigger" class="btn btn-primary waves-effect waves-primary">
            <i class="la la-cog"></i>
        </button>
        <div class="theme-setting-sidebar">
            <div class="h-100">
                <div class="mt-4 d-flex align-items-center flex-wrap px-4">
                    <h4 class="font-weight-bold">THEME CUSTOMIZER</h4>
                    <small>Customize &amp; Preview in Real Time</small>
                </div>
                <hr>
                <div class="theme-setting-sidebar-scroll">
                    <div class="px-4">
                        <div>
                            <h5 class="mb-2">Dark Mode</h5>
                            <div class="d-flex align-items-center">
                                <div class="radio theme-radio mr-4">
                                    <input type="radio" id="light" name="light" value="theme-light">
                                    <label for="light">Light</label>
                                </div>
                                <div class="radio theme-radio mr-4">
                                    <input type="radio" id="dark" name="light" value="theme-dark">
                                    <label for="dark">Dark</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>

    <!-- Left Panel -->
    <div class="br-sideleft">
        <a id="remove-menu" class="la la-close d-xl-none"></a>
        <div class="br-logo d-flex justify-content-center align-items-center">
            <a href="index.html"><img src="{{ asset('assets/image/logo.png') }}" alt="Admin Panel" width="80" /></a>
        </div>
        <ul class="custom-scroll">
            <li class="@yield('menuDashboard')"><a href="{{ route('admin.dashboard') }}" class="waves-effect waves-primary"><i class="la la-dashboard"></i> Dashboard</a></li>
            <li class="@yield('menuBarang')"><a href="{{ route('barang.index') }}" class="waves-effect waves-primary"><i class="la la-clone"></i> Barang</a></li>
            <li class="@yield('menuKategori')"><a href="{{ route('kategori.index') }}" class="waves-effect waves-primary"><i class="la la-clone"></i> Kategori</a></li>
            <li><a href="{{ url('admin/orders') }}" class="waves-effect waves-primary"><i class="la la-cart-arrow-down"></i> Orders</a></li>
            <li><a href="javascript:;" class="waves-effect waves-primary"><i class="la la-wechat"></i> Messages</a></li>
            <li><a href="javascript:;" class="waves-effect waves-primary"><i class="la la-bank"></i> Payments</a></li>
            <li><a href="javascript:;" class="waves-effect waves-primary"><i class="la la-cog"></i> Settings</a></li>
        </ul>
    </div>

    <!-- Header Panel -->
    <header class="header fixed-top d-flex align-items-center">
        <div class="br-header d-flex w-100">
            <a id="add-menu" class="la la-navicon d-flex d-xl-none align-items-center justify-content-center"></a>
            <div class="br-header-left">
                <form class="searchbar d-flex align-items-center pl-3">
                    <i class="la la-search"></i>
                    <input class="form-control border-0 pl-2" type="search" placeholder="Search...">
                </form>
            </div>
            <div class="br-header-right ml-auto">
                <nav class="nav">
                    <div class="dropdown">
                        <a href="" class="nav-link position-relative dropdown-toggle waves-effect waves-primary" id="dropdownMSG" data-toggle="dropdown">
                            <i class="la la-envelope-o"></i>
                            <span class="badge badge-accent">2</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-header py-0" aria-labelledby="dropdownMSG">
                            <div class="dropdown-menu-label">
                                <label class="mb-0">Messages</label>
                                <button type="button" class="btn btn-primary btn-sm waves-effect waves-primary">View all</button>
                            </div>
                            <div class="media-list">
                                <a href="" class="media-list-link">
                                    <div class="media d-flex align-items-center py-2 px-2">
                                        <img src="{{ asset('assets/image/img1.jpg') }}" width="50" class="rounded-circle" alt="">
                                        <div class="media-body pl-3">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <strong>Donna Seay</strong>
                                                <span>2 minutes ago</span>
                                            </div>
                                            <p class="mb-0">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a href="" class="nav-link position-relative dropdown-toggle waves-effect waves-primary" id="dropdownNOTY" data-toggle="dropdown">
                            <i class="la la-bell"></i>
                            <span class="badge badge-accent">1</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-header py-0" aria-labelledby="dropdownNOTY">
                            <div class="dropdown-menu-label">
                                <label class="mb-0">NOTIFICATIONS</label>
                                <button type="button" class="btn btn-primary btn-sm waves-effect waves-light">View all</button>
                            </div>
                            <div class="media-list">
                                <a href="" class="media-list-link">
                                    <div class="media d-flex align-items-center py-2 px-2">
                                        <img src="{{ asset('assets/image/img1.jpg') }}" width="50" class="rounded-circle" alt="">
                                        <div class="media-body pl-3">
                                            <strong>Donna Seay</strong>
                                            <p class="mb-0">A wonderful serenity has taken possession of</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a href="" class="nav-link-profile d-flex dropdown-toggle" data-toggle="dropdown" id="dropdownprofile">
                            <img src="{{ asset('assets/image/img3.jpg') }}" class="rounded" alt="" width="50">
                            <span class="logged-name px-3">Admin <br><small class="pt-3">Admin</small></span>
                            <i class="profile-dropdown la la-caret-square-o-down"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-header dropdown-menu-user" aria-labelledby="dropdownprofile">
                            <div class="text-center">
                                <a href=""><img src="{{ asset('assets/image/img3.jpg') }}" width="80" class="rounded-circle" alt=""></a>
                                <h6 class="logged-fullname font-weight-bold mt-2">Zahir Patel</h6>
                                <p class="my-0">admin@gmail.com</p>
                            </div>
                            <hr>
                            <ul class="list-unstyled user-profile-nav">
                                <li><a href="javascript:;" class="waves-effect waves-light"><i class="la la-user"></i> Edit Profile</a></li>
                                <li><a href="javascript:;" class="waves-effect waves-light"><i class="la la-cog"></i> Settings</a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <li><a href="#" class="waves-effect waves-light" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="la la-power-off"></i> Sign Out</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Panel -->
    <section class="mainpanel">
        <div class="pagebody">
            @yield('content')
        </div>
    </section>

    <!-- Core JS -->
    <script src="{{ asset('assets/scripts/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/scripts/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/scripts/jquery.mCustomScrollbar.js') }}"></script>
    <script src="{{ asset('assets/scripts/dashboard.js') }}"></script>
    <script src="{{ asset('assets/scripts/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/scripts/custome.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>
