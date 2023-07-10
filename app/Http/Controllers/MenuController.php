<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $title ="Menu";
        $menu = DB::table("menus")
         ->join("app", "app.id", "=","menus.app_id")
         ->select("menus.*", "app.app_name")
         ->orderBy('menus.created_at','DESC')->get();

       return view('admin.menu.index',[
        'menu'=>$menu,
        'title'=>$title,

    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mparent = DB::table('menus')->select('id','menu_title')->where('is_active','1')->get();
        $app =  DB::table('app')->select('id','app_name')->where('is_active','1')->get();
        $title ="Create Menu";
        return view('admin.menu.create')->with(['title'=>$title,'app'=>$app,'mparent'=>$mparent]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'menu_code' => 'required',
            'menu_title' => 'required',
            'description' => 'required',
        ]);

        //create post
        $apps = new Menu();
        $apps->app_id = $request->input('app_id');
        $apps->menu_code = $request->input('menu_code');
        $apps->menu_title = $request->input('menu_title');
        $apps->description = $request->input('description');
        $apps->parent_id = $request->input('parent_id');
        $apps->menu_icon = $request->input('menu_icon');
        $apps->menu_route = $request->input('menu_route');
        $apps->sort_order = $request->input('sort_order');
        $apps->is_active = $request->input('is_active');
        $apps->created_by =auth()->user()->id;
        $apps->save();

        return redirect('admin/menu')->with('success','Menu Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Menu::find($id);
        return view('admin.menu.show')->with(['data'=> $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $app =  DB::table('app')->select('id','app_name')->where('is_active','1')->get();
        $mparent = DB::table('menus')->select('id','menu_title')->where('is_active','1')->get();
        $data = Menu::find($id);
        // ->join("app", "app.id", "=","menus.app_id")
        // ->select("menus.*", "app.app_name","app.id")
        // ->where('menu.id',$id)
        // ->orderBy('menus.created_at','DESC')->get();
        $title ="Create Menu";
        return view('admin.menu.edit')->with(['data'=>$data,'title'=>$title,'app'=>$app,'mparent'=>$mparent]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
 //dd($request->all());
 $this->validate($request, [
    'menu_code' => 'required',
    'menu_title' => 'required',
    'description' => 'required',
]);

//create post
$apps = Menu::find($id);
$apps->app_id = $request->input('app_id');
$apps->menu_code = $request->input('menu_code');
$apps->menu_title = $request->input('menu_title');
$apps->description = $request->input('description');
$apps->parent_id = $request->input('parent_id');
$apps->menu_icon = $request->input('menu_icon');
$apps->menu_route = $request->input('menu_route');
$apps->sort_order = $request->input('sort_order');
$apps->is_active = $request->input('is_active');
$apps->created_by =auth()->user()->id;
$apps->save();

return redirect('admin/menu')->with('success','Menu update!');
        }catch(\Exception $e)
        {
            return redirect('/admin/menu/create')->with('error', $e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
