<?php

namespace App\Http\Controllers\Transaction;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class OrderUnitsController extends Controller
{

    /*public function index(Request $request, $id)
    {
        $api_url = config('api.api_url')."/order-units/customer/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        return response()->json($response->data);
    }*/

    public function datatable(Request $request, $id)
    {
        $api_url = config('api.api_url')."/order-units/order/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        
        $data = $response->data;
        //return DataTables::of($data)->make(true);
        if($response->meta->message == "OK"){
            return DataTables::of($data)->make(true);
        }else{
            return DataTables::of([])->make(true);
        }
    }

    public function store(Request $request)
    {
        $api_url = config('api.api_url')."/order-units";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function show(Request $request, $id)
    {
        $api_url = config('api.api_url')."/order-units/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        return response()->json($response->data);
    }

    public function update(Request $request)
    {
        $api_url = config('api.api_url')."/order-units/".$request->id_unit;
        $response = GuzzleHelper::put($request, $api_url);
        return $response;
    }

    public function delete(Request $request)
    {
        $api_url = config('api.api_url')."/order-units/".$request->id;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }
}
