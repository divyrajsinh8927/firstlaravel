<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationSendController;
use App\Models\User;
use App\Models\cart;
use App\Models\orders;
use App\Models\product;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendPushNotification;

class AddToCartController extends Controller
{
    public function proDetailToCart($id)
    {
        $cartProducts = $_SESSION['cart'];

        $products = product::select('products.id', 'products.product_name', 'products.product_image', 'products.product_price', 'sub_categories.category_name as category_name')->join('sub_categories', 'sub_categories.id', '=', 'products.category_id')->where('products.id', $id)->get();
        //echo $product_id;
        foreach ($products as $product) {
            $cartProducts['product'][$product->id]['product_name'] = $product->product_name;
            $cartProducts['product'][$product->id]['category_name'] = $product->category_name;
            $cartProducts['product'][$product->id]['product_image'] = $product->product_image;
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
        /* unset($_SESSION['cart']);
        exit(); */
        $cart = ['product_id' => $product_id, 'product_price' => $price, 'product_quantity' => $quantity];

        if (isset($_SESSION['cart'])) {

            $sessionCarts = $_SESSION['cart'];
            if (isset($sessionCarts['product'][$product_id])) {

                if ($quantity == 0) {
                    unset($_SESSION['cart']['product'][$product_id]);
                } else {
                    $sessionCarts['product'][$product_id]['product_quantity'] = $quantity;
                }
            } else {

                $sessionCarts['product'][$product_id] = $cart;
                $_SESSION['cart'] = $sessionCarts;
                $this->proDetailToCart($product_id);
            }
        } else {

            $_SESSION['cart']['product'] = [$product_id => $cart];
            $this->proDetailToCart($product_id);
        }

        if (!isset($_SESSION['cart'])) {
            return redirect()->intended(RouteServiceProvider::USER_HOME);
        }
        $QuantityArray = array_column($_SESSION['cart']['product'], 'product_quantity');
        $priceArray = array_column($_SESSION['cart']['product'], 'product_price');
        $totalQuantity = array_sum($QuantityArray);
        $totalPrice = array_sum($priceArray);
        $_SESSION['cart']['product_total']['total_quantity'] = $totalQuantity;
        $_SESSION['cart']['product_total']['sub_total_price'] = $totalPrice;

        $cartProducts['cart'] = $_SESSION['cart'];

        $homeControllerobj = new HomeController();
        $cat_data = $homeControllerobj->getAllTypeCategory();
        return view('frontend.cart_products')->with(compact('cat_data', 'cartProducts'));
    }

    public function viewCart()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION['cart'])) {
            $homeControllerobj = new HomeController();
            $cartProducts['cart']['product'] = [];
            $cat_data = $homeControllerobj->getAllTypeCategory();
            return view('frontend.cart_products')->with(compact('cat_data', 'cartProducts'));
        }
        $cartProducts['cart'] = $_SESSION['cart'];

        $homeControllerobj = new HomeController();
        $cat_data = $homeControllerobj->getAllTypeCategory();
        return view('frontend.cart_products')->with(compact('cat_data', 'cartProducts'));
    }

    public function placeCartOrder(Request $request)
    {

        session_start();
        if ($request->all == "true") {
            $cartProducts['cart'] = $_SESSION['cart'];
            foreach ($cartProducts['cart']['product'] as $cartProduct_key => $cartProduct_value) {
                orders::insert([
                    'user_id' => $_SESSION['user'],
                    'product_id' => $cartProduct_value['product_id'],
                    'address' => $request->txtAddress,
                    'quantity' => $cartProduct_value['product_quantity'],
                    'price' => $cartProduct_value['product_price'],
                    'created_at' => Carbon::now()
                ]);
            }
            $user = User::select('fcm_tokens')->where('id', $_SESSION['user'])->first();
            $message = "Your Order of " . $cartProduct_value['product_quantity'] . "Is Placed";
            $NotificationSendController = new NotificationSendController();
            $NotificationSendController->sendNotification("Order Placed",$message);
            unset($_SESSION['cart']);
            return redirect()->intended(RouteServiceProvider::USER_HOME);
        } else {
            $cartProducts['cart'] = $_SESSION['cart'];
            orders::insert([
                'user_id' => $_SESSION['user'],
                'product_id' => $request->product_id,
                'address' => $request->txtAddress,
                'quantity' => $request->txtquantity,
                'price' => $request->txtprice,
                'created_at' => Carbon::now()
            ]);
            $message = "Your Order of " . $request->txtquantity . $cartProducts['cart']['product'][$request->product_id]['product_name'] . "Is Placed";
            $NotificationSendController = new NotificationSendController();
            $NotificationSendController->sendNotification("Order Placed",$message);
            unset($_SESSION['cart']['product'][$request->product_id]);
            return redirect()->route('frontend.cart.product');
        }
    }
}
