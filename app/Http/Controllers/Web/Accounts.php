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
    public function __construct()
    {
        parent::__construct();
    }


    public function getallinvoices()
    {

        $this->data['Invoices'] = '';

        $customer_id = \Session::get("CustomerID");

        if ($customer_id > 0) {
            $this->data['Invoices'] = \App\invoice::where('customer_id', $customer_id)->orderBy('created_at', 'DESC')->get();

            return view('finance.invoices_list', $this->data);
        } else {
            return redirect('/CustomerDash')->with('warning_msg', "Something Went Wrong!! Contact Logoartz Team");
        }
    }

    public function cus_accounts_summary(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');
        $customerID = session('CustomerID');
        
        // Start building the query
        $query = \App\invoice::where('customer_id', $customerID);
        
        // Apply filters for date range if provided
        if (!empty($from)) {
            $query->whereDate('created_at', '>=', $from);
        }
        
        if (!empty($to)) {
            $query->whereDate('created_at', '<=', $to);
        }
        
        // Retrieve filtered results, ordered by latest first
        $this->data['Invoices'] = $query->orderBy('id', 'DESC')->get();
        
        return view('finance.accounts_summary', $this->data);

    }

}
