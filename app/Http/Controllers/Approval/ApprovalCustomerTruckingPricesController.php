<?php

namespace App\Http\Controllers\Approval;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class ApprovalCustomerTruckingPricesController extends Controller
{

    public function index(Request $request)
    {
        abort_unless(\Gate::allows('approval_trucking_price_access'), 403);
        return view('approval.customer-trucking-prices.index');
    }

    public function datatable(Request $request)
    {
        abort_unless(\Gate::allows('approval_trucking_price_access'), 403);
        $api_url = config('api.api_url')."/customer-trucking-prices/pending";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        return DataTables::of($data)->make(true);
    }

    public function approve(Request $request)
    {
        abort_unless(\Gate::allows('approval_trucking_price_access'), 403);
        $api_url = config('api.api_url')."/customer-trucking-prices/approve";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function massApprove(Request $request)
    {
        abort_unless(\Gate::allows('approval_trucking_price_access'), 403);
        $api_url = config('api.api_url')."/customer-trucking-prices/mass-approve";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }
}
