<?php

namespace App\Http\Controllers\Accounting;

use DataTables;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class CashReceiptController extends Controller
{
    public function index(Request $request)
    {
        return view('accounting.cash-receipt.index');
    }

    public function detail($no)
    {
        return view('accounting.cash-receipt.detail');
    }
}
