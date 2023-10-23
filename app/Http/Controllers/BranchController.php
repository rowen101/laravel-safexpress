<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use App\Models\Menu;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class BranchController extends Controller
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
        $title = "Branch Setup";
        if ($request->ajax()) {

            $data = Branch::select('*');

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm edit"><i class="fas fa-edit"></i></a>';
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
        return view('admin.branch.index', compact('title','adminmenu'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        try {
            $request->validate([
                'region' => 'required',
                'site' => 'required',
                'sitehead' => 'required',
                'location' => 'required',
                'phone' => 'required',
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                //'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);


            $sitebranch = Branch::find($request->id);

            if (!$sitebranch) {
                $sitebranch = new Branch(); // Create a new instance if it doesn't exist
            }

            // Check if an image file was provided in the request
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                // Resize and save the image
                $image = Image::make($file);
                $image->resize(600, 700); // Resize the image pixels
                $image->save(storage_path('app/public/img/' . $fileName));

                // Delete the old image if it exists
                if ($sitebranch->image) {
                    Storage::delete('public/img/' . $sitebranch->image);
                }

                // Update the director with the new image
                $sitebranch->image = $fileName; // Save the image filename in the database
            }

            // Update or create the rest of the fields
            $sitebranch->region = $request->region;
            $sitebranch->site = $request->site;
            $sitebranch->sitehead = $request->sitehead;
            $sitebranch->location = $request->location;
            $sitebranch->email = $request->email;
            $sitebranch->phone = $request->phone;
            $sitebranch->is_active = $request->is_active;
            $sitebranch->created_by = auth()->user()->id;

            // Save the branch instance
            $sitebranch->save();

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
        $data = Branch::find($id);
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

        $data = Branch::find($id);
        if (Storage::delete('public/img/' . $data->image)) {
            Branch::destroy($id);
        }
        return response()->json(['success' => 'Successfully deleted!']);
    }
}
