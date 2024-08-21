<?php

namespace App\Http\Controllers\SalesPerson;

use App\Http\Controllers\SalesPersonController;
use Illuminate\Support\Facades\Input;
use App\DigiOrders;
use App\vector_order;
use Validator;
use Hash;
use DB;

class Customers extends SalesPersonController{
    function __construct() {
        parent::__construct();
    }

    public function index() {
        // $SessionID = \Session::get('SalesPersonID');
        // echo $SessionID; die;

        $this->data['recordsTotal'] = \App\Customers::where('SalesPersonID', \Session::get('SalesPersonID'))->count();

        return view('salesperson.customers.index', $this->data);
    

    }

    public function Customers_all() {

        $CustomerID = \Session::get('CustomerID');
        $SalesPerson  = \Session::get('SalesPersonID');

        $Customers = DB::table('customers')->where('CustomerID', $CustomerID)->get();
        $DigiOrders = DB::table('digitizing_orders')->where('SalesPersonID', \Session::get('SalesPersonID'))->get();
        $VectorOrders = DB::table('vector_order')->where('SalesPersonID', \Session::get('SalesPersonID'))->get();
        $DigiQuotes = DB::table('digitizing_orders')->where('SalesPersonID', \Session::get('SalesPersonID'))->where('OrderType', 2)->get();
        $VectorQuotes = DB::table('vector_order')->where('SalesPersonID', \Session::get('SalesPersonID'))->where('OrderType', 2)->get();

        // dd($DigiQuotes);
        // echo '<pre>',print_r($VectorQuotes, 1),'</pre>'; die;

      //  echo "Succfully"; die;

     

        $this->data['recordsTotal'] = \App\Customers::where('SalesPersonID', \Session::get('SalesPersonID'))->count();

        return view('salesperson.customers.index', $this->data);

    }

