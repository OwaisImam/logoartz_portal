<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Input;
use Validator;
use Hash;
use DB;

class User extends CustomerController {

    function __construct() {
        parent::__construct();
    }



    public function CusDashboard() {
//        echo '<pre>'.print_r(\Session::all(), 1).'</pre>'; die;

        if (!\Session::has('CustomerLogin')) {
            return redirect('login');
        }

        $CustomerID = \Session::get('CustomerID');


       // where([['OrderType', '=', 0],['CustomerID', '=', $CustomerID],]);
        $this->data['count_digi_new_orders'] = \App\DigiOrders::where('CustomerID', '=', $CustomerID)->where('Status', '!=', 7)->whereIn('OrderType', [0, 3])->count();


        $this->data['count_digi_order_revision'] = \App\DigiOrders::where('CustomerID', '=', $CustomerID)->where('Status', '!=', 7)->whereIn('OrderType', [1, 9])->count();
        
        $this->data['count_digi_new_quote'] = \App\DigiOrders::where([['OrderType', '=', 2], ['CustomerID', '=', $CustomerID],])->where('Status', '!=', 7)->count();

        $this->data['count_vector_new_orders'] = \App\vector_order::where('CustomerID', '=', $CustomerID)->where('Status', '!=', 7)->whereIn('OrderType', [0, 3])->count();

        $this->data['count_vector_order_revision'] = \App\vector_order::where('CustomerID', '=', $CustomerID)->where('Status', '!=', 7)->whereIn('OrderType', [1, 9])->count();

        $this->data['count_vector_new_quote'] = \App\vector_order::where([['OrderType', '=', 2], ['CustomerID', '=', $CustomerID],])->count();

        $this->data['invoices'] = \App\invoice::where('customer_id', '=', $CustomerID)->count();




        $this->data['digiOrderRev'] = \App\DigiOrders::where([['OrderType', '=', 1], ['CustomerID', '=', $CustomerID],])->count();
        $this->data['VectorOrderRev'] = \App\vector_order::where([['OrderType', '=', 1], ['CustomerID', '=', $CustomerID],])->count();

        //$this->data['RiviCount'] = $digiOrderRev + $VectorOrderRev;





        return view('customer_das', $this->data);
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

    public function currencies_dd() {
        $query = \App\Currencies::where('Status', 1);
        $parents = $query->select('Code', 'CurrencyID')->get();
        $parent_pages = ["0" => "Select Currency"];
        if (count($parents) > 0) {
            foreach ($parents as $parent) {
                $parent_pages += [
                    $parent->CurrencyID => $parent->Code
                ];
            }
        }
        return $parent_pages;
    }

    public function update_cus() {



        if (\Session::has('CustomerLogin')) {

            $CustomerID = \Session::get('CustomerID');
        }

        $this->data['countries_dd'] = $this->countries_dd();
        $this->data['currencies_dd'] = $this->currencies_dd();
        $this->data['hear_about_dd'] = \Config::get('hear_about');
        $this->data['card_types_dd'] = \Config::get('card_types');

        $CusData['Customer'] = DB::table('customers')->where('CustomerID', $CustomerID)->first();


        return view('customerupdate', $this->data, $CusData);
    }

    public function up_cus_info($id) {
// echo '<pre>'.print_r(Input::all(), 1).'</pre>'; die;
        $this->data['countries_dd'] = $this->countries_dd();
        $this->data['currencies_dd'] = $this->currencies_dd();
        $this->data['hear_about_dd'] = \Config::get('hear_about');
        $this->data['card_types_dd'] = \Config::get('card_types');
// //        return view('register', $this->data);
// //        exit();
        $valid["CustomerName"] = 'required|max:20';
        $valid["Cell"] = 'required|max:20';
        $valid["Fax"] = 'max:100';
        $valid["Company"] = 'required|max:100';
        $valid["State"] = 'max:100';
        $valid["City"] = 'max:100';
        $valid["Address"] = 'required|max:1000';
        $valid["Zip"] = 'max:20';
        $valid["CountryID"] = 'required|integer|min:1';
        $valid["CurrencyID"] = 'integer|min:1';
        $valid["HearAbout"] = 'integer|min:1';
        $valid["Password"] = 'max:20';


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
  

        $messages = [
            'required' => 'Please enter :attribute.',
            'CountryID.min' => 'Please select :attribute.',
            'max' => 'No more characters allowed in :attribute.',
            'unique' => ':attribute is already registered.'
        ];

        $v = Validator::make(Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {



            $cat = \App\Customers::find($id);

            $cat->CustomerName = Input::get('CustomerName');
            $cat->Cell = Input::get('Cell');
            $cat->Fax = Input::get('Fax');
            $cat->Company = Input::get('Company');
            $cat->CountryID = Input::get('CountryID');
            $cat->State = Input::get('State');
            $cat->City = Input::get('City');
            $cat->Address = Input::get('Address');
            $cat->Zip = Input::get('Zip');
            $cat->Username = Input::get('Username');
            $cat->CountryID = Input::get('CountryID');
            $cat->CurrencyID = Input::get('CurrencyID');
            $cat->HearAbout = Input::get('HearAbout');

            if (Input::has('Password') && Input::get('Password') != "") {
                $cat->Password = \Hash::make(Input::get('Password'));
            }
            $cat->DateModified = new \DateTime;

            $cat->save();

             return redirect('CustomerDash')->with('success', 'Updated Successfully');

        }
    }

public function bill_check_validate($id)
{
    echo "Succ"; die;
}




}
