<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Input;
use admin\summary\history\historyindi;
use Validator;
use DB;
use PDF;

class AdminAccounts extends AdminController
{

  public function index()
  {

    echo "sadhsdb";
    die;
  }




  public function view_all()
  {

    $this->data['Invoices'] =  \App\invoice::orderBy('id', 'DESC')->get();

    // dd($this->data['Invoices']);

    return view('admin.summary.accounts.invoices', $this->data);
  }



  public function getPriceDigi($id)
  {

    $query = \App\DigiOrders::where('OrderID', $id);
    $this->data['order_digi'] = $query->first();

    //   dd($this->data['order_digi']);
    if (empty($this->data['order_digi'])) {
      return redirect('admin/cus/accounts')->with('warning_msg', "Invalid Order ID");
    } else {
      return view('finance.editPricesDigi', $this->data);
    }
  }


  public function updatePriceDigi($id)
  {


    $valid["OrderID"]         =     'required';
    $valid["DesignName"]      =    'required';
    $valid["OrderPrice"]      =    'required';
    $valid["qty"]             =    'required';
    $valid["finalprice"]   =    'required';
    $valid["DesignerPrice"] =    'required';

    $valid_name["OrderID"] = "Order ID";
    $valid_name["DesignName"] = "Design name";
    $valid_name["OrderPrice"] = "Unit Price";
    $valid_name["qty"] = "Qunatity of Order";
    $valid_name["finalprice"] = "Final price";
    $valid_name["DesignerPrice"] = "Designer price";



    $messages = [
      'required' => 'Please enter :attribute.',
      'max' => 'No more characters allowed in :attribute.'
    ];

    $v = Validator::make(\Input::all(), $valid, $messages);
    $v->setAttributeNames($valid_name);
    if ($v->fails()) {
      return redirect()->back()->withErrors($v->errors())->withInput();
    } else {


      $DesignName = Input::get('DesignName');
      $UnitPrice = Input::get('OrderPrice');
      $Qty = Input::get('qty');
      $Discount = Input::get('Discount');
      $FinalPrice = Input::get('finalprice');
      $DesignerPrice = Input::get('DesignerPrice');
      $SalesPrice = Input::get('SalesComm');


      if ($id > 0) {

        \App\DigiOrders::where('OrderID', $id)
          ->update([
            'DesignName' => $DesignName,
            'Quantity'  => $Qty,
            'PriceBeforeDiscount' => $UnitPrice,
            'Discount' => $Discount,
            'Price' => $FinalPrice,
            'CustomerPrice' => $FinalPrice,
            'DesignerPrice' => $DesignerPrice,
            'DateModified' => new \DateTime()
          ]);

        if (Input::has('SalesComm')) {

          \App\DigiOrders::where('OrderID', $id)
            ->update([
              'SalesPrice' => $SalesPrice,
            ]);

          return redirect('admin/cus/accounts')->with(['success' => "Order Updated Successfully"]);
        }

        return redirect('admin/cus/accounts')->with(['success' => "Error!! Contact Web Engineer"]);
      }
    }
  }


  public function getPriceVec($id)
  {
    $query = \App\vector_order::where('VectorOrderID', $id);
    $this->data['order_vec'] = $query->first();

    if (empty($this->data['order_vec'])) {
      return redirect('admin/cus/accounts')->with('warning_msg', "Invalid Order ID");
    } else {
      return view('finance.editPricesVec', $this->data);
    }
  }

