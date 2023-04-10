<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\categories;
use App\Models\product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = product::select('products.id', 'products.product_name', 'products.product_image', 'products.isDelete', 'Categories.category_name as category_name')->join('categories', 'categories.id', '=', 'products.category_id')->where('products.isDelete', '=', 0)->get();
        return view('frontend.home')->with(compact('products'));
    }
}
