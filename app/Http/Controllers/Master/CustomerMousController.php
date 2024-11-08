<?php

namespace App\Http\Controllers\Master;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class CustomerMousController extends Controller
{

    public function index(Request $request, $id)
    {
        $api_url = config('api.api_url')."/customer-mous/customer/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        return response()->json($response->data);
    }

    public function datatable(Request $request, $id)
    {
        $api_url = config('api.api_url')."/customer-mous/customer/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        return DataTables::of($data)->make(true);
    }

    public function store(Request $request)
    {
        $api_url = config('api.api_url')."/customer-mous";
        $response = GuzzleHelper::postCreateCustomerMou($request, $api_url);
        return $response;
    }

    public function show(Request $request, $id)
    {
        $api_url = config('api.api_url')."/customer-mous/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        return response()->json($response->data);
    }

    public function update(Request $request)
    {
        $api_url = config('api.api_url')."/customer-mous/".$request->id_mou;
        $response = GuzzleHelper::postUpdateCustomerMou($request, $api_url);
        return $response;
    }

    public function delete(Request $request)
    {
        $api_url = config('api.api_url')."/customer-mous/".$request->id;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }
}
