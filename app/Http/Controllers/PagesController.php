<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Posts;
use App\Models\Branch;
use App\Models\Comment;
use App\Models\Gallery;
use App\Models\Category;
use App\Models\BDirector;
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

        $directors = BDirector::where('is_active',1)
        ->get();

        return view('pages.index',compact('menuItem','directors'))->with(['title' => $title]);
    }

    public function about()
    {
        //$title = "About";
        $title = Menu::where('menu_code','about')->pluck('menu_title')->first();

        $menuItem = Menu::where('is_active', 1)
        ->where('app_id', 2)
        ->where('parent_id', 0)
        ->orderBy('sort_order', 'ASC')
        ->get();
        return view('pages.about',compact('menuItem'))->with(['title'=> $title]);
    }

    public function services()
    {
        $title = Menu::where('menu_code','ser')->pluck('menu_title')->first();
        $menuItem = Menu::where('is_active', 1)
        ->where('app_id', 2)
        ->where('parent_id', 0)
        ->orderBy('sort_order', 'ASC')
        ->get();
        return view('pages.services', compact('menuItem'))->with('title', $title);
    }
    public function contact()
    {
        $title = Menu::where('menu_code','ct')->pluck('menu_title')->first();
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
            $title = Menu::where('menu_code','teams')->pluck('menu_title')->first();
        return view('pages.teams')->with(['title' => $title, 'gallery' => $gallery, 'thumbnail' => $thumbnail,'menuItem'=> $menuItem]);
    }

    public function branch(Request $request)
    {
        $title = Menu::where('menu_code','brancl')->pluck('menu_title')->first();
        $menuItem = Menu::where('is_active', 1)
        ->where('app_id', 2)
        ->where('parent_id', 0)
        ->orderBy('sort_order', 'ASC')
        ->get();

        $regions = Branch::distinct()->pluck('region');

        $selectedRegion = $request->input('region');

        $branches = Branch::when($selectedRegion, function ($query) use ($selectedRegion) {
            return $query->where('region', $selectedRegion);
        })->get();

        return view('pages.branch', compact('title','menuItem','regions', 'selectedRegion', 'branches'));
    }
    public function filterBranches(Request $request)
    {
        $selectedRegion = $request->input('region');
        $branches = Branch::where('region', $selectedRegion)->get();

        return view('pages.filtered', compact('branches'));
    }
    public function blog()
    {
        $title = Menu::where('menu_code','bl')->pluck('menu_title')->first();
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
        $title = Menu::where('menu_code','ws')->pluck('menu_title')->first();
        $menuItem = Menu::where('is_active', 1)
        ->where('app_id', 2)
        ->where('parent_id', 0)
        ->orderBy('sort_order', 'ASC')
        ->get();
        return view('pages.warehouse-management',compact('title', 'menuItem'));
    }
    public function transport()
    {
        $title = Menu::where('menu_code','ts')->pluck('menu_title')->first();
        $menuItem = Menu::where('is_active', 1)
        ->where('app_id', 2)
        ->where('parent_id', 0)
        ->orderBy('sort_order', 'ASC')
        ->get();
        return view('pages.transport-services',compact('menuItem','title'));
    }
    public function other()
    {
        $title = Menu::where('menu_code','os')->pluck('menu_title')->first();
        $menuItem = Menu::where('is_active', 1)
        ->where('app_id', 2)
        ->where('parent_id', 0)
        ->orderBy('sort_order', 'ASC')
        ->get();
        return view('pages.other-services',compact('menuItem','title'));
    }

}
