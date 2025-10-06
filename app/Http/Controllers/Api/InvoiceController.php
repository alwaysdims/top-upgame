<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetailTransaksi;
use App\Models\Log_stock;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(){
        $detail_transaksi = DetailTransaksi::with(['transaksi','produk'])->get();

        if ($detail_transaksi) {
            // $produk = Produk::with(['categori','game','brand'])->where('id', $detail_transaksi->product_id)->first();
            return response()->json([
                'status' => true,
                'message' => 'Detail transaksi ditemukan',
                'data' => [
                    'transaksi' => $detail_transaksi,
                    // 'produk' => $produk
                ]
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Transaksi tidak ditemukan'
            ], 404);
        }
    }
    public function cekTransaksi(Request $request){
        $rule = [
            'transaksi_id' => 'required',
        ];
        $validate = Validator::make($request->all(),$rule);
        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validate->errors()
            ], 400);
        }
        $detail_transaksi = DetailTransaksi::where('transaction_id', $request->transaksi_id)->first();
        $produk = Produk::find($detail_transaksi->product_id);
        if (!$produk) {
            return response()->json([
                'status' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        if (!$detail_transaksi) {
            return response()->json([
                'status' => false,
                'message' => 'Transaksi tidak ditemukan'
            ], 404);
        }
        $detail_transaksi->status = 'Success';
        $detail_transaksi->save();

        $log_stock =new Log_stock();
        $log_stock->product_id = $produk->id;
        $log_stock->stock_before = $produk->stock;
        $log_stock->stock_after = $produk->stock - $detail_transaksi->quantity;
        $log_stock->stock_change = $detail_transaksi->quantity;
        $log_stock->date = now();
        $log_stock->description = 'Transaksi pembelian produk';
        $log_stock->save();

        $produk->stock -= $detail_transaksi->quantity;
        $produk->save();

        return response()->json([
            'status' => true,
            'message' => 'Pembayaran dikonfirmasi',
            'data' => [
                'transaksi'=>$detail_transaksi,
                'produk' => $produk,
                ]
        ], 200);


    }
}
