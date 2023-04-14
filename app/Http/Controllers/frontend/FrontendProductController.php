<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;

class FrontendProductController extends Controller
{

    public function index(Request $request)
    {
        $products = product::select('products.id', 'products.product_name', 'products.product_description', 'products.product_image', 'products.product_price', 'products.isDelete', 'sub_categories.category_name as category_name')->join('sub_categories', 'sub_categories.id', '=', 'products.category_id')->where('products.isDelete', '=', 0)->where('products.id', $request->id)->get();
        $homeControllerobj = new HomeController();
        $cat_data = $homeControllerobj->getAllTypeCategory();
        return view('frontend.single_product')->with(compact('cat_data', 'products'));
    }
}
