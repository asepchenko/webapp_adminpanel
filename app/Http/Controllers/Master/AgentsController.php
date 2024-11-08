<?php

namespace App\Http\Controllers\Master;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class AgentsController extends Controller
{

    public function index(Request $request)
    {
        abort_unless(\Gate::allows('master_agent_access'), 403);
        $api_url = config('api.api_url')."/agents";
        $response = GuzzleHelper::get($request, $api_url);
        if($response->meta->code == 403){
            abort(403);
        }
        return view('master.agents.index');
    }

    public function indexByCityID(Request $request, $id)
    {
        $api_url = config('api.api_url')."/agents/city/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        
        if($response->meta->message == "OK"){
            return response()->json($response->data);
        }else{
            return response()->json("");
        }
    }

    public function indexByCityAddressID(Request $request, $id)
    {
        $api_url = config('api.api_url')."/agents/city/".$id."/address";
        $response = GuzzleHelper::get($request, $api_url);
        
        if($response->meta->message == "OK"){
            return response()->json($response->data);
        }else{
            return response()->json("");
        }
    }

    public function create(Request $request)
    {
        abort_unless(\Gate::allows('master_agent_create'), 403);
        $api_url = config('api.api_url')."/areas";
        $response = GuzzleHelper::get($request, $api_url);
        $areas = $response->data;
		
		$api_url = config('api.api_url')."/cities";
        $response = GuzzleHelper::get($request, $api_url);
        $cities = $response->data;
		
        return view('master.agents.create',compact('areas','cities'));
    }

    public function datatable(Request $request)
    {
        abort_unless(\Gate::allows('master_agent_access'), 403);
        $api_url = config('api.api_url')."/agents";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        return DataTables::of($data)->make(true);
    }

    public function store(Request $request)
    {
        abort_unless(\Gate::allows('master_agent_create'), 403);
        $api_url = config('api.api_url')."/agents";
        $response = GuzzleHelper::postCreateAgent($request, $api_url);
        return $response;
    }

    public function show(Request $request, $id)
    {
        abort_unless(\Gate::allows('master_agent_access'), 403);
        $api_url = config('api.api_url')."/agents/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        $agents = $response->data;
        
        $api_url = config('api.api_url')."/areas";
        $response = GuzzleHelper::get($request, $api_url);
        $areas = $response->data;

        $api_url = config('api.api_url')."/cities";
        $response = GuzzleHelper::get($request, $api_url);
        $cities = $response->data;

        $api_url = config('api.api_url')."/locations";
        $response = GuzzleHelper::get($request, $api_url);
        $locations = $response->data;

        $api_url = config('api.api_url')."/services";
        $response = GuzzleHelper::get($request, $api_url);
        $services = $response->data;
        return view('master.agents.edit',compact('agents','id','areas','cities','locations','services'));
    }

    public function update(Request $request)
    {
        abort_unless(\Gate::allows('master_agent_update'), 403);
        $api_url = config('api.api_url')."/agents/".$request->id;
        $response = GuzzleHelper::postUpdateAgent($request, $api_url);
        return $response;
    }

    public function delete(Request $request)
    {
        abort_unless(\Gate::allows('master_agent_delete'), 403);
        $api_url = config('api.api_url')."/agents/".$request->id;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }
    
}
