<?php

namespace App\Http\Controllers\Master;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class CustomerTruckingPricesController extends Controller
{

    public function index(Request $request, $id)
    {
        $api_url = config('api.api_url')."/customer-trucking-prices/customer/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        return response()->json($response->data);
    }

    public function getTruckingPriceRates(Request $request, $customer, $origin, $destination, $truck)
    {
        $api_url = config('api.api_url')."/customer-trucking-prices/customer/".$customer."/origin/".$origin."/destination/".$destination."/truck/".$truck;
        $response = GuzzleHelper::get($request, $api_url);
        if($response->meta->message == "OK"){
            return response()->json($response->data);
        }else{
            return response()->json("");
        }
    }

    public function datatable(Request $request, $id)
    {
        $api_url = config('api.api_url')."/customer-trucking-prices/customer/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        return DataTables::of($data)->make(true);
    }

    public function store(Request $request)
    {
        $api_url = config('api.api_url')."/customer-trucking-prices";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function show(Request $request, $id)
    {
        $api_url = config('api.api_url')."/customer-trucking-prices/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        return response()->json($response->data);
    }

    public function update(Request $request)
    {
        $api_url = config('api.api_url')."/customer-trucking-prices/".$request->id;
        $response = GuzzleHelper::put($request, $api_url);
        return $response;
    }

    public function delete(Request $request)
    {
        $api_url = config('api.api_url')."/customer-trucking-prices/".$request->id;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }
}
