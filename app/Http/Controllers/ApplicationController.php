<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $data = App::orderBy('created_at','desc')->paginate(10);
        $title ="Application";
        return view('admin.application.index')->with(['title' => $title,'data' =>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title ="Application";
        return view('admin.application.create')->with('title',$title);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'app_code' => 'required',
            'app_name' => 'required',

        ]);

        //create post
        $apps = new App();
        $apps->app_code = $request->input('app_code');
        $apps->app_name = $request->input('app_name');
        $apps->description = $request->input('description');
        $apps->status = $request->has('status') ? true : false;
        $apps->created_by =auth()->user()->id;
        $apps->save();

        return redirect('admin/apps')->with('success','App Created Successfully!');
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
        $title ="Application";
        return view('admin.application.edit')->with(['title' => $title,'data' =>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $this->validate($request, [
            'app_code' => 'required',
            'app_name' => 'required',

        ]);
        $apps = App::find($id);
        $apps->app_code = $request->input('app_code');
        $apps->app_name = $request->input('app_name');
        $apps->description = $request->input('description');
        $apps->status = $request->input('status');
        $apps->created_by =auth()->user()->id;
        $apps->save();

        return redirect('admin/apps')->with('success','App Update Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $data = App::find($id);
        if(Menu::find($id) !== $data->id){
            $data->delete();
            return redirect('admin/apps')->with('success','Application  Removed');
        }
        else
        {
            return redirect('admin/apps')->with('error','Application  not Removed');
        }


    }
}
