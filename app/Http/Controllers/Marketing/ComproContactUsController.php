<?php

namespace App\Http\Controllers\Marketing;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class ComproContactUsController extends Controller
{
    public function index(Request $request)
    {
        return view('marketing.compro.contact-us.index');
    }

    public function datatable(Request $request)
    {
        $api_url = config('api.api_url')."/compro-contacts";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        return DataTables::of($data)->make(true);
    }

    public function delete(Request $request)
    {
        $api_url = config('api.api_url')."/compro-contacts/".$request->id;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }
}
