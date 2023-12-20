<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Carousel;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
class CarouselController extends Controller
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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carousel = Carousel::where('is_active',1)
        ->get();

        $adminmenu = $this->getAdminMenu();
        $title = 'Carousel';
        return view('admin.carousel.index', compact('title', 'adminmenu','carousel'));

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

        // Path for the thumbnail and the original image
        $thumbnailDestinationPath = public_path('carousel/thumbnail');
        $originalDestinationPath = public_path('carousel');

        $imgFile = Image::make($image->getRealPath());

        // Resize the image for the thumbnail (400x300)
        $imgFile->resize(400, 300);
        $imgFile->save($thumbnailDestinationPath . '/' . $input['file'], 80); // The "80" is the image quality (adjust as needed)

        // Resize the original image (2200x900)
        $imgFile->resize(2200, 900);
        $imgFile->save($originalDestinationPath . '/' . $input['file'], 80); // The "80" is the image quality (adjust as needed)

        // Create post
        $post = new carousel;
        $post->caption = $request->input('caption');
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

    public function carouselfilename(Request $request)
    {
        Carousel::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'caption' => $request->caption,
                'detail' => $request->detail

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
        // Find the carousel data
        $carousel = Carousel::find($id);

        // Check if the carousel data exists
        if ($carousel) {
            // Get the image name from the carousel data
            $imageName = $carousel->image;

            // Delete the carousel data
            $carousel->delete();

            // Delete the image files if they exist
            $imageThumbnailPath = public_path('carousel/thumbnail/' . $imageName);
            $imageUploadPath = public_path('carousel/' . $imageName);

            if (file_exists($imageThumbnailPath)) {
                unlink($imageThumbnailPath);
            }

            if (file_exists($imageUploadPath)) {
                unlink($imageUploadPath);
            }

            // Return a JSON response indicating success
            return response()->json(['success' => 'Image and data deleted successfully']);
        } else {
            // Return a JSON response for not finding the carousel data
            return response()->json(['error' => 'carousel data not found'], 404);
        }
    }
}
