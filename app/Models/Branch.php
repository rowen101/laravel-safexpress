<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = "branches";

    protected $fillable = [
        'id',
        'site',
        'branch',
        'sitehead',
        'location',
        'email',
        'phone',
        'maps',
        'is_active',
        'created_by',
        'updated_by'

    ];
}

