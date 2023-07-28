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
        // $content = DB::table("posts")
        //     ->join("categories", "categories.id", "=", "posts.category_id")
        //     ->join("users", "users.id", "=", "posts.created_by")
        //     ->select("posts.*", "categories.name", "users.first_name as fname")
        //     ->where('posts.is_active', true)
        //     ->orderBy('posts.created_at', 'DESC')->get();



        // $category = DB::table('categories')
        //     ->join('posts', 'posts.category_id', '=', 'categories.id')
        //     ->groupBy('categories.name')
        //     ->get();

        // $comment = Comment::all();

       $posts = Posts::where('is_active',1)->get();
        return view('pages.blog',compact('posts', 'title','menuItem'));


    }
    public function blogid(string $id)
    {


        $menuItem = Menu::where('is_active', 1)
        ->where('app_id', 2)
        ->where('parent_id', 0)
        ->orderBy('sort_order', 'ASC')
        ->get();

        $posts = Posts::find($id);
        // $posts = DB::table("posts")
        //     ->join("users", "users.id", "=", "posts.created_by")
        //     ->join("comments","posts.id", "=", "comments.post_id")
        //     ->select("posts.*", "users.name","comments.*")
        //     ->where('posts.id', $id)
        //     ->orderBy('posts.created_at', 'DESC')->get();

        // $comments = DB::table('comments')
        //     ->get();

        //dd($posts);

        $post = Posts::withCount('comments')->find($id);
        $commentCount = $post->comments_count;

        $user = Posts::with(['user'])->find($id);
        return view('pages.blog-details',compact('posts','menuItem','commentCount','user'));
    }

    public function warehouse()
    {
        return view('pages.warehouse-management');
    }
    public function transport()
    {
        return view('pages.transport-services');
    }
    public function other()
    {
        return view('pages.other-services');
    }

}