    public function customers_list() {
        $start = (Input::has('start') ? (int) Input::get('start') : 0);
        $length = (Input::has('length') ? (int) Input::get('length') : 25);

        $columns = ["", "CustomerID", "CustomerName", "Cell", "Email", "Status", "DateAdded", "DateModified", ""];

        $query = \App\Customers::select(['CustomerID', 'CustomerName', 'Cell', 'Email',
                    DB::raw("CONCAT('<small class=\"label bg-', IF(Status = 0, 'red', 'green'), '\" ><i class=\"fa ', IF(Status = 0, 'fa-times', 'fa-check'), '\"></i> ', IF(Status = 1, 'Active', 'Deactive'), '</small>') AS Status"),
                    DB::raw("DATE_FORMAT(DateAdded, \"%d-%b-%Y<br>%r\") as DateAdded"),
                    DB::raw("DATE_FORMAT(DateModified, \"%d-%b-%Y<br>%r\") as DateModified")])
                    ->where('SalesPersonID', \Session::get('SalesPersonID'));
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
                '<button type="button" class="btn btn-success btn-sm" onClick="location.href=\'salesperson/view/' . $Rs->CustomerID . '\'"><i class="fa fa-eye-o"></i> Detail</button>'
            ];
        }

        echo json_encode(["draw" => (int) Input::get('draw'), "recordsTotal" => $recordsTotal, "recordsFiltered" => $recordsFiltered, "data" => $data]);
        exit(0);
    }



    public function login() {
        if (\Session::has('CustomerLogin')) {
            return redirect('CustomerDash');
        }
        return view('login', $this->data);
    }

   public function customer_view($CustomerID)
   {
       $SalesPersonID = \Session::get('SalesPersonID');
       $CustomerInfo = DB::table('customers')->where('CustomerID', $CustomerID)->first(); 
       $OrderStatuses = Config('order_statuses');
       $OrderTypes = Config('order_types');
       $customers_ID = $CustomerID;
       $configuration = \DB::table('configuration')->first();
       $hearAbout = Config('hear_about');    

        # Total Vector Orders
        $totalvectors = \DB::table('vector_order')->where('CustomerID', $CustomerID)->where('SalesPersonID', $SalesPersonID)->count();
        
        # Total Digitizing Orders
        $totaldigis = \DB::table('digitizing_orders')->where('CustomerID', $CustomerID)->where('SalesPersonID', $SalesPersonID)->count();

        #Inprocess Vector Orders

         $digiInprocess =  DigiOrders::where('CustomerID', $CustomerID)->where('SalesPersonID', $SalesPersonID)->where('Status','!=', 7)->count();
        
        #Inprocess Digitizing Orders

         $vectorInprocess =  vector_order::where('CustomerID', $CustomerID)->where('SalesPersonID', $SalesPersonID)->where('Status','!=', 7)->count();

        #Last Digitizing Orders Place 
         $digiLastOrder =  DigiOrders::where('CustomerID', $CustomerID)->where('SalesPersonID', $SalesPersonID)->orderBy('DateAdded', 'DESC')->first();
    
        #Last Vector Orders Place 
        $vecLastOrder =  vector_order::where('CustomerID', $CustomerID)->where('SalesPersonID', $SalesPersonID)->orderBy('DateAdded', 'DESC')->first();

        # Customer Notes (CS Note)
          $Notes= DB::table('customernotes')->where('SalesPersonID', $SalesPersonID)->where('CustomerID', $CustomerID)->orderBy('CustomerNoteID', 'DESC')->get(); 

          $data = $this->data;




         return view('salesperson.CustomerDetails', compact('configuration', 'SalesPersonID', 'CustomerInfo', 'OrderStatuses', 'OrderTypes', 'customers_ID', 'totalvectors', 'totaldigis', 'digiInprocess', 'vectorInprocess', 'digiLastOrder', 'vecLastOrder', 'data', 'hearAbout', 'Notes'), $this->data);

            
        // $newdigiorders = \DB::table('digitizing_orders')->where('CustomerID', $CustomerID)->where('SalesPersonID', $SalesPersonID)->where('IsRead',2)->count();

        // $this->data['newvectororders'] = \DB::table('vector_order')->where('CustomerID',\Session::get('CustomerID'))->where('Status',3)->where('IsRead',2)->count();
            
        // $this->data['myvectors'] = \DB::table('vector_order')->where('CustomerID',\Session::get('CustomerID'))->where('Status',7)->where('IsRead',2)->count();
        // $this->data['mydigis'] = \DB::table('digitizing_orders')->where('CustomerID',\Session::get('CustomerID'))->where('Status',7)->where('IsRead',2)->count();






        // $this->data['DigiOrders'] = \App\DigiOrders::select('OrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber','digitizing_orders.Status', 'OrderType', 'customers.CustomerID')
        //     ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
        //     ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
        //     ->where('digitizing_orders.CustomerID', $CustomerID)    
        //     ->where('digitizing_orders.OrderType', '<>', 2)
        //     ->where('digitizing_orders.OrderType', '<>', 4)
        //     ->where('customers.SalesPersonID', $SalesPersonID)
        //     ->orderBy('OrderID', 'DESC')
        //     ->paginate(4);
    
        //     $this->data['DigiQuotes'] = \App\DigiOrders::select('OrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber','digitizing_orders.Status', 'OrderType', 'customers.CustomerID')
        //     ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
        //     ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
        //     ->where('digitizing_orders.CustomerID', $CustomerID)    
        //     ->whereIn('digitizing_orders.OrderType', [2, 4])
        //     ->where('customers.SalesPersonID', $SalesPersonID)
        //     ->orderBy('OrderID', 'DESC')
        //     ->paginate(4);

        //   // $this->data['DigiQuotes'] = DB::table('digitizing_orders')->where('SalesPersonID', $SalesPersonID)->where('CustomerID', $CustomerID)->where('OrderType', 2)
        //   // ->orderBy('OrderID', 'DESC')
        //   // ->get();
      
        //   $this->data['VectorOrders'] = \App\vector_order::select('VectorOrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber','vector_order.Status', 'OrderType')
        //     ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
        //     ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
        //      ->where('vector_order.CustomerID', $CustomerID)    
        //     ->where('vector_order.OrderType', '<>', 2)
        //     ->where('customers.SalesPersonID', $SalesPersonID)
        //     ->orderBy('VectorOrderID', 'DESC')
        //      ->paginate(4);
    


        //   $this->data['VectorQuotes'] = \App\vector_order::select('VectorOrderID', 'CustomerName', 'DesignName', 'PONumber','vector_order.Status')
        //     ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
        //     ->where('vector_order.OrderType', '=', 2)
        //     ->where('customers.SalesPersonID', $SalesPersonID)
        //     ->orderBy('VectorOrderID', 'DESC')
        //     ->get(); 
    



        //   $this->data['Notes'] = DB::table('customernotes')->where('SalesPersonID', $SalesPersonID)->where('CustomerID', $CustomerID)->orderBy('CustomerNoteID', 'DESC')->get();


        //  // echo '<pre>'.print_r($this->data['Notes'], 1).'</pre>'; die;

          
        //   $this->data['CustomerID'] = $CustomerID;

        // return view('salesperson.CustomerDetails', $this->data);
    }


   public function digi_order_detail($OrderID)
   {
    

        $SalesPersonID = \Session::get('SalesPersonID');

         $this->data['DigiOrders']  = \App\DigiOrders::select('digitizing_orders.OrderID', 'CustomerName', 'ReqFormat', 'DesignerName', 'CC', 'File1', 'File2', 'File3', 'File4', 'MoreInstructions', 'NoOfColors', 'DesignName', 'PONumber', 'digitizing_orders.Status', 'OrderType', 'digitizing_orders.DesignerID', 'DesignerPrice', 'CustomerPrice', 'MessageForAdmin', 'QuotePrice', 'IsRead', 'Scale', 'Height', 'Width', 'Fabric', 'CustomerPrice', 'customers.CsNote', 'digitizing_orders.DateAdded')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                ->where('digitizing_orders.OrderID', $OrderID)
                ->where('digitizing_orders.OrderType', '<>', 2)
                ->first();

        $this->data['heading'] = 'Digitizing Order';

         $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');


         return view('salesperson.digiorderdetail', $this->data);
   }

      public function vector_order_detail($OrderID)
   {


        $SalesPersonID = \Session::get('SalesPersonID');

         $this->data['VectorOrders']  = \App\vector_order::select('vector_order.VectorOrderID', 'CustomerName', 'ReqFormat', 'DesignerName', 'CC', 'File1', 'File2', 'File3', 'File4', 'MoreInstructions', 'NoOfColors', 'DesignName', 'PONumber', 'vector_order.Status', 'OrderType', 'vector_order.DesignerID', 'DesignerPrice', 'CustomerPrice', 'MessageForAdmin', 'QuotePrice', 'IsRead', 'Scale', 'Height', 'Width', 'CustomerPrice', 'customers.CsNote', 'vector_order.DateAdded')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                ->where('vector_order.VectorOrderID', $OrderID)
                ->where('vector_order.OrderType', '<>' , 2)
                ->first();
        
          $this->data['heading'] = 'Vector Order';

         $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');



         return view('salesperson.vectororderdetail', $this->data);
   }

    public function digi_quote_detail($OrderID)
   {

        $SalesPersonID = \Session::get('SalesPersonID');

     $this->data['DigiOrders']  = \App\DigiOrders::select('digitizing_orders.OrderID', 'CustomerName', 'ReqFormat', 'DesignerName', 'CC', 'File1', 'File2', 'File3', 'File4', 'MoreInstructions', 'NoOfColors', 'DesignName', 'PONumber', 'digitizing_orders.Status', 'OrderType', 'digitizing_orders.DesignerID', 'DesignerPrice', 'CustomerPrice', 'MessageForAdmin', 'QuotePrice', 'IsRead', 'Scale', 'Height', 'Width', 'Fabric', 'CustomerPrice', 'customers.CsNote', 'digitizing_orders.DateAdded')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                ->where('digitizing_orders.OrderID', $OrderID)
                ->where('digitizing_orders.OrderType', '=', 2)
                ->first();


          $this->data['heading'] = 'Digitizing Quote';

         $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');
       
         return view('salesperson.digiorderdetail', $this->data);
   }

       public function vector_quote_detail($OrderID)
   {    

        $SalesPersonID = \Session::get('SalesPersonID');

         $this->data['VectorOrders']  = \App\vector_order::select('vector_order.VectorOrderID', 'CustomerName', 'ReqFormat', 'DesignerName', 'CC', 'File1', 'File2', 'File3', 'File4', 'MoreInstructions', 'NoOfColors', 'DesignName', 'PONumber', 'vector_order.Status', 'OrderType', 'vector_order.DesignerID', 'DesignerPrice', 'CustomerPrice', 'MessageForAdmin', 'QuotePrice', 'IsRead', 'Scale', 'Height', 'Width', 'CustomerPrice', 'customers.CsNote', 'vector_order.DateAdded')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                ->where('vector_order.VectorOrderID', $OrderID)
                ->where('vector_order.OrderType', '=' , 2)
                ->first();
       

          $this->data['heading'] = 'Vector Quote';

         $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');
       
         return view('salesperson.vectororderdetail', $this->data);
   }



   public function add_cus_note($CustomerID)
   {

    $Message = Input::get('message');
    $SalesPerson = \Session::get('SalesPersonID');

    $Data = [
        'SalesPersonID' => $SalesPerson,
        'CustomerID'  => $CustomerID,
        'Message' => $Message,
        'DateAdded' => new \DateTime()
    ];
    
    DB::table('customernotes')->insert($Data);

    return redirect()->to('salesperson/salesperson/view/'.$CustomerID); 
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
