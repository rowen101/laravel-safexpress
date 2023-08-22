<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
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
    public function index (Request $request)
    {
        $title="Branch Setup";
        if ($request->ajax()) {

            $data = Branch::select('*');

                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
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
                        ->rawColumns(['action','is_active','created_at'])
                        ->make(true);
            }
        return view('admin.branch.index',compact('title'));
    }
     /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'site'       => 'required',
            'branch'     => 'required',
            'sitehead'   => 'required',
            'location' => 'required',
            'phone' => 'required',
            'email' => 'required'
        ]);

        Branch::updateOrCreate(
            [
                'id' => $request->id,
                //'update' => auth()->user()->id
            ],
            [
                'site' => $request->site,
                'branch' => $request->branch,
                'sitehead' => $request->sitehead,
                'location' => $request->location,
                'maps' => $request->maps,
                'email' => $request->email,
                'phone' => $request->phone,
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
        Branch::find($id)->delete();
        return response()->json(['success'=>'Product deleted successfully.']);
    }
}
