<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return response()->json([
            'status' => true,
            'message' => 'Semua data users ditampilkan',
            'data' => $users
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $ruls = [
            'name'=> 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'no_telepon' => 'required',
            'alamat' => 'required',
            'role' => 'required',
        ];

        $cekUsername = User::where('username',$request->username)->first();

        if($cekUsername){
            return response()->json([
                'status' => false,
                'message'=> 'Username sudah digunakan'
            ], 400);
        }
        $cekEmail = User::where('email', $request->email)->first();
        if($cekEmail){
            return response()->json([
                'status' => false,
                'message' => 'Email sudah digunakan'
            ], 400);
        }

        $validate = Validator::make($request->all(), $ruls);
        if($validate->fails()){
            return response()->json([
                'status' => false,
                'message' => $validate->errors()
            ],404);
        }

        $users = new User();
        $users->name = $request->name;
        $users->username = $request->username;
        $users->email = $request->email;
        $users->password = Hash::make($request->password);
        $users->no_telepon = $request->no_telepon;
        $users->alamat = $request->alamat;
        $users->role = $request->role;
        $users->save();

        return response()->json([
            'status' => true,
            'message' => 'User created successfully',
            'data' => $users
        ], 201);
     }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        if($user){
            return response()->json([
                'status' => true,
                'message' => 'Data yang di cari ditemukan',
                'data' => $user
            ],200);
        } else{
            return response()->json([
                'status' =>false,
                'message' => ' Data yang di cari tidak ditemukan'
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $ruls = [
            'name'=> 'required',
            // 'password' => 'required',
            'no_telepon' => 'required',
            'alamat' => 'required',
            'role' => 'required',
        ];

        $validate = Validator::make($request->all(), $ruls);
        if($validate->fails()){
            return response()->json([
                'status' => false,
                'message' => $validate->errors()
            ],404);
        }

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->no_telepon = $request->no_telepon;
        $user->alamat = $request->alamat;
        $user->role = $request->role;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'User Updated successfully',
            'data' => $user
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if(!$user){
            return response()->json([
                'status' => false,
                'message' => 'Id tidak ditemukan'
            ],404);
        }else{
            $user->delete();
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil dihapus'
            ],200);
        }
    }
}
