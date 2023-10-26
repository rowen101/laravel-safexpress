<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
class MenuController extends Controller
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

        $title = "Menu";
// Fetch departments
        $app=  DB::table('app')->select('id', 'app_name')->where('is_active', '1')->get();
        $mparent = DB::table('menus')->select('id', 'menu_title')->where('is_active', '1')->get();
        if ($request->ajax()) {

            $data = DB::table("menus")
            ->join("app", "app.id", "=", "menus.app_id")
            ->select("menus.*", "app.app_name")
            ->orderBy('menus.created_at', 'DESC')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm edit">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm delete">Delete</a>';

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
        return view('admin.menu.index', [

            'title' => $title,
            'app' => $app,
            'mparent' => $mparent,
            'adminmenu' => $adminmenu

        ]);
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
    // Validate the request data as needed
    $this->validate($request, [
        'app_id' => 'required',
        'menu_title' => 'required',
        'menu_route' => 'required',
        'sort_order' => 'required',
        'parent_id' => 'required'
    ]);

    // Fetch the existing menu_code if the record exists
    $existingMenu = Menu::find($request->id);
    $menucode = $existingMenu ? $existingMenu->menu_code : '';

    // If no existing record, generate a new "techno" value
    if (!$menucode) {
        $latestMenu = Menu::orderBy('id', 'desc')->first();
        $nextNumber = $latestMenu ? (intval(substr($latestMenu->menu_code, 4)) + 1) : 1;
        $menucode = 'MENU' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }

    // Create or update the menu item
    Menu::updateOrCreate(
        ['id' => $request->id],
        [
            'app_id' => $request->app_id,
            'menu_code' => $menucode, // Use the fetched or generated menu_code
            'menu_title' => $request->menu_title,
            'description' => $request->description,
            'parent_id' => $request->parent_id,
            'menu_icon' => $request->menu_icon,
            'menu_route' => $request->menu_route,
            'sort_order' => $request->sort_order,
            'is_active' => $request->is_active,
            'created_by' => auth()->user()->id,
        ]
    );

    return response()->json(['success' => 'Record saved successfully!']);
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Menu::find($id);
        return view('admin.menu.show')->with(['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $app =  DB::table('app')->select('id', 'app_name')->where('is_active', '1')->get();
        $mparent = DB::table('menus')->select('id', 'menu_title')->where('is_active', '1')->get();
        $data = Menu::find($id);
        // ->join("app", "app.id", "=","menus.app_id")
        // ->select("menus.*", "app.app_name","app.id")
        // ->where('menu.id',$id)
        // ->orderBy('menus.created_at','DESC')->get();
        $title = "Edit Menu";
        return response()->json([$data,$app,$mparent]);

    }
    public function menuapp()
    {
        $app =  DB::table('app')->select('id', 'app_name')->where('is_active', '1')->get();
        return response()->json($app);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Menu::find($id)->delete();

        return response()->json(['success'=>'Product deleted successfully.']);
    }
}
