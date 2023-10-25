<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class Authentication extends Controller
{

    public function register(Request $request){
        $request->validate([
            'email'=> 'required|string|email|unique:users',
            'password' =>'required|confirmed',
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'job_limit' => 'required',
            'user_level' => 'required',
            'organization_id' => 'required',
            'adaptation' => 'required',
            'username' => 'required|unique:users',

        ]);

        $user = User::create([
            'email' => $request->email,
            'password'=> Hash::make($request->password),
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'job_limit' => $request->job_limit,
            'user_level' => $request->user_level,
            'organization_id' => $request->organization_id,
            'adaptation' => $request->adaptation,
            'username' => $request->username,
        ]);



        return response()->json([
            'message' => 'register sucessfully',
            'user' => $user
        ]);
    }

    public function login(Request $request){

        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('username','password');
        if(Auth::attempt($credentials)){

            $user = Auth::user();

            $token =  $user->createToken('Auth Api')->plainTextToken;

            // $user->format('ph/manila')->(created_at)


            return response()->json([
                'user' => $user,

                'token' => $token
            ]);

        }

        return response()->json([
            'message' => 'Invalid login details'
        ]);

    }

    public function logout(){
        Auth::user()->tokens()->delete();

        return response()->json([
            'message'=>'Successfully Logout'
        ]);
    }



}
