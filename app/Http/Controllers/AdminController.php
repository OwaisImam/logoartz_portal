<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AdminController extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    public $data = [];

    function __construct() {
        if (!\Session::has('SuperAdminLogin')) {
            \Redirect::to('admin/login')->send();
            exit();
        }
        
        $this->data['configuration'] = \DB::table('configuration')->first();
        
        $this->data['totalnewvectors'] = \DB::table('vector_order')->where('IsRead',0)->count();
        $this->data['totalnewdigi'] = \DB::table('digitizing_orders')->where('IsRead',0)->count();
        
        $this->data['vectorneworders'] = \DB::table('vector_order')->where('OrderType',0)->where('IsRead',0)->count();
        $this->data['digineworders'] = \DB::table('digitizing_orders')->where('OrderType',0)->where('IsRead',0)->count();
        
        $this->data['vectornewquotes'] = \DB::table('vector_order')->where('OrderType',2)->where('IsRead',0)->count();
        $this->data['diginewquotes'] = \DB::table('digitizing_orders')->where('OrderType',2)->where('IsRead',0)->count();
        
        $this->data['vectororder_rev'] = \DB::table('vector_order')->where('OrderType',1)->where('IsRead',0)->count();
        $this->data['digiorder_rev'] = \DB::table('digitizing_orders')->where('OrderType',1)->where('IsRead',0)->count();
        
        $this->data['vectorquote_rev'] = \DB::table('vector_order')->where('OrderType',4)->where('IsRead',0)->count();
        $this->data['digiquote_rev'] = \DB::table('digitizing_orders')->where('OrderType',4)->where('IsRead',0)->count();
        
        $this->data['new_vector_designer_quote'] = \App\vector_order::where('Status', 2)->where('IsRead',0)->count();
        $this->data['new_digi_designer_quote'] = \App\DigiOrders::where('Status', 2)->where('IsRead',0)->count();
        $this->data['new_vector_done_designer'] = \App\vector_order::where('Status', 6)->where('IsRead',0)->count();
        $this->data['new_digi_done_designer'] = \App\DigiOrders::where('Status', 6)->where('IsRead',0)->count();
        $this->data['new_vector_free_orders'] = \App\vector_order::where('OrderType', 3)->where('IsRead',0)->count();
        $this->data['new_vector_free_rivision'] = \App\vector_order::where('OrderType', 9)->where('IsRead',0)->count();
        $this->data['count_new_vector_free_rivision'] = \App\vector_order::where('OrderType', 9)->count();

    
        $this->data['new_vector_customer_quote'] = \App\vector_order::where('Status', 4)->where('IsRead',0)->count();
        $this->data['new_digi_customer_quote'] = \App\DigiOrders::where('QuotePrice', 2)->where('IsRead',0)->count();
        $this->data['new_vector_done_customer'] = \App\vector_order::where('Status', 8)->where('IsRead',0)->count();
        $this->data['new_digi_done_customer'] = \App\DigiOrders::where('Status', 8)->where('IsRead',0)->count();
        $this->data['new_digi_free_orders'] = \App\DigiOrders::where('OrderType', 3)->where('IsRead',0)->count();
        $this->data['new_digi_free_rivision'] = \App\DigiOrders::where('OrderType', 9)->where('IsRead',0)->count();
        
         $this->data['order_statuses'] = \Config::get('order_statuses');
    }

}
