<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usermenu extends Model
{
    use HasFactory;

    protected $table = 'app_users_menus';
    protected $fillable = [
        'user_id',
        'menu_id',
        'flag',
        'caninsert',
        'candelete',
        'canedit',
        'canview',
        'favorites',
    ];



}
