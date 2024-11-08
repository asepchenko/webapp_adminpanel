<?php

namespace App\Http\Controllers\Accounting;

use PDF, DataTables;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(\Gate::allows('acc_invoice_access'), 403);
        return view('accounting.invoice.index');
    }

    public function datatable(Request $request)
    {
        abort_unless(\Gate::allows('acc_invoice_access'), 403);
        $api_url = config('api.api_url')."/invoices";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        //dd($data);
        return DataTables::of($data)->make(true);
    }

    public function create(Request $request)
    {
        abort_unless(\Gate::allows('acc_invoice_create'), 403);
        return view('accounting.invoice.create');
    }

    public function listStt(Request $request, $customer_id)
    {
        $api_url = config('api.api_url')."/invoices-order-list/".$customer_id;
        $response = GuzzleHelper::get($request, $api_url);
        return response()->json($response->data);
    }

    public function orderList(Request $request)
    {
        $api_url = config('api.api_url')."/invoices-order-list";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        //dd($data);
        return DataTables::of($data)->make(true);
    }

    public function edit(Request $request, $no)
    {
        abort_unless(\Gate::allows('acc_invoice_update'), 403);
        $api_url = config('api.api_url')."/invoices/".$no;
        $response = GuzzleHelper::get($request, $api_url);
        $invoice = $response->data;
        //dd($invoice);
        return view('accounting.invoice.edit',compact('invoice','no'));
    }

    public function store(Request $request)
    {
        abort_unless(\Gate::allows('acc_invoice_create'), 403);
        $api_url = config('api.api_url')."/invoices";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function update(Request $request)
    {
        abort_unless(\Gate::allows('acc_invoice_update'), 403);
        $api_url = config('api.api_url')."/invoices/".$request->id;
        $response = GuzzleHelper::put($request, $api_url);
        return $response;
    }

    public function closing(Request $request)
    {
        abort_unless(\Gate::allows('acc_invoice_closing'), 403);
        $api_url = config('api.api_url')."/invoices/closing";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function verify(Request $request)
    {
        $api_url = config('api.api_url')."/invoices/verify";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function accept(Request $request)
    {
        $api_url = config('api.api_url')."/invoices/accept";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function pay(Request $request)
    {
        $api_url = config('api.api_url')."/invoices/pay";
        $response = GuzzleHelper::postInvoicePay($request, $api_url);
        return $response;
    }

    public function delete(Request $request)
    {
        $api_url = config('api.api_url')."/invoices/".$request->invoice_number;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }

    public function printPDF(Request $request, $no)
    {
        $printdate = date('d-m-Y');
        /*$api_url = config('api.api_url')."/invoices/".$no;
        $response = GuzzleHelper::get($request, $api_url);
        $invoice = $response->data;

        $data = [
            'invoice' => $invoice,
            'printdate' => date('d-m-Y')
        ];
        //dd($data);
        $pdf = PDF::loadView('accounting.invoice.pdf', $data)->setPaper('a4', 'landscape');
        $output = $pdf->output();

        return new Response($output, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' =>  'inline; filename="'.$invoice->invoice_number.'.pdf',
        ]);*/

        $api_url = config('api.api_url')."/invoices/".$no;
        $response = GuzzleHelper::get($request, $api_url);
        $invoice = $response->data;
        //dd($invoice);
        if($invoice->service_group_id == 3){
            return view('accounting.invoice.pdf-trucking',compact('invoice','no','printdate'));
        }else{
            return view('accounting.invoice.pdf',compact('invoice','no','printdate'));
        }
    }

    public function addDetail(Request $request)
    {
        $api_url = config('api.api_url')."/invoice-details";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function deleteDetail(Request $request)
    {
        $api_url = config('api.api_url')."/invoice-details/".$request->id;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }
}
