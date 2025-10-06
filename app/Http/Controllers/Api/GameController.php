<?php

namespace App\Http\Controllers\Api;

use App\Models\Game;
use App\Models\Brand;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::with('brand')->get();
        $brand = Brand::all();
        if ($games->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Tidak ada data game',
                'data' => []
            ], 404);
        }
        return response()->json([
            'status' => true,
            'message' => 'Semua data game ditampilkan',
            'data' => [
                'game' => $games,
                'brand' => $brand
            ]
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ruls = [
            'name' => 'required',
            'brand_id' => 'required',
            'gambar' => 'required'
        ];

        $cekName = Game::where('name',$request->name)->first();

        if($cekName){
            return response()->json([
                'status' => false,
                'message'=> 'Name sudah digunakan'
            ], 400);
        }

        $validate = Validator::make($request->all(), $ruls);
        if($validate->fails()){
            return response()->json([
                'status' => false,
                'message' => $validate->errors()
            ],404);
        }

        //upload image
        $image = $request->file('gambar');
        $imageName = $image->storeAs('games', $image->hashName(), 'public');

        $games = new Game();
        $games->name = $request->name;
        $games->brands_id = $request->brand_id;
        $games->gambar = $imageName;
        $games->save();

        return response()->json([
            'status' => true,
            'message' => 'Game created successfully',
            'data' => $games
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Game = Game::with('brand')->find($id);
        if($Game){
            return response()->json([
                'status' => true,
                'message' => 'Data yang di cari ditemukan',
                'data' => $Game
            ],200);
        } else{
            return response()->json([
                'status' =>false,
                'message' => ' Data yang di cari tidak ditemukan'
            ],404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $ruls = [
            'name' => 'required',
            'brand_id' => 'required',
            'gambar' => 'required'
        ];

        $cekName = Game::where('name',$request->name)->first();

        if($cekName){
            return response()->json([
                'status' => false,
                'message'=> 'Name sudah digunakan'
            ], 400);
        }

        $validate = Validator::make($request->all(), $ruls);
        if($validate->fails()){
            return response()->json([
                'status' => false,
                'message' => $validate->errors()
            ],404);
        }

        //upload image
        $image = $request->file('gambar');
        $imageName = $image->storeAs('games', $image->hashName(), 'public');

        $games = Game::findOrFail($id);
        $games->name = $request->name;
        $games->brands_id = $request->brand_id;
        $games->gambar = $imageName;
        $games->save();

        return response()->json([
            'status' => true,
            'message' => 'Brand Updated successfully',
            'data' => $games
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Game::findOrFail($id);
        if(!$brand){
            return response()->json([
                'status' => false,
                'message' => 'Id tidak ditemukan'
            ],404);
        }else{
            $brand->delete();
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil dihapus'
            ],200);
        }
    }
}
