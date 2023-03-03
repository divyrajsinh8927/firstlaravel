<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function getProducts()
    {

        $products = product::select('products.id', 'products.product_name', 'products.product_image', 'Categories.category_name as category_name')
        	->join('categories', 'categories.id', '=', 'products.category_id')
        	->get();
        // $products = product::latest()->get();
        $categories = categories::latest()->get();
        return view('admin.products', compact('products','categories'));
    }

    public function addproduct(Request $request)
    {

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
        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function editProduct($id)
    {
        $editProduct = product::findOrFail($id);
        $categories = categories::get();
        return view('admin.productEdit', compact('editProduct', 'categories'));
    }

    public function updateProduct(Request $request)
    {
        $editProduct = product::findOrFail($request->id);
        if ($request->file('productImage')) {
            $image = $request->file('productImage');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move(base_path('\public\media'), $name_gen);
            $save_url = 'media/' . $name_gen;
        }


        $save_url = $editProduct->product_image;
        $updateProduct = product::findOrFail($request->id)->update([
            'product_name' => $request->txtProductName,
            'product_image' => $save_url,
            'category_id' => $request->category,
            'updated_at' => Carbon::now()
        ]);
        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect('/get/products')->with($notification);
    }

    public function deleteProduct($id)
    {
        $updateCategory = product::findOrFail($id)->update([
            'isDelete' => 1,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect('/get/products')->with($notification);
    }
}
