<?php

namespace App\Http\Controllers\Setting;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class DepartemensController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(\Gate::allows('department_access'), 403);
        return view('setting.departemens.index');
    }

    public function datatable(Request $request)
    {
        abort_unless(\Gate::allows('department_access'), 403);
        $api_url = config('api.api_url')."/departemens";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        return DataTables::of($data)->make(true);
    }

    public function store(Request $request)
    {
        abort_unless(\Gate::allows('department_create'), 403);
        $api_url = config('api.api_url')."/departemens";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function show(Request $request, $id)
    {
        abort_unless(\Gate::allows('department_access'), 403);
        $api_url = config('api.api_url')."/departemens/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        return response()->json($response->data);
    }

    public function update(Request $request)
    {
        abort_unless(\Gate::allows('department_update'), 403);
        $api_url = config('api.api_url')."/departemens/".$request->id;
        $response = GuzzleHelper::put($request, $api_url);
        return $response;
    }

    public function delete(Request $request)
    {
        abort_unless(\Gate::allows('department_delete'), 403);
        $api_url = config('api.api_url')."/departemens/".$request->id;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }
}
