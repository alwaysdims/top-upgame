<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request){
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ],422);
        }

        $user = User::where('email',$request->email)->first();
        if($user && Hash::check($request->password, $user->password)){
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'Login berhasil',
                'data'=> [
                    'users' => [
                        'username' => $user->username,
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $user->role,
                    ],
                    'token' => $token
                ]
            ],200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Email atau password salah'
            ],400);
        }
    }

    public function loginUser(Request $request){
        $rules = [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ],422);
        }

        $user = User::where('username',$request->username)->first();
        if($user && Hash::check($request->password, $user->password)){
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'Login berhasil',
                'data'=> [
                    'users' => [
                        'id' => $user->id,
                        'username' => $user->username,
                        'name' => $user->name,
                        'email' => $user->email,
                        'no_telepon' => $user->no_telepon,
                        'alamat' => $user->alamat,
                        'role' => $user->role,
                    ],
                    'token' => $token
                ]
            ],200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Username atau password salah'
            ],400);
        }
    }
    public function register(Request $request){
        $rules = [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'no_telepon' => 'nullable|string|max:15',
            'alamat' => 'nullable|string|max:255',
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ],422);
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'role' => 'user', // Default role
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Registrasi berhasil',
            'data'=> [
                $user
            ]
        ],201);
    }
    
    public function logout(Request $request){
        $user = $request->user();
        if($user){
            $user->tokens()->delete();
            return response()->json([
                'status' => true,
                'message' => 'Logout berhasil'
            ],200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'User tidak ditemukan'
            ],404);
        }
    }

    public function profile(Request $request){
        $user = $request->user();
        if($user){
            return response()->json([
                'status' => true,
                'message' => 'Profile user',
                'data' => [
                    'user' => [
                        'name' => $user->name,
                        'username' => $user->username,
                        'email' => $user->email,
                        'no_telepon' => $user->no_telepon,
                        'alamat' => $user->alamat,
                        'role' => $user->role,
                    ]
                ]
            ],200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'User tidak ditemukan'
            ],404);
        }
    }
}
