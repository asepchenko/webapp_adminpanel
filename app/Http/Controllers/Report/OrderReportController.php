<?php

namespace App\Http\Controllers\Report;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class OrderReportController extends Controller
{
    public function index(Request $request)
    {
        return view('report.order.index');
    }

    public function view(Request $request)
    {
        return view('report.order.view');
    }
}
