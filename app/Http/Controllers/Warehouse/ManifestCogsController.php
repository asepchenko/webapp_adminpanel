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

class ManifestCogsController extends Controller
{
    /*public function index(Request $request)
    {
        return view('warehouse.manifest.index');
    }

    public function datatable(Request $request)
    {
        $api_url = config('api.api_url')."/manifests";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        //dd($data);
        return DataTables::of($data)->make(true);
    }

    public function list(Request $request)
    {
        $api_url = config('api.api_url')."/manifests-list";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        //dd($data);
        return DataTables::of($data)->make(true);
    }*/

    public function detail(Request $request, $id)
    {
        $api_url = config('api.api_url')."/manifest-cogs/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        //return response()->json($response->data);
        if($response->meta->message == "OK"){
            return response()->json($response->data);
        }else{
            return response()->json("");
        }
    }

    /*public function store(Request $request)
    {
        $api_url = config('api.api_url')."/manifests";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }*/

    public function update(Request $request)
    {
        $api_url = config('api.api_url')."/manifest-cogs/".$request->id;
        //return $request->all();
        $response = GuzzleHelper::put($request, $api_url);
        return $response;
    }

    /*
    public function delete(Request $request)
    {
        $api_url = config('api.api_url')."/projects/".$request->id;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }*/
}
