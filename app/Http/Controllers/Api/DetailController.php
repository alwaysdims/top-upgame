<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Cards;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index()
    {
        $uri = request()->segment(2);

        $card = Cards::with(['cardToCategory','cardToBrand','cardToGame'])->get();

        $produk = Produk::with('categori')->where('category_id', $uri )->get();
        if ($produk->isEmpty()) {
            return response()->json([
                'message' => 'No data found',
                'status' => 404,
                'data' => $produk
            ], 404);
        }
        return response()->json([
            'message' => 'Welcome to the API Detail',
            'status' => 200,
            'data' => [
                'product' => $produk,
                'cards' => $card
            ]
        ]);
    }

}
