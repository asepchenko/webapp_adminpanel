<?php

namespace App\Http\Controllers\Master;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class TruckingPricesController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(\Gate::allows('master_trucking_price_access'), 403);
        $api_url = config('api.api_url')."/cities";
        $response = GuzzleHelper::get($request, $api_url);
        $cities = $response->data;

        $api_url = config('api.api_url')."/truck-types";
        $response = GuzzleHelper::get($request, $api_url);
        $trucktypes = $response->data;

        return view('master.trucking-prices.index',compact('cities','trucktypes'));
    }

    public function getTruckingPriceRates(Request $request, $origin, $destination, $type)
    {
        $api_url = config('api.api_url')."/trucking-prices/origin/".$origin."/destination/".$destination."/type/".$type;
        $response = GuzzleHelper::get($request, $api_url);
        if($response->meta->message == "OK"){
            return response()->json($response->data);
        }else{
            return response()->json("");
        }
    }

    public function data(Request $request, $id)
    {
        $api_url = config('api.api_url')."/trucking-prices/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        return response()->json($response->data);
    }

    public function datatable(Request $request)
    {
        abort_unless(\Gate::allows('master_trucking_price_access'), 403);
        $api_url = config('api.api_url')."/trucking-prices";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        return DataTables::of($data)->make(true);
    }

    public function store(Request $request)
    {
        abort_unless(\Gate::allows('master_trucking_price_create'), 403);
        $api_url = config('api.api_url')."/trucking-prices";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function show(Request $request, $id)
    {
        abort_unless(\Gate::allows('master_trucking_price_access'), 403);
        $api_url = config('api.api_url')."/trucking-prices/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        $trucking = $response->data;
        return view('master.trucking-prices.detail',compact('id','trucking'));
    }

    public function update(Request $request)
    {
        abort_unless(\Gate::allows('master_trucking_price_update'), 403);
        $api_url = config('api.api_url')."/trucking-prices/".$request->id;
        $response = GuzzleHelper::put($request, $api_url);
        return $response;
    }

    public function delete(Request $request)
    {
        abort_unless(\Gate::allows('master_trucking_price_delete'), 403);
        $api_url = config('api.api_url')."/trucking-prices/".$request->id;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }
}
