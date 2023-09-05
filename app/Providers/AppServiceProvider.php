<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

       Schema::defaultStringLength(191);


        $adminmenu = Menu::where('is_active', 1)
        ->where('app_id', 1)
        ->where('parent_id', 0)
        ->orderBy('sort_order', 'ASC')
        ->get();
       view()->share('adminmenu', $adminmenu);

        // $menuItem = Menu::where('is_active', 1)
        //  ->where('app_id', 2)
        //  ->where('parent_id', 0)
        //  ->orderBy('sort_order', 'ASC')
        //  ->get();
        // view()->share('menuItem', $menuItem);
    }
}
