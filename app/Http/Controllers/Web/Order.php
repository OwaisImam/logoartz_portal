<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Input;
use Validator;
use Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\VectorRevFiles;
use App\Models\VectorRevision;
use App\DigiRevFiles;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Order extends CustomerController {

    function __construct() {
        if (\Session::has('CustomerID')) {
            $data = \DB::table('customers')->where('CustomerID', \Session::get('CustomerID'))->first();
            if ($data->Status == 0) {
                \Redirect::to('/CustomerDash')->send();
                exit();
            }
        }
        parent::__construct();
    }

    public function index() {
        $this->data['countries_dd'] = $this->countries_dd();
        $this->data['currencies_dd'] = $this->currencies_dd();
        $this->data['hear_about_dd'] = \Config::get('hear_about');
        $this->data['card_types_dd'] = \Config::get('card_types');
        return view('register', $this->data);
    }

    public function vector() {

        return view('vector_order', $this->data);
    }

    public function digitizing() {

        return view('digitizing_order', $this->data);
    }

    public function vector_quote() {

        return view('vector_quote', $this->data);
    }

    public function digi_quote() {

        return view('digitizing_quote', $this->data);
    }


  

    public function plc_vector_order() {
        $fileCount = 0;

        $error1 = false;
        $msg1 = "";

        $error2 = false;
        $msg2 = "";

        $error3 = false;
        $msg3 = "";

        $error4 = false;
        $msg4 = "";

        $errors = false;


        $allowed_ext = ['jpg', 'JPG', 'JPEG', 'jpeg', 'png', "PNG", 'gif', 'GIF','EMB', 'emb', 'DST', 'dst' , 'PDF', 'pdf' , 'ai' , 'AI' , 'CDR' , 'cdr' , 'pof', 'POF' , 'pxf', 'PXF' , 'Exp', 'exp', 'CND' , 'cnd', 'ppt', 'PPT' , 'docx', 'DOCX' ,'PES', 'pes', 'xxx', 'XXX','toyota100', 'TOYOTA100', 'eps' , 'EPS'];

        if (Input::hasFile('FileOne')) {
            $fl = Input::file('FileOne');
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

        if (Input::hasFile('FileTwo')) {
            $fl = Input::file('FileTwo');
            if (!empty($fl)) {
                $ext = $fl->getClientOriginalExtension();
                if (!in_array($ext, $allowed_ext)) {
                    $error2 = true;
                    $msg2 = "Invalid File type";
                } else {
                    $fileCount++;
                }
            }
        }


        if (Input::hasFile('FileThree')) {
            $fl = Input::file('FileThree');
            if (!empty($fl)) {
                $ext = $fl->getClientOriginalExtension();
                if (!in_array($ext, $allowed_ext)) {
                    $error3 = true;
                    $msg3 = "Invalid File type";
                } else {
                    $fileCount++;
                }
            }
        }





        if (Input::hasFile('FileFour')) {
            $fl = Input::file('FileFour');
            if (!empty($fl)) {
                $ext = $fl->getClientOriginalExtension();
                if (!in_array($ext, $allowed_ext)) {
                    $error4 = true;
                    $msg4 = "Invalid File type";
                } else {
                    $fileCount++;
                }
            }
        }






        $valid["DesignName"] = 'required|max:20';
        $valid["PoNum"] = 'max:20';
        $valid["ReqFormat"] = 'required|max:50';
        if (Input::has('ReqFormat') && Input::get('ReqFormat') == "Other") {
            $valid["OtherFormat"] = 'required|max:100';
        }
        $valid["UsedFor"] = 'required|max:100';
        $valid["Width"] = 'required|max:100';
        $valid["Height"] = 'required|max:100';
        $valid["Scale"] = 'required|max:1000';
        $valid["RequriedClr"] = 'required|max:100';
        $valid["NumofClr"] = 'required|max:20';
        $valid["ReqSep"] = 'required|max:100';
        $valid["AddIns"] = 'max:100';
        $valid["CCOrder"] = 'max:100';
        $valid["OrderType"] = 'required|max:100';


        $valid_name["DesignName"] = "Design Name";
        $valid_name["ReqFormat"] = "Requried Format";
        $valid_name["OtherFormat"] = "Other Format";
        $valid_name["UsedFor"] = "Design User For";
        $valid_name["Width"] = "Width";
        $valid_name["Height"] = "Height";
        $valid_name["Scale"] = "Scale";
        $valid_name["RequriedClr"] = "Requried Color";
        $valid_name["NumofClr"] = "Number of Color";
        $valid_name["ReqSep"] = "Requried Seperation";
        $valid_name["AddIns"] = "Addistional Instruction";
        $valid_name["OrderType"] = "Order Type Urgent or Normal";



        $messages = [
            'required' => 'Please enter :attribute.',
            'CountryID.min' => 'Please select :attribute.',
            'max' => 'No more characters allowed in :attribute.'
        ];

        $v = Validator::make(Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);

        if ($v->fails() || $error1 || $error2 || $error3 || $error4 || $errors || $fileCount == 0) {
            if ($error1 || $error2 || $error3 || $error4 || $errors || $fileCount == 0) {

                if ($fileCount == 0) {
                    return redirect()->back()->withErrors($v->errors())->withInput()->with('warning_msg', "Please upload artwork");
                } else {
                    return redirect()->back()->withErrors($v->errors())->withInput()->with('warning_msg', $msg1 . '<br>' . $msg2 . '<br>' . $msg3 . '<br>' . $msg4);
                }
            } else {
                return redirect()->back()->withErrors($v->errors())->withInput();
            }
        } else {

            $ordertype = 0;

            $CustomerID = \Session::get('CustomerID');

            $free_placed = \DB::table('customers')->where('CustomerID', $CustomerID)->where('FreeOrderPlaced', 1)->count();

            if ($free_placed == 0) {
                $ordertype = 3;
                \DB::table('customers')->where('CustomerID', $CustomerID)->update(['FreeOrderPlaced' => 1]);
            }
            $OrderData = [

                'CustomerID' => $CustomerID,
                'DesignName' => Input::get('DesignName'),
                'SalesPersonID' => \Session::get('SalesPersonID'),
                'PONumber' => Input::get('PoNum'),
                'ReqFormat' => Input::get('ReqFormat'),
                'UsedFor' => Input::get('UsedFor'),
                'Width' => Input::get('Width'),
                'Height' => Input::get('Height'),
                'Scale' => Input::get('Scale'),
                'ReqColor' => Input::get('RequriedClr'),
                'NoOfColors' => Input::get('NumofClr'),
                'ReqSeparation' => Input::get('ReqSep'),
                'MoreInstructions' => Input::get('AddIns'),
                'File1' => Input::get('File1'),
                'File2' => Input::get('File2'),
                'CC' => Input::get('CCOrder'),
                'Status' => 4,
                'OrderType' => $ordertype,
                'OrderStatus' => Input::get('OrderType'),
                'DateAdded' => new \DateTime(),
                'DateModified' => new \DateTime()
            ];

           \App\vector_order::insert($OrderData);

            $InsertID = \DB::getPdo()->lastInsertId();

            if (Input::hasFile('FileOne')) {
                $fl = Input::file('FileOne');
                if (!empty($fl)) {
                    $filename1 = $InsertID . '_' . str_random(5) . '1.' . $fl->getClientOriginalExtension();

                    $path = public_path('uploads') . '/orders/vector/';
                    $fl->move($path ,$filename1);
                    $attachFiles[] = $path. $filename1;
                    \DB::table('vector_order')->where('VectorOrderID', $InsertID)->update(['File1' => $filename1]);
                }
            }

            if (Input::hasFile('FileTwo')) {
                $fl = Input::file('FileTwo');
                if (!empty($fl)) {
                    $filename2 = $InsertID . '_' . str_random(5) . '2.' . $fl->getClientOriginalExtension();

                    $path = public_path('uploads') . '/orders/vector/';
                    $fl->move($path ,$filename2);
                    $attachFiles[] = $path. $filename2;
                    \DB::table('vector_order')->where('VectorOrderID', $InsertID)->update(['File2' => $filename2]);
                }
            }

            if (Input::hasFile('FileThree')) {
                $fl = Input::file('FileThree');
                if (!empty($fl)) {
                    $filename3 = $InsertID . '_' . str_random(5) . '3.' . $fl->getClientOriginalExtension();

                    $path = public_path('uploads') . '/orders/vector/';
                     $fl->move($path ,$filename3);
                     $attachFiles[] = $path. $filename3;
                     \DB::table('vector_order')->where('VectorOrderID', $InsertID)->update(['File3' => $filename3]);
                }
            }

            if (Input::hasFile('FileFour')) {
                $fl = Input::file('FileFour');
                if (!empty($fl)) {
                    $filename4 = $InsertID . '_' . str_random(5) . '4.' . $fl->getClientOriginalExtension();

                    $path = public_path('uploads') . '/orders/vector/';
                    $fl->move($path ,$filename4);
                    $attachFiles[] = $path. $filename4;
                    \DB::table('vector_order')->where('VectorOrderID', $InsertID)->update(['File4' => $filename4]);
                }
            }
            
            
            
             $CustomerID = \Session::get('CustomerID');
             $Cus_info =  DB::table('customers')->where('CustomerID', $CustomerID)->first();
             $Cus_order = DB::table('vector_order')->where('VectorOrderID', $InsertID)->first();
             
             
                 $email = '';
                 $cus_email = $Cus_info->Email;
                 $email = $cus_email;
                 $Name = $Cus_info->CustomerName;
                 $Cell = $Cus_info->Cell;
                 $Company = $Cus_info->Company;
                 
                  

                
                 if(Input::get('CCOrder') != ''){
                     $ccMail = Input::get('CCOrder');

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
                    , function($message) use ($mailFrom, $ccMail, $attachFiles) {
                    
                        $message->to(\Session::get('Email'))->from($mailFrom, 'Logo Artz')->cc($ccMail)->subject('Logo Artz - Order Confirmation');
                        if (!empty($attachFiles)) {
                            foreach ($attachFiles as $attachmentPath) {
                                if (file_exists($attachmentPath)) {
                                    $message->attach($attachmentPath);
                                }
                            }
                        }
            });

                 }else{

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
                    , function($message) use ($mailFrom, $attachFiles) {
                    
                        $message->to(\Session::get('Email'))->from($mailFrom, 'Logo Artz')
                        ->subject('Logo Artz - Order Confirmation');
                        if (!empty($attachFiles)) {
                            foreach ($attachFiles as $attachmentPath) {
                                if (file_exists($attachmentPath)) {
                                    $message->attach($attachmentPath);
                                }
                            }
                        }
                         });
                 }

                
        
            // Email for Admin
                
                $mailFrom = 'technical-team@logoartz.com';
                  \Mail::send('includes.emails.vecsubmitorder', [
                  "CustomerName" => $Name,
                   "CusEmail" => $email,
                  "CusPhone" => $Cell,
                  "CusCompany" => $Company,
                  "OrderType" => 'vector order',
                  "OrderStatus" => 1,
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
                    , function($message) use ($mailFrom, $attachFiles) {
                $message->to('info@logoartz.com')->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Vector Order Received');
                if (!empty($attachFiles)) {
                    foreach ($attachFiles as $attachmentPath) {
                        if (file_exists($attachmentPath)) {
                            $message->attach($attachmentPath);
                        }
                    }
                }
            });

            

            return redirect('/vector-order')->with('success', 'Thank You !! Order Submitted Successfully');
        }
    }

    public function plc_vector_quote() {

        $fileCount = 0;

        $error1 = false;
        $msg1 = "";

        $error2 = false;
        $msg2 = "";

        $error3 = false;
        $msg3 = "";

        $error4 = false;
        $msg4 = "";

        $errors = false;


        $errors = false;

         $allowed_ext = ['jpg', 'JPG', 'JPEG', 'jpeg', 'png', "PNG", 'gif','EMB', 'DST', 'PDF', 'ai' , 'cdr' , 'pof', 'pxf', "Exp", 'cnd', 'ppt', 'doc', 'PES', 'xxx', 'toyota100', 'eps'];

        if (Input::hasFile('FileOne')) {
            $fl = Input::file('FileOne');
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




        if (Input::hasFile('FileTwo')) {
            $fl = Input::file('FileTwo');
            if (!empty($fl)) {
                $ext = $fl->getClientOriginalExtension();
                if (!in_array($ext, $allowed_ext)) {
                    $error2 = true;
                    $msg2 = "Invalid File type";
                } else {
                    $fileCount++;
                }
            }
        }



        if (Input::hasFile('FileThree')) {
            $fl = Input::file('FileThree');
            if (!empty($fl)) {
                $ext = $fl->getClientOriginalExtension();
                if (!in_array($ext, $allowed_ext)) {
                    $error3 = true;
                    $msg3 = "Invalid File type";
                } else {
                    $fileCount++;
                }
            }
        }


        if (Input::hasFile('FileFour')) {
            $fl = Input::file('FileFour');
            if (!empty($fl)) {
                $ext = $fl->getClientOriginalExtension();
                if (!in_array($ext, $allowed_ext)) {
                    $error3 = true;
                    $msg3 = "Invalid File type";
                } else {
                    $fileCount++;
                }
            }
        }

          


        $valid["DesignName"] = 'required|max:30';
        $valid["PoNum"] = 'max:20';
        $valid["ReqFormat"] = 'required|max:50';
        if (Input::has('ReqFormat') && Input::get('ReqFormat') == "Other") {
            $valid["OtherFormat"] = 'required|max:100';
        }
        $valid["UsedFor"] = 'required|max:100';
        $valid["Width"] = 'required|max:100';
        $valid["Height"] = 'required|max:100';
        $valid["Scale"] = 'required|max:1000';
        $valid["RequriedClr"] = 'required|max:100';
        $valid["NumofClr"] = 'required|max:20';
        $valid["ReqSep"] = 'required|max:100';
        $valid["AddIns"] = 'max:100';
        $valid["CCOrder"] = 'max:1000';
        $valid["OrderType"] = 'required|max:100';



        $valid_name["DesignName"] = "Design Name";
        $valid_name["ReqFormat"] = "Requried Format";
        $valid_name["OtherFormat"] = "Other Format";
        $valid_name["UsedFor"] = "Design User For";
        $valid_name["Width"] = "Width";
        $valid_name["Height"] = "Height";
        $valid_name["Scale"] = "Scale";
        $valid_name["RequriedClr"] = "Requried Color";
        $valid_name["NumofClr"] = "Number of Color";
        $valid_name["ReqSep"] = "Requried Seperation";
        $valid_name["AddIns"] = "Addistional Instruction";
        $valid_name["CCOrder"] = "CC Order";
        $valid_name["OrderType"] = "Order Type Urgent or Normal";

        $messages = [
            'required' => 'Please enter :attribute.',
            'CountryID.min' => 'Please select :attribute.',
            'max' => 'No more characters allowed in :attribute.'
        ];

        $v = Validator::make(Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);




        if ($v->fails() || $error1 || $error2 || $error3 || $error4 || $errors || $fileCount == 0) {
            if ($error1 || $error2 || $error3 || $error4 || $errors || $fileCount == 0) {

                if ($fileCount == 0) {
                    return redirect()->back()->withErrors($v->errors())->withInput()->with('warning_msg', "Please upload artwork");
                } else {
                    return redirect()->back()->withErrors($v->errors())->withInput()->with('warning_msg', $msg1 . '<br>' . $msg2 . '<br>' . $msg3 . '<br>' . $msg4);
                }
            } else {
                return redirect()->back()->withErrors($v->errors())->withInput();
            }
        } else {

            $OrderData = [

                'CustomerID' => \Session::get('CustomerID'),
                'DesignName' => Input::get('DesignName'),
                'PONumber' => Input::get('PoNum'),
                'ReqFormat' => Input::get('ReqFormat'),
                'UsedFor' => Input::get('UsedFor'),
                'Width' => Input::get('Width'),
                'Height' => Input::get('Height'),
                'Scale' => Input::get('Scale'),
                'ReqColor' => Input::get('RequriedClr'),
                'NoOfColors' => Input::get('NumofClr'),
                'ReqSeparation' => Input::get('ReqSep'),
                'MoreInstructions' => Input::get('AddIns'),
                'SalesPersonID' => \Session::get('SalesPersonID'),
                'File1' => Input::get('File1'),
                'File2' => Input::get('File2'),
                'CC' => Input::get('CCOrder'),
                'Status' => 0,
                'OrderType' => 2,
                'OrderStatus' => Input::get('OrderType'),
                'DateAdded' => new \DateTime(),
                'DateModified' => new \DateTime()
            ];




            DB::table('vector_order')->insert($OrderData);

            $InsertID = \DB::getPdo()->lastInsertId();


            if (Input::hasFile('FileOne')) {
                $fl = Input::file('FileOne');
                if (!empty($fl)) {
                    $filename1 = $InsertID . '_' . str_random(5) . 'quote1.' . $fl->getClientOriginalExtension();

                    $path = public_path('uploads') . '/orders/vector/';
                    $fl->move($path ,$filename1);
                    $attachFiles[] = $path. $filename1;
                    \DB::table('vector_order')->where('VectorOrderID', $InsertID)->update(['File1' => $filename1]);
                }
            }



            if (Input::hasFile('FileTwo')) {
                $fl = Input::file('FileTwo');
                if (!empty($fl)) {
                    $filename2 = $InsertID . '_' . str_random(5) . 'quote2.' . $fl->getClientOriginalExtension();

                    $path = public_path('uploads') . '/orders/vector/';
                     $fl->move($path ,$filename2);
                     $attachFiles[] = $path. $filename2;
                     \DB::table('vector_order')->where('VectorOrderID', $InsertID)->update(['File2' => $filename2]);
                }
            }



            if (Input::hasFile('FileThree')) {
                $fl = Input::file('FileThree');
                if (!empty($fl)) {
                    $filename3 = $InsertID . '_' . str_random(5) . 'quote3.' . $fl->getClientOriginalExtension();

                    $path = public_path('uploads') . '/orders/vector/';
                    $fl->move($path ,$filename3);
                    $attachFiles[] = $path. $filename3;
                    \DB::table('vector_order')->where('VectorOrderID', $InsertID)->update(['File3' => $filename3]);
                }
            }



            if (Input::hasFile('FileFour')) {
                $fl = Input::file('FileFour');
                if (!empty($fl)) {
                    $filename4 = $InsertID . '_' . str_random(5) . 'quote4.' . $fl->getClientOriginalExtension();

                    $path = public_path('uploads') . '/orders/vector/';
                     $fl->move($path ,$filename4);
                     $attachFiles[] = $path. $filename4;
                     \DB::table('vector_order')->where('VectorOrderID', $InsertID)->update(['File4' => $filename4]);
                }
            }
            
            
            
             
             $CustomerID = \Session::get('CustomerID');
             $Cus_info =  DB::table('customers')->where('CustomerID', $CustomerID)->first();
             $Cus_order = DB::table('vector_order')->where('VectorOrderID', $InsertID)->first();
             
             
                 $email = '';
                 $cus_email = $Cus_info->Email;
                 $email = $cus_email;
                 $Name = $Cus_info->CustomerName;
                 $Cell = $Cus_info->Cell;
                 $Company = $Cus_info->Company;
                
               // Email for Customer
                  $mailFrom = 'technical-team@logoartz.com';
                  \Mail::send('includes.emails.vecsubmitorder', [
                  "CustomerName" => $Name,
                  "OrderType" => 'vector quote',
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
                    , function($message) use ($mailFrom, $attachFiles) {
                $message->to(\Session::get('Email'))->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Quote Confirmation');
                if (!empty($attachFiles)) {
                    foreach ($attachFiles as $attachmentPath) {
                        if (file_exists($attachmentPath)) {
                            $message->attach($attachmentPath);
                        }
                    }
                }
            });
            
            // Email for Admin
            
            
                $mailFrom = 'technical-team@logoartz.com';
                  \Mail::send('includes.emails.vecsubmitorder', [
                  "CustomerName" => $Name,
                  "CusEmail" => $email,
                  "CusPhone" => $Cell,
                  "CusCompany" => $Company,
                  "OrderType" => 'vector quote',
                  "OrderStatus" => 1,
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
                    , function($message) use ($mailFrom, $attachFiles) {
                $message->to('info@logoartz.com')->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Vector Quote Received');
                if (!empty($attachFiles)) {
                    foreach ($attachFiles as $attachmentPath) {
                        if (file_exists($attachmentPath)) {
                            $message->attach($attachmentPath);
                        }
                    }
                }
            });



            return redirect('/vector_quote')->with('success', 'Thank You !! Quote Submited Successfully');
        }
    }

    public function plc_digi_order() {
        try {
            DB::beginTransaction();
            $fileCount = 0;

            $error1 = false;
            $msg1 = "";

            $error2 = false;
            $msg2 = "";

            $error3 = false;
            $msg3 = "";

            $error4 = false;
            $msg4 = "";

            $errors = false;

            $errors = false;

            $allowed_ext = ['jpg', 'pdf', 'PDF', 'JPG', 'JPEG', 'jpeg', 'eps', 'png', "PNG", 'psd', 'PSD','gif','EMB', 'DST', 'ai', 'PDF', 'cdr' , 'pof', 'pxf', "Exp", 'cnd', 'ppt', 'doc', 'PES', 'xxx', 'toyota100', 'eps'];

            if (Input::hasFile('FileOne')) {
                $fl = Input::file('FileOne');
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


            if (Input::hasFile('FileTwo')) {
                $fl = Input::file('FileTwo');
                if (!empty($fl)) {
                    $ext = $fl->getClientOriginalExtension();
                    if (!in_array($ext, $allowed_ext)) {
                        $error2 = true;
                        $msg2 = "Invalid File type";
                    } else {
                        $fileCount++;
                    }
                }
            }



            if (Input::hasFile('FileThree')) {
                $fl = Input::file('FileThree');
                if (!empty($fl)) {
                    $ext = $fl->getClientOriginalExtension();
                    if (!in_array($ext, $allowed_ext)) {
                        $error3 = true;
                        $msg3 = "Invalid File type";
                    } else {
                        $fileCount++;
                    }
                }
            }


            if (Input::hasFile('FileFour')) {
                $fl = Input::file('FileFour');
                if (!empty($fl)) {
                    $ext = $fl->getClientOriginalExtension();
                    if (!in_array($ext, $allowed_ext)) {
                        $error4 = true;
                        $msg4 = "Invalid File type";
                    } else {
                        $fileCount++;
                    }
                }
            }



            $valid["DesignName"] = 'required|max:20';
            $valid["PoNum"] = 'max:20';
            $valid["ReqFormat"] = 'required|max:50';
            if (Input::has('ReqFormat') && Input::get('ReqFormat') == "Other") {
                $valid["OtherFormat"] = 'required|max:100';
            }
            $valid["Fabric"] = 'required|max:100';

            $valid["Placement"] = 'required|max:100';
            $valid["Width"] = 'required|max:100';
            $valid["Height"] = 'required|max:100';
            $valid["Scale"] = 'required|max:1000';
            $valid["NumofClr"] = 'required|max:20';
            $valid["FabricClr"] = 'max:100';
            $valid["Clrblending"] = 'required|max:100';
            $valid["PicEmb"] = 'required|max:20';
            $valid["BackFill"] = 'required|max:100';
            $valid["AddIns"] = 'max:100';
            $valid["CCOrder"] = 'max:100';
            $valid["OrderType"] = 'required|max:100';


            $valid_name["DesignName"] = "Design Name";
            $valid_name["ReqFormat"] = "Requried Format";
            $valid_name["Fabric"] = "Fabrics";
            $valid_name["OtherFormat"] = "OtherFormat";
            $valid_name["Placement"] = "Placement";
            $valid_name["Width"] = "Width";
            $valid_name["Height"] = "Height";
            $valid_name["Scale"] = "Scale";
            $valid_name["NumofClr"] = "Number of Color";
            $valid_name["Clrblending"] = "Color Blending";
            $valid_name["FabricClr"] = "Fabric Color";
            $valid_name["PicEmb"] = "Piture Embroidery";
            $valid_name["BackFill"] = "Background Fill";
            $valid_name["AddIns"] = "Addistional Instruction";
            $valid_name["CCOrder"] = "CC Order";
            $valid_name["OrderType"] = "Order Type Urgent or Normal";

        


            $messages = [
                'required' => 'Please enter :attribute.',
                'CountryID.min' => 'Please select :attribute.',
                'max' => 'No more characters allowed in :attribute.'
            ];


            $v = Validator::make(Input::all(), $valid, $messages);
            $v->setAttributeNames($valid_name);

            if ($v->fails() || $error1 || $error2 || $error3 || $error4 || $fileCount == 0) {
                if ($error1 || $error2 || $error3 || $error4 || $errors || $fileCount == 0) {
                    

                    if ($fileCount == 0) {
                        return redirect()->back()->withErrors($v->errors())->withInput()->with('warning_msg', "Please upload artwork");
                    } else {
                        return redirect()->back()->withErrors($v->errors())->withInput()->with('warning_msg', $msg1 . '<br>' . $msg2 . '<br>' . $msg3 . '<br>' . $msg4);
                    }
                } else {
                    return redirect()->back()->withErrors($v->errors())->withInput();
                }
            } else 
            {

                $ordertype = 0;

                $CustomerID = \Session::get('CustomerID');

                $free_placed = \DB::table('customers')->where('CustomerID', $CustomerID)->where('FreeOrderPlaced', 1)->count();

                if ($free_placed == 0) {
                    $ordertype = 3;
                    \DB::table('customers')->where('CustomerID', $CustomerID)->update(['FreeOrderPlaced' => 1]);
                }
                $OrderData = [

                    'CustomerID' => $CustomerID,
                    'DesignName' => Input::get('DesignName'),
                    'SalesPersonID' => \Session::get('SalesPersonID'),
                    'PONumber' => Input::get('PoNum'),
                    'ReqFormat' => Input::get('ReqFormat'),
                    'OtherFormat' => Input::get('OtherFormat'),
                    'Fabric' => Input::get('Fabric'),
                    'Placement' => Input::get('Placement'),
                    'Width' => Input::get('Width'),
                    'Height' => Input::get('Height'),
                    'Scale' => Input::get('Scale'),
                    'NoOfColors' => Input::get('NumofClr'),
                    'FabricColor' => Input::get('FabricClr'),
                    'ColorBlending' => Input::get('Clrblending'),
                    'BackgroundFill' => Input::get('BackFill'),
                    'PictureEmbroidery' => Input::get('PicEmb'),
                    'MoreInstructions' => Input::get('AddIns'),
                    'File1' => Input::get('File1'),
                    'File2' => Input::get('File2'),
                    'CC' => Input::get('CCOrder'),
                    'Status' => 4,
                    'OrderType' => $ordertype,
                    'OrderStatus' => Input::get('OrderType'),
                    'DateAdded' => new \DateTime(),
                    'DateModified' => new \DateTime()
                ];


                DB::table('digitizing_orders')->insert($OrderData);

                $InsertID = \DB::getPdo()->lastInsertId();

                if (Input::hasFile('FileOne')) {
                    $fl = Input::file('FileOne');
                    if (!empty($fl)) {

                        $filename1 = $InsertID . '_' . str_random(5) . '1.' . $fl->getClientOriginalExtension();
                        $path = public_path('uploads') . '/orders/digi/';
                        $fl->move($path ,$filename1);

                        $attachFiles[] = $path. $filename1;

                        \DB::table('digitizing_orders')->where('OrderID', $InsertID)->update(['File1' => $filename1]);
                    }
                }

                if (Input::hasFile('FileTwo')) {
                    $fl = Input::file('FileTwo');
                    if (!empty($fl)) {
                        $filename2 = $InsertID . '_' . str_random(5) . '2.' . $fl->getClientOriginalExtension();

                        $path = public_path('uploads') . '/orders/digi/';
                        $fl->move($path ,$filename2);
                        $attachFiles[] = $path. $filename2;
                        \DB::table('digitizing_orders')->where('OrderID', $InsertID)->update(['File2' => $filename2]);
                    }
                }


                if (Input::hasFile('FileThree')) {
                    $fl = Input::file('FileThree');
                    if (!empty($fl)) {
                        $filename3 = $InsertID . '_' . str_random(5) . '3.' . $fl->getClientOriginalExtension();
                        $path = public_path('uploads') . '/orders/digi/';
                        $fl->move($path ,$filename3);
                        $attachFiles[] = $path. $filename3;
                        \DB::table('digitizing_orders')->where('OrderID', $InsertID)->update(['File3' => $filename3]);
                    }
                }



                if (Input::hasFile('FileFour')) {
                    $fl = Input::file('FileFour');
                    if (!empty($fl)) {
                        $filename4 = $InsertID . '_' . str_random(5) . '4.' . $fl->getClientOriginalExtension();
                        $path = public_path('uploads') . '/orders/digi/';
                        $fl->move($path ,$filename4);
                        $attachFiles[] = $path. $filename4;
                        \DB::table('digitizing_orders')->where('OrderID', $InsertID)->update(['File4' => $filename4]);
                    }
                }
                
                
                
                $CustomerID = \Session::get('CustomerID');
                $Cus_info =  DB::table('customers')->where('CustomerID', $CustomerID)->first();
                $Cus_order = DB::table('digitizing_orders')->where('OrderID', $InsertID)->first();
                
                
                    $email = '';
                    $cus_email = $Cus_info->Email;
                    $email = $cus_email;
                    $Name = $Cus_info->CustomerName;
                    $Cell = $Cus_info->Cell;
                    $Company = $Cus_info->Company;
                    
                    
                    if(Input::get('CCOrder') != ''){
                        $ccMail = Input::get('CCOrder');

                    $mailFrom = 'technical-team@logoartz.com';
                    Mail::send('includes.emails.digisubmitorder', [
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
                        , function($message) use ($mailFrom, $ccMail, $attachFiles) {
                                $message->to('owaisimam2@gmail.com')
                                ->cc($ccMail)
                                ->from($mailFrom, 'Logo Artz')
                                ->subject('Logo Artz - Order Confirmation');

                                if (!empty($attachFiles)) {
                                    foreach ($attachFiles as $attachmentPath) {
                                        if (file_exists($attachmentPath)) {
                                            $message->attach($attachmentPath);
                                        }
                                    }
                                }
                        });

                    }else{ 
                        
                        $mailFrom = 'technical-team@logoartz.com';
                        Mail::send('includes.emails.digisubmitorder', [
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
                            , function($message) use ($mailFrom, $attachFiles) {
                                    $message->to('owaisimam2@gmail.com')
                                    ->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Order Confirmation');
                                    if (!empty($attachFiles)) {
                                        foreach ($attachFiles as $attachmentPath) {
                                            if (file_exists($attachmentPath)) {
                                                $message->attach($attachmentPath);
                                            }
                                        }
                                    }
                            });
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
                    "ADDITIONALINSTRUCTIONS" => $Cus_order->MoreInstructions
                    ]
                        , function($message) use ($mailFrom, $attachFiles) {
                    $message->to('info@logoartz.com')->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Digitizing Order Received');
                    if (!empty($attachFiles)) {
                        foreach ($attachFiles as $attachmentPath) {
                            if (file_exists($attachmentPath)) {
                                $message->attach($attachmentPath);
                            }
                        }
                    }
                });
                DB::commit();
                return redirect('/digi-order')->with('success', 'Thank You !! Order Submited Successfully');
            }

        } catch(Exception $e) {
            Log::error($e);
            DB::rollback();
            return redirect('/digi-order')->with('error', 'Something went wrong');

        }
    }


        // public function countries_dd() {
        //     $query = \App\Countries::where('Status', 1);
        //     $parents = $query->select('CountryName', 'CountryID')->get();
        //     $parent_pages = ["0" => "Select Country"];
        //     if (count($parents) > 0) {
        //         foreach ($parents as $parent) {
        //             $parent_pages += [
        //                 $parent->CountryID => $parent->CountryName
        //             ];
        //         }
        //     }
        //     return $parent_pages;
        // }
        // public function currencies_dd() {
        //     $query = \App\Currencies::where('Status', 1);
        //     $parents = $query->select('Code', 'CurrencyID')->get();
        //     $parent_pages = ["0" => "Select Currency"];
        //     if (count($parents) > 0) {
        //         foreach ($parents as $parent) {
        //             $parent_pages += [
        //                 $parent->CurrencyID => $parent->Code
        //             ];
        //         }
        //     }
        //     return $parent_pages;
        // }
        // public function submit_reg() {
        //     $this->data['countries_dd'] = $this->countries_dd();
        //     $this->data['currencies_dd'] = $this->currencies_dd();
        //     $this->data['hear_about_dd'] = \Config::get('hear_about');
        //     $this->data['card_types_dd'] = \Config::get('card_types');
        //     return view('register', $this->data);
        //     exit();
        //     $valid["CountryID"] = 'required|integer|min:1';
        //     $valid["CustomerName"] = 'required|max:20';
        //     $valid["Cell"] = 'max:20';
        //     $valid["Email"] = 'email|max:50';
        //     $valid["Fax"] = 'max:100';
        //     $valid["Company"] = 'max:100';
        //     $valid["State"] = 'max:100';
        //     $valid["City"] = 'max:100';
        //     $valid["Address"] = 'max:1000';
        //     $valid["Zip"] = 'max:20';
        //     $valid["Username"] = 'required|max:100';
        //     $valid["Password"] = 'required|max:20';
        //     $valid["Status"] = 'required|integer|min:0|max:1';
        //     $valid_name["CountryID"] = "Country";
        //     $valid_name["CustomerName"] = "Customer Name";
        //     $valid_name["Cell"] = "Cell";
        //     $valid_name["Email"] = "Email";
        //     $valid_name["Fax"] = "Fax";
        //     $valid_name["Company"] = "Company";
        //     $valid_name["State"] = "State";
        //     $valid_name["City"] = "City";
        //     $valid_name["Address"] = "Address";
        //     $valid_name["Zip"] = "Zip";
        //     $valid_name["Username"] = "Username";
        //     $valid_name["Password"] = "Password";
        //     $valid_name["Status"] = "Status";
        //     $messages = [
        //         'required' => 'Please enter :attribute.',
        //         'CountryID.min' => 'Please select :attribute.',
        //         'max' => 'No more characters allowed in :attribute.'
        //     ];
        //     $v = Validator::make(Input::all(), $valid, $messages);
        //     $v->setAttributeNames($valid_name);
        //     if ($v->fails()) {
        //         return redirect()->back()->withErrors($v->errors())->withInput();
        //     } else {
        //         $user = DB::table('customers')
        //                 ->whereRaw(("Username = '" . Input::get('Username') . "'"))
        //                 ->where('Status', 1)
        //                 ->first();
        //         if (!empty($user)) {
        //             if (Hash::check(Input::get('Password'), $user->Password)) {
        //                 if ($user->IsActivated == 0) {
        //                     return redirect()->back()->withErrors("Account is not activated");
        //                 } else {
        //                     \Session::put('CustomerLogin', true);
        //                     \Session::put("CustomerID", $user->CustomerID);
        //                     \Session::put('CustomerName', $user->CustomerName);
        //                     \Session::put('Cell', $user->Cell);
        //                     \Session::put('Email', $user->Email);
        //                     return redirect('/');
        //                 }
        //             } else {
        //                 return redirect()->back()->withErrors("Invalid Username OR Password");
        //             }
        //         } else {
        //             return redirect()->back()->withErrors("Invalid Username OR Password");
        //         }
        //     }
        // }

        public function plc_digi_quote() {

        $fileCount = 0;

        $error1 = false;
        $msg1 = "";

        $error2 = false;
        $msg2 = "";

        $error3 = false;
        $msg3 = "";

        $error4 = false;
        $msg4 = "";

        $errors = false;


        $errors = false;

            $allowed_ext = ['jpg', 'JPG', 'JPEG', 'jpeg', 'png', "PNG", 'gif','EMB', 'DST', 'PDF', 'PSD', 'psd','ai' , 'cdr' , 'pof', 'pxf', "Exp", 'cnd', 'ppt', 'doc', 'PES', 'xxx', 'toyota100', 'eps'];

        if (Input::hasFile('FileOne')) {
            $fl = Input::file('FileOne');
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




        if (Input::hasFile('FileTwo')) {
            $fl = Input::file('FileTwo');
            if (!empty($fl)) {
                $ext = $fl->getClientOriginalExtension();
                if (!in_array($ext, $allowed_ext)) {
                    $error2 = true;
                    $msg2 = "Invalid File type";
                } else {
                    $fileCount++;
                }
            }
        }


        if (Input::hasFile('FileThree')) {
            $fl = Input::file('FileThree');
            if (!empty($fl)) {
                $ext = $fl->getClientOriginalExtension();
                if (!in_array($ext, $allowed_ext)) {
                    $error3 = true;
                    $msg3 = "Invalid File type";
                } else {
                    $fileCount++;
                }
            }
        }


        if (Input::hasFile('FileFour')) {
            $fl = Input::file('FileFour');
            if (!empty($fl)) {
                $ext = $fl->getClientOriginalExtension();
                if (!in_array($ext, $allowed_ext)) {
                    $error4 = true;
                    $msg4 = "Invalid File type";
                } else {
                    $fileCount++;
                }
            }
        }



        $valid["DesignName"] = 'required|max:20';
        $valid["PoNum"] = 'max:20';
        $valid["ReqFormat"] = 'required|max:50';
        $valid["Fabric"] = 'required|max:100';
        if (Input::has('ReqFormat') && Input::get('ReqFormat') == "Other") {
            $valid["OtherFormat"] = 'required|max:100';
        }
        $valid["Fabric"] = 'required|max:100';
        $valid["Placement"] = 'required|max:100';
        $valid["Width"] = 'required|max:100';
        $valid["Height"] = 'required|max:100';
        $valid["Scale"] = 'required|max:1000';
        $valid["NumofClr"] = 'required|max:20';
        $valid["FabricClr"] = 'max:100';
        $valid["Clrblending"] = 'required|max:100';
        $valid["PicEmb"] = 'required|max:20';
        $valid["BackFill"] = 'required|max:100';
        $valid["AddIns"] = 'max:100';
        $valid["CCOrder"] = 'max:1000';
        $valid["OrderType"] = 'required|max:100';


        $valid_name["DesignName"] = "Design Name";
        $valid_name["ReqFormat"] = "Requried Format";
        $valid_name["Fabric"] = "Fabrics";
        $valid_name["OtherFormat"] = "OtherFormat";
        $valid_name["Placement"] = "Placement";
        $valid_name["Width"] = "Width";
        $valid_name["Height"] = "Height";
        $valid_name["Scale"] = "Scale";
        $valid_name["NumofClr"] = "Number of Color";
        $valid_name["Clrblending"] = "Color Blending";
        $valid_name["FabricClr"] = "Fabric Color";
        $valid_name["PicEmb"] = "Piture Embroidery";
        $valid_name["BackFill"] = "Background Fill";
        $valid_name["AddIns"] = "Addistional Instruction";
        $valid_name["CCOrder"] = "CC Order";
        $valid_name["OrderType"] = "Order Type Urgent or Normal";




        $messages = [
            'required' => 'Please enter :attribute.',
            'CountryID.min' => 'Please select :attribute.',
            'max' => 'No more characters allowed in :attribute.'
        ];


        $v = Validator::make(Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);

        if ($v->fails() || $error1 || $error2 || $error3 || $error4 || $errors || $fileCount == 0) {
            if ($error1 || $error2 || $error3 || $error4 || $errors || $fileCount == 0) {

                if ($fileCount == 0) {
                    return redirect()->back()->withErrors($v->errors())->withInput()->with('warning_msg', "Please upload artwork");
                } else {
                    return redirect()->back()->withErrors($v->errors())->withInput()->with('warning_msg', $msg1 . '<br>' . $msg2 . '<br>' . $msg3 . '<br>' . $msg4);
                }
            } else {
                return redirect()->back()->withErrors($v->errors())->withInput();
            }
        } else {



            $CustomerID = \Session::get('CustomerID');

            $OrderData = [

                'CustomerID' => $CustomerID,
                'DesignName' => Input::get('DesignName'),
                'SalesPersonID' => \Session::get('SalesPersonID'),
                'PONumber' => Input::get('PoNum'),
                'ReqFormat' => Input::get('ReqFormat'),
                'Fabric' => Input::get('Fabric'),
                'Placement' => Input::get('Placement'),
                'Width' => Input::get('Width'),
                'Height' => Input::get('Height'),
                'Scale' => Input::get('Scale'),
                'NoOfColors' => Input::get('NumofClr'),
                'FabricColor' => Input::get('FabricClr'),
                'ColorBlending' => Input::get('Clrblending'),
                'BackgroundFill' => Input::get('BackFill'),
                'PictureEmbroidery' => Input::get('PicEmb'),
                'MoreInstructions' => Input::get('AddIns'),
                'File1' => Input::get('File1'),
                'File2' => Input::get('File2'),
                'CC' => Input::get('CCOrder'),
                'Status' => 0,
                'OrderType' => 2, // Payment Order Or Free Order
                'OrderStatus' => Input::get('OrderType'),
                'DateAdded' => new \DateTime(),
                'DateModified' => new \DateTime()
            ];

            DB::table('digitizing_orders')->insert($OrderData);


            $InsertID = \DB::getPdo()->lastInsertId();
            $attachFiles = [];

            
            if (Input::hasFile('FileOne')) {
                $fl = Input::file('FileOne');
                if (!empty($fl)) {
                    $filename1 = $InsertID . '_' . str_random(5) . 'quote1.' . $fl->getClientOriginalExtension();

                    $path = public_path('uploads') . '/orders/digi/';
                    $fl->move($path ,$filename1);
                    $attachFiles[] = $path. $filename1;
                    \DB::table('digitizing_orders')->where('OrderID', $InsertID)->update(['File1' => $filename1]);
                    
                }
            }


            if (Input::hasFile('FileTwo')) {
                $fl = Input::file('FileTwo');
                if (!empty($fl)) {
                    $filename2 = $InsertID . '_' . str_random(5) . 'quote2.' . $fl->getClientOriginalExtension();

                    $path = public_path('uploads') . '/orders/digi/';
                     $fl->move($path ,$filename2);
                     $attachFiles[] = $path. $filename2;
                     \DB::table('digitizing_orders')->where('OrderID', $InsertID)->update(['File2' => $filename2]);
                }
            }

            if (Input::hasFile('FileThree')) {
                $fl = Input::file('FileThree');
                if (!empty($fl)) {
                    $filename3 = $InsertID . '_' . str_random(5) . 'quote3.' . $fl->getClientOriginalExtension();

                    $path = public_path('uploads') . '/orders/digi/';
                    $fl->move($path ,$filename3);
                    $attachFiles[] = $path. $filename3;
                    \DB::table('digitizing_orders')->where('OrderID', $InsertID)->update(['File3' => $filename3]);
                }
            }



            if (Input::hasFile('FileFour')) {
                $fl = Input::file('FileFour');
                if (!empty($fl)) {
                    $filename4 = $InsertID . '_' . str_random(5) . 'quote4.' . $fl->getClientOriginalExtension();

                    $path = public_path('uploads') . '/orders/digi/';
                     $fl->move($path ,$filename4);
                     $attachFiles[] = $path. $filename4;

                    \DB::table('digitizing_orders')->where('OrderID', $InsertID)->update(['File4' => $filename4]);
                }
            }
            
            
             $CustomerID = \Session::get('CustomerID');
             $Cus_info =  DB::table('customers')->where('CustomerID', $CustomerID)->first();
             $Cus_order = DB::table('digitizing_orders')->where('OrderID', $InsertID)->first();
             
                 $email = '';
                 $cus_email = $Cus_info->Email;
                 $email = $cus_email;
                 $Name = $Cus_info->CustomerName;
                 $Cell = $Cus_info->Cell;
                 $Company = $Cus_info->Company;
             
            
                  $mailFrom = 'technical-team@logoartz.com';
                  \Mail::send('includes.emails.digisubmitorder', [
                  "CustomerName" => $Name,
                  "OrderType" => 'digitizing quote',
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
                    , function($message) use ($mailFrom, $attachFiles) {
                    $message->to(\Session::get('Email'))->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Quote Confirmation');
                
                if (!empty($attachFiles)) {
                    foreach ($attachFiles as $attachmentPath) {
                        if (file_exists($attachmentPath)) {
                            $message->attach($attachmentPath);
                        }
                    }
                }
            });
            // Email for Admin
                
                $mailFrom = 'technical-team@logoartz.com';
                  \Mail::send('includes.emails.digisubmitorder', [
                  "CustomerName" => $Name,
                  "CusEmail" => $email,
                  "CusPhone" => $Cell,
                  "CusCompany" => $Company,
                  "OrderType" => 'digitizing quote',
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
                  "ADDITIONALINSTRUCTIONS" => $Cus_order->MoreInstructions
                  ]
                    , function($message) use ($mailFrom, $attachFiles) {
                $message->to('info@logoartz.com')->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Digitzing Quote Received');
                
                if (!empty($attachFiles)) {
                    foreach ($attachFiles as $attachmentPath) {
                        if (file_exists($attachmentPath)) {
                            $message->attach($attachmentPath);
                        }
                    }
                }
            });

            return redirect('/digi_quote')->with('success', 'Thank You! Quotation Submitted Successfully');
        }
    }

    public function vector_approvals() {
        $this->data['statuses'] = [
                    0 => 'Pending',
                    1 => 'Pending',
                    2 => 'Pending',
                    3 => 'Quote Done',
                    4 => 'Under Process',
                    5 => 'Under Process',
                    6 => 'Under Process',
                    7 => 'Completed',
                    8 => 'Done',
                    9 => 'Cancelled',
                    10 => 'Under Process',
        ];
        $this->data['orders'] = \DB::table('vector_order')->where('CustomerID', \Session::get('CustomerID'))->where('Status', 3)->get();
        $this->data['types'] = Config('order_types');
        $this->data['heading'] = 'Quote Confirmations';
        $this->data['status'] = 'Required Confirmation';
        return view('vector_approvals', $this->data);
    }

    public function digi_approvals() {
        $this->data['statuses'] = [
                    0 => 'Pending',
                    1 => 'Pending',
                    2 => 'Pending',
                    3 => 'Quote Done',
                    4 => 'Under Process',
                    5 => 'Under Process',
                    6 => 'Under Process',
                    7 => 'Completed',
                    8 => 'Done',
                    9 => 'Cancelled',
                    10 => 'Under Process',
        ];
        $this->data['orders'] = \DB::table('digitizing_orders')->where('CustomerID', \Session::get('CustomerID'))->where('Status', 3)->get();
        $this->data['types'] = Config('order_types');
        $this->data['heading'] = 'Quote Confirmations';
        $this->data['status'] = 'Required Confirmation';
        return view('digi_approvals', $this->data);
    }

    public function vector_approval($orderid) {
        $this->data['order'] = \DB::table('vector_order')
                ->select('vector_order.*')
                ->where('vector_order.CustomerID', \Session::get('CustomerID'))
                ->where('vector_order.VectorOrderID', $orderid)
                ->leftjoin('vector_result', 'vector_result.VectorOrderID', '=', 'vector_order.VectorOrderID')
                ->orderby('vector_result.VR_ID', 'desc')
                ->first();

        $this->data['DesignFiles'] = \DB::table('vector_result_files')
                ->where('VectorOrderID', $orderid)
                ->where('ForCustomer', 1)
                ->whereRaw('VR_ID = (SELECT MAX(VR_ID) FROM vector_result_files WHERE VectorOrderID = '.$orderid.')')
                ->get();

        $this->data['revision'] = \DB::table('vector_revision')
                ->where('VectorOrderID', $orderid)
                ->where('From', 1)
                ->where('To', 3)
                ->orderby('vector_revision.RevisionID', 'desc')
                ->get();

        //Digi Work Copy Start //


        $revision_history = [];
       $OrderDRID = \DB::table('vector_revision')
                ->where('VectorOrderID', $orderid)->where('From' , 3)->get();

    
       $getfileId =  \DB::table('vector_result_files')
                      ->where('VectorOrderID', $orderid)->where('ForCustomer' , 1)->get();  

        $FirstOrder =  \DB::table('vector_result_files')
                    ->where('VectorOrderID', $orderid)->where('RevisionSet' , 1)->get(); 


          $this->data['OrderFiles'] = $FirstOrder;
          $this->data['customerRevHistory'] = [];
          $vector_revision = DB::table('vector_revision')->select('RevisionID', 'Message')->where('VectorOrderID', $orderid)->where('From', 3)->get();

          if(!empty($vector_revision)) {
                foreach($vector_revision as $revHis) {
                    $RevFiles = DB::table('vector_result_files')->where('RevisionID', $revHis->RevisionID)->get();
                    $this->data['customerRevHistory'][] = [
                        'RevisionID' => $revHis->RevisionID,
                        'Message' => $revHis->Message,
                        'Files' => $RevFiles
                    ];
                }
          }

       //  echo '<pre>'.print_r($this->data['customerRevHistory'], 1).'</pre>'; die;
       if(!empty($getfileId)) {
                    foreach($getfileId as $order_dr) {
                        $ResultFiles = \DB::table('vector_result_files')->where('VectorOrderID', $order_dr->VectorOrderID)->where('VR_ID', $order_dr->VR_ID)->get();
                        $revision_history[] = [
                                'Files' => $ResultFiles,
                        ];

                    }
                }

       // dd($revision_history); die;


                  // dd($revision_history); die;

            //    $this->data['revision_history'] = $revision_history;

            // EEEE NNNNNNNNNN DDDDDDDD  ///


        if (empty($this->data['order'])) {
            return redirect()->back();
        }
        if ($this->data['order']->IsRead == 2) {
            \DB::table('vector_order')->where('vector_order.VectorOrderID', $orderid)->update(['IsRead' => 3]);
        }
        return view('vector_order_details', $this->data);
    }

    public function digi_approval($orderid) {
        $this->data['order'] = \DB::table('digitizing_orders')
                ->select('digitizing_orders.*' , 'Price')
                ->where('digitizing_orders.CustomerID', \Session::get('CustomerID'))
                ->where('digitizing_orders.OrderID', $orderid)
                ->leftjoin('digi_result', 'digi_result.OrderID', '=', 'digitizing_orders.OrderID')
                ->orderby('digi_result.DR_ID', 'desc')
                ->first();

        $this->data['DesignFiles'] = \DB::table('digi_result_files')
                ->where('OrderID', $orderid)
                ->where('ForCustomer', 1)
                ->whereRaw('DR_ID = (SELECT MAX(DR_ID) FROM digi_result_files WHERE OrderID = '.$orderid.')')
                ->get();
        
        $this->data['revision'] = \DB::table('digi_revision')
                ->where('OrderID', $orderid)
                ->where('From', 1)
                ->where('To', 3)
                ->orderby('digi_revision.RevisionID', 'desc')
                ->get();


       $revision_history = [];
       $OrderDRID = \DB::table('digi_revision')
                ->where('OrderID', $orderid)->where('From' , 3)->get();

    
       $getfileId =  \DB::table('digi_result_files')
                      ->where('OrderID', $orderid)->where('ForCustomer' , 1)->get();  

        $FirstOrder =  \DB::table('digi_result_files')
                    ->where('OrderID', $orderid)->where('RevisionSet' , 1)->get(); 


          $this->data['OrderFiles'] = $FirstOrder;
          $this->data['customerRevHistory'] = [];
          $digi_revision = DB::table('digi_revision')->select('RevisionID', 'Message')->where('OrderID', $orderid)->where('From', 3)->get();

          if(!empty($digi_revision)) {
                foreach($digi_revision as $revHis) {
                    $RevFiles = DB::table('digi_result_files')->where('RevisionID', $revHis->RevisionID)->get();
                    $this->data['customerRevHistory'][] = [
                        'RevisionID' => $revHis->RevisionID,
                        'Message' => $revHis->Message,
                        'Files' => $RevFiles
                    ];
                }
          }

        //  echo '<pre>'.print_r($this->data['customerRevHistory'], 1).'</pre>'; die;
       if(!empty($getfileId)) {
                    foreach($getfileId as $order_dr) {
                        $ResultFiles = \DB::table('digi_result_files')->where('OrderID', $order_dr->OrderID)->where('DR_ID', $order_dr->DR_ID)->get();
                        $revision_history[] = [
                                'Files' => $ResultFiles,
                        ];

                    }
                }

       // dd($revision_history); die;


                  // dd($revision_history); die;

            //    $this->data['revision_history'] = $revision_history;

        if (empty($this->data['order'])) {
            return redirect()->back();
        }
        if ($this->data['order']->IsRead == 2) {
            \DB::table('digitizing_orders')->where('digitizing_orders.OrderID', $orderid)->update(['IsRead' => 3]);
        }
        return view('digi_order_details', $this->data);


    } 



    public function vector_approve($orderid) {
        \DB::table('vector_order')->where('CustomerID', \Session::get('CustomerID'))->where('VectorOrderID', $orderid)->update(['OrderType' => 0, 'Status' => 4, 'IsRead' => 0]);

           DB::table('vector_result_files')
                    ->where('VectorOrderID', $orderid)
                    ->delete();
        
        DB::table('vector_result')
                      ->where('VectorOrderID', $orderid)
                    ->delete();
     
      // $Ids = \DB::table('vector_revision')->select('RevisionID')->where("VectorOrderID" , $orderid)->get();
       
        DB::table('vector_revision')
                    ->where('VectorOrderID', $orderid)
                    ->delete();
     
        
        return redirect('/CustomerDash')->with('success', 'Success ! Your Order is Approved Successfully');
    }

    public function digi_approve($orderid) {
        \DB::table('digitizing_orders')->where('CustomerID', \Session::get('CustomerID'))->where('OrderID', $orderid)->update(['Status' => 4, 'IsRead' => 0, 'OrderType' => 0]);


           DB::table('digi_result_files')
                    ->where('OrderID', $orderid)
                    ->delete();

           DB::table('digi_result')
                      ->where('OrderID', $orderid)
                    ->delete();
     
        
           DB::table('digi_revision')
                    ->where('OrderID', $orderid)
                    ->delete();
     
        return redirect('/CustomerDash')->with('success', 'Thank You! Order is Proceeded Successfully');
    }

    public function vector_done($orderid) {
        \DB::table('vector_order')->where('CustomerID', \Session::get('CustomerID'))->where('VectorOrderID', $orderid)->update(['Status' => 8]);
        return redirect('/CustomerDash')->with('success', 'Thank You ! For Working With Logo Artz');
    }

    public function digi_done($orderid) {
        \DB::table('digitizing_orders')->where('CustomerID', \Session::get('CustomerID'))->where('OrderID', $orderid)->update(['Status' => 8]);
        return redirect('/CustomerDash')->with('success', 'Thank You ! For Working With Logo Artz');
    }

    public function my_vectors($status) {

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

        if (!array_key_exists($status, $arr)) {
            return redirect()->back();
            exit();
        }

        $this->data['orders'] = \DB::table('vector_order')
                ->where('CustomerID', \Session::get('CustomerID'))
                ->whereIn('Status', $arr[$status])
             ->orderby('DateModified', 'desc')
                ->get();
        $this->data['types'] = Config('order_types');
        $this->data['heading'] = 'My Orders';
        $this->data['status'] = 'Order Completed';
        return view('vector_approvals', $this->data);
    }

    public function my_digis($status) {

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

        if (!array_key_exists($status, $arr)) {
            return redirect()->back();
            exit();
        }

        $this->data['orders'] = \DB::table('digitizing_orders')
                ->where('CustomerID', \Session::get('CustomerID'))
                ->whereIn('Status', $arr[$status])
                ->orderby('DateModified', 'desc')
                ->get();



         //dd($this->data['orders']);
        $this->data['All_Select'] = 'all';
        $this->data['types'] = Config('order_types');
        $this->data['heading'] = 'My Orders';
        $this->data['status'] = 'Order Completed';
        return view('digi_approvals', $this->data);
    }


    public function vector_revise($orderid) {

    
 $allowed_ext = ['jpg', 'JPG', 'JPEG', 'jpeg', 'png', "PNG", 'gif', 'GIF','EMB', 'emb', 'DST', 'dst' , 'PDF', 'pdf' , 'ai' , 'AI' , 'CDR' , 'cdr' , 'pof', 'POF' , 'pxf', 'PXF' , 'Exp', 'exp', 'CND' , 'cnd', 'ppt', 'PPT' , 'docx', 'DOCX' ,'PES', 'pes', 'xxx', 'XXX','toyota100', 'TOYOTA100', 'eps' , 'EPS'];

  $fileCount = 0;
   $count = 0;

    if (Input::hasFile('reviseFiles')) {
             $files =  Input::file('reviseFiles');
            foreach ($files as $fl) {
                      $ext = $fl->getClientOriginalExtension();
                    if (!in_array($ext, $allowed_ext)) {
                        $error  = true;
                        $msg = "Invalid File type<br>";
                    } else {
                        $fileCount++;
                    }
        
              }
              
    }
    
    
      if($fileCount > 4 ){
                    return redirect()->back()->with('warning_msg', 'Only 4 Fils Allow');
       }

 
        $valid["AddIns"] = 'required|max:2500';
    

        $valid_name["AddIns"] = "message fo admin";
       


        $messages = [
            'required' => 'Please enter :attribute.',
           'max' => 'No more characters allowed in :attribute.'
        ];

        $v = Validator::make(Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);

        if ($v->fails()) {
             return redirect()->back()->withErrors($v->errors())->withInput();
             } else {
               
               
            }


        $type = 1;
        $data_arr = [
            'VectorOrderID' => $orderid,
            'From' => 3,
            'To' => 1,
            'Message' => Input::get('AddIns'),
            'RevisionType' => 1,
            'DateAdded' => new \DateTime()
        ];
        $order = \DB::table('vector_order')->select('OrderType', 'VectorOrderID', 'DesignName')->where('VectorOrderID', $orderid)->first();
        if ($order->OrderType == 2) {
            $type = 4;
        }
        if ($order->OrderType == 3) {
            $type = 9;
        }if ($order->OrderType == 9) {
            $type = 9;
        }if ($order->OrderType == 4) {
            $type = 4;
        }


        \DB::table('vector_order')->where('CustomerID', \Session::get('CustomerID'))->where('VectorOrderID', $orderid)->update(['OrderType' => $type, 'Status' => 10, 'IsRead' => 0, 'DateModified' => new \DateTime()]);
        \DB::table('vector_revision')->insert($data_arr);
        $RevID = \DB::getPdo()->lastInsertId();

/*/  FILES STORE   /*/ 


        if (Input::hasFile('reviseFiles')) {
             
                foreach ($files  as $fl) {  
                   
                    $filename = 'vc_cus'. $orderid . 'C' .$count .'_'.str_random(3) .'.'.$fl->getClientOriginalExtension();
                    $file = $filename;
                    $path = public_path('uploads') . '/orders/vector_revision_customer';
                    $fl->move($path ,$file);
                    $Files[] = $file;

                    $rev_file = [
                      'OrderID'      =>  $orderid,
                      'revise_id'    =>  $RevID,  
                      'file'         =>  $file,
                      'created_at'   =>  new \DateTime()
                    ];

                    if($rev_file != ''){
                         VectorRevFiles::insert($rev_file);
                     }
                     
                $count++;
                }
      }
        if($count < 1){
             $Files[] = '';
        }


  /*/  FILES STORE END /*/ 



   $MaxValue = DB::table('vector_result_files')
                   ->select(DB::raw('MAX(VR_ID) as VR_ID'))
                   ->where('VectorOrderID', $orderid)->first();
        

        $VrID = 0;

        if(!empty($MaxValue)) {
            $VrID = $MaxValue->VR_ID;
        }

         DB::table('vector_result_files')
        ->where('VectorOrderID', $orderid)
        ->where('VR_ID' , $VrID)
        ->where('ForCustomer', 1)
        ->update(['RevisionID' => $RevID]);


         $Customer  = \DB::table('customers')->where('CustomerID', \Session::get('CustomerID'))->first();
         $Name = $Customer->CustomerName;

                 $email = '';
                 $cus_email = $Customer->Email;
                 $email = $cus_email;
                 $Name = $Customer->CustomerName;
                 $Cell = $Customer->Cell;
                 $Company = $Customer->Company;


        if($order->OrderType == 2 || $order->OrderType == 4){
            $type_name = "Quote";
             
        }else{
            
             $type_name = "Order";
        }             
            

          // Email for Admin
          
                $mailFrom = 'technical-team@logoartz.com';
                  \Mail::send('includes.emails.vecsubmitrev', [
                  "CustomerName" => $Name,
                   "CusEmail" => $email,
                  "CusPhone" => $Cell,
                  "CusCompany" => $Company,
                  "OrderType" => 'Vector',
                  "OrderStatus" => $type,
                  "OrderID" => $order->VectorOrderID,
                  "DesignName" => $order->DesignName
                  ], 
                  function($message) use ($mailFrom, $Files) {
                $message->to('info@logoartz.com')->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Vector Revision');
                   
                       if($Files[0] != ''){
                              foreach ($Files as $file){
                        
                              $path = public_path('uploads') . '/orders/vector_revision_customer';

                             $orignalFile = $path.'/'.$file;
                             $message->attach($orignalFile);
                        
                    }
                        }
                   
                  }
            
            );
            

        return redirect('/CustomerDash')->with('success', 'Your '.$type_name.' is Sent For Revision');

    }

    public function digi_revise($orderid) {

        $count = 0;
        $fileCount = 0;
        
    $allowed_ext = ['jpg', 'JPG', 'JPEG', 'jpeg', 'png', "PNG", 'gif', 'GIF','EMB', 'emb', 'DST', 'dst' , 'PDF', 'pdf' , 'ai' , 'AI' , 'CDR' , 'cdr' , 'pof', 'POF' , 'pxf', 'PXF' , 'Exp', 'exp', 'CND' , 'cnd', 'ppt', 'PPT' , 'docx', 'DOCX' ,'PES', 'pes', 'xxx', 'XXX','toyota100', 'TOYOTA100', 'eps' , 'EPS'];

     if (Input::hasFile('reviseFiles')) {
                     $files =  Input::file('reviseFiles');
            foreach ($files as $fl) {

                       $ext = $fl->getClientOriginalExtension();
                    if (!in_array($ext, $allowed_ext)) {
                        $error  = true;
                        $msg = "Invalid File type<br>";
                    } else {
                        $fileCount++;
                    }
        
              }


                  if($fileCount > 2 ){
                    return redirect()->back()->with('warning_msg', 'Only 2 Files Allow');
                  }
        }

        if($fileCount > 0){
            $files =  Input::file('reviseFiles');
        }

        
        $valid["AddIns"] = 'required|max:2500';
    

        $valid_name["AddIns"] = "message fo admin";
       


        $messages = [
            'required' => 'Please enter :attribute.',
           'max' => 'No more characters allowed in :attribute.'
        ];

        $v = Validator::make(Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);

        if ($v->fails()) {
             return redirect()->back()->withErrors($v->errors())->withInput();
             } else {
               
               
            }
      
        
        $type = 1;
        $data_arr = [
            'OrderID' => $orderid,
            'From' => 3,
            'To' => 1,
            'Message' => Input::get('AddIns'),
            'RevisionType' => 1,
            'DateAdded' => new \DateTime()
        ];
        $order = \DB::table('digitizing_orders')->select('OrderType', 'OrderID', 'DesignName', 'OrderType')->where('OrderID', $orderid)->first();
        if ($order->OrderType == 2) {
            $type = 4;
        }
        if ($order->OrderType == 3) {
            $type = 9;
        }if ($order->OrderType == 9) {
            $type = 9;
        }if ($order->OrderType == 4) {
            $type = 4;
        }
        
        
      
            
        \DB::table('digitizing_orders')->where('CustomerID', \Session::get('CustomerID'))->where('OrderID', $orderid)->update(['OrderType' => $type, 'Status' => 10, 'IsRead' => 0, 'DateModified' => new \DateTime()]);
        \DB::table('digi_revision')->insert($data_arr);
        $RevID = \DB::getPdo()->lastInsertId();


        /*/  FILES STORE   /*/ 


        if (Input::hasFile('reviseFiles')) {
             
                foreach ($files  as $fl) {  
                   
                    $filename = 'digi_cus'. $orderid . 'C' .$count .'_'.str_random(3) .'.'.$fl->getClientOriginalExtension();
                    $file = $filename;
                    $path = public_path('uploads') . '/orders/digi_revision_customer';
                    $fl->move($path ,$file);
                    $Files[] = $file;

                    $rev_file = [
                      'OrderID'      =>  $orderid,
                      'revise_id'    =>  $RevID,  
                      'file'         =>  $file,
                      'created_at'   =>  new \DateTime()
                    ];

                    if($rev_file != ''){
                         DigiRevFiles::insert($rev_file);
                     }
                     
                $count++;
                }
      }
        if($count < 1){
             $Files[] = '';
        }


  /*/  FILES STORE END /*/ 


       // $MaxValue = \DB::table('digi_result_files')->where('OrderID', $);

        $MaxValue = DB::table('digi_result_files')
                   ->select(DB::raw('MAX(DR_ID) as DR_ID'))
                   ->where('OrderID', $orderid)->first();
        
         // dd($MaxValue);
        $DrID = 0;

        if(!empty($MaxValue)) {
            $DrID = $MaxValue->DR_ID;
        }

         DB::table('digi_result_files')
        ->where('OrderID', $orderid)
        ->where('DR_ID' , $DrID)
        ->where('ForCustomer', 1)
        ->update(['RevisionID' => $RevID]);

        // DB::table('digi_result_files')->where('OrderID', $orderid)->where('DR_ID = (SELECT MAX(DR_ID) FROM digi_result_files WHERE OrderID = '.$orderid.')')
        // ->where('ForCustomer', 1)->update(['RevisionID' => $RevID]);
        
         $Customer  = \DB::table('customers')->where('CustomerID', \Session::get('CustomerID'))->first();
         $Name = $Customer->CustomerName;

         
         
                 $email = '';
                 $cus_email = $Customer->Email;
                 $email = $cus_email;
                 $Name = $Customer->CustomerName;
                 $Cell = $Customer->Cell;
                 $Company = $Customer->Company;
                 $type_name = "";
                 

        if($order->OrderType == 2 || $order->OrderType == 4){
            $type_name = "Quote";
             
        }else{
            
             $type_name = "Order";
        }             
                 
         
          // Email for Admin
          
                $mailFrom = 'technical-team@logoartz.com';
                  \Mail::send('includes.emails.digisubmitrev', [
                  "CustomerName" => $Name,
                   "CusEmail" => $email,
                  "CusPhone" => $Cell,
                  "CusCompany" => $Company,
                  "OrderType" => 'Digitizing',
                  "OrderStatus" => $type,
                  "OrderID" => $order->OrderID,
                  "DesignName" => $order->DesignName
                  ], 
                  function($message) use ($mailFrom, $Files) {
                $message->to('info@logoartz.com')->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Digitizing Revision');
                
                      if($Files[0] != ''){
                              foreach ($Files as $file){
                        
                              $path = public_path('uploads') . '/orders/digi_revision_customer';

                             $orignalFile = $path.'/'.$file;
                             $message->attach($orignalFile);
                        
                    }
                        }
                  }
            
            );

         

        return redirect('/CustomerDash')->with('success', 'Your '.$type_name.' is Sent For Revision');
    }

    public function logout() {
        \Session::forget("CustomerLogin");
        \Session::forget('CustomerID');
        \Session::forget('CustomerName');
        \Session::forget('Cell');
        \Session::forget('Email');
        return redirect('/');
    }

}
