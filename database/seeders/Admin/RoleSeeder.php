<?php

namespace Database\Seeders\Admin;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = database_path(). '/seeders/Admin/Role.json';
        $str = file_get_contents($filePath);
        $json = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $str), true );
        foreach ($json as $value) {
            $rowdata = new Role();
            $rowdata->id = $value["id"];
            $rowdata->role_code = $value["roleCode"];
            $rowdata->description = $value["description"];
            $rowdata->is_active = $value["isActive"];
            $rowdata->created_by = 0;
            $rowdata->save();
        }
    }
}
