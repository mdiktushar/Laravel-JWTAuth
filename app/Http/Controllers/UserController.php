<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    //

    public function register(Request $request)
    {
        $request->validate([
            'name' => "required",
            'email' => "required|email|unique:users",
            'password' => "required|confirmed"
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

        return response()->json([
            'statue' => 200,
            'message' => 'user created'
        ], 200);
    }

    public function login(Request $request)
    {
         # Validation
         $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);
        
        $token = JWTAuth::attempt(['email' => $request->email, 'password' => $request->password]);

        if(!empty($token)) {
            return response()->json([
                'staus' => 200,
                'message' => "Successfully Loged in",
                'access_token' => $token
            ], 200);
        }

        return response()->json([
            'staus' => 406,
            'Invalide Email or Passowrd'
        ], 406);
        
    }

    public function profile()
    {
    }

    public function logout()
    {
    }
}
