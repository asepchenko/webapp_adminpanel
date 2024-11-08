<?php

namespace App\Http\Controllers\Marketing;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class ComproGalleryController extends Controller
{
    public function index(Request $request)
    {
        return view('marketing.compro.gallery.index');
    }

    public function datatable(Request $request)
    {
        $api_url = config('api.api_url')."/compro-galleries";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        return DataTables::of($data)->make(true);
    }

    public function store(Request $request)
    {
        $api_url = config('api.api_url')."/compro-galleries";
        $response = GuzzleHelper::postComproGallery($request, $api_url);
        return $response;
    }

    public function show(Request $request, $id)
    {
        $api_url = config('api.api_url')."/compro-galleries/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        return response()->json($response->data);
    }

    public function update(Request $request)
    {
        $api_url = config('api.api_url')."/compro-galleries/".$request->id;
        $response = GuzzleHelper::putComproGallery($request, $api_url);
        return $response;
    }

    public function delete(Request $request)
    {
        $api_url = config('api.api_url')."/compro-galleries/".$request->id;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }
}
