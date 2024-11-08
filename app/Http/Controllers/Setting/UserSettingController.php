<?php

namespace App\Http\Controllers\Setting;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class UserSettingController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(\Gate::allows('user_access'), 403);
        return view('setting.users.index');
    }

    public function create(Request $request)
    {
        abort_unless(\Gate::allows('user_create'), 403);
        $api_url = config('api.api_url')."/branchs";
        $response = GuzzleHelper::get($request, $api_url);
        $branchs = $response->data;

        $api_url = config('api.api_url')."/departemens";
        $response = GuzzleHelper::get($request, $api_url);
        $departemens = $response->data;

        $api_url = config('api.api_url')."/roles";
        $response = GuzzleHelper::get($request, $api_url);
        $roles = $response->data;

        $api_url = config('api.api_url')."/drivers";
        $response = GuzzleHelper::get($request, $api_url);
        $drivers = $response->data;

        return view('setting.users.create',compact('branchs','departemens','roles','drivers'));
    }

    public function datatable(Request $request)
    {
        abort_unless(\Gate::allows('user_access'), 403);
        $api_url = config('api.api_url')."/users";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        return DataTables::of($data)->make(true);
    }
    
    public function store(Request $request)
    {
        abort_unless(\Gate::allows('user_create'), 403);
        $api_url = config('api.api_url')."/users";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function show(Request $request, $id)
    {
        abort_unless(\Gate::allows('user_access'), 403);
        $api_url = config('api.api_url')."/users/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        $user = $response->data;

        $api_url = config('api.api_url')."/branchs";
        $response = GuzzleHelper::get($request, $api_url);
        $branchs = $response->data;

        $api_url = config('api.api_url')."/departemens";
        $response = GuzzleHelper::get($request, $api_url);
        $departemens = $response->data;

        $api_url = config('api.api_url')."/roles";
        $response = GuzzleHelper::get($request, $api_url);
        $roles = $response->data;

        $api_url = config('api.api_url')."/drivers";
        $response = GuzzleHelper::get($request, $api_url);
        $drivers = $response->data;
        return view('setting.users.edit',compact('user','branchs','departemens','roles','drivers'));
    }

    public function update(Request $request)
    {
        abort_unless(\Gate::allows('user_update'), 403);
        $api_url = config('api.api_url')."/users/".$request->id;
        $response = GuzzleHelper::put($request, $api_url);
        return $response;
    }

    public function delete(Request $request)
    {
        abort_unless(\Gate::allows('user_delete'), 403);
        $api_url = config('api.api_url')."/users/".$request->id;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }
}