  public function updatePriceVec($id)
  {


    $valid["OrderID"]         =     'required';
    $valid["DesignName"]      =    'required';
    $valid["OrderPrice"]      =    'required';
    $valid["qty"]             =    'required';
    $valid["finalprice"]   =    'required';
    $valid["DesignerPrice"] =    'required';

    $valid_name["OrderID"] = "Order ID";
    $valid_name["DesignName"] = "Design name";
    $valid_name["OrderPrice"] = "Unit Price";
    $valid_name["qty"] = "Qunatity of Order";
    $valid_name["finalprice"] = "Final price";
    $valid_name["DesignerPrice"] = "Designer price";


    $messages = [
      'required' => 'Please enter :attribute.',
      'max' => 'No more characters allowed in :attribute.'
    ];

    $v = Validator::make(\Input::all(), $valid, $messages);
    $v->setAttributeNames($valid_name);
    if ($v->fails()) {
      return redirect()->back()->withErrors($v->errors())->withInput();
    } else {

      $DesignName = Input::get('DesignName');
      $UnitPrice = Input::get('OrderPrice');
      $Qty = Input::get('qty');
      $Discount = Input::get('Discount');
      $FinalPrice = Input::get('finalprice');
      $DesignerPrice = Input::get('DesignerPrice');
      $SalesPrice = Input::get('SalesComm');



      if ($id > 0) {

        \App\vector_order::where('VectorOrderID', $id)
          ->update([
            'DesignName' => $DesignName,
            'Quantity'  => $Qty,
            'PriceBeforeDiscount' => $UnitPrice,
            'Discount' => $Discount,
            'Price' => $FinalPrice,
            'CustomerPrice' => $FinalPrice,
            'DesignerPrice' => $DesignerPrice,
            'DateModified' => new \DateTime()
          ]);

        if (Input::has('SalesComm')) {

          \App\vector_order::where('VectorOrderID', $id)
            ->update([
              'SalesPrice' => $SalesPrice,
            ]);

          return redirect('admin/cus/accounts')->with(['success' => "Order Updated Successfully"]);
        }

        return redirect('admin/cus/accounts')->with(['success' => "Error!! Contact Web Engineer"]);
      }
    }
  }


