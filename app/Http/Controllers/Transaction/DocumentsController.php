<?php

namespace App\Http\Controllers\Transaction;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class DocumentsController extends Controller
{

    public function index(Request $request)
    {
        /*$api_url = config('api.api_url')."/documents";
        $response = GuzzleHelper::get($request, $api_url);
        $documents = $response->data;*/
        return view('transaction.document.index');
    }

    public function datatable(Request $request)
    {
        $api_url = config('api.api_url')."/documents";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        //dd($data);
        return DataTables::of($data)->make(true);
    }

    public function accept(Request $request)
    {
        $api_url = config('api.api_url')."/documents/closing";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    /*
    public function show(Request $request, $id)
    {
        $api_url = config('api.api_url')."/order-units/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        return response()->json($response->data);
    }
    */
}
