<?php

namespace App\Http\Controllers\Approval;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class ApprovalInvoicesController extends Controller
{

    public function index(Request $request)
    {
        abort_unless(\Gate::allows('acc_invoice_access'), 403);
        $api_url = config('api.api_url')."/users";
        $response = GuzzleHelper::get($request, $api_url);
        $users = $response->data;

        return view('approval.invoices.index',compact('users'));
    }

    public function datatable(Request $request)
    {
        abort_unless(\Gate::allows('acc_invoice_access'), 403);
        $api_url = config('api.api_url')."/invoice-approvals";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        return DataTables::of($data)->make(true);
    }

    public function show(Request $request, $id)
    {
        abort_unless(\Gate::allows('acc_invoice_access'), 403);
        $api_url = config('api.api_url')."/invoice-approvals/".$id;
        $response = GuzzleHelper::get($request, $api_url);
        return response()->json($response->data);
    }

    public function store(Request $request)
    {
        abort_unless(\Gate::allows('acc_invoice_create'), 403);
        $api_url = config('api.api_url')."/invoice-approvals";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function update(Request $request)
    {
        abort_unless(\Gate::allows('acc_invoice_update'), 403);
        $api_url = config('api.api_url')."/invoice-approvals/".$request->id;
        $response = GuzzleHelper::put($request, $api_url);
        return $response;
    }

    public function delete(Request $request)
    {
        $api_url = config('api.api_url')."/invoice-approvals/".$request->invoice_number;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }
}
