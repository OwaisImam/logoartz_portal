<?php

namespace App\Http\Controllers\SalesPerson;

use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Input;
use Validator;
use Hash;
use DB;

class SalesPerson {

    function __construct() {
        parent::__construct();
    }

    public function index() {

        echo "Succfully"; die;
        // $this->data['hear_about_dd'] = \Config::get('hear_about');
        // return view('home', $this->data);
    }

    public function free_trial() {

        $valid["CustomerName"] = 'required|max:20';
        $valid["Company"] = 'max:100';
        $valid["Email"] = 'required|email|max:50';
        $valid["Cell"] = 'required|max:20';
        $valid["DesignName"] = 'required|max:255';
        $valid["Width"] = 'required|max:50';
        $valid["Height"] = 'required|max:50';
        $valid["OrderType"] = 'required|integer|min:1|max:2';
        $valid["Fabric"] = 'required|max:50';
        $valid["AddIns"] = 'max:1000';
        $valid["HearAbout"] = 'required|integer|min:1|max:6';
        $valid["Username"] = 'required|max:100';
        $valid["Password"] = 'required|max:20';

        $valid_name["CustomerName"] = 'Customer Name';
        $valid_name["Company"] = 'Company';
        $valid_name["Email"] = 'Email';
        $valid_name["Cell"] = 'Cell';
        $valid_name["DesignName"] = 'Design Name';
        $valid_name["Width"] = 'Width';
        $valid_name["Height"] = 'Height';
        $valid_name["OrderType"] = 'OrderType';
        $valid_name["Fabric"] = 'Fabric';
        $valid_name["AddIns"] = 'More Instructions';
        $valid_name["HearAbout"] = 'Hear About';
        $valid_name["Username"] = 'Username';
        $valid_name["Password"] = 'Password';

        $messages = [
            'required' => 'Please enter :attribute.',
            'Fabric.required' => 'Please select :attribute.',
            'OrderType.min' => 'Please select :attribute.',
            'HearAbout.min' => 'Please select :attribute.',
            'max' => 'No more characters allowed in :attribute.',
            'OrderType.max' => 'Please select :attribute.',
            'HearAbout.max' => 'Please select :attribute.'
        ];

        $v = Validator::make(Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {
            $FreeOrderPlaced = 0;
            $CheckUser = DB::table('customers')->where('Username', Input::get('Username'))->first();
            if (!empty($CheckUser)) {
                if (Hash::check(Input::get('Password'), $CheckUser->Password)) {
                    $CustomerID = $CheckUser->CustomerID;
                    $CustomerName = $CheckUser->CustomerName;
                    $CustomerCell = $CheckUser->Cell;
                    $CustomerEmail = $CheckUser->Email;
                    $FreeOrderPlaced = $CheckUser->FreeOrderPlaced;
                } else {
                    return redirect()->back()->withErrors("Invalid Password")->withInput();
                }
            } else {
                $CustomerData = [
                    'CustomerName' => Input::get('CustomerName'),
                    'Cell' => Input::get('Cell'),
                    'Email' => Input::get('Email'),
                    'Company' => Input::get('Company'),
                    'Username' => Input::get('Username'),
                    'Password' => Hash::make(Input::get('Password')),
                    'HearAbout' => Input::get('HearAbout'),
                    'Status' => 0,
                    'DateAdded' => new \DateTime()
                ];

                DB::table('customers')->insert($CustomerData);
                $CustomerID = DB::getPdo()->lastInsertId();
                $CustomerName = Input::get('CustomerName');
                $CustomerCell = Input::get('Cell');
                $CustomerEmail = Input::get('Email');
            }

            if ($FreeOrderPlaced == 0) {
                $OrderData = [
                    'CustomerID' => $CustomerID,
                    'DesignName' => Input::get('DesignName'),
                    'Width' => Input::get('Width'),
                    'Height' => Input::get('Height'),
                    'MoreInstructions' => Input::get('AddIns'),
                    'Scale' => 'Inch',
                    'Status' => 0,
                    'OrderType' => 3,
                    'DateAdded' => new \DateTime()
                ];

                if (Input::has('OrderType') && Input::get('OrderType') == 1) {
                    // digitizing order
                    $OrderData['Fabric'] = Input::get('Fabric');
                    DB::table('digitizing_orders')->insert($OrderData);
                } else {
                    // vector order
                    DB::table('vector_order')->insert($OrderData);
                }

                DB::table('customers')->where('CustomerID', $CustomerID)->update(['FreeOrderPlaced' => 1]);

                \Session::put('CustomerLogin', true);
                \Session::put("CustomerID", $CustomerID);
                \Session::put('CustomerName', $CustomerName);
                \Session::put('Cell', $CustomerCell);
                \Session::put('Email', $CustomerEmail);
                return redirect('/CustomerDash')->with('success', 'Free order placed successfully');
            } else {
                return redirect()->back()->withErrors("You have already placed your free order")->withInput();
            }
        }
    }

    public function login() {
        if (\Session::has('CustomerLogin')) {
            return redirect('CustomerDash');
        }
        return view('login', $this->data);
    }

    public function about() {
        return view('about', $this->data);
    }

    public function contactus() {
        return view('contact', $this->data);
    }

    public function digiportfolio() {

        return view('/digi', $this->data);
    }

    public function vectorportfolio() {

        return view('/vector', $this->data);
    }

    public function portfolio() {

        return view('/portfolio', $this->data);
    }

    public function digi_services() {
        echo "Succfully Digitizing";
        die;
        return view('contact', $this->data);
    }

    public function vector_services() {

        return view('vector_detail', $this->data);
    }

    public function submit_login() {
        $v = Validator::make(Input::all(), [
                    'Username' => 'required',
                    'Password' => 'required'
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {
            $user = DB::table('customers')
                    ->whereRaw(("Username = '" . Input::get('Username') . "'"))
                    ->where('Status', 1)
                    ->first();
            if (!empty($user)) {
                if (Hash::check(Input::get('Password'), $user->Password)) {
                    if ($user->IsActivated == 0) {
                        return redirect()->back()->withErrors("Account is not activated");
                    } else {
                        \Session::put('CustomerLogin', true);
                        \Session::put("CustomerID", $user->CustomerID);
                        \Session::put('CustomerName', $user->CustomerName);
                        \Session::put('Cell', $user->Cell);
                        \Session::put('Email', $user->Email);
                        return redirect('/CustomerDash');
                    }
                } else {
                    return redirect()->back()->withErrors("Invalid Username OR Password");
                }
            } else {
                return redirect()->back()->withErrors("Invalid Username OR Password");
            }
        }
    }

    public function CusDashboard() {
//        echo '<pre>'.print_r(\Session::all(), 1).'</pre>'; die;

        if (!\Session::has('CustomerLogin')) {
            return redirect('login');
        }

        $CustomerID = \Session::get('CustomerID');


        // where([['OrderType', '=', 0],['CustomerID', '=', $CustomerID],]);
        $this->data['count_digi_new_orders'] = \App\DigiOrders::where([['OrderType', '=', 0], ['CustomerID', '=', $CustomerID],])->count();
        $this->data['count_digi_order_revision'] = \App\DigiOrders::where([['OrderType', '=', 1], ['CustomerID', '=', $CustomerID],])->count();
        $this->data['count_digi_new_quote'] = \App\DigiOrders::where([['OrderType', '=', 2], ['CustomerID', '=', $CustomerID],])->count();

        $this->data['count_vector_new_orders'] = \App\vector_order::where([['OrderType', '=', 0], ['CustomerID', '=', $CustomerID],])->count();
        $this->data['count_vector_order_revision'] = \App\vector_order::where([['OrderType', '=', 1], ['CustomerID', '=', $CustomerID],])->count();
        $this->data['count_vector_new_quote'] = \App\vector_order::where([['OrderType', '=', 2], ['CustomerID', '=', $CustomerID],])->count();




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

        echo $id;
        die;
        $this->data['countries_dd'] = $this->countries_dd();
        $this->data['currencies_dd'] = $this->currencies_dd();
        $this->data['hear_about_dd'] = \Config::get('hear_about');
        $this->data['card_types_dd'] = \Config::get('card_types');
// //        return view('register', $this->data);
// //        exit();


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
            $cat->Email = Input::get('Email');
            $cat->Fax = Input::get('Fax');
            $cat->Company = Input::get('Company');
            $cat->CountryID = Input::get('CountryID');
            $cat->State = Input::get('State');
            $cat->City = Input::get('City');
            $cat->Address = Input::get('Address');
            $cat->Zip = Input::get('Zip');
            $cat->Username = Input::get('Username');
            if (Input::has('Password') && Input::get('Password') != "") {
                $cat->Password = \Hash::make(Input::get('Password'));
            }
            $cat->Status = Input::get('Status');
            $cat->DateModified = new \DateTime;

            $cat->save();


            echo "Succfully Updated";
            die;
        }
    }

    public function logout() {
        \Session::forget(['CustomerLogin', 'CustomerID', 'CustomerName', 'Cell', 'Email']);
        return redirect('login');
        exit();
    }

    public function plc_vector_freeorder() {

        if (\Session::has('CustomerLogin')) {
            return redirect('/vector-order');
        }

        $this->data['countries_dd'] = $this->countries_dd();
        $this->data['currencies_dd'] = $this->currencies_dd();
        $this->data['hear_about_dd'] = \Config::get('hear_about');
        $this->data['card_types_dd'] = \Config::get('card_types');


        return view('register', $this->data);
    }

    public function plc_digi_freeorder() {

        if (\Session::has('CustomerLogin')) {
            return redirect('/digi-order');
        }
        $this->data['countries_dd'] = $this->countries_dd();
        $this->data['currencies_dd'] = $this->currencies_dd();
        $this->data['hear_about_dd'] = \Config::get('hear_about');
        $this->data['card_types_dd'] = \Config::get('card_types');


        return view('register', $this->data);
    }

}
