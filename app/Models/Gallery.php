<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'galleries';

    protected $fillable = [
        'id',
        'gurec',
        'foldername',
        'is_active',
        'filename',
        'parent_id',
        'caption',
        'image'

    ];

}
