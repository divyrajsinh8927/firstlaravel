@extends('frontend.includes.master')
@section('frontend')
    <!-- banner section end -->
    {{-- {{print_r($perentCategoriesArray)}} --}}
    <!-- catagary section start -->
    <div class="catagary_section_2">
        <div class="container-fluid">
            <div class="row">
                @foreach ($products as $product)
                <div class="col-md-4" style="margin-top: 20px">
                    <div class="box_man">
                        <h3 class="mobile_text">{{$product->category_name}}</h3>
                        <div class="mobile_img"><img style="width:60%;
                            max-height:300px;" class="img-fluid img-thumbnail" src="{{url('/').'/'.$product->product_image }}"></div>
                        <div class="cart_main">
                            
                            <div class="cart_bt"><a href="#">Add To Cart</a></div>
                            <h4 class="samsung_text">{{$product->product_name}}</h4>
                            <h6 class="rate_text"><a href="#">₹{{$product->product_price}}</a></h6>
                            {{-- <h6 class="rate_text_1">$1000</h6> --}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
            <!-- catagary section end -->
@endsection
