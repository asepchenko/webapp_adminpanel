<?php

namespace App\Http\Controllers\Marketing;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class ComproPostController extends Controller
{
    public function index(Request $request)
    {
        return view('marketing.compro.post.index');
    }

    public function create()
    {
        return view('marketing.compro.post.create');
    }

    public function datatable(Request $request)
    {
        $api_url = config('api.api_url')."/compro-posts";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        return DataTables::of($data)->make(true);
    }

    public function store(Request $request)
    {
        $api_url = config('api.api_url')."/compro-posts";
        $response = GuzzleHelper::postComproPost($request, $api_url);
        return $response;
    }

    public function show(Request $request, $id)
    {
        $api_url = config('api.api_url')."/compro-posts/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        $post = $response->data;
        return view('marketing.compro.post.edit',compact('post'));
    }

    public function update(Request $request)
    {
        $api_url = config('api.api_url')."/compro-posts/".$request->id;
        $response = GuzzleHelper::putComproPost($request, $api_url);
        return $response;
    }

    public function delete(Request $request)
    {
        $api_url = config('api.api_url')."/compro-posts/".$request->id;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }
}
