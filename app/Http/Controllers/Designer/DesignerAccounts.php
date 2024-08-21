<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\DesignerController;
use Illuminate\Support\Facades\Input;
use admin\summary\history\historyindi;
use Validator;
use DB;
use PDF;


class DesignerAccounts extends DesignerController
{
   public function getallinvoices(){

   		$this->data['Invoices'] = '';

   		$customer_id = \Session::get("CustomerID");
   		if($customer_id > 0)
   		{
   		   $this->data['Invoices'] = \App\invoice::where('customer_id', $customer_id)->get();
   		   return view('invoices_list', $this->data);
   		}else{
   			  return redirect('/CustomerDash')->with('warning_msg', "Something Went Wrong!! Contact Logoartz Team");
   		}
   }


 public function decAccGet(){
      //  $this->data['allcustomers'] = \DB::table('customers')->get();
     return view('designer.summary.accounts.accounts', $this->data);

    }



public function search_record() {
   // return view('designer.summary.accounts.historyindi', $this->data);

        $To = Input::get('DateTo');
        $From = Input::get('DateFrom');
        $Cat = \Session::get('Dcatagory');
        $d_id = \Session::get('DesignerID');
        $or_cat = Input::get('order_type');

     // dd($d_id);


  if ($To != "" && $From != "" && $Cat != "" && $d_id > 0 && $or_cat > 0){

        $this->data['or_type'] = $or_cat;
        if($or_cat == 1){
          $type = [0, 1, 3, 9];
        }else{
             $type = [2, 4];
        }

    $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');


        if (!empty($To || $From || $Cat)) {

            if ($Cat == 2) {

                $this->data['Cat'] = 2;

                $this->data['Orders'] = \App\DigiOrders::select('digitizing_orders.OrderID', 'CustomerName', 'DesignName', 'PONumber', 'OrderType', 'DesignerPrice' )
                        ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                        ->whereBetween(DB::Raw('date(digitizing_orders.DateAdded)'), array($From, $To))
                        ->where('digitizing_orders.DesignerID', $d_id)
                        ->where('digitizing_orders.Status', 7)
                        ->whereIn('digitizing_orders.OrderType', $type)
                        ->orderby('digitizing_orders.OrderID', 'desc')
                        ->get();
                // echo '<pre>'.print_r(DB::getQueryLog(), 1).'</pre>';
              return view('designer.summary.accounts.accounts', $this->data);
            } else if ($Cat == 1) {
               
                $this->data['Cat'] = 1;

                $this->data['Orders'] = \App\vector_order::select('VectorOrderID', 'CustomerName', 'DesignName', 'PONumber', 'OrderType', 'DesignerPrice')
                        ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                        ->whereRaw('vector_order.DateAdded BETWEEN "' . $From . '" AND "' . $To . '"')
                        ->where('vector_order.Status', 7)
                         ->where('vector_order.DesignerID', $d_id)
                        ->where('vector_order.OrderType', '!=', 2)
                        ->where('vector_order.OrderType', '!=', 4)
                        ->orderby('vector_order.VectorOrderID', 'desc')
                        ->get();


           return view('designer.summary.accounts.accounts', $this->data);  } else {
                return redirect('designer/acc/accounts');
            }
        } else {
            return redirect('designer/acc/accounts')->with('warning_msg', "Invalid Selecttion");
        }


          
        }else{
        return redirect('designer/acc/accounts')->with('warning_msg', "Selection Not Valid");
        }

    
    }
    












}
