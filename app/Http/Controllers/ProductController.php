<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public $search = "";
    public function getProducts()
    {
        return view('admin.products');
    }

    public function addproduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'productImage' => 'required',
            'txtProductName' => 'required',
            'category' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }

        if ($request->file('productImage')) {
            $image = $request->file('productImage');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move(base_path('\public\media'), $name_gen);
            $save_url = 'media/' . $name_gen;
        }
        product::insert([
            'product_name' => $request->txtProductName,
            'product_image' => $save_url,
            'category_id' => $request->category,
            'created_at' => Carbon::now()
        ]);

        return response()->json(['success' => 'Product Added successfully.']);
    }

    public function editProduct(Request $request)
    {
        $editProduct = product::findOrFail($request->id);
        return response()->json($editProduct);
    }

    public function updateProduct(Request $request)
    {
        $updatevalidator = Validator::make($request->all(), [
            'txtUpdateProductName' => 'required',
            'updateCategory' => 'required',
        ]);

        if ($updatevalidator->fails()) {
            return response()->json([
                'error' => $updatevalidator->errors()->all()
            ]);
        }

        $editProduct = product::findOrFail($request->updateid);
        if ($request->file('updateProductImage')) {
            $image = $request->file('updateProductImage');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move(base_path('\public\media'), $name_gen);
            $save_url = 'media/' . $name_gen;
        }


        $save_url = $editProduct->product_image;
        product::findOrFail($request->updateid)->update([
            'product_name' => $request->txtUpdateProductName,
            'product_image' => $save_url,
            'category_id' => $request->updateCategory,
            'updated_at' => Carbon::now()
        ]);

        return response()->json(['success' => 'Product Updated successfully.']);
    }

    public function deleteProduct(Request $request)
    {
        product::findOrFail($request->id)->update([
            'isDelete' => 1,
            'updated_at' => Carbon::now(),
        ]);

        return response()->json(['success' => 'Product Deleted successfully.']);
    }

    public function getProductsByCategory(Request $request)
    {
        $category_id = $request->category_id;
        $length = $request->length;
        $start = $_POST['start'];
        global $search;
        $search = $request->search['value'];
        $draw = $request->draw;
        
        $orderColumn = $request->order[0]['column'];
        if ($orderColumn == 0)
            $orderColumnName = "id";
        elseif ($orderColumn == 2)
            $orderColumnName = "products.product_name";
        else
            $orderColumnName = "Categories.category_name";
        $order = $request->order[0]['dir'];
        $totalProduct = product::where('isDelete', 0)->get()->count();
        if ($category_id == 0) {
            $products = product::select('products.id', 'products.product_name', 'products.product_image', 'products.isDelete', 'Categories.category_name as category_name')
                ->join('categories', 'categories.id', '=', 'products.category_id')->where('products.isDelete', '=', 0)->where(function ($query) {
                    global $search;
                    $query->where('products.product_name', 'LIKE', '%' . $search . '%')
                        ->orWhere('products.id', 'LIKE', '%' . $search . '%')
                        ->orWhere('Categories.category_name', 'LIKE', '%' . $search . '%');
                })->skip($start)->take($length)
                ->orderBy($orderColumnName, $order)->get();
            $filterdproducts = product::select('products.id', 'products.product_name', 'products.product_image', 'products.isDelete', 'Categories.category_name as category_name')
                ->join('categories', 'categories.id', '=', 'products.category_id')->where('products.isDelete', '=', 0)->where(function ($query) {
                    global $search;
                    $query->where('products.product_name', 'LIKE', '%' . $search . '%')
                        ->orWhere('products.id', 'LIKE', '%' . $search . '%')
                        ->orWhere('Categories.category_name', 'LIKE', '%' . $search . '%');
                })->get()->count();
            $displayedProduct = $products->count();
            $res = array(
                "totalProduct" => $totalProduct,
                "displayedProduct" => $displayedProduct,
                "recordsFiltered" => $filterdproducts,
                "draw" => intval($draw),
                "data" => $products
            );
            return response()->json($res);
        }
        $products = product::select('products.id', 'products.product_name', 'products.product_image', 'products.isDelete', 'Categories.category_name as category_name')
            ->join('categories', 'categories.id', '=', 'products.category_id')->where('products.isDelete', '=', 0)->where('products.category_id', '=', $category_id)->where(function ($query) {
                global $search;
                $query->where('products.product_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('products.id', 'LIKE', '%' . $search . '%')
                    ->orWhere('Categories.category_name', 'LIKE', '%' . $search . '%');
            })->skip($start)->take($length)->get();
        $filterdproducts = product::select('products.id', 'products.product_name', 'products.product_image', 'products.isDelete', 'Categories.category_name as category_name')
            ->join('categories', 'categories.id', '=', 'products.category_id')->where('products.isDelete', '=', 0)->where('products.category_id', '=', $category_id)->where(function ($query) {
                global $search;
                $query->where('products.product_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('products.id', 'LIKE', '%' . $search . '%')
                    ->orWhere('Categories.category_name', 'LIKE', '%' . $search . '%');
            })->take($start,$length)->orderBy($orderColumnName, $order)->get()->count();
        $displayedProduct = $products->count();
        $res = array(
            "totalProduct" => $totalProduct,
            "displayedProduct" => $displayedProduct,
            "recordsFiltered" => $filterdproducts,
            "draw" => intval($draw),
            "data" => $products
        );
        return response()->json($res);
    }
}
