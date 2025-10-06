<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(){

        $client = new Client();
        $url = 'http://127.0.0.1:8000/api/invoices';
        $response = $client->request('get',$url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        $data = $contentArray['data'];

        return view('admin.invoice',['data' =>$data]);
    }
    public function cekTransaksi(Request $request){
        $request->validate([
            'transaksi_id' => 'required',
        ]);
        $url = 'http://127.0.0.1:8000/api/invoices/cekTransaksi';
        $client = new Client();
        $response = $client->request('POST', $url, [
            'multipart' => [
                [
                    'name'     => '_method',
                    'contents' => 'PUT',
                ],
                [
                    'name'     => 'transaksi_id',
                    'contents' => $request->input('transaksi_id'),
                ],
            ]
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] == true) {
            return redirect()->to('/admin/invoices')->with('message', 'Berhasil konfirmasi pembayaran');
        } else {
            $errors = $contentArray['message'] ?? ['Terjadi kesalahan saat konfirmasi pembayaran'];
            return redirect()->to('/admin/invoices')->withErrors($errors)->withInput();
        }
    }
}
