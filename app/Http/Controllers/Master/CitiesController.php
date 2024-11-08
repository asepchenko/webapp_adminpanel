<?php

namespace App\Http\Controllers\Master;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class CitiesController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(\Gate::allows('master_cities_access'), 403);
        $api_url = config('api.api_url')."/provinces";
        $response = GuzzleHelper::get($request, $api_url);
        $provinces = $response->data;
        return view('master.cities.index',compact('provinces'));
    }

    public function datatable(Request $request)
    {
        abort_unless(\Gate::allows('master_cities_access'), 403);
        $api_url = config('api.api_url')."/cities";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        return DataTables::of($data)->make(true);
    }

    public function store(Request $request)
    {
        abort_unless(\Gate::allows('master_cities_create'), 403);
        $api_url = config('api.api_url')."/cities";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function show(Request $request, $id)
    {
        abort_unless(\Gate::allows('master_cities_access'), 403);
        $api_url = config('api.api_url')."/cities/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        return response()->json($response->data);
    }

    public function update(Request $request)
    {
        abort_unless(\Gate::allows('master_cities_update'), 403);
        $api_url = config('api.api_url')."/cities/".$request->id;
        $response = GuzzleHelper::put($request, $api_url);
        return $response;
    }

    public function delete(Request $request)
    {
        abort_unless(\Gate::allows('master_cities_delete'), 403);
        $api_url = config('api.api_url')."/cities/".$request->id;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }
}
