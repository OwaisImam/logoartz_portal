<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Input;
use Validator;
use Hash;
use DB;
use PDF;

class Home extends WebController {

    function __construct() {
        parent::__construct();
    }



    public function index() {
        $this->data['hear_about_dd'] = \Config::get('hear_about');
         $this->data['countries_dd'] = $this->countries_dd();
        return view('home', $this->data);
    }



 public function checklogin(){

     if (\Session::has('CustomerLogin')) {
            return redirect()->back();
        }else{
        return view('login');
        }
 }
    


public function free_trial() {
    
        $fileCount = 0;
        $error1 = false;
        $msg1 = "";

       
           $allowed_ext = ['jpg', 'JPG', 'JPEG', 'jpeg', 'png', "PNG", 'gif', 'GIF','EMB', 'emb', 'DST', 'dst' , 'PDF', 'pdf' , 'ai' , 'AI' , 'CDR' , 'cdr' , 'pof', 'POF' , 'pxf', 'PXF' , 'Exp', 'exp', 'CND' , 'cnd', 'ppt', 'PPT' , 'docx', 'DOCX' ,'PES', 'pes', 'xxx', 'XXX','toyota100', 'TOYOTA100', 'eps' , 'EPS'];


            if (Input::hasFile('File')) {
            $fl = Input::file('File');
            if (!empty($fl)) {
                $ext = $fl->getClientOriginalExtension();
                if (!in_array($ext, $allowed_ext)) {
                    $error1 = true;
                    $msg1 = "Invalid File type";
                } else {
                      $fileCount++;
                }
            }
        }


        $valid["CustomerName"] = 'required|max:20';
        $valid["Company"] = 'max:100';
        $valid["Email"] = 'required|email|max:50|unique:customers';
        $valid["Cell"] = 'required|numeric|digits_between:8,15';
        $valid["DesignName"] = 'required|max:255';
        $valid["Width"] = 'required|max:50|numeric';
        $valid["Height"] = 'required|max:50|numeric';
        $valid["OrderType"] = 'required|integer|min:1|max:2';
        $valid["Fabric"] = 'max:50';
        $valid["AddIns"] = 'max:1000';
        $valid["HearAbout"] = 'required|integer|min:1|max:6';
        $valid["CountryID"] = 'required|integer|min:1';
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
        $valid_name["CountryID"] = "Country";
        $valid["Username"] = 'required|max:100|unique:customers';
        $valid_name["Password"] = 'Password';

        $messages = [
            'required' => 'Please enter :attribute.',
            'Fabric.required' => 'Please select :attribute.',
            'OrderType.min' => 'Please select :attribute.',
            'HearAbout.min' => 'Please select :attribute.',
            'max' => 'No more characters allowed in :attribute.',
            'OrderType.max' => 'Please select :attribute.',
            'HearAbout.max' => 'Please select :attribute.',
            'unique' => ':attribute is already registered.'
        ];

        $v = Validator::make(Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);
        if ($v->fails() || $error1 || $fileCount == 0) {
            if ($fileCount == 0) {
                return redirect()->back()->withErrors($v->errors())->withInput()->with('warning_msg', "Please upload artwork");
            } else if($error1) {
                return redirect()->back()->withErrors($v->errors())->withInput()->with('warning_msg', $msg1);
            } else {
                return redirect()->back()->withErrors($v->errors())->withInput();
            }
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
                    'CountryID' => Input::get('CountryID'),
                    'Username' => Input::get('Username'),
                    'Password' => Hash::make(Input::get('Password')),
                    'HearAbout' => Input::get('HearAbout'),
                    'Status' => 1,
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
                
                 $Cus_info =  DB::table('customers')->where('CustomerID', $CustomerID)->first();
       
                 $email = '';
                 $cus_email = $Cus_info->Email;
                 $email = $cus_email;
                 $Name = $Cus_info->CustomerName;
                 $Cell = $Cus_info->Cell;
                 $Company = $Cus_info->Company;
                 $City = $Cus_info->City;
              

                if (Input::has('OrderType') && Input::get('OrderType') == 1) {
                    // digitizing order
                  
                    $OrderData['Fabric'] = Input::get('Fabric');
                    DB::table('digitizing_orders')->insert($OrderData);
                     $InsertID = \DB::getPdo()->lastInsertId();
                      $Cus_order = DB::table('digitizing_orders')->where('OrderID', $InsertID)->first();

                     

                           if (Input::hasFile('File')) {
                        $fl = Input::file('File');
                        if (!empty($fl)) {
                            $filename1 = $InsertID . '_' . str_random(5) . 'digi.' . $fl->getClientOriginalExtension();

                             $path = public_path('uploads') . '/orders/digi/';
                             $fl->move($path ,$filename1);
                            \DB::table('digitizing_orders')->where('OrderID', $InsertID)->update(['File1' => $filename1]);
                        }
                     }
                     
                                     // Email for Admin
                                    
                                      $mailFrom = 'technical-team@logoartz.com';
                                      \Mail::send('includes.emails.digisubmitorder', [
                                      "CustomerName" => $Name,
                                      "CusEmail" => $email,
                                      "CusPhone" => $Cell,
                                      "CusCompany" => $Company,
                                      "OrderType" => 'digitizing order',
                                      "OrderStatus" => 1,
                                      "Msg"   => 'place a order.',
                                      "DesignName" => $Cus_order->DesignName,
                                      "RequriedFormat" => $Cus_order->ReqFormat,
                                      "FABRIC" => $Cus_order->Fabric,
                                      "PLACEMENT" => $Cus_order->Placement,
                                      "Width" => $Cus_order->Width,
                                      "Height" => $Cus_order->Height,
                                      "Scale" => $Cus_order->Scale,
                                      "NumClr" => $Cus_order->NoOfColors,
                                      "Fbrclr" => $Cus_order->FabricColor,
                                      "ADDITIONALINSTRUCTIONS" => $Cus_order->MoreInstructions,
                                      "Trial" => 1,
                                      ]
                                        , function($message) use ($mailFrom) {
                                    $message->to('info@logoartz.com')->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Receive Digitizing Order');
                                });
                                
                                
                                             if(\Mail::failures()){
                                            
                                               
                                                  $mailFrom = 'technical-team@logoartz.com';
                                                  \Mail::send('includes.emails.digisubmitorder', [
                                                  "CustomerName" => $Name,
                                                  "CusEmail" => $email,
                                                  "CusPhone" => $Cell,
                                                  "CusCompany" => $Company,
                                                  "OrderType" => 'digitizing order',
                                                  "OrderStatus" => 1,
                                                  "Msg"   => 'place a order.',
                                                  "DesignName" => $Cus_order->DesignName,
                                                  "RequriedFormat" => $Cus_order->ReqFormat,
                                                  "FABRIC" => $Cus_order->Fabric,
                                                  "PLACEMENT" => $Cus_order->Placement,
                                                  "Width" => $Cus_order->Width,
                                                  "Height" => $Cus_order->Height,
                                                  "Scale" => $Cus_order->Scale,
                                                  "NumClr" => $Cus_order->NoOfColors,
                                                  "Fbrclr" => $Cus_order->FabricColor,
                                                  "ADDITIONALINSTRUCTIONS" => $Cus_order->MoreInstructions,
                                                  "Trial" => 1,
                                                  ]
                                                    , function($message) use ($mailFrom) {
                                                $message->to('info@logoartz.com')->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Receive Digitizing Order');
                                            });
                                                   
               
                                            }elseif(\Mail::failures()){
                                                                                                   

                                                  $mailFrom = 'technical-team@logoartz.com';
                                                  \Mail::send('includes.emails.digisubmitorder', [
                                                  "CustomerName" => $Name,
                                                  "CusEmail" => $email,
                                                  "CusPhone" => $Cell,
                                                  "CusCompany" => $Company,
                                                  "OrderType" => 'digitizing order',
                                                  "OrderStatus" => 1,
                                                  "Msg"   => 'place a order.',
                                                  "DesignName" => $Cus_order->DesignName,
                                                  "RequriedFormat" => $Cus_order->ReqFormat,
                                                  "FABRIC" => $Cus_order->Fabric,
                                                  "PLACEMENT" => $Cus_order->Placement,
                                                  "Width" => $Cus_order->Width,
                                                  "Height" => $Cus_order->Height,
                                                  "Scale" => $Cus_order->Scale,
                                                  "NumClr" => $Cus_order->NoOfColors,
                                                  "Fbrclr" => $Cus_order->FabricColor,
                                                  "ADDITIONALINSTRUCTIONS" => $Cus_order->MoreInstructions,
                                                  "Trial" => 1,
                                                  ]
                                                    , function($message) use ($mailFrom) {
                                                $message->to('info@logoartz.com')->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Receive Digitizing Order');
                                            });
                                                            
                                                
                                            }


                  #Email for Confirmation Email For

                  $mailFrom = 'technical-team@logoartz.com';
                  \Mail::send('includes.emails.digisubmitorder', [
                  "CustomerName" => $Name,
                  "OrderType" => 'digitizing order',
                  "OrderStatus" => 0,
                  "Msg"   => 'Your Order has been submit.',
                  "DesignName" => $Cus_order->DesignName,
                  "RequriedFormat" => $Cus_order->ReqFormat,
                  "FABRIC" => $Cus_order->Fabric,
                  "PLACEMENT" => $Cus_order->Placement,
                  "Width" => $Cus_order->Width,
                  "Height" => $Cus_order->Height,
                  "Scale" => $Cus_order->Scale,
                  "NumClr" => $Cus_order->NoOfColors,
                  "Fbrclr" => $Cus_order->FabricColor,
                  "ADDITIONALINSTRUCTIONS" => $Cus_order->MoreInstructions
                  ] 
                    , function($message) use ($mailFrom) {
                             $message->to(Input::get('Email'))->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Order Confirmation');
                        });               


                   if(\Mail::failures()){

                      $mailFrom = 'technical-team@logoartz.com';
                      \Mail::send('includes.emails.digisubmitorder', [
                      "CustomerName" => $Name,
                      "OrderType" => 'digitizing order',
                      "OrderStatus" => 0,
                      "Msg"   => 'Your Order has been submit.',
                      "DesignName" => $Cus_order->DesignName,
                      "RequriedFormat" => $Cus_order->ReqFormat,
                      "FABRIC" => $Cus_order->Fabric,
                      "PLACEMENT" => $Cus_order->Placement,
                      "Width" => $Cus_order->Width,
                      "Height" => $Cus_order->Height,
                      "Scale" => $Cus_order->Scale,
                      "NumClr" => $Cus_order->NoOfColors,
                      "Fbrclr" => $Cus_order->FabricColor,
                      "ADDITIONALINSTRUCTIONS" => $Cus_order->MoreInstructions
                      ] 
                    , function($message) use ($mailFrom) {
                             $message->to(Input::get('Email'))->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Order Confirmation');
                        });              



                   }

                                
                                
                                
                } else {
                    // vector order
                    DB::table('vector_order')->insert($OrderData);

                    $InsertID = \DB::getPdo()->lastInsertId();
                    
                    $Cus_order = DB::table('vector_order')->where('VectorOrderID', $InsertID)->first();

                           if (Input::hasFile('File')) {
                        $fl = Input::file('FIle');
                        if (!empty($fl)) {
                            $filename1 = $InsertID . '_' . str_random(5) . 'vector.' . $fl->getClientOriginalExtension();

                            $path = public_path('uploads') . '/orders/vector/';
                            $fl->move($path ,$filename1);
                            \DB::table('vector_order')->where('VectorOrderID', $InsertID)->update(['File1' => $filename1]);
                        }
                     }
                     
                                            //Email for Admin
                     
                                              $mailFrom = 'technical-team@logoartz.com';
                                              \Mail::send('includes.emails.vecsubmitorder', [
                                              "CustomerName" => $Name,
                                              "CusEmail" => $email,
                                              "CusPhone" => $Cell,
                                              "CusCompany" => $Company,
                                              "OrderType" => 'vector Order',
                                              "OrderStatus" => 1,
                                               "DesignName" => $Cus_order->DesignName,
                                              "RequriedFormat" => $Cus_order->ReqFormat,
                                              "Vecuse" => $Cus_order->UsedFor,
                                              "Width" => $Cus_order->Width,
                                              "Height" => $Cus_order->Height,
                                              "Scale" => $Cus_order->Scale,
                                              "Reqclr" => $Cus_order->ReqColor,
                                              "NumClr" => $Cus_order->NoOfColors,
                                              "ADDITIONALINSTRUCTIONS" => $Cus_order->MoreInstructions,
                                              "Trial" => 1,
                                              ]
                                                , function($message) use ($mailFrom) {
                                            $message->to('info@logoartz.com')->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Recive Vector Order');
                                        });
                                        
                                        
                                        if(\Mail::failures()){
                                            
                                                     $mailFrom = 'technical-team@logoartz.com';
                                                      \Mail::send('includes.emails.vecsubmitorder', [
                                                      "CustomerName" => $Name,
                                                      "CusEmail" => $email,
                                                      "CusPhone" => $Cell,
                                                      "CusCompany" => $Company,
                                                      "OrderType" => 'vector Order',
                                                      "OrderStatus" => 1,
                                                       "DesignName" => $Cus_order->DesignName,
                                                      "RequriedFormat" => $Cus_order->ReqFormat,
                                                      "Vecuse" => $Cus_order->UsedFor,
                                                      "Width" => $Cus_order->Width,
                                                      "Height" => $Cus_order->Height,
                                                      "Scale" => $Cus_order->Scale,
                                                      "Reqclr" => $Cus_order->ReqColor,
                                                      "NumClr" => $Cus_order->NoOfColors,
                                                      "ADDITIONALINSTRUCTIONS" => $Cus_order->MoreInstructions,
                                                      "Trial" => 1,
                                                      ]
                                                        , function($message) use ($mailFrom) {
                                                    $message->to('info@logoartz.com')->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Recive Vector Order');
                                                });
                                                    
                                            
               
                                            }elseif(\Mail::failures()){
                                                
                                                             $mailFrom = 'technical-team@logoartz.com';
                                                          \Mail::send('includes.emails.vecsubmitorder', [
                                                          "CustomerName" => $Name,
                                                          "CusEmail" => $email,
                                                          "CusPhone" => $Cell,
                                                          "CusCompany" => $Company,
                                                          "OrderType" => 'vector Order',
                                                          "OrderStatus" => 1,
                                                           "DesignName" => $Cus_order->DesignName,
                                                          "RequriedFormat" => $Cus_order->ReqFormat,
                                                          "Vecuse" => $Cus_order->UsedFor,
                                                          "Width" => $Cus_order->Width,
                                                          "Height" => $Cus_order->Height,
                                                          "Scale" => $Cus_order->Scale,
                                                          "Reqclr" => $Cus_order->ReqColor,
                                                          "NumClr" => $Cus_order->NoOfColors,
                                                          "ADDITIONALINSTRUCTIONS" => $Cus_order->MoreInstructions,
                                                          "Trial" => 1,
                                                          ]
                                                            , function($message) use ($mailFrom) {
                                                        $message->to('info@logoartz.com')->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Recive Vector Order');
                                                    });
                                                
                                                
                                            }
                                            
                                            
                  $mailFrom = 'technical-team@logoartz.com';
                  \Mail::send('includes.emails.vecsubmitorder', [
                  "CustomerName" => $Name,
                  "OrderType" => 'vector order',
                  "OrderStatus" => 0,
                  "Msg"   => 'Your Order has been submit.',
                  "DesignName" => $Cus_order->DesignName,
                  "RequriedFormat" => $Cus_order->ReqFormat,
                  "Vecuse" => $Cus_order->UsedFor,
                  "Width" => $Cus_order->Width,
                  "Height" => $Cus_order->Height,
                  "Scale" => $Cus_order->Scale,
                  "Reqclr" => $Cus_order->ReqColor,
                  "NumClr" => $Cus_order->NoOfColors,
                  "ADDITIONALINSTRUCTIONS" => $Cus_order->MoreInstructions
                  ] 
                    , function($message) use ($mailFrom) {
                    
                        $message->to(Input::get('Email'))->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Order Confirmation');
            });


                  if(\Mail::failures()){

                  $mailFrom = 'technical-team@logoartz.com';
                  \Mail::send('includes.emails.vecsubmitorder', [
                  "CustomerName" => $Name,
                  "OrderType" => 'vector order',
                  "OrderStatus" => 0,
                  "Msg"   => 'Your Order has been submit.',
                  "DesignName" => $Cus_order->DesignName,
                  "RequriedFormat" => $Cus_order->ReqFormat,
                  "Vecuse" => $Cus_order->UsedFor,
                  "Width" => $Cus_order->Width,
                  "Height" => $Cus_order->Height,
                  "Scale" => $Cus_order->Scale,
                  "Reqclr" => $Cus_order->ReqColor,
                  "NumClr" => $Cus_order->NoOfColors,
                  "ADDITIONALINSTRUCTIONS" => $Cus_order->MoreInstructions
                  ] 
                    , function($message) use ($mailFrom, $ccMail) {
                    
                        $message->to(Input::get('Email'))->from($mailFrom, 'Logo Artz')->cc($ccMail)->subject('Logo Artz - Order Confirmation');
            });

                  }

              
                }






                DB::table('customers')->where('CustomerID', $CustomerID)->update(['FreeOrderPlaced' => 1]);


                 $ActivationCode = sha1(md5($CustomerID)) . $CustomerID;

                DB::table('customers')->where('CustomerID', $CustomerID)->update(['ActivationCode' => $ActivationCode]);
                
                
            // Email for Customer

                  $mailFrom = 'technical-team@logoartz.com';
                  \Mail::send('includes.emails.register', [
                  "FirstName" => Input::get('CustomerName'),
                "ActivationCode" => url('activate-user/' . $ActivationCode)
                    ]
                    , function($message) use ($mailFrom) {
                $message->to(Input::get('Email'))->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Email Verification');
            });
            
                if(\Mail::failures()){
                       $mailFrom = 'technical-team@logoartz.com';
                  \Mail::send('includes.emails.register', [
                  "FirstName" => Input::get('CustomerName'),
                "ActivationCode" => url('activate-user/' . $ActivationCode)
                    ]
                    , function($message) use ($mailFrom) {
                     $message->to(Input::get('Email'))->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Email Verification');
                    });
                }elseif(\Mail::failures()){
                    
                                 $mailFrom = 'technical-team@logoartz.com';
                  \Mail::send('includes.emails.register', [
                  "FirstName" => Input::get('CustomerName'),
                "ActivationCode" => url('activate-user/' . $ActivationCode)
                    ]
                    , function($message) use ($mailFrom) {
                     $message->to(Input::get('Email'))->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Email Verification');
                    });
                    
                }elseif(\Mail::failures()){
                                 $mailFrom = 'technical-team@logoartz.com';
                  \Mail::send('includes.emails.register', [
                      "FirstName" => Input::get('CustomerName'),
                    "ActivationCode" => url('activate-user/' . $ActivationCode)
                        ]
                    , function($message) use ($mailFrom) {
                     $message->to(Input::get('Email'))->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Email Verification');
                    });
                    
                }else{
                    if(\Mail::failures()){
                         return redirect('login')->with('success', 'Registered Successfully, Registered Successfully, varification email fail please contact info@logoartz.com');
                    }else{
                        
                         return redirect('login')->with('success', 'Registered Successfully, please check your email for further steps');
                    }
                    
                    
                }



            } else {
                return redirect()->back()->withErrors("You have already placed your free order")->withInput();
            }
        }
    
    
    
}



    public function cus_due_biling_invoices()
    {
        $CustomerID = \Session::get('CustomerID');
        $Configg = DB::table('configuration')->get(); 
        //Customer Detail
        //Done Orders Detail
        //

        $customerdetail = DB::table('customers')->where('CustomerID' , $CustomerID)->first();
        $DigiOdersData = DB::table('digitizing_orders')
                        ->where('CustomerID', $CustomerID)
                        ->where('OrderType', '<>' , 2)
                        ->where('Status', 7)->get();
        $VectorOdersData = DB::table('vector_order')
                        ->where('CustomerID', $CustomerID)
                        ->where('OrderType', '<>' , 2)
                        ->where('Status', 7)->get();

        


        $TodayDate = new \DateTime();


    return view('invbldview', $this->data, compact('Config', 'customerdetail', 'DigiOdersData', 'VectorOdersData', 'TodayDate'));

    }

  public function dgetaccdata(){
        $CustomerID = \Session::get('CustomerID');
 
        $this->data['AllData'] =  DB::table('digitizing_orders')
        ->where('CustomerID', $CustomerID)
        ->where('Status', 7)        
        ->get();

        $this->data['heading'] = 'Digitizing Accounts Records';

        return view('digi_acc_sum', $this->data);
    }

 public function vgetsccdataforcus(){

        $CustomerID = \Session::get('CustomerID');
 
       $this->data['AllData'] =  DB::table('vector_order')
        ->where('CustomerID', $CustomerID)
        ->where('Status', 7)
        ->get();

        $this->data['heading'] = 'Vector Accounts Records';

        return view('vec_acc_sum', $this->data);
       
    }

   



