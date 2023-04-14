<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Bookoing;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider as Serviceprovider;

class OrderProductController extends Controller
{
    public function placeOrder(Request $request)
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            return redirect()->intended(Serviceprovider::LOGIN);
        }

        $price = $request->txtprice;
        $quantity = $request->txtquantity;
        $adderess = $request->txtAddress;

        Bookoing::insert([
            'user_id' => $_SESSION['user'],
            'product_id' => $request->txtProductId,
            'address' => $request->txtAddress,
            'quantity' => $request->txtquantity,
            'price' => $request->txtprice,
            'created_at' => Carbon::now()
        ]);

        return redirect()->intended(Serviceprovider::USER_HOME);

    }
}
