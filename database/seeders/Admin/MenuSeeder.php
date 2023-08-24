<?php

namespace Database\Seeders\Admin;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = database_path(). '/seeders/Admin/Menu.json';
        $str = file_get_contents($filePath);
        $json = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $str), true );
        foreach ($json as $value) {
            $rowdata = new Menu();
            $rowdata->id = $value["id"];
            $rowdata->app_id = $value["app_id"];
            $rowdata->menu_code = $value["menuCode"];
            $rowdata->menu_title = $value["menuTitle"];
            $rowdata->description = $value["description"];
            $rowdata->parent_id = $value["parent_id"];
            $rowdata->menu_icon = $value["menuIcon"];
            $rowdata->menu_route = $value["menuRoute"];
            $rowdata->sort_order = $value["sortOrder"];
            $rowdata->is_active = $value["isActive"];
            $rowdata->created_by = 0;
            $rowdata->save();
        }
    }
}
