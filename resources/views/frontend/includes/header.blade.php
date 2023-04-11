<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Frica</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}">
    <!-- Responsive-->
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <!-- fevicon -->
    <link rel="icon" href="{{ asset('media/fevicon.png') }}" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.mCustomScrollbar.min.css') }}">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

</head>
<div class="container-fluid">

    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm p-1  bg-white ">
        <a class="navbar-brand" href="">
            <img src="{{ asset('media/appLogo.png') }}" alt="Logo" style="height: 85px;width: 100%" />
        </a>
        <button type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbars"
            aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarContent" class="collapse navbar-collapse">
            <ul class="navbar-nav mx-auto">
                @foreach ($cat_data as $perentCategoriesArray_key => $perent_value)
                    <li class="nav-item dropdown megamenu" id="subid"><a id="megamneu" href=""
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            class="nav-link dropdown-toggle font-weight-bold text-uppercase">{{ $perent_value['cat_name'] }}</a>
                        <div aria-labelledby="megamneu" class="dropdown-menu border-0 p-0 m-0">
                            <div class="container">
                                <div class="row bg-white rounded-0 m-0 shadow-sm">
                                    <div class="col-lg-7 col-xl-8">
                                        <div class="p-4">
                                            <div class="row">
                                                <div class="col-lg-6 mb-4">
                                                    <ul class="list-unstyled">
                                                        @foreach ($perent_value['sub_cat'] as $sub_cat_key => $sub_cat_value)
                                                            <li class="nav-item"><a href="{{url('/sub_cat_product/'.$sub_cat_key)}}"
                                                                    class="nav-link text-small pb-0">{{ $sub_cat_value['sub_cat_name'] }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-xl-4 px-0 d-none d-lg-block"
                                        style="background: center center url(https://images.unsplash.com/photo-1533637267520-4dfd6aa7ee93?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1268&q=80)no-repeat; background-size: cover;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="form-group has-search" style="margin-top: 1%">
                <span class="fa fa-search form-control-feedback"></span>
                <input type="text" class="form-control" placeholder="Search for Products Branda and More" />
            </div>
        </div>

    </nav>
</div>
