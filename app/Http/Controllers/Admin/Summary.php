<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Input;
use admin\summary\history\historyindi;
use App\DigiRevFiles;
use Validator;
use DB;
use PDF;
use File;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Summary extends AdminController
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //   $this->data['DigiOrders'] = \App\Customers::all();

        $this->data['OrderTypes'] = \App\Customers::all();
        $this->data['Orders'] = '';
        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');
        $Today = Carbon::today();


        #Both Digitizing and Vector Data

        #Digitizing
        $Qurey = \App\DigiOrders::select('digitizing_orders.OrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'OrderType', 'digitizing_orders.IsRead')
            ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
            ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
            ->where(DB::Raw('date(digitizing_orders.DateAdded)'), $Today);


        $this->data['DigiOrders'] = $Qurey->orderby('digitizing_orders.OrderID', 'desc')->get();

        #Vector
        $Qurey = \App\vector_order::select('VectorOrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'vector_order.Status', 'OrderType', 'vector_order.IsRead')
            ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
            ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
            ->where(DB::Raw('date(vector_order.DateAdded)'), $Today);



        $this->data['VecOrders'] = $Qurey->orderby('vector_order.VectorOrderID', 'desc')->get();


        return view('admin.summary.history.historyindi', $this->data);
    }

    public function client_sum()
    {

        $this->data['OrderTypes'] = \App\Customers::all();
        $this->data['Orders'] = '';
        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');
        $this->data['allcustomers'] = \DB::table('customers')->get();


        return view('admin.summary.customers.index', $this->data);
    }

    public function sales_sum()
    {

        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');
        $this->data['Sales_Rep'] = \App\SalesPerson::select('SalesPersonID', 'SalesPersonName')->get();
        $this->data['allcustomers'] = \DB::table('customers')->get();

        return view('admin.summary.sales.index', $this->data);
    }



    public function cus_search_records()
    {

        // dd(Input::all());
        $Type = 0;

        $To = Input::get('DateTo');
        $From = Input::get('DateFrom');
        $Cat = Input::get('Cetagory');
        $CustomerID = Input::get('cusname');
        $Type = Input::get('type');

        if ($Type == 5) {
            $Type = 0;
        } elseif ($Type == 1) {
            $Type = 1;
        } elseif ($Type == 2) {
            $Type = 2;
        } elseif ($Type == 4) {
            $Type = 4;
        } elseif ($Type == 3) {
            $Type = 3;
        } else {
            $Type = "";
        }



        $this->data['OrderTypes'] = \App\Customers::all();
        $this->data['Orders'] = '';
        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');
        $this->data['allcustomers'] = \DB::table('customers')->get();

        if ($To != "" && $From != "") {

            if ($Cat == 1) {
                // echo "Its Digi"; die;


                $this->data['Cat'] = 1;
                $Qurey = \App\DigiOrders::select('digitizing_orders.OrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'OrderType', 'digitizing_orders.IsRead')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                    ->where('digitizing_orders.OrderType', '!=', 2)
                    ->where('digitizing_orders.OrderType', '!=', 4)
                    ->whereBetween(DB::Raw('date(digitizing_orders.DateAdded)'), array($From, $To));
                if ($CustomerID > 0) {
                    $Qurey->where('digitizing_orders.CustomerID', $CustomerID);
                }
                if ($Type !== "") {
                    $Qurey->where('digitizing_orders.OrderType', $Type);
                }


                $this->data['d_Orders'] = $Qurey->orderby('digitizing_orders.OrderID', 'desc')->get();


                return view('admin.summary.customers.index', $this->data);
            } else if ($Cat == 2) {
                // echo "Its Vector"; die;


                $this->data['Cat'] = 2;
                $Qurey = \App\vector_order::select('vector_order.VectorOrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'OrderType', 'vector_order.IsRead')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                    ->where('vector_order.OrderType', '!=', 2)
                    ->where('vector_order.OrderType', '!=', 4)
                    ->whereBetween(DB::Raw('date(vector_order.DateAdded)'), array($From, $To));
                if ($CustomerID > 0) {
                    $Qurey->where('vector_order.CustomerID', $CustomerID);
                }
                if ($Type !== "") {
                    $Qurey->where('vector_order.OrderType', $Type);
                }

                $this->data['v_Orders'] = $Qurey->orderby('vector_order.VectorOrderID', 'desc')->get();
                return view('admin.summary.customers.index', $this->data);
            } elseif ($Cat == "") {

                // echo "Its Null"; die;

                // Digitizing Orders Patch
                $d_Qurey = \App\DigiOrders::select('digitizing_orders.OrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'OrderType', 'digitizing_orders.IsRead')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                    ->where('digitizing_orders.OrderType', '!=', 2)
                    ->where('digitizing_orders.OrderType', '!=', 4)
                    ->whereBetween(DB::Raw('date(digitizing_orders.DateAdded)'), array($From, $To));
                if ($CustomerID > 0) {
                    $d_Qurey->where('digitizing_orders.CustomerID', $CustomerID);
                }
                if ($Type !== "") {
                    $d_Qurey->where('digitizing_orders.OrderType', $Type);
                }

                // Vector Orders Patch

                $v_Qurey = \App\vector_order::select('vector_order.VectorOrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'OrderType', 'vector_order.IsRead')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                    ->where('vector_order.OrderType', '!=', 2)
                    ->where('vector_order.OrderType', '!=', 4)
                    ->whereBetween(DB::Raw('date(vector_order.DateAdded)'), array($From, $To));
                if ($CustomerID > 0) {
                    $v_Qurey->where('vector_order.CustomerID', $CustomerID);
                }
                if ($Type !== "") {
                    $v_Qurey->where('vector_order.OrderType', $Type);
                }

                $this->data['d_Orders'] = $d_Qurey->orderby('digitizing_orders.OrderID', 'desc')->get();
                $this->data['v_Orders'] = $v_Qurey->orderby('vector_order.VectorOrderID', 'desc')->get();

                return view('admin.summary.customers.index', $this->data);
            } else {
                return redirect('admin/summary/customers')->with('warning_msg', "Invalid Selecttion Under");
            }
        } else {
            return redirect('admin/summary/customers')->with('warning_msg', "Invalid Selecttion");
        }
    }





    public function sales_spec_records()
    {

        //dd(Input::all());
        $Type = 0;

        $To = Input::get('DateTo');
        $From = Input::get('DateFrom');
        $Cat = Input::get('Cetagory');
        $SalesPerson = Input::get('salesname');
        $CustomerID = Input::get('cusname');
        $Type = Input::get('type');
        //$Current_Status = Input::get('status');


        if ($Type == 5) {
            $Type = 0;
        } elseif ($Type == 1) {
            $Type = 1;
        } elseif ($Type == 2) {
            $Type = 2;
        } elseif ($Type == 4) {
            $Type = 4;
        } elseif ($Type == 3) {
            $Type = 3;
        } else {
            $Type = "";
        }


        // if($Current_Status == 0){
        //     $Current_Status = 0;
        // }elseif ($Current_Status == 1) {
        //     $Current_Status = 1;
        // }elseif ($Current_Status == 2) {
        //     $Current_Status = 2;
        // }elseif ($Current_Status == 4) {
        //     $Current_Status = 4;
        // }elseif ($Current_Status == 3) {
        //     $Current_Status = 3;
        // }elseif($Current_Status == ""){
        //     $Current_Status = "";
        // }

        $this->data['OrderTypes'] = \App\Customers::all();
        $this->data['Orders'] = '';
        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');
        $this->data['allcustomers'] = \DB::table('customers')->get();
        $this->data['Sales_Rep'] = \App\SalesPerson::select('SalesPersonID', 'SalesPersonName')->get();

        if ($To != "" && $From != "") {
            if ($Cat == 1) {

                $this->data['Cat'] = 1;

                $d_Qurey = \App\DigiOrders::select('digitizing_orders.OrderID', 'CustomerName', 'DesignerName', 'SalesPersonName', 'DesignName', 'PONumber', 'OrderType', 'digitizing_orders.Status', 'digitizing_orders.IsRead')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                    ->leftjoin('salesperson', 'salesperson.SalesPersonID', '=', 'digitizing_orders.SalesPersonID')
                    ->where('digitizing_orders.SalesPersonID', $SalesPerson)
                    ->whereBetween(DB::Raw('date(digitizing_orders.DateAdded)'), array($From, $To));
                if ($CustomerID > 0) {
                    $d_Qurey->where('digitizing_orders.CustomerID', $CustomerID);
                }
                if ($Type !== "") {
                    $d_Qurey->where('digitizing_orders.OrderType', $Type);
                }

                $this->data['d_Orders'] = $d_Qurey->orderby('digitizing_orders.OrderID', 'desc')->get();

                return view('admin.summary.sales.index', $this->data);
            } else if ($Cat == 2) {


                $this->data['Cat'] = 2;


                $v_Qurey = \App\vector_order::select('vector_order.VectorOrderID', 'CustomerName', 'DesignerName', 'SalesPersonName', 'DesignName', 'PONumber', 'OrderType', 'vector_order.Status', 'vector_order.IsRead')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                    ->leftjoin('salesperson', 'salesperson.SalesPersonID', '=', 'vector_order.SalesPersonID')
                    ->where('vector_order.SalesPersonID', $SalesPerson)
                    ->whereBetween(DB::Raw('date(vector_order.DateAdded)'), array($From, $To));
                if ($CustomerID > 0) {
                    $v_Qurey->where('vector_order.CustomerID', $CustomerID);
                }
                if ($Type !== "") {
                    $v_Qurey->where('vector_order.OrderType', $Type);
                }


                $this->data['v_Orders'] = $v_Qurey->orderby('vector_order.VectorOrderID', 'desc')->get();

                return view('admin.summary.sales.index', $this->data);
            } elseif ($Cat == "") {

                $d_Qurey = \App\DigiOrders::select('digitizing_orders.OrderID', 'CustomerName', 'DesignerName', 'SalesPersonName', 'DesignName', 'PONumber', 'OrderType', 'digitizing_orders.Status', 'digitizing_orders.IsRead')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                    ->leftjoin('salesperson', 'salesperson.SalesPersonID', '=', 'digitizing_orders.SalesPersonID')
                    ->where('digitizing_orders.SalesPersonID', $SalesPerson)
                    ->whereBetween(DB::Raw('date(digitizing_orders.DateAdded)'), array($From, $To));
                if ($CustomerID > 0) {
                    $d_Qurey->where('digitizing_orders.CustomerID', $CustomerID);
                }
                if ($Type !== "") {
                    $d_Qurey->where('digitizing_orders.OrderType', $Type);
                }


                $v_Qurey = \App\vector_order::select('vector_order.VectorOrderID', 'CustomerName', 'DesignerName', 'SalesPersonName', 'DesignName', 'PONumber', 'OrderType', 'vector_order.Status', 'vector_order.IsRead')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                    ->leftjoin('salesperson', 'salesperson.SalesPersonID', '=', 'vector_order.SalesPersonID')
                    ->where('vector_order.SalesPersonID', $SalesPerson)
                    ->whereBetween(DB::Raw('date(vector_order.DateAdded)'), array($From, $To));
                if ($CustomerID > 0) {
                    $v_Qurey->where('vector_order.CustomerID', $CustomerID);
                }
                if ($Type !== "") {
                    $v_Qurey->where('vector_order.OrderType', $Type);
                }

                $this->data['d_Orders'] = $d_Qurey->orderby('digitizing_orders.OrderID', 'desc')->get();
                $this->data['v_Orders'] = $v_Qurey->orderby('vector_order.VectorOrderID', 'desc')->get();


                return view('admin.summary.sales.index', $this->data);
            } else {
                return redirect('admin/summary');
            }
        } else {
            return redirect('admin/summary')->with('warning_msg', "Invalid Selecttion");
        }
    }



    public function artist_sum_rec()
    {
        $Type = 0;

        $To = Input::get('DateTo');
        $From = Input::get('DateFrom');
        $Cat = Input::get('Cetagory');
        $DesignerID = Input::get('designer');
        $Type = Input::get('type');

        $D_Cat = \App\Designers::first();



        if ($Type == 5) {
            $Type = 0;
        } elseif ($Type == 1) {
            $Type = 1;
        } elseif ($Type == 2) {
            $Type = 2;
        } elseif ($Type == 4) {
            $Type = 4;
        } elseif ($Type == 3) {
            $Type = 3;
        } else {
            $Type = "";
        }



        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');
        $this->data['artists_staff'] = \App\Designers::all();

        if (!empty($To || $From || $Cat)) {
            if ($D_Cat->Category == 2) {

                $this->data['Cat'] = 0;

                $Qurey = \App\DigiOrders::select('digitizing_orders.OrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'OrderType', 'digitizing_orders.IsRead')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                    ->where('digitizing_orders.DesignerID', $DesignerID)
                    ->whereRaw('digitizing_orders.DateAdded BETWEEN "' . $From . '" AND "' . $To . '"');
                if ($Type !== "") {
                    $Qurey->where('digitizing_orders.OrderType', $Type);
                }

                $this->data['Orders'] = $Qurey->orderby('digitizing_orders.OrderID', 'desc')->get();

                return view('admin.summary.designers.index', $this->data);
            } else if ($Cat == 1) {
                $this->data['Cat'] = 1;

                $Qurey = \App\vector_order::select('vector_order.VectorOrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'OrderType', 'vector_order.IsRead')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                    ->where('digitizing_orders.DesignerID', $DesignerID)
                    ->whereRaw('vector_order.DateAdded BETWEEN "' . $From . '" AND "' . $To . '"');
                if ($Type !== "") {
                    $Qurey->where('vector_order.OrderType', $Type);
                }

                $this->data['Orders'] = $Qurey->orderby('vector_order.VectorOrderID', 'desc')->get();

                return view('admin.summary.designers.index', $this->data);
            } else {
                return redirect('admin/summary');
            }
        } else {
            return redirect('admin/summary')->with('warning_msg', "Invalid Selecttion");
        }
    }



    public function designer_sum()
    {

        $this->data['artists_staff'] = \App\Designers::all();
        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');

        return view('admin.summary.designers.index', $this->data);
    }









    public function search_records()
    {

        $To = Input::get('DateTo');
        $From = Input::get('DateFrom');
        $Cat = Input::get('Cetagory');
        $Type = Input::get('type');
        $this->data['orderStableStatus'] = $this->stableStatus();


        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');



        if ($Type == 5) {
            $Type = 0;
        } elseif ($Type == 1) {
            $Type = 1;
        } elseif ($Type == 2) {
            $Type = 2;
        } elseif ($Type == 4) {
            $Type = 4;
        } elseif ($Type == 3) {
            $Type = 3;
        } else {
            $Type = "";
        }

        if ($Cat == null) {
            $Cat = 3;
        }


        if (!empty($To || $From || $Cat)) {
            if ($Cat == 0) {

                $this->data['Cat'] = 0;

                $Qurey = \App\DigiOrders::select('digitizing_orders.OrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'OrderType', 'digitizing_orders.IsRead', 'digitizing_orders.OrderStatus')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                    ->whereRaw('digitizing_orders.DateAdded BETWEEN "' . $From . '" AND "' . $To . '"');
                if ($Type !== "") {
                    $Qurey->where('digitizing_orders.OrderType', $Type);
                }

                $this->data['DigiOrders'] = $Qurey->orderby('digitizing_orders.OrderID', 'desc')->get();
                return view('admin.summary.history.historyindi', $this->data);
            } else if ($Cat == 1) {
                $this->data['Cat'] = 1;



                $Qurey = \App\vector_order::select('VectorOrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'vector_order.Status', 'OrderType', 'vector_order.IsRead', 'vector_order.OrderStatus')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                    ->whereRaw('vector_order.DateAdded BETWEEN "' . $From . '" AND "' . $To . '"');
                if ($Type !== "") {
                    $Qurey->where('vector_order.OrderType', $Type);
                }

                $this->data['VecOrders'] = $Qurey->orderby('vector_order.VectorOrderID', 'desc')->get();

                return view('admin.summary.history.historyindi', $this->data);
            } else if ($Cat == 3) {
                #Both Digitizing and Vector Data
                #Digitizing
                $Qurey = \App\DigiOrders::select('digitizing_orders.OrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'OrderType', 'digitizing_orders.IsRead', 'digitizing_orders.OrderStatus')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                    ->whereRaw('digitizing_orders.DateAdded BETWEEN "' . $From . '" AND "' . $To . '"');
                if ($Type !== "") {
                    $Qurey->where('digitizing_orders.OrderType', $Type);
                }

                $this->data['DigiOrders'] = $Qurey->orderby('digitizing_orders.OrderID', 'desc')->get();

                #Vector
                $Qurey = \App\vector_order::select('VectorOrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'vector_order.Status', 'OrderType', 'vector_order.IsRead', 'vector_order.OrderStatus')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                    ->whereRaw('vector_order.DateAdded BETWEEN "' . $From . '" AND "' . $To . '"');
                if ($Type !== "") {
                    $Qurey->where('vector_order.OrderType', $Type);
                }

                $this->data['VecOrders'] = $Qurey->orderby('vector_order.VectorOrderID', 'desc')->get();


                return view('admin.summary.history.historyindi', $this->data);
            } else {
                return redirect('admin/summary');
            }
        } else {
            return redirect('admin/summary')->with('warning_msg', "Invalid Selecttion");
        }
    }


    public function destroy_record($id)
    {

        if ($id > 0) {
            DB::table('digitizing_orders')
                ->where('OrderID', $id)
                ->delete();
        }
        return redirect('admin/digi/orders/all')->with('success', "Order Deleted Successfully");
    }



    public function vdestroy_record($id)
    {

        if ($id > 0) {
            DB::table('vector_order')
                ->where('VectorOrderID', $id)
                ->delete();
        }
        return redirect('admin/vector/orders/all')->with('success', "Order Deleted Successfully");
    }


    public function editDigiOrder($id)
    {
        $allow_order_type = [0, 1, 3, 9];
        $this->data['stableStatus'] = $this->stableStatus();



        if ($id > 0) {

            $orderData = \App\DigiOrders::where('OrderID', $id)->first();

            if (in_array($orderData->OrderType, $allow_order_type)) {
                $this->data['type'] = "Order";
            } else {
                $this->data['type'] = "Quote";
            }
            $this->data['order'] = $orderData;
            $this->data['allowed_ext'] =  ['jpg', 'JPG', 'JPEG', 'jpeg', 'png', "PNG", 'gif', 'GIF'];
            return view('admin.summary.EditOrder', $this->data);
        } else {
            return redirect()->back()->with('warning_msg', "Opps !! Order Dose Not Exit.");
        }
    }

    public function editVecOrder($id)
    {
        $allow_order_type = [0, 1, 3, 9];
        $this->data['stableStatus'] = $this->stableStatus();
        if ($id > 0) {

            $orderData = \App\vector_order::where('VectorOrderID', $id)->first();

            if (in_array($orderData->OrderType, $allow_order_type)) {
                $this->data['type'] = "Order";
            } else {
                $this->data['type'] = "Quote";
            }
            $this->data['order'] = $orderData;
            $this->data['allowed_ext'] =  ['jpg', 'JPG', 'JPEG', 'jpeg', 'png', "PNG", 'gif', 'GIF'];
            return view('admin.summary.EditOrderVec', $this->data);
        } else {
            return redirect()->back()->with('warning_msg', "Opps !! Order Dose Not Exit.");
        }
    }

    public function update_digi_order()
    {


        $OrderID = Input::get('id');

        $valid["DesignName"] = 'required|max:60';
        $valid["PoNum"] = 'max:20';
        $valid["ReqFormat"] = 'required|max:50';
        if (Input::has('ReqFormat') && Input::get('ReqFormat') == "Other") {
            $valid["OtherFormat"] = 'required|max:100';
        }
        $valid["Fabric"] = 'required|max:100';

        $valid["Placement"] = 'required|max:100';
        $valid["Width"] = 'nullable|max:100';
        $valid["Height"] = 'nullable|max:100';
        $valid["Scale"] = 'required|max:1000';
        $valid["NumofClr"] = 'nullable|max:20';
        $valid["FabricClr"] = 'max:100';
        $valid["Clrblending"] = 'required|max:100';
        $valid["PicEmb"] = 'required|max:20';
        $valid["BackFill"] = 'required|max:100';
        $valid["AddIns"] = 'max:25000';

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



        $messages = [
            'required' => 'Please enter :attribute.',
            'CountryID.min' => 'Please select :attribute.',
            'max' => 'No more characters allowed in :attribute.'
        ];

        $v = Validator::make(Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {


            $allowed_ext = ['jpg', 'pdf', 'PDF', 'JPG', 'JPEG', 'jpeg', 'eps', 'png', "PNG", 'psd', 'PSD', 'gif', 'EMB', 'DST', 'ai', 'PDF', 'cdr', 'pof', 'pxf', "Exp", 'cnd', 'ppt', 'doc', 'PES', 'xxx', 'toyota100', 'eps'];




            $OrderData = [
                'DesignName' => Input::get('DesignName'),
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
                'OrderStatus' => Input::get('StableStatus'),
                'DateModified' => new \DateTime()
            ];

            if (\App\DigiOrders::where('OrderID', $OrderID)->update($OrderData)) {

                $Or_detail = \App\DigiOrders::where('OrderID', $OrderID)->first();

                //*** -----------UPDATE FILES-----------****//
                if (Input::hasFile('File1')) {
                    $fl = Input::file('File1');
                    if (!empty($fl)) {
                        $ext = $fl->getClientOriginalExtension();
                        if (!in_array($ext, $allowed_ext)) {

                            return redirect()->back()->with('warning_msg', "Invalid File Extention in File One");
                        } else {

                            if ($Or_detail->File1 != "") {
                                $path = public_path('uploads') . '/orders/digi/' . $Or_detail->File1;
                                File::delete($path);
                            }

                            $filename1 = $OrderID . '_' . str_random(5) . '1.' . $ext;
                            $path = public_path('uploads') . '/orders/digi/';
                            $fl->move($path, $filename1);
                            \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update(['File1' => $filename1]);
                        }
                    }
                }


                if (Input::hasFile('File2')) {
                    $fl = Input::file('File2');
                    if (!empty($fl)) {
                        $ext = $fl->getClientOriginalExtension();
                        if (!in_array($ext, $allowed_ext)) {

                            return redirect()->back()->with('warning_msg', "Invalid File Extention in File Two");
                        } else {

                            if ($Or_detail->File2 != "") {
                                $path = public_path('uploads') . '/orders/digi/' . $Or_detail->File2;
                                File::delete($path);
                            }

                            $filename2 = $OrderID . '_' . str_random(5) . '2.' . $ext;
                            $path = public_path('uploads') . '/orders/digi/';
                            $fl->move($path, $filename2);
                            \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update(['File2' => $filename2]);
                        }
                    }
                }


                if (Input::hasFile('File3')) {
                    $fl = Input::file('File3');
                    if (!empty($fl)) {
                        $ext = $fl->getClientOriginalExtension();
                        if (!in_array($ext, $allowed_ext)) {

                            return redirect()->back()->with('warning_msg', "Invalid File Extention in File Three");
                        } else {

                            if ($Or_detail->File3 != "") {
                                $path = public_path('uploads') . '/orders/digi/' . $Or_detail->File3;
                                File::delete($path);
                            }

                            $filename3 = $OrderID . '_' . str_random(5) . '3.' . $ext;
                            $path = public_path('uploads') . '/orders/digi/';
                            $fl->move($path, $filename3);
                            \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update(['File3' => $filename3]);
                        }
                    }
                }


                if (Input::hasFile('File4')) {
                    $fl = Input::file('File4');
                    if (!empty($fl)) {
                        $ext = $fl->getClientOriginalExtension();
                        if (!in_array($ext, $allowed_ext)) {

                            return redirect()->back()->with('warning_msg', "Invalid File Extention in File Four");
                        } else {

                            if ($Or_detail->File4 != "") {
                                $path = public_path('uploads') . '/orders/digi/' . $Or_detail->File4;
                                File::delete($path);
                            }

                            $filename4 = $OrderID . '_' . str_random(5) . '4.' . $ext;
                            $path = public_path('uploads') . '/orders/digi/';
                            $fl->move($path, $filename4);
                            \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update(['File4' => $filename4]);
                        }
                    }
                }


                return redirect('admin/Norder-details/' . $OrderID)->with('success', "Updated Successfully");
                //return redirect()->back()->with('success', "Updated Successfully");
            } else {
                return redirect()->back()->with('warning_msg', "Some Thing Went Wrong!! Please Contact Website Engineer");
            }
        }
    }


    public function updateVecOrder()
    {
        $OrderID = Input::get('id');

        $valid["DesignName"] = 'required|max:20';
        $valid["PoNum"] = 'max:20';
        $valid["ReqFormat"] = 'required|max:50';
        if (Input::has('ReqFormat') && Input::get('ReqFormat') == "Other") {
            $valid["OtherFormat"] = 'required|max:100';
        }
        $valid["UsedFor"] = 'required|max:100';
        $valid["Width"] = 'nullable|max:100';
        $valid["Height"] = 'nullable|max:100';
        $valid["Scale"] = 'required|max:1000';
        $valid["RequriedClr"] = 'nullable|max:100';
        $valid["NumofClr"] = 'required|max:20';
        $valid["ReqSep"] = 'required|max:100';
        $valid["AddIns"] = 'nullable|max:25000';
        $valid["CCOrder"] = 'max:100';



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


        $messages = [
            'required' => 'Please enter :attribute.',
            'CountryID.min' => 'Please select :attribute.',
            'max' => 'No more characters allowed in :attribute.'
        ];

        $v = Validator::make(Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {

            $allowed_ext = ['jpg', 'JPG', 'JPEG', 'jpeg', 'png', "PNG", 'gif', 'GIF', 'EMB', 'emb', 'DST', 'dst', 'PDF', 'pdf', 'ai', 'AI', 'CDR', 'cdr', 'pof', 'POF', 'pxf', 'PXF', 'Exp', 'exp', 'CND', 'cnd', 'ppt', 'PPT', 'docx', 'DOCX', 'PES', 'pes', 'xxx', 'XXX', 'toyota100', 'TOYOTA100', 'eps', 'EPS'];


            $OrderData = [

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
                'OrderStatus' => Input::get('StableStatus'),
                'DateModified' => new \DateTime()
            ];

            if (\App\vector_order::where('VectorOrderID', $OrderID)->update($OrderData)) {

                $Or_detail = \App\vector_order::where('VectorOrderID', $OrderID)->first();

                //*** -----------UPDATE FILES-----------****//
                if (Input::hasFile('File1')) {
                    $fl = Input::file('File1');
                    if (!empty($fl)) {
                        $ext = $fl->getClientOriginalExtension();
                        if (!in_array($ext, $allowed_ext)) {

                            return redirect()->back()->with('warning_msg', "Invalid File Extention in File One");
                        } else {

                            if ($Or_detail->File1 != "") {
                                $path = public_path('uploads') . '/orders/vector/' . $Or_detail->File1;
                                File::delete($path);
                            }

                            $filename1 = $OrderID . '_' . str_random(5) . '1.' . $ext;
                            $path = public_path('uploads') . '/orders/vector/';
                            $fl->move($path, $filename1);
                            \App\vector_order::where('VectorOrderID', $OrderID)->update(['File1' => $filename1]);
                        }
                    }
                }


                if (Input::hasFile('File2')) {
                    $fl = Input::file('File2');
                    if (!empty($fl)) {
                        $ext = $fl->getClientOriginalExtension();
                        if (!in_array($ext, $allowed_ext)) {

                            return redirect()->back()->with('warning_msg', "Invalid File Extention in File Two");
                        } else {

                            if ($Or_detail->File2 != "") {
                                $path = public_path('uploads') . '/orders/vector/' . $Or_detail->File2;
                                File::delete($path);
                            }

                            $filename2 = $OrderID . '_' . str_random(5) . '2.' . $ext;
                            $path = public_path('uploads') . '/orders/vector/';
                            $fl->move($path, $filename2);
                            \App\vector_order::where('VectorOrderID', $OrderID)->update(['File2' => $filename2]);
                        }
                    }
                }


                if (Input::hasFile('File3')) {
                    $fl = Input::file('File3');
                    if (!empty($fl)) {
                        $ext = $fl->getClientOriginalExtension();
                        if (!in_array($ext, $allowed_ext)) {

                            return redirect()->back()->with('warning_msg', "Invalid File Extention in File Three");
                        } else {

                            if ($Or_detail->File3 != "") {
                                $path = public_path('uploads') . '/orders/vector/' . $Or_detail->File3;
                                File::delete($path);
                            }

                            $filename3 = $OrderID . '_' . str_random(5) . '3.' . $ext;
                            $path = public_path('uploads') . '/orders/vector/';
                            $fl->move($path, $filename3);
                            \App\vector_order::where('VectorOrderID', $OrderID)->update(['File3' => $filename3]);
                        }
                    }
                }


                if (Input::hasFile('File4')) {
                    $fl = Input::file('File4');
                    if (!empty($fl)) {
                        $ext = $fl->getClientOriginalExtension();
                        if (!in_array($ext, $allowed_ext)) {

                            return redirect()->back()->with('warning_msg', "Invalid File Extention in File Four");
                        } else {

                            if ($Or_detail->File4 != "") {
                                $path = public_path('uploads') . '/orders/vector/' . $Or_detail->File4;
                                File::delete($path);
                            }

                            $filename4 = $OrderID . '_' . str_random(5) . '4.' . $ext;
                            $path = public_path('uploads') . '/orders/vector/';
                            $fl->move($path, $filename4);
                            \App\vector_order::where('VectorOrderID', $OrderID)->update(['File4' => $filename4]);
                        }
                    }
                }


                // return redirect()->back()->with('success', "Updated Successfully");
                return redirect('admin/Vec_order-details/' . $OrderID)->with('success', "Order Updated Successfully");
            } else {
                return redirect()->back()->with('warning_msg', "Some Thing Went Wrong!! Please Contact Website Engineer");
            }
        }
    }


    public function jd()
    {

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



    public function digi_orders($StatusID)
    {


        if ($StatusID == 'all') {
            $this->data['DigiOrders'] = \App\DigiOrders::select('OrderID', 'customers.CustomerID as CusId', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'digitizing_orders.Status', 'OrderType', 'digitizing_orders.IsRead', 'digitizing_orders.OrderStatus', 'salesperson.SalesPersonName as salesrep', 'digitizing_orders.DateAdded', 'digitizing_orders.DateModified')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                ->leftjoin('salesperson', 'salesperson.SalesPersonID', '=', 'customers.SalesPersonID')
                ->where('digitizing_orders.QuotePrice', 0)
                ->orderBy('digitizing_orders.DateModified', 'desc')
                ->get();
        } else {
            $this->data['DigiOrders'] = \App\DigiOrders::select('OrderID', 'customers.CustomerID as CusId', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'digitizing_orders.Status', 'OrderType', 'digitizing_orders.IsRead', 'digitizing_orders.OrderStatus', 'salesperson.SalesPersonName as salesrep', 'digitizing_orders.DateAdded', 'digitizing_orders.DateModified')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                ->leftjoin('salesperson', 'salesperson.SalesPersonID', '=', 'customers.SalesPersonID')
                ->where('digitizing_orders.OrderType', $StatusID)
                ->orderBy('digitizing_orders.DateModified',  'desc')
                ->get();
        }

        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');

        return view('admin.summary.NewOrders', $this->data);
    }

    public function digi_orders_list(Request $request, $StatusID)
    {
        $columns = [
            'OrderID',
            'CustomerName',
            'DesignerName',
            'DesignName',
            'PONumber',
            'digitizing_orders.Status',
            'OrderType',
            'digitizing_orders.IsRead',
            'digitizing_orders.OrderStatus',
            'salesperson.SalesPersonName',
            'digitizing_orders.DateAdded',
            'digitizing_orders.DateModified'
        ];

        $query = \App\DigiOrders::select(
            'OrderID',
            'customers.CustomerID as CusId',
            'CustomerName',
            'DesignerName',
            'DesignName',
            'PONumber',
            'digitizing_orders.Status',
            'OrderType',
            'digitizing_orders.IsRead',
            'digitizing_orders.OrderStatus',
            'salesperson.SalesPersonName as salesrep',
            'digitizing_orders.DateAdded',
            'digitizing_orders.DateModified'
        )
            ->leftJoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
            ->leftJoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
            ->leftJoin('salesperson', 'salesperson.SalesPersonID', '=', 'customers.SalesPersonID');

        if ($StatusID == 'all') {
            $query->where('digitizing_orders.QuotePrice', 0);
        } else {
            $query->where('digitizing_orders.OrderType', $StatusID);
        }

        $totalData = $query->count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $DigiOrders = $query
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $DigiOrders = $query->where(function ($q) use ($search) {
                $q->where('OrderID', 'LIKE', "%{$search}%")
                    ->orWhere('CustomerName', 'LIKE', "%{$search}%")
                    ->orWhere('DesignerName', 'LIKE', "%{$search}%")
                    ->orWhere('DesignName', 'LIKE', "%{$search}%")
                    ->orWhere('PONumber', 'LIKE', "%{$search}%");
            })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = $query->where(function ($q) use ($search) {
                $q->where('OrderID', 'LIKE', "%{$search}%")
                    ->orWhere('CustomerName', 'LIKE', "%{$search}%")
                    ->orWhere('DesignerName', 'LIKE', "%{$search}%")
                    ->orWhere('DesignName', 'LIKE', "%{$search}%")
                    ->orWhere('PONumber', 'LIKE', "%{$search}%");
            })
                ->count();
        }

        $data = [];
        foreach ($DigiOrders as $order) {
            $data[] = [
                "OrderID" => $order->OrderID,
                "CustomerName" => $order->CustomerName,
                "DesignerName" => $order->DesignerName,
                "DesignName" => $order->DesignName,
                "PONumber" => $order->PONumber,
                "Status" => Config('order_statuses')[$order->Status],
                "OrderType" => $order->OrderType,
                "IsRead" => $order->IsRead,
                "salesrep" => $order->salesrep,
                "DateAdded" => $order->DateAdded,
                "Action" => ' <select class="pull-right btn btn-primary" onchange="javascript:takeAction(' . $order->OrderID . ')" id="action-' . $order->OrderID . '">
                                                        <option value="">Select Action</option>
                                                        <option value="view" on>View</option>
                                                        <option value="update_type">Update Type</option>
                                                    </select>'
                // Add any additional formatting or HTML here
            ];
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        return response()->json($json_data);
    }

    public function vector_orders($StatusID)
    {



        if ($StatusID == 'all') {
            $this->data['VectorOrders'] = \App\vector_order::select('VectorOrderID', 'customers.CustomerID as CusId', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'vector_order.Status', 'OrderType', 'vector_order.IsRead', 'vector_order.OrderStatus',  'salesperson.SalesPersonName as salesrep', 'vector_order.DateAdded', 'vector_order.DateModified')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                ->leftjoin('salesperson', 'salesperson.SalesPersonID', '=', 'customers.SalesPersonID')
                ->where('vector_order.QuotePrice', 0)
                ->orderBy('vector_order.DateModified', 'desc')
                ->get();
        } else {
            $this->data['VectorOrders'] = \App\vector_order::select('VectorOrderID', 'customers.CustomerID as CusId', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'vector_order.Status', 'OrderType', 'vector_order.IsRead', 'vector_order.OrderStatus', 'salesperson.SalesPersonName as salesrep', 'vector_order.DateAdded', 'vector_order.DateModified')
                ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                ->leftjoin('salesperson', 'salesperson.SalesPersonID', '=', 'customers.SalesPersonID')
                ->where('vector_order.OrderType', $StatusID)
                ->orderBy('vector_order.DateModified', 'desc')
                ->get();
        }
        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');


        return view('admin.summary.VectorOrders', $this->data);
    }

    public function vec_OrderDetail($VectorOrderID)
    {

        $this->data['VectorOrders'] = \App\vector_order::select('vector_order.VectorOrderID', 'CustomerName', 'customers.SalesPersonID', 'ReqFormat', 'DesignerName', 'UsedFor', 'AssignStatus', 'CC', 'File1', 'File2', 'File3', 'File4', 'MoreInstructions', 'NoOfColors', 'DesignName', 'PONumber', 'vector_order.Status', 'OrderType', 'vector_order.DesignerID', 'DesignerPrice', 'CustomerPrice', 'Price', 'customers.priceplane', 'MessageForAdmin', 'QuotePrice', 'IsRead', 'vector_result.VR_ID', 'Scale', 'Height', 'Width', 'ReqColor', 'ReqSeparation', 'CustomerPrice', 'vector_order.DateAdded')
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

        $rev = '';

        if ($revision_history != null) {
            if (is_array($revision_history)) {
                if (!isset($revision_history[1])) {
                    $single_rev = $revision_history[0];
                    $rev = $single_rev['DesignerMessage'];
                }
            }
        }


        $this->data['firstDesignerResponse'] = $rev;

        $this->data['revision_history'] = $revision_history;


        $this->data['DesignFiles'] = \DB::table('vector_result_files')
            ->where('VectorOrderID', $VectorOrderID)
            ->whereRaw('VR_ID = (SELECT MAX(VR_ID) FROM vector_result_files WHERE VectorOrderID = ' . $VectorOrderID . ')')
            ->get();

        $this->data['RivisionHistory'] = \DB::table('vector_revision')
            ->where('VectorOrderID', $VectorOrderID)
            ->get();

        #---------OLD --------###

        // $this->data['Revision'] = \DB::table('vector_revision')
        //         ->where('VectorOrderID', $VectorOrderID)
        //         ->where('From', 3)
        //         ->where('To', 1)
        //         ->get();

        #-------------OLD----------##


        #xxxxxxxxxxxxx-------xxxxxxx----NEW CODE----xxxxxxxxxxxxxxx#

        $this->data['Revision'] = \DB::table('vector_revision')
            ->where('VectorOrderID', $VectorOrderID)
            ->where('From', 3)
            ->where('To', 1)
            ->get();

        $Customer_Rev_Data = $this->data['Revision'];
        $cus_revision_history = [];

        if (!empty($Customer_Rev_Data)) {
            foreach ($Customer_Rev_Data as $order_dr) {
                $ResultFiles = \DB::table('vector_customer_rev_files')->where('OrderID', $VectorOrderID)->where('revise_id', $order_dr->RevisionID)->get();
                $cus_revision_history[] = [
                    'CustomerMessage' => $order_dr->Message,
                    'DateAdded' => $order_dr->DateAdded,
                    'Files' => $ResultFiles,
                ];
            }
        }
        $this->data['Revision'] = $cus_revision_history;

        #xxxxxxxxxxxxx-------xxxxxxx----NEW CODE----xxxxxxxxxxxxxxx#






        $this->data['OrderStatuses'] = Config('order_statuses');

        $this->data['Designers'] = \App\Designers::where('Category', 1)
            ->pluck('DesignerName', 'DesignerID');
        //       array_unshift($this->data['Designers'], "Select Designer");
        //       print_r($this->data['Designers']);die;

        if ($this->data['VectorOrders']->IsRead == 0) {
            \DB::table('vector_order')->where('VectorOrderID', $VectorOrderID)->update(['IsRead' => 3]);
        }

        $this->data['OrderTypes'] = Config('order_types');

        return view('admin.summary.VecOrderDetail', $this->data);
    }

    public function OrderDetail(Request $request, $OrderID)
    {


        $this->data['DigiOrders'] = \App\DigiOrders::select('digitizing_orders.OrderID', 'customers.SalesPersonID', 'CustomerName', 'ReqFormat', 'Fabric', 'FabricColor', 'DesignerName', 'ColorBlending', 'BackgroundFill', 'PictureEmbroidery', 'Placement', 'digitizing_orders.DateAdded', 'AssignStatus', 'CC', 'File1', 'File2', 'File3', 'File4', 'MoreInstructions', 'NoOfColors', 'DesignName', 'PONumber', 'OtherFormat', 'digitizing_orders.Status', 'OrderType', 'digitizing_orders.DesignerID', 'DesignerPrice', 'CustomerPrice', 'Price', 'customers.priceplane', 'MessageForAdmin', 'QuotePrice', 'IsRead', 'Scale', 'Height', 'Width', 'CustomerPrice', 'customers.CsNote')
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

        if (!empty($OrderDRID)) {
            foreach ($OrderDRID as $order_dr) {
                $ResultFiles = \DB::table('digi_result_files')->where('OrderID', $OrderID)->where('DR_ID', $order_dr->DR_ID)->get();
                $revision_history[] = [
                    'DesignerMessage' => $order_dr->DesignerMessage,
                    'DateAdded' => $order_dr->DateAdded,
                    'Files' => $ResultFiles
                ];
            }
        }
        $rev = '';

        if ($revision_history != null) {
            if (is_array($revision_history)) {
                if (!isset($revision_history[1])) {
                    $single_rev = $revision_history[0];
                    $rev = $single_rev['DesignerMessage'];
                }
            }
        }


        $this->data['firstDesignerResponse'] = $rev;

        $this->data['revision_history'] = $revision_history;
        //  $OrderRevHistory[] = \DB::table('digi_result_files')
        //       ->where('OrderID', $OrderID)->get();
        // echo '<pre>'.print_r($revision_hist,ory, 1).'</rpe>'; die;



        $this->data['DesignFiles'] = \DB::table('digi_result_files')
            ->where('OrderID', $OrderID)
            ->whereRaw('DR_ID = (SELECT MAX(DR_ID) FROM digi_result_files WHERE OrderID = ' . $OrderID . ')')
            ->get();

        $this->data['RivisionHistory'] = \DB::table('digi_revision')
            ->where('OrderID', $OrderID)
            ->get();




        $this->data['Revision'] = \DB::table('digi_revision')
            ->where('OrderID', $OrderID)
            ->where('From', 3)
            ->where('To', 1)
            ->get();

        $Customer_Rev_Data = $this->data['Revision'];
        $cus_revision_history = [];

        if (!empty($Customer_Rev_Data)) {
            foreach ($Customer_Rev_Data as $order_dr) {
                $ResultFiles = DigiRevFiles::where('OrderID', $OrderID)->where('revise_id', $order_dr->RevisionID)->get();
                $cus_revision_history[] = [
                    'CustomerMessage' => $order_dr->Message,
                    'DateAdded' => $order_dr->DateAdded,
                    'Files' => $ResultFiles,
                ];
            }
        }

        $this->data['Revision'] = $cus_revision_history;



        $this->data['OrderStatuses'] = Config('order_statuses');

        $this->data['Designers'] = \App\Designers::where('Category', 2)->pluck('DesignerName', 'DesignerID');
        //       array_unshift($this->data['Designers'], "Select Designer");

        if ($this->data['DigiOrders']->IsRead == 0) {
            \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update(['IsRead' => 3]);
        }

        $this->data['OrderTypes'] = Config('order_types');

        if ($request->ajax()) {
            return (['message' => 'Data fetched successfully', 'data' => $this->data]);
        }

        return view('admin.summary.OrderDetail', $this->data);
    }


    public function update_order_type(Request $request, $OrderID)
    {
        $orderData = \App\DigiOrders::where('OrderID', $OrderID)->first();
        if ($orderData) {
            $orderData->OrderType = $request->OrderType;
            $orderData->save();

            return redirect()->back()->with('success', 'Order type updated successfully.');
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function AssignSubmit($OrderID)
    {

        // Revision CODE LINE 1490



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

            if ($order->OrderType == 0 || $order->OrderType == 3) {

                $status = 5;
            }
            if ($order->OrderType == 2) {
                $type = 2;
            }
            $orderDetail = [
                'DesignerID' => \Input::get('DesignerID'),
                'MessageForDesigner' => \Input::get('MessageForDesigner'),
                'IsRead' => $read,
                'AssignStatus' => 1,
                'Status' => $status,
                'DateModified' => new \DateTime
            ];

            $DesignerID = \Input::get('DesignerID');
            $D_data = DB::table('designers')->select('DesignerName', 'Email')->where('DesignerID', $DesignerID)->first();

            \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update($orderDetail);
            $this->data['designer_email'] = $D_data->Email;
            $path = public_path('uploads') . '/orders/digi/';

            $attachFiles[] = $path . $order->File1;
            $attachFiles[] = $path . $order->File2;
            $attachFiles[] = $path . $order->File3;
            $attachFiles[] = $path . $order->File4;

            if ($order->OrderType == 2 || $order->OrderType == 4) {
                $type = "Quote";
                $mailFrom = 'technical-team@logoartz.com';
                \Mail::send(
                    'includes.emails.digi_designer',
                    [
                        "DesignerName" => $D_data->DesignerName,
                        "OrderType" => 'Digitizing ' . $type,
                        "OrderStatus" => 1,
                        "DesignName" => $order->DesignName,
                        "RequriedFormat" => $order->ReqFormat,
                        "FABRIC" => $order->Fabric,
                        "PLACEMENT" => $order->Placement,
                        "Width" => $order->Width,
                        "Height" => $order->Height,
                        "Scale" => $order->Scale,
                        "NumClr" => $order->NoOfColors,
                        "Fbrclr" => $order->FabricColor,
                        "Adminmsg" => \Input::get('MessageForDesigner')
                    ],
                    function ($message) use ($mailFrom, $attachFiles) {
                        $message->to($this->data['designer_email'])->from($mailFrom, 'Logo Artz')->subject('Logo Artz -Assigned Digitizing Quote');
                        if (!empty($attachFiles)) {
                            foreach ($attachFiles as $attachmentPath) {
                                if (file_exists($attachmentPath)) {
                                    $message->attach($attachmentPath);
                                }
                            }
                        }
                    }
                );
            } else {
                $type = "Order";

                $mailFrom = 'technical-team@logoartz.com';
                \Mail::send(
                    'includes.emails.digi_designer',
                    [
                        "DesignerName" => $D_data->DesignerName,
                        "OrderType" => 'Digitizing ' . $type,
                        "OrderStatus" => 1,
                        "DesignName" => $order->DesignName,
                        "RequriedFormat" => $order->ReqFormat,
                        "FABRIC" => $order->Fabric,
                        "PLACEMENT" => $order->Placement,
                        "Width" => $order->Width,
                        "Height" => $order->Height,
                        "Scale" => $order->Scale,
                        "NumClr" => $order->NoOfColors,
                        "Fbrclr" => $order->FabricColor,
                        "Adminmsg" => \Input::get('MessageForDesigner')
                    ],
                    function ($message) use ($mailFrom, $attachFiles) {
                        $message->to($this->data['designer_email'])->from($mailFrom, 'Logo Artz')->subject('Logo Artz -Assigned Digitizing Order');
                        if (!empty($attachFiles)) {
                            foreach ($attachFiles as $attachmentPath) {
                                if (file_exists($attachmentPath)) {
                                    $message->attach($attachmentPath);
                                }
                            }
                        }
                    }
                );
            }


            // \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update($orderDetail);
            return redirect('admin/Norder-details/' . $OrderID)->with('success', 'Assigned to Designer Successfully');
        }
    }




    public function VecAssignSubmit_q_rev($VectorOrderID)
    {
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
            $order = \DB::table('vector_order')->where('VectorOrderID', $VectorOrderID)->first();

            if ($order->OrderType == 2) {
                $type = 2;          //Type 2 (Quote)
            }
            if ($order->OrderType == 4) {
                $type = 4;       //Type 2 (Quote Revision)
                $status = 10; //Status 10 (Revision)
            }

            $orderDetail = [
                'DesignerID' => \Input::get('DesignerID'),
                'MessageForDesigner' => \Input::get('MessageForDesigner'),
                'IsRead' => $read,
                'AssignStatus' => 1,
                'Status' => $status,
                'DateModified' => new \DateTime
            ];

            \App\vector_order::where('VectorOrderID', $VectorOrderID)->update($orderDetail);

            $DesignerID = \Input::get('DesignerID');
            $D_data = DB::table('designers')->select('DesignerName', 'Email')->where('DesignerID', $DesignerID)->first();
            $this->data['designer_email'] = $D_data->Email;

            $path = public_path('uploads') . '/orders/digi/';

            $attachFiles[] = $path . $order->File1;
            $attachFiles[] = $path . $order->File2;
            $attachFiles[] = $path . $order->File3;
            $attachFiles[] = $path . $order->File4;

            $designerEmail = $D_data->Email;

            $type = "Quote";
            $mailFrom = 'technical-team@logoartz.com';
            \Mail::send(
                'includes.emails.vec_designer',
                [
                    "DesignerName" => $D_data->DesignerName,
                    "OrderType" => 'Vector ' . $type,
                    "OrderStatus" => 1,
                    "DesignName" => $order->DesignName,
                    "RequriedFormat" => $order->ReqFormat,
                    "Vecuse" => $order->UsedFor,
                    "Width" => $order->Width,
                    "Height" => $order->Height,
                    "Scale" => $order->Scale,
                    "Reqclr" => $order->ReqColor,
                    "NumClr" => $order->NoOfColors,
                    "Adminmsg" => \Input::get('MessageForDesigner')
                ],
                function ($message) use ($mailFrom, $designerEmail, $attachFiles) {
                    $message->to($designerEmail)->from($mailFrom, 'Logo Artz')->subject('Logo Artz -Assigned Vector Quote Revision');

                    if (!empty($attachFiles)) {
                        foreach ($attachFiles as $attachmentPath) {
                            if (file_exists($attachmentPath)) {
                                $message->attach($attachmentPath);
                            }
                        }
                    }
                }
            );



            return redirect('admin/Vec_order-details/' . $VectorOrderID)->with('success', 'Assigned to Designer Successfully');
        }
    }


    public function AssignSubmit_q_rev($OrderID)
    {
        // Quote Revision Set
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


            if ($order->OrderType == 2) {
                $type = 2;
            }
            if ($order->OrderType == 4) {
                $type = 4;
                $status = 10;
            }
            $orderDetail = [
                'DesignerID' => \Input::get('DesignerID'),
                'MessageForDesigner' => \Input::get('MessageForDesigner'),
                'IsRead' => $read,
                'AssignStatus' => 1,
                'Status' => $status,
                'DateModified' => new \DateTime
            ];
            \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update($orderDetail);
            $DesignerID = \Input::get('DesignerID');
            $D_data = DB::table('designers')->select('DesignerName', 'Email')->where('DesignerID', $DesignerID)->first();
            $designerEmail = $D_data->Email;

            $path = public_path('uploads') . '/orders/digi/';

            $attachFiles[] = $path . $order->File1;
            $attachFiles[] = $path . $order->File2;
            $attachFiles[] = $path . $order->File3;
            $attachFiles[] = $path . $order->File4;

            $mailFrom = 'technical-team@logoartz.com';
            \Mail::send(
                'includes.emails.digi_designer',
                [
                    "DesignerName" => $D_data->DesignerName,
                    "OrderType" => 'Digitizing ' . $type,
                    "OrderStatus" => 1,
                    "DesignName" => $order->DesignName,
                    "RequriedFormat" => $order->ReqFormat,
                    "FABRIC" => $order->Fabric,
                    "PLACEMENT" => $order->Placement,
                    "Width" => $order->Width,
                    "Height" => $order->Height,
                    "Scale" => $order->Scale,
                    "NumClr" => $order->NoOfColors,
                    "Fbrclr" => $order->FabricColor,
                    "Adminmsg" => \Input::get('MessageForDesigner')
                ],
                function ($message) use ($mailFrom, $designerEmail, $attachFiles) {
                    $message->to($designerEmail)->from($mailFrom, 'Logo Artz')->subject('Logo Artz -Assigned Digitizing Quote');
                    if (!empty($attachFiles)) {
                        foreach ($attachFiles as $attachmentPath) {
                            if (file_exists($attachmentPath)) {
                                $message->attach($attachmentPath);
                            }
                        }
                    }
                }
            );

            if (\Mail::failures()) {


                $mailFrom = 'technical-team@logoartz.com';
                \Mail::send(
                    'includes.emails.digi_designer',
                    [
                        "DesignerName" => $D_data->DesignerName,
                        "OrderType" => 'Digitizing ' . $type,
                        "OrderStatus" => 1,
                        "DesignName" => $order->DesignName,
                        "RequriedFormat" => $order->ReqFormat,
                        "FABRIC" => $order->Fabric,
                        "PLACEMENT" => $order->Placement,
                        "Width" => $order->Width,
                        "Height" => $order->Height,
                        "Scale" => $order->Scale,
                        "NumClr" => $order->NoOfColors,
                        "Fbrclr" => $order->FabricColor,
                        "Adminmsg" => \Input::get('MessageForDesigner')
                    ],
                    function ($message) use ($mailFrom, $designerEmail, $attachFiles) {
                        $message->to($designerEmail)->from($mailFrom, 'Logo Artz')->subject('Logo Artz -Assigned Digitizing Quote');
                        if (!empty($attachFiles)) {
                            foreach ($attachFiles as $attachmentPath) {
                                if (file_exists($attachmentPath)) {
                                    $message->attach($attachmentPath);
                                }
                            }
                        }
                    }
                );
            }



            // dd($orderDetail); die;

            \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update($orderDetail);
            return redirect('admin/Norder-details/' . $OrderID)->with('success', 'Assigned to Designer Successfully');
        }
    }


    public function VecAssignSubmit($VectorOrderID)
    {

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
            $order = \DB::table('vector_order')->where('VectorOrderID', $VectorOrderID)->first();
            if ($order->OrderType == 0 || $order->OrderType == 3) {
                $status = 5;
            }
            if ($order->OrderType == 2) {
                $type = 2;
            }
            $orderDetail = [
                'DesignerID' => \Input::get('DesignerID'),
                'MessageForDesigner' => \Input::get('MessageForDesigner'),
                'IsRead' => $read,
                'AssignStatus' => 1,
                'Status' => $status,
                'DateModified' => new \DateTime
            ];
            $DesignerID = \Input::get('DesignerID');
            $D_data = DB::table('designers')->select('DesignerName', 'Email')->where('DesignerID', $DesignerID)->first();
            \DB::table('vector_order')->where('VectorOrderID', $VectorOrderID)->update($orderDetail);
            $this->data['designer_email'] = $D_data->Email;
            $designerEmail = $D_data->Email;


            $path = public_path('uploads') . '/orders/digi/';

            $attachFiles[] = $path . $order->File1;
            $attachFiles[] = $path . $order->File2;
            $attachFiles[] = $path . $order->File3;
            $attachFiles[] = $path . $order->File4;

            if ($order->OrderType == 2 || $order->OrderType == 4) {
                $type = "Quote";
                $mailFrom = 'technical-team@logoartz.com';
                \Mail::send(
                    'includes.emails.vec_designer',
                    [
                        "DesignerName" => $D_data->DesignerName,
                        "OrderType" => 'Vector ' . $type,
                        "OrderStatus" => 1,
                        "DesignName" => $order->DesignName,
                        "RequriedFormat" => $order->ReqFormat,
                        "Vecuse" => $order->UsedFor,
                        "Width" => $order->Width,
                        "Height" => $order->Height,
                        "Scale" => $order->Scale,
                        "Reqclr" => $order->ReqColor,
                        "NumClr" => $order->NoOfColors,
                        "Adminmsg" => \Input::get('MessageForDesigner')
                    ],
                    function ($message) use ($mailFrom, $designerEmail) {
                        $message->to($designerEmail)->from($mailFrom, 'Logo Artz')->subject('Logo Artz -Assigned Vector Quote');
                    }
                );
            } else {
                $type = "Order";

                $mailFrom = 'technical-team@logoartz.com';
                \Mail::send(
                    'includes.emails.vec_designer',
                    [
                        "DesignerName" => $D_data->DesignerName,
                        "OrderType" => 'Vector ' . $type,
                        "OrderStatus" => 1,
                        "DesignName" => $order->DesignName,
                        "RequriedFormat" => $order->ReqFormat,
                        "Vecuse" => $order->UsedFor,
                        "Width" => $order->Width,
                        "Height" => $order->Height,
                        "Scale" => $order->Scale,
                        "Reqclr" => $order->ReqColor,
                        "NumClr" => $order->NoOfColors,
                        "Adminmsg" => \Input::get('MessageForDesigner')
                    ],
                    function ($message) use ($mailFrom, $designerEmail) {
                        $message->to($designerEmail)->from($mailFrom, 'Logo Artz')->subject('Logo Artz -Assigned Vector Order');
                    }
                );
            }

            return redirect('admin/Vec_order-details/' . $VectorOrderID)->with('success', 'Assigned to Designer Successfully');
        }
    }

    public function RevOrders()
    {
        $this->data['recordsTotal'] = \App\Customers::count();

        return view('admin.summary.RevOrders', $this->data);
    }

    public function NewQuotes()
    {
        $this->data['recordsTotal'] = \App\Customers::count();

        return view('admin.summary.NewQuotes', $this->data);
    }

    public function QuteRev()
    {
        $this->data['recordsTotal'] = \App\Customers::count();

        return view('admin.summary.QuteRev', $this->data);
    }

    public function ExtraTime()
    {
        $this->data['recordsTotal'] = \App\Customers::count();

        return view('admin.summary.index', $this->data);
    }

    public function customers_list()
    {
        $start = (Input::has('start') ? (int) Input::get('start') : 0);
        $length = (Input::has('length') ? (int) Input::get('length') : 25);

        $columns = ["", "CustomerID", "CustomerName", "Cell", "Email", "Status", "DateAdded", "DateModified"];

        $query = \App\Customers::select([
            'CustomerID',
            'CustomerName',
            'Cell',
            'Email',
            DB::raw("CONCAT('<small class=\"label bg-', IF(Status = 0, 'red', 'green'), '\" ><i class=\"fa ', IF(Status = 0, 'fa-times', 'fa-check'), '\"></i> ', IF(Status = 1, 'Active', 'Deactive'), '</small>') AS Status"),
            DB::raw("DATE_FORMAT(DateAdded, \"%d-%b-%Y<br>%r\") as DateAdded"),
            DB::raw("DATE_FORMAT(DateModified, \"%d-%b-%Y<br>%r\") as DateModified")
        ]);

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

    public function countries_dd()
    {
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

    public function add()
    {
        $this->data['countries_dd'] = $this->countries_dd();
        return view('admin.customers.add', $this->data);
    }

    public function save()
    {

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

    public function edit($id)
    {
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

    public function update($id)
    {

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

    public function delete()
    {
        if (count(\Input::get('ids')) > 0) {
            DB::table('customers')
                ->whereIn('CustomerID', \Input::get('ids'))
                ->delete();
        }
        return redirect('admin/customers')->with('success', "Selected Customer Deleted Successfully");
    }

    function VecSendQuote($VectorOrderID)
    {

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

            if (Input::has('FileForCustomer') && is_array(Input::get('FileForCustomer')) && count(Input::get('FileForCustomer')) > 0) {

                $isRevisionSet = DB::table('vector_result_files')->select(DB::raw('MAX(RevisionSet) as RevisionSet'))
                    ->where('VectorOrderID', $VectorOrderID)
                    ->first();
                if (!empty($isRevisionSet)) {
                    $myVar = $isRevisionSet->RevisionSet;
                    $myVar++;
                } else {
                    $myVar = 0;
                }


                \DB::table('vector_result_files')->whereIn('VR_File_ID', Input::get('FileForCustomer'))
                    ->update([
                        'ForCustomer' => 1,
                        'RevisionSet' => $myVar
                    ]);
            }
        }



        $types = Config('order_types');
        $query = \App\vector_order::where('VectorOrderID', $VectorOrderID)
            ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
            ->first();



        $CustomerName = $query->CustomerName;
        $Price = \Input::get('CustomerPrice');
        $timeLine = \Input::get('Timeline');
        $OrderType = $query->OrderType;
        $designName = $query->DesignName;
        $this->data['mail'] = $query->Email;

        \DB::table('vector_order')->where('VectorOrderID', $VectorOrderID)->update(['CustomerPrice' => \Input::get('CustomerPrice'), 'Status' => 3, 'IsRead' => 2]);

        if ($OrderType == 2) {

            // Vec Quote Email 

            $mailFrom = 'technical-team@logoartz.com';
            \Mail::send(
                'includes.emails.quoteready',
                [
                    "CustomerName" => $CustomerName,
                    "OrderType" => 'vector quote',
                    "timeFrame" => $timeLine,
                    "designName" => $designName,
                    "Price"    =>   $Price
                ],
                function ($message) use ($mailFrom) {
                    $message->to($this->data['mail'])->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Vector Quote Ready');
                }
            );
        } else {

            // Vec Quote Revision
            $mailFrom = 'technical-team@logoartz.com';
            \Mail::send(
                'includes.emails.quoteready',
                [
                    "CustomerName" => $CustomerName,
                    "OrderType" => 'vector quote revision',
                    "timeFrame" => $timeLine,
                    "designName" => $designName,
                    "Price"    =>   $Price
                ],
                function ($message) use ($mailFrom) {
                    $message->to($this->data['mail'])->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Vector Quote Revision Ready');
                }
            );
        }








        return redirect('admin/Vec_order-details/' . $VectorOrderID)->with('success', 'Quote Sent To Customer Successfully');
    }

    function SendQuote($OrderID)
    {
        // Line 1305 for Order 


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


            if (Input::has('FileForCustomer') && is_array(Input::get('FileForCustomer')) && count(Input::get('FileForCustomer')) > 0) {

                $isRevisionSet = DB::table('digi_result_files')->select(DB::raw('MAX(RevisionSet) as RevisionSet'))
                    ->where('OrderID', $OrderID)
                    ->first();
                if (!empty($isRevisionSet)) {
                    $myVar = $isRevisionSet->RevisionSet;
                    $myVar++;
                } else {
                    $myVar = 0;
                }


                \DB::table('digi_result_files')->whereIn('DR_File_ID', Input::get('FileForCustomer'))
                    ->update([
                        'ForCustomer' => 1,
                        'RevisionSet' => $myVar
                    ]);
            }
        }

        $types = Config('order_types');
        $query = \App\DigiOrders::where('OrderID', $OrderID)
            ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
            ->first();


        $CustomerName = $query->CustomerName;
        $Price = \Input::get('CustomerPrice');
        $timeLine = \Input::get('Timeline');
        $OrderType = $query->OrderType;
        $designName = $query->DesignName;
        $this->data['mail'] = $query->Email;


        \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update(['CustomerPrice' => \Input::get('CustomerPrice'), 'Status' => 3, 'IsRead' => 2]);


        if ($OrderType == 2) {

            // Digi Quote Email 

            $mailFrom = 'technical-team@logoartz.com';
            \Mail::send(
                'includes.emails.quoteready',
                [
                    "CustomerName" => $CustomerName,
                    "OrderType" => 'digitizing quote',
                    "timeFrame" => $timeLine,
                    "designName" => $designName,
                    "Price"    =>   $Price
                ],
                function ($message) use ($mailFrom) {
                    $message->to($this->data['mail'])->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Digitizing Quote Ready');
                }
            );
        } else {

            // Digi Quote Revision

            $mailFrom = 'technical-team@logoartz.com';
            \Mail::send(
                'includes.emails.quoteready',
                [
                    "CustomerName" => $CustomerName,
                    "OrderType" => 'digitizing quote revision',
                    "timeFrame" => $timeLine,
                    "designName" => $designName,
                    "Price"    =>   $Price
                ],
                function ($message) use ($mailFrom) {
                    $message->to($this->data['mail'])->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Digitizing Quote Revision Ready');
                }
            );
        }

        // \Mail::send(['html' => 'mail'], ['name' => 'Logo Artz', 'user' => $query->CustomerName, 'design' => 'Digitizing Design', 'type' => $types[$query->OrderType], 'amount' => \Input::get('CustomerPrice')], function ($message) use ($query) {
        //     $message->to($query->Email)->subject('Quote Confirmation');
        //     $message->from('technical-team@logoartz.com', 'Logo Artz');
        // });


        return redirect('admin/Norder-details/' . $OrderID)->with('success', 'Quote Sent To Customer Successfully');
    }


    function new_vector_quote($quotestatus)
    {
        $this->data['VectorOrders'] = \App\vector_order::select('VectorOrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'vector_order.Status', 'OrderType', 'IsRead')
            ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
            ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
            ->where('vector_order.Status', $quotestatus)
            ->get();
        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');

        return view('admin.summary.VectorOrders', $this->data);
    }

    function new_digi_quote($quotestatus)
    {
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

    public function search_order()
    {


        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');

        // echo '<pre>'.print_r(Input::all(), 1).'</pre>'; die;

        $OrderNo = 0;
        $QuoteNo = 0;
        $PoNumber = 0;
        $mCustomerName = "";
        $CustomerEmail = "";
        $CusPhone = "";
        $DesignName = "";

        if (Input::has('OrderNum') && (int) Input::get('OrderNum') != 0) {
            $OrderNo = (int) Input::get('OrderNum');
        }
        if (Input::has('quote_num') && (int) Input::get('quote_num') != 0) {
            $QuoteNo = (int) Input::get('quote_num');
        }
        if (Input::has('PoNum') && (int) Input::get('PoNum') != 0) {
            $PoNumber = (int) Input::get('PoNum');
        }
        if (Input::has('design_name') && Input::get('design_name') != "") {
            $DesignName = Input::get('design_name');
        }
        if (Input::has('Customer_Name') && Input::get('Customer_Name') != '') {
            $mCustomerName = trim(Input::get('Customer_Name'));
        }
        if (Input::has('phone_num') && Input::get('phone_num') != '') {
            $CusPhone = trim(Input::get('phone_num'));
        }
        if (Input::has('Cus_email') && Input::get('Cus_email') != '') {
            $CustomerEmail = trim(Input::get('Cus_email'));
        }




        $OrderSearchResult = [];

        if ($mCustomerName != "") {
            $CustomerIDs = DB::table('customers')->select('CustomerID')->whereRaw('CustomerName LIKE "%' . $mCustomerName . '%"')->get();
        }
        if ($CustomerEmail !=  "") {
            $CustomerIDs = DB::table('customers')->select('CustomerID')->whereRaw('Email LIKE "%' . $CustomerEmail . '%"')->get();
        }
        if ($CusPhone !=  "") {
            $CustomerIDs = DB::table('customers')->select('CustomerID')->whereRaw('Cell LIKE "%' . $CusPhone . '%"')->get();
        }

        $CompleteResult = [];

        // digitizing_search
        $Digitizing = DB::table('digitizing_orders')
            ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
            ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID');
        if ($OrderNo != 0) {
            $Digitizing->where('OrderID', $OrderNo);
        }
        if ($QuoteNo != 0) {
            $Digitizing->where('OrderID', $QuoteNo);
        }
        if ($PoNumber != 0) {
            $Digitizing->where('PONumber', $PoNumber);
        }
        if ($DesignName != "") {
            $Digitizing->where('DesignName', 'LIKE', '%' . $DesignName . '%');
        }
        if ($mCustomerName != "" || $CustomerEmail != "" || $CusPhone != "" && !empty($CustomerIDs)) {
            $CustIDs = [];
            foreach ($CustomerIDs as $cIds) {
                array_push($CustIDs, $cIds->CustomerID);
            }
            $Digitizing->whereIn('digitizing_orders.CustomerID', $CustIDs);
        }
        $DigitizingResult = $Digitizing->get();

        if (!empty($DigitizingResult)) {
            foreach ($DigitizingResult as $digitRes) {
                $CompleteResult[] = [
                    'OrderID' => $digitRes->OrderID,
                    'OrderRef' => 'Digitizing',
                    'OrderDetailLink' => url('admin/Norder-details/' . $digitRes->OrderID),
                    'PONumber' => $digitRes->PONumber,
                    'DesignName' => $digitRes->DesignName,
                    'CustomerName' => $digitRes->CustomerName,
                    'DesignerName' => $digitRes->DesignerName,
                    'OrderType' => $digitRes->OrderType,
                    'Status' => $digitRes->Status,
                    'CusId' => $digitRes->CustomerID,
                    'Type' => 'digitizing'

                ];
            }
        }

        // digitizing_search
        $Vector = DB::table('vector_order')
            ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
            ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID');
        if ($OrderNo != 0) {
            $Vector->where('VectorOrderID', $OrderNo);
        }
        if ($QuoteNo != 0) {
            $Vector->where('VectorOrderID', $QuoteNo);
        }
        if ($PoNumber != 0) {
            $Vector->where('PONumber', $PoNumber);
        }
        if ($DesignName != "") {
            $Vector->where('DesignName', 'LIKE', '%' . $DesignName . '%');
        }
        if ($mCustomerName != "" || $CustomerEmail != "" || $CusPhone != ""  && !empty($CustomerIDs)) {
            $CustIDs = [];
            foreach ($CustomerIDs as $cIds) {
                array_push($CustIDs, $cIds->CustomerID);
            }
            $Vector->whereIn('vector_order.CustomerID', $CustIDs);
        }
        $VectorResult = $Vector->get();

        if (!empty($VectorResult)) {
            foreach ($VectorResult as $vectRes) {
                $CompleteResult[] = [
                    'OrderID' => $vectRes->VectorOrderID,
                    'OrderRef' => 'Vector',
                    'OrderDetailLink' => url('admin/Vec_order-details/' . $vectRes->VectorOrderID),
                    'PONumber' => $vectRes->PONumber,
                    'DesignName' => $vectRes->DesignName,
                    'CustomerName' => $vectRes->CustomerName,
                    'DesignerName' => $vectRes->DesignerName,
                    'OrderType' => $vectRes->OrderType,
                    'Status' => $vectRes->Status,
                    'CusId' => $digitRes->CustomerID,
                    'Type' => 'vector'
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
            return view('amndmin.summary.VectorOrders', $this->data);
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
            print_r($this->data['DigiOrders']);
            die;
            return view('admin.summary.NewOrders', $this->data);
        }




        die;





        ////// O L  D      C H E E E R A    H O A     W O R K




        $this->data['OrderStatuses'] = Config('order_statuses');
        $this->data['OrderTypes'] = Config('order_types');

        // echo '<pre>'.print_r(Input::all(), 1).'</pre>'; die;


        $OrderNo = 0;
        $QuoteNo = 0;
        $PoNumber = 0;
        $PhoneNo = 0;
        $mCustomerName = "";
        $CustomerEmail = "";


        if (Input::has('OrderNum') && (int) Input::get('OrderNum') != 0) {
            $OrderNo = (int) Input::get('OrderNum');
        }
        if (Input::has('quote_num') && (int) Input::get('quote_num') != 0) {
            $QuoteNo = (int) Input::get('quote_num');
        }
        if (Input::has('PoNum') && (int) Input::get('PoNum') != 0) {
            $PoNumber = (int) Input::get('PoNum');
        }
        if (Input::has('phone_num') && Input::get('phone_num') != "") {
            $PhoneNo = (int) Input::get('phone_num');
        }
        if (Input::has('Customer_Name') && Input::get('Customer_Name') != "") {
            $mCustomerName = trim(Input::get('Customer_Name'));
        }
        if (Input::has('Cus_email') && Input::get('Cus_email') != "") {
            $CustomerEmail = trim(Input::get('Customer_Name'));
        }

        // echo $CustomerEmail.'<br>'.$mCustomerName.'<br>'. $PhoneNo; die;

        $OrderSearchResult = [];

        if ($mCustomerName != "") {
            $CustomerIDs = DB::table('customers')->select('CustomerID')->whereRaw('CustomerName LIKE "%' . $mCustomerName . '%"')->get();
        }
        if ($CustomerEmail != "") {
            $CustomerIDs = DB::table('customers')->select('CustomerID')->whereRaw('Email LIKE "%' . $CustomerEmail . '%"')->get();
        }
        if ($PhoneNo != "") {
            $CustomerIDs = DB::table('customers')->select('CustomerID')->whereRaw('Cell LIKE "%' . $PhoneNo . '%"')->get();
        }


        $CompleteResult = [];

        // digitizing_search
        $Digitizing = DB::table('digitizing_orders')
            ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
            ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID');
        if ($OrderNo != 0) {
            $Digitizing->where('OrderID', $OrderNo);
        }
        if ($QuoteNo != 0) {
            $Digitizing->where('OrderID', $QuoteNo);
        }
        if ($PoNumber != 0) {
            $Digitizing->where('PONumber', $PoNumber);
        }
        if ($CustomerEmail != "") {
            $Digitizing->where('Email', $CustomerEmail);
        }
        if ($mCustomerName != "") {
            $Digitizing->where('CustomerName', $mCustomerName);
        }
        if ($PhoneNo != 0) {
            $Digitizing->where('Cell', $PhoneNo);
        }


        if (!empty($CustomerIDs)) {
            $CustIDs = [];
            foreach ($CustomerIDs as $cIds) {
                array_push($CustIDs, $cIds->CustomerID);
            }
            $Digitizing->whereIn('digitizing_orders.CustomerID', $CustIDs);
        }
        $DigitizingResult = $Digitizing->get();

        if (!empty($DigitizingResult)) {
            foreach ($DigitizingResult as $digitRes) {
                $CompleteResult[] = [
                    'OrderID' => $digitRes->OrderID,
                    'OrderRef' => 'Digitizing',
                    'OrderDetailLink' => url('admin/Norder-details/' . $digitRes->OrderID),
                    'PONumber' => $digitRes->PONumber,
                    'DesignName' => $digitRes->DesignName,
                    'CustomerName' => $digitRes->CustomerName,
                    'DesignerName' => $digitRes->DesignerName,
                    'OrderType' => $digitRes->OrderType,
                ];
            }
        }
        $this->data['SearchResult'] = $CompleteResult;

        return view('admin.summary.SearchDetail', $this->data);


        // Vector_search
        $Vector = DB::table('vector_order')
            ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
            ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID');
        if ($OrderNo != 0) {
            $Vector->where('VectorOrderID', $OrderNo);
        }
        if ($PoNumber != 0) {
            $Vector->where('PONumber', $PoNumber);
        }
        if ($mCustomerName != "" && !empty($CustomerIDs)) {
            $CustIDs = [];
            foreach ($CustomerIDs as $cIds) {
                array_push($CustIDs, $cIds->CustomerID);
            }
            $Vector->whereIn('vector_order.CustomerID', $CustIDs);
        }
        $VectorResult = $Vector->get();

        if (!empty($VectorResult)) {
            foreach ($VectorResult as $vectRes) {
                $CompleteResult[] = [
                    'OrderID' => $vectRes->VectorOrderID,
                    'OrderRef' => 'Vector',
                    'OrderDetailLink' => url('admin/Vec_order-details/' . $vectRes->VectorOrderID),
                    'PONumber' => $vectRes->PONumber,
                    'DesignName' => $vectRes->DesignName,
                    'CustomerName' => $vectRes->CustomerName,
                    'DesignerName' => $vectRes->DesignerName,
                    'OrderType' => $vectRes->OrderType,
                ];
            }
        }



        $this->data['SearchResult'] = $CompleteResult;

        // echo '<pre>'.print_r($CompleteResult, 1).'</pre>'; die;


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
            print_r($this->data['DigiOrders']);
            die;
            return view('admin.summary.NewOrders', $this->data);
        }
    }

    public function approve_vector_design($VectorOrderID)
    {
        \DB::table('vector_order')->where('VectorOrderID', $VectorOrderID)->update(['Status' => 5, 'OrderType' => 0, 'IsRead' => 1]);

        return redirect()->back()->with(['success' => "Approved to Designer Successfully"]);
    }

    public function approve_digi_design($OrderID)
    {
        \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update(['Status' => 5, 'OrderType' => 0, 'IsRead' => 1]);

        return redirect()->back()->with(['success' => "Approved to Designer Successfully"]);
    }

    public function send_vector_design($VectorOrderID)
    {


        // Full Price
        $price = Input::get('OrderPrice');
        $fullnFinalPrice = Input::get('finalprice');



        // dd($price);
        $fprice = Input::get('OrderPrice');
        // Discount
        $discount = \Input::get('Discount');
        //Final Price After Discount 
        $finalprice = Input::get('finalprice');


        $SalesP = \Input::get('salesorp');
        $DesignP = \Input::get('designorp');
        $qty = \Input::get('qty');


        if ($DesignP = 0 || $qty = 0 || $SalesP = 0 || $discount = 0) {

            return redirect()->back()->with('warning_msg', 'All field cannot except 0 value, if do not charge this order please null text box please');
        }



        //   dd($qty);

        // $vecOrderDetail = \App\vector_order::where('VectorOrderID', $VectorOrderID)->first();

        // if($vecOrderDetail->OrderType != 1 || $vecOrderDetail->OrderType != 4 || $vecOrderDetail->OrderType !=  9){
        //     if($qty == ''){
        //         $qty = 1;    
        //     }
        // }


        //   if($qty != '' && $fullnFinalPrice == ""){
        //       return redirect()->back()->with('warning_msg', "If you are update quantity!! u also update price please");
        //     }


        // $vector = \App\vector_order::where('VectorOrderID', $VectorOrderID)->first();

        //   if($vector->OrderType == 1){
        //     if($price == ''){
        //         $fprice = $vector->PriceBeforeDiscount;
        //     }
        //      if($discount == ''){
        //         $discount = $vector->Discount;
        //     }
        //      if($fullnFinalPrice == ''){
        //         $fullnFinalPrice = $vector->CustomerPrice;
        //         if($fullnFinalPrice == ''){
        //              $fullnFinalPrice = $vector->Price;
        //               }
        //     }

        //      if($qty == ''){
        //         $qty = $vector->Quantity;
        //     }
        //      if($DesignP == ''){
        //         $DesignP = $vector->DesignerPrice;
        //     }
        //     if($SalesP == ''){
        //         $SalesP = $vector->SalesPrice;
        //     }

        //   }
        $accounts = [
            'PriceBeforeDiscount' => $fprice,
            'Discount' => $discount,
            'CustomerPrice' => $fullnFinalPrice,
            'Price' =>  $fullnFinalPrice,
            'Quantity' => $qty,
            'DesignerPrice' => $DesignP,
            'SalesPrice' => $SalesP,
            'DateModified' => new \DateTime()
        ];



        if (!empty($price)) {
            \App\vector_order::where('VectorOrderID', $VectorOrderID)->update($accounts);
        }

        \App\vector_order::where('VectorOrderID', $VectorOrderID)->update(['Status' => 7, 'MessageForCustomer' => Input::get('MessageForCustomer'), 'IsRead' => 2]);

        if (Input::has('FileForCustomer') && is_array(Input::get('FileForCustomer')) && count(Input::get('FileForCustomer')) > 0) {
            \DB::table('vector_result_files')->whereIn('VR_File_ID', Input::get('FileForCustomer'))->update(['ForCustomer' => 1]);
        }

        $isRevisionSet = DB::table('vector_result_files')->select(DB::raw('MAX(RevisionSet) as RevisionSet'))
            ->where('VectorOrderID', $VectorOrderID)
            ->first();
        if (!empty($isRevisionSet)) {
            $myVar = $isRevisionSet->RevisionSet;
            $myVar++;
        } else {
            $myVar = 0;
        }


        \DB::table('vector_result_files')->whereIn('VR_File_ID', Input::get('FileForCustomer'))->update(['ForCustomer' => 1, 'RevisionSet' => $myVar]);



        $query = \App\vector_order::where('VectorOrderID', $VectorOrderID)
            ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
            ->first();

        // \Mail::send(['html' => 'send_design_mail'], ['name' => 'Logo Artz', 'user' => $query->CustomerName, 'design' => 'Vector Design'], function ($message) use ($query) {
        //     $message->to($query->Email)->subject('Information');
        //     $message->from('technical-team@logoartz.com', 'Logo Artz');
        // });



        $CustomerName = $query->CustomerName;
        $this->data['mail'] = $query->Email;
        $OrderType = $query->OrderType;
        $designName = $query->DesignName;

        if (Input::get('OrderType') != '') {
            $query->OrderType = Input::get('OrderType');
            $query->save();
        }

        // Email ALert For Customer
        if ($OrderType != "") {
            $ccMail = null;
            if (Input::get('CCOrder') != '') {
                $ccMail = Input::get('CCOrder');
            }

            if ($OrderType == 1) {
                // Order Revision Email

                // Email For Order Revision
                $mailFrom = 'technical-team@logoartz.com';
                \Mail::send(
                    'includes.emails.orderready',
                    [
                        "CustomerName" => $CustomerName,
                        "OrderType" => 'vector revision',
                        "designName" => $designName
                    ],
                    function ($message) use ($mailFrom, $ccMail) {
                        $message->to([$this->data['mail'], 'info@logoartz.com'])->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Order Revision Complete');
                        if ($ccMail != null) {
                            $message->cc($ccMail);
                        }
                    }
                );
            } elseif ($OrderType == 9) {
                // Free Order Revision Email 

                // Email For Order Revision
                $mailFrom = 'technical-team@logoartz.com';
                \Mail::send(
                    'includes.emails.freeorderready',
                    [
                        "CustomerName" => $CustomerName,
                        "OrderType" => 'vector revision',
                        "designName" => $designName
                    ],
                    function ($message) use ($mailFrom, $ccMail) {
                        $message->to([$this->data['mail'], 'info@logoartz.com'])->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Logo Artz -Free Order Revision Ready');
                        if ($ccMail != null) {
                            $message->cc($ccMail);
                        }
                    }
                );
                //     



            } elseif ($OrderType == 3) {
                // Free Order Email

                // Email For Order Revision
                $mailFrom = 'technical-team@logoartz.com';
                \Mail::send(
                    'includes.emails.freeorderready',
                    [
                        "CustomerName" => $CustomerName,
                        "OrderType" => 'vector order',
                        "designName" => $designName
                    ],
                    function ($message) use ($mailFrom, $ccMail) {
                        $message->to([$this->data['mail'], 'info@logoartz.com'])->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Free Order Ready');

                        if ($ccMail != null) {
                            $message->cc($ccMail);
                        }
                    }
                );
            } else {

                // Normal Order Email  

                $mailFrom = 'technical-team@logoartz.com';
                \Mail::send(
                    'includes.emails.orderready',
                    [
                        "CustomerName" => $CustomerName,
                        "OrderType" => 'vector order',
                        "designName" => $designName
                    ],
                    function ($message) use ($mailFrom, $ccMail) {
                        $message->to([$this->data['mail'], 'info@logoartz.com'])->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Order Complete');
                        if ($ccMail != null) {
                            $message->cc($ccMail);
                        }
                    }
                );
            }
        }





        return redirect('admin/Vec_order-details/' . $VectorOrderID)->with('success', 'Order Sent To Customer Successfully');
    }

    public function send_digi_design($OrderID)
    {
        // O R D E R 

        //2419 Vector

        //dd(Input::all());

        // Full Price
        $price = Input::get('OrderPrice');
        $fullnFinalPrice = Input::get('finalprice');

        // dd($price);
        $fprice = Input::get('OrderPrice');
        // Discount
        $discount = \Input::get('Discount');
        //Final Price After Discount 
        $finalprice = Input::get('finalprice');


        $SalesP = \Input::get('salesorp');
        $DesignP = \Input::get('designorp');
        $qty = \Input::get('qty');

        // if($finalprice == "" || $discount == ""){
        //      $price =  $price;
        // }

        // if($finalprice != "" || $discount == ""){
        //      $calDiscount = $price - $finalprice;
        //      $discount = $calDiscount;
        //      $price = $finalprice;

        // }

        //   if($qty > 1){
        //        $price = $price * $qty;     
        //     }

        $accounts = [
            'PriceBeforeDiscount' => $fprice,
            'Discount' => $discount,
            'CustomerPrice' => $fullnFinalPrice,
            'Price' =>  $fullnFinalPrice,
            'Quantity' => $qty,
            'DateModified' => new \DateTime()
        ];

        if (!empty($price)) {
            \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update($accounts);
        }

        \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update(['Status' => 7, 'MessageForCustomer' => Input::get('MessageForCustomer'), 'IsRead' => 2]);

        if (Input::has('FileForCustomer') && is_array(Input::get('FileForCustomer')) && count(Input::get('FileForCustomer')) > 0) {

            $isRevisionSet = DB::table('digi_result_files')->select(DB::raw('MAX(RevisionSet) as RevisionSet'))
                ->where('OrderID', $OrderID)
                ->first();
            if (!empty($isRevisionSet)) {
                $myVar = $isRevisionSet->RevisionSet;
                $myVar++;
            } else {
                $myVar = 0;
            }

            // if (!empty($price)) {
            //     \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update(['CustomerPrice' => $price,
            //      'Price' => $price]);
            // }


            if (!empty($SalesP)) {
                \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update(['SalesPrice' => $SalesP]);
            }
            if (!empty($DesignP)) {
                \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update(['DesignerPrice' => $DesignP]);
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


        $CustomerName = $query->CustomerName;
        $designName = $query->DesignName;
        $OrderType = $query->OrderType;
        $this->data['mail'] = $query->Email;


        if (Input::get('OrderType') != '') {
            $query->OrderType = Input::get('OrderType');
            $query->save();
        }

        // Email ALert For Customer
        if (isset($OrderType)) {

            $ccMail = null;

            if ($OrderType == 1) {
                // Order Revision Email

                if (Input::get('CCOrder') != '') {
                    $ccMail = Input::get('CCOrder');
                }

                $mailFrom = 'technical-team@logoartz.com';
                \Mail::send(
                    'includes.emails.orderready',
                    [
                        "CustomerName" => $CustomerName,
                        "OrderType" => 'digitizing revision',
                        "designName" => $designName
                    ],
                    function ($message) use ($mailFrom, $ccMail) {
                        $message->to([$this->data['mail'], 'info@logoartz.com'])->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Order Revision Complete');
                        if ($ccMail != null) {
                            $message->cc($ccMail);
                        }
                    }
                );


                if (\Mail::failures()) {

                    $mailFrom = 'technical-team@logoartz.com';
                    \Mail::send(
                        'includes.emails.orderready',
                        [
                            "CustomerName" => $CustomerName,
                            "OrderType" => 'digitizing revision',
                            "designName" => $designName
                        ],
                        function ($message) use ($mailFrom, $ccMail) {
                            $message->to([$this->data['mail'], 'info@logoartz.com'])->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Order Revision Complete');
                            if ($ccMail != null) {
                                $message->cc($ccMail);
                            }
                        }
                    );
                }
            } elseif ($OrderType == 9) {
                // Free Order Revision Email 

                $mailFrom = 'technical-team@logoartz.com';
                \Mail::send(
                    'includes.emails.freeorderready',
                    [
                        "CustomerName" => $CustomerName,
                        "OrderType" => 'digitizing revision',
                        "designName" => $designName
                    ],
                    function ($message) use ($mailFrom, $ccMail) {
                        $message->to([$this->data['mail'], 'info@logoartz.com'])->from($mailFrom, 'Logo Artz')->subject('Logo Artz -Free Order Revision Ready');
                        if ($ccMail != null) {
                            $message->cc($ccMail);
                        }
                    }
                );

                if (\Mail::failures()) {

                    $mailFrom = 'technical-team@logoartz.com';
                    \Mail::send(
                        'includes.emails.freeorderready',
                        [
                            "CustomerName" => $CustomerName,
                            "OrderType" => 'digitizing revision',
                            "designName" => $designName
                        ],
                        function ($message) use ($mailFrom, $ccMail) {
                            $message->to([$this->data['mail'], 'info@logoartz.com'])->from($mailFrom, 'Logo Artz')->subject('Logo Artz -Free Order Revision Ready');
                            if ($ccMail != null) {
                                $message->cc($ccMail);
                            }
                        }
                    );
                }
            } elseif ($OrderType == 3) {
                // Free Order Email

                $mailFrom = 'technical-team@logoartz.com';
                \Mail::send(
                    'includes.emails.freeorderready',
                    [
                        "CustomerName" => $CustomerName,
                        "OrderType" => 'digitizing order',
                        "designName" => $designName
                    ],
                    function ($message) use ($mailFrom, $ccMail) {
                        $message->to([$this->data['mail'], 'info@logoartz.com'])->from($mailFrom, 'Logo Artz')->subject('Logo Artz -Free Order Ready');
                        if ($ccMail != null) {
                            $message->cc($ccMail);
                        }
                    }
                );


                if (\Mail::failures()) {

                    $mailFrom = 'technical-team@logoartz.com';
                    \Mail::send(
                        'includes.emails.freeorderready',
                        [
                            "CustomerName" => $CustomerName,
                            "OrderType" => 'digitizing order',
                            "designName" => $designName
                        ],
                        function ($message) use ($mailFrom, $ccMail) {
                            $message->to([$this->data['mail'], 'info@logoartz.com'])->from($mailFrom, 'Logo Artz')->subject('Logo Artz -Free Order Ready');
                            if ($ccMail != null) {
                                $message->cc($ccMail);
                            }
                        }
                    );
                }
            } else {

                // Normal Order Email  
                $mailFrom = 'technical-team@logoartz.com';
                \Mail::send(
                    'includes.emails.orderready',
                    [
                        "CustomerName" => $CustomerName,
                        "OrderType" => 'digitizing order',
                        "designName" => $designName
                    ],
                    function ($message) use ($mailFrom, $ccMail) {
                        $message->to([$this->data['mail'], 'info@logoartz.com'])->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Order Complete');
                        if ($ccMail != null) {
                            $message->cc($ccMail);
                        }
                    }
                );



                if (\Mail::failures()) {

                    $mailFrom = 'technical-team@logoartz.com';
                    \Mail::send(
                        'includes.emails.orderready',
                        [
                            "CustomerName" => $CustomerName,
                            "OrderType" => 'digitizing order',
                            "designName" => $designName
                        ],
                        function ($message) use ($mailFrom, $ccMail) {
                            $message->to([$this->data['mail'], 'info@logoartz.com'])->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Order Complete');
                            if ($ccMail != null) {
                                $message->cc($ccMail);
                            }
                        }
                    );
                }
            }
        }



        return redirect('admin/Norder-details/' . $OrderID)->with('success', 'Order Sent To Customer Successfully');
    }

    public function order_revision($VectorOrderID)
    {

        $valid["DesignerID"] = 'required|integer|min:1';
        $valid["MessageForDesigner"] = 'required';
        $valid_name["MessageForDesigner"] = "Message For Designer";
        $valid_name["DesignerID"] = "Designer";
        $messages = [
            'required' => 'Please enter :attribute.',
            'DesignerID.min' => 'Please select :attribute.'
        ];
        $v = Validator::make(\Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {
            $type = 1;
            $status = 5;
            $order = \DB::table('vector_order')->where('VectorOrderID', $VectorOrderID)->first();
            if ($order->OrderType == 3 || $order->OrderType == 9 || $order->OrderType == 0) {
                $type = 9;
                $status = 10;
            }
            if ($order->OrderType == 1) {
                $status = 10;
            }

            \DB::table('vector_order')->where('VectorOrderID', $VectorOrderID)->update(['AssignStatus' => 1, 'DesignerID' => \Input::get('DesignerID'), 'Status' => $status, 'IsRead' => 1]);
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

    public function digi_order_revision($OrderID)
    {

        $valid["DesignerID"] = 'required|integer|min:1';
        $valid["MessageForDesigner"] = 'required';
        $valid_name["DesignerID"] = "Designer";
        $valid_name["MessageForDesigner"] = "Message For Designer";
        $messages = [
            'required' => 'Please enter :attribute.',
            'DesignerID.min' => 'Please select :attribute.'
        ];
        $v = Validator::make(\Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {
            $type = 1;
            $status = 5;
            $order = \DB::table('digitizing_orders')->where('OrderID', $OrderID)->first();
            if ($order->OrderType == 3 || $order->OrderType == 9 || $order->OrderType == 0) {
                $type = 9;
                $status = 10;
            }

            if ($order->OrderType == 1) {
                $status = 10;
            }

            \DB::table('digitizing_orders')->where('OrderID', $OrderID)->update(['AssignStatus' => 1, 'DesignerID' => \Input::get('DesignerID'), 'Status' => $status, 'IsRead' => 1]);
            // MessageForDesigner

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

    public function digi_order_revision_complete($OrderID)
    {

        $order = \DB::table('digitizing_orders')->where('OrderID', $OrderID)->first();
        if ($order->OrderType == 3 || $order->OrderType == 9 || $order->OrderType == 0) {
            $type = 9;
            $status = 10;
        }

        if ($order->OrderType == 1) {
            $status = 10;
        }

        // MessageForDesigner
        \DB::table('digitizing_orders')::where('OrderID', $OrderID)->update(['Status' => 7, 'MessageForCustomer' => Input::get('MessageForCustomer'), 'IsRead' => 2]);

        $data = [
            'OrderID' => $OrderID,
            'From' => 1,
            'To' => 2,
            'RevisionType' => 1,
            'Message' => \Input::get('MessageForCustomer'),
            'DateAdded' => new \DateTime()
        ];
        \DB::table('digi_revision')->insert($data);
        return redirect('admin/Norder-details/' . $OrderID)->with('success', 'Order Revision Sent To Designer Successfully');
    }

    public function quote_revision($vectorid)
    {

        $valid["Price"] = 'required';
        $messages = [
            'required' => 'Please enter :attribute.'
        ];
        $v = Validator::make(\Input::all(), $valid, $messages);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {
            \DB::table('vector_order')->where('VectorOrderID', $vectorid)->update(['CustomerPrice' => \Input::get('Price'), 'Status' => 3, 'OrderType' => 2, 'IsRead' => 2]);
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
        } else {
            // {       echo "Successfully"; die;
            //$this->data['getorderdata'] = 0;
            //$getorderdata = \DB::table('digitizing_orders')->where('OrderID', $orderid)->first();

            \DB::table('digitizing_orders')->where('OrderID', $orderid)->update(['OrderType' => \Input::get('Status'), 'IsRead' => 0]);
            return redirect('admin/dashboard');
        }
    }

    public function digi_quote_revision($orderid)
    {
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

    public function cus_acc_get()
    {
        $this->data['allcustomers'] = \DB::table('customers')->get();

        return view('admin.summary.accounts.cus_acc', $this->data);
    }

    public function get_all_cus_acc(Request $request)
    {
        $From = \Input::get('DateFrom');
        $To = \Input::get('DateTo');
        $getcusid = \Input::get('cusname');
        $this->data['CustomerID'] = $getcusid;

        $this->data['allcustomers'] = \DB::table('customers')->get();

        $this->data['DigiOrders'] = \App\DigiOrders::select('digitizing_orders.OrderID', 'CustomerName', 'DesignName', 'PONumber', 'Price', 'digitizing_orders.DateAdded', 'digitizing_orders.IsRead')
            ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
            ->whereBetween(DB::Raw('date(digitizing_orders.DateAdded)'), array($From, $To))
            ->whereIn('digitizing_orders.Status', [7, 8])
            ->when(($request->has('OrderNum') && $request->OrderNum != null), function ($query) use ($request) {
                return $query->where('OrderID', $request->OrderNum);
            })
            ->when(($request->has('design_name')  && $request->design_name != null), function ($query) use ($request) {
                return $query->where('DesignName', $request->design_name);
            })
            ->where('digitizing_orders.CustomerID', $getcusid)
            ->orderby('digitizing_orders.OrderID', 'desc')
            ->get();

        $this->data['VecOrders'] = \App\vector_order::select('vector_order.VectorOrderID', 'CustomerName', 'DesignName', 'PONumber', 'Price', 'vector_order.DateAdded', 'vector_order.IsRead')
            ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
            ->whereBetween(DB::Raw('date(vector_order.DateAdded)'), array($From, $To))
            ->whereIn('vector_order.Status', [7, 8])
            ->when(($request->has('OrderNum')  && $request->OrderNum != null), function ($query) use ($request) {
                return $query->where('VectorOrderID', $request->OrderNum);
            })
            ->when(($request->has('design_name')  && $request->design_name != null), function ($query) use ($request) {
                return $query->where('DesignName', $request->design_name);
            })
            ->where('vector_order.CustomerID', $getcusid)
            ->orderby('vector_order.VectorOrderID', 'desc')
            ->get();


        return view('admin.summary.accounts.cus_acc', $this->data);
    }

    public function generate_cus_inv()
    {
        // echo '<pre>'.print_r(Input::all(), 1).'</pre>'; die;

        $DPrices = 0;
        $VPrices = 0;

        $Prices=0;


        if (Input::has('DOrderIDs') || Input::has('VOrderIDs') && Input::has('CustomerID')) {
            $DOrderIds = \Input::get('DOrderIDs');
            $VOrderIds = \Input::get('VOrderIDs');
            $CustomerID = \Input::get('CustomerID');

            // echo '<pre>'.print_r($VOrderIds, 1).'</pre>'; die;

            $this->data['DOrderIDs'] = $DOrderIds;
            $this->data['VOrderIDs'] = $VOrderIds;
            $this->data['CustomerID'] = $CustomerID;


            $this->data['Customer'] = DB::table('customers')->where('CustomerID', $CustomerID)->first();

            if (empty($this->data['Customer'])) {
                return redirect('admin/digi/accounts')->with('warning_msg', "Invalid Customer");
            }


            if ($this->data['DOrderIDs'] != '') {

                $this->data['DigiOrders'] = \App\DigiOrders::whereIn('digitizing_orders.OrderID', $DOrderIds)
                    ->orderby('digitizing_orders.OrderID', 'desc')
                    ->get();
                $DOrdersData = $this->data['DigiOrders'];
            }

            if ($this->data['VOrderIDs'] != '') {

                $this->data['VecOrders'] = \App\vector_order::whereIn('vector_order.VectorOrderID', $VOrderIds)
                    ->orderby('vector_order.VectorOrderID', 'desc')
                    ->get();
                $VOrderData  = $this->data['VecOrders'];
            }


            if (!empty($this->data['DigiOrders'])) {

                foreach ($this->data['DigiOrders'] as $Price_str) {
                    $DPrices = $DPrices + $Price_str->Price;
                    //  echo $Price_str->Price.'<br>';
                }
            }

            if (!empty($this->data['VecOrders'])) {

                foreach ($this->data['VecOrders'] as $Price_str) {
                    $VPrices = $VPrices + $Price_str->Price;
                    //   echo $Price_str->Price.'<br>';
                }
            }


            // echo "Pricess:".'<br>';
            // echo 'Digi Price:'.$DPrices.'<br>';
            // echo 'Vector Price:'.$VPrices.'<br>';


            if ($DPrices >  0) {
                $Prices = $DPrices;
            }
            if ($VPrices >  0) {
                $Prices = $DPrices + $VPrices;
            }


            $this->data['TotalPrice'] = $Prices;

            $this->data['todaydate'] = date("d-m-Y");

            // $Due =  explode('-',  $this->data['todaydate']);
            // $Dueday = $Due[0] + 4;
            // $Duedate = $Dueday .'-'. $Due[1] .'-'. $Due[2];

            // $this->data['Duedate'] =  $Duedate;

            return view('admin.summary.accounts.cus_invoice', $this->data);
        } else {
            return redirect('admin/digi/accounts')->with('warning_msg', "Invalid Customer Or Order");
        }
    }







    public function digi_acc_get()
    {

        $this->data['allcustomers'] = \DB::table('customers')->get();

        return view('admin.summary.accounts.digi_acc', $this->data);
    }

    public function vec_acc_get()
    {
        $this->data['allcustomers'] = \DB::table('customers')->get();
        return view('admin.summary.accounts.vec_acc', $this->data);
    }

    public function get_all_dacc_req()
    {
        $From = \Input::get('DateFrom');
        $To = \Input::get('DateTo');
        $getcusid = \Input::get('cusname');
        $this->data['CustomerID'] = $getcusid;

        $this->data['allcustomers'] = \DB::table('customers')->get();
        $this->data['Orders'] = \App\DigiOrders::select('digitizing_orders.OrderID', 'CustomerName', 'DesignName', 'PONumber', 'Price', 'digitizing_orders.IsRead')
            ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
            ->whereRaw('digitizing_orders.DateAdded BETWEEN "' . $From . '" AND "' . $To . '"')
            ->whereIn('digitizing_orders.Status', [7, 8])
            ->where('digitizing_orders.CustomerID', $getcusid)
            ->orderby('digitizing_orders.OrderID', 'desc')
            ->get();

        return view('admin.summary.accounts.digi_acc', $this->data);
    }

    public function generate_digi_inv()
    {
        // echo '<pre>'.print_r(Input::all(), 1).'</pre>'; die;
        $this->data['type'] = 'Digitizing';

        if (Input::has('OrderIDs') && Input::has('CustomerID')) {
            $OrderIds = \Input::get('OrderIDs');
            $CustomerID = \Input::get('CustomerID');

            $this->data['OrderIDs'] = $OrderIds;
            $this->data['CustomerID'] = $CustomerID;

            // dd($OrderIds); die;

            $this->data['Customer'] = DB::table('customers')->where('CustomerID', $CustomerID)->first();

            if (empty($this->data['Customer'])) {
                return redirect('admin/digi/accounts')->with('warning_msg', "Invalid Customer");
            }

            $this->data['Orders'] = \App\DigiOrders::whereIn('digitizing_orders.OrderID', $OrderIds)
                ->orderby('digitizing_orders.OrderID', 'desc')
                ->get();

            $OrdersData = $this->data['Orders'];

            $Prices = 0;
            foreach ($OrdersData as $Price_str) {
                $Prices = $Prices + $Price_str->Price;
            }

            $this->data['TotalPrice'] = $Prices;

            $this->data['todaydate'] = date("d:m:Y");

            $Due =  explode(':',  $this->data['todaydate']);
            $Dueday = $Due[0] + 4;
            $Duedate = $Dueday . ':' . $Due[1] . ':' . $Due[2];

            $this->data['Duedate'] =  $Duedate;


            // $TodayDate = date('d-m-Y', strtotime($OrdersData->DateAdded));

            // dd($date); 

            //   echo $TodayDate; die; 




            return view('admin.summary.accounts.digi_invoice', $this->data);
        } else {
            return redirect('admin/digi/accounts')->with('warning_msg', "Invalid Customer Or Order");
        }
    }

    public function send_digi_inv()
    {
        //         echo '<pre>'.print_r(Input::all(), 1).'</pre>'; die;
        // echo public_path('').'/invoices/my_stored_file.pdf'; die;
        $this->data['type'] = 'Digitizing';

        if (Input::has('orderids') && Input::has('CustomerID')) {
            $OrderIds = \Input::get('orderids');
            $CustomerID = \Input::get('CustomerID');

            // dd($OrderIds); die;
            $this->data['CustomerID'] = $CustomerID;

            $this->data['Customer'] = DB::table('customers')->where('CustomerID', $CustomerID)->first();

            $CustomerData =  $this->data['Customer'];

            if (empty($this->data['Customer'])) {
                return redirect('admin/digi/accounts')->with('warning_msg', "Invalid Customer");
            }

            $this->data['Orders'] = \App\DigiOrders::whereIn('digitizing_orders.OrderID', $OrderIds)
                ->orderby('digitizing_orders.OrderID', 'desc')
                ->get();

            $OrdersData = $this->data['Orders'];
            $Prices = 0;
            foreach ($OrdersData as $Price_str) {
                $Prices = $Prices + $Price_str->Price;
            }

            $this->data['TotalPrice'] = $Prices;
            $this->data['todaydate'] = date("d:m:Y");

            $Due =  explode(':',  $this->data['todaydate']);
            $Dueday = $Due[0] + 4;
            $Duedate = $Dueday . ':' . $Due[1] . ':' . $Due[2];

            $this->data['Duedate'] =  $Duedate;



            $fileName = str_random(5) . '-' . $CustomerID . '-' . str_random(5) . '.pdf';

            $pdf = PDF::loadView('admin.summary.accounts.print_digi_invoice', $this->data)
                ->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
                ->save(public_path('') . '/invoices/' . $fileName);

            $ToEmail = 'CustomerEmailAddress';
            $From = 'accounts@logoartz.com';

            $ToEmail = $CustomerData->Email;

            \Mail::send('includes.emails.invoice', [
                "CustomerName" => 'Umer'
            ], function ($message) use ($ToEmail, $From, $fileName) {
                $message->to($ToEmail)
                    ->from($From, "LogoArtz Accounts Department")
                    ->subject("Invioce")
                    ->attach(public_path('') . '/invoices/' . $fileName, ['mime' => 'application/pdf']);
            });

            return redirect('admin/vector/accounts')->with('success', 'Send Invoice Successfully');

            //            return $pdf->download('invoice.pdf');
            //            return view('admin.summary.accounts.digi_invoice', $this->data);
        } else {
            return redirect('admin/digi/accounts')->with('warning_msg', "Invalid Customer Or Order");
        }
    }



    public function generate_vec_inv()
    {
        // echo '<pre>'.print_r(Input::all(), 1).'</pre>'; die;
        $this->data['type'] = 'Vector';

        $CustomerID = \Input::get('CustomerID');

        if (Input::has('OrderIDs') && Input::has('CustomerID')) {
            $OrderIds = \Input::get('OrderIDs');
            $CustomerID = \Input::get('CustomerID');

            $this->data['OrderIDs'] = $OrderIds;
            $this->data['CustomerID'] = $CustomerID;

            // dd($OrderIds); die;

            $this->data['Customer'] = DB::table('customers')->where('CustomerID', $CustomerID)->first();

            if (empty($this->data['Customer'])) {
                return redirect('admin/vector/accounts')->with('warning_msg', "Invalid Customer");
            }

            $this->data['Orders'] = \App\vector_order::whereIn('vector_order.VectorOrderID', $OrderIds)
                ->orderby('vector_order.VectorOrderID', 'desc')
                ->get();
            $OrdersData = $this->data['Orders'];

            $Prices = 0;
            foreach ($OrdersData as $Price_str) {
                $Prices = $Prices + $Price_str->Price;
            }

            $this->data['TotalPrice'] = $Prices;

            $this->data['todaydate'] = date("d:m:Y");

            $Due =  explode(':',  $this->data['todaydate']);
            $Dueday = $Due[0] + 4;
            $Duedate = $Dueday . ':' . $Due[1] . ':' . $Due[2];

            $this->data['Duedate'] =  $Duedate;




            return view('admin.summary.accounts.vec_invoice', $this->data);
        } else {
            return redirect('admin/vector/accounts')->with('warning_msg', "Invalid Customer Or Order");
        }
    }

    public function send_vec_inv()
    {
        //         echo '<pre>'.print_r(Input::all(), 1).'</pre>'; die;
        // echo public_path('').'/invoices/my_stored_file.pdf'; die;
        $this->data['type'] = 'Vector';

        if (Input::has('orderids') && Input::has('CustomerID')) {
            $OrderIds = \Input::get('orderids');
            $CustomerID = \Input::get('CustomerID');

            // dd($OrderIds); die;
            $this->data['CustomerID'] = $CustomerID;

            $this->data['Customer'] = DB::table('customers')->where('CustomerID', $CustomerID)->first();

            $CustomerData =  $this->data['Customer'];

            if (empty($this->data['Customer'])) {
                return redirect('admin/vector/accounts')->with('warning_msg', "Invalid Customer");
            }

            $this->data['Orders'] = \App\vector_order::whereIn('vector_order.VectorOrderID', $OrderIds)
                ->orderby('vector_order.VectorOrderID', 'desc')
                ->get();

            $OrdersData = $this->data['Orders'];
            $Prices = 0;
            foreach ($OrdersData as $Price_str) {
                $Prices = $Prices + $Price_str->Price;
            }

            $this->data['TotalPrice'] = $Prices;

            $this->data['todaydate'] = date("d:m:Y");

            $Due =  explode(':',  $this->data['todaydate']);
            $Dueday = $Due[0] + 4;
            $Duedate = $Dueday . ':' . $Due[1] . ':' . $Due[2];

            $this->data['Duedate'] =  $Duedate;



            $fileName = str_random(5) . '-' . $CustomerID . '-' . str_random(5) . '.pdf';

            $pdf = PDF::loadView('admin.summary.accounts.print_vec_invoice', $this->data)
                ->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
                ->save(public_path('') . '/invoices/' . $fileName);

            $ToEmail = 'CustomerEmailAddress';
            $From = 'accounts@logoartz.com';

            $ToEmail = $CustomerData->Email;

            \Mail::send('includes.emails.invoice', [
                "CustomerName" => 'Umer'
            ], function ($message) use ($ToEmail, $From, $fileName) {
                $message->to($ToEmail)
                    ->from($From, "LogoArtz Accounts Department")
                    ->subject("Invioce")
                    ->attach(public_path('') . '/invoices/' . $fileName, ['mime' => 'application/pdf']);
            });

            return redirect('admin/vector/accounts')->with('success', 'Send Invoice Successfully');


            //            return $pdf->download('invoice.pdf');
            //            return view('admin.summary.accounts.digi_invoice', $this->data);
        } else {
            return redirect('admin/vector/accounts')->with('warning_msg', "Invalid Customer Or Order");
        }
    }


    public function get_all_vacc_req()
    {
        $From = \Input::get('DateFrom');
        $To = \Input::get('DateTo');
        $getcusid = \Input::get('cusname');
        $this->data['CustomerID'] = $getcusid;

        $this->data['allcustomers'] = \DB::table('customers')->get();
        $this->data['Orders'] = \App\vector_order::select('vector_order.VectorOrderID', 'CustomerName', 'DesignName', 'PONumber', 'Price', 'vector_order.IsRead')
            ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
            ->whereRaw('vector_order.DateAdded BETWEEN "' . $From . '" AND "' . $To . '"')
            ->whereIn('vector_order.Status', [7, 8])
            ->where('vector_order.CustomerID', $getcusid)
            ->orderby('vector_order.VectorOrderID', 'desc')
            ->get();

        return view('admin.summary.accounts.vec_acc', $this->data);
    }

    public function designer_acc()
    {

        $this->data['designers'] = \App\Designers::get();

        return view('admin.summary.accounts.dec_acc', $this->data);
    }

    public function desi_acc_detail(Request $request)
    {

        $From = \Input::get('DateFrom');
        $To = \Input::get('DateTo');
        $getdesid = \Input::get('desname');


        $this->data['designers'] = \App\Designers::get();

        $this->data['OrdersVec'] = \App\vector_order::select('vector_order.VectorOrderID', 'DesignName', 'PONumber', 'DesignerPrice', 'DesignerName', 'vector_order.IsRead', 'vector_order.DateAdded')
            ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
            ->whereBetween(DB::Raw('date(vector_order.DateAdded)'), array($From, $To))
            ->where('vector_order.Status', 7)
            ->when(($request->has('OrderNum') && $request->OrderNum != null), function ($query) use ($request) {
                return $query->where('VectorOrderID', $request->OrderNum);
            })
            ->when(($request->has('design_name')  && $request->design_name != null), function ($query) use ($request) {
                return $query->where('DesignName', $request->design_name);
            })
            ->where('vector_order.DesignerID', $getdesid)
            ->orderby('vector_order.VectorOrderID', 'desc')
            ->get();

        $this->data['OrdersDigi'] = \App\DigiOrders::select('digitizing_orders.OrderID', 'DesignName', 'PONumber', 'DesignerPrice', 'DesignerName', 'digitizing_orders.IsRead', 'digitizing_orders.DateAdded')
            ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
            ->whereBetween(DB::Raw('date(digitizing_orders.DateAdded)'), array($From, $To))
            ->where('digitizing_orders.Status', 7)
            ->when(($request->has('OrderNum') && $request->OrderNum != null), function ($query) use ($request) {
                return $query->where('OrderID', $request->OrderNum);
            })
            ->when(($request->has('design_name')  && $request->design_name != null), function ($query) use ($request) {
                return $query->where('DesignName', $request->design_name);
            })
            ->where('digitizing_orders.DesignerID', $getdesid)
            ->orderby('digitizing_orders.OrderID', 'desc')
            ->get();

        return view('admin.summary.accounts.dec_acc', $this->data);
    }

    public function sales_acc()
    {

        $this->data['salesrep'] = \App\SalesPerson::get();

        return view('admin.summary.accounts.sales_acc', $this->data);
    }

    public function sales_acc_detail(Request $request)
    {

        $From = \Input::get('DateFrom');
        $To = \Input::get('DateTo');
        $getsalesid = \Input::get('salesname');


        $this->data['salesrep'] = \App\SalesPerson::get();

        $this->data['OrdersVec'] = \App\vector_order::select('vector_order.VectorOrderID', 'DesignName', 'SalesPersonName', 'DesignerName', 'PONumber', 'SalesPrice', 'vector_order.IsRead', 'vector_order.DateAdded')
            ->leftjoin('salesperson', 'salesperson.SalesPersonID', '=', 'vector_order.SalesPersonID')
            ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
            ->whereBetween(DB::Raw('date(vector_order.DateAdded)'), array($From, $To))
            ->where('vector_order.Status', 7)
            ->when(($request->has('OrderNum') && $request->OrderNum != null), function ($query) use ($request) {
                return $query->where('VectorOrderID', $request->OrderNum);
            })
            ->when(($request->has('design_name')  && $request->design_name != null), function ($query) use ($request) {
                return $query->where('DesignName', $request->design_name);
            })
            ->where('vector_order.SalesPersonID', $getsalesid)
            ->orderby('vector_order.VectorOrderID', 'desc')
            ->get();

        $this->data['OrdersDigi'] = \App\DigiOrders::select('digitizing_orders.OrderID', 'DesignName', 'DesignerName', 'SalesPersonName', 'PONumber', 'SalesPrice', 'digitizing_orders.IsRead', 'digitizing_orders.DateAdded')
            ->leftjoin('salesperson', 'salesperson.SalesPersonID', '=', 'digitizing_orders.SalesPersonID')
            ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
            ->whereBetween(DB::Raw('date(digitizing_orders.DateAdded)'), array($From, $To))
            ->where('digitizing_orders.Status', 7)
            ->when(($request->has('OrderNum') && $request->OrderNum != null), function ($query) use ($request) {
                return $query->where('OrderID', $request->OrderNum);
            })
            ->when(($request->has('design_name')  && $request->design_name != null), function ($query) use ($request) {
                return $query->where('DesignName', $request->design_name);
            })
            ->where('digitizing_orders.SalesPersonID', $getsalesid)
            ->orderby('digitizing_orders.OrderID', 'desc')
            ->get();

        return view('admin.summary.accounts.sales_acc', $this->data);
    }

    public function customerView($customerId)
    {
        if ($customerId != '' && $customerId > 0) {


            #Customer Details
            $this->data['CustomerInfo'] = \App\Customers::where('CustomerID', $customerId)->first();

            if ($this->data['CustomerInfo'] != '') {



                # Digitzing Quote
                $this->data['DigiQuote'] = \App\DigiOrders::select('OrderID', 'customers.CustomerID as CusId', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'digitizing_orders.Status', 'OrderType', 'digitizing_orders.IsRead', 'digitizing_orders.OrderStatus', 'digitizing_orders.DateAdded', 'digitizing_orders.DateModified')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                    ->where('digitizing_orders.CustomerID', $customerId)
                    ->whereIn('digitizing_orders.OrderType', [2, 4])
                    ->orderBy('digitizing_orders.DateModified',  'desc')
                    ->get();




                # Digitzing Order
                $this->data['DigiOrders'] = \App\DigiOrders::select('OrderID', 'customers.CustomerID as CusId', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'digitizing_orders.Status', 'OrderType', 'digitizing_orders.IsRead', 'digitizing_orders.OrderStatus', 'digitizing_orders.DateAdded', 'digitizing_orders.DateModified')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'digitizing_orders.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'digitizing_orders.DesignerID')
                    ->where('digitizing_orders.CustomerID', $customerId)
                    ->whereIn('digitizing_orders.OrderType', [0, 1, 3, 9])
                    ->orderBy('digitizing_orders.DateModified',  'desc')
                    ->get();


                # Vector Quote
                $this->data['VectorQuote'] = \App\vector_order::select('VectorOrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'vector_order.Status', 'OrderType', 'vector_order.IsRead', 'vector_order.OrderStatus', 'vector_order.OrderStatus', 'vector_order.DateAdded', 'vector_order.DateModified')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                    ->where('vector_order.CustomerID', $customerId)
                    ->whereIn('vector_order.OrderType',  [2, 4])
                    ->orderBy('vector_order.DateModified', 'desc')
                    ->get();

                # Vector Order
                $this->data['VectorOrders'] = \App\vector_order::select('VectorOrderID', 'CustomerName', 'DesignerName', 'DesignName', 'PONumber', 'vector_order.Status', 'OrderType', 'vector_order.IsRead', 'vector_order.OrderStatus', 'vector_order.OrderStatus', 'vector_order.DateAdded', 'vector_order.DateModified')
                    ->leftjoin('customers', 'customers.CustomerID', '=', 'vector_order.CustomerID')
                    ->leftjoin('designers', 'designers.DesignerID', '=', 'vector_order.DesignerID')
                    ->where('vector_order.CustomerID', $customerId)
                    ->whereIn('vector_order.OrderType',  [0, 1, 3, 9])
                    ->orderBy('vector_order.DateModified', 'desc')
                    ->get();

                $this->data['OrderStatuses'] = Config('order_statuses');
                $this->data['OrderTypes'] = Config('order_types');
                $this->data['hearAbout'] = Config('hear_about');

                return view('admin.summary.CustomerSummary', $this->data);
            } else {

                return redirect()->back();
            }
        } else {

            return redirect()->back();
        }
    }





    public function stableStatus()
    {
        return [
            "1" => "Normal",
            "2" => "Rush",
            "3" => "On Hold",
            "4" => "Extra Time"
        ];
    }
}
