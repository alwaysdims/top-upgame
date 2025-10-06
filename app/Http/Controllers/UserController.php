<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {

        $client = new Client();
        $url = 'http://127.0.0.1:8000/api/users';
        $response = $client->request('get',$url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        $data = $contentArray['data'];

        return view('admin.user',['data' =>$data]);
    }

    public function store(Request $request)
    {
       $users_data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'role' => $request->role
        ];

        $client = new Client();
        $url = 'http://127.0.0.1:8000/api/users';
        $response = $client->request('POST',$url,[
            'headers' => ['content-type' => 'application/json'],
            'json' => $users_data
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);

        if($contentArray['status'] == true){
            return redirect()->to('/admin/users')->with('message','Berhasil menambahkan data user');
        }else{
            $errors = $contentArray['message'] ?? ['Terjadi kesalahan saat menambahkan data brand'];
            return redirect()->to('/admin/users')->withErrors($errors)->withInput();
        }
    }

    public function update(Request $request,$id)
    {
        $client = new Client();
        $url = 'http://127.0.0.1:8000/api/users/' . $id;
        $response = $client->request('PUT', $url, [
            'headers' => ['content-type' => 'application/json'],
            'json' => [
                'name' => $request->name,
                'no_telepon' => $request->no_telepon,
                'alamat' => $request->alamat,
                'role' => $request->role
            ]
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] == true) {
            return redirect()->to('/admin/users')->with('message', 'Berhasil mengupdate data user');
        } else {
            $error = $contentArray['data'];
            return redirect()->to('/admin/users')->with($error)->withInput();
        }
    }

    public function delete($id)
    {
        $client = new Client();
        $url = 'http://127.0.0.1:8000/api/users/' . $id;
        $response = $client->request('DELETE', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] == true) {
            return redirect()->to('/admin/users')->with('message', 'Berhasil menghapus data user');
        } else {
            $error = $contentArray['data'];
            return redirect()->to('/admin/users')->with($error)->withInput();
        }
    }
}