  public function send_cus_inv()
  {

    $digiOrders = [];
    $vecOrders = [];
    $digiFinalPrice = 0;
    $vecFinalPrice = 0;
    $vecWithoutDisPrice = 0;
    $digiWithoutDisPrice = 0;
    $digiDiscountTotal = 0;
    $vecDiscountTotal = 0;
    $vecFinalPrice = 0;
    $totalQuantity = 0;
    $digiIdies = Input::get('digi_orId');
    $vecIdies = Input::get('vec_orId');
    $due_date = Input::get('due_date');
    $invoice_number = Input::get('invoice_number');


    if ($digiIdies != '' || $vecIdies != '') {
      //*//    Digi Orders Set //*//


      $digiNames = Input::get('digi_orName');
      $digiOrDate = Input::get('digi_orDate');
      $digiPrices = Input::get('digi_orPrice');
      $digiUnit = Input::get('digi_prUnit');
      $digiQty = Input::get('digi_orQty');
      $digiDiscount = Input::get('digi_orDiscount');
      $digiTotal = Input::get('digi_orPrice');

      //*//    Vector Orders Set //*//

      $vecNames = Input::get('vec_orName');
      $vecOrDate = Input::get('vec_orDate');
      $vecPrices = Input::get('vec_orPrice');
      $vecUnit = Input::get('vec_prUnit');
      $vecQty = Input::get('vec_orQty');
      $vecDiscount = Input::get('vec_orDiscount');
      $vecTotal = Input::get('vec_orPrice');



      if ($digiIdies != '') {
        $count = 0;

        foreach ($digiIdies as $id) {
          if ($digiDiscount[$count] != '') {
            $total = $digiPrices[$count] - $digiDiscount[$count];
          } else {
            $total = $digiTotal[$count];
          }


          $arr = [
            'orId' => $id,
            'orName' => $digiNames[$count],
            'orCetagory' => 'Digitizing',
            'orDate' => $digiOrDate[$count],
            'orQty' => $digiQty[$count],
            'orUnitPrice' => $digiUnit[$count],
            'orDiscount' => $digiDiscount[$count],
            'orTotal' => $digiTotal[$count]
          ];
          array_push($digiOrders, $arr);
          $digiFinalPrice = $digiFinalPrice + $digiTotal[$count];
          // Total Discount
          $digiDiscountTotal = $digiDiscountTotal + $digiDiscount[$count];
          // Total Price With Out Discount
          $digiWithoutDisPrice = $digiWithoutDisPrice + $digiUnit[$count];

          $totalQuantity = $totalQuantity + $digiQty[$count];

          $count++;
        }
      }

      if ($vecIdies != '') {
        $count = 0;

        foreach ($vecIdies as $id) {

          // if($vecDiscount[$count] != ''){

          //   $total = $vecPrices[$count] - $vecDiscount[$count];
          //  }  else{
          //   $total = $vecTotal[$count];
          // }


          $arr = [
            'orId' => $id,
            'orName' => $vecNames[$count],
            'orCetagory' => 'Vector',
            'orDate' => $vecOrDate[$count],
            'orQty' => $vecQty[$count],
            'orUnitPrice' => $vecUnit[$count],
            'orDiscount' => $vecDiscount[$count],
            'orTotal' => $vecTotal[$count]
          ];

          array_push($vecOrders, $arr);
          // Final Price
          $vecFinalPrice = $vecFinalPrice + $vecTotal[$count];
          // Total Discount
          $vecDiscountTotal = $vecDiscountTotal + $vecDiscount[$count];
          // Total Price With Out Discount
          $vecWithoutDisPrice = $vecWithoutDisPrice + $vecUnit[$count];

          $totalQuantity = $totalQuantity + $vecQty[$count];


          $count++;
        }
      }







      $this->data['Pay_URL'] =  Input::get('payUrl');
      $this->data['emailmessage'] = Input::get('emailcontent');

      $this->data['periodline'] = Input::get('period');


      if ($this->data['Pay_URL'] == "" && $this->data['emailmessage'] == "") {
        return redirect('admin/digi/accounts')->with('warning_msg', "Please Enter Payment Link and Email Message");
      } else {

        $CustomerID = \Input::get('CustomerID');

        $Customer = DB::table('customers')->where('CustomerID', $CustomerID)->first();

        if (empty($Customer)) {
          return redirect('admin/digi/accounts')->with('warning_msg', "Invalid Customer");
        }

        // Set Due Date 

        $Due =  explode('-',  $due_date);
        $Duedate = $Due[2] . '-' . $Due[1] . '-' . $Due[0];

        // Craete Invoice Number 
        $file = $Customer->CustomerName . '-' . $invoice_number . '.pdf';
        $fileName = str_replace(' ', '', $file);
        // Check Unique NUmber of Invoice
        $invCheck = \App\invoice::select('invoice_name')->where('invoice_name', $fileName)->first();

        if ($invCheck != "") {
          return redirect('admin/cus/accounts')->with('warning_msg', "Invoice Number Already Exits Please Change Invoice Number");
        }

        $Sub_Total = $digiWithoutDisPrice + $vecWithoutDisPrice;
        $TotalDiscount = $vecDiscountTotal + $digiDiscountTotal;
        $TotalPrice = $digiFinalPrice + $vecFinalPrice;

        // dd($TotalPrice);


        $this->data['Duedate']        =     $due_date;
        $this->data['invoice_number'] =     $invoice_number;
        $this->data['Sub_Total']      =     $Sub_Total;
        $this->data['Discount']       =     $TotalDiscount;
        $this->data['TotalPrice']      =    $TotalPrice;
        $this->data['Customer']      =      $Customer;
        $this->data['todaydate']    =      date("d-m-Y");
        $this->data['digiOrders'] = $digiOrders;
        $this->data['vecOrders'] = $vecOrders;
        $this->data['totalQuantity'] = $totalQuantity;



        // return view('admin.summary.accounts.print_cus_invoice', $this->data);
        // exit();


        $pdf = PDF::loadView('admin.summary.accounts.print_cus_invoice', $this->data)
          ->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);

        $pdf->save(public_path('') . '/invoices/' . $fileName);


        if ($TotalPrice > 0) {
          $data = [
            'Inv_id' => $invoice_number,
            'customer_id' => $CustomerID,
            'total_price' => $TotalPrice,
            'customer_email' => $Customer->Email,
            'customer_name' => $Customer->CustomerName,
            'invoice_name'  => $fileName,
            'due_date'     =>   $Duedate,
            'created_at' => now(),
          ];
          \App\invoice::insert($data);
        }


        $ToEmail = 'CustomerEmailAddress';
        $From = 'accounts@logoartz.com';

        $ToEmail = $Customer->Email;
        $CustomerName = $Customer->CustomerName;
        $payUrl = $this->data['Pay_URL'];
        $Message = $this->data['emailmessage'];




        \Mail::send('includes.emails.invoice', [
          "CustomerName" => $CustomerName,
          'payUrl' => $payUrl,
          "Message" => $Message
        ], function ($message) use ($ToEmail, $From, $fileName) {
          $message->to($ToEmail)
            ->from($From, "LogoArtz Accounts Department")
            ->subject("Invoice")
            ->attach(public_path('') . '/invoices/' . $fileName, ['mime' => 'application/pdf']);
        });

        return redirect('admin/cus/accounts')->with('success', 'Invoice Sent To Customer Successfully');
      }
    } else {
      // Redirect ///
      return redirect('admin/digi/accounts')->with('warning_msg', "Invalid Customer Or Order");
    }


