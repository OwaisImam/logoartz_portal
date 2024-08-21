<?php

namespace App\Http\Controllers\SalesPerson;

use App\Http\Controllers\SalesPersonController;
use App\DigiOrders;
use App\vector_order;

class Dashboard extends SalesPersonController {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        
        $this->data['sales_cat'] =  \Session::get('SalesCategory');
        $sales_id = \Session::get('SalesPersonID');



        if($sales_id > 0){

            //*/-------------------DIGITIZING COUNT----------------/*//
            // NEW ORDER
            $this->data['count_digi_new_orders'] = DigiOrders::where('OrderType', 0)->where('SalesPersonID', $sales_id)->count();
            // FREE OERDERS
            $this->data['count_digi_free_orders'] = DigiOrders::where('OrderType', 3)->where('SalesPersonID', $sales_id)->count();       
            // Free ORDER REVISION
            $this->data['count_digi_free_orders_rev'] = DigiOrders::where('OrderType', 9)->where('SalesPersonID', $sales_id)->count();  
            // ORDER REVISION    
            $this->data['count_digi_orders_rev'] = DigiOrders::where('OrderType', 1)->where('SalesPersonID', $sales_id)->count();      
            //New Quote 
            $this->data['count_digi_new_quote'] = DigiOrders::where('OrderType', 2)->where('SalesPersonID', $sales_id)->count();       
            //New Quote Revision
            $this->data['count_digi_quote_rev'] = DigiOrders::where('OrderType', 4)->where('SalesPersonID', $sales_id)->count();       

             //*/-------------------VECTOR COUNT----------------/*//

              // NEW ORDER
            $this->data['count_vector_new_orders'] = vector_order::where('OrderType', 0)->where('SalesPersonID', $sales_id)->count();
            // FREE OERDERS
            $this->data['count_vector_free_orders'] = vector_order::where('OrderType', 3)->where('SalesPersonID', $sales_id)->count();       
            // Free ORDER REVISION
            $this->data['count_vector_free_orders_rev'] = vector_order::where('OrderType', 9)->where('SalesPersonID', $sales_id)->count();  
            // ORDER REVISION    
            $this->data['count_vector_orders_rev'] = vector_order::where('OrderType', 1)->where('SalesPersonID', $sales_id)->count();      
            //New Quote 
            $this->data['count_vector_new_quote'] = vector_order::where('OrderType', 2)->where('SalesPersonID', $sales_id)->count();       
            //New Quote Revision
            $this->data['count_vector_quote_rev'] = vector_order::where('OrderType', 4)->where('SalesPersonID', $sales_id)->count();       

        }else{
            return redirect('salesperson/logout');
        }

     

        return view('salesperson.dashboard', $this->data);
    }

    public function logout() {
        \Session::forget("SalesPersonLogin");
        \Session::forget('SalesPersonID');
        \Session::forget('SalesPersonName');
        \Session::forget('SalesPersonEmail');
        \Session::forget('SalesCategory');
        \Session::forget('SalesPerosnCell');
        \Session::forget('SalesPersonPicture');
         return view('salesperson.login');
    }

}
