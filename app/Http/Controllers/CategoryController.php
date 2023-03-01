<?php

namespace App\Http\Controllers;
use App\Models\categories;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories()
    {
        $categories = categories::latest()->get();
        return view('admin.categories',compact('categories'));
    }

    public function addCategory(Request $request)
    {
        categories::insert([
            'category_name' => $request->txtcategoryName,
            'created_at' => Carbon::now()
        ]);
        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect('/dashboard')->with($notification);
    }

    public function editCategory($id)
    {
            $editCategory = categories::findOrFail($id);
            return view('admin.edit',compact('editCategory'));
    }

    public function updateCategory(Request $request)
    {
        $updateCategory = categories::findOrFail($request->id)->update([
            'category_name' => $request->txtUpdatecategoryName,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect('/dashboard')->with($notification);
    }
}
