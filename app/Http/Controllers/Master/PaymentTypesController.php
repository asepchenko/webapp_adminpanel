<?php

namespace App\Http\Controllers\Master;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class PaymentTypesController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(\Gate::allows('master_payment_type_access'), 403);
        return view('master.payment-types.index');
    }

    public function datatable(Request $request)
    {
        abort_unless(\Gate::allows('master_payment_type_access'), 403);
        $api_url = config('api.api_url')."/payment-types";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        return DataTables::of($data)->make(true);
    }

    public function store(Request $request)
    {
        abort_unless(\Gate::allows('master_payment_type_create'), 403);
        $api_url = config('api.api_url')."/payment-types";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function show(Request $request, $id)
    {
        abort_unless(\Gate::allows('master_payment_type_access'), 403);
        $api_url = config('api.api_url')."/payment-types/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        return response()->json($response->data);
    }

    public function update(Request $request)
    {
        abort_unless(\Gate::allows('master_payment_type_update'), 403);
        $api_url = config('api.api_url')."/payment-types/".$request->id;
        $response = GuzzleHelper::put($request, $api_url);
        return $response;
    }

    public function delete(Request $request)
    {
        abort_unless(\Gate::allows('master_payment_type_delete'), 403);
        $api_url = config('api.api_url')."/payment-types/".$request->id;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }
}
