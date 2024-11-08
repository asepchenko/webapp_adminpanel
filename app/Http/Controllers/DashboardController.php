<?php

namespace App\Http\Controllers;

use DataTables, DateTime, DateInterval, DatePeriod;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\GuzzleHelper;

use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $api_url = config('api.api_url')."/dashboard";
        $response = GuzzleHelper::get($request, $api_url);
        if($response->meta->code == 403){
            abort(403);
        }

        $total_order = $response->data->total_order;
        $total_new_customer = $response->data->total_new_customer;
        $total_order_on_delivery = $response->data->total_order_on_delivery;
        $total_order_delivered = $response->data->total_order_delivered;
        $order_monthly = $response->data->order_monthly;
        $new_customers = $response->data->new_customers;
        $new_orders = $response->data->new_orders;
        $order_realtime = $response->data->order_realtime;

        //chart
        if ($order_monthly == NULL) {
            $order_monthly = [];
            $charts = [];
        }else{
            $arr = [];
            foreach($order_monthly as $row)
            {
                $arr[] = (array) $row;
            }

            $begin = new DateTime( date('Y-m-01') ); //or given date
            $end = new DateTime( date('Y-m-t') );
            $end = $end->modify( '+1 day' ); 
            $interval = new DateInterval('P1D');
            $dateRange = new DatePeriod($begin, $interval ,$end);

            $charts =[];

            foreach($dateRange as $date){
                $dataKey = array_search($date->format("Y-m-d"), array_column($arr, 'date'));
                if ($dataKey !== false) { // if we have the data in given date
                    $charts[$date->format("d")] = $arr[$dataKey]['total'];
                }else {
                    //if there is no record, create default values
                    $charts[$date->format("d")] = 0;
                }
            }
        }

        return view('dashboard', compact
            (
                'total_order',
                'total_new_customer',
                'total_order_on_delivery',
                'total_order_delivered',
                'charts',
                'new_customers',
                'new_orders',
                'order_realtime'
            )
        );
    }

    /*public function datatable(Request $request)
    {
        $api_url = config('api.api_url')."/posts";
        $response = GuzzleHelper::get($request, $api_url);
        $data = $response->data;
        return DataTables::of($data)->make(true);
    }*/
}
