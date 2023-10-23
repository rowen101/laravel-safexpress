<?php

namespace App\Http\Controllers;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class WebUserController extends Controller
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
        $title = 'User List';
        $role = DB::table('role')->select('id', 'role_code')->where('is_active', '1')->get();
        if ($request->ajax()) {

            $data = DB::table('users')
                ->join("role", "role.id", "=", "users.role_id")
                ->select('users.*', 'role.role_code')
                ->get();

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
        return view('admin.user.index')->with(['title' => $title, 'role' => $role,'adminmenu'=>$adminmenu]);
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
        User::updateOrCreate(
            [
                'id' => $request->id,
            ],
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'user_type'=> $request->user_type,
                'role_id' => $request->role_id,
                'is_active' => $request->is_active,
                'created_by' => auth()->user()->id,
            ]
        );

            return response()->json(['success' => 'Record saved successfully!']);

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = User::find($id);
        $role = DB::table('role')->select('id', 'role_code')->where('is_active', '1')->get();
        return response()->json([$data, $role]);
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

             User::find($id)->delete();
            return response()->json('success', 'User remove Succesfully!');


    }
}
