<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Models\Categori;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CategoriController extends Controller
{
    public function index(){

        $client = new Client();
        $url = 'http://127.0.0.1:8000/api/categorys';
        $response = $client->request('get',$url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        $data = $contentArray['data'];

        return view('admin.categori',['data' =>$data]);
    }

    public function store(Request $request)
    {
        // dd($request->gambar);
        $request->validate([
            'name' => 'required',
            'gambar' => 'required'
        ]);
        $url = 'http://127.0.0.1:8000/api/categorys';

        $client = new Client();

        $response = $client->request('POST', $url, [
            'multipart' => [
                [
                    'name'     => 'name',
                    'contents' => $request->input('name'),
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
            return redirect()->to('/admin/categorys')->with('message', 'Berhasil menambahkan data categori');
        } else {
            $errors = $contentArray['message'] ?? ['Terjadi kesalahan saat menambahkan data categori'];
            return redirect()->to('/admin/categorys')->withErrors($errors)->withInput();
        }

    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'gambar' => 'required'
        ]);
        $url = 'http://127.0.0.1:8000/api/categorys/' . $id;
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
                    'name'     => 'gambar',
                    'contents' => fopen($request->file('gambar')->getRealPath(), 'r'),
                    'filename' => $request->file('gambar')->getClientOriginalName()
                ],
            ]
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] == true) {
            return redirect()->to('/admin/categorys')->with('message', 'Berhasil mengupdate data categori');
        } else {
            $errors = $contentArray['message'] ?? ['Terjadi kesalahan saat mengupdate data categori'];
            return redirect()->to('/admin/categorys')->withErrors($errors)->withInput();
        }
    }
    public function destroy($id)
    {
        $url = 'http://127.0.0.1:8000/api/categorys/' . $id;
        $client = new Client();
        $response = $client->request('DELETE', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] == true) {
            return redirect()->to('/admin/categorys')->with('message', 'Berhasil menghapus data categori');
        } else {
            $errors = $contentArray['message'] ?? ['Terjadi kesalahan saat menghapus data categori'];
            return redirect()->to('/admin/categorys')->withErrors($errors)->withInput();
        }
    }
}
