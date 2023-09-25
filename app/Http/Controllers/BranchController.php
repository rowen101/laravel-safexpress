<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Image;

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
    public function index(Request $request)
    {
        $title = "Branch Setup";
        if ($request->ajax()) {

            $data = Branch::select('*');

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm edit"><i class="fas fa-edit"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Addimage" class="btn btn-success btn-sm addimage"><i class="fas fa-file-image"></i></a>';
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
        return view('admin.branch.index', compact('title'));
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
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);


            // Include the 'created_by' field with the authenticated user's ID
            $data = $request->all();
            $data['created_by'] = auth()->user()->id;

            // Check if an existing product ID is provided in the request for updating
            if ($request->has('id')) {
                $branch = Branch::findOrFail($request->input('id'));

                // Update the product data
                $branch->update($data);

                // Handle image update
                if ($request->hasFile('image')) {
                    // Delete the old image file
                    Storage::delete('public/images/warehouse/' . $branch->image);

                    // Store and update the new image
                    $imagePath = $request->file('image')->store('public/images/warehouse');
                    $branch->update(['image' => str_replace('public/images/warehouse', '', $imagePath)]);
                }
            } else {
                // If no existing product ID is provided, create a new product
                if ($request->hasFile('image')) {
                    $imagePath = $request->file('image')->store('public/images/warehouse');
                    $data['image'] = str_replace('public/images/warehouse/', '', $imagePath);
                } else {
                    // If no image was uploaded, set the image field to null or an empty string, depending on your database schema.
                    $data['image'] = null; // You can use an empty string '' instead of null if preferred.
                }

                Branch::create($data);
            }
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
