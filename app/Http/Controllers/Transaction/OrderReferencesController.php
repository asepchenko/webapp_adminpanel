<?php

namespace App\Http\Controllers\Transaction;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class OrderReferencesController extends Controller
{

    /*public function index(Request $request, $id)
    {
        $api_url = config('api.api_url')."/order-references/customer/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        return response()->json($response->data);
    }*/

    public function datatable(Request $request, $id)
    {
        $api_url = config('api.api_url')."/order-references/order/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        
        $data = $response->data;
        //return DataTables::of($data)->make(true);
        if($response->meta->message == "OK"){
            return DataTables::of($data)->make(true);
        }else{
            return DataTables::of([])->make(true);
        }
    }

    public function importExcel(Request $request)
    {
        $api_url = config('api.api_url')."/order-references/import-excel";
        $response = GuzzleHelper::postOrderRefImportExcel($request, $api_url);
        return $response;
    }

    public function store(Request $request)
    {
        $api_url = config('api.api_url')."/order-references";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function show(Request $request, $id)
    {
        $api_url = config('api.api_url')."/order-references/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        return response()->json($response->data);
    }

    public function update(Request $request)
    {
        $api_url = config('api.api_url')."/order-references/".$request->id_ref;
        $response = GuzzleHelper::put($request, $api_url);
        return $response;
    }

    public function delete(Request $request)
    {
        $api_url = config('api.api_url')."/order-references/".$request->id;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }
}
