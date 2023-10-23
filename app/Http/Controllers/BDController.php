<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\BDirector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class BDController extends Controller
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
        $title = 'Board of Director';
        if ($request->ajax()) {

            $data = BDirector::select('*');

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm edit"><i class="fas fa-edit"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm delete"><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->editColumn('fb', function ($row) {
                    return $row->fb == '' ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa fa-circle"></i>';
                })
                ->editColumn('tw', function ($row) {
                    return $row->tw == '' ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa fa-circle"></i>';
                })
                ->editColumn('linkin', function ($row) {
                    return $row->linkin == '' ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa fa-circle"></i>';
                })
                ->editColumn('instagram', function ($row) {
                    return $row->instagram == '' ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa fa-circle"></i>';
                })
                ->editColumn('is_active', function ($row) {
                    return $row->is_active == '1' ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa fa-circle"></i>';
                })
                ->addColumn('created_at', function ($data) {
                    return date('d/m/Y', strtotime($data->created_at));
                })
                ->rawColumns(['action', 'fb', 'tw', 'linkin', 'instagram', 'is_active', 'created_at'])
                ->make(true);
        }
        return view('admin.bdirector.index', compact('title', 'adminmenu'));
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
            $request->validate([
                'name' => 'required',
                'position' => 'required',
            ]);

            $bDirector = BDirector::find($request->id);

            if (!$bDirector) {
                $bDirector = new BDirector(); // Create a new instance if it doesn't exist
            }

            // Check if an image file was provided in the request
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                // Resize and save the image
                $image = Image::make($file);
                $image->resize(600, 600); // Resize the image to 600x600 pixels
                $image->save(storage_path('app/public/img/' . $fileName));

                // Delete the old image if it exists
                if ($bDirector->image) {
                    Storage::delete('public/img/' . $bDirector->image);
                }

                // Update the director with the new image
                $bDirector->image = $fileName; // Save the image filename in the database
            }

            // Update or create the rest of the fields
            $bDirector->name = $request->name;
            $bDirector->position = $request->position;
            $bDirector->about = $request->about;
            $bDirector->org_type = $request->org_type;
            $bDirector->is_social = $request->is_social;
            $bDirector->fb_url = $request->fb_url;
            $bDirector->tw_url = $request->tw_url;
            $bDirector->linkin_url = $request->linkin_url;
            $bDirector->instagram_url = $request->instagram_url;
            $bDirector->fb = $request->fb;
            $bDirector->tw = $request->tw;
            $bDirector->linkin = $request->linkin;
            $bDirector->instagram = $request->instagram;
            $bDirector->is_active = $request->is_active;
            $bDirector->created_by = auth()->user()->id;

            // Save the branch instance
            $bDirector->save();

            return response()->json(['success' => 'Success!']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
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
        $data = BDirector::find($id);
        return response()->json($data);
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
        // dd($id);
        $data = BDirector::find($id);
        if (Storage::delete('public/img/' . $data->image)) {
            BDirector::destroy($id);
        }
        return response()->json(['success' => 200]);
    }
}
