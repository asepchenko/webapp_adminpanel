<?php

namespace App\Http\Controllers\Master;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class CustomersController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(\Gate::allows('master_customer_access'), 403);
        return view('master.customers.index');
    }

    public function create(Request $request)
    {
        abort_unless(\Gate::allows('master_customer_create'), 403);
        $api_url = config('api.api_url')."/cities";
        $response = GuzzleHelper::get($request, $api_url);
        $cities = $response->data;
        return view('master.customers.create',compact('cities'));
    }

    public function datatable(Request $request)
    {
        abort_unless(\Gate::allows('master_customer_access'), 403);
        $api_url = config('api.api_url')."/customers";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        return DataTables::of($data)->make(true);
    }

    public function store(Request $request)
    {
        abort_unless(\Gate::allows('master_customer_create'), 403);
        $api_url = config('api.api_url')."/customers";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function show(Request $request, $id)
    {
        abort_unless(\Gate::allows('master_customer_access'), 403);
        $api_url = config('api.api_url')."/customers/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        $customer = $response->data;

        $api_url = config('api.api_url')."/cities";
        $response = GuzzleHelper::get($request, $api_url);
        $cities = $response->data;

        $api_url = config('api.api_url')."/locations";
        $response = GuzzleHelper::get($request, $api_url);
        $locations = $response->data;

        $api_url = config('api.api_url')."/services";
        $response = GuzzleHelper::get($request, $api_url);
        $services = $response->data;

        $api_url = config('api.api_url')."/truck-types";
        $response = GuzzleHelper::get($request, $api_url);
        $trucktypes = $response->data;

        return view('master.customers.edit',
            compact('customer','id','cities','locations','services','trucktypes')
        );
    }

    public function update(Request $request)
    {
        abort_unless(\Gate::allows('master_customer_update'), 403);
        $api_url = config('api.api_url')."/customers/".$request->id;
        $response = GuzzleHelper::put($request, $api_url);
        return $response;
    }

    public function delete(Request $request)
    {
        abort_unless(\Gate::allows('master_customer_delete'), 403);
        $api_url = config('api.api_url')."/customers/".$request->id;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }
}
