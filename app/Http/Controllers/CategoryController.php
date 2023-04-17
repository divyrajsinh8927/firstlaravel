<?php

namespace App\Http\Controllers;

use App\Imports\categoriesImport;
use App\Models\categories;
use Illuminate\Support\Facades\Validator;
use App\Models\sub_categories;
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

        $totalCategory = sub_categories::where('isDelete', 0)->get()->count();
        $categories = sub_categories::where('isDelete', 0)->where(function ($query) {
            global $search;
            $query->where('id', 'LIKE', '%' . $search . '%')
                ->orWhere('category_name', 'LIKE', '%' . $search . '%');
        })->skip($start)->take($length)
            ->orderBy($orderColumnName, $order)->get();
        $displayedCategories = $categories->count();
        $filterdCategories = sub_categories::where('isDelete', 0)->where(function ($query) {
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
        try {
            $validator = Validator::make($request->all(), [
                'categoryName' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors()->all()
                ]);
            }

            $sub_category_id = sub_categories::insertGetId([
                'category_name' => $request->categoryName,
                'category_id' => $request->main_category_id,
                'created_at' => Carbon::now()
            ]);
            $sub_category_data = [
                'sub_category_id' => $sub_category_id,
                'category_name' => $request->categoryName,
                'category_id' => $request->main_category_id,
                'created_at' => Carbon::now()
            ];
            saveLogs('success', "Category Inserted", $sub_category_data);
            return response()->json(['success' => 'Category Added successfully.']);
        } catch (Exception $e) {
            saveLogs('denger', "Category Not Inserted", $e);
        }
    }

    public function editCategory(Request $request)
    {
        $editCategory = sub_categories::findOrFail($request->id);
        return response()->json($editCategory);
    }

    public function updateCategory(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'updateCategory' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors()->all()
                ]);
            }

            sub_categories::findOrFail($request->id)->update([
                'category_name' => $request->updateCategory,
                'category_id' => $request->update_main_category_id,
                'updated_at' => Carbon::now()
            ]);
            $sub_category_data = [
                'sub_category_id' => $request->id,
                'category_name' => $request->updateCategory,
                'category_id' => $request->update_main_category_id,
                'updated_at' => Carbon::now()
            ];
            saveLogs('success', "Category Updated", $sub_category_data);
            return response()->json(['success' => 'Category Updated successfully.']);
        } catch (Exception $e) {
            saveLogs('denger', "Category Not Updated", $e);
            return response()->json(['error' => $e]);
        }
    }

    public function deleteCategory(Request $request)
    {
        try {
            $updateCategory = sub_categories::findOrFail($request->id)->update([
                'isDelete' => 1,
                'updated_at' => Carbon::now(),
            ]);
            $sub_category_data = [
                'sub_category_id' => $request->id,
                'isDelete' => 1,
                'updated_at' => Carbon::now(),
            ];
            saveLogs('success', "Category Deleted", $sub_category_data);
            return response()->json(['success' => 'Category Deleted successfully.']);
        } catch (Exception $e) {
            saveLogs('denger', "Category Not Deleted", $e);
        }
    }

    public function getCategoriesForOption()
    {
        $categories = sub_categories::where('isDelete', 0)->get();
        return response()->json($categories);
    }

    public function getMainCategoriesForOption()
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
            array_push($notFound, $printMessage);
        }

        if (!empty($notFound)) {
            return $notFound;
        }
        // return "<tr><td><span style='color: red;'> category_name Column Required </span><td><tr>";
        //This array holds the final response.
        $categories  = [];
        foreach ($rows as $row) {
            $arr_data = array_filter($row);
            if (!empty($arr_data)) {
                if (sub_categories::where('category_name', $row)->exists()) {
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


        sub_categories::insert($categories);
        $totalrecord = count($rows);
        $insertrow = ["<tr><td><span style='color: green;'>Insert  $InsertedRows Rows From  $totalrecord Rows </span></td></tr>", "<tr><td><span style='color: green;'>Skip " . $totalrecord - $InsertedRows . " Rows From $totalrecord Rows</span></td></tr>"];
        $allErrors = array_merge($skipedRowsNumber, $duplicateEntry);
        $lastAllData = array_merge($allErrors, $insertrow);
        return $lastAllData;
    }
}
