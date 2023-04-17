<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub_categories extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name',
        'isDelete',
        'category_id',
        'created_at',
        'updated_at',
    ];
}