    // dd(Input::get('digi_orPriceee'));






    exit();















    dd($vecOrders);

    //   foreach ($invoiceDueAmount as $key => $value) {
    //     $totalInvAmount = $totalInvAmount + $invoiceDueAmount[$key]->invoice_due_amount;
    //     $totalRevAmount = $totalRevAmount + $invoiceDueAmount[$key]->receive_amount;
    // }












    //*//*//---------- Old Work ---------------*//*//



    $VOrderData = '';
    $DOrdersData = '';
    $due_date = Input::get('due_date');
    $Sub_Total = Input::get('sub_total');
    $TotalPrice = Input::get('TotalPrice');
    $invoice_number = Input::get('invoice_number');
    $discount = Input::get('discount');
    $this->data['Pay_URL'] =  Input::get('payUrl');
    $this->data['emailmessage'] = Input::get('emailcontent');
    $this->data['DigiOrders'] = '';
    $this->data['VecOrders'] = '';
    $this->data['count'] = 1;
    $this->data['periodline'] = Input::get('period');


    if ($this->data['Pay_URL'] == "" && $this->data['emailmessage'] == "") {
      return redirect('admin/digi/accounts')->with('warning_msg', "Please Enter Payment Link and Email Message");
    } else {

      if (Input::has('dorderids') || Input::has('vorderids') && Input::has('CustomerID')) {
        $DOrderIds = \Input::get('dorderids');
        $VOrderIds = \Input::get('vorderids');
        $CustomerID = \Input::get('CustomerID');

        // $this->data['DOrderIDs'] = $DOrderIds;
        // $this->data['VOrderIDs'] = $VOrderIds;
        // $this->data['CustomerID'] = $CustomerID;


        $Customer = DB::table('customers')->where('CustomerID', $CustomerID)->first();
        //    $this->data['CustomerID'] = $CustomerID;
        //    $CustomerData =  $this->data['Customer'];

        if (empty($Customer)) {
          return redirect('admin/digi/accounts')->with('warning_msg', "Invalid Customer");
        }

        if ($DOrderIds != '') {

          $DOrdersData = \App\DigiOrders::select('OrderID', 'DesignName', 'Price', 'DateAdded')
            ->whereIn('digitizing_orders.OrderID', $DOrderIds)
            ->orderby('digitizing_orders.OrderID', 'desc')
            ->get();
        }

        if ($VOrderIds != '') {
          $VOrderData = \App\vector_order::select('VectorOrderID', 'DesignName', 'Price', 'DateAdded')
            ->whereIn('vector_order.VectorOrderID', $VOrderIds)
            ->orderby('vector_order.VectorOrderID', 'desc')
            ->get();
        }


        // PRICE AREA


        // Get Digitizing Order Prices 

        // if(!empty($this->data['DigiOrders'])) {

        //     foreach($this->data['DigiOrders'] as $Price_str)
        //       {
        //      $DPrices = $DPrices + $Price_str->Price;
        //       }
        //   }


        // Get Vector Order Prices 

        // if(!empty($this->data['VecOrders'])) {

        //     foreach($this->data['VecOrders'] as $Price_str)
        //      {
        //     $VPrices = $VPrices + $Price_str->Price;

        //      }
        // }


        // if($DPrices >  0){
        //         $SubPrices = $DPrices;
        //     }
        //     if($VPrices >  0){
        //         $SubPrices = $DPrices + $VPrices;
        //     }


        if ($discount == "") {
          $TotalPrice =  $Sub_Total;
        } else {

          $TotalPrice == Input::get('TotalPrice');
          $discount == Input::get('discount');
        }





        // echo "Invoice Number:  ". $invoice_number. '<br>';
        // echo "Due Date:  ". $due_date. '<br>';
        // echo "Sub Total:  ". $Sub_Total. '<br>';
        // echo "Discount:  " . $discount. '<br>';
        // echo "Total Price:  ". $TotalPrice. '<br>';






        //   $this->data['Sub_Total'] = $SubPrices;

        $Due =  explode('-',  $due_date);
        $Duedate = $Due[2] . '-' . $Due[1] . '-' . $Due[0];

        // Data Sets for Genrrate Invoice


        $this->data['Duedate']        =     $Duedate;
        $this->data['invoice_number'] =     $invoice_number;
        $this->data['digiOrders']     =     $DOrdersData;
        $this->data['vecOrders']      =     $VOrderData;
        $this->data['Sub_Total']      =     $Sub_Total;
        $this->data['TotalPrice']      =    $TotalPrice;
        $this->data['Discount']       =     $discount;
        $this->data['Customer']      =      $Customer;
        $this->data['todaydate']    =      date("d-m-Y");

        // $fileName = str_random(5) . '-' . $CustomerID . '-' . str_random(5) . '.pdf';
        $file = $Customer->CustomerName . '-' . $invoice_number . '.pdf';
        $fileName = str_replace(' ', '', $file);

        // echo $fileName; die;


        $invCheck = \App\invoice::select('invoice_name')->where('invoice_name', $fileName)->first();




        if ($invCheck != "") {
          return redirect('admin/cus/accounts')->with('warning_msg', "Invoice Number Already Exits Please Change Invoice Number");
        }


        $pdf = PDF::loadView('admin.summary.accounts.print_cus_invoice', $this->data)
          ->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
          ->save(public_path('') . '/invoices/' . $fileName);

        // echo  $invoice_number."<br>". $Duedate. '<br>'.$SubPrices.'<br>'.$TotalPrice; die;


        // echo $DOrderIds.'<br>'; die;

        // echo '<pre>';
        // print_r($DOrderIds);
        // echo '</pre>'; 


        // echo '<pre>';
        // print_r($VOrderIds);
        // echo '</pre>'; die;



        if ($TotalPrice > 0) {
          $data = [
            'Inv_id' => $invoice_number,
            'customer_id' => $CustomerID,
            'total_price' => $TotalPrice,
            'customer_email' => $Customer->Email,
            'customer_name' => $Customer->CustomerName,
            'invoice_name'  => $fileName,
            'due_date'     =>   $Duedate,
            'created_at' => now(),
          ];
          \App\invoice::insert($data);
        }

        $ToEmail = 'CustomerEmailAddress';
        $From = 'accounts@logoartz.com';

        $ToEmail = $Customer->Email;
        $CustomerName = $Customer->CustomerName;
        $payUrl = $this->data['Pay_URL'];
        $Message = $this->data['emailmessage'];


        \Mail::send('includes.emails.invoice', [
          "CustomerName" => $CustomerName,
          'payUrl' => $payUrl,
          "Message" => $Message
        ], function ($message) use ($ToEmail, $From, $fileName) {
          $message->to($ToEmail)
            ->from($From, "LogoArtz Accounts Department")
            ->subject("Invoice")
            ->attach(public_path('') . '/invoices/' . $fileName, ['mime' => 'application/pdf']);
        });

        return redirect('admin/cus/accounts')->with('success', 'Invoice Sent To Customer Successfully');

        //return view('admin.summary.accounts.print_cus_invoice', $this->data);
      } else {
        return redirect('admin/digi/accounts')->with('warning_msg', "Invalid Customer Or Order");
      }
    }
  }
}
