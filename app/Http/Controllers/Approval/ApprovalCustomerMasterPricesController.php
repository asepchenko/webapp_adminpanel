<?php

namespace App\Http\Controllers\Approval;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class ApprovalCustomerMasterPricesController extends Controller
{

    public function index(Request $request)
    {
        abort_unless(\Gate::allows('approval_reguler_price_access'), 403);
        return view('approval.customer-master-prices.index');
    }

    public function datatable(Request $request)
    {
        abort_unless(\Gate::allows('approval_reguler_price_access'), 403);
        $api_url = config('api.api_url')."/customer-master-prices/pending";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        return DataTables::of($data)->make(true);
    }

    public function approve(Request $request)
    {
        abort_unless(\Gate::allows('approval_reguler_price_access'), 403);
        $api_url = config('api.api_url')."/customer-master-prices/approve";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function massApprove(Request $request)
    {
        abort_unless(\Gate::allows('approval_reguler_price_access'), 403);
        $api_url = config('api.api_url')."/customer-master-prices/mass-approve";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }
}
