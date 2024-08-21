<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\DesignerController;

class Dashboard extends DesignerController {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        
        $this->data['count_digi_new_orders'] = \App\DigiOrders::whereIn('OrderType', [0, 3])->where('DesignerID', \Session::get('DesignerID'))->count();

        $this->data['count_digi_orders_rev'] = \App\DigiOrders::whereIn('OrderType', [1, 9])->where('DesignerID', \Session::get('DesignerID'))->count();


        $this->data['count_digi_new_quote'] = \App\DigiOrders::where('OrderType', 2)->where('DesignerID', \Session::get('DesignerID'))->count();

           $this->data['count_digi_quote_rev'] = \App\DigiOrders::where('OrderType', 4)->where('DesignerID', \Session::get('DesignerID'))->count();





        $this->data['count_vector_new_orders'] = \App\vector_order::whereIn('OrderType', [0, 3])->where('DesignerID', \Session::get('DesignerID'))->count();

        $this->data['count_vector_orders_rev'] = \App\vector_order::whereIn('OrderType', [1, 9])->where('DesignerID', \Session::get('DesignerID'))->count();

        $this->data['count_vector_new_quote'] = \App\vector_order::where('OrderType', 2)->where('DesignerID', \Session::get('DesignerID'))->count();

         $this->data['count_vector_quote_rev'] = \App\vector_order::where('OrderType', 4)->where('DesignerID', \Session::get('DesignerID'))->count();


        return view('designer.dashboard', $this->data);
    }

    public function logout() {
        \Session::forget("DesignerLogin");
        \Session::forget('DesignerID');
        \Session::forget('DesignerName');
        \Session::forget('DesignerEmail');
        \Session::forget('DesignerCell');
        \Session::forget('DesignerPicture');
         return view('designer.login');
    }

}
