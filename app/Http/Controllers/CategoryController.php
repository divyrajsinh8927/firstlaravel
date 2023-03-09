<?php

namespace App\Http\Controllers;

use App\Imports\categoriesImport;
use Illuminate\Support\Facades\Validator;
use App\Models\categories;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\LazyCollection;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class CategoryController extends Controller
{
    public function getCategories()
    {
        return view('admin.categories');
    }

    public function getAllCategories(Request $request)
    {
        $category_id = $request->category_id;
        $length = $request->length;
        $start = $_POST['start'];
        global $search;
        $search = $request->search['value'];
        $draw = $request->draw;
        $order = $request->order[0]['dir'];

        $orderColumn = $request->order[0]['column'];
        if ($orderColumn == 0)
            $orderColumnName = "id";
        elseif ($orderColumn == 2)
            $orderColumnName = "category_name";

        $totalCategory = categories::where('isDelete', 0)->get()->count();
        $categories = categories::where('isDelete', 0)->where(function ($query) {
            global $search;
            $query->where('id', 'LIKE', '%' . $search . '%')
                ->orWhere('category_name', 'LIKE', '%' . $search . '%');
        })->skip($start)->take($length)
            ->orderBy($orderColumnName, $order)->get();
        $displayedCategories = $categories->count();
        $filterdCategories = categories::where('isDelete', 0)->where(function ($query) {
            global $search;
            $query->where('id', 'LIKE', '%' . $search . '%')
                ->orWhere('category_name', 'LIKE', '%' . $search . '%');
        })->orderBy($orderColumnName, $order)->get()->count();
        $responce = array(
            "totalProduct" => $totalCategory,
            "displayedProduct" => $displayedCategories,
            "recordsFiltered" => $filterdCategories,
            "draw" => intval($draw),
            "data" => $categories,
        );
        return response()->json($responce);
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
        $validator = Validator::make($request->all(), [
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
        $categories = categories::where('isDelete', 0)->get();
        return response()->json($categories);
    }



    public function importCsv(Request $request)
    {
        $reader = fopen($request->categoryfile, "r");
        // $error = Excel::import(new categoriesImport, $request->categoryfile);
       
    }
}
