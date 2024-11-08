<?php

namespace App\Http\Controllers\Warehouse;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class DeliveryScheduleController extends Controller
{
    public function index(Request $request)
    {
        $api_url = config('api.api_url')."/manifests-schedule";
        $response = GuzzleHelper::get($request, $api_url);
        $mfts = $response->data;
        //dd($mfts);
        $events = [];

        if(count($mfts) > 0){
            foreach ($mfts as $mft) {
                $awbs = "";
                foreach($mft->details as $detail){
                    $awbs .= $detail->orders->awb_no.',';
                }

                //' ['.$mft->drivers->driver_name. ' - '.$mft->trucks->trucktypes->type_name.']',
                $events[] = [
                    'title' => $mft->destinations->city_name,
                    'no' => $mft->manifest_number,
                    'driver' => $mft->drivers->driver_name,
                    'truck' => $mft->trucks->police_number,
                    'truck_type' => $mft->trucks->trucktypes->type_name,
                    'destination' => $mft->destinations->city_name,
                    'description' => $awbs.' <br> Tgl : ('.$mft->manifest_date.')',
                    'start' => $mft->manifest_date,
                    'color' => 'green',
                    'url'   => '',
                ];
            }
        }
        //dd($events);
        return view('warehouse.delivery-schedule.index',compact('events'));
    }

    /*public function datatable(Request $request)
    {
        $api_url = config('api.api_url')."/projects";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        return DataTables::of($data)->make(true);
    }

    public function store(Request $request)
    {
        $api_url = config('api.api_url')."/projects";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function detail(Request $request, $id)
    {
        $api_url = config('api.api_url')."/projects/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        return response()->json($response->data);
    }

    public function update(Request $request)
    {
        $api_url = config('api.api_url')."/projects/".$request->id;
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function delete(Request $request)
    {
        $api_url = config('api.api_url')."/projects/".$request->id;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }*/
}
