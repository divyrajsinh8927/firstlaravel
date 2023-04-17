<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'mobile_number',
        'user_type_id',
        'password',
        'created_at',
        'status',
        'is_delete',
        'updated_at',
        'device_token'
    ];
}
