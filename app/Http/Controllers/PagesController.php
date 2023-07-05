<?php

namespace App\Http\Controllers;

use App\Models\Menu;
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
        ->select('id','foldername', 'is_active','image','filename','caption')
        ->groupBy('foldername')
        ->get();

        $thumbnail = DB::table('galleries')
        ->select('id','foldername', 'is_active','image','filename','caption')
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

}
