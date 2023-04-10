@extends('frontend.includes.master')
@section('frontend')
    <!-- banner section end -->
    <!-- catagary section start -->
    <div class="catagary_section layout_padding">
        <div class="container">
            <div class="catagary_main">
                <div class="catagary_left">
                    <h2 class="categary_text">Categary</h2>
                </div>
                <div class="catagary_right">
                    <div class="catagary_menu">
                        <ul>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="catagary_section_2">
        <div class="container-fluid">
            <div class="row">
                @foreach ($products as $product)
                <div class="col-md-4" style="margin-top: 20px">
                    <div class="box_man">
                        <h3 class="mobile_text">{{$product->category_name}}</h3>
                        <div class="mobile_img"><img style="width:100%;
                            max-height:400px;" class="img-fluid img-thumbnail" src="{{url('/').'/'.$product->product_image }}"></div>
                        <div class="cart_main">
                            {{-- <div class="cart_bt"><a href="#">Add To Cart</a></div> --}}
                            <h4 class="samsung_text">{{$product->product_name}}</h4>
                            <h6 class="rate_text"><a href="#">$500</a></h6>
                            <h6 class="rate_text_1">$1000</h6>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- catagary section end -->
@endsection
