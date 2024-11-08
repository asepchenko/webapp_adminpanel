<?php

namespace App\Http\Controllers\Report;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class AgentReportController extends Controller
{
    public function index(Request $request)
    {
        return view('report.agent.index');
    }

    public function view(Request $request)
    {
        return view('report.agent.view');
    }
}
