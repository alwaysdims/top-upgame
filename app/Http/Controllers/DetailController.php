<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index(){
        $client = new Client();
        $url = 'http://127.0.0.1:8000/api/detail';

        $response = $client->request('get',$url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        $data = $contentArray['data'];

        return view('frontend.detail_produk',['data' =>$data]);
    }
}
