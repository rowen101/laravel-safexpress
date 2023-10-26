<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = Client::where('is_active', 1)
        ->get();

        $adminmenu = $this->getAdminMenu();
        $title = "Client";


        return view('admin.client.index', compact('title', 'adminmenu','images'));
    }
    public function fetch()
    {

        $images = Client::where('is_active', 1)
        ->get();

        // Use dd to inspect the data

        return response()->json(['images' => $images]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Handle File Upload
            $image = $request->file('file');
            $input['file'] = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('clients/thumbnail');
            $imgFile = Image::make($image->getRealPath());
            $imgFile->resize(400, 300)
                ->save($destinationPath . '/' . $input['file']);
            $destinationPath = public_path('clients');
            $image->move($destinationPath, $input['file']);

            //create post
            $post = new Client;
            $post->filename = $request->input('filename');
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
    public function delete(Request $request)
    {
        if ($request->get('name')) {
            $name = $request->name;
            $image_thumbnail_path = public_path('client/thumbnail/' . $name);
            $image_upload_path = public_path('client/' . $name);
            if (file_exists($image_thumbnail_path) || file_exists($image_upload_path)) {
                unlink($image_thumbnail_path);
                unlink($image_upload_path);
            }
            Client::where('image', $name)->firstorfail()->delete();
        }
    }
}
