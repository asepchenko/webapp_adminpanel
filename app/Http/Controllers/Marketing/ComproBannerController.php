<?php

namespace App\Http\Controllers\Marketing;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class ComproBannerController extends Controller
{
    public function index(Request $request)
    {
        return view('marketing.compro.banner.index');
    }

    public function create()
    {
        return view('marketing.compro.banner.create');
    }

    public function datatable(Request $request)
    {
        $api_url = config('api.api_url')."/compro-banners";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        return DataTables::of($data)->make(true);
    }

    public function store(Request $request)
    {
        $api_url = config('api.api_url')."/compro-banners";
        $response = GuzzleHelper::postComproBanner($request, $api_url);
        return $response;
    }

    public function show(Request $request, $id)
    {
        $api_url = config('api.api_url')."/compro-banners/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        $banner = $response->data;
        return view('marketing.compro.banner.edit',compact('banner'));
    }

    public function update(Request $request)
    {
        $api_url = config('api.api_url')."/compro-banners/".$request->id;
        $response = GuzzleHelper::putComproBanner($request, $api_url);
        return $response;
    }

    public function delete(Request $request)
    {
        $api_url = config('api.api_url')."/compro-banners/".$request->id;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }
}
