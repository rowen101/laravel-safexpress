<?php

namespace App\Http\Controllers;

use App\Models\BDirector;
use App\Models\Menu;
use App\Models\User;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


     private function getAdminMenu()
     {
         $userId = auth()->user()->id;

         $menu = Menu::select('menus.*')
             ->join('usermenus', 'menus.id', '=', 'usermenus.menu_id')
             ->where('menus.is_active', 1)
             ->where('menus.app_id', 1)
             ->where('menus.parent_id', 0)
             ->where('usermenus.user_id', $userId)
             ->orderBy('menus.sort_order', 'ASC')
             ->get();

         // For each top-level menu item, fetch and attach its submenus based on user access
         $menu->each(function ($menuItem) use ($userId) {
             $menuItem->submenus = Menu::select('menus.*')
                 ->join('usermenus', 'menus.id', '=', 'usermenus.menu_id')
                 ->where('menus.is_active', 1)
                 ->where('menus.parent_id', $menuItem->id)
                 ->where('usermenus.user_id', $userId)
                 ->orderBy('menus.sort_order', 'ASC')
                 ->get();
         });

         return $menu;
     }

    public function index()
    {
        // $title ="Dasboard";
        //  return view('admin.dashboard',[
        //     'title'=> $title
        //  ]);

         return Redirect::to('admin/dashboard');

    }

    public function activity()
    {
        $title ="Activity";
        $adminmenu = $this->getAdminMenu();
        return view('admin.activity')->with(['title'=>$title,'adminmenu'=>$adminmenu]);
    }

    public function dashboard()
    {

        $adminmenu = $this->getAdminMenu();
        //dd($adminmenu);
        $title ="Dasboard";
        $user = User::count();
        $mancom = BDirector::count();
        return view('admin.dashboard', compact(['title','user','mancom','adminmenu']));
    }

}
