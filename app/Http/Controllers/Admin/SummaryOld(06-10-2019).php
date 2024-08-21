<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Input;
use admin\summary\history\historyindi;
use Validator;
use DB;
use PDF;

class Summary extends AdminController {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        //   $this->data['DigiOrders'] = \App\Customers::all();

        $this->data['OrderTypes'] = \App\Customers::all();
        $this->data['Orders'] = '';
        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');


        return view('admin.summary.history.historyindi', $this->data);
    }

 public function client_sum(){
        
        $this->data['OrderTypes'] = \App\Customers::all();
        $this->data['Orders'] = '';
        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');
        $this->data['allcustomers'] = \DB::table('customers')->get();

     
        return view('admin.summary.customers.index', $this->data);
}

public function sales_sum(){

        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');
        $this->data['Sales_Rep'] = \App\SalesPerson::select('SalesPersonID', 'SalesPersonName')->get();
        $this->data['allcustomers'] = \DB::table('customers')->get();

        return view('admin.summary.sales.index', $this->data);
}



public function cus_search_records() {

        // dd(Input::all());
        $Type = 0;

        $To = Input::get('DateTo');
        $From = Input::get('DateFrom');
        $Cat = Input::get('Cetagory');
        $CustomerID = Input::get('cusname');
        $Type = Input::get('type');

        if($Type == 5){
            $Type = 0;
        }elseif ($Type == 1) {
            $Type = 1;
        }elseif ($Type == 2) {
            $Type = 2;
        }elseif ($Type == 4) {
            $Type = 4;
        }elseif ($Type == 3) {
            $Type = 3;
        }else{
            $Type = "";
        }



        $this->data['OrderTypes'] = \App\Customers::all();
        $this->data['Orders'] = '';
        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');
        $this->data['allcustomers'] = \DB::table('customers')->get();

        if ($To != "" && $From != "") {

            if ($Cat == 1) {
                // echo "Its Digi"; die;


                $this->data['Cat'] = 1;
                            $Qurey = \App\DigiOrders::select('digitizing_orders.OrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'OrderType', 'digitizing_orders.IsRead')
                            ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                            ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                            ->where('digitizing_orders.OrderType', '!=', 2)
                            ->where('digitizing_orders.OrderType', '!=', 4)
                            ->whereBetween(DB::Raw('date(digitizing_orders.DateAdded)'), array($From, $To));
                            if($CustomerID > 0){
                                $Qurey->where('digitizing_orders.CustomerID', $CustomerID);
                            }if($Type !== ""){
                            $Qurey->where('digitizing_orders.OrderType', $Type);
                        }


                $this->data['d_Orders'] = $Qurey->orderby('digitizing_orders.OrderID', 'desc')->get();


                return view('admin.summary.customers.index', $this->data);
            } else if ($Cat == 2) {
                // echo "Its Vector"; die;


                   $this->data['Cat'] = 2;
                            $Qurey = \App\vector_order::select('vector_order.VectorOrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'OrderType', 'vector_order.IsRead')
                            ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                            ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                            ->where('vector_order.OrderType', '!=', 2)
                            ->where('vector_order.OrderType', '!=', 4)
                            ->whereBetween(DB::Raw('date(vector_order.DateAdded)'), array($From, $To));
                            if($CustomerID > 0){
                                $Qurey->where('vector_order.CustomerID', $CustomerID);
                            }if($Type !== ""){
                            $Qurey->where('vector_order.OrderType', $Type);
                        }

                    $this->data['v_Orders'] = $Qurey->orderby('vector_order.VectorOrderID', 'desc')->get();
                  return view('admin.summary.customers.index', $this->data);
            } elseif($Cat == ""){

                // echo "Its Null"; die;

            // Digitizing Orders Patch
                    $d_Qurey = \App\DigiOrders::select('digitizing_orders.OrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'OrderType', 'digitizing_orders.IsRead')
                            ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                            ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                            ->where('digitizing_orders.OrderType', '!=', 2)
                            ->where('digitizing_orders.OrderType', '!=', 4)
                            ->whereBetween(DB::Raw('date(digitizing_orders.DateAdded)'), array($From, $To));
                            if($CustomerID > 0){
                                $d_Qurey->where('digitizing_orders.CustomerID', $CustomerID);
                            }if($Type !== ""){
                            $d_Qurey->where('digitizing_orders.OrderType', $Type);
                        }

             // Vector Orders Patch

                      $v_Qurey = \App\vector_order::select('vector_order.VectorOrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'OrderType', 'vector_order.IsRead')
                            ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                            ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                            ->where('vector_order.OrderType', '!=', 2)
                            ->where('vector_order.OrderType', '!=', 4)
                            ->whereBetween(DB::Raw('date(vector_order.DateAdded)'), array($From, $To));
                            if($CustomerID > 0){
                                $v_Qurey->where('vector_order.CustomerID', $CustomerID);
                            }if($Type !== ""){
                            $v_Qurey->where('vector_order.OrderType', $Type);
                        }

                 $this->data['d_Orders'] = $d_Qurey->orderby('digitizing_orders.OrderID', 'desc')->get();
                 $this->data['v_Orders'] = $v_Qurey->orderby('vector_order.VectorOrderID', 'desc')->get();
            
               return view('admin.summary.customers.index', $this->data);

            } else {
                return redirect('admin/summary/customers')->with('warning_msg', "Invalid Selecttion Under");
            }
        } else {
            return redirect('admin/summary/customers')->with('warning_msg', "Invalid Selecttion");
        }
 }





public function sales_spec_records()
{

        //dd(Input::all());
        $Type = 0;

        $To = Input::get('DateTo');
        $From = Input::get('DateFrom');
        $Cat = Input::get('Cetagory');
        $SalesPerson = Input::get('salesname');
        $CustomerID = Input::get('cusname');
        $Type = Input::get('type');
        //$Current_Status = Input::get('status');


        if($Type == 5){
            $Type = 0;
        }elseif ($Type == 1) {
            $Type = 1;
        }elseif ($Type == 2) {
            $Type = 2;
        }elseif ($Type == 4) {
            $Type = 4;
        }elseif ($Type == 3) {
            $Type = 3;
        }else{
            $Type = "";
        }


        // if($Current_Status == 0){
        //     $Current_Status = 0;
        // }elseif ($Current_Status == 1) {
        //     $Current_Status = 1;
        // }elseif ($Current_Status == 2) {
        //     $Current_Status = 2;
        // }elseif ($Current_Status == 4) {
        //     $Current_Status = 4;
        // }elseif ($Current_Status == 3) {
        //     $Current_Status = 3;
        // }elseif($Current_Status == ""){
        //     $Current_Status = "";
        // }

        $this->data['OrderTypes'] = \App\Customers::all();
        $this->data['Orders'] = '';
        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');
        $this->data['allcustomers'] = \DB::table('customers')->get();
        $this->data['Sales_Rep'] = \App\SalesPerson::select('SalesPersonID', 'SalesPersonName')->get();

        if ($To != "" && $From != "") {
            if ($Cat == 1) {
               // echo "Its Digi"; die;
                $this->data['Cat'] = 1;

                $d_Qurey = \App\DigiOrders::select('digitizing_orders.OrderID', 'CustomerName', 'DesignerName', 'SalesPersonName', 'DesignName', 'PONumber', 'OrderType', 'digitizing_orders.Status','digitizing_orders.IsRead')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                    ->leftjoin('salesperson', 'salesperson.SalesPersonID', '=', 'digitizing_orders.SalesPersonID')
                    ->where('digitizing_orders.SalesPersonID', $SalesPerson)
                    ->whereBetween(DB::Raw('date(digitizing_orders.DateAdded)'), array($From, $To));
                    if($CustomerID > 0){
                        $d_Qurey->where('digitizing_orders.CustomerID', $CustomerID);
                    }if($Type !== ""){
                        $d_Qurey->where('digitizing_orders.OrderType', $Type);
                    }

                    $this->data['d_Orders'] = $d_Qurey->orderby('digitizing_orders.OrderID', 'desc')->get();

                return view('admin.summary.sales.index', $this->data);
            } else if ($Cat == 2) {
               // echo "Its Vector"; die;

                $this->data['Cat'] = 2;

       
                $v_Qurey = \App\vector_order::select('vector_order.VectorOrderID', 'CustomerName', 'DesignerName', 'SalesPersonName', 'DesignName', 'PONumber', 'OrderType', 'vector_order.Status','vector_order.IsRead')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                    ->leftjoin('salesperson', 'salesperson.SalesPersonID', '=', 'vector_order.SalesPersonID')
                    ->where('vector_order.SalesPersonID', $SalesPerson)
                    ->whereBetween(DB::Raw('date(vector_order.DateAdded)'), array($From, $To));
                    if($CustomerID > 0){
                        $v_Qurey->where('vector_order.CustomerID', $CustomerID);
                    }if($Type !== ""){
                        $v_Qurey->where('vector_order.OrderType', $Type);
                    }


                  $this->data['v_Orders'] = $v_Qurey->orderby('vector_order.VectorOrderID', 'desc')->get();

                return view('admin.summary.sales.index', $this->data);
            } elseif($Cat == ""){
                //echo "Its Null"; die;

                    $d_Qurey = \App\DigiOrders::select('digitizing_orders.OrderID', 'CustomerName', 'DesignerName', 'SalesPersonName', 'DesignName', 'PONumber', 'OrderType', 'digitizing_orders.Status','digitizing_orders.IsRead')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                    ->leftjoin('salesperson', 'salesperson.SalesPersonID', '=', 'digitizing_orders.SalesPersonID')
                    ->where('digitizing_orders.SalesPersonID', $SalesPerson)
                    ->whereBetween(DB::Raw('date(digitizing_orders.DateAdded)'), array($From, $To));
                    if($CustomerID > 0){
                        $d_Qurey->where('digitizing_orders.CustomerID', $CustomerID);
                    }if($Type !== ""){
                        $d_Qurey->where('digitizing_orders.OrderType', $Type);
                    }

                    
                    $v_Qurey = \App\vector_order::select('vector_order.VectorOrderID', 'CustomerName', 'DesignerName', 'SalesPersonName', 'DesignName', 'PONumber', 'OrderType', 'vector_order.Status','vector_order.IsRead')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                    ->leftjoin('salesperson', 'salesperson.SalesPersonID', '=', 'vector_order.SalesPersonID')
                    ->where('vector_order.SalesPersonID', $SalesPerson)
                    ->whereBetween(DB::Raw('date(vector_order.DateAdded)'), array($From, $To));
                    if($CustomerID > 0){
                        $v_Qurey->where('vector_order.CustomerID', $CustomerID);
                    }if($Type !== ""){
                        $v_Qurey->where('vector_order.OrderType', $Type);
                    }

                  $this->data['d_Orders'] = $d_Qurey->orderby('digitizing_orders.OrderID', 'desc')->get();
                  $this->data['v_Orders'] = $v_Qurey->orderby('vector_order.VectorOrderID', 'desc')->get();


                  return view('admin.summary.sales.index', $this->data);

            } else {
                return redirect('admin/summary');
            }
        } else {
            return redirect('admin/summary')->with('warning_msg', "Invalid Selecttion");
        }
}



public function artist_sum_rec()
{
        $Type = 0;

        $To = Input::get('DateTo');
        $From = Input::get('DateFrom');
        $Cat = Input::get('Cetagory');
        $DesignerID = Input::get('designer');
        $Type = Input::get('type');

        $D_Cat = \App\Designers::first();


      
       if($Type == 5){
            $Type = 0;
        }elseif ($Type == 1) {
            $Type = 1;
        }elseif ($Type == 2) {
            $Type = 2;
        }elseif ($Type == 4) {
            $Type = 4;
        }elseif ($Type == 3) {
            $Type = 3;
        }else{
            $Type = "";
        }



        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');
        $this->data['artists_staff'] = \App\Designers::all();

        if (!empty($To || $From || $Cat)) {
            if ($D_Cat->Category == 2) {

                $this->data['Cat'] = 0;
           
                $Qurey = \App\DigiOrders::select('digitizing_orders.OrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'OrderType', 'digitizing_orders.IsRead')
                            ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                            ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                            ->where('digitizing_orders.DesignerID', $DesignerID)
                            ->whereRaw('digitizing_orders.DateAdded BETWEEN "' . $From . '" AND "' . $To . '"');
                            if($Type !== ""){
                            $Qurey->where('digitizing_orders.OrderType', $Type);
                        }

                        $this->data['Orders'] = $Qurey->orderby('digitizing_orders.OrderID', 'desc')->get();

                return view('admin.summary.designers.index', $this->data);
            } else if ($Cat == 1) {
                $this->data['Cat'] = 1;

                   $Qurey = \App\vector_order::select('vector_order.VectorOrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'OrderType', 'vector_order.IsRead')
                            ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                            ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                            ->where('digitizing_orders.DesignerID', $DesignerID)
                            ->whereRaw('vector_order.DateAdded BETWEEN "' . $From . '" AND "' . $To . '"');
                            if($Type !== ""){
                            $Qurey->where('vector_order.OrderType', $Type);
                             }

                        $this->data['Orders'] = $Qurey->orderby('vector_order.VectorOrderID', 'desc')->get();

                return view('admin.summary.designers.index', $this->data);
            } else {
                return redirect('admin/summary');
            }
        } else {
            return redirect('admin/summary')->with('warning_msg', "Invalid Selecttion");
        }




}



 public function designer_sum(){
        
        $this->data['artists_staff'] = \App\Designers::all();
        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');

        return view('admin.summary.designers.index', $this->data);

 }









 public function search_records() {
        $To = Input::get('DateTo');
        $From = Input::get('DateFrom');
        $Cat = Input::get('Cetagory');
        $Type = Input::get('type');


        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');



      if($Type == 5){
            $Type = 0;
        }elseif ($Type == 1) {
            $Type = 1;
        }elseif ($Type == 2) {
            $Type = 2;
        }elseif ($Type == 4) {
            $Type = 4;
        }elseif ($Type == 3) {
            $Type = 3;
        }else{
            $Type = "";
        }


        if (!empty($To || $From || $Cat)) {
            if ($Cat == 0) {

                $this->data['Cat'] = 0;

                 $Qurey = \App\DigiOrders::select('digitizing_orders.OrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'OrderType', 'digitizing_orders.IsRead')
                        ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                        ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                        ->whereRaw('digitizing_orders.DateAdded BETWEEN "' . $From . '" AND "' . $To . '"');
                         if($Type !== ""){
                            $Qurey->where('digitizing_orders.OrderType', $Type);
                          }

                           $this->data['Orders'] = $Qurey->orderby('digitizing_orders.OrderID', 'desc')->get();
                return view('admin.summary.history.historyindi', $this->data);
            } else if ($Cat == 1) {
                $this->data['Cat'] = 1;



                   $Qurey = \App\vector_order::select('VectorOrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'vector_order.Status', 'OrderType', 'vector_order.IsRead')
                        ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                        ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                        ->whereRaw('vector_order.DateAdded BETWEEN "' . $From . '" AND "' . $To . '"');
                         if($Type !== ""){
                            $Qurey->where('vector_order.OrderType', $Type);
                          }

                        $this->data['Orders'] = $Qurey->orderby('vector_order.VectorOrderID', 'desc')->get();

                return view('admin.summary.history.historyindi', $this->data);
            } else {
                return redirect('admin/summary');
            }
        } else {
            return redirect('admin/summary')->with('warning_msg', "Invalid Selecttion");
        }
    }
    
    
    public function destroy_record($id){
    
           if (count($id) > 0) {
            DB::table('digitizing_orders')
                    ->where('OrderID', $id)
                    ->delete();
        }
        return redirect('admin/digi/orders/all')->with('success', "Order Deleted Successfully");
        
    
        
    }
    
    
    
public function vdestroy_record($id){
    
           if (count($id) > 0) {
            DB::table('vector_order')
                    ->where('VectorOrderID', $id)
                    ->delete();
        }
        return redirect('admin/vector/orders/all')->with('success', "Order Deleted Successfully");
        
    
        
    }
    
    
    
public function jd(){

          $this->data['DigiOrders'] = \App\DigiOrders::select('OrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'digitizing_orders.Status', 'OrderType', 'digitizing_orders.IsRead')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                ->where('digitizing_orders.OrderType', $StatusID)
                ->orderby('digitizing_orders.OrderID', 'desc')
                ->get();
        if ($StatusID == 'all') {
            $this->data['DigiOrders'] = \App\DigiOrders::select('OrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'digitizing_orders.Status', 'OrderType', 'digitizing_orders.IsRead')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                    ->where('digitizing_orders.QuotePrice', 0)
                    ->orderby('digitizing_orders.OrderID', 'desc')
                    ->get();
        }
        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');

        return view('admin.summary.NewOrders', $this->data);


    }



    public function digi_orders($StatusID) {

//       $this->data['DigiOrders'] = \App\DigiOrders::select('OrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber','digitizing_orders.Status', 'OrderType')
//     ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
//       ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
//       ->where('digitizing_orders.OrderType', $StatusID)
//     ->get();
//       if($StatusID == 'all'){
//           $this->data['DigiOrders'] = \App\DigiOrders::select('OrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber','digitizing_orders.Status', 'OrderType')
//     ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
//           ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
//           ->get();
//       }
//
//       $this->data['OrderStatuses'] = Config('order_statuses');
//       $this->data['OrderTypes'] = Config('order_types');
//     
//       return view('admin.summary.NewOrders', $this->data);
        $this->data['DigiOrders'] = \App\DigiOrders::select('OrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'digitizing_orders.Status', 'OrderType', 'digitizing_orders.IsRead')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                ->where('digitizing_orders.OrderType', $StatusID)
                ->orderby('digitizing_orders.OrderID', 'desc')
                ->get();
        if ($StatusID == 'all') {
            $this->data['DigiOrders'] = \App\DigiOrders::select('OrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'digitizing_orders.Status', 'OrderType', 'digitizing_orders.IsRead')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                    ->where('digitizing_orders.QuotePrice', 0)
                    ->orderby('digitizing_orders.OrderID', 'desc')
                    ->get();
        }
        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');

        return view('admin.summary.NewOrders', $this->data);
    }

    public function vector_orders($StatusID) {


        $this->data['VectorOrders'] = \App\vector_order::select('VectorOrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'vector_order.Status', 'OrderType', 'vector_order.IsRead')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                ->where('vector_order.OrderType', $StatusID)
                ->orderby('vector_order.VectorOrderID', 'asc')
                ->get();


        if ($StatusID == 'all') {
            $this->data['VectorOrders'] = \App\vector_order::select('VectorOrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'vector_order.Status', 'OrderType', 'vector_order.IsRead')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                    ->where('vector_order.QuotePrice', 0)
                    ->orderby('vector_order.VectorOrderID', 'asc')
                    ->get();
        }
        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');

        return view('admin.summary.VectorOrders', $this->data);
    }

    public function vec_OrderDetail($VectorOrderID) {

        $this->data['VectorOrders'] = \App\vector_order::select('vector_order.VectorOrderID', 'CustomerName', 'customers.SalesPersonID', 'ReqFormat', 'DesignerName', 'AssignStatus', 'CC', 'File1', 'File2', 'File3', 'File4', 'MoreInstructions', 'NoOfColors', 'DesignName', 'PONumber', 'vector_order.Status', 'OrderType', 'vector_order.DesignerID', 'DesignerPrice', 'CustomerPrice', 'Price', 'customers.priceplane', 'MessageForAdmin', 'QuotePrice', 'IsRead', 'vector_result.VR_ID', 'Scale', 'Height', 'Width', 'ReqColor', 'ReqSeparation', 'CustomerPrice')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                ->leftjoin('vector_result', 'vector_result.VectorOrderID', '=', 'vector_order.VectorOrderID')
                ->where('vector_order.VectorOrderID', $VectorOrderID)
                ->orderby('vector_result.VR_ID', 'desc')
                ->first();

        $this->data['DesignHistory'] = \DB::table('vector_result')
                ->where('VectorOrderID', $VectorOrderID)
                ->get();


        $revision_history = [];

        $OrderDRID = \DB::table('vector_result')
                        ->where('VectorOrderID', $VectorOrderID)->get();

        if (!empty($OrderDRID)) {
            foreach ($OrderDRID as $order_dr) {
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
                ->whereRaw('VR_ID = (SELECT MAX(VR_ID) FROM vector_result_files WHERE VectorOrderID = ' . $VectorOrderID . ')')
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

        $this->data['Designers'] = \App\Designers::where('Category', 1)
                ->pluck('DesignerName', 'DesignerID');
//       array_unshift($this->data['Designers'], "Select Designer");
//       print_r($this->data['Designers']);die;

        if ($this->data['VectorOrders']->IsRead == 0) {
            \DB::table('vector_order')->where('VectorOrderID', $VectorOrderID)->update(['IsRead' => 3]);
        }
        return view('admin.summary.VecOrderDetail', $this->data);
    }

    public function OrderDetail($OrderID) {

        $this->data['DigiOrders'] = \App\DigiOrders::select('digitizing_orders.OrderID', 'customers.SalesPersonID','CustomerName', 'ReqFormat', 'DesignerName', 'AssignStatus', 'CC', 'File1', 'File2', 'File3', 'File4', 'MoreInstructions', 'NoOfColors', 'DesignName', 'PONumber', 'digitizing_orders.Status', 'OrderType', 'digitizing_orders.DesignerID', 'DesignerPrice', 'CustomerPrice', 'Price', 'customers.priceplane', 'MessageForAdmin', 'QuotePrice', 'IsRead', 'Scale', 'Height', 'Width', 'CustomerPrice', 'customers.CsNote')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID') 
                ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                ->where('digitizing_orders.OrderID', $OrderID)
                ->first();


        $this->data['DesignHistory'] = \DB::table('digi_result')
                ->where('OrderID', $OrderID)
                ->get();

        $revision_history = [];

        $OrderDRID = \DB::table('digi_result')
                        ->where('OrderID', $OrderID)->get();

        if (!empty($OrderDRID)) {
            foreach ($OrderDRID as $order_dr) {
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
                ->whereRaw('DR_ID = (SELECT MAX(DR_ID) FROM digi_result_files WHERE OrderID = ' . $OrderID . ')')
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

        $this->data['Designers'] = \App\Designers::where('Category', 2)->pluck('DesignerName', 'DesignerID');
//       array_unshift($this->data['Designers'], "Select Designer");

        if ($this->data['DigiOrders']->IsRead == 0) {
            \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update(['IsRead' => 3]);
        }
        return view('admin.summary.OrderDetail', $this->data);
    }

    public function AssignSubmit($OrderID) {

         // Revision CODE LINE 1490

  

        $valid["DesignerID"] = 'required|integer|min:1';

        $valid_name["DesignerID"] = "Designer";

        $messages = [
            'required' => 'Please enter :attribute.',
            'DesignerID.min' => 'Please select :attribute.'
        ];

        $v = Validator::make(Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {
            $status = 1;
            $read = 1;
            $type = 0;
            $order = \DB::table('digitizing_orders')->where('OrderID', $OrderID)->first();
            
            if ($order->OrderType == 0 || $order->OrderType == 3) {
               
                    $status = 5;
            }
            if ($order->OrderType == 2) {
                $type = 2;
            }
            $orderDetail = [
                'DesignerID' => \Input::get('DesignerID'),
                'MessageForDesigner' => \Input::get('MessageForDesigner'),
                'IsRead' => $read,
                'AssignStatus' => 1,
                'Status' => $status
            ];

           $DesignerID = \Input::get('DesignerID');
           $D_data = DB::table('designers')->select('DesignerName', 'Email')->where('DesignerID', $DesignerID)->first();   

             \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update($orderDetail);
           $this->data['designer_email'] = $D_data->Email;

         if($order->OrderType == 2 || $order->OrderType == 4){
            $type = "Quote";
             $mailFrom = 'technical-team@logoartz.com';
                  \Mail::send('includes.emails.digi_designer', [
                  "DesignerName" => $D_data->DesignerName,
                  "OrderType" => 'Digitizing '.$type,
                  "OrderStatus" => 1,
                  "DesignName" => $order->DesignName,
                  "RequriedFormat" => $order->ReqFormat,
                  "FABRIC" => $order->Fabric,
                  "PLACEMENT" => $order->Placement,
                  "Width" => $order->Width,
                  "Height" => $order->Height,
                  "Scale" => $order->Scale,
                  "NumClr" => $order->NoOfColors,
                  "Fbrclr" => $order->FabricColor,
                  "Adminmsg" => \Input::get('MessageForDesigner')
                  ]
                    , function($message) use ($mailFrom) {
                $message->to($this->data['designer_email'])->from($mailFrom, 'Logo Artz')->subject('Logo Artz -Assigned Digitizing Quote');
            });
           }else{
               $type = "Order";
               
                 $mailFrom = 'technical-team@logoartz.com';
                  \Mail::send('includes.emails.digi_designer', [
                  "DesignerName" => $D_data->DesignerName,
                  "OrderType" => 'Digitizing '.$type,
                  "OrderStatus" => 1,
                  "DesignName" => $order->DesignName,
                  "RequriedFormat" => $order->ReqFormat,
                  "FABRIC" => $order->Fabric,
                  "PLACEMENT" => $order->Placement,
                  "Width" => $order->Width,
                  "Height" => $order->Height,
                  "Scale" => $order->Scale,
                  "NumClr" => $order->NoOfColors,
                  "Fbrclr" => $order->FabricColor,
                  "Adminmsg" => \Input::get('MessageForDesigner')
                  ]
                    , function($message) use ($mailFrom) {
                $message->to($this->data['designer_email'])->from($mailFrom, 'Logo Artz')->subject('Logo Artz -Assigned Digitizing Order');
            });
               
               
           }
               
    
            \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update($orderDetail);
            return redirect('admin/Norder-details/' . $OrderID)->with('success', 'Assigned to Designer Successfully');
        }
    }




   public function VecAssignSubmit_q_rev($VectorOrderID) {


        $valid["DesignerID"] = 'required|integer|min:1';

        $valid_name["DesignerID"] = "Designer";

        $messages = [
            'required' => 'Please enter :attribute.',
            'DesignerID.min' => 'Please select :attribute.'
        ];

        $v = Validator::make(Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {
            
            $status = 1;
            $read = 1;
            $type = 0;
            $order = \DB::table('vector_order')->where('VectorOrderID', $VectorOrderID)->first();

            if ($order->OrderType == 2) {
                $type = 2;          //Type 2 (Quote)
            }if ($order->OrderType == 4) {
                $type = 4;       //Type 2 (Quote Revision)
                $status = 10; //Status 10 (Revision)
            }

            $orderDetail = [
                'DesignerID' => \Input::get('DesignerID'),
                'MessageForDesigner' => \Input::get('MessageForDesigner'),
                'IsRead' => $read,
                'AssignStatus' => 1,
                'Status' => $status
            ];

           $DesignerID = \Input::get('DesignerID');
           $D_data = DB::table('designers')->select('DesignerName', 'Email')->where('DesignerID', $DesignerID)->first();    
           $this->data['designer_email'] = $D_data->Email;

               $this->data['designer_email'] = $D_data->Email;
           
             $type = "Quote";
             $mailFrom = 'technical-team@logoartz.com';
                  \Mail::send('includes.emails.vec_designer', [
                  "DesignerName" => $D_data->DesignerName,
                  "OrderType" => 'Vector '.$type,
                  "OrderStatus" => 1,
                 "DesignName" => $order->DesignName,
                  "RequriedFormat" => $order->ReqFormat,
                  "Vecuse" => $order->UsedFor,
                  "Width" => $order->Width,
                  "Height" => $order->Height,
                  "Scale" => $order->Scale,
                  "Reqclr" => $order->ReqColor,
                  "NumClr" => $order->NoOfColors,
                  "Adminmsg" => \Input::get('MessageForDesigner')
                  ]
                    , function($message) use ($mailFrom) {
                $message->to('umerbhattiboostani@gmail.com')->from($mailFrom, 'Logo Artz')->subject('Logo Artz -Assigned Vector Quote');
            });


            \DB::table('vector_order')->where('VectorOrderID', $VectorOrderID)->update($orderDetail);
            return redirect('admin/Vec_order-details/' . $VectorOrderID)->with('success', 'Assigned to Designer Successfully');
        }
    }


  public function AssignSubmit_q_rev($OrderID) {
   // Quote Revision Set
        $valid["DesignerID"] = 'required|integer|min:1';

        $valid_name["DesignerID"] = "Designer";

        $messages = [
            'required' => 'Please enter :attribute.',
            'DesignerID.min' => 'Please select :attribute.'
        ];

        $v = Validator::make(Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {
            $status = 1;
            $read = 1;
            $type = 0;
            $order = \DB::table('digitizing_orders')->where('OrderID', $OrderID)->first();
            
            
            if ($order->OrderType == 2) {
                $type = 2;
            }if ($order->OrderType == 4) {
                $type = 4;
                $status = 10;
            }
            $orderDetail = [
                'DesignerID' => \Input::get('DesignerID'),
                'MessageForDesigner' => \Input::get('MessageForDesigner'),
                'IsRead' => $read,
                'AssignStatus' => 1,
                'Status' => $status
            ];

           $DesignerID = \Input::get('DesignerID');
           $D_data = DB::table('designers')->select('DesignerName', 'Email')->where('DesignerID', $DesignerID)->first();  
           $this->data['designer_email'] = $D_data->Email;
            
              $mailFrom = 'technical-team@logoartz.com';
                  \Mail::send('includes.emails.digi_designer', [
                  "DesignerName" => $D_data->DesignerName,
                  "OrderType" => 'Digitizing '.$type,
                  "OrderStatus" => 1,
                  "DesignName" => $order->DesignName,
                  "RequriedFormat" => $order->ReqFormat,
                  "FABRIC" => $order->Fabric,
                  "PLACEMENT" => $order->Placement,
                  "Width" => $order->Width,
                  "Height" => $order->Height,
                  "Scale" => $order->Scale,
                  "NumClr" => $order->NoOfColors,
                  "Fbrclr" => $order->FabricColor,
                  "Adminmsg" => \Input::get('MessageForDesigner')
                  ]
                    , function($message) use ($mailFrom) {
                $message->to('umerbhattiboostani@gmail.com')->from($mailFrom, 'Logo Artz')->subject('Logo Artz -Assigned Digitizing Quote');
            });


            
           // dd($orderDetail); die;
            
            \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update($orderDetail);
            return redirect('admin/Norder-details/' . $OrderID)->with('success', 'Assigned to Designer Successfully');
        }
    }


    public function VecAssignSubmit($VectorOrderID) {
        $valid["DesignerID"] = 'required|integer|min:1';

        $valid_name["DesignerID"] = "Designer";

        $messages = [
            'required' => 'Please enter :attribute.',
            'DesignerID.min' => 'Please select :attribute.'
        ];

        $v = Validator::make(Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {
            
    
        
            
            $status = 1;
            $read = 1;
            $type = 0;
            $order = \DB::table('vector_order')->where('VectorOrderID', $VectorOrderID)->first();
            if ($order->OrderType == 0 || $order->OrderType == 3) {
                $status = 5;
            }
            if($order->OrderType == 2 ){
                $type = 2;
                
            }
            $orderDetail = [
                'DesignerID' => \Input::get('DesignerID'),
                'MessageForDesigner' => \Input::get('MessageForDesigner'),
                'IsRead' => $read,
                'AssignStatus' => 1,
                'Status' => $status
            ];
            $DesignerID = \Input::get('DesignerID');
           $D_data = DB::table('designers')->select('DesignerName', 'Email')->where('DesignerID', $DesignerID)->first();  
           $this->data['designer_email'] = $D_data->Email;

        if($order->OrderType == 2 || $order->OrderType == 4){
                $type = "Quote";
                $mailFrom = 'technical-team@logoartz.com';
                  \Mail::send('includes.emails.vec_designer', [
                  "DesignerName" => $D_data->DesignerName,
                  "OrderType" => 'Vector '.$type,
                  "OrderStatus" => 1,
                 "DesignName" => $order->DesignName,
                  "RequriedFormat" => $order->ReqFormat,
                  "Vecuse" => $order->UsedFor,
                  "Width" => $order->Width,
                  "Height" => $order->Height,
                  "Scale" => $order->Scale,
                  "Reqclr" => $order->ReqColor,
                  "NumClr" => $order->NoOfColors,
                  "Adminmsg" => \Input::get('MessageForDesigner')
                  ]
                    , function($message) use ($mailFrom) {
                $message->to('umerbhattiboostani@gmail.com')->from($mailFrom, 'Logo Artz')->subject('Logo Artz -Assigned Vector Quote');
            });
           }else{
               $type = "Order";
               
                 $mailFrom = 'technical-team@logoartz.com';
                  \Mail::send('includes.emails.vec_designer', [
                  "DesignerName" => $D_data->DesignerName,
                  "OrderType" => 'Vector '.$type,
                  "OrderStatus" => 1,
                  "DesignName" => $order->DesignName,
                  "RequriedFormat" => $order->ReqFormat,
                  "Vecuse" => $order->UsedFor,
                  "Width" => $order->Width,
                  "Height" => $order->Height,
                  "Scale" => $order->Scale,
                  "Reqclr" => $order->ReqColor,
                  "NumClr" => $order->NoOfColors,
                  "Adminmsg" => \Input::get('MessageForDesigner')
                  ]
                    , function($message) use ($mailFrom) {
                $message->to('umerbhattiboostani@gmail.com')->from($mailFrom, 'Logo Artz')->subject('Logo Artz -Assigned Vector Order');
            });
               
               
           }



            \DB::table('vector_order')->where('VectorOrderID', $VectorOrderID)->update($orderDetail);
            return redirect('admin/Vec_order-details/' . $VectorOrderID)->with('success', 'Assigned to Designer Successfully');
        }
    }

    public function RevOrders() {
        $this->data['recordsTotal'] = \App\Customers::count();

        return view('admin.summary.RevOrders', $this->data);
    }

    public function NewQuotes() {
        $this->data['recordsTotal'] = \App\Customers::count();

        return view('admin.summary.NewQuotes', $this->data);
    }

    public function QuteRev() {
        $this->data['recordsTotal'] = \App\Customers::count();

        return view('admin.summary.QuteRev', $this->data);
    }

    public function ExtraTime() {
        $this->data['recordsTotal'] = \App\Customers::count();

        return view('admin.summary.index', $this->data);
    }

    public function customers_list() {
        $start = (Input::has('start') ? (int) Input::get('start') : 0);
        $length = (Input::has('length') ? (int) Input::get('length') : 25);

        $columns = ["", "CustomerID", "CustomerName", "Cell", "Email", "Status", "DateAdded", "DateModified"];

        $query = \App\Customers::select(['CustomerID', 'CustomerName', 'Cell', 'Email',
                    DB::raw("CONCAT('<small class=\"label bg-', IF(Status = 0, 'red', 'green'), '\" ><i class=\"fa ', IF(Status = 0, 'fa-times', 'fa-check'), '\"></i> ', IF(Status = 1, 'Active', 'Deactive'), '</small>') AS Status"),
                    DB::raw("DATE_FORMAT(DateAdded, \"%d-%b-%Y<br>%r\") as DateAdded"),
                    DB::raw("DATE_FORMAT(DateModified, \"%d-%b-%Y<br>%r\") as DateModified")]);

        $recordsTotal = count($query->get());

        if (!empty(Input::get('search')["value"])) {
            $input = strtolower(trim(Input::get('search')["value"]));
            $query->whereRaw("(CustomerName LIKE '%" . $input . "%' OR Cell LIKE '%" . $input . "%' OR Email LIKE '%" . $input . "%')");
        }

        $query->orderBy($columns[(int) Input::get('order')[0]["column"]], strtoupper(Input::get('order')[0]["dir"]));
        $query->orderBy("CustomerID", "DESC");

        // limit acc to start and length
        $recordsFiltered = count($query->get());
        $result = $query->skip($start)->take($length)->get();
        // $maxRow = count($result);
        $data = [];
        foreach ($result as $Rs) {
            $data[] = [
                "<input type=\"checkbox\" class=\"check\" name=\"ids[]\" value=\"" . $Rs->CustomerID . "\" />",
                $Rs->CustomerID,
                $Rs->CustomerName,
                $Rs->Cell,
                $Rs->Email,
                $Rs->Status,
                $Rs->DateAdded,
                $Rs->DateModified,
                '<button type="button" class="btn btn-success btn-sm" onClick="location.href=\'customers/' . $Rs->CustomerID . '\'"><i class="fa fa-edit"></i> Edit</button>'
            ];
        }

        echo json_encode(["draw" => (int) Input::get('draw'), "recordsTotal" => $recordsTotal, "recordsFiltered" => $recordsFiltered, "data" => $data]);
        exit(0);
    }

    public function countries_dd() {
        $query = \App\Countries::where('Status', 1);
        $parents = $query->select('CountryName', 'CountryID')->get();
        $parent_pages = ["0" => "Select Country"];
        if (count($parents) > 0) {
            foreach ($parents as $parent) {
                $parent_pages += [
                    $parent->CountryID => $parent->CountryName
                ];
            }
        }
        return $parent_pages;
    }

    public function add() {
        $this->data['countries_dd'] = $this->countries_dd();
        return view('admin.customers.add', $this->data);
    }

    public function save() {

        $error = false;
        $msg = "";

        $allowed_ext = ['jpg', 'JPG', 'JPEG', 'jpeg', 'png', "PNG", 'gif', 'GIF'];

        if (Input::hasFile('Image')) {
            $fl = Input::file('Image');
            if (!empty($fl)) {
                $ext = $fl->getClientOriginalExtension();
                if (!in_array($ext, $allowed_ext)) {
                    $error = true;
                    $msg = "Invalid Image type";
                }
            }
        }

        $valid["CountryID"] = 'required|integer|min:1';
        $valid["CustomerName"] = 'required|max:20';
        $valid["Cell"] = 'max:20';
        $valid["Email"] = 'email|max:50';
        $valid["Fax"] = 'max:100';
        $valid["Company"] = 'max:100';
        $valid["State"] = 'max:100';
        $valid["City"] = 'max:100';
        $valid["Address"] = 'max:1000';
        $valid["Zip"] = 'max:20';
        $valid["Username"] = 'required|max:100';
        $valid["Password"] = 'required|max:20';
        $valid["Status"] = 'required|integer|min:0|max:1';

        $valid_name["CountryID"] = "Country";
        $valid_name["CustomerName"] = "Customer Name";
        $valid_name["Cell"] = "Cell";
        $valid_name["Email"] = "Email";
        $valid_name["Fax"] = "Fax";
        $valid_name["Company"] = "Company";
        $valid_name["State"] = "State";
        $valid_name["City"] = "City";
        $valid_name["Address"] = "Address";
        $valid_name["Zip"] = "Zip";
        $valid_name["Username"] = "Username";
        $valid_name["Password"] = "Password";
        $valid_name["Status"] = "Status";

        $messages = [
            'required' => 'Please enter :attribute.',
            'CountryID.min' => 'Please select :attribute.',
            'max' => 'No more characters allowed in :attribute.'
        ];

        $v = Validator::make(Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);
        if ($v->fails() || $error) {
            if ($error) {
                return redirect()->back()->withErrors($v->errors())->withInput()->with('warning_msg', $msg);
            } else {
                return redirect()->back()->withErrors($v->errors())->withInput();
            }
        } else {
            $cat = new \App\Customers;

            $cat->CustomerName = Input::get('CustomerName');
            $cat->Cell = Input::get('Cell');
            $cat->Email = Input::get('Email');
            $cat->Fax = Input::get('Fax');
            $cat->Company = Input::get('Company');
            $cat->CountryID = Input::get('CountryID');
            $cat->State = Input::get('State');
            $cat->City = Input::get('City');
            $cat->Address = Input::get('Address');
            $cat->Zip = Input::get('Zip');
            $cat->CsNote = Input::get('CsNote');
            $cat->Username = Input::get('Username');
            $cat->Password = \Hash::make(Input::get('Password'));
            $cat->Status = Input::get('Status');
            $cat->DateAdded = new \DateTime;

            $cat->save();

            $CustomerID = \DB::getPdo()->lastInsertId();

            if (Input::hasFile('Image')) {
                $fl = Input::file('Image');
                if (!empty($fl)) {
                    $filename = $CustomerID . '_' . str_random(5) . '.' . $fl->getClientOriginalExtension();

                    $path = public_path('uploads') . '/customers/' . $filename;

                    \Image::make($fl->getRealPath())->save($path);
                    \DB::table('customers')->where('CustomerID', $CustomerID)->update(['DP' => $filename]);
                }
            }

            return redirect('admin/customers')->with(['success' => "Customer Added Successfully"]);
        }
    }

    public function edit($id) {
        $query = \DB::table('customers');
        $query->where('CustomerID', $id);

        $this->data['cust'] = $query->first();

        if (empty($this->data['cust'])) {
            return redirect('admin/customers')->with('warning_msg', "Invalid Customer ID");
        } else {
            $this->data['countries_dd'] = $this->countries_dd();
            return view('admin.customers.edit', $this->data);
        }
    }

    public function update($id) {

        $error = false;
        $msg = "";

        $allowed_ext = ['jpg', 'JPG', 'JPEG', 'jpeg', 'png', "PNG", 'gif', 'GIF'];

        if (Input::hasFile('Image')) {
            $fl = Input::file('Image');
            if (!empty($fl)) {
                $ext = $fl->getClientOriginalExtension();
                if (!in_array($ext, $allowed_ext)) {
                    $error = true;
                    $msg = "Invalid Image type";
                }
            }
        }

        $valid["CountryID"] = 'required|integer|min:1';
        $valid["CustomerName"] = 'required|max:20';
        $valid["Cell"] = 'max:20';
        $valid["Email"] = 'email|max:50';
        $valid["Fax"] = 'max:100';
        $valid["Company"] = 'max:100';
        $valid["State"] = 'max:100';
        $valid["City"] = 'max:100';
        $valid["Address"] = 'max:1000';
        $valid["Zip"] = 'max:20';
        $valid["Username"] = 'required|max:100';
        $valid["Password"] = 'max:20';
        $valid["Status"] = 'required|integer|min:0|max:1';

        $valid_name["CountryID"] = "Country";
        $valid_name["CustomerName"] = "Customer Name";
        $valid_name["Cell"] = "Cell";
        $valid_name["Email"] = "Email";
        $valid_name["Fax"] = "Fax";
        $valid_name["Company"] = "Company";
        $valid_name["State"] = "State";
        $valid_name["City"] = "City";
        $valid_name["Address"] = "Address";
        $valid_name["Zip"] = "Zip";
        $valid_name["Username"] = "Username";
        $valid_name["Password"] = "Password";
        $valid_name["Status"] = "Status";

        $messages = [
            'required' => 'Please enter :attribute.',
            'CountryID.min' => 'Please select :attribute.',
            'max' => 'No more characters allowed in :attribute.'
        ];

        $v = Validator::make(\Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);
        if ($v->fails()) {
            if ($error) {
                return redirect()->back()->withErrors($v->errors())->withInput()->with('warning_msg', $msg);
            } else {
                return redirect()->back()->withErrors($v->errors())->withInput();
            }
        } else {


            $cat = \App\Customers::find($id);

            $cat->CustomerName = Input::get('CustomerName');
            $cat->Cell = Input::get('Cell');
            $cat->Email = Input::get('Email');
            $cat->Fax = Input::get('Fax');
            $cat->Company = Input::get('Company');
            $cat->CountryID = Input::get('CountryID');
            $cat->State = Input::get('State');
            $cat->City = Input::get('City');
            $cat->Address = Input::get('Address');
            $cat->CsNote = Input::get('CsNote');
            $cat->Zip = Input::get('Zip');
            $cat->Username = Input::get('Username');
            if (Input::has('Password') && Input::get('Password') != "") {
                $cat->Password = \Hash::make(Input::get('Password'));
            }
            $cat->Status = Input::get('Status');
            $cat->DateModified = new \DateTime;

            $cat->save();

            if (Input::hasFile('Image')) {
                $i = 1;
                $fl = Input::file('Image');
                if (!empty($fl)) {
                    $prod = DB::table('customers')->select('DP')->where('CustomerID', $id)->first();
                    if (\File::exists(public_path('uploads') . '/customers/' . $prod->DP)) {
                        \File::delete(public_path('uploads') . '/customers/' . $prod->DP);
                    }
                    $filename = $id . '_' . str_random(5) . '.' . $fl->getClientOriginalExtension();

                    $path = public_path('uploads') . '/customers/' . $filename;

                    \Image::make($fl->getRealPath())->save($path);
                    \DB::table('customers')->where('CustomerID', $id)->update(['DP' => $filename]);
                }
            }

            return redirect('admin/customers')->with(['success' => "Customer Updated Successfully"]);
        }
    }

    public function delete() {
        if (count(\Input::get('ids')) > 0) {
            DB::table('customers')
                    ->whereIn('CustomerID', \Input::get('ids'))
                    ->delete();
        }
        return redirect('admin/customers')->with('success', "Selected Customer Deleted Successfully");
    }

    function VecSendQuote($VectorOrderID) {
        $query;
        $valid["CustomerPrice"] = 'required|integer|min:1';
        $valid_name["CustomerPrice"] = "Customer Price";
        $messages = [
            'required' => 'Please enter :attribute.',
            'CountryID.min' => 'Please Enter Valid Amount'
        ];
        $v = Validator::make(\Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {

            if (Input::has('FileForCustomer') && is_array(Input::get('FileForCustomer')) && count(Input::get('FileForCustomer')) > 0) {

            $isRevisionSet = DB::table('vector_result_files')->select(DB::raw('MAX(RevisionSet) as RevisionSet'))
                    ->where('VectorOrderID', $VectorOrderID)
                    ->first();
            if (!empty($isRevisionSet)) {
                $myVar = $isRevisionSet->RevisionSet;
                $myVar++;
            } else {
                $myVar = 0;
             }
           

            \DB::table('vector_result_files')->whereIn('VR_File_ID', Input::get('FileForCustomer'))
                    ->update([
                        'ForCustomer' => 1,
                        'RevisionSet' => $myVar
            ]);
                    }

        }

                    
          
            $types = Config('order_types');
            $query = \App\vector_order::where('VectorOrderID', $VectorOrderID)
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                    ->first();
            $CustomerName = $query->CustomerName;
            \DB::table('vector_order')->where('VectorOrderID', $VectorOrderID)->update(['CustomerPrice' => \Input::get('CustomerPrice'), 'Status' => 3, 'IsRead' => 2]);
            \Mail::send(['html' => 'mail'], ['name' => 'Logo Artz', 'user' => $query->CustomerName, 'design' => 'Vector Design', 'type' => $types[$query->OrderType], 'amount' => \Input::get('CustomerPrice')], function ($message) use ($query) {
                $message->to($query->Email)->subject('Confirmation');
                $message->from('technical-team@logoartz.com', 'Logo Artz');
            });
            return redirect('admin/Vec_order-details/' . $VectorOrderID)->with('success', 'Quote Sent To Customer Successfully');
        
    }

    function SendQuote($OrderID) {
        // Line 1305 for Order 


        $query;
        $valid["CustomerPrice"] = 'required|integer|min:1';
        $valid_name["CustomerPrice"] = "Customer Price";
        $messages = [
            'required' => 'Please enter :attribute.',
            'CountryID.min' => 'Please Enter Valid Amount'
        ];
        $v = Validator::make(\Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {


        if (Input::has('FileForCustomer') && is_array(Input::get('FileForCustomer')) && count(Input::get('FileForCustomer')) > 0) {

            $isRevisionSet = DB::table('digi_result_files')->select(DB::raw('MAX(RevisionSet) as RevisionSet'))
                    ->where('OrderID', $OrderID)
                    ->first();
            if (!empty($isRevisionSet)) {
                $myVar = $isRevisionSet->RevisionSet;
                $myVar++;
            } else {
                $myVar = 0;
             }
           

            \DB::table('digi_result_files')->whereIn('DR_File_ID', Input::get('FileForCustomer'))
                    ->update([
                        'ForCustomer' => 1,
                        'RevisionSet' => $myVar
            ]);
                    }




        }

            $types = Config('order_types');
            $query = \App\DigiOrders::where('OrderID', $OrderID)
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                    ->first();
                    
            $CustomerName = $query->CustomerName;
            $this->data['mail'] = $query->Email;
            \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update(['CustomerPrice' => \Input::get('CustomerPrice'), 'Status' => 3, 'IsRead' => 2]);
            
             $mailFrom = 'technical-team@logoartz.com';
                  \Mail::send('includes.emails.quoteready', [
                  "CustomerName" => $CustomerName,
                  "OrderType" => 'digitizing order',
                  "Price"   => \Input::get('CustomerPrice')
                  ]
                    , function($message) use ($mailFrom) {
                $message->to($this->data['mail'])->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Quote Confirmation');
            });
         
         
            // \Mail::send(['html' => 'mail'], ['name' => 'Logo Artz', 'user' => $query->CustomerName, 'design' => 'Digitizing Design', 'type' => $types[$query->OrderType], 'amount' => \Input::get('CustomerPrice')], function ($message) use ($query) {
            //     $message->to($query->Email)->subject('Quote Confirmation');
            //     $message->from('technical-team@logoartz.com', 'Logo Artz');
            // });
            
        
            return redirect('admin/Norder-details/' . $OrderID)->with('success', 'Quote Sent To Customer Successfully');
        }
    

    function new_vector_quote($quotestatus) {
        $this->data['VectorOrders'] = \App\vector_order::select('VectorOrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'vector_order.Status', 'OrderType', 'IsRead')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                ->where('vector_order.Status', $quotestatus)
                ->get();
        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');

        return view('admin.summary.VectorOrders', $this->data);
    }

    function new_digi_quote($quotestatus) {
//        $this->data['DigiOrders'] = \App\DigiOrders::select('OrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber','digitizing_orders.Status', 'OrderType')
//                                    ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
//                                    ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
//                                    ->where('digitizing_orders.QuotePrice', $quotestatus)
//                                    ->get();
//       $this->data['OrderStatuses'] = Config('order_statuses');
//       $this->data['OrderTypes'] = Config('order_types');
//       
//       return view('admin.summary.NewOrders', $this->data);
        $this->data['DigiOrders'] = \App\DigiOrders::select('OrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'digitizing_orders.Status', 'OrderType', 'IsRead')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                ->where('digitizing_orders.Status', $quotestatus)
                ->get();
        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');

        return view('admin.summary.NewOrders', $this->data);
    }

    public function search_order() {


        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');

        // echo '<pre>'.print_r(Input::all(), 1).'</pre>'; die;

        $OrderNo = 0;
        $QuoteNo = 0;
        $PoNumber = 0;
        $mCustomerName = "";
        $CustomerEmail = "";
        $CusPhone = "";

        if (Input::has('OrderNum') && (int) Input::get('OrderNum') != 0) {
            $OrderNo = (int) Input::get('OrderNum');
        } 
        if (Input::has('quote_num') && (int) Input::get('quote_num') != 0) {
            $QuoteNo = (int) Input::get('quote_num');
        }
        if (Input::has('PoNum') && (int) Input::get('PoNum') != 0) {
            $PoNumber = (int) Input::get('PoNum');
        }
        if (Input::has('Customer_Name') && Input::get('Customer_Name') != '') {
            $mCustomerName = trim(Input::get('Customer_Name'));
        } 
         if (Input::has('phone_num') && Input::get('phone_num') != '') {
            $CusPhone = trim(Input::get('phone_num'));
        } 
        if (Input::has('Cus_email') && Input::get('Cus_email') != '') {
            $CustomerEmail = trim(Input::get('Cus_email'));
        }




        $OrderSearchResult = [];

        if ($mCustomerName != "") {
            $CustomerIDs = DB::table('customers')->select('CustomerID')->whereRaw('CustomerName LIKE "%' . $mCustomerName . '%"')->get();
        }
        if ($CustomerEmail !=  "") {
            $CustomerIDs = DB::table('customers')->select('CustomerID')->whereRaw('Email LIKE "%' . $CustomerEmail . '%"')->get();
        }
        if ($CusPhone !=  "") {
            $CustomerIDs = DB::table('customers')->select('CustomerID')->whereRaw('Cell LIKE "%' . $CusPhone . '%"')->get();
        }

        $CompleteResult = [];

        // digitizing_search
        $Digitizing = DB::table('digitizing_orders')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID');
        if ($OrderNo != 0) {
            $Digitizing->where('OrderID', $OrderNo);
        }
        if ($QuoteNo != 0) {
            $Digitizing->where('OrderID', $QuoteNo);
        }
        if ($PoNumber != 0) {
            $Digitizing->where('PONumber', $PoNumber);
        }
        if ($mCustomerName != "" || $CustomerEmail != "" || $CusPhone != "" && !empty($CustomerIDs)) {
            $CustIDs = [];
            foreach ($CustomerIDs as $cIds) {
                array_push($CustIDs, $cIds->CustomerID);
            }
            $Digitizing->whereIn('digitizing_orders.CustomerID', $CustIDs);
        }
        $DigitizingResult = $Digitizing->get();

        if (!empty($DigitizingResult)) {
            foreach ($DigitizingResult as $digitRes) {
                $CompleteResult[] = [
                    'OrderID' => $digitRes->OrderID,
                    'OrderRef' => 'Digitizing',
                    'OrderDetailLink' => url('admin/Norder-details/' . $digitRes->OrderID),
                    'PONumber' => $digitRes->PONumber,
                    'DesignName' => $digitRes->DesignName,
                    'CustomerName' => $digitRes->CustomerName,
                    'DesignerName' => $digitRes->DesignerName,
                    'OrderType' => $digitRes->OrderType,
                ];
            }
        }

        // digitizing_search
        $Vector = DB::table('vector_order')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID');
        if ($OrderNo != 0) {
            $Vector->where('VectorOrderID', $OrderNo);
        }
        if ($QuoteNo != 0) {
            $Vector->where('VectorOrderID', $QuoteNo);
        }
        if ($PoNumber != 0) {
            $Vector->where('PONumber', $PoNumber);
        }
        if ($mCustomerName != "" || $CustomerEmail != "" || $CusPhone != ""  && !empty($CustomerIDs)) {
            $CustIDs = [];
            foreach ($CustomerIDs as $cIds) {
                array_push($CustIDs, $cIds->CustomerID);
            }
            $Vector->whereIn('vector_order.CustomerID', $CustIDs);
        }
        $VectorResult = $Vector->get();

        if (!empty($VectorResult)) {
            foreach ($VectorResult as $vectRes) {
                $CompleteResult[] = [
                    'OrderID' => $vectRes->VectorOrderID,
                    'OrderRef' => 'Vector',
                    'OrderDetailLink' => url('admin/Vec_order-details/' . $vectRes->VectorOrderID),
                    'PONumber' => $vectRes->PONumber,
                    'DesignName' => $vectRes->DesignName,
                    'CustomerName' => $vectRes->CustomerName,
                    'DesignerName' => $vectRes->DesignerName,
                    'OrderType' => $vectRes->OrderType,
                ];
            }
       }



        $this->data['SearchResult'] = $CompleteResult;

        //  echo '<pre>'.print_r($CompleteResult, 1).'</pre>'; die;


        return view('admin.summary.SearchDetail', $this->data);

        if (Input::get('order') == 1) {
            $this->data['VectorOrders'] = DB::table('vector_order')
                    ->select('vector_order.*', 'customers.CustomerName', 'designers.DesignerName')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                    ->where('VectorOrderID', 'LIKE', '%' . Input::get('OrderNum') . "%")
                    ->where('PONumber', 'LIKE', '%' . Input::get('PoNum') . "%")
                    ->where('customers.CustomerName', 'LIKE', '%' . Input::get('Customer_Name') . "%")
                    ->where('designers.DesignerName', 'LIKE', '%' . Input::get('Designer_Name') . "%")
                    ->get();
            return view('amndmin.summary.VectorOrders', $this->data);
        } elseif (Input::get('order') == 2) {
            $this->data['DigiOrders'] = DB::table('digitizing_orders')
                    ->select('digitizing_orders.*', 'customers.CustomerName', 'designers.DesignerName')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                    ->where('OrderID', 'LIKE', '%' . Input::get('OrderNum') . "%")
                    ->where('PONumber', 'LIKE', '%' . Input::get('PoNum') . "%")
                    ->where('customers.CustomerName', 'LIKE', '%' . Input::get('Customer_Name') . "%")
                    ->where('designers.DesignerName', 'LIKE', '%' . Input::get('Designer_Name') . "%")
                    ->get();
            print_r($this->data['DigiOrders']);
            die;
            return view('admin.summary.NewOrders', $this->data);
        }




die;





        ////// O L  D      C H E E E R A    H O A     W O R K




        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');

        // echo '<pre>'.print_r(Input::all(), 1).'</pre>'; die;


        $OrderNo = 0;
        $QuoteNo = 0;
        $PoNumber = 0;
        $PhoneNo = 0;
        $mCustomerName = "";
        $CustomerEmail = "";


        if (Input::has('OrderNum') && (int) Input::get('OrderNum') != 0) {
            $OrderNo = (int) Input::get('OrderNum');
        }
        if (Input::has('quote_num') && (int) Input::get('quote_num') != 0) {
            $QuoteNo = (int) Input::get('quote_num');
        }
        if (Input::has('PoNum') && (int) Input::get('PoNum') != 0) {
            $PoNumber = (int) Input::get('PoNum');
        }
        if (Input::has('phone_num') && Input::get('phone_num') != "") {
            $PhoneNo = (int) Input::get('phone_num');
        }
        if (Input::has('Customer_Name') && Input::get('Customer_Name') != "") {
            $mCustomerName = trim(Input::get('Customer_Name'));
        }
        if (Input::has('Cus_email') && Input::get('Cus_email') != "") {
            $CustomerEmail = trim(Input::get('Customer_Name'));
        }

       // echo $CustomerEmail.'<br>'.$mCustomerName.'<br>'. $PhoneNo; die;

        $OrderSearchResult = [];

        if ($mCustomerName != "") {
            $CustomerIDs = DB::table('customers')->select('CustomerID')->whereRaw('CustomerName LIKE "%' . $mCustomerName . '%"')->get();
        } 
        if ($CustomerEmail != "") {
            $CustomerIDs = DB::table('customers')->select('CustomerID')->whereRaw('Email LIKE "%' . $CustomerEmail . '%"')->get();
        }
        if ($PhoneNo != "") {
            $CustomerIDs = DB::table('customers')->select('CustomerID')->whereRaw('Cell LIKE "%' . $PhoneNo . '%"')->get();
        }


        $CompleteResult = [];

        // digitizing_search
        $Digitizing = DB::table('digitizing_orders')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID');
        if ($OrderNo != 0) {
            $Digitizing->where('OrderID', $OrderNo);
        }
        if ($QuoteNo != 0) {
            $Digitizing->where('OrderID', $QuoteNo);
        }
        if ($PoNumber != 0) {
            $Digitizing->where('PONumber', $PoNumber);
        }
         if ($CustomerEmail != "") {
            $Digitizing->where('Email', $CustomerEmail);
        }
         if ($mCustomerName != "") {
            $Digitizing->where('CustomerName', $mCustomerName);
        }
        if ($PhoneNo != 0) {
            $Digitizing->where('Cell', $PhoneNo);
        }


        if (!empty($CustomerIDs)) {
            $CustIDs = [];
            foreach ($CustomerIDs as $cIds) {
                array_push($CustIDs, $cIds->CustomerID);
            }
            $Digitizing->whereIn('digitizing_orders.CustomerID', $CustIDs);
        }
        $DigitizingResult = $Digitizing->get();

        if (!empty($DigitizingResult)) {
            foreach ($DigitizingResult as $digitRes) {
                $CompleteResult[] = [
                    'OrderID' => $digitRes->OrderID,
                    'OrderRef' => 'Digitizing',
                    'OrderDetailLink' => url('admin/Norder-details/' . $digitRes->OrderID),
                    'PONumber' => $digitRes->PONumber,
                    'DesignName' => $digitRes->DesignName,
                    'CustomerName' => $digitRes->CustomerName,
                    'DesignerName' => $digitRes->DesignerName,
                    'OrderType' => $digitRes->OrderType,
                ];
            }
        }
          $this->data['SearchResult'] = $CompleteResult;

         return view('admin.summary.SearchDetail', $this->data);


        // Vector_search
        $Vector = DB::table('vector_order')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID');
        if ($OrderNo != 0) {
            $Vector->where('VectorOrderID', $OrderNo);
        }
        if ($PoNumber != 0) {
            $Vector->where('PONumber', $PoNumber);
        }
        if ($mCustomerName != "" && !empty($CustomerIDs)) {
            $CustIDs = [];
            foreach ($CustomerIDs as $cIds) {
                array_push($CustIDs, $cIds->CustomerID);
            }
            $Vector->whereIn('vector_order.CustomerID', $CustIDs);
        }
        $VectorResult = $Vector->get();

        if (!empty($VectorResult)) {
            foreach ($VectorResult as $vectRes) {
                $CompleteResult[] = [
                    'OrderID' => $vectRes->VectorOrderID,
                    'OrderRef' => 'Vector',
                    'OrderDetailLink' => url('admin/Vec_order-details/' . $vectRes->VectorOrderID),
                    'PONumber' => $vectRes->PONumber,
                    'DesignName' => $vectRes->DesignName,
                    'CustomerName' => $vectRes->CustomerName,
                    'DesignerName' => $vectRes->DesignerName,
                    'OrderType' => $vectRes->OrderType,
                ];
            }
        }



        $this->data['SearchResult'] = $CompleteResult;

         // echo '<pre>'.print_r($CompleteResult, 1).'</pre>'; die;


        return view('admin.summary.SearchDetail', $this->data);

        if (Input::get('order') == 1) {
            $this->data['VectorOrders'] = DB::table('vector_order')
                    ->select('vector_order.*', 'customers.CustomerName', 'designers.DesignerName')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                    ->where('VectorOrderID', 'LIKE', '%' . Input::get('OrderNum') . "%")
                    ->where('PONumber', 'LIKE', '%' . Input::get('PoNum') . "%")
                    ->where('customers.CustomerName', 'LIKE', '%' . Input::get('Customer_Name') . "%")
                    ->where('designers.DesignerName', 'LIKE', '%' . Input::get('Designer_Name') . "%")
                    ->get();
            return view('admin.summary.VectorOrders', $this->data);
        } elseif (Input::get('order') == 2) {
            $this->data['DigiOrders'] = DB::table('digitizing_orders')
                    ->select('digitizing_orders.*', 'customers.CustomerName', 'designers.DesignerName')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                    ->where('OrderID', 'LIKE', '%' . Input::get('OrderNum') . "%")
                    ->where('PONumber', 'LIKE', '%' . Input::get('PoNum') . "%")
                    ->where('customers.CustomerName', 'LIKE', '%' . Input::get('Customer_Name') . "%")
                    ->where('designers.DesignerName', 'LIKE', '%' . Input::get('Designer_Name') . "%")
                    ->get();
            print_r($this->data['DigiOrders']);
            die;
            return view('admin.summary.NewOrders', $this->data);
        }
    }

    public function approve_vector_design($VectorOrderID) {
        \DB::table('vector_order')->where('VectorOrderID', $VectorOrderID)->update(['Status' => 5, 'OrderType' => 0, 'IsRead' => 1]);

        return redirect()->back()->with(['success' => "Approved to Designer Successfully"]);
    }

    public function approve_digi_design($OrderID) {
        \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update(['Status' => 5, 'OrderType' => 0, 'IsRead' => 1]);

        return redirect()->back()->with(['success' => "Approved to Designer Successfully"]);
    }

    public function send_vector_design($VectorOrderID) {

        $price = Input::get('OrderPrice');
        $SalesP = \Input::get('salesorp');
        $DesignP = \Input::get('designorp');

        \DB::table('vector_order')->where('VectorOrderID', $VectorOrderID)->update(['Status' => 7, 'MessageForCustomer' => Input::get('MessageForCustomer'), 'IsRead' => 2]);

        if (Input::has('FileForCustomer') && is_array(Input::get('FileForCustomer')) && count(Input::get('FileForCustomer')) > 0) {
            \DB::table('vector_result_files')->whereIn('VR_File_ID', Input::get('FileForCustomer'))->update(['ForCustomer' => 1]);
        }

        // Todays Work Sunday //
        $isRevisionSet = DB::table('vector_result_files')->select(DB::raw('MAX(RevisionSet) as RevisionSet'))
                ->where('VectorOrderID', $VectorOrderID)
                ->first();
        if (!empty($isRevisionSet)) {
            $myVar = $isRevisionSet->RevisionSet;
            $myVar++;
        } else {
            $myVar = 0;
        }

        if (!empty($price)) {
            \DB::table('vector_order')->where('VectorOrderID', $VectorOrderID)->update(['CustomerPrice' => $price, 'Price' => $price]);
        } if (!empty($SalesP)) {
            \DB::table('vector_order')->where('VectorOrderID', $VectorOrderID)->update(['SalesPrice' => $SalesP]);
        } if (!empty($DesignP)) {
            \DB::table('vector_order')->where('VectorOrderID', $VectorOrderID)->update(['DesignerPrice' => $DesignP]);
        }
        //echo $myVar; die;
        \DB::table('vector_result_files')->whereIn('VR_File_ID', Input::get('FileForCustomer'))->update(['ForCustomer' => 1, 'RevisionSet' => $myVar]);


        // E    N     D       Todays Work Sunday //
        $query = \App\vector_order::where('VectorOrderID', $VectorOrderID)
                ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                ->first();



        // \Mail::send(['html' => 'send_design_mail'], ['name' => 'Logo Artz', 'user' => $query->CustomerName, 'design' => 'Vector Design'], function ($message) use ($query) {
        //     $message->to($query->Email)->subject('Information');
        //     $message->from('technical-team@logoartz.com', 'Logo Artz');
        // });
        
        
            $CustomerName = $query->CustomerName;
          $this->data['mail'] = $query->Email;
            $designName = $query->DesignName;   
        
           $mailFrom = 'technical-team@logoartz.com';
                  \Mail::send('includes.emails.orderready', [
                  "CustomerName" => $CustomerName,
                  "OrderType" => 'vector order',
                  "designName" => $designName
                  ]
                    , function($message) use ($mailFrom) {
                $message->to($this->data['mail'])->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Order Complete');
            });
        
        return redirect('admin/Vec_order-details/' . $VectorOrderID)->with('success', 'Order Sent To Customer Successfully');
    }

    public function send_digi_design($OrderID) {
        // O R D E R 

        //1249 Vector



        $price = Input::get('OrderPrice');
        $SalesP = \Input::get('salesorp');
        $DesignP = \Input::get('designorp');


        \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update(['Status' => 7, 'MessageForCustomer' => Input::get('MessageForCustomer'), 'IsRead' => 2]);

        if (Input::has('FileForCustomer') && is_array(Input::get('FileForCustomer')) && count(Input::get('FileForCustomer')) > 0) {

            $isRevisionSet = DB::table('digi_result_files')->select(DB::raw('MAX(RevisionSet) as RevisionSet'))
                    ->where('OrderID', $OrderID)
                    ->first();
            if (!empty($isRevisionSet)) {
                $myVar = $isRevisionSet->RevisionSet;
                $myVar++;
            } else {
                $myVar = 0;
            }

            if (!empty($price)) {
                \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update(['CustomerPrice' => $price,
                 'Price' => $price]);
            }if (!empty($SalesP)) {
                \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update(['SalesPrice' => $SalesP]);
            }if (!empty($DesignP)) {
                \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update(['DesignerPrice' => $DesignP]);
            }

            //echo $myVar; die;
            \DB::table('digi_result_files')->whereIn('DR_File_ID', Input::get('FileForCustomer'))
                    ->update([
                        'ForCustomer' => 1,
                        'RevisionSet' => $myVar
            ]);
        }


        $query = \App\DigiOrders::where('OrderID', $OrderID)
                ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                ->first();
    



          $CustomerName = $query->CustomerName;
          $designName = $query->DesignName;
          $this->data['mail'] = $query->Email;

          
          
          if($query->OrderType == 1 || $query->OrderType == 9){
              
                $mailFrom = 'technical-team@logoartz.com';
                  \Mail::send('includes.emails.orderready', [
                  "CustomerName" => $CustomerName,
                  "OrderType" => 'digitizing revision',
                  "designName" => $designName
                  ]
                    , function($message) use ($mailFrom) {
                $message->to($this->data['mail'])->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Order Complete');
            });
            
          }else{
              
                   $mailFrom = 'technical-team@logoartz.com';
                  \Mail::send('includes.emails.orderready', [
                  "CustomerName" => $CustomerName,
                  "OrderType" => 'digitizing order',
                   "designName" => $designName
                  ]
                    , function($message) use ($mailFrom) {
                $message->to($this->data['mail'])->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Order Complete');
            });
            
              
          }
          
         
        return redirect('admin/Norder-details/' . $OrderID)->with('success', 'Order Sent To Customer Successfully');
    }

    public function order_revision($VectorOrderID) {
        
        $valid["DesignerID"] = 'required|integer|min:1';
        $valid["MessageForDesigner"] = 'required';
        $valid_name["MessageForDesigner"] = "Message For Designer";
        $valid_name["DesignerID"] = "Designer";
        $messages = [
            'required' => 'Please enter :attribute.',
             'DesignerID.min' => 'Please select :attribute.'
        ];
        $v = Validator::make(\Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {
            $type = 1;
            $status = 5;
            $order = \DB::table('vector_order')->where('VectorOrderID', $VectorOrderID)->first();
            if ($order->OrderType == 3 || $order->OrderType == 9 || $order->OrderType == 0) {
                $type = 9;
                $status = 10;
            } if($order->OrderType == 1){
            $status = 10;
            
         } 
            
            \DB::table('vector_order')->where('VectorOrderID', $VectorOrderID)->update(['AssignStatus' => 1, 'DesignerID' => \Input::get('DesignerID'), 'Status' => $status, 'IsRead' => 1]);
            $data = [
                'VectorOrderID' => $VectorOrderID,
                'From' => 1,
                'To' => 2,
                'RevisionType' => 1,
                'Message' => \Input::get('MessageForDesigner'),
                'DateAdded' => new \DateTime()
            ];
            \DB::table('vector_revision')->insert($data);
            return redirect('admin/Vec_order-details/' . $VectorOrderID)->with('success', 'Order Revision Sent To Designer Successfully');
        }
    }

    public function digi_order_revision($OrderID) {
       


        $valid["DesignerID"] = 'required|integer|min:1';
        $valid["MessageForDesigner"] = 'required';
        $valid_name["DesignerID"] = "Designer";
        $valid_name["MessageForDesigner"] = "Message For Designer";
        $messages = [
            'required' => 'Please enter :attribute.',
            'DesignerID.min' => 'Please select :attribute.'
        ];
        $v = Validator::make(\Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {
            $type = 1;
            $status = 5;
            $order = \DB::table('digitizing_orders')->where('OrderID', $OrderID)->first();
            if ($order->OrderType == 3 || $order->OrderType == 9 || $order->OrderType == 0) {
                $type = 9;
                $status = 10;
            }
            
        if($order->OrderType == 1){
            $status = 10;
        }        
            
            \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update(['AssignStatus' => 1,'DesignerID' => \Input::get('DesignerID'), 'Status' => $status, 'IsRead' => 1]);
           // MessageForDesigner
            
            $data = [
                'OrderID' => $OrderID,
                'From' => 1,
                'To' => 2,
                'RevisionType' => 1,
                'Message' => \Input::get('MessageForDesigner'),
                'DateAdded' => new \DateTime()
            ];
            \DB::table('digi_revision')->insert($data);
            return redirect('admin/Norder-details/' . $OrderID)->with('success', 'Order Revision Sent To Designer Successfully');
        }
    }

    public function quote_revision($vectorid) {
        
        $valid["Price"] = 'required';
        $messages = [
            'required' => 'Please enter :attribute.'
        ];
        $v = Validator::make(\Input::all(), $valid, $messages);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {
            \DB::table('vector_order')->where('VectorOrderID', $vectorid)->update(['CustomerPrice' => \Input::get('Price'), 'Status' => 3, 'OrderType' => 2, 'IsRead' => 2]);
            $data = [
                'VectorOrderID' => $vectorid,
                'From' => 1,
                'To' => 3,
                'RevisionType' => 2,
                'Message' => \Input::get('MessageForCustomer') . '<h6>New Price : $' . \Input::get('Price') . '.00</h6>',
                'DateAdded' => new \DateTime()
            ];
            \DB::table('vector_revision')->insert($data);
            return redirect('admin/Vec_order-details/' . $vectorid)->with('success', 'Order Revision Sent To Customer Successfully');
        }
    }

    public function status_update($orderid) {
        // if (Input::has('ReqFormat') && Input::get('ReqFormat') == "Other") {
        //     $valid["OtherFormat"] = 'required|max:100';
        // }

        $valid['Status'] = 'required|integer|min:0|max:3';
        $valid_name['Status'] = 'Change Status';

        $messages = [
            'required' => 'please Select Status',
            'Status.min' => 'please Select Status',
            'Status.max' => 'please Select Status',
        ];


        $v = Validator::make(Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);


        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {
            // {       echo "Successfully"; die;
            //$this->data['getorderdata'] = 0;
            //$getorderdata = \DB::table('digitizing_orders')->where('OrderID', $orderid)->first();

            \DB::table('digitizing_orders')->where('OrderID', $orderid)->update(['OrderType' => \Input::get('Status'), 'IsRead' => 0]);
            return redirect('admin/dashboard');
        }
    }

    public function digi_quote_revision($orderid) {
        $valid["Price"] = 'required';
        $messages = [
            'required' => 'Please enter :attribute.'
        ];
        $v = Validator::make(\Input::all(), $valid, $messages);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {
            \DB::table('digitizing_orders')->where('OrderID', $orderid)->update(['Status' => 3, 'OrderType' => 2, 'IsRead' => 2]);
            $data = [
                'OrderID' => $orderid,
                'From' => 1,
                'To' => 3,
                'RevisionType' => 2,
                'Message' => \Input::get('MessageForCustomer') . '<h6>New Price : $' . \Input::get('Price') . '.00</h6>',
                'DateAdded' => new \DateTime()
            ];
            \DB::table('digi_revision')->insert($data);
            return redirect('admin/Norder-details/' . $orderid)->with('success', 'Order Revision Sent To Customer Successfully');
        }
    }

    public function cus_acc_get(){
        $this->data['allcustomers'] = \DB::table('customers')->get();

        return view('admin.summary.accounts.cus_acc', $this->data);

    }

    public function get_all_cus_acc() {
        $From = \Input::get('DateFrom');
        $To = \Input::get('DateTo');
        $getcusid = \Input::get('cusname');
        $this->data['CustomerID'] = $getcusid;

        $this->data['allcustomers'] = \DB::table('customers')->get();
        $this->data['DigiOrders'] = \App\DigiOrders::select('digitizing_orders.OrderID', 'CustomerName', 'DesignName', 'PONumber', 'Price', 'digitizing_orders.DateAdded', 'digitizing_orders.IsRead')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                ->whereBetween(DB::Raw('date(digitizing_orders.DateAdded)'), array($From, $To))
                ->whereIn('digitizing_orders.Status', [7, 8])
                ->where('digitizing_orders.CustomerID', $getcusid)
                ->orderby('digitizing_orders.OrderID', 'desc')
                ->get();

        $this->data['VecOrders'] = \App\vector_order::select('vector_order.VectorOrderID', 'CustomerName', 'DesignName', 'PONumber', 'Price', 'vector_order.DateAdded', 'vector_order.IsRead')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                ->whereBetween(DB::Raw('date(vector_order.DateAdded)'), array($From, $To))
                ->whereIn('vector_order.Status', [7, 8])
                ->where('vector_order.CustomerID', $getcusid)
                ->orderby('vector_order.VectorOrderID', 'desc')
                ->get();


        return view('admin.summary.accounts.cus_acc', $this->data);
    }

 public function generate_cus_inv() {
        // echo '<pre>'.print_r(Input::all(), 1).'</pre>'; die;

    $DPrices = 0;
    $VPrices = 0;




        if (Input::has('DOrderIDs') || Input::has('VOrderIDs') && Input::has('CustomerID')) {
            $DOrderIds = \Input::get('DOrderIDs');
            $VOrderIds = \Input::get('VOrderIDs');
            $CustomerID = \Input::get('CustomerID');

// echo '<pre>'.print_r($VOrderIds, 1).'</pre>'; die;

            $this->data['DOrderIDs'] = $DOrderIds;
            $this->data['VOrderIDs'] = $VOrderIds;
            $this->data['CustomerID'] = $CustomerID;


            $this->data['Customer'] = DB::table('customers')->where('CustomerID', $CustomerID)->first();

            if (empty($this->data['Customer'])) {
                return redirect('admin/digi/accounts')->with('warning_msg', "Invalid Customer");
            }


            if($this->data['DOrderIDs'] != ''){

                $this->data['DigiOrders'] = \App\DigiOrders::whereIn('digitizing_orders.OrderID', $DOrderIds)
                    ->orderby('digitizing_orders.OrderID', 'desc')
                    ->get();
                      $DOrdersData = $this->data['DigiOrders'];

            }
          
            if($this->data['VOrderIDs'] != ''){

                 $this->data['VecOrders'] = \App\vector_order::whereIn('vector_order.VectorOrderID', $VOrderIds)
                    ->orderby('vector_order.VectorOrderID', 'desc')
                    ->get();
              $VOrderData  = $this->data['VecOrders'];
            }

           
    

            if(!empty($this->data['DigiOrders'])) {

               foreach($this->data['DigiOrders'] as $Price_str)
                 {
                $DPrices = $DPrices + $Price_str->Price;
                //  echo $Price_str->Price.'<br>';
                 }
             }

            if(!empty($this->data['VecOrders'])) {

                foreach($this->data['VecOrders'] as $Price_str)
                 {
                $VPrices = $VPrices + $Price_str->Price;
             //   echo $Price_str->Price.'<br>';
                 }
            }


            // echo "Pricess:".'<br>';
            // echo 'Digi Price:'.$DPrices.'<br>';
            // echo 'Vector Price:'.$VPrices.'<br>';



            // die;


            if($DPrices >  0){
                $Prices = $DPrices;
            }
            if($VPrices >  0){
                $Prices = $DPrices + $VPrices;
            }


           $this->data['TotalPrice'] = $Prices;

           $this->data['todaydate'] = date("d-m-Y");

           // $Due =  explode('-',  $this->data['todaydate']);
           // $Dueday = $Due[0] + 4;
           // $Duedate = $Dueday .'-'. $Due[1] .'-'. $Due[2];

             // $this->data['Duedate'] =  $Duedate;

            return view('admin.summary.accounts.cus_invoice', $this->data);
        } else {
            return redirect('admin/digi/accounts')->with('warning_msg', "Invalid Customer Or Order");
        }
    }




    public function digi_acc_get() {

        $this->data['allcustomers'] = \DB::table('customers')->get();

        return view('admin.summary.accounts.digi_acc', $this->data);
    }

    public function vec_acc_get() {
        $this->data['allcustomers'] = \DB::table('customers')->get();
        return view('admin.summary.accounts.vec_acc', $this->data);
    }

    public function get_all_dacc_req() {
        $From = \Input::get('DateFrom');
        $To = \Input::get('DateTo');
        $getcusid = \Input::get('cusname');
        $this->data['CustomerID'] = $getcusid;

        $this->data['allcustomers'] = \DB::table('customers')->get();
        $this->data['Orders'] = \App\DigiOrders::select('digitizing_orders.OrderID', 'CustomerName', 'DesignName', 'PONumber', 'Price', 'digitizing_orders.IsRead')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                ->whereRaw('digitizing_orders.DateAdded BETWEEN "' . $From . '" AND "' . $To . '"')
                ->whereIn('digitizing_orders.Status', [7, 8])
                ->where('digitizing_orders.CustomerID', $getcusid)
                ->orderby('digitizing_orders.OrderID', 'desc')
                ->get();

        return view('admin.summary.accounts.digi_acc', $this->data);
    }

    public function generate_digi_inv() {
        // echo '<pre>'.print_r(Input::all(), 1).'</pre>'; die;
        $this->data['type'] = 'Digitizing';

        if (Input::has('OrderIDs') && Input::has('CustomerID')) {
            $OrderIds = \Input::get('OrderIDs');
            $CustomerID = \Input::get('CustomerID');

            $this->data['OrderIDs'] = $OrderIds;
            $this->data['CustomerID'] = $CustomerID;

            // dd($OrderIds); die;

            $this->data['Customer'] = DB::table('customers')->where('CustomerID', $CustomerID)->first();

            if (empty($this->data['Customer'])) {
                return redirect('admin/digi/accounts')->with('warning_msg', "Invalid Customer");
            }

            $this->data['Orders'] = \App\DigiOrders::whereIn('digitizing_orders.OrderID', $OrderIds)
                    ->orderby('digitizing_orders.OrderID', 'desc')
                    ->get();

            $OrdersData = $this->data['Orders'];

            $Prices = 0;
            foreach($OrdersData as $Price_str)
            {
                $Prices = $Prices + $Price_str->Price;
            }

           $this->data['TotalPrice'] = $Prices;

           $this->data['todaydate'] = date("d:m:Y");

           $Due =  explode(':',  $this->data['todaydate']);
           $Dueday = $Due[0] + 4;
           $Duedate = $Dueday .':'. $Due[1] .':'. $Due[2];

          $this->data['Duedate'] =  $Duedate;


          // $TodayDate = date('d-m-Y', strtotime($OrdersData->DateAdded));

              // dd($date); 

         //   echo $TodayDate; die; 




            return view('admin.summary.accounts.digi_invoice', $this->data);
        } else {
            return redirect('admin/digi/accounts')->with('warning_msg', "Invalid Customer Or Order");
        }
    }

    public function send_digi_inv() {
//         echo '<pre>'.print_r(Input::all(), 1).'</pre>'; die;
       // echo public_path('').'/invoices/my_stored_file.pdf'; die;
        $this->data['type'] = 'Digitizing';

        if (Input::has('orderids') && Input::has('CustomerID')) {
            $OrderIds = \Input::get('orderids');
            $CustomerID = \Input::get('CustomerID');

            // dd($OrderIds); die;
            $this->data['CustomerID'] = $CustomerID;

            $this->data['Customer'] = DB::table('customers')->where('CustomerID', $CustomerID)->first();

            $CustomerData =  $this->data['Customer'];

            if (empty($this->data['Customer'])) {
                return redirect('admin/digi/accounts')->with('warning_msg', "Invalid Customer");
            }

            $this->data['Orders'] = \App\DigiOrders::whereIn('digitizing_orders.OrderID', $OrderIds)
                    ->orderby('digitizing_orders.OrderID', 'desc')
                    ->get();

            $OrdersData = $this->data['Orders'];       
            $Prices = 0;
            foreach($OrdersData as $Price_str)
            {
                $Prices = $Prices + $Price_str->Price;
            }

           $this->data['TotalPrice'] = $Prices;
           $this->data['todaydate'] = date("d:m:Y");

           $Due =  explode(':',  $this->data['todaydate']);
           $Dueday = $Due[0] + 4;
           $Duedate = $Dueday .':'. $Due[1] .':'. $Due[2];

          $this->data['Duedate'] =  $Duedate;



            $fileName = str_random(5) . '-' . $CustomerID . '-' . str_random(5) . '.pdf';

            $pdf = PDF::loadView('admin.summary.accounts.print_digi_invoice', $this->data)
                    ->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
                    ->save(public_path('') . '/invoices/' . $fileName);

            $ToEmail = 'CustomerEmailAddress';
            $From = 'accounts@logoartz.com';

            $ToEmail = $CustomerData->Email;

            \Mail::send('includes.emails.invoice', [
                "CustomerName" => 'Umer'
                    ], function($message) use ($ToEmail, $From, $fileName) {
                $message->to($ToEmail)
                        ->from($From, "LogoArtz Accounts Department")
                        ->subject("Invioce")
                        ->attach(public_path('').'/invoices/' . $fileName, ['mime' => 'application/pdf']);
            });

           return redirect('admin/vector/accounts')->with('success', 'Send Invoice Successfully');

//            return $pdf->download('invoice.pdf');
//            return view('admin.summary.accounts.digi_invoice', $this->data);
        } else {
            return redirect('admin/digi/accounts')->with('warning_msg', "Invalid Customer Or Order");
        }
    }



public function generate_vec_inv() {
       // echo '<pre>'.print_r(Input::all(), 1).'</pre>'; die;
        $this->data['type'] = 'Vector';

        $CustomerID = \Input::get('CustomerID');

        if (Input::has('OrderIDs') && Input::has('CustomerID')) {
            $OrderIds = \Input::get('OrderIDs');
            $CustomerID = \Input::get('CustomerID');

            $this->data['OrderIDs'] = $OrderIds;
            $this->data['CustomerID'] = $CustomerID;

            // dd($OrderIds); die;

            $this->data['Customer'] = DB::table('customers')->where('CustomerID', $CustomerID)->first();

            if (empty($this->data['Customer'])) {
                return redirect('admin/vector/accounts')->with('warning_msg', "Invalid Customer");
            }

            $this->data['Orders'] = \App\vector_order::whereIn('vector_order.VectorOrderID', $OrderIds)
                    ->orderby('vector_order.VectorOrderID', 'desc')
                    ->get();
            $OrdersData = $this->data['Orders'];

            $Prices = 0;
            foreach($OrdersData as $Price_str)
            {
                $Prices = $Prices + $Price_str->Price;
            }

            $this->data['TotalPrice'] = $Prices;

           $this->data['todaydate'] = date("d:m:Y");

           $Due =  explode(':',  $this->data['todaydate']);
           $Dueday = $Due[0] + 4;
           $Duedate = $Dueday .':'. $Due[1] .':'. $Due[2];

          $this->data['Duedate'] =  $Duedate;




            return view('admin.summary.accounts.vec_invoice', $this->data);
        } else {
            return redirect('admin/vector/accounts')->with('warning_msg', "Invalid Customer Or Order");
        }
    }

    public function send_vec_inv() {
//         echo '<pre>'.print_r(Input::all(), 1).'</pre>'; die;
       // echo public_path('').'/invoices/my_stored_file.pdf'; die;
        $this->data['type'] = 'Vector';

        if (Input::has('orderids') && Input::has('CustomerID')) {
            $OrderIds = \Input::get('orderids');
            $CustomerID = \Input::get('CustomerID');

            // dd($OrderIds); die;
            $this->data['CustomerID'] = $CustomerID;

            $this->data['Customer'] = DB::table('customers')->where('CustomerID', $CustomerID)->first();

            $CustomerData =  $this->data['Customer'];

            if (empty($this->data['Customer'])) {
                return redirect('admin/vector/accounts')->with('warning_msg', "Invalid Customer");
            }

            $this->data['Orders'] = \App\vector_order::whereIn('vector_order.VectorOrderID', $OrderIds)
                    ->orderby('vector_order.VectorOrderID', 'desc')
                    ->get();

            $OrdersData = $this->data['Orders'];       
            $Prices = 0;
            foreach($OrdersData as $Price_str)
            {
                $Prices = $Prices + $Price_str->Price;
            }

            $this->data['TotalPrice'] = $Prices;

           $this->data['todaydate'] = date("d:m:Y");

           $Due =  explode(':',  $this->data['todaydate']);
           $Dueday = $Due[0] + 4;
           $Duedate = $Dueday .':'. $Due[1] .':'. $Due[2];

            $this->data['Duedate'] =  $Duedate;
  


            $fileName = str_random(5) . '-' . $CustomerID . '-' . str_random(5) . '.pdf';

            $pdf = PDF::loadView('admin.summary.accounts.print_vec_invoice', $this->data)
                    ->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
                    ->save(public_path('') . '/invoices/' . $fileName);

            $ToEmail = 'CustomerEmailAddress';
            $From = 'accounts@logoartz.com';

            $ToEmail = $CustomerData->Email;

            \Mail::send('includes.emails.invoice', [
                "CustomerName" => 'Umer'
                    ], function($message) use ($ToEmail, $From, $fileName) {
                $message->to($ToEmail)
                        ->from($From, "LogoArtz Accounts Department")
                        ->subject("Invioce")
                        ->attach(public_path('').'/invoices/' . $fileName, ['mime' => 'application/pdf']);
            });

           return redirect('admin/vector/accounts')->with('success', 'Send Invoice Successfully');


//            return $pdf->download('invoice.pdf');
//            return view('admin.summary.accounts.digi_invoice', $this->data);
        } else {
            return redirect('admin/vector/accounts')->with('warning_msg', "Invalid Customer Or Order");
        }

    }


    public function get_all_vacc_req() {
        $From = \Input::get('DateFrom');
        $To = \Input::get('DateTo');
        $getcusid = \Input::get('cusname');
        $this->data['CustomerID'] = $getcusid;

        $this->data['allcustomers'] = \DB::table('customers')->get();
        $this->data['Orders'] = \App\vector_order::select('vector_order.VectorOrderID', 'CustomerName', 'DesignName', 'PONumber', 'Price', 'vector_order.IsRead')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                ->whereRaw('vector_order.DateAdded BETWEEN "' . $From . '" AND "' . $To . '"')
                ->whereIn('vector_order.Status', [7, 8])
                ->where('vector_order.CustomerID', $getcusid)
                ->orderby('vector_order.VectorOrderID', 'desc')
                ->get();

        return view('admin.summary.accounts.vec_acc', $this->data);
    }

    public function designer_acc() {

        $this->data['designers'] = \App\Designers::get();

        return view('admin.summary.accounts.dec_acc', $this->data);
    }

    public function desi_acc_detail() {

        $From = \Input::get('DateFrom');
        $To = \Input::get('DateTo');
        $getdesid = \Input::get('desname');


        $this->data['designers'] = \App\Designers::get();

        $this->data['OrdersVec'] = \App\vector_order::select('vector_order.VectorOrderID', 'DesignName', 'PONumber', 'DesignerPrice', 'DesignerName', 'vector_order.IsRead', 'vector_order.DateAdded')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                ->whereBetween(DB::Raw('date(vector_order.DateAdded)'), array($From, $To))
                ->where('vector_order.Status', 7)
                ->where('vector_order.DesignerID', $getdesid)
                ->orderby('vector_order.VectorOrderID', 'desc')
                ->get();

        $this->data['OrdersDigi'] = \App\DigiOrders::select('digitizing_orders.OrderID', 'DesignName', 'PONumber', 'DesignerPrice', 'DesignerName', 'digitizing_orders.IsRead', 'digitizing_orders.DateAdded')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                ->whereBetween(DB::Raw('date(digitizing_orders.DateAdded)'), array($From, $To))
                ->where('digitizing_orders.Status', 7)
                ->where('digitizing_orders.DesignerID', $getdesid)
                ->orderby('digitizing_orders.OrderID', 'desc')
                ->get();

        return view('admin.summary.accounts.dec_acc', $this->data);
    }

    public function sales_acc() {

        $this->data['salesrep'] = \App\SalesPerson::get();

        return view('admin.summary.accounts.sales_acc', $this->data);
    }

    public function sales_acc_detail() {

        $From = \Input::get('DateFrom');
        $To = \Input::get('DateTo');
        $getsalesid = \Input::get('salesname');


        $this->data['salesrep'] = \App\SalesPerson::get();

        $this->data['OrdersVec'] = \App\vector_order::select('vector_order.VectorOrderID', 'DesignName', 'SalesPersonName','DesignerName', 'PONumber', 'SalesPrice', 'vector_order.IsRead', 'vector_order.DateAdded')
                ->leftjoin('salesperson', 'salesperson.SalesPersonID', '=', 'vector_order.SalesPersonID')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                ->whereBetween(DB::Raw('date(vector_order.DateAdded)'), array($From, $To))
                ->where('vector_order.Status', 7)
                ->where('vector_order.SalesPersonID', $getsalesid)
                ->orderby('vector_order.VectorOrderID', 'desc')
                ->get();

        $this->data['OrdersDigi'] = \App\DigiOrders::select('digitizing_orders.OrderID', 'DesignName', 'DesignerName', 'SalesPersonName', 'PONumber', 'SalesPrice', 'digitizing_orders.IsRead', 'digitizing_orders.DateAdded')
                ->leftjoin('salesperson', 'salesperson.SalesPersonID', '=', 'digitizing_orders.SalesPersonID')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                ->whereBetween(DB::Raw('date(digitizing_orders.DateAdded)'), array($From, $To))
                ->where('digitizing_orders.Status', 7)
                ->where('digitizing_orders.SalesPersonID', $getsalesid)
                ->orderby('digitizing_orders.OrderID', 'desc')
                ->get();

        return view('admin.summary.accounts.sales_acc', $this->data);
    }

}
