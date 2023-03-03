<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\categories;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories()
    {
        $categories = categories::get();
        return view('admin.categories', compact('categories'));
    }

    public function addCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'categoryName' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }

        categories::insert([
            'category_name' => $request->categoryName,
            'created_at' => Carbon::now()
        ]);

        return response()->json(['success' => 'Category Added successfully.']);
    }

    public function editCategory(Request $request)
    {
        $editCategory = categories::findOrFail($request->id);
        return response()->json($editCategory);
    }

    public function updateCategory(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'updateCategory' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }
        
        categories::findOrFail($request->id)->update([
            'category_name' => $request->updateCategory,
            'updated_at' => Carbon::now(),
        ]);
        return response()->json(['success' => 'Category Updated successfully.']);
    }

    public function deleteCategory(Request $request)
    {
        $updateCategory = categories::findOrFail($request->id)->update([
            'isDelete' => 1,
            'updated_at' => Carbon::now(),
        ]);
        return response()->json(['success' => 'Category Deleted successfully.']);
    }

    public function getCategoriesForOption()
    {
        $categories = categories::where('isDelete',0)->get();
        return response()->json($categories);
    }
}
