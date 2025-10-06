<?php

namespace App\Http\Controllers\Api;

use App\Models\Produk;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Cards;
use App\Models\Categori;
use App\Models\Game;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::with(['categori', 'game','brand'])->get();
        $games = Game::all();

        $brands = Brand::all();
        $categories = Categori::all();

        // if ($produk->isEmpty()) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Tidak ada data produk ditemukan'
        //     ], 404);
        // }

        return response()->json([
            'status' => true,
            'message' => 'Semua data produk ditampilkan',
            'data' => [
                'produk' => $produk,
                'games' => $games,
                'brands' => $brands,
                'categorys' => $categories,
            ]
        ]);
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
            'item' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required',
            'stock' => 'required|integer|min:0'
        ];
        $validate = Validator::make($request->all(), $ruls);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validate->errors()
            ], 400);
        }

        $cekItem = Produk::where('item', $request->item)->first();
        if ($cekItem) {
            return response()->json([
                'status' => true,
                'message' => 'Stock sudah diisi ulang sudah digunakan'
            ], 400);
        }

        $game = Game::where('id', $request->brand_id)->first();

        $produk = new Produk();
        $produk->item = $request->item;
        $produk->price = $request->price;
        $produk->description = $request->description;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->storeAs('products', $image->hashName(), 'public');
            $produk->image = $imageName;
        }else{
            $produk->image = null;
        }
        $produk->brand_id = $request->brand_id;
        $produk->game_id = $game->id;
        $produk->category_id = $request->category_id;
        $produk->stock = $request->stock;
        $produk->save();

        $cekCard = Cards::where('category_id', $request->category_id)->first();
        if(!$cekCard){
            $card = new Cards();
            $card->brand_id = $game->id;
            $card->game_id = $request->brand_id;
            $card->category_id = $request->category_id;
            $card->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'Produk berhasil ditambahkan',
            'data' => $produk
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produk = Produk::find($id);
        if ($produk) {
            return response()->json([
                'status' => true,
                'message' => 'Produk ditemukan',
                'data' => $produk
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ruls = [
            'item' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'brand_id' => 'required',
            'category_id' => 'required',
            'stock' => 'nullable'
        ];

        $validate = Validator::make($request->all(), $ruls);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validate->errors()
            ], 400);
        }

        $cekItem = Produk::where('item', $request->item)
                        ->where('id', '!=', $id)
                        ->first();

        if ($cekItem) {
            return response()->json([
                'status' => false,
                'message' => 'Item sudah digunakan'
            ], 400);
        }

        $game = Game::find($request->brand_id);
        if (!$game) {
            return response()->json([
                'status' => false,
                'message' => 'Game tidak ditemukan'
            ], 404);
        }

        $produk = Produk::findOrFail($id);
        $produk->item = $request->item;
        $produk->price = $request->price;
        $produk->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->storeAs('products', $image->hashName(), 'public');
            $produk->image = $imageName;
        }

        $produk->brand_id = $request->brand_id;
        $produk->game_id = $game->id;
        $produk->category_id = $request->category_id;
        $produk->stock = $request->stock;
        $produk->save();

        return response()->json([
            'status' => true,
            'message' => 'Produk berhasil diperbarui',
            'data' => $produk
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produk = Produk::find($id);
        if ($produk) {
            $produk->delete();
            return response()->json([
                'status' => true,
                'message' => 'Produk berhasil dihapus'
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }
    }
}
