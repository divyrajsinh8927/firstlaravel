@extends('frontend.includes.master')
@section('frontend')
    @if (empty($cartProducts['cart']['product']))
        <div class="col-md-4" style="margin-top: 20px">
            <h1 style="align-self: center">No Item In Cart</h1>
        </div>
    @else
        <button onclick="startFCM()" class="btn btn-danger btn-flat">Allow notification
        </button>
        <div class="catagary_section_2">
            <div class="container-fluid">
                <div class="row">
                    @foreach ($cartProducts['cart']['product'] as $cartProduct_key => $cartProduct_value)
                        <div class="col-md-4" style="margin-top: 20px">
                            <div class="box_man"><a href="{{ url('/single_product/' . $cartProduct_value['product_id']) }}">
                                    <h3 class="mobile_text">{{ $cartProduct_value['category_name'] }}</h3>
                                    <div class="mobile_img"><img
                                            style="width:60%;
                            max-height:300px;"
                                            class="img-fluid img-thumbnail"
                                            src="{{ url('/') . '/' . $cartProduct_value['product_image'] }}">
                                    </div>
                                    <div class="cart_main">
                                        <div class="col-sm-10">
                                            <h4 class="samsung_text">{{ $cartProduct_value['product_name'] }}</h4>
                                        </div>
                                        <h6 class="rate_text"><a
                                                href="#">₹{{ $cartProduct_value['product_price'] }}</a>
                                        </h6>
                                        <div class="col-sm-4">
                                            <form action="{{ route('frontend.cart.order.product') }}" method="POST">
                                                @csrf
                                                <input type="hidden" class="form-control" id="product_id" name="product_id"
                                                    value="{{ $cartProduct_value['product_id'] }}">
                                                <input type="hidden" class="form-control" id="product_price"
                                                    name="product_price" value="₹{{ $cartProduct_value['product_price'] }}">
                                                <input type="hidden" class="form-control" id="txtquantity"
                                                    name="txtquantity" value="0" placeholder="quantity">
                                                <input type="number" class="form-control" id="dispQuantity"
                                                    name="dispQuantity" value="{{ $cartProduct_value['product_quantity'] }}"
                                                    placeholder="quantity" readonly>
                                        </div>
                                        <div class="col-sm-4">
                                            <button id="btncart" type="submit" class="btn btn-primary shop-button">
                                                Remove Cart
                                            </button>
                                        </div>
                                        </form>
                                    </div>
                                    <button type="button" class="btn btn-success shop-button" type="button"
                                        data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"
                                        style="margin-left: 35% ">Buy
                                        Now</button>
                            </div></a>
                        </div>

                        <div class="modal fade bd-example-modal-lg" tabindex="-1" id="exampleModal" tabindex="-1"
                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="{{ route('frontend.cart.order.product') }}">
                                        @csrf
                                        <input type="hidden" class="form-control" id="all" name="all"
                                            value="false">
                                        <input type="hidden" class="form-control" id="product_id" name="product_id"
                                            value="{{ $cartProduct_value['product_id'] }}">
                                        <input type="hidden" class="form-control" id="txtquantity" name="txtquantity"
                                            value="{{ $cartProduct_value['product_quantity'] }}">
                                        <input type="hidden" class="form-control" id="txtprice" name="txtprice"
                                            value="{{ $cartProduct_value['product_price'] }}">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="message-text" class="col-form-label">Message:</label>
                                                <textarea class="form-control" id="txtAddress" name="txtAddress"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div><br><br><br>
            <label style="margin-left: 1% ;font-weight: bold;font-size: 20px">Quantity: </label>
            <label
                style="margin-left: 5% ;font-weight: bold;font-size: 20px">{{ $cartProducts['cart']['product_total']['total_quantity'] }}</label><br>
            <hr style="height:2px;border-width:0;color:gray;background-color:gray;margin-left: 1% ;width: 350px;">
            <label style="margin-left: 1% ;font-weight: bold;font-size: 20px">SubPrice: </label>
            <label
                style="margin-left: 5% ;font-weight: bold;font-size: 20px">{{ $cartProducts['cart']['product_total']['sub_total_price'] }}</label><br>
            <hr style="height:2px;border-width:0;color:gray;background-color:gray;margin-left: 1% ;width: 350px;">
            <button id="orderAll" type="button" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"
                class="btn btn-success shop-button" style="margin-left: 1% ;">Buy
                All Now</button>
    @endif
    <script>
        window.addEventListener('DOMContentLoaded', function(event) {
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $("#orderAll").click(function(e) {
                    e.preventDefault();
                    document.getElementById("all").value = "true";
                });
            });
        });
    </script>
@endsection
