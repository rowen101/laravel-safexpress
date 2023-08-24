<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use function Psy\debug;

class UserController extends Controller
{

    public   function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
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

    public function sign_up(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->role_id = $request['role_id'];
        $user->user_type = $request['user_type'];
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->save();


        $token = $user->createToken('apiToken')->plainTextToken;

        $res = [
            'user' => $user,
            'token' => $token
        ];
        return response()->json($res);
    }

}
