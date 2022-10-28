<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Register Account
    public function register(Request $request) {
        $fields = $request ->validate([
            'name'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string|confirmed'

        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user'=>$user,
            'token'=>$token
        ];

        return response($response, 201);

    }
    //Login Account
    public function login(Request $request) {
        $fields = $request ->validate([
            'email'=>'required|string',
            'password'=>'required|string'

        ]);
        //check email
        $user = User::where('email', $fields['email'])->first();
       
        //check password

        if(!$user||!Hash::check($fields['password'], $user->password)){
           /* return response([
                'message'=>'Invalid Login'
            ], 404);*/

            return response()->json([
                'message'=>'Incorrect email or password!'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user'=>$user,
            'token'=>$token
        ];

        return response($response, 201);

    }
    //Logout Account
    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return[
            'message'=>'Logged Out'
        ];
    }
}
