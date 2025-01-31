<?php

namespace App\Http\Controllers\Master;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class TrucksController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(\Gate::allows('master_truck_access'), 403);
        $api_url = config('api.api_url')."/truck-types";
        $response = GuzzleHelper::get($request, $api_url);
        $trucktypes = $response->data;
        return view('master.trucks.index', compact('trucktypes'));
    }

    public function datatable(Request $request)
    {
        abort_unless(\Gate::allows('master_truck_access'), 403);
        $api_url = config('api.api_url')."/trucks";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        return DataTables::of($data)->make(true);
    }

    public function store(Request $request)
    {
        abort_unless(\Gate::allows('master_truck_create'), 403);
        $api_url = config('api.api_url')."/trucks";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function show(Request $request, $id)
    {
        abort_unless(\Gate::allows('master_truck_access'), 403);
        $api_url = config('api.api_url')."/trucks/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        return response()->json($response->data);
    }

    public function update(Request $request)
    {
        abort_unless(\Gate::allows('master_truck_update'), 403);
        $api_url = config('api.api_url')."/trucks/".$request->id;
        $response = GuzzleHelper::put($request, $api_url);
        return $response;
    }

    public function delete(Request $request)
    {
        abort_unless(\Gate::allows('master_truck_delete'), 403);
        $api_url = config('api.api_url')."/trucks/".$request->id;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }
}