public function cus_due_biling()
{



}




    public function accountsdetails()
    {
        $cusid = \Session::get('CustomerID');

        
        DB::table('digitizing_orders')->where('OrderID', '');

         // $this->data['OrdersData'] = \App\DigiOrders::select('digitizing_orders.OrderID', 'vector_order.VectorOrderID', 'CustomerName', 'DesignName', 'PONumber', 'OrderType', 'Price', '')
         //    ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
         //    ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
         //    ->where('digitizing_orders.Status', 8)
         //    ->orderby('digitizing_orders.OrderID', 'desc')
         //    ->get();  

        $this->data['types'] = Config('order_types');
        $this->data['heading'] = 'Quote Confirmations';
        $this->data['status'] = 'Required Confirmation';


                return view('accounts', $this->data);
    }

    public function getalldigiqoutrecord(){
        // $c = new Home();
        // $c->checklogin();
        // checklogin();

         $this->data['statuses'] = [
                    0 => 'Pending',
                    1 => 'Pending',
                    2 => 'Pending',
                    3 => 'Quote Done',
                    4 => 'Processing',
                    5 => 'Processing',
                    6 => 'Processing',
                    7 => 'Completed',
                    8 => 'Done',
                    9 => 'Cancelled',
                    10 => 'Processing',
        ];

        $arr = [
            'all' => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
            'pending' => [0, 1, 2],
            'quote' => [3],
            'underprocess' => [4, 5, 6],
            'completed' => [7],
            'done' => [8],
        ];

        //   $this->data['statuses'] = [
        //             0 => 'quotes',
        //             1 => 'orders',
        // ];

        // $arr = [
        //     'all' => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
        //     'pending' => [0, 1, 2],
        //     'quote' => [3],
        //     'underprocess' => [4, 5, 6],
        //     'completed' => [7],
        //     'done' => [8],
        // ];

    $cusID = \Session::get('CustomerID');

    // $this->data['statuses'] = \Config::get('order_statuses');
    $this->data['allrecords'] = DB::table('digitizing_orders')->where('CustomerID', $cusID)->where('OrderType', 2)->orderby('DateModified', 'desc')->get();
    $this->data['types'] = Config('order_types');
    $this->data['heading'] = 'My Orders';
    $this->data['status'] = 'Order Completed';
    $this->data['headingg']  = 'Digitizing Quotes Records';

    return view('digisumm', $this->data);
    }


    public function getalldigiorderrecord(){

$this->data['statuses'] = [
                    0 => 'Pending',
                    1 => 'Pending',
                    2 => 'Pending',
                    3 => 'Quote Done',
                    4 => 'Processing',
                    5 => 'Processing',
                    6 => 'Processing',
                    7 => 'Completed',
                    8 => 'Done',
                    9 => 'Cancelled',
                    10 => 'Processing',
        ];
        $arr = [
            'all' => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
            'pending' => [0, 1, 2],
            'quote' => [3],
            'underprocess' => [4, 5, 6],
            'completed' => [7],
            'done' => [8],
        ];

   

    $cusID = \Session::get('CustomerID');


    $this->data['allrecords'] = DB::table('digitizing_orders')->where('CustomerID', $cusID)
    ->where('OrderType', '<>',  2)->where('OrderType', '!=', 2)->where('OrderType', '!=', 4)->where('OrderType', '!=', 8)
    ->orderby('DateModified', 'desc')->get();

    $this->data['types'] = Config('order_types');
    // $this->data['statuses'] = \Config::get('order_statuses');
    $this->data['headingg'] = 'Digitizing Orders Records';    


    //dd($this->data['allrecords']);

     return view('digisumm', $this->data);

    }
    


    public function getallvectororderrecord(){
      
        $this->data['statuses'] = [
                    0 => 'Pending',
                    1 => 'Pending',
                    2 => 'Pending',
                    3 => 'Quote Done',
                    4 => 'Processing',
                    5 => 'Processing',
                    6 => 'Processing',
                    7 => 'Completed',
                    8 => 'Done',
                    9 => 'Cancelled',
                    10 => 'Processing',
        ];
    $cusID = \Session::get('CustomerID');

    $this->data['allrecords'] = DB::table('vector_order')->where('CustomerID', $cusID)
    ->where('OrderType', '<>',  2)->where('OrderType', '!=', 2)->where('OrderType', '!=', 4)->where('OrderType', '!=', 8)->orderby('DateModified', 'desc')
    ->get();
   
     $this->data['types'] = Config('order_types');
     // $this->data['statuses'] = \Config::get('order_statuses');
    
     $this->data['headingg'] = 'Vector Orders Records';   




     return view('vecsumm', $this->data);

    }
    

     public function getallvectorqoutrecord(){

           $this->data['statuses'] = [
                    0 => 'Pending',
                    1 => 'Pending',
                    2 => 'Pending',
                    3 => 'Quote Done',
                    4 => 'Processing',
                    5 => 'Processing',
                    6 => 'Processing',
                    7 => 'Completed',
                    8 => 'Done',
                    9 => 'Cancelled',
                    10 => 'Processing',
        ];

    $cusID = \Session::get('CustomerID');

    $this->data['allrecords'] = DB::table('vector_order')->where('CustomerID', $cusID)->where('OrderType', 2)
    ->where('OrderType', '!=', 3)->where('OrderType', '!=', 0)->where('OrderType', '!=', 1)->where('OrderType', '!=', 9)->orderby('DateModified', 'desc')->get();


  
     $this->data['types'] = Config('order_types');
    
     $this->data['headingg'] = 'Vector Quote Records';   


     return view('vecsumm', $this->data);
    
    }



    public function invprpdf(){
          // $orders = DB::table("digitizing_orders")->get();
          // view()->share('digitizing_orders',$orders);
           //  $data = [];

       //    $pdf = PDF::loadView('welcome', $data)
        //   ->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        //   return $pdf->download('invoice.pdf');
       //     die;

        $CustomerID = \Session::get('CustomerID');

     
        $this->data['customerdetail'] = DB::table('customers')->where('CustomerID' , $CustomerID)->first();
        $this->data['DigiOdersData'] = DB::table('digitizing_orders')
                        ->where('CustomerID', $CustomerID)
                        ->where('OrderType', '<>' , 2)
                        ->where('Status', 7)->get();
        $this->data['VectorOdersData'] = DB::table('vector_order')
                        ->where('CustomerID', $CustomerID)
                        ->where('OrderType', '<>' , 2)
                        ->where('Status', 7)->get();

        
        $this->data['Configg'] = new \DateTime();

          $pdf = PDF::loadView('pdfinvbldview', $this->data)
          ->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
          return $pdf->download('invoice.pdf');
    
    // return view('pdfview', compact('orders'));
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
                    ->whereRaw(("Username = '" . Input::get('Username') . "'"))->first();

                if($user->Status == 0){
                       return redirect()->back()->withErrors("your account has been blocked, please contact at info@logoartz.com");
                       exit();
                }

            // $user = DB::table('customers')
            //         ->whereRaw(("Username = '" . Input::get('Username') . "'"))
            //         ->where('Status', 1)
            //         ->first();
            if (!empty($user)) {
                if (Hash::check(Input::get('Password'), $user->Password)) {
                    if ($user->IsActivated == 0) {
                        return redirect()->back()->withErrors("Account is not activated, please check your emial and activate your account");
                    } else {
                        \Session::put('CustomerLogin', true);
                        \Session::put("CustomerID", $user->CustomerID);
                        \Session::put("SalesPersonID", $user->SalesPersonID);
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
