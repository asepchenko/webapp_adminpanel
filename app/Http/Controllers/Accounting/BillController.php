<?php

namespace App\Http\Controllers\Accounting;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class BillController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(\Gate::allows('acc_bill_access'), 403);
        $api_url = config('api.api_url')."/agents";
        $response = GuzzleHelper::get($request, $api_url);
        $agents = $response->data;
        
        return view('accounting.bill.index',compact('agents'));
    }

    public function datatable(Request $request)
    {
        abort_unless(\Gate::allows('acc_bill_access'), 403);
        $api_url = config('api.api_url')."/bills";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        //dd($data);
        return DataTables::of($data)->make(true);
    }

    public function create(Request $request)
    {
        abort_unless(\Gate::allows('acc_bill_create'), 403);
        return view('accounting.bill.create');
    }

    public function store(Request $request)
    {
        abort_unless(\Gate::allows('acc_bill_create'), 403);
        $api_url = config('api.api_url')."/bills/store-by-admin";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function update(Request $request)
    {
        abort_unless(\Gate::allows('acc_bill_update'), 403);
        $api_url = config('api.api_url')."/bills/".$request->id;
        $response = GuzzleHelper::put($request, $api_url);
        return $response;
    }

    public function listStt(Request $request, $agent_id)
    {
        $api_url = config('api.api_url')."/bills-order-list/".$agent_id;
        $response = GuzzleHelper::get($request, $api_url);
        return response()->json($response->data);
    }

    public function detail(Request $request, $no)
    {
        abort_unless(\Gate::allows('acc_bill_update'), 403);
        $api_url = config('api.api_url')."/bills/".$no;
        $response = GuzzleHelper::get($request, $api_url);
        $invoice = $response->data;

        return view('accounting.bill.detail',compact('invoice','no'));
    }

    public function pay(Request $request)
    {
        abort_unless(\Gate::allows('acc_bill_closing'), 403);
        $api_url = config('api.api_url')."/bills/pay";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function closing(Request $request)
    {
        abort_unless(\Gate::allows('acc_bill_closing'), 403);
        $api_url = config('api.api_url')."/bills/closing";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function addDetail(Request $request)
    {
        $api_url = config('api.api_url')."/bill-details";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function deleteDetail(Request $request)
    {
        $api_url = config('api.api_url')."/bill-details/".$request->id;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }
}
