@extends('frontend.includes.master')
@section('frontend')
    <div class="catagary_section_2">
        <div class="container-fluid">
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4" style="margin-top: 20px">
                        <div class="box_man"><a href="{{ url('/single_product/' . $product->id) }}">
                                <h3 class="mobile_text">{{ $product->category_name }}</h3>
                                <div class="mobile_img"><img style="width:60%;
                            max-height:300px;"
                                        class="img-fluid img-thumbnail"
                                        src="{{ url('/') . '/' . $product->product_image }}">
                                </div>
                                <div class="cart_main">
                                    <div class="col-sm-10">
                                        <h4 class="samsung_text">{{ $product->product_name }}</h4>
                                    </div>
                                    <h6 class="rate_text"><a href="#">₹{{ $product->product_price }}</a></h6>
                                    <div class="col-sm-4">
                                        <form action="{{ route('frontend.Add.product.cart') }}" method="POST">
                                            @csrf
                                            <input type="hidden" class="form-control" id="product_id" name="product_id"
                                                value="{{ $product->id }}">
                                            <input type="hidden" class="form-control" id="product_price"
                                                name="product_price" value="{{ $product->product_price }}">
                                            <input type="number" class="form-control" id="txtquantity" name="txtquantity"
                                                value="1" placeholder="quantity">
                                    </div>
                                    <button id="btncart" type="submit" class="btn btn-primary shop-button">
                                        Add To Cart
                                    </button>
                                    </form>
                                </div>
                        </div></a>
                    </div>
                @endforeach
            </div>
        </div>
    @endsection
