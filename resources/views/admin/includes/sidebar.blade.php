<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Datatable - srtdash</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/metisMenu.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/slicknav.min.css') }}">
    <link href="{{ asset('admin/assets/css/bootstrap-editable.css') }}" rel="stylesheet" />

    <!-- amcharts css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css"
        media="all" />
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/jquery.dataTables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/responsive.jqueryui.min.css') }}">
    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/typography.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/default-css.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/responsive.css') }}">
    <!-- modernizr css -->
    <script src="{{ asset('admin/assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>

    <script src="{{ asset('admin/assets/js/vendor/jquery.min.js') }}"></script>


    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>

    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="index.html"><img src="{{ asset('media/appLogo.png') }}" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i
                                        class="ti-dashboard"></i><span>dashboard</span></a>
                                <ul class="collapse">
                                    <li><a href="#">hello 1</a></li>
                                    <li><a href="#">hello 2</a></li>
                                    <li><a href="#">hello 3</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('admin.list') }}"><i class="ti-map-alt"></i> <span>Users</span></a>
                            </li>
                            <li><a href="{{ route('admin.categories') }}"><i class="ti-map-alt"></i>
                                    <span>Categories</span></a></li>
                            <li><a href="{{ route('admin.products') }}"><i class="ti-receipt"></i>
                                    <span>Products</span></a></li>
                            <li><a href="{{ route('Admin.Order.Management') }}"><i class="ti-receipt"></i>
                                    <span>Orders</span></a></li>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
