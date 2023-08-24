<?php

namespace Database\Seeders\Admin;

use App\Models\App;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = database_path() . '/seeders/Admin/App.json';
        $str = file_get_contents($filePath);
        $json = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $str), true);
        foreach ($json as $value) {
            $rowdata = new App();
            $rowdata->id = $value["id"];
            $rowdata->app_code = $value["app_code"];
            $rowdata->app_name = $value["app_name"];
            $rowdata->description = $value["description"];
            $rowdata->app_icon = $value["app_icon"];
            $rowdata->is_active = $value["is_active"];
            $rowdata->status_message = $value["status_message"];
            $rowdata->created_by = 0;
            $rowdata->save();
        }
    }

}
