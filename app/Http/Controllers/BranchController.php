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
            ]);

            // Find the branch by ID or create a new instance if ID doesn't exist
            $branch = Branch::findOrNew($request->id);

            // Check if an image file was provided in the request
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/img', $fileName);

                //  // Resize the image here
                // $image = Branch::make(storage_path('app/public/img/' . $fileName));
                // $image->resize(600, 600); // Replace these dimensions with your desired width and height
                // $image->save();

                // Delete the old image if it exists
                if ($branch->image) {
                    Storage::delete('public/img/' . $branch->image);
                }

                // Update the branch with the new image
                $branch->fill([
                    'region' => $request->region,
                    'site' => $request->site,
                    'sitehead' => $request->sitehead,
                    'location' => $request->location,
                    'image' => $fileName,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'is_active' => $request->is_active,
                    'created_by' => auth()->user()->id,
                ]);
            } else {
                // No image provided, update other fields without changing the image
                $branch->fill([
                    'region' => $request->region,
                    'site' => $request->site,
                    'sitehead' => $request->sitehead,
                    'location' => $request->location,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'is_active' => $request->is_active,
                    'created_by' => auth()->user()->id,
                ]);
            }

            // Save the branch instance (creating a new one if necessary)
            $branch->save();

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
