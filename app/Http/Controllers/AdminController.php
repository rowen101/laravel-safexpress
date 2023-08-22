<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
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
        return view('admin.activity')->with('title',$title);
    }

    public function dashboard()
    {
        $title ="Dasboard";
        $user = User::count();
        $post = Posts::count();
        return view('admin.dashboard', compact(['title','user','post']));
    }







}
