<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\cart;
use App\Models\product;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AddToCartController extends Controller
{
    public function proDetailToCart($id)
    {
        $cartProducts = $_SESSION['cart'];

        $products = product::select('products.id', 'products.product_name', 'products.product_image', 'products.product_price', 'sub_categories.category_name as category_name')->join('sub_categories', 'sub_categories.id', '=', 'products.category_id')->where('products.id', $id)->get();
        //echo $product_id;
        foreach ($products as $product) {
            $cartProducts[$product->id]['product_name'] = $product->product_name;
            $cartProducts[$product->id]['category_name'] = $product->category_name;
            $cartProducts[$product->id]['product_image'] = $product->product_image;
        }
        $_SESSION['cart'] = $cartProducts;
    }
    public function addToCart(Request $request)
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            return redirect()->intended(RouteServiceProvider::LOGIN);
        }
        $user_id = $_SESSION['user'];
        $product_id = $request->product_id;
        $price = $request->product_price;
        $quantity = $request->txtquantity;
        //  unset($_SESSION['cart']);
        // exit();
        $cart = ['product_id' => $product_id, 'product_price' => $price, 'product_quantity' => $quantity];

        if (isset($_SESSION['cart'])) {

            $sessionCarts = $_SESSION['cart'];
            if (isset($sessionCarts[$product_id])) {

                if ($quantity == 0) {
                    unset($_SESSION['cart'][$product_id]);
                } else {
                    $sessionCarts[$product_id]['product_quantity'] = $quantity;
                }
            } else {

                $sessionCarts[$product_id] = $cart;
                $_SESSION['cart'] = $sessionCarts;
                $this->proDetailToCart($product_id);
            }

        } else {

            $_SESSION['cart'] = [$product_id => $cart];
            $this->proDetailToCart($product_id);
        }

        $cartProducts = $_SESSION['cart'];
        if(empty($cartProducts))
        {
            return redirect()->intended(RouteServiceProvider::USER_HOME);
        }

        $homeControllerobj = new HomeController();
        $cat_data = $homeControllerobj->getAllTypeCategory();
        return view('frontend.cart_products')->with(compact('cat_data', 'cartProducts'));
    }

    public function viewCart()
    {
        session_start();
        if(!isset($_SESSION['cart']))
        {
            return view('frontend.cart_products');
        }
        $cartProducts = $_SESSION['cart'];

        $homeControllerobj = new HomeController();
        $cat_data = $homeControllerobj->getAllTypeCategory();
        return view('frontend.cart_products')->with(compact('cat_data', 'cartProducts'));
    }
}
