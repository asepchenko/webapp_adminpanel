<?php

namespace App\Http\Controllers\Warehouse;

use DataTables;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class TripController extends Controller
{
    public function index(Request $request)
    {
        return view('warehouse.trip.index');
    }

    public function create(Request $request)
    {
        return view('warehouse.trip.create');
    }

    public function datatable(Request $request)
    {
        $api_url = config('api.api_url')."/trips";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        //dd($data);
        return DataTables::of($data)->make(true);
    }

    public function datatableCogs(Request $request, $no)
    {
        //$api_url = config('api.api_url')."/manifests-cogs/trip/".$no;
        $api_url = config('api.api_url')."/trip-cities/trip/".$no;
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        //dd($data);
        return DataTables::of($data)->make(true);
    }

    public function detail(Request $request, $no)
    {
        $api_url = config('api.api_url')."/trips/".$no;
        $response = GuzzleHelper::get($request, $api_url);
        //dd($response);
        $trip = $response->data;

        $driver_name = $response->data->details[0]->manifests->drivers->driver_name;
        $police_number = $response->data->details[0]->manifests->trucks->police_number;
        $truck = $response->data->details[0]->manifests->trucks->trucktypes->type_name;

        //$api_url = config('api.api_url')."/manifests-cogs/trip/".$no;
        $api_url = config('api.api_url')."/trip-cities/trip/".$no;
        $response = GuzzleHelper::get($request, $api_url);
        //dd($response);
        $cogs = $response->data;

        //dd($trip);
        return view('warehouse.trip.detail',
            compact('no','trip','cogs','driver_name','police_number','truck')
        );
    }

    public function store(Request $request)
    {
        $api_url = config('api.api_url')."/trips";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function update(Request $request)
    {
        $api_url = config('api.api_url')."/trips/".$request->id;
        $response = GuzzleHelper::put($request, $api_url);
        return $response;
    }

    public function closing(Request $request)
    {
        $api_url = config('api.api_url')."/trips/closing";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function delete(Request $request)
    {
        $api_url = config('api.api_url')."/trips/".$request->id;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }
}