<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function register(Request $request) {
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

    public function login(Request $request) {

    }

    public function profile() {

    }

    public function logout() {

    }
}
