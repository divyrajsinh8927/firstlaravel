@extends('frontend.includes.master')
@section('frontend')
    <div class="catagary_section_2">
        <div class="container-fluid">
            <div class="row">
                @if (empty($cartProducts))
                <div class="col-md-4" style="margin-top: 20px">
                    <h1 style="align-self: center">No Item In Cart</h1>
                </div>
                @else
                    @foreach ($cartProducts as $cartProduct)
                        <div class="col-md-4" style="margin-top: 20px">
                            <div class="box_man"><a href="{{ url('/single_product/' . $cartProduct['product_id']) }}">
                                    <h3 class="mobile_text">{{ $cartProduct['category_name'] }}</h3>
                                    <div class="mobile_img"><img
                                            style="width:60%;
                            max-height:300px;"
                                            class="img-fluid img-thumbnail"
                                            src="{{ url('/') . '/' . $cartProduct['product_image'] }}">
                                    </div>
                                    <div class="cart_main">
                                        <div class="col-sm-10">
                                            <h4 class="samsung_text">{{ $cartProduct['product_name'] }}</h4>
                                        </div>
                                        <h6 class="rate_text"><a href="#">₹{{ $cartProduct['product_price'] }}</a>
                                        </h6>
                                        <div class="col-sm-4">
                                            <form action="{{ route('frontend.Add.product.cart') }}" method="POST">
                                                @csrf
                                                <input type="hidden" class="form-control" id="product_id" name="product_id"
                                                    value="{{ $cartProduct['product_id'] }}">
                                                <input type="hidden" class="form-control" id="product_price"
                                                    name="product_price" value="₹{{ $cartProduct['product_price'] }}">
                                                <input type="hidden" class="form-control" id="txtquantity"
                                                    name="txtquantity" value="0" placeholder="quantity">
                                                <input type="number" class="form-control" id="dispQuantity"
                                                    name="dispQuantity" value="{{ $cartProduct['product_quantity'] }}"
                                                    placeholder="quantity" readonly>
                                        </div>
                                        <div class="col-sm-4">
                                            <button id="btncart" type="submit" class="btn btn-primary shop-button">
                                                Remove Cart
                                            </button>
                                        </div>
                                        </form>
                                    </div>
                            </div></a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    @endsection
