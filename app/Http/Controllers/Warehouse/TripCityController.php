<?php

namespace App\Http\Controllers\Warehouse;

use PDF, DataTables;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class TripCityController extends Controller
{

    public function detail(Request $request, $id)
    {
        $api_url = config('api.api_url')."/trip-cities/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        //return response()->json($response->data);
        if($response->meta->message == "OK"){
            return response()->json($response->data);
        }else{
            return response()->json("");
        }
    }

    public function update(Request $request)
    {
        $api_url = config('api.api_url')."/trip-cities/".$request->id;
        //return $request->all();
        $response = GuzzleHelper::put($request, $api_url);
        return $response;
    }
}
