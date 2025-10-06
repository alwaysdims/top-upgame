<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\Produk;
use App\Models\Categori;
use App\Models\Brand;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){
        $client = new Client();
        $url = 'http://127.0.0.1:8000/api/products';
        $response = $client->request('get',$url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        $data = $contentArray['data'];

        return view('admin.products',['data' =>$data]);
    }

    public function store(Request $request)
    {
        // dd($request->gambar);
        $request->validate([
            'item' => 'required',
            'gambar' => 'nullable',
            'price' => 'required',
            'brand_id' => 'required',
            'categori_id' => 'required',
            'description' => 'nullable',
            'stock' => 'required|integer|min:0',
        ]);
        $url = 'http://127.0.0.1:8000/api/products';

        $client = new Client();

        $response = $client->request('POST', $url, [
            'multipart' => [
                [
                    'name'     => 'item',
                    'contents' => $request->input('item'),
                ],
                [
                    'name'     => 'price',
                    'contents' => $request->input('price'),
                ],
                [
                    'name'     => 'brand_id',
                    'contents' => $request->input('brand_id'),
                ],
                [
                    'name'     => 'category_id',
                    'contents' => $request->input('categori_id'),
                ],
                [
                    'name'     => 'description',
                    'contents' => $request->input('description'),
                ],
                [
                    'name'     => 'stock',
                    'contents' => $request->input('stock'),
                ],
                [
                    'name'     => 'image',
                    'contents' => fopen($request->file('image')->getRealPath(), 'r'),
                    'filename' => $request->file('image')->getClientOriginalName()
                ],
            ]
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if($contentArray['status'] == true){
            return redirect()->to('/admin/products')->with('message', 'Berhasil menambahkan data produk');
        } else {
            $errors = $contentArray['message'] ?? ['Terjadi kesalahan saat menambahkan data produk'];
            return redirect()->to('/admin/products')->withErrors($errors)->withInput();
        }

    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'item' => 'required',
            'gambar' => 'nullable',
            'price' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
            'description' => 'nullable',
            'stock' => 'required|integer|min:0',
        ]);

        $url = 'http://127.0.0.1:8000/api/products/' . $id;
        $client = new Client();
        $response = $client->request('POST', $url, [
            'multipart' => [
                [
                    'name'     => '_method',
                    'contents' => 'PUT',
                ],
                [
                    'name'     => 'item',
                    'contents' => $request->input('item'),
                ],
                [
                    'name'     => 'price',
                    'contents' => $request->input('price'),
                ],
                [
                    'name'     => 'brand_id',
                    'contents' => $request->input('brand_id'),
                ],
                [
                    'name'     => 'category_id',
                    'contents' => $request->input('category_id'),
                ],
                [
                    'name'     => 'description',
                    'contents' => $request->input('description'),
                ],
                [
                    'name'     => 'stock',
                    'contents' => $request->input('stock'),
                ],
                [
                    'name'     => 'image',
                    'contents' => fopen($request->file('image')->getRealPath(), 'r'),
                    'filename' => $request->file('image')->getClientOriginalName()
                ],
            ]
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] == true) {
            return redirect()->to('/admin/products')->with('message', 'Berhasil mengupdate data produk');
        } else {
            $errors = $contentArray['message'] ?? ['Terjadi kesalahan saat mengupdate data produk'];
            return redirect()->to('/admin/products')->withErrors($errors)->withInput();
        }
    }
    public function destroy($id)
    {
        $url = 'http://127.0.0.1:8000/api/products/' . $id;
        $client = new Client();
        $response = $client->request('DELETE', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] == true) {
            return redirect()->to('/admin/products')->with('message', 'Berhasil menghapus data produk');
        } else {
            $errors = $contentArray['message'] ?? ['Terjadi kesalahan saat menghapus data produk'];
            return redirect()->to('/admin/products')->withErrors($errors)->withInput();
        }
    }
}
