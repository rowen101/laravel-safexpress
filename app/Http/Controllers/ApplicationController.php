<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class ApplicationController extends Controller
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
        $title = "Application";
        if ($request->ajax()) {

            $data = App::select('*');

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

        return view('admin.application.index')->with(['title' => $title,'adminmenu'=>$adminmenu]);
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

        $request->validate([
            'app_code'          => 'required',
            'app_name'         => 'required',
            'description'        => 'required',
        ]);

        App::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'app_code' => $request->app_code,
                'app_name' => $request->app_name,
                'description' => $request->description,
                'app_icon' => $request->app_icon,
                'is_active' => $request->is_active,
                // 'status' => $request->status,
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
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = App::find($id);
        return response()->json($data);
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
    public function destroy($id)
    {
        $data = App::find($id);
        if (Menu::find($id) !== $data->id) {
            $data->delete();
            return response()->json(['success' => 'Application Remove successfully!']);
        } else {
            return response()->json(['error' => 'Application is use!']);
        }
    }
}
