<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategorieController extends Controller
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
        $title ="Posts Categorie";

       if ($request->ajax()) {

        $data = Category::select('*');

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edit">Edit</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm delete">Delete</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.categorie.index')->with(['title' => $title, 'adminmenu' => $adminmenu]);
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


        $request->validate([
            'name'          => 'required',
        ]);
       Category::updateOrCreate([
            'id' => $request->id
       ],
       [
            'name' => $request->name
       ]);


        return response()->json(['success' => 'Record saved successfully!']);
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
        $category = Category::find($id);
        return response()->json($category);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        Category::find($id)->delete();

        return response()->json(['success'=>'Product deleted successfully.']);
    }
}
