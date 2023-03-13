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
use PhpParser\Node\Expr\AssignOp\Concat;

use function PHPUnit\Framework\returnSelf;

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
        elseif ($orderColumn == 1)
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
        $skipedRowsNumber = [];
        $duplicateEntry = [];
        $InsertedRows = 0;
        $FoundColumn = [];
        $FoundColumnNumber = 0;

        $rows   = array_map('str_getcsv', file($request->categoryfile));
        // print_r($rows);
        //Get the first row that is the HEADER row.
        $header_row = array_shift($rows);
        $notFound = [];
        if (count($header_row) > 1) {
            return  "<tr><td><span style='color: red;'>Unnassecry Coulumns Found only take category_name and Remove other Columns</span><td><tr>";
        }
        if (!in_array("category_name", $header_row)) {
            $printMessage = "<tr><td><span style='color: red;'>Category_name Column Not Found</span><td><tr>";
            array_push($notFound,$printMessage);
        }

        if(!empty($notFound))
        {
            return $notFound;
        }
        // return "<tr><td><span style='color: red;'> category_name Column Required </span><td><tr>";
        //This array holds the final response.
        $categories  = [];
        foreach ($rows as $row) {
            $arr_data = array_filter($row);
            if (!empty($arr_data)) {
                if (categories::where('category_name', $row)->exists()) {
                    $duplicateLine = "<tr><td><span style='color: red;'>Duplicate Data Found At Row " . 1 . "</span><td><tr>";
                    array_push($duplicateEntry, $duplicateLine);
                } else {
                    $categories[] = array_combine($header_row, $row);
                    $InsertedRows = $InsertedRows + 1;
                }
            } else {
                $blankline = "<tr><td><span style='color: red;'>Blank Data Found in line Row " .  1 . "</span><td><tr>";
                array_push($skipedRowsNumber, $blankline);
            }
        }


        categories::insert($categories);
        $totalrecord = count($rows);
        $insertrow = ["<tr><td><span style='color: green;'>Insert  $InsertedRows Rows From  $totalrecord Rows </span></td></tr>", "<tr><td><span style='color: green;'>Skip " . $totalrecord - $InsertedRows . " Rows From $totalrecord Rows</span></td></tr>"];
        $allErrors = array_merge($skipedRowsNumber, $duplicateEntry);
        $lastAllData = array_merge($allErrors, $insertrow);
        return $lastAllData;

    }
}
