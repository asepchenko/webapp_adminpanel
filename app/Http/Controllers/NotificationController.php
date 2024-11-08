<?php

namespace App\Http\Controllers;

use DataTables, DateTime, DateInterval, DatePeriod;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;

use Illuminate\Support\Facades\Http;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $api_url = config('api.api_url')."/notifications/list/LKE";
        $response = GuzzleHelper::get($request, $api_url);
        if($response->meta->message == "OK"){
            return response()->json($response->data);
        }else{
            return response()->json("");
        }
    }
}
