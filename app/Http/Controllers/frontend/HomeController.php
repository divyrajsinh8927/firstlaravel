<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\categories;
use App\Models\sub_categories;
use App\Models\product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getAllTypeCategory()
    {
        $perentCategories = categories::all()->where('isDelete', 0);

        $perentCategoriesArray = [];

        foreach ($perentCategories as $perentCategory) {

            $perentCategoryId = $perentCategory->id;
            $perentCategoryName = $perentCategory->name;

            $perentCategoriesArray[$perentCategoryId] = ['cat_id' => $perentCategoryId, 'cat_name' => $perentCategoryName, 'sub_cat' => []];


            $subCategories = sub_categories::all()->where('isDelete', 0)->where('category_id', $perentCategoryId);


            $subCategoriesArray = [];
            foreach ($subCategories as $subCategory) {

                $subCategoryId = $subCategory->id;
                $subCategoryName = $subCategory->category_name;
                $subCategoriesArray[$subCategoryId] = ['sub_cate_id' => $subCategoryId, 'sub_cat_name' => $subCategoryName];
            }

            $perentCategoriesArray[$perentCategoryId]['sub_cat'] = $subCategoriesArray;
        }
        return $perentCategoriesArray;
    }
    public function index()
    {
        $products = product::select('products.id', 'products.product_name', 'products.product_image', 'products.product_price', 'products.isDelete', 'sub_categories.category_name as category_name')->join('sub_categories', 'sub_categories.id', '=', 'products.category_id')->where('products.isDelete', '=', 0)->get();
        $cat_data = $this->getAllTypeCategory();
        return view('frontend.home')->with(compact('cat_data', 'products'));
    }

    public function getProductBySubCategory(Request $req)
    {
        $products = product::select('products.id', 'products.product_name', 'products.product_image', 'products.product_price', 'products.isDelete', 'sub_categories.category_name as category_name')->join('sub_categories', 'sub_categories.id', '=', 'products.category_id')->where('products.isDelete', '=', 0)->where('products.category_id',$req->id)->get();
        $cat_data = $this->getAllTypeCategory();
        return view('frontend.home')->with(compact('cat_data', 'products'));
    }
}
