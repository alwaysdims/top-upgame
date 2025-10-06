<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categori;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CategoriController extends Controller
{
    public function index()
    {
        $categori = Categori::all();
        return response()->json([
            'status' => true,
            'message' => 'Semua data brand ditampilkan',
            'data' => $categori
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
            'gambar' => 'required'
        ];

        $cekName = Categori::where('name',$request->name)->first();

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
        $imageName = $image->storeAs('categories', $image->hashName(), 'public');

        $categories = new Categori();
        $categories->name = $request->name;
        $categories->gambar = $imageName;
        $categories->save();

        return response()->json([
            'status' => true,
            'message' => 'Brand created successfully',
            'data' => $categories
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brand = Categori::find($id);
        if($brand){
            return response()->json([
                'status' => true,
                'message' => 'Data yang di cari ditemukan',
                'data' => $brand
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
            'gambar' => 'required'
        ];

        $cekName = Categori::where('name',$request->name)->first();

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
        $imageName = $image->storeAs('categories', $image->hashName(), 'public');

        $categories = Categori::findOrFail($id);
        $categories->name = $request->name;
        $categories->gambar = $imageName;
        $categories->save();

        return response()->json([
            'status' => true,
            'message' => 'Brand Updated successfully',
            'data' => $categories
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Categori::findOrFail($id);
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
