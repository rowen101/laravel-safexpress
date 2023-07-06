<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\Admin\AppSeeder;
use Database\Seeders\Admin\MenuSeeder;
use Database\Seeders\Admin\RoleSeeder;
use Database\Seeders\Admin\UserSeeder;
use Database\Seeders\Admin\GallerySeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([

            AppSeeder::class,
            MenuSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            GallerySeeder::class

        ]);
    }
}
