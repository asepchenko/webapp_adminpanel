<?php

namespace App\Http\Controllers\Warehouse;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class WarehouseOrderController extends Controller
{
    public function index(Request $request)
    {
        return view('warehouse.order.index');
    }

    public function manifest($no)
    {
        return view('warehouse.order.manifest',compact('no'));
    }

    /*public function datatable(Request $request)
    {
        $api_url = config('api.api_url')."/projects";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        return DataTables::of($data)->make(true);
    }

    public function store(Request $request)
    {
        $api_url = config('api.api_url')."/projects";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function detail(Request $request, $id)
    {
        $api_url = config('api.api_url')."/projects/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        return response()->json($response->data);
    }

    public function update(Request $request)
    {
        $api_url = config('api.api_url')."/projects/".$request->id;
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function delete(Request $request)
    {
        $api_url = config('api.api_url')."/projects/".$request->id;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }*/
}