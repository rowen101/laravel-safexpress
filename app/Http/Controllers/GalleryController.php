<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\Debugbar\Facades\Debugbar;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gallery = DB::table('galleries')
        ->select('id','foldername', 'is_active')
        ->groupBy('foldername')
        ->where('foldername','<>','')
        ->get();
        $title ="Gallery";
        return view('admin.gallery.index',[
            'gallery'=>$gallery,
            'title'=>$title,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gallery.create',[


        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{

             //dd($request->all());
        $this->validate($request, [
            'foldername' => 'required',
            // 'filename' => 'required',
            //'cover_image' =>'required'
            //'image' =>'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        //Handle File Upload
        // if($request->hasFile('image')){
        //     //Get Filename with Extension
        //     $filenamewithExt = $request->file('image')->getClientOriginalName();
        //     //Get just Filename
        //     $filename = pathinfo($filenamewithExt, PATHINFO_FILENAME);
        //     //Get file ext
        //     $extension = $request->file('image')->getClientOriginalExtension();
        //     //Filename store
        //     $filenameToStore = $filename.'_'.time().'.'.$extension;
        //     //Upload Image
        //     $path = $request->file('image')->storeAs('public/cover_image',$filenameToStore);

        // } else {
        //     $filenameToStore = 'noimage.jpg';
        // }
        //create post
        $post = new Gallery();
        $post->foldername = $request->input('foldername');
        // $post->filename = $request->input('filename');
        // $post->sort = $request->input('sort');
        $post->created_at =auth()->user()->id;
        //$post->image = $filenameToStore;
        $post->is_active = $request->input('is_active');
        $post->save();

        return redirect('/admin/gallery')->with('success','Gallery Created');

        } catch (\Exception $e){
            return redirect('/admin/gallery/create')->with('error', $e->getMessage());
        }

    }
    public function viewimage($id)
    {
        //DB::table('galleries')->select('id','foldername')->where('id',$id)->get();
        $data = Gallery::find($id);
        return view('admin.gallery.image')->with('data',$data);
    }
    public function addimage(Request $request)
    {
        try{

            //dd($request->all());
       $this->validate($request, [

           'filename' => 'required',
           'caption' =>'required',
           'image' =>'required|image|mimes:jpeg,png,jpg,gif|max:2048'
       ]);

      // Handle File Upload

       if($request->hasFile('image')){
           //Get Filename with Extension
           $filenamewithExt = $request->file('image')->getClientOriginalName();
           //Get just Filename
           $filename = pathinfo($filenamewithExt, PATHINFO_FILENAME);
           //Get file ext
           $extension = $request->file('image')->getClientOriginalExtension();
           //Filename store
           $filenameToStore = $filename.'_'.time().'.'.$extension;
           //Upload Image
           $path = $request->file('image')->storeAs('public/cover_image',$filenameToStore);

       } else {
           $filenameToStore = 'noimage.jpg';
       }
       //create post
       $post = new Gallery;
       $post->foldername = $request->input('foldername');
       $post->filename = $request->input('filename');
       $post->caption = $request->input('caption');
       $post->parent_id = $request->input('parent_id');
       // $post->sort = $request->input('sort');
       $post->created_at =auth()->user()->id;
       $post->image = $filenameToStore;
       $post->is_active = $request->input('is_active');
       $post->save();

       return redirect('/admin/gallery')->with('success','Gallery Created');

       } catch (\Exception $e){
          // return redirect('/admin/gallery/create')->with('error', $e->getMessage());
       }

    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

    public function subimage($id)
    {
        $gallery = Gallery::find($id);
        $title ="Gallery";
        return view('admin.gallery.subimage',[
            'gallery'=>$gallery,
            'title'=>$title,

        ]);
    }
    public function subimageupload(Request $request, $id)
    {
        try{

            //dd($request->all());
       $this->validate($request, [
           'filename' => 'required',
           'sort_order' => 'required',
           //'cover_image' =>'required'
           'image' =>'required|image|mimes:jpeg,png,jpg,gif|max:2048'
       ]);

       //Handle File Upload
       if($request->hasFile('cover_image')){
           //Get Filename with Extension
           $filenamewithExt = $request->file('cover_image')->getClientOriginalName();
           //Get just Filename
           $filename = pathinfo($filenamewithExt, PATHINFO_FILENAME);
           //Get file ext
           $extension = $request->file('cover_image')->getClientOriginalExtension();
           //Filename store
           $filenameToStore = $filename.'_'.time().'.'.$extension;
           //Upload Image
           $path = $request->file('cover_image')->storeAs('public/cover_image',$filenameToStore);

       } else {
           $filenameToStore = 'noimage.jpg';
       }
       //create post
       $post =  Gallery::find($id);
       $post->filaname = $request->input('filename');
       $post->sort_order = $request->input('sort_order');
       // $post->user_id =auth()->user()->id;
       $post->image = $filenameToStore;
       $post->is_active = $request->input('is_active');
       $post->save();

       return redirect('/admin/gallery/create')->with('success','Gallery Created');

       } catch (\Exception $e){
           return redirect('/admin/gallery/create')->with('error', $e->getMessage());
       }
    }
}
