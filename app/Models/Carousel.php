<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    protected $table = "carousels";

    protected $fillable = [
        'id',
        'image',
        'caption',
        'detail',
        'is_active',
        'created_by',
        'updated_by'
    ];
}
