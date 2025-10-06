<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $client = new Client();
        $url = 'http://127.0.0.1:8000/api/home';

        $response = $client->request('get',$url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        $data = $contentArray['data'];

        return view('frontend.dashboard',['data' =>$data]);
    }

    public function detail_produk($id)
    {
        $client = new Client();
        $url = 'http://127.0.0.1:8000/api/home/detail_produk/'. $id;

        $response = $client->request('get',$url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        $data = $contentArray['data'];

        return view('frontend.detail_produk',['data' =>$data]);
    }
    public function transaksi(Request $request)
    {
        $client = new Client();
        $url = 'http://127.0.0.1:8000/api/home/transaksi';
        $response = $client->request('POST', $url, [
            'multipart' => [
                [
                    'name'     => 'user_id',
                    'contents' => $request->input('user_id'),
                ],
                [
                    'name'     => 'no_telp',
                    'contents' => $request->input('no_telp'),
                ],
                [
                    'name'     => 'zone_id',
                    'contents' => $request->input('zone_id'),
                ],
                [
                    'name'     => 'jumlah',
                    'contents' => $request->input('jumlah'),
                ],
                [
                    'name'     => 'pilihan',
                    'contents' => $request->input('pilihan'),
                ],
                [
                    'name'     => 'total',
                    'contents' => $request->input('total'),
                ],
                [
                    'name'     => 'voucher',
                    'contents' => $request->input('voucher'),
                ],
                [
                    'name'     => 'discount',
                    'contents' => $request->input('discount'),
                ],
            ]
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $id = $contentArray['data']['transaksi']['transaction_code'];
        if ($contentArray['status'] == true) {
            return redirect()->to('/detail_transaksi/'.$id)->with('message', 'Transaksi berhasil');
        } else {
            $errors = $contentArray['message'] ?? ['Terjadi kesalahan saat melakukan transaksi'];
            return redirect()->back()->withErrors($errors)->withInput();
        }
    }

    public function detail_transaksi($id)
    {
        $client = new Client();
        $url = 'http://127.0.0.1:8000/api/home/detail_transaksi/' . $id;
        $response = $client->request('get', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

        if ($contentArray['status'] == true) {
            $data = $contentArray['data'];
            return view('frontend.detail_transaksi', ['data' => $data]);
        } else {
            $errors = $contentArray['message'] ?? ['Terjadi kesalahan saat mengambil detail transaksi'];
            return redirect()->to('/')->withErrors($errors)->withInput();
        }
    }

    public function cariTransaksi(Request $request){
        $client = new Client();
        $url = 'http://127.0.0.1:8000/api/home/cari_transaksi';
        $response = $client->request('post', $url,[
        'multipart' => [
                [
                    'name'     => 'transaction_code',
                    'contents' => $request->input('transaction_code'),
                ],
            ]]
        );
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $id = $contentArray['data']['transaction_code'];
        if ($contentArray['status'] == true) {
            return redirect()->to('/detail_transaksi/'.$id)->with('message', 'Transaksi berhasil');
        } else {
            $errors = $contentArray['message'] ?? ['Terjadi kesalahan saat mengambil nota transaksi'];
            return redirect()->to('/')->withErrors($errors)->withInput();
        }
    }

    public function cari(){
        return view('frontend.cari');
    }

    public function buktiPembayaran(Request $request) {
        $client = new Client();
        $url = 'http://127.0.0.1:8000/api/home/bukti_pembayaran';

        try {
            $response = $client->request('POST', $url, [
                'multipart' => [
                    [
                        'name'     => '_method',
                        'contents' => 'PUT',
                    ],
                    [
                        'name'     => 'transaction_id',
                        'contents' => $request->input('transaction_id'),
                    ],
                    [
                        'name'     => 'bukti_pembayaran',
                        'contents' => fopen($request->file('bukti_pembayaran')->getRealPath(), 'r'),
                        'filename' => $request->file('bukti_pembayaran')->getClientOriginalName()
                    ]
                ]
            ]);

            $content = $response->getBody()->getContents();
            $contentArray = json_decode($content, true);

            $id = $contentArray['data']['transaction_code'] ?? null;

            if ($contentArray['status'] === true && $id) {
                return redirect()->to('/detail_transaksi/' . $id)->with('message', 'Bukti pembayaran berhasil dikirim');
            } else {
                $errors = $contentArray['message'] ?? ['Gagal mengirim bukti pembayaran'];
                return redirect()->back()->withErrors($errors)->withInput();
            }

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['Terjadi error: ' . $e->getMessage()])->withInput();
        }
    }


    public function article(){
        //  // Ambil data dari API The Lazy Media
        //  $response = Http::get('https://the-lazy-media-api.vercel.app/api/games/news');

        //  // Ubah menjadi array
        //  $news = $response->json();

        //  // Kirim ke view
        //  return view('frontend.dashboard', compact('news'));
    }
}
