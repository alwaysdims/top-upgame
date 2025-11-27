<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use App\Models\Voucher;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Categori;
use App\Models\Brand;
use App\Models\Cards;
use Illuminate\Support\Facades\Validator;
use App\Models\Game;
use App\Models\Log_stock;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    public function index()
    {
          // Ambil data dari API The Lazy Media
        $response = Http::get('https://the-lazy-media-api.vercel.app/api/games/news');
        // Ubah menjadi array
        $news = $response->json();

        $produk = Produk::with('categori')->with('game')->with('brand')->get();
        $game = Game::with('brand')->get();
        $categori = Categori::with('products')->get();
        $card = Cards::with(['cardToCategory','cardToBrand','cardToGame'])->get();

        return response()->json([
            'message' => 'Welcome to the API Home',
            'status' => 200,
            'data' => [
                'games' => $game,
                'products' => $produk,
                'categorys' => $categori,
                'cards' => $card,
                'news' => $news
            ]
        ]);
    }

    public function detail_produk($id)
    {
        $produk = Produk::with('categori')->where('category_id', $id)->get();
        $card = Cards::with(['cardToCategory','cardToBrand','cardToGame'])->where('category_id', $id)->first();
        $vouchers = Voucher::all();
        if ($produk->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Detail produk ditemukan',
            'data' => [
                'products' => $produk,
                'cards' => $card,
                'vouchers' => $vouchers
            ]
        ]);
    }

    public function transaksi(Request $request)
    {
        $ruls = [
            'user_id' => 'required',
            'zone_id' => 'required',
            'pilihan' => 'required',
            'jumlah' => 'required',
            'total' => 'required',
            'voucher' => 'required',
            'discount' => 'required'
        ];
        $validate = Validator::make($request->all(), $ruls);
        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validate->errors()
            ], 400);
        }
       // Ambil voucher berdasarkan ID dari request, bukan semua voucher
        $voucher = Voucher::find($request->voucher);

        if ($voucher->min_price < $request->total) {
            return response()->json([
                'status' => false,
                'message' => 'Voucher tidak bisa digunakan karena total belanja belum mencukupi minimum penggunaan.'
            ], 400);
        }

        $bayar = $request->total - $request->discount;

        $nomorTransaksi = rand(1000, 9999) . date('ymdHis');

        $transaksi = new Transaksi();
        $transaksi->user_id = session('user_id');
        $transaksi->transaction_code = $nomorTransaksi;
        $transaksi->game_id = $request->user_id;
        $transaksi->zone_id = $request->zone_id;
        $transaksi->no_telp = $request->no_telp;
        $transaksi->voucher_id = $request->voucher;
        $transaksi->status_pembayaran = 'Belum bayar';
        $transaksi->total_amount = $bayar;
        $transaksi->date = Carbon::now('Asia/Jakarta');
        $transaksi->save();

        $produk = Produk::find($request->pilihan);
        if (!$produk) {
            return response()->json([
                'status' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        if ($produk->stock <= $request->jumlah) {
            return response()->json([
                'status' => false,
                'message' => 'Stok produk tidak mencukupi'
            ], 400);
        }

        $detail_transaksi = new DetailTransaksi();
        $detail_transaksi->transaction_id = $transaksi->id;
        $detail_transaksi->transaction_code = $nomorTransaksi;
        $detail_transaksi->product_id = $request->pilihan;
        $detail_transaksi->quantity = $request->jumlah;
        $detail_transaksi->unit_price = $produk->price;
        $detail_transaksi->subtotal = $bayar;
        $detail_transaksi->status = 'pending';
        $detail_transaksi->save();

        return response()->json([
            'status' => true,
            'message' => 'Transaksi berhasil',
            'data' => [
                'transaksi' => $transaksi,
                'detail_transaksi' => $detail_transaksi,
                'produk' => $produk
            ]
        ], 201);
    }

    public function detail_transaksi($id)
    {

        $detail_transaksi = DetailTransaksi::with(['transaksi','produk'])->where('transaction_code', $id)->first();

        if ($detail_transaksi) {
            $produk = Produk::with(['categori','game','brand'])->where('id', $detail_transaksi->product_id)->first();

            return response()->json([
                'status' => true,
                'message' => 'Detail transaksi ditemukan',
                'data' => [
                    'transaksi' => $detail_transaksi,
                    'produk' => $produk
                ]
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Transaksi tidak ditemukan'
        ], 404);

    }
    public function buktiPembayaran(Request $request){

        $ruls = [
            'transaction_id' => 'required',
            'bukti_pembayaran' => 'required',
        ];

        $validate = Validator::make($request->all(),$ruls);
        if($validate->fails()){
            return response()->json([
                'status' => false,
                'message' => $validate->errors()
            ], 400);
        }
        // $image = $request->hasFile('bukti_pembayaran');
        $image = $request->file('bukti_pembayaran');
        $imageName = $image->storeAs('bukti_pembayaran', $image->hashName(), 'public');

        $transaksi = Transaksi::findOrFail($request->transaction_id);
        $transaksi->picture = $imageName;
        $transaksi->status_pembayaran = 'Sudah bayar';
        $transaksi->save();

        return response()->json([
            'status' => true,
            'message' => 'Success upload file',
            'data' => $transaksi
        ]);
    }
    public function cariTransaksi(Request $request){
        $rule = [
            'transaction_code' => 'required'
        ];
        $validate = Validator::make($request->all(), $rule);
        if($validate->fails()){
            return response()->json([
                'status' => false,
                'message' => $validate->errors()
            ], 400);
        }
        $transaksi = DetailTransaksi::with(['transaksi','produk'])->where('transaction_code', $request->transaction_code)->first();

        // Jika tidak ditemukan
        if (!$transaksi) {
            return response()->json([
                'status' => false,
                'message' => 'Transaksi tidak ditemukan'
            ], 404);
        }

        // Jika ditemukan
        return response()->json([
            'status' => true,
            'message' => 'Transaksi ditemukan',
            'data' => [ 'transaksi' => $transaksi ]
        ], 200);
    }
}
