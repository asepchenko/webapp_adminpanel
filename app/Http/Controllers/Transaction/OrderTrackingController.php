<?php

namespace App\Http\Controllers\Transaction;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class OrderTrackingController extends Controller
{

    /*public function index(Request $request, $id)
    {
        $api_url = config('api.api_url')."/order-trackings/customer/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        return response()->json($response->data);
    }*/

    public function show(Request $request, $id)
    {
        $api_url = config('api.api_url')."/order-trackings/order/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        return response()->json($response->data);
    }

    public function store(Request $request)
    {
        $api_url = config('api.api_url')."/order-trackings";
        $response = GuzzleHelper::postOrderTracking($request, $api_url);
        //$response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function update(Request $request)
    {
        $api_url = config('api.api_url')."/order-trackings/".$request->id_unit;
        $response = GuzzleHelper::put($request, $api_url);
        return $response;
    }

    public function delete(Request $request)
    {
        $api_url = config('api.api_url')."/order-trackings/".$request->id;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }
}
