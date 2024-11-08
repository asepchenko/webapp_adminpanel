<?php

namespace App\Http\Controllers\Transaction;

use PDF, DataTables;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(\Gate::allows('order_access'), 403);
        $api_url = config('api.api_url')."/customers";
        $response = GuzzleHelper::get($request, $api_url);
        $customers = $response->data;

        return view('transaction.order.index', compact('customers'));
    }

    public function datatable(Request $request)
    {
        abort_unless(\Gate::allows('order_access'), 403);
        if($request->ajax())
        {
            $first_date = date('Y-m-01');
            $last_date = date('Y-m-t');

            $start = (!empty($request->start_date)) ? ($request->start_date) : $first_date;
            $end = (!empty($request->end_date)) ? ($request->end_date) : $last_date;

            $api_url = config('api.api_url')."/orders/".$start."/".$end;
            $response = GuzzleHelper::get($request, $api_url);
            $data = $response->data;
        }
        //dd($data);
        return DataTables::of($data)->make(true);
    }

    public function list(Request $request)
    {
        $api_url = config('api.api_url')."/orders-list";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        //dd($data);
        return DataTables::of($data)->make(true);
    }

    public function create(Request $request)
    {
        abort_unless(\Gate::allows('order_create'), 403);
        $api_url = config('api.api_url')."/customers";
        $response = GuzzleHelper::get($request, $api_url);
        $customers = $response->data;

        $api_url = config('api.api_url')."/cities";
        $response = GuzzleHelper::get($request, $api_url);
        $cities = $response->data;

        $api_url = config('api.api_url')."/service-groups";
        $response = GuzzleHelper::get($request, $api_url);
        $service_groups = $response->data;

        $api_url = config('api.api_url')."/payment-types";
        $response = GuzzleHelper::get($request, $api_url);
        $payment_types = $response->data;

        return view('transaction.order.create',
            compact('customers','cities','service_groups','payment_types')
        );
    }

    public function detail(Request $request, $no)
    {
        abort_unless(\Gate::allows('order_access'), 403);
        $api_url = config('api.api_url')."/orders/".$no;
        $response = GuzzleHelper::get($request, $api_url);
        $order = $response->data;
        //dd($order);
        $api_url = config('api.api_url')."/cities";
        $response = GuzzleHelper::get($request, $api_url);
        $cities = $response->data;

        $api_url = config('api.api_url')."/service-groups";
        $response = GuzzleHelper::get($request, $api_url);
        $service_groups = $response->data;

        $api_url = config('api.api_url')."/payment-types";
        $response = GuzzleHelper::get($request, $api_url);
        $payment_types = $response->data;

        $api_url = config('api.api_url')."/services";
        $response = GuzzleHelper::get($request, $api_url);
        $services = $response->data;

        $api_url = config('api.api_url')."/truck-types";
        $response = GuzzleHelper::get($request, $api_url);
        $trucks = $response->data;

        return view('transaction.order.detail',
            compact('no','order','cities','service_groups','payment_types','services','trucks')
        );
    }

    public function track(Request $request, $no)
    {
        abort_unless(\Gate::allows('order_tracking'), 403);
        $api_url = config('api.api_url')."/orders/".$no;
        $response = GuzzleHelper::get($request, $api_url);
        $order = $response->data;

        $api_url = config('api.api_url')."/order-trackings/order/".$no;
        $response = GuzzleHelper::get($request, $api_url);
        $track = $response->data;

        $api_url = config('api.api_url')."/order-agents/order/".$no;
        $response = GuzzleHelper::get($request, $api_url);
        $agents = $response->data;

        $api_url = config('api.api_url')."/cities";
        $response = GuzzleHelper::get($request, $api_url);
        $cities = $response->data;
		//dd($agents);
        //return DataTables::of($data)->make(true);
        /*if($response->meta->message == "OK"){
            return DataTables::of($data)->make(true);
        }else{
            return DataTables::of([])->make(true);
        }*/
        return view('transaction.order.track',compact('no','order','track','agents','cities'));
    }
    
    public function store(Request $request)
    {
        abort_unless(\Gate::allows('order_create'), 403);
        $api_url = config('api.api_url')."/orders";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function update(Request $request)
    {
        abort_unless(\Gate::allows('order_update'), 403);
        $api_url = config('api.api_url')."/orders/".$request->id;
        $response = GuzzleHelper::put($request, $api_url);
        return $response;
    }

    public function closing(Request $request)
    {
        abort_unless(\Gate::allows('order_update'), 403);
        $api_url = config('api.api_url')."/orders/closing";
        $response = GuzzleHelper::post($request, $api_url);
        return $response;
    }

    public function printPDF(Request $request, $no)
    {
        $printdate = date('d-m-Y');
        $api_url = config('api.api_url')."/orders/".$no;
        $response = GuzzleHelper::get($request, $api_url);
        $order = $response->data;

        $data = [
            'order' => $order,
            'awb_no' => $order->awb_no,
            'printdate' => date('d-m-Y'),
        ];
        //dd($data);
        //$customPaper = array(0,0,283.00,283.00);
        $pdf = PDF::loadView('transaction.order.pdf', $data)->setPaper('a5', 'landscape');
        //return $pdf->download($order->order_number.'.pdf');
        $output = $pdf->output();

        return new Response($output, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' =>  'inline; filename="'.$order->order_number.'.pdf',
        ]);
    }

    public function printPDFColly(Request $request, $no)
    {
        $printdate = date('d-m-Y');
        $api_url = config('api.api_url')."/orders/".$no;
        $response = GuzzleHelper::get($request, $api_url);
        $order = $response->data;

        $data = [
            'order' => $order,
            'awb_no' => $order->awb_no,
            'printdate' => date('d-m-Y')
        ];
        
        /*
        1 inch = 72 point
        1 inch = 2.54 cm
        10 cm = 10/2.54*72 = 283.464566929
        */
        $customPaper = array(0,0,283.464566929,283.464566929);
        $pdf = PDF::loadView('transaction.order.colly-pdf', $data)->setPaper($customPaper, 'portrait');
        //return $pdf->download($order->order_number.'-label.pdf');
        $output = $pdf->output();

        return new Response($output, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' =>  'inline; filename="'.$order->order_number.'-label.pdf',
        ]);
    }

    public function printPDFListColly(Request $request, $no)
    {
        $printdate = date('d-m-Y');
        $api_url = config('api.api_url')."/orders/".$no;
        $response = GuzzleHelper::get($request, $api_url);
        $order = $response->data;

        $api_url = config('api.api_url')."/order-units/order/".$no;
        $response = GuzzleHelper::get($request, $api_url);
        //return DataTables::of($data)->make(true);
        if($response->meta->message == "OK"){
            $colly = $response->data;
        }else{
            $colly = [];
        }

        $data = [
            'order' => $order,
            'colly' => $colly,
            'awb_no' => $order->awb_no,
            'printdate' => date('d-m-Y H:i:s')
        ];
        
        $pdf = PDF::loadView('transaction.order.colly-list-pdf', $data)->setPaper('A5', 'portrait');
        //return $pdf->download($order->order_number.'-label.pdf');
        $output = $pdf->output();

        return new Response($output, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' =>  'inline; filename="'.$order->order_number.'-label.pdf',
        ]);
    }

    public function delete(Request $request)
    {
        abort_unless(\Gate::allows('order_delete'), 403);
        $api_url = config('api.api_url')."/orders/".$request->id;
        $response = GuzzleHelper::del($request, $api_url);
        return $response;
    }
}
