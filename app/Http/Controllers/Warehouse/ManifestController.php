<?php

namespace App\Http\Controllers\Warehouse;

use PDF, DataTables;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class ManifestController extends Controller
{
    public function index(Request $request)
    {
        return view('warehouse.manifest.index');
    }

    public function datatable(Request $request)
    {
        $api_url = config('api.api_url')."/manifests";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        //dd($data);
        return DataTables::of($data)->make(true);
    }

    public function list(Request $request)
    {
        $api_url = config('api.api_url')."/manifests-list";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        //dd($data);
        return DataTables::of($data)->make(true);
    }

    public function listStt(Request $request, $manifest_number)
    {
        $api_url = config('api.api_url')."/manifests-stt-list/".$manifest_number;
        $response = GuzzleHelper::get($request, $api_url);
        return response()->json($response->data);
    }

    public function detail(Request $request, $no)
    {
        $api_url = config('api.api_url')."/manifests/".$no;
        $response = GuzzleHelper::get($request, $api_url);
        $manifest = $response->data;
        //dd($manifest->details[0]);
        $api_url = config('api.api_url')."/cities";
        $response = GuzzleHelper::get($request, $api_url);
        $cities = $response->data;

        $api_url = config('api.api_url')."/drivers";
        $response = GuzzleHelper::get($request, $api_url);
        $drivers = $response->data;

        if($manifest->details[0]->orders->servicegroups->group_name == "Trucking"){
            $api_url = config('api.api_url')."/trucks/type/".$manifest->details[0]->orders->truck_type_id;
            $response = GuzzleHelper::get($request, $api_url);
        }else{
            $api_url = config('api.api_url')."/trucks";
            $response = GuzzleHelper::get($request, $api_url);
        }

        $trucks = $response->data;
        //dd($trucks);
        return view('warehouse.manifest.detail',
            compact('no','manifest','cities','drivers','trucks')
        );
    }

    public function addDetail(Request $request)
    {
        $api_url = config('api.api_url')."/manifest-details";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function store(Request $request)
    {
        $api_url = config('api.api_url')."/manifests";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function update(Request $request)
    {
        $api_url = config('api.api_url')."/manifests/".$request->id;
        $response = GuzzleHelper::put($request, $api_url);
        return $response;
    }

    public function closing(Request $request)
    {
        $api_url = config('api.api_url')."/manifests/closing";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function printPDF(Request $request, $no)
    {
        $printdate = date('d-m-Y');
        $api_url = config('api.api_url')."/manifests/".$no;
        $response = GuzzleHelper::get($request, $api_url);
        $manifest = $response->data;
        
        $api_url = config('api.api_url')."/manifests-stt/".$no."/agent";
        $response = GuzzleHelper::get($request, $api_url);
        $agent = $response->data;

        $data = [
            'manifest' => $manifest,
            'agent' => $agent,
            'printdate' => date('d-m-Y H:i:s'),
        ];
        //dd($data);
        $pdf = PDF::loadView('warehouse.manifest.pdf', $data)->setPaper('a4');
        $output = $pdf->output();

        return new Response($output, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' =>  'inline; filename="'.$manifest->manifest_number.'.pdf',
        ]);
    }

    public function printSTT(Request $request, $no)
    {
        $printdate = date('d-m-Y');
        $api_url = config('api.api_url')."/manifests/".$no;
        $response = GuzzleHelper::get($request, $api_url);
        $manifest = $response->data;
        //dd($manifest->details);
        //dd(count($manifest->details));
        $data = [
            'stt' => $manifest->details,
            'countSTT' => count($manifest->details),
            'printdate' => date('d-m-Y H:i:s'),
        ];
        //dd($data);
        $pdf = PDF::loadView('warehouse.manifest.stt-pdf', $data)->setPaper('a5', 'landscape');
        $output = $pdf->output();

        return new Response($output, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' =>  'inline; filename="'.$manifest->manifest_number.'.pdf',
        ]);
    }

    public function delete(Request $request)
    {
        $api_url = config('api.api_url')."/manifests/".$request->id;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }

    public function deleteDetail(Request $request)
    {
        $api_url = config('api.api_url')."/manifest-details/".$request->id;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }
}
