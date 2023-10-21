<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usermenu extends Model
{
    use HasFactory;
    protected $table = "usermenus";

    protected $fillable = [
        'user_id',
        'menu_id',
        'flag',
        'caninsert',
        'candelete',
        'canedit',
        'canview',
        'favorite',
        'is_active',
        'created_by',
        'updated_by',
    ];
}
