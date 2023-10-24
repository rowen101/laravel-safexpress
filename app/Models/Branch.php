<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = "branches";

    protected $fillable = [
        'id',
        'region',
        'site',
        'sitehead',
        'location',
        'email',
        'phone',
        'geomap',
        'image',
        'is_active',
        'created_by',
        'updated_by'

    ];
}

