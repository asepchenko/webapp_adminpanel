<?php

namespace App\Http\Controllers\Driver;

use DataTables, Session;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class DriverManifestController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(\Gate::allows('driver_update_tracking'), 403);
        return view('driver.manifest.index');
    }

    public function detail(Request $request,$no)
    {
        abort_unless(\Gate::allows('driver_update_tracking'), 403);
        $api_url = config('api.api_url')."/manifests-driver/".$no."/detail";
        $response = GuzzleHelper::get($request, $api_url);
        $manifest = $response->data;
        //dd($manifest);

        $api_url = config('api.api_url')."/manifests-driver/".$no."/agent";
        $response = GuzzleHelper::get($request, $api_url);
        $agents = $response->data;
        //dd($agents);

        $api_url = config('api.api_url')."/cities";
        $response = GuzzleHelper::get($request, $api_url);
        $cities = $response->data;
        return view('driver.manifest.detail',compact('no','manifest','agents','cities'));
    }

    public function datatable(Request $request)
    {
        $api_url = config('api.api_url')."/manifests-driver/".Session::get('user')->driver_id;
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        return DataTables::of($data)->make(true);
    }

    public function update(Request $request)
    {
        $api_url = config('api.api_url')."/manifests-driver";
        $response = GuzzleHelper::postManifestTracking($request, $api_url);
        return $response;
    }
}
