<?php

namespace App\Http\Controllers;

use App\Models\BDirector;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class BDController extends Controller
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
        $title = 'Board of Director';
        if ($request->ajax()) {

            $data = BDirector::select('*');

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm edit"><i class="fas fa-edit"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm delete"><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->editColumn('fb', function ($row) {
                    return $row->fb == '' ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa fa-circle"></i>';
                })
                ->editColumn('tw', function ($row) {
                    return $row->tw == '' ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa fa-circle"></i>';
                })
                ->editColumn('linkin', function ($row) {
                    return $row->linkin == '' ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa fa-circle"></i>';
                })
                ->editColumn('instagram', function ($row) {
                    return $row->instagram == '' ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa fa-circle"></i>';
                })
                ->editColumn('is_active', function ($row) {
                    return $row->is_active == '1' ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa fa-circle"></i>';
                })
                ->addColumn('created_at', function ($data) {
                    return date('d/m/Y', strtotime($data->created_at));
                })
                ->rawColumns(['action', 'fb', 'tw', 'linkin', 'instagram', 'is_active', 'created_at'])
                ->make(true);
        }
        return view('admin.bdirector.index', compact('title'));
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
    try {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'about' => 'required',
        ]);

        // Find the branch by ID or create a new instance if ID doesn't exist
        $bDirector = BDirector::findOrNew($request->id);

        // Check if an image file was provided in the request
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/img', $fileName);

            // Delete the old image if it exists
            if ($bDirector->image) {
                Storage::delete('public/img/' . $bDirector->image);
            }

            // Update the director with the new image
            $bDirector->file([
                'name' => $request->name,
                'image' => $fileName, // Save the image filename in the database
                'position' => $request->position,
                'about' => $request->about,
                'fb_url' => $request->fb_url,
                'tw_url' => $request->tw_url,
                'linkin_url' => $request->linkin_url,
                'instagram_url' => $request->instagram_url,
                'fb' => $request->fb,
                'tw' => $request->tw,
                'linkin' => $request->linkin,
                'instagram' => $request->instagram,
                'is_active' => $request->is_active,
                'created_by' => auth()->user()->id,
            ]);
        } else {
            // No image provided, update other fields without changing the image
            $bDirector->fill([
                'name' => $request->name,
                'position' => $request->position,
                'about' => $request->about,
                'fb_url' => $request->fb_url,
                'tw_url' => $request->tw_url,
                'linkin_url' => $request->linkin_url,
                'instagram_url' => $request->instagram_url,
                'fb' => $request->fb,
                'tw' => $request->tw,
                'linkin' => $request->linkin,
                'instagram' => $request->instagram,
                'is_active' => $request->is_active,
                'created_by' => auth()->user()->id,
            ]);
        }

        // Save the branch instance (creating a new one if necessary)
        $bDirector->save();

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
        $data = BDirector::find($id);
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
        // dd($id);
        $data = BDirector::find($id);
        if (Storage::delete('public/img/' . $data->image)) {
            BDirector::destroy($id);
        }
        return response()->json(['success' => 200]);
    }
}
