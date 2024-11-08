<?php

namespace App\Http\Controllers\Master;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class LocationsController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(\Gate::allows('master_regular_price_access'), 403);
        $api_url = config('api.api_url')."/cities";
        $response = GuzzleHelper::get($request, $api_url);
        $cities = $response->data;

        $api_url = config('api.api_url')."/services";
        $response = GuzzleHelper::get($request, $api_url);
        $services = $response->data;

        return view('master.locations.index',compact('cities','services'));
    }

    public function data(Request $request, $id)
    {
        $api_url = config('api.api_url')."/locations/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        return response()->json($response->data);
    }

    public function datatable(Request $request)
    {
        abort_unless(\Gate::allows('master_regular_price_access'), 403);
        $api_url = config('api.api_url')."/locations";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        return DataTables::of($data)->make(true);
    }

    public function store(Request $request)
    {
        abort_unless(\Gate::allows('master_regular_price_create'), 403);
        $api_url = config('api.api_url')."/locations";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function show(Request $request, $id)
    {
        abort_unless(\Gate::allows('master_regular_price_access'), 403);
        $api_url = config('api.api_url')."/locations/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        $location = $response->data;
        return view('master.locations.detail',compact('id','location'));
    }

    public function update(Request $request)
    {
        abort_unless(\Gate::allows('master_regular_price_update'), 403);
        $api_url = config('api.api_url')."/locations/".$request->id;
        $response = GuzzleHelper::put($request, $api_url);
        return $response;
    }

    public function delete(Request $request)
    {
        abort_unless(\Gate::allows('master_regular_price_delete'), 403);
        $api_url = config('api.api_url')."/locations/".$request->id;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }
}
