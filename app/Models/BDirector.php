<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BDirector extends Model
{
    protected $table = "b_directors";
    protected $fillable = [
        'id',
        'name',
        'position',
        'image',
        'about',
        'org_type',
        'is_social',
        'fb',
        'tw',
        'linkin',
        'instagram',
        'fb_url',
        'tw_url',
        'linkin_url',
        'instagram_url',
        'is_active',
        'created_by',
        'updated_by',
    ];
}
