<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

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
        $ccount = Comment::count();
        $countpublish = Posts::where('is_publish','1')->count();
        $posts = Posts::all();
        return view('admin.post.index')->with([
            'title' => $title, 'posts' => $posts, 'count' => $count, 'ccount' => $ccount,'countpublish'=> $countpublish
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $count = Posts::count();
        $title = "Create Post";
        $categorie = Category::all();
        return view('admin.post.create')->with(['title' => $title, 'count' => $count, 'categorie' => $categorie]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //dd($request->all());
            $this->validate($request, [
                'title' => 'required',
                'body' => 'required',
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'

            ]);
            // Handle File Upload
            $image = $request->file('photo');
            $input['photo'] = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/thumbnail');
            $imgFile = Image::make($image->getRealPath());
            $imgFile->resize(1020, 768, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['photo']);
            $destinationPath = public_path('/uploads');
            $image->move($destinationPath, $input['photo']);

            //create post
            $apps = new Posts();
            $apps->title = $request->input('title');
            $apps->body = $request->input('body');
            $apps->category_id = 1;
            $apps->photo = $input['photo'];
            $apps->created_by = auth()->user()->id;
            $apps->save();

            return redirect('admin/post')->with('success', 'Post Created Successfully!');
            return redirect('admin/post')->with('success', 'Post Created Successfully!');
        } catch (\Exception $e) {
            return redirect('admin/post')->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function publish($id)
    {
        // $title = "Create Post";
        // $count = Posts::count();
        // $ccount = Comment::count();

        $posts = Posts::find($id);
        //dd($posts->is_publish);
        if($posts->is_publish == 0){
            $posts->is_publish = 1;
            $posts->save();
            return back()->with('success', 'Post publish Successfully!');
        }
        elseif($posts->is_publish == 1){
            $posts->is_publish = 0;
            $posts->save();
            return back()->with('error', 'Post Unpublish Successfully!');
        }
        else{

        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categorie = Category::all();
        $count = Posts::count();
        $title = "Edit Post";
        $post = Posts::find($id);
        return view('admin.post.edit')->with(['post' => $post, 'title' => $title, 'count' => $count, 'categorie' => $categorie]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            //dd($request->all());
            $this->validate($request, [
                'title' => 'required',
                'body' => 'required',
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'

            ]);

            // Handle File Upload
            $image = $request->file('photo');
            $input['photo'] = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/thumbnail');
            $imgFile = Image::make($image->getRealPath());
            $imgFile->resize(1020, 768, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['photo']);
            $destinationPath = public_path('/uploads');
            $image->move($destinationPath, $input['photo']);

            //create post
            $apps =  Posts::find($id);
            $apps->title = $request->input('title');
            $apps->body = $request->input('body');
            $apps->category_id = $request->input('category_id');
            $apps->photo = $input['photo'];
            $apps->created_by = auth()->user()->id;
            $apps->save();

            return redirect('admin/post')->with('success', 'Post Created Successfully!');
        } catch (\Exception $e) {
            return redirect('admin/post')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $post = DB::table('posts')
            ->select('id','photos')
            ->where('id',$id)->get();

            $image_thumbnail_path = public_path('thumbnail/' . $post->photo);
            $image_upload_path = public_path('uploads/' . $post->photo);
            if (file_exists($image_thumbnail_path) || file_exists($image_upload_path)) {
                unlink($image_thumbnail_path);
                unlink($image_upload_path);
            }

        $postdel = Posts::find($id);
        $postdel->delete();
        return view('admin.post.index')->with('success', 'Post Delete Successfully!');
    }
}
