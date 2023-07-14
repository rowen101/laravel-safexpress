<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Posts;
use Illuminate\Http\Request;

class PostController extends Controller
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
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Post";
        $count = Posts::count();

      $posts = Posts::all();
        return view ('admin.post.index')->with(['title' => $title ,'posts'=> $posts,'count' => $count]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $count = Posts::count();
        $title = "Create Post";
        $categorie = Category::all();
        return view ('admin.post.create')->with(['title'=> $title, 'count' => $count, 'categorie' => $categorie]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',

        ]);

        //create post
        $apps = new Posts();
        $apps->title = $request->input('title');
        $apps->body = $request->input('body');
        $apps->category_id = 1;
        $apps->created_by =auth()->user()->id;
        $apps->save();

        return redirect('admin/post')->with('success','Post Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
