<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
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
    public function index()
    {
        $title ="Setting";

        $setting = Setting::first(); // Retrieve the first settings record
        return view('admin.setting.index', compact('title', 'setting'));
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

       Setting::updateOrCreate([
            'id' => $request->id
       ],
       [
            'site_email' => $request->site_email,
            'site_phone' => $request->site_phone,
            'site_address' => $request->site_address
       ]);


        return response()->json(['success' => 'Saved Record successfully!']);
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
        $data = $request->all();

        $setting = Setting::first(); // Assuming you have only one settings record
        $setting->update($data);

        return response()->json(['success' => 'Settings updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
