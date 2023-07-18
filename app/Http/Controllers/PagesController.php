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
        return view('pages.index')->with(['title'=> $title]);
    }

    public function about()
    {
        $title = "About";
        return view('pages.about')->with('title', $title);
    }

    public function services()
    {
        $title = "Services";
        return view('pages.services')->with('title', $title);
    }
    public function contact()
    {
        $title = "contact";
        return view('pages.contact')->with('title', $title);
    }
    public function teams()
    {
        $gallery = DB::table('galleries')
        ->select('id','gurec','foldername', 'is_active','image','filename','caption')
        ->groupBy('foldername')
        ->get();


        $thumbnail = DB::table('galleries')
        ->select('id','gurec','foldername', 'is_active','parent_id','image','filename','caption')
        ->where('image','<>','')
        ->get();
        $title = "Teams";
        return view('pages.teams')->with(['title'=> $title ,'gallery'=> $gallery,'thumbnail'=>$thumbnail]);
    }

    public function branch()
    {
        $title = "Branch";
        return view('pages.branch')->with('title', $title);;
    }

    public function blog()
    {
        $title = "Blog";

        $content = DB::table("posts")
        ->join("categories", "categories.id", "=","posts.category_id")
        ->select("posts.*", "categories.name")
        ->where('is_active',true)
        ->orderBy('posts.created_at','DESC')->get();


        $category = DB::table('categories')
        ->join('posts','posts.category_id','=', 'categories.id')
        ->select('categories.*')
        ->get('categories.name');

        $comment = Comment::all();


        return view('pages.blog')->with(['title' => $title, 'content' => $content,
        'category' => $category,'comment' => $comment]);
    }
    public function blogid(string $id){
        $category = DB::table('categories')
        ->join('posts','posts.category_id','=', 'categories.id')
        ->select('categories.*')
        ->get();

        $commentCount = DB::table('comments')
                ->where('post_id', $id)
                ->count();

        $comment = DB::table('comments')->where('post_id','=',$id)->get();

      $posts = DB::table('posts')
        ->join('users','users.id', '=','posts.created_by')
        ->select('posts.*')
        ->where('posts.id',$id)
        ->get();
        return view('pages.blog-details')->with(['posts'=>$posts,'category'=>$category,'comment'=>$comment,'commentCount'=>$commentCount]);
    }


}
