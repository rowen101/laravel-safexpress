<?php

namespace Database\Seeders\Admin;


use App\Models\Gallery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = database_path() . '/seeders/Admin/Gallery.json';
        $str = file_get_contents($filePath);
        $json = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $str), true);
        foreach ($json as $value) {
            $rowdata = new Gallery();
            $rowdata->id = $value["id"];
            $rowdata->gurec = $value["gurec"];
            $rowdata->foldername = $value["foldername"];
            $rowdata->filename = $value["filename"];
            $rowdata->image = $value["image"];
            $rowdata->caption = $value["caption"];
            $rowdata->parent_id = $value["parent_id"];
            $rowdata->sort = $value["sort"];
            $rowdata->is_active = $value["is_active"];
            $rowdata->created_by = 0;
            $rowdata->save();
        }
    }

}
