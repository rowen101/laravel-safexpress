<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function Psy\debug;

class UserController extends Controller
{

    public   function login(Request $request)
    {
        $user= User::where('email', $request->email)->first();
        // print_r($data);
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }

             $token = $user->createToken('my-app-token')->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token
            ];

             return response($response, 201);
    }

    public function sign_up(Request $request){
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        $token = $user->createToken('apiToken')->plainTextToken;

        $res = [
            'user' => $user,
            'token' => $token
        ];
        return response($res, 201)->with('success','Successfully Sign up pleae Login ');;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = User::orderBy('created_at','desc')->get();
        return view('admin.user.index')->with(['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = DB::table('role')->select('id','role_code')->where('is_active','1')->get();
        return view('admin.user.create')->with(['role'=>$role]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
            try
            {
                $this->validate($request,[
                    'name'=> 'required',
                    'email'=> 'required',
                    'password'=> 'required',
                    'first_name'=> 'required',
                    'last_name'=> 'required',


                ]);


                $data = new User;
                $data->name = $request->input('name');
                $data->email = $request->input('email');
                $data->password = bcrypt($request->input('password'));
                $data->first_name = $request->input('first_name');
                $data->last_name = $request->input('last_name');
                $data->role_id = $request->input('role_id');
                $data->is_active = $request->has('is_active') ? true : false;
               $data->created_by = auth()->user()->id;

                $data->save();

                return redirect('/admin/user')->with('success','User Created');
            } catch(\Exception $e)
            {
                  return redirect('/admin/user/create')->with('error', $e->getMessage());
            }

    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
       $data = User::find($id);
       return view('admin.user.show')->with('data',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
       $data = User::find($id);
       $role = DB::table('role')->select('id','role_code')->where('is_active','1')->get();
       return view('admin.user.edit')->with(['data' =>$data,'role'=>$role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        dd($request->all());
        try
            {
                $this->validate($request,[
                    'name'=> 'required',
                    'email'=> 'required',
                    'password'=> 'required',
                    'first_name'=> 'required',
                    'last_name'=> 'required',


                ]);


                $data =  User::find($id);
                $data->name = $request->input('name');
                $data->email = $request->input('email');
                $data->password = bcrypt($request->input('password'));
                $data->first_name = $request->input('first_name');
                $data->last_name = $request->input('last_name');
                $data->role_id = $request->input('role_id');
                $data->is_active = $request->has('is_active') ? true : false;
               $data->created_by = auth()->user()->id;

                $data->save();

                return redirect('/admin.user.index')->with('success','User Created');
            } catch(\Exception $e)
            {
                  return redirect('/admin/user/edit')->with('error', $e->getMessage());
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $data = User::find($id);

       if(auth()->user()->id !== $data->id){
        return redirect('/admin.user.index')->with('error','Unauthorized Page');
       }

       $data->delete();
       return redirect('admin.user.index')->with('success','User Remove');
    }
}
