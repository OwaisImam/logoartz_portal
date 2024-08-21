<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Input;
use admin\summary\history\historyindi;
use Validator;
use DB;

class Summary extends AdminController {

    function __construct() {
        parent::__construct();
    }

    public function index() {
     //   $this->data['DigiOrders'] = \App\Customers::all();

        $this->data['OrderTypes'] = \App\Customers::all();
        $this->data['Orders'] =  '';
        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');


        return view('admin.summary.history.historyindi', $this->data);
    }


    public function search_records()
    {   
          $To = Input::get('DateTo');
          $From = Input::get('DateFrom');
          $Cat   = Input::get('Cetagory');

// echo $To.'<br>';
// echo $From; die;
           $this->data['OrderStatuses'] = Config('order_statuses');
          $this->data['OrderTypes'] = Config('order_types');


        if (!empty($To || $From || $Cat)) {
            if($Cat == 0){

                $this->data['Cat'] = 0; 

            $this->data['Orders'] = \App\DigiOrders::select('digitizing_orders.OrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'OrderType', 'digitizing_orders.IsRead')
            ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
            ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
            ->whereRaw('digitizing_orders.DateAdded BETWEEN "'.$From.'" AND "'.$To.'"')
            ->where('digitizing_orders.Status', 8)
            ->orderby('digitizing_orders.OrderID', 'desc')
            ->get();   
            // echo '<pre>'.print_r(DB::getQueryLog(), 1).'</pre>';
            return view('admin.summary.history.historyindi', $this->data);

            }else if($Cat == 1){
                  $this->data['Cat'] = 1; 

                $this->data['Orders'] = \App\vector_order::select('VectorOrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'vector_order.Status', 'OrderType', 'vector_order.IsRead')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                ->whereRaw('vector_order.DateAdded BETWEEN "'.$From.'" AND "'.$To.'"')
                ->orderby('vector_order.VectorOrderID', 'desc')
                ->get();

                 return view('admin.summary.history.historyindi', $this->data);
         }else{
            return redirect('admin/summary');
         }

          }else{
            return redirect('admin/summary')->with('warning_msg', "Invalid Selecttion");

        }
            }

public function digi_orders($StatusID) {

//       $this->data['DigiOrders'] = \App\DigiOrders::select('OrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber','digitizing_orders.Status', 'OrderType')
//	   ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
//       ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
//       ->where('digitizing_orders.OrderType', $StatusID)
//	   ->get();
//       if($StatusID == 'all'){
//           $this->data['DigiOrders'] = \App\DigiOrders::select('OrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber','digitizing_orders.Status', 'OrderType')
//	   ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
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


        $this->data['VectorOrders'] = \App\vector_order::select('vector_order.VectorOrderID', 'CustomerName', 'ReqFormat', 'DesignerName', 'CC', 'File1', 'File2', 'File3', 'File4', 'MoreInstructions', 'NoOfColors', 'DesignName', 'PONumber', 'vector_order.Status', 'OrderType', 'vector_order.DesignerID', 'DesignerPrice', 'CustomerPrice', 'Price', 'customers.priceplane', 'MessageForAdmin', 'QuotePrice', 'IsRead', 'vector_result.VR_ID', 'Scale', 'Height', 'Width', 'ReqColor', 'ReqSeparation', 'CustomerPrice')
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


//      $this->data['DigiOrders'] = \App\DigiOrders::select('OrderID', 'CustomerName', 'ReqFormat','DesignerName', 'Fabric', 'CC' , 'File1', 'File2', 'MoreInstructions', 'NoOfColors', 'DesignName', 'PONumber','digitizing_orders.Status', 'OrderType', 'digitizing_orders.DesignerID')
//       ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
//       ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
//       ->where('digitizing_orders.OrderID', $OrderID)
//       ->first();
        $this->data['DigiOrders'] = \App\DigiOrders::select('digitizing_orders.OrderID', 'CustomerName', 'ReqFormat', 'DesignerName', 'CC', 'File1', 'File2', 'File3', 'File4', 'MoreInstructions', 'NoOfColors', 'DesignName', 'PONumber', 'digitizing_orders.Status', 'OrderType', 'digitizing_orders.DesignerID', 'DesignerPrice', 'CustomerPrice', 'Price', 'customers.priceplane', 'MessageForAdmin', 'QuotePrice', 'IsRead', 'Scale', 'Height', 'Width', 'CustomerPrice', 'customers.CsNote')
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

        $this->data['Designers'] = \App\Designers::where('Category', 2)->pluck('DesignerName', 'DesignerID');
//       array_unshift($this->data['Designers'], "Select Designer");

        if ($this->data['DigiOrders']->IsRead == 0) {
            \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update(['IsRead' => 3]);
        }
        return view('admin.summary.OrderDetail', $this->data);
    }

    public function AssignSubmit($OrderID) {
//        $valid["DesignerID"] = 'required|integer|min:1';
//
//         $valid_name["DesignerID"] = "Designer";
//
//         $messages = [
//            'required' => 'Please enter :attribute.',
//            'DesignerID.min' => 'Please select :attribute.'
//            
//        ];
//
//        $v = Validator::make(Input::all(), $valid, $messages);
//        $v->setAttributeNames($valid_name);
//
//        if ($v->fails()) {
//            return redirect()->back()->withErrors($v->errors())->withInput();
//        } else {
//            $orderDetail = [
//                'DesignerID' => \Input::get('DesignerID'),
//                'MessageForDesigner' => \Input::get('MessageForDesigner'),
//                'Status' => 1
//            ];
//            \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update($orderDetail);
//            return redirect('admin/Norder-details/'.$OrderID)->with('success', 'Assigned to Designer Successfully');
//        }
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
            if ($order->OrderType == 0 || $order->OrderType == 3 || $order->DesignerID != '') {
                $status = 5;
            }
            if ($order->OrderType == 2) {
                $type = 2;
            }
            $orderDetail = [
                'DesignerID' => \Input::get('DesignerID'),
                'MessageForDesigner' => \Input::get('MessageForDesigner'),
                'IsRead' => $read,
                'Status' => $status,
                'OrderType' => $type
            ];
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
            $order = \DB::table('vector_order')->where('VectorOrderID', $VectorOrderID)->first();
            if ($order->OrderType == 0 || $order->OrderType == 3 || $order->DesignerID != '') {
                $status = 5;
            }
            $orderDetail = [
                'DesignerID' => \Input::get('DesignerID'),
                'MessageForDesigner' => \Input::get('MessageForDesigner'),
                'IsRead' => $read,
                'Status' => $status
            ];
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
            $types = Config('order_types');
            $query = \App\vector_order::where('VectorOrderID', $VectorOrderID)
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                    ->first();
            \DB::table('vector_order')->where('VectorOrderID', $VectorOrderID)->update(['CustomerPrice' => \Input::get('CustomerPrice'), 'Status' => 3, 'IsRead' => 2]);
            \Mail::send(['html' => 'mail'], ['name' => 'Logo Artz', 'user' => $query->CustomerName, 'design' => 'Vector Design', 'type' => $types[$query->OrderType], 'amount' => \Input::get('CustomerPrice')], function ($message) use ($query) {
                $message->to($query->Email)->subject('Confirmation');
                $message->from('technical-team@logoartz.com', 'Logo Artz');
            });
            return redirect('admin/Vec_order-details/' . $VectorOrderID)->with('success', 'Quote Sent To Customer Successfully');
        }
    }

    function SendQuote($OrderID) {
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
            $types = Config('order_types');
            $query = \App\DigiOrders::where('OrderID', $OrderID)
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                    ->first();
            \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update(['CustomerPrice' => \Input::get('CustomerPrice'), 'Status' => 3, 'IsRead' => 2]);
            \Mail::send(['html' => 'mail'], ['name' => 'Logo Artz', 'user' => $query->CustomerName, 'design' => 'Digitizing Design', 'type' => $types[$query->OrderType], 'amount' => \Input::get('CustomerPrice')], function ($message) use ($query) {
                $message->to($query->Email)->subject('Confirmation');
                $message->from('technical-team@logoartz.com', 'Logo Artz');
            });
            return redirect('admin/Norder-details/' . $OrderID)->with('success', 'Quote Sent To Customer Successfully');
        }
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
        $PoNumber = 0;
        $mCustomerName = "";

        if(Input::has('OrderNum') && (int) Input::get('OrderNum') != 0) {
             $OrderNo = (int) Input::get('OrderNum');
        }
        if(Input::has('PoNum') && (int) Input::get('PoNum') != 0) {
             $PoNumber = (int) Input::get('PoNum');
        }
        if(Input::has('Customer_Name') && Input::get('Customer_Name') != '') {
             $mCustomerName = trim(Input::get('Customer_Name'));
        }

        $OrderSearchResult = [];

          if($mCustomerName != "") {
           $CustomerIDs = DB::table('customers')->select('CustomerID')->whereRaw('CustomerName LIKE "%'.$mCustomerName.'%"')->get();
        }
       
       $CompleteResult = [];

        // digitizing_search
        $Digitizing = DB::table('digitizing_orders')
        ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
        ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID');
        if($OrderNo != 0) {
            $Digitizing->where('OrderID', $OrderNo);
        }
        if($PoNumber != 0) {
            $Digitizing->where('PONumber', $PoNumber);
        }
        if($mCustomerName != "" && !empty($CustomerIDs)) {
            $CustIDs = [];
            foreach($CustomerIDs as $cIds) {
                array_push($CustIDs, $cIds->CustomerID);
            }
            $Digitizing->whereIn('digitizing_orders.CustomerID', $CustIDs);
        }
        $DigitizingResult = $Digitizing->get();

        if(!empty($DigitizingResult)) {
            foreach($DigitizingResult as $digitRes) {
                $CompleteResult[] = [
                    'OrderID' => $digitRes->OrderID,
                    'OrderRef' => 'Digitizing',
                    'OrderDetailLink' => url('admin/Norder-details/'.$digitRes->OrderID),
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
        if($OrderNo != 0) {
            $Vector->where('VectorOrderID', $OrderNo);
        }
        if($PoNumber != 0) {
            $Vector->where('PONumber', $PoNumber);
        }
        if($mCustomerName != "" && !empty($CustomerIDs)) {
            $CustIDs = [];
            foreach($CustomerIDs as $cIds) {
                array_push($CustIDs, $cIds->CustomerID);
            }
            $Vector->whereIn('vector_order.CustomerID', $CustIDs);
        }
        $VectorResult = $Vector->get();

        if(!empty($VectorResult)) {
            foreach($VectorResult as $vectRes) {
                $CompleteResult[] = [
                    'OrderID' => $vectRes->VectorOrderID,
                    'OrderRef' => 'Vector',
                    'OrderDetailLink' => url('admin/Vec_order-details/'.$vectRes->VectorOrderID),
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
        print_r($this->data['DigiOrders']);die;
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

        \DB::table('vector_order')->where('VectorOrderID', $VectorOrderID)->update(['Status' => 7, 'MessageForCustomer' => Input::get('MessageForCustomer'), 'DesignerPrice' => $DesignP, 'SalesPrice' => $SalesP,'IsRead' => 2]);
        
        if(Input::has('FileForCustomer') && is_array(Input::get('FileForCustomer')) && count(Input::get('FileForCustomer')) > 0) {
            \DB::table('vector_result_files')->whereIn('VR_File_ID', Input::get('FileForCustomer'))->update(['ForCustomer' => 1]);
        }

            // Todays Work Sunday //
            $isRevisionSet = DB::table('vector_result_files')->select(DB::raw('MAX(RevisionSet) as RevisionSet'))
            ->where('VectorOrderID', $VectorOrderID)
            ->first();
            if(!empty($isRevisionSet)) {
                $myVar = $isRevisionSet->RevisionSet;
                $myVar++;
            } else {
                $myVar = 0;
            }

    
            if (!empty($price)) {
                \DB::table('vector_order')->where('VectorOrderID', $VectorOrderID)->update(['CustomerPrice' => $price]);
            }
            
            //echo $myVar; die;
            \DB::table('vector_result_files')->whereIn('VR_File_ID', Input::get('FileForCustomer'))->update(['ForCustomer' => 1, 'RevisionSet' => $myVar]);
    

        

           // E    N     D       Todays Work Sunday //
        $query = \App\vector_order::where('VectorOrderID', $VectorOrderID)
                ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                ->first();
        
        \Mail::send(['html' => 'send_design_mail'], ['name' => 'Logo Artz', 'user' => $query->CustomerName, 'design' => 'Vector Design'], function ($message) use ($query) {
            $message->to($query->Email)->subject('Information');
            $message->from('technical-team@logoartz.com', 'Logo Artz');
        });
        return redirect('admin/Vec_order-details/' . $VectorOrderID)->with('success', 'Order Sent To Customer Successfully');
    }

    public function send_digi_design($OrderID) {
        $price = Input::get('OrderPrice');
        $SalesP = \Input::get('salesorp');
        $DesignP = \Input::get('designorp');

        \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update(['Status' => 7, 'MessageForCustomer' => Input::get('MessageForCustomer'), 'SalesPrice' => $SalesP, 'DesignerPrice' => $DesignP,'IsRead' => 2]);
        
        if(Input::has('FileForCustomer') && is_array(Input::get('FileForCustomer')) && count(Input::get('FileForCustomer')) > 0) {

            $isRevisionSet = DB::table('digi_result_files')->select(DB::raw('MAX(RevisionSet) as RevisionSet'))
            ->where('OrderID', $OrderID)
            ->first();
            if(!empty($isRevisionSet)) {
                $myVar = $isRevisionSet->RevisionSet;
                $myVar++;
            } else {
                $myVar = 0;
            }

            
            if (!empty($price)) {
                \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update(['CustomerPrice' => $price]);
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
        \Mail::send(['html' => 'send_design_mail'], ['name' => 'Logo Artz', 'user' => $query->CustomerName, 'design' => 'Digitizing Design'], function ($message) use ($query) {
            $message->to($query->Email)->subject('Information');
            $message->from('technical-team@logoartz.com', 'Logo Artz');
        });
        return redirect('admin/Norder-details/' . $OrderID)->with('success', 'Order Sent To Customer Successfully');
    }

    public function order_revision($VectorOrderID) {
        $valid["MessageForDesigner"] = 'required';
        $valid_name["MessageForDesigner"] = "Message For Designer";
        $messages = [
            'required' => 'Please enter :attribute.'
        ];
        $v = Validator::make(\Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {
            $type = 1;
            $status = 5;
            $order = \DB::table('vector_order')->where('VectorOrderID', $VectorOrderID)->first();
            if ($order->OrderType == 3 || $order->OrderType == 9) {
                $type = 9;
                $status = 10;
            }
            \DB::table('vector_order')->where('VectorOrderID', $VectorOrderID)->update(['Status' => $status, 'OrderType' => $type, 'IsRead' => 1]);
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
        $valid["MessageForDesigner"] = 'required';
        $valid_name["MessageForDesigner"] = "Message For Designer";
        $messages = [
            'required' => 'Please enter :attribute.'
        ];
        $v = Validator::make(\Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {
            $type = 1;
            $status = 5;
            $order = \DB::table('digitizing_orders')->where('OrderID', $OrderID)->first();
            if ($order->OrderType == 3 || $order->OrderType == 9) {
                $type = 9;
                $status = 10;
            }
            \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update(['Status' => $status, 'OrderType' => $type, 'IsRead' => 1]);
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
            \DB::table('vector_order')->where('VectorOrderID', $vectorid)->update(['Status' => 3, 'OrderType' => 2, 'IsRead' => 2]);
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

    

    public function status_update($orderid) 
    {
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
          }  else {
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


    public function digi_acc_get(){

      $this->data['allcustomers'] = \DB::table('customers')->get(); 

      return view('admin.summary.accounts.digi_acc', $this->data);
    }


    public function vec_acc_get(){
      $this->data['allcustomers'] = \DB::table('customers')->get(); 
      return view('admin.summary.accounts.vec_acc', $this->data);    
  }

    public function get_all_dacc_req(){
        $From = \Input::get('DateFrom');
        $To  = \Input::get('DateTo');
        $getcusid =  \Input::get('cusname');
        $this->data['CustomerID'] = $getcusid;

         $this->data['allcustomers'] = \DB::table('customers')->get(); 
         $this->data['Orders'] = \App\DigiOrders::select('digitizing_orders.OrderID', 'CustomerName', 'DesignName', 'PONumber', 'Price', 'digitizing_orders.IsRead')
            ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
            ->whereRaw('digitizing_orders.DateAdded BETWEEN "'.$From.'" AND "'.$To.'"')
            ->where('digitizing_orders.Status', 7)
            ->where('digitizing_orders.CustomerID', $getcusid)
            ->orderby('digitizing_orders.OrderID', 'desc')
            ->get();   

        return view('admin.summary.accounts.digi_acc', $this->data);


    }
    public function generate_digi_inv() {
        // echo '<pre>'.print_r(Input::all(), 1).'</pre>'; die;
        $this->data['type'] = 'Digitizing';


        if(Input::has('OrderIDs') && Input::has('CustomerID')) {
            $OrderIds = \Input::get('OrderIDs');
            $CustomerID = \Input::get('CustomerID');


          // dd($OrderIds); die;

            $this->data['Customer'] = DB::table('customers')->where('CustomerID', $CustomerID)->first();

            if(empty($this->data['Customer'])) {
                return redirect('admin/digi/accounts')->with('warning_msg', "Invalid Customer");
            }

            $this->data['Orders'] = \App\DigiOrders::whereIn('digitizing_orders.OrderID', $OrderIds)
            ->orderby('digitizing_orders.OrderID', 'desc')
            ->get(); 

        
            return view('admin.summary.accounts.digi_invoice', $this->data);  

        } else {
            return redirect('admin/digi/accounts')->with('warning_msg', "Invalid Customer Or Order");
        }
    }

    public function get_all_vacc_req(){
        $From = \Input::get('DateFrom');
        $To  = \Input::get('DateTo');
        $getcusid =  \Input::get('cusname');

         $this->data['allcustomers'] = \DB::table('customers')->get(); 
         $this->data['Orders'] = \App\vector_order::select('vector_order.VectorOrderID', 'CustomerName', 'DesignName', 'PONumber', 'Price', 'vector_order.IsRead')
            ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
            ->whereRaw('vector_order.DateAdded BETWEEN "'.$From.'" AND "'.$To.'"')
            ->where('vector_order.Status', 8)
            ->where('vector_order.CustomerID', $getcusid)
            ->orderby('vector_order.VectorOrderID', 'desc')
            ->get();   

        return view('admin.summary.accounts.vec_acc', $this->data);

    }

    public function designer_acc(){

        $this->data['designers'] = \App\Designers::get();

        return view('admin.summary.accounts.dec_acc', $this->data);

    }

    public function desi_acc_detail(){

        $From = \Input::get('DateFrom');
        $To  = \Input::get('DateTo');
        $getdesid =  \Input::get('desname');


       $this->data['designers'] = \App\Designers::get();

       $this->data['OrdersVec'] = \App\vector_order::select('vector_order.VectorOrderID', 'DesignName', 'PONumber', 'DesignerPrice', 'DesignerName', 'vector_order.IsRead')
            ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
            ->whereRaw('vector_order.DateAdded BETWEEN "'.$From.'" AND "'.$To.'"')
            ->where('vector_order.Status', 7)
            ->where('vector_order.DesignerID', $getdesid)
            ->orderby('vector_order.VectorOrderID', 'desc')
            ->get();   
         
       $this->data['OrdersDigi'] = \App\DigiOrders::select('digitizing_orders.OrderID', 'DesignName', 'PONumber', 'DesignerPrice', 'DesignerName',  'digitizing_orders.IsRead')
            ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
            ->whereRaw('digitizing_orders.DateAdded BETWEEN "'.$From.'" AND "'.$To.'"')
            ->where('digitizing_orders.Status', 7)
            ->where('digitizing_orders.DesignerID', $getdesid)
            ->orderby('digitizing_orders.OrderID', 'desc')
            ->get();   
           
        return view('admin.summary.accounts.dec_acc', $this->data);

    }

    public function sales_acc(){

        $this->data['salesrep'] = \App\SalesPerson::get();

        return view('admin.summary.accounts.sales_acc', $this->data);

    }

    public function sales_acc_detail(){

        $From = \Input::get('DateFrom');
        $To  = \Input::get('DateTo');
        $getsalesid =  \Input::get('salesname');


      $this->data['salesrep'] = \App\SalesPerson::get();

       $this->data['OrdersVec'] = \App\vector_order::select('vector_order.VectorOrderID', 'DesignName', 'DesignerName','PONumber', 'SalesPrice', 'vector_order.IsRead')
            ->leftjoin('salesperson', 'salesperson.SalesPersonID', '=', 'vector_order.SalesPersonID')
            ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
            ->whereRaw('vector_order.DateAdded BETWEEN "'.$From.'" AND "'.$To.'"')
            ->whereIn('vector_order.Status', [7,8])
            ->where('vector_order.SalesPersonID', $getsalesid)
            ->orderby('vector_order.VectorOrderID', 'desc')
            ->get();   
         
       $this->data['OrdersDigi'] = \App\DigiOrders::select('digitizing_orders.OrderID', 'DesignName', 'PONumber', 'SalesPrice',  'digitizing_orders.IsRead')
            ->leftjoin('salesperson', 'salesperson.SalesPersonID', '=', 'digitizing_orders.SalesPersonID')
            ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
            ->whereRaw('digitizing_orders.DateAdded BETWEEN "'.$From.'" AND "'.$To.'"')
            ->where('digitizing_orders.Status', 8)
            ->where('digitizing_orders.SalesPersonID', $getsalesid)
            ->orderby('digitizing_orders.OrderID', 'desc')
            ->get();   
           
        return view('admin.summary.accounts.sales_acc', $this->data);

    }














}
