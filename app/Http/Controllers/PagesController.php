<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Menu;
use App\Models\Posts;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{

    public function menu(){
        $menuItem = Menu::where('is_active', 1)
        ->where('app_id', 2)
        ->where('parent_id', 0)
        ->orderBy('sort_order', 'ASC')
        ->get();

        return $menuItem;
    }
    public function index()
    {

        $title = "Home";
        $menuItem = Menu::where('is_active', 1)
        ->where('app_id', 2)
        ->where('parent_id', 0)
        ->orderBy('sort_order', 'ASC')
        ->get();

        return view('pages.index',compact('menuItem'))->with(['title' => $title]);
    }

    public function about()
    {
        $title = "About";
        $menuItem = Menu::where('is_active', 1)
        ->where('app_id', 2)
        ->where('parent_id', 0)
        ->orderBy('sort_order', 'ASC')
        ->get();
        return view('pages.about',compact('menuItem'))->with(['title'=> $title]);
    }

    public function services()
    {
        $title = "Services";
        $menuItem = Menu::where('is_active', 1)
        ->where('app_id', 2)
        ->where('parent_id', 0)
        ->orderBy('sort_order', 'ASC')
        ->get();
        return view('pages.services', compact('menuItem'))->with('title', $title);
    }
    public function contact()
    {
        $title = "contact";
        $menuItem = Menu::where('is_active', 1)
        ->where('app_id', 2)
        ->where('parent_id', 0)
        ->orderBy('sort_order', 'ASC')
        ->get();
        return view('pages.contact',compact('menuItem'))->with('title', $title);
    }
    public function teams()
    {
        $menuItem = Menu::where('is_active', 1)
        ->where('app_id', 2)
        ->where('parent_id', 0)
        ->orderBy('sort_order', 'ASC')
        ->get();

        $gallery = DB::table('galleries')
            ->select( 'id','foldername')
            ->where('is_active', 1)
            ->get();


        $thumbnail = DB::table('galleries')
            ->select('id', 'gurec', 'foldername', 'is_active', 'parent_id', 'image', 'filename', 'caption')
            ->where('image', '<>', '')
            ->get();
        $title = "Teams";
        return view('pages.teams')->with(['title' => $title, 'gallery' => $gallery, 'thumbnail' => $thumbnail,'menuItem'=> $menuItem]);
    }

    public function branch()
    {
        $title = "Branch";
        $menuItem = Menu::where('is_active', 1)
        ->where('app_id', 2)
        ->where('parent_id', 0)
        ->orderBy('sort_order', 'ASC')
        ->get();
        return view('pages.branch')->with(['title'=> $title,'menuItem'=> $menuItem]);;
    }

    public function blog()
    {
        $title = "Blog";
        $menuItem = Menu::where('is_active', 1)
        ->where('app_id', 2)
        ->where('parent_id', 0)
        ->orderBy('sort_order', 'ASC')
        ->get();

        $postid = DB::table('posts')
        ->select('id')->get();
        //dd($postid);
       $posts = Posts::where('is_active',1)->where('is_publish',1)->get();
    //    $post = Posts::withCount('comments')->find();
    //     $commentCount = $post->comments_count;
        return view('pages.blog',compact('posts', 'title','menuItem'));


    }
    public function blogid(string $id)
    {

        $posts = Posts::find($id);
        if($posts && $posts->is_publish){
            $post = Posts::withCount('comments')->find($id);
            $commentCount = $post->comments_count;
            $menuItem = Menu::where('is_active', 1)
            ->where('app_id', 2)
            ->where('parent_id', 0)
            ->orderBy('sort_order', 'ASC')
            ->get();
            $user = Posts::with(['user'])->find($id);
            return view('pages.blog-details',compact('posts','menuItem','commentCount','user'));
        }else{
            return view('inactivate');
        }

    }

    public function warehouse()
    {
        $title = "Warehouse Management";
        $menuItem = Menu::where('is_active', 1)
        ->where('app_id', 2)
        ->where('parent_id', 0)
        ->orderBy('sort_order', 'ASC')
        ->get();
        return view('pages.warehouse-management',compact('title', 'menuItem'));
    }
    public function transport()
    {
        $title = "Transport Serveces";
        $menuItem = Menu::where('is_active', 1)
        ->where('app_id', 2)
        ->where('parent_id', 0)
        ->orderBy('sort_order', 'ASC')
        ->get();
        return view('pages.transport-services',compact('menuItem','title'));
    }
    public function other()
    {
        $title = "Other Services";
        $menuItem = Menu::where('is_active', 1)
        ->where('app_id', 2)
        ->where('parent_id', 0)
        ->orderBy('sort_order', 'ASC')
        ->get();
        return view('pages.other-services',compact('menuItem','title'));
    }

}
