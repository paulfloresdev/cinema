<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function create(Request $request)
    {
        $rules = [
            'name' => 'required|string|min:1|max:16',
            'lastname' => 'required|string|min:1|max:16',
            'email' => 'required|string|email|min:1|max:64',
            'username' => 'required|string|min:1|max:32',
            'password' => 'required|string|min:8|max:128',
            'role_id' => 'required|numeric'              
        ];
        $validator = Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation error',
                'errors' => $validator->errors()->all()
            ], 400);
        }
        try{
            $user = User::create([
                'name' => $request->name,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id
            ]);
            return response()->json([
                'status' => true,
                'message' => 'User created successfully',
                'token' => $user->createToken('API TOKEN')->plainTextToken
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'msg' => 'Something went wrong',
                'errors' => $e
            ], 500);
        }
    }


    public function login(Request $request)
    {
        $rules = [
            'username' => 'required|string|max:32',
            'password' => 'required|string|min:8|max:128'
        ];
        $validator = Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
        if (!Auth::attempt($request->only('username', 'password'))) {
            return response()->json([
                'status' => false,
                'errors' => ['Unauthorized']
            ], 401);
        }
        $user = User::where('username', $request->username)->first();

        return response()->json([
            'status' => true,
            'message' => 'User logged in successfully',
            'data' => $user,
            'token' => $user->createToken('API TOKEN')->plainTextToken
        ], 200);
    }

    public function checkToken()
    {
        return response()->json([
            'status' => true,
            'message' => 'The token is valid'
        ], 200);
    }


    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => true,
            'message' => 'User logged out successfully'
        ], 200);
    }
}
