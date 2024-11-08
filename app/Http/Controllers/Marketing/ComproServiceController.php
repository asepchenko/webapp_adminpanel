<?php

namespace App\Http\Controllers\Marketing;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class ComproServiceController extends Controller
{
    public function index(Request $request)
    {
        return view('marketing.compro.service.index');
    }

    public function datatable(Request $request)
    {
        $api_url = config('api.api_url')."/compro-services";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        return DataTables::of($data)->make(true);
    }

    public function store(Request $request)
    {
        $api_url = config('api.api_url')."/compro-services";
        $response = GuzzleHelper::postComproService($request, $api_url);
        return $response;
    }

    public function show(Request $request, $id)
    {
        $api_url = config('api.api_url')."/compro-services/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        return response()->json($response->data);
    }

    public function update(Request $request)
    {
        $api_url = config('api.api_url')."/compro-services/".$request->id;
        $response = GuzzleHelper::putComproService($request, $api_url);
        return $response;
    }

    public function delete(Request $request)
    {
        $api_url = config('api.api_url')."/compro-services/".$request->id;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }
}
