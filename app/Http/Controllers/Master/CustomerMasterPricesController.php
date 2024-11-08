<?php

namespace App\Http\Controllers\Master;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class CustomerMasterPricesController extends Controller
{

    public function index(Request $request, $id)
    {
        $api_url = config('api.api_url')."/customer-master-prices/customer/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        return response()->json($response->data);
    }

    public function getMasterPriceRates(Request $request, $customer, $origin, $destination, $service)
    {
        $api_url = config('api.api_url')."/customer-master-prices/customer/".$customer."/origin/".$origin."/destination/".$destination."/service/".$service;
        $response = GuzzleHelper::get($request, $api_url);
        if($response->meta->message == "OK"){
            return response()->json($response->data);
        }else{
            return response()->json("");
        }
    }

    public function datatable(Request $request, $id)
    {
        $api_url = config('api.api_url')."/customer-master-prices/customer/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        return DataTables::of($data)->make(true);
    }

    public function store(Request $request)
    {
        $api_url = config('api.api_url')."/customer-master-prices";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function show(Request $request, $id)
    {
        $api_url = config('api.api_url')."/customer-master-prices/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        return response()->json($response->data);
    }

    public function update(Request $request)
    {
        $api_url = config('api.api_url')."/customer-master-prices/".$request->id_price;
        $response = GuzzleHelper::put($request, $api_url);
        return $response;
    }

    public function delete(Request $request)
    {
        $api_url = config('api.api_url')."/customer-master-prices/".$request->id;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }
}
