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
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


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


        return view('admin.client.index', compact('title', 'adminmenu', 'images'));
    }
    public function fetch()
    {

        $images = Client::where('is_active', 1)->get();
        dd($images);

        return response()->json(['images' => $images]);
        // if ($images->count() > 0) {
        //     // Map the images if necessary
        //     $data = $images->map(function ($image) {
        //         return [
        //             'id' => $image->id,
        //             'filename' => $image->filename,
        //             'image_url' => asset('clients/' . $image->image),
        //             'thumbnail_url' => asset('clients/thumbnail/' . $image->image),
        //         ];
        //     });

        //     return response()->json(['images' => $data]);
        // } else {
        //     // If no images are found, return an empty JSON array
        //     return response()->json(['images' => []]);
        // }
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
            $input['file'] = time() . '.jpg'; // Change the extension to JPG

            $destinationPath = public_path('clients/thumbnail');
            $imgFile = Image::make($image->getRealPath());

            // Resize the image
            $imgFile->resize(400, 300);

            // Save the resized image as JPG
            $imgFile->save($destinationPath . '/' . $input['file'], 80); // The "80" is the image quality (adjust as needed)

            $destinationPath = public_path('clients');
            $image->move($destinationPath, $input['file']);

            // Create post
            $post = new Client;
            $post->filename = $request->input('filename');
            $post->created_at = auth()->user()->id;
            $post->image = $input['file'];
            $post->save();

            return response()->json([
                'success' => $input['file'],
                'message' => 'Image Saved Successfully..'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function clientfilename(Request $request)
    {
        Client::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'filename' => $request->filename,

            ]
        );


        return response()->json(['success' => 'Saved Record successfully!']);
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
        // Find the client data
        $client = Client::find($id);

        // Check if the client data exists
        if ($client) {
            // Get the image name from the client data
            $imageName = $client->image;

            // Delete the client data
            $client->delete();

            // Delete the image files if they exist
            $imageThumbnailPath = public_path('clients/thumbnail/' . $imageName);
            $imageUploadPath = public_path('clients/' . $imageName);

            if (file_exists($imageThumbnailPath)) {
                unlink($imageThumbnailPath);
            }

            if (file_exists($imageUploadPath)) {
                unlink($imageUploadPath);
            }

            // Return a JSON response indicating success
            return response()->json(['success' => 'Image and data deleted successfully']);
        } else {
            // Return a JSON response for not finding the client data
            return response()->json(['error' => 'Client data not found'], 404);
        }
    }
}
