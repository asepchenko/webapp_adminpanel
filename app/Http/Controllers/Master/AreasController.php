<?php

namespace App\Http\Controllers\Master;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class AreasController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(\Gate::allows('master_area_access'), 403);
        return view('master.areas.index');
    }

    public function data(Request $request, $id)
    {
        $api_url = config('api.api_url')."/areas/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        return response()->json($response->data);
    }

    public function datatable(Request $request)
    {
        abort_unless(\Gate::allows('master_area_access'), 403);
        $api_url = config('api.api_url')."/areas";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        return DataTables::of($data)->make(true);
    }

    public function store(Request $request)
    {
        abort_unless(\Gate::allows('master_area_create'), 403);
        $api_url = config('api.api_url')."/areas";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function show(Request $request, $id)
    {
        abort_unless(\Gate::allows('master_area_access'), 403);
        $api_url = config('api.api_url')."/areas/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        $area = $response->data;

        $api_url = config('api.api_url')."/cities";
        $response = GuzzleHelper::get($request, $api_url);
        $cities = $response->data;
        return view('master.areas.detail',compact('id','area','cities'));
    }

    public function update(Request $request)
    {
        abort_unless(\Gate::allows('master_area_update'), 403);
        $api_url = config('api.api_url')."/areas/".$request->id;
        $response = GuzzleHelper::put($request, $api_url);
        return $response;
    }

    public function delete(Request $request)
    {
        abort_unless(\Gate::allows('master_area_delete'), 403);
        $api_url = config('api.api_url')."/areas/".$request->id;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }
}
