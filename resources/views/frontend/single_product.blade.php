@extends('frontend.includes.master')
@section('frontend')
    @foreach ($products as $product)
        <div class="single_product">
            <div class="container-fluid" style=" background-color: #fff; padding: 11px;">
                <div class="row">
                    <div class="col-lg-4 order-lg-2 order-1">
                        <div class="image_selected"><img src="{{ url('/') . '/' . $product->product_image }}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 order-3">
                        <div class="product_description">
                            <div class="product_name" style="text-transform: uppercase;font-size: 30px">
                                {{ $product->product_name }}</div>
                            <div class="rate_text" style="text-transform: uppercase;font-size: 40px;font-style: bold">Rs.
                                {{ $product->product_price }}</div>
                            <div class="product-rating"><span class="badge badge-success" style="font-size: 15px"><i
                                        class="fa fa-star"></i> 4.5
                                    Star</span> </div>
                            <hr class="singleline">
                        </div>
                        <div class="product_description">
                            <div class="product_name" style="text-transform: uppercase">Description</div>
                        </div>
                        <div><br> <span class="product_info">{{ $product->product_description }}<span><br>
                        </div>
                        <div>
                        </div>
                        <hr class="singleline"><br>
                        <div class="col-xs-6"> <button type="button" class="btn btn-primary shop-button">Add to
                                Cart</button> <button type="button" class="btn btn-success shop-button"
                                onclick="displayForm()">Buy
                                Now</button>
                        </div>
                    </div>
                </div>
                <div class="contact_section layout_padding" style="margin-left: 40%;display: none" id="buyForm">
                    <div class="container">
                        <h1 class="contact_taital" style="margin-left: 24%">Fill Order Detail</h1>
                        <div class="contact_section_2">
                            <form action="{{ route('frontend.order.product') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <input type="hidden" class="form-control" id="txtProductId" name="txtProductId"
                                        value="{{ $product->id }}">
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control" id="txtprice" name="txtprice"
                                            value="{{ $product->product_price }}" readonly>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control" id="txtquantity" name="txtquantity"
                                            placeholder="quantity">
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <textarea type="text" class="form-control" id="txtAddress" name="txtAddress" placeholder="quantity">
                                        </textarea>
                                    </div>
                                </div><br>
                                <div class="row" style="display: none" id="totalprice">
                                    <div class="col-xs-6"
                                        style="text-transform: uppercase;font-size: 30px;float: right;margin-right: 34%">
                                        <div id="total_price">
                                        </div>
                                    </div>
                                </div><br><br><br>
                                <div class="row" style="float: right;margin-right: 34%">
                                    <div class="col-xs-6" style="float: right;margin-right: 34%">
                                        <button type="submit" class="btn btn-success shop-button">Order</button>
                                    </div>
                                </div><br><br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function displayForm() {
                var buyForm = document.getElementById("buyForm");
                buyForm.style.display = "block";
            }
            const inputQuantity = document.getElementById("txtquantity");
            const price = document.getElementById("txtprice").value;
            inputQuantity.oninput = function() {
                var totalpricediv = document.getElementById("totalprice");
                totalpricediv.style.display = "block";
                var totalprice = document.getElementById("total_price");
                totalprice.innerHTML = "Total Price : " + inputQuantity.value * price + " Rs.";
            };
        </script>
    @endforeach
@endsection
