<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\DesignerController;
use App\Http\Helper;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DB;
use Exception;
use Storage;
use Illuminate\Support\Facades\File;

class Order extends DesignerController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function vector_order($status)
    {
        $this->data['orders'] = \App\vector_order::select('vector_order.*', 'customers.CustomerName')
                ->where('DesignerID', \Session::get('DesignerID'))
                ->leftJoin('customers', 'vector_order.CustomerID', '=', 'customers.CustomerID');

        if ($status != 'all') {
            if ($status == 0) {
                $this->data['orders'] = $this->data['orders']
                         ->where('DesignerID', \Session::get('DesignerID'))
                        ->whereIn('vector_order.OrderType', [0, 3])
                         ->where('vector_order.OrderType', '!=', 2)
                        ->where('vector_order.OrderType', '!=', 4);

            } elseif ($status == 1) {
                $this->data['orders'] = $this->data['orders']
                            ->where('DesignerID', \Session::get('DesignerID'))
                           ->whereIn('vector_order.OrderType', [1, 9])
                           ->where('vector_order.OrderType', '!=', 2)
                           ->where('vector_order.OrderType', '!=', 4);


            } elseif ($status == 6) {
                $this->data['orders'] = $this->data['orders']
                        ->where('vector_order.Status', 6)
                        ->orwhere('vector_order.Status', 7)
                        ->where('vector_order.OrderType', '!=', 2)
                        ->where('vector_order.OrderType', '!=', 4);

            } else {
                $this->data['orders'] = $this->data['orders']->where('vector_order.Status', $status);
            }
        }





        $this->data['orders'] = $this->data['orders']
                ->where('vector_order.OrderType', '!=', 2)
                ->orderBy('vector_order.DateModified', 'desc')
                ->get();

        $this->data['OrderTypes'] = Config('order_types');
        $this->data['OrderStatuses'] = Config('order_statuses');

        return view('designer.VectorOrders', $this->data);
    }

    public function vector_quote($status)
    {

        $this->data['orders'] = \App\vector_order::select('vector_order.*', 'customers.CustomerName')
                ->where('DesignerID', \Session::get('DesignerID'))
                ->whereIn('vector_order.OrderType', [2, 4])
                ->leftJoin('customers', 'vector_order.CustomerID', '=', 'customers.CustomerID');

        if ($status != 'all') {
            if ($status == 0) {

                $this->data['orders'] = $this->data['orders']
                        ->where('DesignerID', \Session::get('DesignerID'))
                        ->where('vector_order.OrderType', 2);

            } elseif ($status == 1) {

                $this->data['orders'] = $this->data['orders']
                         ->where('DesignerID', \Session::get('DesignerID'))
                         ->where('vector_order.OrderType', 4)
                         ->where('vector_order.OrderType', '!=', 2);

            } elseif ($status == 6) {
                $this->data['orders'] = $this->data['orders']
                        ->where('vector_order.Status', 6)
                        ->orwhere('vector_order.Status', 7)
                        ->whereIn('vector_order.OrderType', [2, 4]);


            } else {
                $this->data['orders'] = $this->data['orders']->where('vector_order.Status', $status);
            }
        }


        $this->data['orders'] = $this->data['orders']
                ->orderBy('Status', 'asc')
                ->get();

        $this->data['OrderTypes'] = Config('order_types');
        $this->data['OrderStatuses'] = Config('order_statuses');

        return view('designer.VectorQuotes', $this->data);
    }

    public function digi_quote($status)
    {

        $this->data['orders'] = \App\DigiOrders::select('digitizing_orders.*', 'customers.CustomerName')
                ->where('DesignerID', \Session::get('DesignerID'))
                ->whereIn('digitizing_orders.OrderType', [2, 4])
                ->leftJoin('customers', 'digitizing_orders.CustomerID', '=', 'customers.CustomerID');


        if ($status != 'all') {
            if ($status == 0) {
                $this->data['orders'] = $this->data['orders']
                         ->where('DesignerID', \Session::get('DesignerID'))
                         ->where('digitizing_orders.OrderType', 2);

            } elseif ($status == 1) {
                $this->data['orders'] = $this->data['orders']
                            ->where('DesignerID', \Session::get('DesignerID'))
                            ->where('digitizing_orders.OrderType', 4)
                            ->where('digitizing_orders.OrderType', '!=', 2);

            } elseif ($status == 6) {
                $this->data['orders'] = $this->data['orders']
                        ->where('digitizing_orders.Status', 6)
                        ->orwhere('digitizing_orders.Status', 7)
                        ->whereIn('digitizing_orders.OrderType', [2, 4]);


            } else {
                $this->data['orders'] = $this->data['orders']->where('digitizing_orders.Status', $status);
            }
        }


        $this->data['orders'] = $this->data['orders']
                ->orderBy('Status', 'asc')
                ->get();

        $this->data['OrderTypes'] = Config('order_types');
        $this->data['OrderStatuses'] = Config('order_statuses');

        return view('designer.DigiQuotes', $this->data);
    }

    public function vector_order_details($VectorOrderID)
    {


        $this->data['VectorOrders'] = \App\vector_order::select('VectorOrderID', 'CustomerName', 'ReqFormat', 'DesignerName', 'CC', 'File1', 'File2', 'File3', 'File4', 'MoreInstructions', 'NoOfColors', 'DesignName', 'PONumber', 'vector_order.Width', 'vector_order.Height', 'vector_order.Scale', 'vector_order.UsedFor', 'vector_order.ReqColor', 'vector_order.Status', 'vector_order.DateAdded', 'OrderType', 'vector_order.DesignerID', 'vector_order.DesignerPrice', 'vector_order.MessageForDesigner', 'vector_order.QuotePrice', 'vector_order.IsRead')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                ->where('vector_order.VectorOrderID', $VectorOrderID)
                ->first();




        // REVISION DATA
        $revision_history = [];

        $OrderDRID = \DB::table('vector_result')
                        ->where('VectorOrderID', $VectorOrderID)->get();

        if (!empty($OrderDRID)) {
            foreach ($OrderDRID as $order_dr) {
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
                ->whereRaw('VR_ID = (SELECT MAX(VR_ID) FROM vector_result_files WHERE VectorOrderID = ' . $VectorOrderID . ')')
                ->get();

        $this->data['RivisionHistory'] = \DB::table('vector_revision')
                ->where('VectorOrderID', $VectorOrderID)
                ->get();

        $this->data['Revision'] = \DB::table('vector_revision')
                ->where('VectorOrderID', $VectorOrderID)
                ->where('From', 3)
                ->where('To', 1)
                ->get();

        // END



        $this->data['Revision'] = \DB::table('vector_revision')->where('VectorOrderID', $VectorOrderID)->where('From', 1)->where('To', 2)->get();

        $this->data['OrderStatuses'] = Config('order_statuses');

        $this->data['Designers'] = \App\Designers::pluck('DesignerName', 'DesignerID')->toArray();
        array_unshift($this->data['Designers'], "Select Designer");

        if ($this->data['VectorOrders']->IsRead == 1) {
            \DB::table('vector_order')->where('VectorOrderID', $VectorOrderID)->update(['IsRead' => 3]);
        }
        return view('designer.VecOrderDetail', $this->data);
    }

    public function vector_order_price($OrderID)
    {

        $CountRev = 0;

        $valid["Price"] = 'required|integer|min:1';

        $valid_name["Price"] = "Quote Price";

        $messages = [
            'required' => 'Please enter :attribute.'
        ];

        $v = \Validator::make(\Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);


        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'emb', 'dst', 'dsb','pcs', 'hus', 'jef', 'pdf', 'pof', 'u01', 'pxf', 'exp', 'cnd', 'ppt', 'doc', 'pes', 'xxx', 'toyota100', 'eps'];
        $categories = ['Filea' => 'a', 'Fileb' => 'b', 'Filec' => 'c'];

        $errorMessages = [];
        $totalFileCount = 0;

        foreach ($categories as $inputName => $categoryCode) {
            if (Input::hasFile($inputName)) {
                $files = Input::file($inputName);

                foreach ($files as $file) {
                    $extension = strtolower($file->getClientOriginalExtension());

                    // Validate file extension
                    if (!in_array($extension, $allowedExtensions)) {
                        $errorMessages[] = "Invalid file type in category '{$inputName}' for file '{$file->getClientOriginalName()}'.";
                    } else {
                        $totalFileCount++;
                    }
                }
            }
        }

        if (!empty($errorMessages)) {
            return redirect()->back()->withInput()->with('warning_msg', implode('<br>', $errorMessages));
       } else {

            $order = DB::table('vector_order')->where('VectorOrderID', $OrderID)->first();

            if ($order->OrderType == 4 && $order->Status == 10) {
                $Status = 11;
            } else {
                $Status = 2;
            }


            if ($order->OrderType == 4 || $order->OrderType == 2) {
                $type = 'quote';
            } else {
                $type = 'order';
            }

            $orderDetail = [
                'DesignerPrice' => \Input::get('Price'),
                'MessageForAdmin' => \Input::get('Reply'),
                'IsRead' => 0,
                'AssignStatus' => '0',
                'Status' => $Status
            ];
            \DB::table('vector_order')->where('VectorOrderID', $OrderID)->update($orderDetail);


            $data = [
            'VectorOrderID' => $OrderID,
            'DesignerMessage' => \Input::get('Reply'),
            'DateAdded' => new \DateTime()
            ];

            \DB::table('vector_result')->insert($data);


            $InsertID = \DB::getPdo()->lastInsertId();
            $orderDetail = DB::table('vector_order')->where('VectorOrderID', $OrderID)->first();


            $OrderDRID = \DB::table('vector_revision')
                ->where('VectorOrderID', $OrderID)->where('From', 3)->get();

            if ($orderDetail->OrderType == 1 || $orderDetail->OrderType == 4) {
                $CountRev =  count($OrderDRID, COUNT_RECURSIVE);

                $CountRev = 'Rev-'.$CountRev;
            } else {
                $CountRev = $InsertID;

            }


            // Proceed with file uploads if validation passed
            foreach ($categories as $inputName => $categoryCode) {
                if (Input::hasFile($inputName)) {
                    $files = Input::file($inputName);
                    Helper::handleVectorFileUploads($files, $categoryCode, $OrderID, $CountRev, $InsertID);
                }
            }


            return redirect('designer/vector/details/' . $OrderID)->with('success', 'Quote Sent Successfully');
        }
    }

    public function digi_order($status)
    {

        $this->data['orders'] = \App\DigiOrders::select('digitizing_orders.*', 'customers.CustomerName')
                ->where('DesignerID', \Session::get('DesignerID'))
                ->where('digitizing_orders.OrderType', '!=', 2)
                ->where('digitizing_orders.OrderType', '!=', 4)
                ->leftJoin('customers', 'digitizing_orders.CustomerID', '=', 'customers.CustomerID');


        if ($status != 'all') {
            if ($status == 0) {
                $this->data['orders'] = $this->data['orders']
                         ->where('DesignerID', \Session::get('DesignerID'))
                        ->whereIn('digitizing_orders.OrderType', [0, 3])
                         ->where('digitizing_orders.OrderType', '!=', 2)
                        ->where('digitizing_orders.OrderType', '!=', 4);

            } elseif ($status == 1) {
                $this->data['orders'] = $this->data['orders']
                            ->where('DesignerID', \Session::get('DesignerID'))
                           ->whereIn('digitizing_orders.OrderType', [1, 9])
                           ->where('digitizing_orders.OrderType', '!=', 2)
                           ->where('digitizing_orders.OrderType', '!=', 4);


            } elseif ($status == 6) {
                $this->data['orders'] = $this->data['orders']
                        ->where('digitizing_orders.Status', 6)
                        ->orwhere('digitizing_orders.Status', 7)
                        ->where('digitizing_orders.OrderType', '!=', 2)
                        ->where('digitizing_orders.OrderType', '!=', 4);

            } else {
                $this->data['orders'] = $this->data['orders']->where('digitizing_orders.Status', $status);
            }
        }

        $this->data['orders'] = $this->data['orders']
                ->where('digitizing_orders.OrderType', '!=', 2)
              
                ->orderBy('digitizing_orders.DateModified', 'desc')
                ->get();

        $this->data['OrderTypes'] = Config('order_types');
        $this->data['OrderStatuses'] = Config('order_statuses');

        return view('designer.DigiOrders', $this->data);
    }

    public function digi_order_details($OrderID)
    {

        $this->data['DigiOrders'] = \App\DigiOrders::select('OrderID', 'CustomerName', 'ReqFormat', 'DesignerName', 'CC', 'File1', 'File2', 'File3', 'File4', 'MoreInstructions', 'NoOfColors', 'DesignName', 'PONumber', 'digitizing_orders.Status', 'digitizing_orders.Fabric', 'digitizing_orders.FabricColor', 'digitizing_orders.Width', 'digitizing_orders.Height', 'digitizing_orders.Scale', 'digitizing_orders.ColorBlending', 'digitizing_orders.BackgroundFill', 'digitizing_orders.PictureEmbroidery', 'digitizing_orders.OtherFormat', 'digitizing_orders.Placement', 'OrderType', 'digitizing_orders.DesignerID', 'digitizing_orders.DesignerPrice', 'digitizing_orders.MessageForDesigner', 'digitizing_orders.QuotePrice', 'digitizing_orders.IsRead', 'digitizing_orders.DateAdded')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                ->where('digitizing_orders.OrderID', $OrderID)
                ->first();

        $this->data['Revision'] = \DB::table('digi_revision')->where('OrderID', $OrderID)->where('From', 1)->where('To', 2)->get();



        //-- REVISION DATA
        $revision_history = [];
        $OrderDRID = \DB::table('digi_result')
                      ->where('OrderID', $OrderID)->get();

        if (!empty($OrderDRID)) {
            foreach ($OrderDRID as $order_dr) {
                $ResultFiles = \DB::table('digi_result_files')->where('OrderID', $OrderID)->where('DR_ID', $order_dr->DR_ID)->get();
                $revision_history[] = [
                    'DesignerMessage' => $order_dr->DesignerMessage,
                    'DateAdded' => $order_dr->DateAdded,
                    'Files' => $ResultFiles,
                ];
            }
        }
        $this->data['revision_history'] = $revision_history;




        $this->data['DesignHistory'] = \DB::table('digi_result')
                ->where('OrderID', $OrderID)
                ->get();

        $this->data['DesignFiles'] = \DB::table('digi_result_files')
                 ->where('OrderID', $OrderID)
                 ->whereRaw('DR_ID = (SELECT MAX(DR_ID) FROM digi_result_files WHERE OrderID = ' . $OrderID . ')')
                 ->get();

        $this->data['RivisionHistory'] = \DB::table('digi_revision')
                ->where('OrderID', $OrderID)
                ->get();

        //-- R.D END

        $this->data['OrderStatuses'] = Config('order_statuses');

        $this->data['Designers'] = \App\Designers::pluck('DesignerName', 'DesignerID')->toArray();
        array_unshift($this->data['Designers'], "Select Designer");

        if ($this->data['DigiOrders']->IsRead == 1) {
            \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update(['IsRead' => 3]);
        }
        return view('designer.DigiOrderDetail', $this->data);
    }

    public function digi_order_price($OrderID)
    {
        $CountRev = 0;

        $valid["Price"] = 'required|integer|min:0';

        $valid_name["Price"] = "Quote Price";

        $messages = [
            'required' => 'Please enter :attribute.'
        ];

        $v = \Validator::make(\Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);

        
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'emb', 'dst', 'dsb','pcs', 'hus', 'jef', 'pdf', 'pof', 'u01', 'pxf', 'exp', 'cnd', 'ppt', 'doc', 'pes', 'xxx', 'toyota100', 'eps'];
        $categories = ['Filea' => 'a', 'Fileb' => 'b', 'Filec' => 'c'];

        $errorMessages = [];
        $totalFileCount = 0;

        foreach ($categories as $inputName => $categoryCode) {
            if (Input::hasFile($inputName)) {
                $files = Input::file($inputName);

                foreach ($files as $file) {
                    $extension = strtolower($file->getClientOriginalExtension());

                    // Validate file extension
                    if (!in_array($extension, $allowedExtensions)) {
                        $errorMessages[] = "Invalid file type in category '{$inputName}' for file '{$file->getClientOriginalName()}'.";
                    } else {
                        $totalFileCount++;
                    }
                }
            }
        }

        if (!empty($errorMessages)) {
            return redirect()->back()->withInput()->with('warning_msg', implode('<br>', $errorMessages));
        } else {


            $order = DB::table('digitizing_orders')->where('OrderID', $OrderID)->first();

            if ($order->OrderType == 4 && $order->Status == 10) {
                $Status = 11;
            } else {
                $Status = 2;
            }


            if ($order->OrderType == 4 || $order->OrderType == 2) {
                $type = 'quote';
            } else {
                $type = 'order';
            }



            $orderDetail = [
                'DesignerPrice' => \Input::get('Price'),
                'MessageForAdmin' => \Input::get('Reply'),
                'IsRead' => 0,
                'AssignStatus' => '0',
                 'Status' => $Status

            ];
            \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update($orderDetail);

            $data = [
               'OrderID' => $OrderID,
               'DesignerMessage' => \Input::get('Reply'),
               'DateAdded' => new \DateTime()
            ];

            \DB::table('digi_result')->insert($data);

            $InsertID = \DB::getPdo()->lastInsertId();
            $orderDetail = DB::table('digitizing_orders')->where('OrderID', $OrderID)->first();

            $OrderDRID = \DB::table('digi_revision')
                ->where('OrderID', $OrderID)->where('From', 3)->get();

            if ($orderDetail->OrderType == 1 || $orderDetail->OrderType == 4) {
                $CountRev =  count($OrderDRID, COUNT_RECURSIVE);

                $CountRev = 'Rev-'.$CountRev;
            } else {
                $CountRev = $InsertID;

            }

             // Proceed with file uploads if validation passed
             foreach ($categories as $inputName => $categoryCode) {
                if (Input::hasFile($inputName)) {
                    $files = Input::file($inputName);
                    Helper::handleDigiFileUploads($files, $categoryCode, $OrderID, $CountRev, $InsertID);
                }
            }


            return redirect('designer/digi/details/' . $OrderID)->with('success', 'Quote Sent Successfully');
        }
    }

    public function summary()
    {
        $this->data['vectororders'] = \App\vector_order::where('DesignerID', \Session::get('DesignerID'))
                ->leftJoin('customers', 'vector_order.CustomerID', '=', 'customers.CustomerID')
                ->where('QuotePrice', '!=', 0)
                ->orderBy('QuotePrice', 'asc')
                ->get();
        $this->data['DigiOrders'] = \App\DigiOrders::where('DesignerID', \Session::get('DesignerID'))
                ->leftJoin('customers', 'digitizing_orders.CustomerID', '=', 'customers.CustomerID')
                ->where('QuotePrice', '!=', 0)
                ->orderBy('QuotePrice', 'asc')
                ->get();

        $this->data['OrderTypes'] = Config('order_types');
        $this->data['OrderStatuses'] = Config('order_statuses');

        return view('designer.orderhistory', $this->data);
    }

    public function vector_complete($vectorid)
    {
        $fileCount = 0;
        $CountRev = 0;
        $error = false;

        $msg = "";

        $error1 = false;
        $msg1 = "";

        $error2 = false;
        $msg2 = "";

        $error3 = false;
        $msg3 = "";

        $error4 = false;
        $msg4 = "";

        $error5 = false;
        $msg5 = "";

        $error6 = false;
        $msg6 = "";

        $allowed_ext = ['jpg', 'JPG', 'JPEG', 'jpeg', 'png', "PNG", 'gif','EMB', 'emb', 'DST', 'PDF', 'pdf', 'pof', 'pxf', "Exp", 'cnd', 'ppt', 'doc', 'PES', 'xxx', 'toyota100', 'eps', 'EPS'];


        $filea =  Input::file('Filea');
        $fileb =  Input::file('Fileb');
        $filec =  Input::file('Filec');
        $errorCount = 1;



        if (Input::hasFile('Filea')) {

            foreach ($filea as $fl) {
                $ext = $fl->getClientOriginalExtension();
                if (in_array(strtolower($ext), array_map('strtolower', $allowed_ext))) {
                    $error  = true;
                    $msg.$errorCount = "Invalid File type<br>";
                    $errorCount++;
                } else {
                    $fileCount++;
                }
            }
        }

        if (Input::hasFile('Fileb')) {
            foreach ($fileb as $fl) {
                $ext = $fl->getClientOriginalExtension();
                if (in_array(strtolower($ext), array_map('strtolower', $allowed_ext))) {
                    $error  = true;
                    $msg.$errorCount = "Invalid File type<br>";
                    $errorCount++;
                } else {
                    $fileCount++;
                }

            }
        }

        if (Input::hasFile('Filec')) {
            foreach ($filec as $fl) {
                $ext = $fl->getClientOriginalExtension();
                if (in_array(strtolower($ext), array_map('strtolower', $allowed_ext))) {
                    $error = true;
                    $msg.$errorCount = "Invalid File type<br>";
                } else {
                    $fileCount++;
                }

            }
        }

        if ($error == true) {

            return redirect()->back()->withInput()->with('warning_msg', $msg1 . $msg2 . $msg3, $msg4 . $msg5 . $msg6);

        } else {
            $data = [
                'VectorOrderID' => $vectorid,
                'DesignerMessage' => \Input::get('DesignerMessage'),
                'DateAdded' => new \DateTime()
            ];
            \DB::table('vector_result')->insert($data);

            $InsertID = \DB::getPdo()->lastInsertId();

            $orderDetail = \DB::table('vector_order')->where('VectorOrderID', $vectorid)->first();

            $OrderDRID = \DB::table('vector_revision')
                ->where('VectorOrderID', $vectorid)->where('From', 3)->get();

            if ($orderDetail->OrderType == 1) {
                $CountRev =  count($OrderDRID, COUNT_RECURSIVE);

                $CountRev = 'Revision-'.$CountRev;
            } else {
                $CountRev = $InsertID;

            }




            $filename = '';

            if (Input::hasFile('Filea')) {
                $count = 1;
                foreach ($filea as $fl) {

                    $filename = 'vc_' .'order'. $vectorid . 'A_' . $CountRev . '_' . $count .'.' . $fl->getClientOriginalExtension();
                    $file = $filename;
                    $path = public_path('uploads') . '/orders/vector';
                    $fl->move($path, $file);
                    \DB::table('vector_result_files')->insert(['VR_ID' => $InsertID, 'VectorOrderID' => $vectorid, 'File' => $file, 'Category' => 'a']);
                    $count++;
                }

            }



            if (Input::hasFile('Fileb')) {
                $count = 1;

                foreach ($fileb as $fl) {

                    $filename = 'vc_' .'order'. $vectorid . 'B_' . $CountRev . '_' . $count .'.' . $fl->getClientOriginalExtension();
                    $file = $filename;
                    $path = public_path('uploads') . '/orders/vector';
                    $fl->move($path, $file);
                    \DB::table('vector_result_files')->insert(['VR_ID' => $InsertID, 'VectorOrderID' => $vectorid, 'File' => $file, 'Category' => 'b']);
                    $count++;
                }

            }



            if (Input::hasFile('Filec')) {
                $count = 1;
                foreach ($filec as $fl) {

                    $filename = 'vc_' .'order'. $vectorid . 'C_' . $CountRev . '_' . $count .'.' . $fl->getClientOriginalExtension();
                    $file = $filename;
                    $path = public_path('uploads') . '/orders/vector';
                    $fl->move($path, $file);
                    \DB::table('vector_result_files')->insert(['VR_ID' => $InsertID, 'VectorOrderID' => $vectorid, 'File' => $file, 'Category' => 'c']);
                    $count++;
                }

            }



            if (Input::hasFile('Filea') || Input::hasFile('Fileb') || Input::hasFile('Filec')) {
                \DB::table('vector_order')->where('VectorOrderID', $vectorid)->update(['Status' => '6']);
            }

            \DB::table('vector_order')->where('VectorOrderID', $vectorid)->update(['AssignStatus' => '0', 'IsRead' => '0']);

            return back()->with('success', 'File Sent Successfully.');
        }
    }

    public function digi_complete($orderid)
    {

        try {
            $CountRev = 0;

            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'emb', 'dst', 'dsb','pcs', 'hus', 'jef', 'pdf', 'pof', 'u01', 'pxf', 'exp', 'cnd', 'ppt', 'doc', 'pes', 'xxx', 'toyota100', 'eps'];
            $categories = ['Filea' => 'a', 'Fileb' => 'b', 'Filec' => 'c'];

            $errorMessages = [];
            $totalFileCount = 0;

            foreach ($categories as $inputName => $categoryCode) {
                if (Input::hasFile($inputName)) {
                    $files = Input::file($inputName);

                    foreach ($files as $file) {
                        $extension = strtolower($file->getClientOriginalExtension());

                        // Validate file extension
                        if (!in_array($extension, $allowedExtensions)) {
                            $errorMessages[] = "Invalid file type in category '{$inputName}' for file '{$file->getClientOriginalName()}'.";
                        } else {
                            $totalFileCount++;
                        }
                    }
                }
            }

            if (!empty($errorMessages)) {
                return redirect()->back()->withInput()->with('warning_msg', implode('<br>', $errorMessages));
            } else {

                $data = [
                    'OrderID' => $orderid,
                    'DesignerMessage' => \Input::get('DesignerMessage'),
                    'DateAdded' => new \DateTime()
                ];

                \DB::table('digi_result')->insert($data);

                $InsertID = \DB::getPdo()->lastInsertId();
                $orderDetail = DB::table('digitizing_orders')->where('OrderID', $orderid)->first();

                $OrderDRID = \DB::table('digi_revision')
                    ->where('OrderID', $orderid)->where('From', 3)->get();

                if ($orderDetail->OrderType == 1) {
                    $CountRev =  count($OrderDRID, COUNT_RECURSIVE);

                    $CountRev = 'Revision-'.$CountRev;
                } else {
                    $CountRev = $InsertID;

                }

                // Proceed with file uploads if validation passed
                foreach ($categories as $inputName => $categoryCode) {
                    if (Input::hasFile($inputName)) {
                        $files = Input::file($inputName);
                        Helper::handleDigiFileUploads($files, $categoryCode, $orderid, $CountRev, $InsertID);
                    }
                }

                // Update order status if any files were uploaded
                if ($totalFileCount > 0) {
                    \DB::table('digitizing_orders')->where('OrderID', $orderid)->update(['Status' => '6']);
                }

                \DB::table('digitizing_orders')->where('OrderID', $orderid)->update(['AssignStatus' => '0', 'IsRead' => '0']);

                return back()->with('success', 'File Sent Successfully.');
            }
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function vector_revision($type)
    {

        $this->data['orders'] = \App\vector_order::select('vector_order.*', 'customers.CustomerName')
                ->where('DesignerID', \Session::get('DesignerID'))
                ->where('vector_order.OrderType', $type)
                ->where('vector_revision.RevisionType', 1)
                ->leftJoin('customers', 'vector_order.CustomerID', '=', 'customers.CustomerID')
                ->leftJoin('vector_revision', 'vector_revision.VectorOrderID', '=', 'vector_order.VectorOrderID')
                ->distinct('vector_revision.VectorOrderID')
                ->orderBy('Status', 'asc')
                ->get();

        $this->data['OrderTypes'] = Config('order_types');
        $this->data['OrderStatuses'] = Config('order_statuses');

        return view('designer.VectorOrders', $this->data);
    }

    public function digi_revision($type)
    {

        $this->data['orders'] = \App\DigiOrders::select('digitizing_orders.*', 'customers.CustomerName')
                ->where('DesignerID', \Session::get('DesignerID'))
                ->where('digitizing_orders.OrderType', $type)
                ->where('digi_revision.RevisionType', 1)
                ->leftJoin('customers', 'digitizing_orders.CustomerID', '=', 'customers.CustomerID')
                ->leftJoin('digi_revision', 'digi_revision.OrderID', '=', 'digitizing_orders.OrderID')
                ->distinct('digi_revision.OrderID')
                ->orderBy('Status', 'asc')
                ->get();

        $this->data['OrderTypes'] = Config('order_types');
        $this->data['OrderStatuses'] = Config('order_statuses');

        return view('designer.DigiOrders', $this->data);
    }

}
