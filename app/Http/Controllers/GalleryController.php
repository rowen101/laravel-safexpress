<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Barryvdh\Debugbar\Facades\Debugbar;
use Yajra\DataTables\Facades\DataTables;

class GalleryController extends Controller
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
    private function getAdminMenu()
    {
        $userId = auth()->user()->id;

        $menu = Menu::select('menus.*')
            ->join('usermenus', 'menus.id', '=', 'usermenus.menu_id')
            ->where('menus.is_active', 1)
            ->where('menus.app_id', 1)
            ->where('menus.parent_id', 0)
            ->where('usermenus.user_id', $userId)
            ->orderBy('menus.sort_order', 'ASC')
            ->get();

        // For each top-level menu item, fetch and attach its submenus based on user access
        $menu->each(function ($menuItem) use ($userId) {
            $menuItem->submenus = Menu::select('menus.*')
                ->join('usermenus', 'menus.id', '=', 'usermenus.menu_id')
                ->where('menus.is_active', 1)
                ->where('menus.parent_id', $menuItem->id)
                ->where('usermenus.user_id', $userId)
                ->orderBy('menus.sort_order', 'ASC')
                ->get();
        });

        return $menu;
    }
    public function index(Request $request)
    {
        $adminmenu = $this->getAdminMenu();
        $title = "Gallery";
        $datagallery = DB::table('galleries')
        ->get();
// Fetch departments

        if ($request->ajax()) {


            $data = DB::table("galleries")
            ->orderBy('created_at', 'DESC')
            ->where('gurec','<>','')
            ->get();

            return Datatables::of($data)

                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm edit"><i class="fas fa-edit"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Addimage" class="btn btn-success btn-sm addimage"><i class="fas fa-file-image"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm delete"><i class="fas fa-trash"></i></a>';
                    return $btn;
                })

                ->editColumn('is_active', function ($row) {
                    return $row->is_active == '1' ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa fa-circle"></i>';
                })
                ->addColumn('created_at', function ($data) {
                    return date('d/m/Y', strtotime($data->created_at));
                })
                ->rawColumns(['action', 'is_active', 'created_at'])
                ->make(true);
        }
        return view('admin.gallery.index')->with(['title' => $title,'datagallery'=> $datagallery,'adminmenu' => $adminmenu]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

          //dd($request->all());
            // Generate a 5-character code starting with "SL"
            $code = 'SLI-' . Str::random(3);
            $this->validate($request, [
                'foldername' => 'required',

            ]);
           Gallery::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'gurec' => $code,
                    'foldername' => $request->foldername,
                    'is_active' => $request->is_active,
                    'created_by' => auth()->user()->id,
                ]
            );
            return response()->json(['success' =>'Record saved successfully!']);

    }
    function upload(Request $request)
    {
        try {
            // Handle File Upload
            $image = $request->file('file');
            $input['file'] = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/thumbnail');
            $imgFile = Image::make($image->getRealPath());
            $imgFile->resize(1024, 768, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['file']);
            $destinationPath = public_path('/uploads');
            $image->move($destinationPath, $input['file']);

            //create post
            $post = new Gallery;
            $post->foldername = $request->input('foldername');
            $post->filename = $request->input('filename');
            $post->caption = $request->input('caption');
            $post->parent_id = $request->input('parent_id');
            // $post->sort = $request->input('sort');
            $post->created_at = auth()->user()->id;
            $post->image = $input['file'];
            // $post->is_active = $request->input('is_active');
            $post->save();


            return response()->json([
                'success' => $input['file'],
                'message' => 'Images Saved Successfully..'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error', $e->getMessage()]);
        }
    }

    function fetch(string $parent_id)
    {
        $images = DB::table('galleries')
            ->select('id', 'foldername', 'is_active', 'image', 'filename', 'caption')
            ->where('image', '<>', '')
            ->where('parent_id', $parent_id)
            ->get();
        $output = '<div class="row">';
        foreach ($images as $image) {
            $output .= '

  <div class="col-md-2" style="margin-bottom:16px;" align="center">
            <img src="' . asset('thumbnail/' . $image->image) . '" class="img-thumbnail" width="175" height="175" style="height:175px;" />
            <button type="button" class="btn btn-link remove_image" id="' . $image->image . '">Remove</button>
        </div>
  ';
        }
        $output .= '</div>';
        echo $output;
    }

    function delete(Request $request)
    {

        if ($request->get('name')) {
            $name = $request->name;
            $image_thumbnail_path = public_path('thumbnail/' . $name);
            $image_upload_path = public_path('uploads/' . $name);
            if (file_exists($image_thumbnail_path) || file_exists($image_upload_path)) {
                unlink($image_thumbnail_path);
                unlink($image_upload_path);
            }
           Gallery::where('image', $name)->firstorfail()->delete();
        }
    }
    public function addimage(Request $request)
    {
        try{

            //dd($request->all());
       $this->validate($request, [

           'filename' => 'required',
           //'caption' =>'required',
           'image' =>'required|image|mimes:jpeg,png,jpg,gif|max:2048'
       ]);

      // Handle File Upload
      $image = $request->file('image');
      $input['image'] = time().'.'.$image->getClientOriginalExtension();

      $destinationPath = public_path('/thumbnail');
      $imgFile = Image::make($image->getRealPath());
      $imgFile->resize(1024, 768, function ($constraint) {
          $constraint->aspectRatio();
      })->save($destinationPath.'/'.$input['image']);
      $destinationPath = public_path('/uploads');
      $image->move($destinationPath, $input['image']);


       //create post
       $post = new Gallery;
       $post->foldername = $request->input('foldername');
       $post->filename = $request->input('filename');
       $post->caption = $request->input('caption');
       $post->parent_id = $request->input('parent_id');
       // $post->sort = $request->input('sort');
       $post->created_at =auth()->user()->id;
       $post->image = $input['image'];
      // $post->is_active = $request->input('is_active');
       $post->save();

       return redirect('/admin/gallery')->with('success','Gallery Created',$input['image']);

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
        $data = Gallery::select('foldername','id','is_active')
        ->find($id);
        return response()->json($data);
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
    public function destroy(string $id)
    {
        try{
            Gallery::find($id)->delete();
            return response()->json('success','Gallery Successfully Delete ');
        } catch (\Exception $e){

        }

    }



}
