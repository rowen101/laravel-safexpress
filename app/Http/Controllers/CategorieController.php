<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\DataTables\CategoryDataTable;
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
    public function index(Request $request)
    {

        $title ="Categorie";
        $data = Category::latest()->get();
       // if ($request->ajax()) {

         //   $data = Category::latest()->get();

            // return Datatables::of($data)
            //         ->addIndexColumn()
            //         ->addColumn('action', function($row){

            //                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

            //                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

            //                 return $btn;
            //         })
            //         ->rawColumns(['action'])
            //         ->make(true);
        //}

        return view('admin.categorie.index')->with(['title' => $title, 'data' => $data]);
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
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        //update post
        $apps =  Category::find($id);
        $apps->name = $request->input('name');
        $apps->save();
        return response()->json(['message' => 'Record updated successfully!']);
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
