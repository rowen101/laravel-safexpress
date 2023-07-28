<?php

namespace App\Http\Controllers;

use App\Models\Posts;
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

                               $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editCategorie">ddEdit</a>';

                               $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCategorie">Delete</a>';

                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }
        return view('admin.branch.index',compact('title'));
    }
}
