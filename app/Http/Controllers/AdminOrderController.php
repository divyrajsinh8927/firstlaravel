<?php

namespace App\Http\Controllers;

use App\Models\orders;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        return view('admin.orderManagement');
    }

    public function getAllOrders(Request $request)
    {
        $length = $request->length;
        $start = $_POST['start'];
        global $search;
        $search = $request->search['value'];
        $draw = $request->draw;
        $order = $request->order[0]['dir'];

        $orderColumn = $request->order[0]['column'];
        if ($orderColumn == 0)
            $orderColumnName = "id";
        // elseif ($orderColumn == 1)
        //     $orderColumnName = "product_name";

        $totalOrders = orders::get()->count();
        $orders = Orders::select('orders.id', 'orders.address', 'orders.quantity', 'orders.price', 'orders.status', 'orders.created_at', 'products.product_name as product_name', 'users.name as user_name')->join('users', 'users.id', '=', 'orders.user_id')->join('products', 'products.id', '=', 'orders.product_id')->where(function ($query) {
            global $search;
            $query->where('orders.id', 'LIKE', '%' . $search . '%');
        })->skip($start)->take($length)
            ->orderBy($orderColumnName, $order)->get();
        $displayedOrders = $orders->count();
        $filterdCategories = orders::where(function ($query) {
            global $search;
            $query->where('id', 'LIKE', '%' . $search . '%');
            // ->orWhere('category_name', 'LIKE', '%' . $search . '%');
        })->orderBy($orderColumnName, $order)->get()->count();
        $responce = array(
            "totalOrders" => $totalOrders,
            "displayedProduct" => $displayedOrders,
            "recordsFiltered" => $filterdCategories,
            "draw" => intval($draw),
            "data" => $orders,
        );
        return response()->json($responce);
    }

    public function confirmOrder(Request $request)
    {
        try {
            $notifictionControllerobj = new NotificationSendController();
            $data = $notifictionControllerobj->sendSMS();
            if ($data = "sent") {
                $confirmOrder = orders::findOrFail($request->id)->update([
                    'status' => 1,
                    'updated_at' => Carbon::now(),
                ]);
                $order_data = [
                    'order_id' => $request->id,
                    'status' => 1,
                    'updated_at' => Carbon::now(),
                ];
                saveLogs('success', "Order Confirmed", $order_data);
                return response()->json(['success' => 'Order Confirm successfully.']);
            }
        } catch (Exception $e) {
            saveLogs('denger', "Order Not Confirm", $e);
        }
    }

    public function rejectOrder(Request $request)
    {
        try {
            $updateCategory = orders::findOrFail($request->id)->update([
                'status' => 0,
                'updated_at' => Carbon::now(),
            ]);
            $order_data = [
                'order_id' => $request->id,
                'status' => 0,
                'updated_at' => Carbon::now(),
            ];
            saveLogs('success', "Order Confirmed", $order_data);
        } catch (Exception $e) {
            saveLogs('denger', "Order Not Reject", $e);
        }
        return response()->json(['success' => 'Order Rejected successfully.']);
    }
}
