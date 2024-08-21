<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\AdminController;

class Dashboard extends AdminController {

    function __construct() {
        parent::__construct();
    }

    public function index() {

    $this->data['count_digi_new_orders'] = \App\DigiOrders::where('OrderType', 0)->where('Status', '!=', 7)->where('QuotePrice', 0)->count();
        $this->data['count_digi_order_revision'] = \App\DigiOrders::where('OrderType', 1)->where('Status', '!=', 7)->count();
        $this->data['count_digi_new_quote'] = \App\DigiOrders::where('OrderType', 2)->where('Status', '!=', 7)->count();
        $this->data['count_digi_free_orders'] = \App\DigiOrders::where('OrderType', 3)->where('Status', '!=', 7)->count();
        $this->data['count_new_digi_free_rivision'] = \App\DigiOrders::where('OrderType', 9)->where('Status', '!=', 7)->count();
        $this->data['count_digi_quote_revisions'] = \App\DigiOrders::where('OrderType', 4)->where('Status', '!=', 7)->count();
        $this->data['count_digi_extra_time'] = \App\DigiOrders::where('OrderType', 5)->where('Status', '!=', 7)->count();
        $this->data['count_digi_pending'] = \App\DigiOrders::where('OrderType', 6)->where('Status', '!=', 7)->count();
        $this->data['count_digi_hold'] = \App\DigiOrders::where('OrderType', 7)->where('Status', '!=', 7)->count();
        
        $this->data['count_digi_designer_quote'] = \App\DigiOrders::where('Status', 2)->where('Status', '!=', 7)->count();
        $this->data['count_digi_customer_quote'] = \App\DigiOrders::where('QuotePrice', 2)->where('Status', '!=', 7)->count();
        
        $this->data['count_vector_new_orders'] = \App\vector_order::where('OrderType', 0)->where('Status', '!=', 7)->where('QuotePrice', 0)->count();
        $this->data['count_vector_order_revision'] = \App\vector_order::where('OrderType', 1)->where('Status', '!=', 7)->count();
        $this->data['count_vector_new_quote'] = \App\vector_order::where('OrderType', 2)->where('Status', '!=', 7)->count();
        $this->data['count_vector_free_orders'] = \App\vector_order::where('OrderType', 3)->where('Status', '!=', 7)->count();
        $this->data['count_vector_quote_revisions'] = \App\vector_order::where('OrderType', 4)->where('Status', '!=', 7)->count();
        $this->data['count_vector_extra_time'] = \App\vector_order::where('OrderType', 5)->where('Status', '!=', 7)->count();
        $this->data['count_vector_pending'] = \App\vector_order::where('OrderType', 6)->where('Status', '!=', 7)->count();
        $this->data['count_vector_hold'] = \App\vector_order::where('OrderType', 7)->where('Status', '!=', 7)->count();
        
        $this->data['count_vector_designer_quote'] = \App\vector_order::where('Status', 2)->where('Status', '!=', 7)->count();
        $this->data['count_vector_customer_quote'] = \App\vector_order::where('Status', 4)->where('Status', '!=', 7)->count();
        $this->data['count_vector_done_designer'] = \App\vector_order::where('Status', 6)->where('Status', '!=', 7)->count();
        $this->data['count_digi_done_designer'] = \App\DigiOrders::where('Status', 6)->where('Status', '!=', 7)->count();

        $this->data['count_vector_done_customer'] = \App\vector_order::where('Status', 8)->where('Status', '!=', 7)->count();
        $this->data['count_digi_done_customer'] = \App\DigiOrders::where('Status', 8)->where('Status', '!=', 7)->count();


        return view('admin.dashboard', $this->data);
    }

    public function logout() {
        \Session::forget("SuperAdminLogin");
        \Session::forget('AdminID');
        \Session::forget('AdminFirstName');
        \Session::forget('AdminLastName');
        \Session::forget('AdminEmail');
        \Session::forget('AdminContact');
        \Session::forget('AdminProfilePicture');
        \Session::forget('AdminFullName');
        return view('admin.login');
    }

}
