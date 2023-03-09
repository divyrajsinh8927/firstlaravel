<?php

namespace App\Exports;

use App\Models\product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection,WithHeadings 
{
    public function headings(): array {
        return [
           "id","product_name","category_name"
        ];
      }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    { 
        return  product::select('products.id', 'products.product_name', 'Categories.category_name as category_name')
        ->join('categories', 'categories.id', '=', 'products.category_id')->where('products.isDelete', '=', 0)
        ->get();;
    }

   
}
