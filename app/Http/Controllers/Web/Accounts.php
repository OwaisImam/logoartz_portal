<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Input;
use Validator;
use Hash;
use DB;
use PDF;
use App;


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

   public function cus_accounts_summary(){
      return view('finance.accounts_summary', $this->data);
        
   }


  public function get_accounts_record()
  {
        $valid["from"] = 'required';
        $valid["to"] = 'required';


        $valid_name["from"] = "from date";
        $valid_name["to"]   = "to date ";

         $messages = [
            'required' => 'Please select :attribute.'
        ];

        $v = Validator::make(Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);


        if ($v->fails()) {

                return redirect()->back()->withErrors($v->errors())->withInput();
        } else{


        $From = \Input::get('from');
        $To = \Input::get('to');
        $orderType = \Input::get('order_type');
        $getcusid = \Session::get('CustomerID');
        $this->data['CustomerID'] = $getcusid;
        $this->data['OrderTypes'] = Config('order_types');

          if ($From != "" && $To != ""){

                if ($orderType == 1){
                      // Only Digitizing Get
                      $this->data['DigiOrders'] = \App\DigiOrders::select('digitizing_orders.OrderID', 'CustomerName', 'DesignName', 'PONumber', 'Price', 'OrderType','digitizing_orders.DateAdded', 'digitizing_orders.IsRead')
                      ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                      ->whereBetween(DB::Raw('date(digitizing_orders.DateAdded)'), array($From, $To))
                      ->where('digitizing_orders.Status', 7)
                      ->where('digitizing_orders.OrderType', '!=' , 2)
                      ->where('digitizing_orders.OrderType', '!=' , 4)
                      ->where('digitizing_orders.CustomerID', $getcusid)
                      ->orderby('digitizing_orders.OrderID', 'desc')
                      ->get();

                      return view('finance.accounts_summary', $this->data);

                } elseif($orderType == 2){
                       // Only Vector Get
                      $this->data['VecOrders'] = \App\vector_order::select('vector_order.VectorOrderID', 'CustomerName', 'DesignName', 'PONumber', 'Price', 'OrderType', 'vector_order.DateAdded', 'vector_order.IsRead')
                        ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                        ->whereBetween(DB::Raw('date(vector_order.DateAdded)'), array($From, $To))
                        ->where('vector_order.Status', 7)
                        ->where('vector_order.OrderType', '!=' , 2)
                        ->wherenotIn('vector_order.OrderType', '!=' , 4)
                        ->where('vector_order.CustomerID', $getcusid)
                        ->orderby('vector_order.VectorOrderID', 'desc')
                        ->get();

                        return view('finance.accounts_summary', $this->data);

                }else{
                       // Get All Data From Orders
                     $this->data['DigiOrders'] = \App\DigiOrders::select('digitizing_orders.OrderID', 'CustomerName', 'DesignName', 'PONumber', 'Price', 'OrderType', 'digitizing_orders.DateAdded', 'digitizing_orders.IsRead')
                      ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                      ->whereBetween(DB::Raw('date(digitizing_orders.DateAdded)'), array($From, $To))
                      ->where('digitizing_orders.Status', 7)
                      ->where('digitizing_orders.OrderType', '!=' , 2)
                      ->where('digitizing_orders.OrderType', '!=' , 4)
                      ->where('digitizing_orders.CustomerID', $getcusid)
                      ->orderby('digitizing_orders.OrderID', 'desc')
                      ->get();

                      $this->data['VecOrders'] = \App\vector_order::select('vector_order.VectorOrderID', 'CustomerName', 'DesignName', 'PONumber', 'Price', 'OrderType', 'vector_order.DateAdded', 'vector_order.IsRead')
                      ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                      ->whereBetween(DB::Raw('date(vector_order.DateAdded)'), array($From, $To))
                      ->where('vector_order.Status', 7)
                      ->where('vector_order.OrderType', '!=' , 2)
                      ->where('vector_order.OrderType', '!=' , 4)
                      ->where('vector_order.CustomerID', $getcusid)
                      ->orderby('vector_order.VectorOrderID', 'desc')
                      ->get();

                      return view('finance.accounts_summary', $this->data);

                    }

          }else{
                 return redirect('/CustomerDash')->with('warning_msg', "Something Went Wrong!! Please Try Again");
          }
    


        }
        




       
  }







}
