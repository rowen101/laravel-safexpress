<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\Facades\DB;
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

       //Schema::defaultStringLength(191);

    //    if (auth()->check()) {
        // $userId = auth()->user()->id;
        // $adminmenu = DB::table('usermenus')
        // ->join("menu", "menu.id", "=", "usermenus.menu_id")
        // ->select("menus.*", "app.app_name")
        // ->where('usermenus.user_id', '=', auth()->user()->$userId)
        // ->where('menu.is_active', 1)
        // ->orderBy('menus.sort_order', 'ASC')
        // ->get();

    //     view()->share('adminmenu', $adminmenu);
    // }else{
    //     $adminmenu = Menu::where('is_active', 1)
    //     ->where('app_id', 1)
    //     ->where('parent_id', 0)
    //     ->orderBy('sort_order', 'ASC')
    //     ->get();
    //    view()->share('adminmenu', $adminmenu);
    // }


    //     $adminmenu = Menu::where('is_active', 1)
    //     ->where('app_id', 1)
    //     ->where('parent_id', 0)
    //     ->orderBy('sort_order', 'ASC')
    //     ->get();
    //    view()->share('adminmenu', $adminmenu);

        //     $adminmenu = Menu::select('menus.*')
        //     ->join('usermenus', 'menus.id', '=', 'usermenus.menu_id')
        //     ->where('menus.is_active', 1)
        //     ->where('menus.app_id', 1)
        //     ->where('menus.parent_id', 0)
        //     ->where('usermenus.user_id', 2) // Replace $user_id with the actual user ID
        //     ->orderBy('menus.sort_order', 'ASC')
        //     ->get();

        // view()->share('adminmenu', $adminmenu);


        // $menuItem = Menu::where('is_active', 1)
        //  ->where('app_id', 2)
        //  ->where('parent_id', 0)
        //  ->orderBy('sort_order', 'ASC')
        //  ->get();
        // view()->share('menuItem', $menuItem);
    }
}
