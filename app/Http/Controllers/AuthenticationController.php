<?php

namespace App\Http\Controllers;

use Exception;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthenticationController extends Controller
{

    public function register(Request $request){

        try {

            //validate input
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


            //create user if success
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


            //return a message
            return response()->json([
                'message' => 'register sucessfully',
                'user' => $user
            ]);

        } catch (Exception $e) {

            Log::error($e->getMessage());

            return response()->json([
                'message' => 'something went wrong!'
            ]);
        }
    }

    public function login(Request $request){

        try {

            //validate login data
            $request->validate([
                'username' => 'required',
                'password' => 'required'
            ]);

            //check credentials
            $credentials = $request->only('username','password');
            if(Auth::attempt($credentials)){

                $user = Auth::user();

                $token =  $user->createToken('AuthApi')->plainTextToken;

                return response()->json([
                    'user' => $user,
                    'token' => $token
                ]);

            }

            //return message if invalid credentials
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);

        } catch (Exception $e) {

            Log::error($e->getMessage());

            return response()->json([
                'message' => 'something went wrong!'
            ]);
        }
    }

    public function logout(){
        try {
            //delete token of current user
            Auth::user()->tokens()->delete();

            return response()->json([
                'message'=>'Successfully Logout'
            ]);

        } catch (Exception $e) {

            Log::error($e->getMessage());

            return response()->json([
                'message' => 'something went wrong!'
            ]);
        }
    }



}
