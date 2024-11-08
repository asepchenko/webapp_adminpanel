<?php

namespace App\Http\Controllers;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;

use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $tmp = $request->session()->get('user');
        $api_url = config('api.api_url')."/users/".$tmp->id;
        $response = GuzzleHelper::get($request, $api_url);
        $user = $response->data;

        $api_url = config('api.api_url')."/orders-list/user";
        $response = GuzzleHelper::get($request, $api_url);
        $orders = $response->data;
        return view('profile.index',compact('user','orders'));
    }

    public function datatable(Request $request)
    {
        $api_url = config('api.api_url')."/profile";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        return DataTables::of($data)->make(true);
    }

    public function update(Request $request)
    {
        $api_url = config('api.api_url')."/profile";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function changePassword(Request $request)
    {
        $api_url = config('api.api_url')."/users/change-password";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function changeProfile(Request $request)
    {
        $api_url = config('api.api_url')."/users/change-profile";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }
}
