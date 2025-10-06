<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(){

        $client = new Client();
        $url = 'http://127.0.0.1:8000/api/games';
        $response = $client->request('get',$url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        $data = $contentArray['data'];

        return view('admin.game',['data' =>$data]);
    }

    public function store(Request $request)
    {
        // dd($request->gambar);
        $request->validate([
            'name' => 'required',
            'gambar' => 'required'
        ]);
        $url = 'http://127.0.0.1:8000/api/games';

        $client = new Client();

        $response = $client->request('POST', $url, [
            'multipart' => [
                [
                    'name'     => 'name',
                    'contents' => $request->input('name'),
                ],
                [
                    'name'     => 'brand_id',
                    'contents' => $request->input('brand_id'),
                ],
                [
                    'name'     => 'gambar',
                    'contents' => fopen($request->file('gambar')->getRealPath(), 'r'),
                    'filename' => $request->file('gambar')->getClientOriginalName()
                ],
            ]
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if($contentArray['status'] == true){
            return redirect()->to('/admin/games')->with('message', 'Berhasil menambahkan data brand');
        } else {
            $errors = $contentArray['message'] ?? ['Terjadi kesalahan saat menambahkan data brand'];
            return redirect()->to('/admin/games')->withErrors($errors)->withInput();
        }

    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'gambar' => 'required'
        ]);
        $url = 'http://127.0.0.1:8000/api/games/' . $id;
        $client = new Client();
        $response = $client->request('POST', $url, [
            'multipart' => [
                [
                    'name'     => '_method',
                    'contents' => 'PUT',
                ],
                [
                    'name'     => 'name',
                    'contents' => $request->input('name'),
                ],
                [
                    'name'     => 'brand_id',
                    'contents' => $request->input('brand_id'),
                ],
                [
                    'name'     => 'gambar',
                    'contents' => fopen($request->file('gambar')->getRealPath(), 'r'),
                    'filename' => $request->file('gambar')->getClientOriginalName()
                ],
            ]
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] == true) {
            return redirect()->to('/admin/games')->with('message', 'Berhasil mengupdate data brand');
        } else {
            $errors = $contentArray['message'] ?? ['Terjadi kesalahan saat mengupdate data brand'];
            return redirect()->to('/admin/games')->withErrors($errors)->withInput();
        }
    }
    public function destroy($id)
    {
        $url = 'http://127.0.0.1:8000/api/games/' . $id;
        $client = new Client();
        $response = $client->request('DELETE', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] == true) {
            return redirect()->to('/admin/games')->with('message', 'Berhasil menghapus data brand');
        } else {
            $errors = $contentArray['message'] ?? ['Terjadi kesalahan saat menghapus data brand'];
            return redirect()->to('/admin/games')->withErrors($errors)->withInput();
        }
    }
}
