<?php

namespace App\Http\Controllers\SalesPerson;

use App\Http\Controllers\SalesPersonController;
use Illuminate\Support\Facades\Input;
use App\DigiOrders;
use App\vector_order;
use App\Customers;
use Validator;
use Hash;
use DB;

class Orders extends SalesPersonController {

    function __construct() {
        if (\Session::has('CustomerID')) {
            $data = \DB::table('customers')->where('CustomerID', \Session::get('CustomerID'))->first();
            if ($data->Status == 0) {
                \Redirect::to('/CustomerDash')->send();
                exit();
            }
        }
        parent::__construct();
    }

    public function index() {
        // $this->data['countries_dd'] = $this->countries_dd();
        // $this->data['currencies_dd'] = $this->currencies_dd();
        // $this->data['hear_about_dd'] = \Config::get('hear_about');
        // $this->data['card_types_dd'] = \Config::get('card_types');
        // return view('register', $this->data);
    }

    public function digi_orders($StatusID) {
 
        $CustomerID = 0;
        if(\Request::has('CustomerID') && (int) \Request::get('CustomerID') > 0) {
            $CustomerID = (int) \Request::get('CustomerID');
        }

      
         $SalesPersonID =  \Session::get('SalesPersonID');

         $this->data['DigiOrders'] = '';

         if($StatusID !==  ""){

                $Query = \App\DigiOrders::select('OrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'digitizing_orders.Status', 'OrderType', 'digitizing_orders.IsRead')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                ->where('digitizing_orders.OrderType', $StatusID)
                ->where('customers.SalesPersonID', $SalesPersonID);
                if($CustomerID > 0) {
                    $Query->where('digitizing_orders.CustomerID', $CustomerID);
                }
             $this->data['DigiOrders'] =  $Query->orderby('digitizing_orders.OrderID', 'desc')->get();

         }elseif($StatusID == 'all') {

         $this->data['DigiOrders'] = \App\DigiOrders::select('OrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'digitizing_orders.Status', 'OrderType', 'digitizing_orders.IsRead')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                    ->where('digitizing_orders.SalesPersonID', $SalesPersonID)
                    ->where('digitizing_orders.CustomerID', $CustomerID)
                    ->orderby('digitizing_orders.OrderID', 'desc')
                    ->get();
        }

        //dd($this->data['DigiOrders']);

        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');

        return view('salesperson.digitizing', $this->data);
       

    }

    public function vector_orders($StatusID) {

          $SalesPersonID = \Session::get('SalesPersonID');

          $this->data['VectorOrders'] = \App\vector_order::select('VectorOrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'vector_order.Status', 'OrderType', 'vector_order.IsRead')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                ->where('vector_order.OrderType', $StatusID)
                ->where('customers.SalesPersonID', $SalesPersonID)
                ->orderby('vector_order.VectorOrderID', 'asc')
                ->get();

        if ($StatusID == 'all') {
            $this->data['VectorOrders'] = \App\vector_order::select('VectorOrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'vector_order.Status', 'OrderType', 'vector_order.IsRead')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                    ->where('vector_order.QuotePrice', 0)
                    ->where('customers.SalesPersonID', $SalesPersonID)
                    ->orderby('vector_order.VectorOrderID', 'asc')
                    ->get();
        }
        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');

        return view('salesperson.vectors', $this->data);
    }

    public function digi_order_detail($OrderID) {

              $SalesPersonID = \Session::get('SalesPersonID');   
            $this->data['DigiOrders'] = \App\DigiOrders::select('digitizing_orders.OrderID', 'CustomerName', 'ReqFormat', 'DesignerName', 'CC', 'File1', 'File2', 'File3', 'File4', 'MoreInstructions', 'NoOfColors', 'DesignName', 'PONumber', 'digitizing_orders.Status', 'OrderType', 'digitizing_orders.DesignerID', 'DesignerPrice', 'CustomerPrice', 'MessageForAdmin', 'QuotePrice', 'IsRead', 'Scale', 'Height', 'Width', 'CustomerPrice', 'customers.CsNote')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                ->where('customers.SalesPersonID', $SalesPersonID)
                ->where('digitizing_orders.OrderID', $OrderID)
                ->first();

        $this->data['DesignHistory'] = \DB::table('digi_result')
                ->where('OrderID', $OrderID)
                ->get();

            $revision_history = [];

      $OrderDRID = \DB::table('digi_result')
                ->where('OrderID', $OrderID)->get();

                if(!empty($OrderDRID)) {
                    foreach($OrderDRID as $order_dr) {
                        $ResultFiles = \DB::table('digi_result_files')->where('OrderID', $OrderID)->where('DR_ID', $order_dr->DR_ID)->get();
                        $revision_history[] = [
                                'DesignerMessage' => $order_dr->DesignerMessage,
                                'DateAdded' => $order_dr->DateAdded,
                                'Files' => $ResultFiles,
                        ];
                    }
                }
                  // dd($revision_history); die;

                $this->data['revision_history'] = $revision_history;
                      //  $OrderRevHistory[] = \DB::table('digi_result_files')
                         //       ->where('OrderID', $OrderID)->get();

                                // echo '<pre>'.print_r($revision_hist,ory, 1).'</rpe>'; die;


        
        $this->data['DesignFiles'] = \DB::table('digi_result_files')
                ->where('OrderID', $OrderID)
                ->whereRaw('DR_ID = (SELECT MAX(DR_ID) FROM digi_result_files WHERE OrderID = '.$OrderID.')')
                ->get();
        
        $this->data['RivisionHistory'] = \DB::table('digi_revision')
                ->where('OrderID', $OrderID)
                ->get();

        $this->data['Revision'] = \DB::table('digi_revision')
                ->where('OrderID', $OrderID)
                ->where('From', 3)
                ->where('To', 1)
                ->get();

        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['heading'] = 'Digitizing';

        $this->data['Designers'] = \App\Designers::where('Category', 2)->pluck('DesignerName', 'DesignerID');
//       array_unshift($this->data['Designers'], "Select Designer");

       
        return view('salesperson.digi_detail', $this->data);
    }


    public function vec_order_detail($VectorOrderID) 
    {       
                $SalesPersonID = \Session::get('SalesPersonID');
              $this->data['VectorOrders'] = \App\vector_order::select('vector_order.VectorOrderID', 'CustomerName', 'ReqFormat', 'DesignerName', 'CC', 'File1', 'File2', 'File3', 'File4', 'MoreInstructions', 'NoOfColors', 'DesignName', 'PONumber', 'vector_order.Status', 'OrderType', 'vector_order.DesignerID', 'DesignerPrice', 'CustomerPrice', 'MessageForAdmin', 'QuotePrice', 'IsRead', 'vector_result.VR_ID', 'Scale', 'Height', 'Width', 'ReqColor', 'ReqSeparation', 'CustomerPrice')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                ->leftjoin('vector_result', 'vector_result.VectorOrderID', '=', 'vector_order.VectorOrderID')
                ->where('vector_order.VectorOrderID', $VectorOrderID)
                ->where('customers.SalesPersonID', $SalesPersonID)
                ->orderby('vector_result.VR_ID', 'desc')
                ->first();

        $this->data['DesignHistory'] = \DB::table('vector_result')
                ->where('VectorOrderID', $VectorOrderID)
                ->get();


        $revision_history = [];

      $OrderDRID = \DB::table('vector_result')
                ->where('VectorOrderID', $VectorOrderID)->get();

                if(!empty($OrderDRID)) {
                    foreach($OrderDRID as $order_dr) {
                        $ResultFiles = \DB::table('vector_result_files')->where('VectorOrderID', $VectorOrderID)->where('VR_ID', $order_dr->VR_ID)->get();
                        $revision_history[] = [
                                'DesignerMessage' => $order_dr->DesignerMessage,
                                'DateAdded' => $order_dr->DateAdded,
                                'Files' => $ResultFiles,
                        ];
                    }
                }
                 

                $this->data['revision_history'] = $revision_history;
                     

        $this->data['DesignFiles'] = \DB::table('vector_result_files')
                ->where('VectorOrderID', $VectorOrderID)
                ->whereRaw('VR_ID = (SELECT MAX(VR_ID) FROM vector_result_files WHERE VectorOrderID = '.$VectorOrderID.')')
                ->get();

        $this->data['RivisionHistory'] = \DB::table('vector_revision')
                ->where('VectorOrderID', $VectorOrderID)
                ->get();

        $this->data['Revision'] = \DB::table('vector_revision')
                ->where('VectorOrderID', $VectorOrderID)
                ->where('From', 3)
                ->where('To', 1)
                ->get();


        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['heading'] = 'Vector';


        $this->data['Designers'] = \App\Designers::where('Category', 1)
                ->pluck('DesignerName', 'DesignerID');
//       array_unshift($this->data['Designers'], "Select Designer");
//       print_r($this->data['Designers']);die;

        if ($this->data['VectorOrders']->IsRead == 0) {
            \DB::table('vector_order')->where('VectorOrderID', $VectorOrderID)->update(['IsRead' => 3]);
        }
        return view('salesperson.vectororderdetail', $this->data);




    } 

 
    public function getalldata(){

          $To = Input::get('DateTo');
          $From = Input::get('DateFrom');
          $Cat   = Input::get('Cetagory');
          $SalesID = \Session::get('SalesPersonID');



            $this->data['OrderStatuses'] = Config('order_statuses');
            $this->data['OrderTypes'] = Config('order_types');



        if (!empty($To || $From || $Cat)) {
            if($Cat == 0){

            $this->data['Orders'] = \App\DigiOrders::select('digitizing_orders.OrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'OrderType', 'digitizing_orders.IsRead')
            ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
            ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
             ->where('digitizing_orders.SalesPersonID', $SalesID)
            ->whereRaw('digitizing_orders.DateAdded BETWEEN "'.$From.'" AND "'.$To.'"')
            ->where('digitizing_orders.OrderType', '!=', 2)
            ->orderby('digitizing_orders.OrderID', 'desc')
            ->get();   
            // echo '<pre>'.print_r(DB::getQueryLog(), 1).'</pre>';

           // dd($this->data['Orders']);die;


            return view('salesperson.historysales', $this->data);

            }else if($Cat == 1){
                $this->data['VecOrders'] = \App\vector_order::select('VectorOrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'vector_order.Status', 'OrderType', 'vector_order.IsRead')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                ->whereRaw('vector_order.DateAdded BETWEEN "'.$From.'" AND "'.$To.'"')
                ->where('vector_order.SalesPersonID', $SalesID)
                ->where('vector_order.OrderType', '!=', 2)
                ->orderby('vector_order.VectorOrderID', 'desc')
                ->get();


            //dd($this->data['VecOrders']);die;

                 return view('salesperson.historysales', $this->data);
         }else{
            return redirect('salesperson/summary');
         }

          }else{
            return redirect('salesperson/summary')->with('warning_msg', "Invalid Selecttion");

        }
    
    }

        public function getAllCustomerDigies($customer_id)
        {
            $SalesPersonID = \Session::get('SalesPersonID');
            $customerdata = Customers::where('CustomerID', $customer_id)->first();
            $OrderStatuses = Config('order_statuses');
            $OrderTypes = Config('order_types');
            $CustomerName = $customerdata->CustomerName;


            if($customerdata != ""){
                 # Total Digitizing Orders
             $Orders = DigiOrders::select('digitizing_orders.OrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'OrderType', 'digitizing_orders.Status','digitizing_orders.IsRead')
            ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
            ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
            ->where('digitizing_orders.CustomerID', $customer_id)->where('digitizing_orders.SalesPersonID', $SalesPersonID)->get(); 
             
                $heading = "Digitizing Orders";
                $listStatus = 1;

                return view('salesperson.summary.OrdersByCustomer', compact('Orders', 'OrderStatuses', 'OrderTypes', 'heading', 'listStatus', 'CustomerName'), $this->data);

            }else{

                  return redirect()->back()->with('warning_msg', "Invalid Customer ID");
            }
            
        }

        public function getAllCustomerVector($customer_id)
        {
            $SalesPersonID = \Session::get('SalesPersonID');
            $customerdata = Customers::where('CustomerID', $customer_id)->first();
            $OrderStatuses = Config('order_statuses');
            $OrderTypes = Config('order_types');
            $CustomerName = $customerdata->CustomerName;


            if($customerdata != ""){
                 # Total Digitizing Orders
                $Orders =  vector_order::select('VectorOrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'vector_order.Status', 'OrderType', 'vector_order.IsRead')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                ->where('vector_order.CustomerID', $customer_id)->where('vector_order.SalesPersonID', $SalesPersonID)->get();

                $heading = "Vector Orders";
                $listStatus = 2;
                
                return view('salesperson.summary.OrdersByCustomer', compact('Orders', 'heading', 'listStatus','OrderStatuses', 'OrderTypes', 'CustomerName'), $this->data);

            }else{

                  return redirect()->back()->with('warning_msg', "Invalid Customer ID");
            }
        }

        public function getAllCustomerCurrentDigies($customer_id)
        {
            $SalesPersonID = \Session::get('SalesPersonID');
            $customerdata = Customers::where('CustomerID', $customer_id)->first();
            $OrderStatuses = Config('order_statuses');
            $OrderTypes = Config('order_types');
            $CustomerName = $customerdata->CustomerName;


            if($customerdata != ""){
                 # Total Digitizing Orders
           
                $DigiOrders = DigiOrders::where('CustomerID', $customer_id)->where('SalesPersonID', $SalesPersonID)->where('Status','!=', 7)->get();

            $Orders = DigiOrders::select('digitizing_orders.OrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'OrderType', 'digitizing_orders.IsRead')
            ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
            ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
            ->where('digitizing_orders.CustomerID', $customer_id)->where('digitizing_orders.SalesPersonID', $SalesPersonID)->where('digitizing_orders.Status','!=', 7)->get();

              $heading = "Inprocess Digitizing Orders";
              $listStatus = 1;

                return view('salesperson.summary.OrdersByCustomer', compact('Orders', 'heading', 'listStatus', 'OrderStatuses', 'OrderTypes', 'CustomerName'), $this->data);

            }else{

                  return redirect()->back()->with('warning_msg', "Invalid Customer ID");
            }
        }

        public function getAllCustomerCurrentVectors($customer_id)
        {
            $SalesPersonID = \Session::get('SalesPersonID');
            $customerdata = Customers::where('CustomerID', $customer_id)->first();
            $OrderStatuses = Config('order_statuses');
            $OrderTypes = Config('order_types');
            $CustomerName = $customerdata->CustomerName;

            if($customerdata != ""){
                 # Total Digitizing Orders
        
                  $Orders =  vector_order::select('VectorOrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'vector_order.Status', 'OrderType', 'vector_order.IsRead')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                ->where('vector_order.CustomerID', $customer_id)->where('vector_order.SalesPersonID', $SalesPersonID)->where('vector_order.Status','!=', 7)->get();
            
                $heading = "Inprocess Vector Orders";
                $listStatus = 2;
            
                return view('salesperson.summary.OrdersByCustomer', compact('Orders', 'heading', 'listStatus','OrderStatuses', 'OrderTypes', 'CustomerName'), $this->data);

            }else{

                  return redirect()->back()->with('warning_msg', "Invalid Customer ID");
            }
        }





    public function logout() {    }

}
