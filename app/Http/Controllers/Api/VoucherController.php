<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::all();
        $nomorTransaksi = rand(1000, 9999);

        return response()->json([
            'status' => true,
            'message' => 'Semua data vouchers ditampilkan',
            'data' => [
                'vouchers' => $vouchers,
                'code' => $nomorTransaksi
                ]
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $ruls = [
            'code'=> 'required',
            'discount_value' => 'required',
            'min_price' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'usage_limit' => 'required',
        ];

        $code = Voucher::where('code',$request->code)->first();

        if($code){
            return response()->json([
                'status' => false,
                'message'=> 'Code voucher sudah digunakan'
            ], 400);
        }

        $validate = Validator::make($request->all(), $ruls);
        if($validate->fails()){
            return response()->json([
                'status' => false,
                'message' => $validate->errors()
            ],404);
        }

        $vouchers = new Voucher();
        $vouchers->code = $request->code;
        $vouchers->discount_value = $request->discount_value;
        $vouchers->min_price = $request->min_price;
        $vouchers->start_date = $request->start_date;
        $vouchers->end_date = $request->end_date;
        $vouchers->usage_limit = $request->usage_limit;
        $vouchers->save();

        return response()->json([
            'status' => true,
            'message' => 'Voucher created successfully',
            'data' => $vouchers
        ], 201);
     }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = Voucher::find($id);
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
            // 'code'=> 'required',
            'discount_value' => 'required',
            'min_price' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'usage_limit' => 'required',
        ];

        $validate = Validator::make($request->all(), $ruls);
        if($validate->fails()){
            return response()->json([
                'status' => false,
                'message' => $validate->errors()
            ],404);
        }

        $vouchers = Voucher::findOrFail($id);
        // $vouchers->code = $request->code;
        $vouchers->discount_value = $request->discount_value;
        $vouchers->min_price = $request->min_price;
        $vouchers->start_date = $request->start_date;
        $vouchers->end_date = $request->end_date;
        $vouchers->usage_limit = $request->usage_limit;
        $vouchers->save();

        return response()->json([
            'status' => true,
            'message' => 'vouchers Updated successfully',
            'data' => $vouchers
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Voucher::findOrFail($id);
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
