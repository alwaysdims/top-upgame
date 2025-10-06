<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index(){

        $client = new Client();
        $url = 'http://127.0.0.1:8000/api/vouchers';
        $response = $client->request('get',$url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        $data = $contentArray['data'];

        return view('admin.voucher',['data' =>$data]);
    }

    public function store(Request $request)
    {
        // dd($request->gambar);
        $request->validate([
            'code'=> 'required',
            'discount_value' => 'required',
            'min_price' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'usage_limit' => 'required',
        ]);
        $url = 'http://127.0.0.1:8000/api/vouchers';

        $client = new Client();

        $response = $client->request('POST', $url, [
            'multipart' => [
                [
                    'name'     => 'code',
                    'contents' => $request->input('code'),
                ],
                [
                    'name'     => 'discount_value',
                    'contents' => $request->input('discount_value'),
                ],
                [
                    'name'     => 'min_price',
                    'contents' => $request->input('min_price'),
                ],
                [
                    'name'     => 'start_date',
                    'contents' => $request->input('start_date'),
                ],
                [
                    'name'     => 'end_date',
                    'contents' => $request->input('end_date'),
                ],
                [
                    'name'     => 'usage_limit',
                    'contents' => $request->input('usage_limit'),
                ],

            ]
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if($contentArray['status'] == true){
            return redirect()->to('/admin/vouchers')->with('message', 'Berhasil menambahkan data vouchers');
        } else {
            $errors = $contentArray['message'] ?? ['Terjadi kesalahan saat menambahkan data vouchers'];
            return redirect()->to('/admin/vouchers')->withErrors($errors)->withInput();
        }

    }
    public function update(Request $request, $id)
    {
        $request->validate([
            //   'code'=> 'required',
            'discount_value' => 'required',
            'min_price' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'usage_limit' => 'required',
        ]);
        $url = 'http://127.0.0.1:8000/api/vouchers/' . $id;
        $client = new Client();
        $response = $client->request('POST', $url, [
            'multipart' => [
                [
                    'name'     => '_method',
                    'contents' => 'PUT',
                ],
                [
                    'name'     => 'discount_value',
                    'contents' => $request->input('discount_value'),
                ],
                [
                    'name'     => 'min_price',
                    'contents' => $request->input('min_price'),
                ],
                [
                    'name'     => 'start_date',
                    'contents' => $request->input('start_date'),
                ],
                [
                    'name'     => 'end_date',
                    'contents' => $request->input('end_date'),
                ],
                [
                    'name'     => 'usage_limit',
                    'contents' => $request->input('usage_limit'),
                ],
            ]
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] == true) {
            return redirect()->to('/admin/vouchers')->with('message', 'Berhasil mengupdate data vouchers');
        } else {
            $errors = $contentArray['message'] ?? ['Terjadi kesalahan saat mengupdate data vouchers'];
            return redirect()->to('/admin/vouchers')->withErrors($errors)->withInput();
        }
    }
    public function destroy($id)
    {
        $url = 'http://127.0.0.1:8000/api/vouchers/' . $id;
        $client = new Client();
        $response = $client->request('DELETE', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] == true) {
            return redirect()->to('/admin/vouchers')->with('message', 'Berhasil menghapus data vouchers');
        } else {
            $errors = $contentArray['message'] ?? ['Terjadi kesalahan saat menghapus data vouchers'];
            return redirect()->to('/admin/vouchers')->withErrors($errors)->withInput();
        }
    }
}
