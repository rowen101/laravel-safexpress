<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Posts;
use App\Models\Branch;
use App\Models\Comment;
use App\Models\Gallery;
use App\Models\Category;
use App\Models\BDirector;
use App\Models\Client;
use App\Models\Setting;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    private function getGuestMenu()
    {
        return Menu::select('menus.*')
            ->where('is_active', 1)
            ->where('app_id', 2)
            ->where('parent_id', 0)
            ->orderBy('sort_order', 'ASC')
            ->get();
    }


    public function index()
    {

        $title = "Home";
        $menuItem = $this->getGuestMenu();
        $setting = Setting::first();
        $carousel = Carousel::where('is_active', 1)
        ->get();

        $directors = BDirector::where('is_active',1)
        ->where('org_type','board')
        ->get();

        $clientlogo = Client::where('is_active',1)->get();

        $mancom = BDirector::where('is_active',1)
        ->where('org_type','mancom')
        ->get();

        return view('pages.index',compact('menuItem','directors','setting','mancom','clientlogo','carousel'))->with(['title' => $title]);
    }

    public function about()
    {
        //$title = "About";
        $title = Menu::where('menu_code','about')->pluck('menu_title')->first();

        $menuItem = $this->getGuestMenu();

        $setting = Setting::first();

        $directors = BDirector::where('is_active',1)
        ->where('org_type','board')
        ->get();

        return view('pages.about',compact('menuItem','directors','setting'))->with(['title'=> $title]);
    }

    public function services()
    {
        $title = Menu::where('menu_code','ser')->pluck('menu_title')->first();
        $menuItem = $this->getGuestMenu();

        $setting = Setting::first();
        return view('pages.services', compact('menuItem','setting'))->with('title', $title);
    }
    public function contact()
    {
        $title = Menu::where('menu_code','ct')->pluck('menu_title')->first();
        $setting = Setting::first();
        $menuItem = $this->getGuestMenu();
        $setting = Setting::first();
        return view('pages.contact',compact('menuItem','setting','title','setting'));
    }
    public function teams()
    {
        $menuItem = $this->getGuestMenu();

        $gallery = DB::table('galleries')
            ->select( 'id','foldername')
            ->where('is_active', 1)
            ->get();


        $thumbnail = DB::table('galleries')
            ->select('id', 'gurec', 'foldername', 'is_active', 'parent_id', 'image', 'filename', 'caption')
            ->where('image', '<>', '')
            ->get();
            $title = Menu::where('menu_code','teams')->pluck('menu_title')->first();

            $setting = Setting::first();
        return view('pages.teams',compact('setting'))->with(['title' => $title, 'gallery' => $gallery, 'thumbnail' => $thumbnail,'menuItem'=> $menuItem]);
    }

    public function branch(Request $request)
    {
        $title = "Branch";
        $menuItem = $this->getGuestMenu();
        $regions = Branch::distinct()->pluck('region');
        $selectedRegion = $request->input('region');
        $setting = Setting::first();
        $perPage = 10; // Adjust the number of items per page as needed
        $branches = Branch::when($selectedRegion, function ($query) use ($selectedRegion) {
             $query->where('region', $selectedRegion);
        })
        ->where('is_active', 1)
        ->paginate($perPage); // Paginate the results

        return view('pages.branch', compact('setting','title','menuItem','regions', 'selectedRegion', 'branches'));
    }

    public function blog()
    {
        $title = Menu::where('menu_code','bl')->pluck('menu_title')->first();
        $menuItem = $this->getGuestMenu();

        $postid = DB::table('posts')
        ->select('id')->get();

        $setting = Setting::first();
        //dd($postid);
       $posts = Posts::where('is_active',1)->where('is_publish',1)->get();
    //    $post = Posts::withCount('comments')->find();
    //     $commentCount = $post->comments_count;
        return view('pages.blog',compact('posts', 'title','menuItem','setting'));


    }
    public function blogid(string $id)
    {

        $posts = Posts::find($id);
        if($posts && $posts->is_publish){
            $post = Posts::withCount('comments')->find($id);
            $commentCount = $post->comments_count;
            $menuItem = $this->getGuestMenu();
            $setting = Setting::first();
            $user = Posts::with(['user'])->find($id);
            return view('pages.blog-details',compact('posts','menuItem','commentCount','user','setting'));
        }else{
            return view('inactivate');
        }

    }

    public function warehouse()
    {
        $title = Menu::where('menu_code','ws')->pluck('menu_title')->first();
        $menuItem = $this->getGuestMenu();

        $setting = Setting::first();
        return view('pages.warehouse-management',compact('title', 'menuItem','setting'));
    }
    public function transport()
    {
        $title = Menu::where('menu_code','ts')->pluck('menu_title')->first();
        $menuItem = $this->getGuestMenu();

        $setting = Setting::first();
        return view('pages.transport-services',compact('menuItem','title','setting'));
    }
    public function other()
    {
        $title = Menu::where('menu_code','os')->pluck('menu_title')->first();
        $menuItem = $this->getGuestMenu();

        $setting = Setting::first();
        return view('pages.other-services',compact('menuItem','title','setting'));
    }


}
