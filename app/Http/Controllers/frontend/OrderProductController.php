<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\orders;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider as Serviceprovider;
use Exception;
use Illuminate\Validation\Rules\Exists;

class OrderProductController extends Controller
{
    public function placeOrder(Request $request)
    {
        try {
            session_start();
            if (!isset($_SESSION['user'])) {
                return redirect()->intended(Serviceprovider::LOGIN);
            }

            $order = orders::insertGetId([
                'user_id' => $_SESSION['user'],
                'product_id' => $request->txtProductId,
                'address' => $request->txtAddress,
                'quantity' => $request->txtquantity,
                'price' => $request->txtprice,
                'created_at' => Carbon::now()
            ]);
            $order_data = [
                'order_id' => $order,
                'user_id' => $_SESSION['user'],
                'product_id' => $request->txtProductId,
                'address' => $request->txtAddress,
                'quantity' => $request->txtquantity,
                'price' => $request->txtprice,
                'created_at' => Carbon::now()
            ];

            saveLogs('success', "Order Placed", $order_data);
        } catch (Exception $e) {
            saveLogs('danger', "Order Not Placed", $e);
        }

        return redirect()->intended(Serviceprovider::USER_HOME);
    }
}
