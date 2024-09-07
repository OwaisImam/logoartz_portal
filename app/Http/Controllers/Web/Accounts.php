<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Input;
use Hash;
use DB;
use PDF;
use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Accounts extends CustomerController
{
   
    function __construct() {
        parent::__construct();
    }

   
   public function getallinvoices(){

   		$this->data['Invoices'] = '';

   		$customer_id = \Session::get("CustomerID");
    
   		if($customer_id > 0)
   		{
   		   $this->data['Invoices'] = \App\invoice::where('customer_id', $customer_id)->orderBy('created_at', 'DESC')->get();

   		   return view('finance.invoices_list', $this->data);
   		}else{
   			  return redirect('/CustomerDash')->with('warning_msg', "Something Went Wrong!! Contact Logoartz Team");
   		}
   }

   public function cus_accounts_summary(Request $request)
   {
       $from = $request->input('from');
       $to = $request->input('to');
       $orderType = $request->input('order_type');
       $customerID = session('CustomerID');
   
       $this->data['CustomerID'] = $customerID;
       $this->data['OrderTypes'] = config('order_types');

          switch ($orderType) {
              case 1:
                  // Only Digitizing Orders
                  $this->data['DigiOrders'] = \App\DigiOrders::select(
                      'digitizing_orders.OrderID',
                      'CustomerName',
                      'DesignName',
                      'PONumber',
                      'Price',
                      'OrderType',
                      'digitizing_orders.DateAdded',
                      'digitizing_orders.IsRead'
                  )
                  ->leftJoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                  ->whereBetween(DB::raw('date(digitizing_orders.DateAdded)'), [$from, $to])
                  ->where('digitizing_orders.Status', 7)
                  ->whereNotIn('digitizing_orders.OrderType', [2, 4])
                  ->where('digitizing_orders.CustomerID', $customerID)
                  ->orderByDesc('digitizing_orders.OrderID')
                  ->get();
                  break;
  
              case 2:
                  // Only Vector Orders
                  $this->data['VecOrders'] = \App\vector_order::select(
                      'vector_order.VectorOrderID',
                      'CustomerName',
                      'DesignName',
                      'PONumber',
                      'Price',
                      'OrderType',
                      'vector_order.DateAdded',
                      'vector_order.IsRead'
                  )
                  ->leftJoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                  ->whereBetween(DB::raw('date(vector_order.DateAdded)'), [$from, $to])
                  ->where('vector_order.Status', 7)
                  ->whereNotIn('vector_order.OrderType', [2, 4])
                  ->where('vector_order.CustomerID', $customerID)
                  ->orderByDesc('vector_order.VectorOrderID')
                  ->get();
                  break;
  
              default:
                  // All Orders
                  $this->data['DigiOrders'] = \App\DigiOrders::select(
                      'digitizing_orders.OrderID',
                      'CustomerName',
                      'DesignName',
                      'PONumber',
                      'Price',
                      'OrderType',
                      'digitizing_orders.DateAdded',
                      'digitizing_orders.IsRead'
                  )
                  ->leftJoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                  ->where('digitizing_orders.Status', 7)
                  ->whereNotIn('digitizing_orders.OrderType', [2, 4])
                  ->where('digitizing_orders.CustomerID', $customerID)
                  ->orderByDesc('digitizing_orders.OrderID')
                  ->get();
  
                  $this->data['VecOrders'] = \App\vector_order::select(
                      'vector_order.VectorOrderID',
                      'CustomerName',
                      'DesignName',
                      'PONumber',
                      'Price',
                      'OrderType',
                      'vector_order.DateAdded',
                      'vector_order.IsRead'
                  )
                  ->leftJoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                  ->whereBetween(DB::raw('date(vector_order.DateAdded)'), [$from, $to])
                  ->where('vector_order.Status', 7)
                  ->whereNotIn('vector_order.OrderType', [2, 4])
                  ->where('vector_order.CustomerID', $customerID)
                  ->orderByDesc('vector_order.VectorOrderID')
                  ->get();
                  break;
         }
        return view('finance.accounts_summary', $this->data);
       
   }

}
