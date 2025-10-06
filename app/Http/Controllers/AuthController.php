<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(){
        return view('admin.login');
    }
    public function login(Request $request){
        $url = 'http://127.0.0.1:8000/api/auth/login';
        $client = new Client();

        $data_user = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $response = $client->request('post', $url,[
            'headers' => ['content-type' => 'application/json'],
            'json' => $data_user
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if($contentArray['status'] == true){
            $user = $contentArray['data']['users'];
            $token = $contentArray['data']['token'];

            session(['user' => $user, 'token' => $token]);
            return redirect()->to('/admin/dashboard')->with('message', 'Berhasil login');
        } else{
            $errors = $contentArray['message'] ?? ['Terjadi kesalahan saat login'];
            return redirect()->to('/admin/auth/login')->withErrors($errors)->withInput();
        }
    }
}
