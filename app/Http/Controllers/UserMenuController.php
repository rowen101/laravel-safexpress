<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Usermenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class UserMenuController extends Controller
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
        $menu = Menu::where('is_active', 1)
            ->where('app_id', 1)
            ->where('parent_id', 0)
            ->orderBy('sort_order', 'ASC')
            ->get();

        return $menu;
     }
    public function index(Request $request)
    {
        $adminmenu = $this->getAdminMenu();

        $title = "User Menu";
        if ($request->ajax()) {

            $data = DB::table("users")
                ->select('id', 'name', 'email', 'created_at', 'is_active')
                ->where('is_active', '1')
                ->orderBy('created_at', 'DESC')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm edit">User Menu Maintenance</a>';

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

        return view('admin.usermenu.index', [

            'title' => $title,
            'adminmenu' => $adminmenu
        ]);
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
        $user_id = $request->input('user_id');
        $menu_ids = $request->input('menu_id');


        foreach ($menu_ids as $menu_id) {
            UserMenu::updateOrInsert(
                ['user_id' => $user_id, 'menu_id' => $menu_id],
                ['user_id' => $user_id, 'menu_id' => $menu_id]
            );
        }

        return response()->json(['message' => 'Data saved successfully']);
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
        //
    }
}
