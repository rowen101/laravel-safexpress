<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    protected $table = 'app';

    public function menus()
    {
        return $this->hasMany(Menu::class, 'app_id', 'id');
    }
    // public function help_sections()
    // {
    //     return $this->hasMany(HelpSection::class, 'systemID', 'id');
    // }
    protected $fillable = [
        'id',
        'app_code',
        'app_name',
        'description',
        'app_icon',
        'is_active',
        'status_message',
        'created_by',
        'updated_by'
    ];
}
