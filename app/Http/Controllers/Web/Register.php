<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Input;
use Validator;
use Hash;
use DB;

class Register extends WebController {

    function __construct() {
        parent::__construct();
    }

    public function index() {

//        echo sha1(md5('2')); die;

        $this->data['countries_dd'] = $this->countries_dd();
        $this->data['currencies_dd'] = $this->currencies_dd();
        $this->data['hear_about_dd'] = \Config::get('hear_about');
        $this->data['card_types_dd'] = \Config::get('card_types');
        return view('register', $this->data);
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

    public function submit_reg() {
        $this->data['countries_dd'] = $this->countries_dd();
        $this->data['currencies_dd'] = $this->currencies_dd();
        $this->data['hear_about_dd'] = \Config::get('hear_about');
        $this->data['card_types_dd'] = \Config::get('card_types');
//        return view('register', $this->data);
//        exit();

        $valid["CustomerName"] = 'required|max:20';
        $valid["Cell"] = 'required|numeric|digits_between:8,15';
//        $valid["Email"] = 'email|max:50|unique:customers,CustomerID,'.$id; // for update record
        $valid["Email"] = 'required|email|max:50|unique:customers';
        $valid["Fax"] = 'max:100';
        $valid["Company"] = 'max:100';          
        $valid["State"] = 'required|max:100';
        $valid["City"] = 'required|max:100';
        $valid["Address"] = 'required|max:1000';
        $valid["CountryID"] = 'required|integer|min:1';
        $valid["CurrencyID"] = 'required|integer|min:1';
        $valid["HearAbout"] = 'required|integer|min:1';
        $valid["Zip"] = 'numeric|digits_between:5,10';
        $valid["Username"] = 'required|max:100|unique:customers';
        $valid["Password"] = 'required|max:20';

        $valid_name["CountryID"] = "Country";
        $valid_name["CustomerName"] = "Customer Name";
        $valid_name["Cell"] = "Cell";
        $valid_name["Email"] = "Email";
        $valid_name["Fax"] = "Fax";
        $valid_name["Company"] = "Company";
        $valid_name["State"] = "state";
        $valid_name["City"] = "City";
        $valid_name["Address"] = "Address";
        $valid_name["CountryID"] = "Country";
        $valid_name["CurrencyID"] = "Currency";
        $valid_name["HearAbout"] = "Hear About";
        $valid_name["Zip"] = "Zip";
        $valid_name["Username"] = "Username";
        $valid_name["Password"] = "Password";

        $messages = [
            'required' => 'Please enter :attribute.',
            'CountryID.min' => 'Please select :attribute.',
            'HearAbout.min' => 'Please select :attribute.',
            'CurrencyID.min' => 'Please select :attribute.',
            'max' => 'No more characters allowed in :attribute.',
            'unique' => ':attribute is already registered.'
        ];

        $v = Validator::make(Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {
            $CustomerData = [
                'CustomerName' => Input::get('CustomerName'),
                'Cell' => Input::get('Cell'),
                'Email' => Input::get('Email'),
                'Fax' => Input::get('Fax'),
                'Company' => Input::get('Company'),
                'CountryID' => Input::get('CountryID'),
                'State' => Input::get('State'),
                'City' => Input::get('City'),
                'Address' => Input::get('Address'),
                'Zip' => Input::get('Zip'),
                'CurrencyID' => Input::get('CurrencyID'),
                'Username' => Input::get('Username'),
                'Password' => Hash::make(Input::get('Password')),
                'HearAbout' => Input::get('HearAbout'),
                'Status' => 0,
                'DateAdded' => new \DateTime()
            ];

            DB::table('customers')->insert($CustomerData);
            $CustomerID = DB::getPdo()->lastInsertId();

            $ActivationCode = sha1(md5($CustomerID)) . $CustomerID;

            DB::table('customers')->where('CustomerID', $CustomerID)->update(['ActivationCode' => $ActivationCode]);



            $BillingData = [
                'CustomerID' => $CustomerID,
                'CardNumber' => Input::get('CardNumber'),
                'NameOnCard' => Input::get('NameOnCard'),
                'Type' => Input::get('Type'),
                'VerificationCode' => Input::get('VerificationCode'),
                'ExpiryDate' => Input::get('ExpiryDate'),
                'Address' => Input::get('Address'),
                'City' => Input::get('City'),
                'ZipCode' => Input::get('ZipCode'),
                'State' => Input::get('State'),
                'CountryID' => Input::get('CountryID')
            ];

            //DB::table('customer_billing_info')->insert($BillingData);
             $mailFrom = 'technical-team@logoartz.com';
             $customerName = Input::get('FirstName');
             $email = Input::get('Email');



                if($CustomerData != ''){
                   $mailRes = $this->registorMail($mailFrom, $email, $customerName, $ActivationCode);
                }
            

            
                // New Customer EMail Alert for Admin
            
                  $CountryList = $this->countries_dd();
                  $Currencylist = $this->currencies_dd();
                  $Hear_About = \Config::get('hear_about');
                  
                  
                  $Cus_info =  DB::table('customers')->where('CustomerID', $CustomerID)->first();
             
                   $email = '';
                   $cus_email = $Cus_info->Email;
                   $email = $cus_email;
                   $Name = $Cus_info->CustomerName;
                   $Cell = $Cus_info->Cell;
                   $Company = $Cus_info->Company;
                   $City = $Cus_info->City;
                   $Country =  $CountryList[$Cus_info->CountryID];
                   $Currency = $Currencylist[$Cus_info->CurrencyID];
                   $hear_about = $Hear_About[$Cus_info->HearAbout];

                 
                  $mailFrom = 'technical-team@logoartz.com';
                  \Mail::send('includes.emails.cus_reg', [
                  "CustomerName" => $Name,
                  "CusEmail" => $email,
                  "CusPhone" => $Cell,
                  "CusCompany" => $Company,
                  "CusCity" => $City,
                  "CusCountry" => $Country,
                  "CusCurrency" => $Currency,
                  "HearAbout" => $hear_about,
                  
                  ]
                    , function($message) use ($mailFrom) {
                $message->to('info@logoartz.com')->from($mailFrom, 'Logo Artz')->subject('Logo Artz - New Customer Alert!');
            });

            if($mailRes == 10){
                return redirect('login')->with('success', 'Registered Successfully, varification email fail please contact info@logoartz.com');
            }else{

               return redirect('login')->with('success', 'Registered Successfully, please check your email for further steps');
            }
          
           
        }
    }

    public function registorMail($from, $to, $name, $activationcode)
    {
        $ActivationCode = $activationcode;
        $Name = $name;
        $mailFrom = $from;
        $mailTo = $to;

                    \Mail::send('includes.emails.register', [
                        "FirstName" => $name,
                        "ActivationCode" => url('activate-user/' . $ActivationCode)
                            ]
                            , function($message) use ($mailFrom, $mailTo) {
                        $message->to($mailTo)->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Email Verification');
                    });

        if(count(\Mail::failures() )  >  0 && $count <= 5) {
           $count++;
           $this->registorMail($mailFrom, $mailTo, $Name, $ActivationCode);
        }else if (count(\Mail::failures() )  <  1 && $count = 5){
            return 10; // Means Fail Mail
        }else{
            return 9; // Mail Send
        }   


    }

public function forgot_password() 
{
         return view('forgotpwd', $this->data);
}

public function forgot_password_submit() 
{ 
    
         $GetEmail = \Input::get('Email');
        
        $valid["Email"] = 'required|email|max:50';

        $valid_name["Email"] = "Email";

        $messages = [
            'required' => 'Please enter :attribute.',
            'max' => 'No more characters allowed in :attribute.',
            'unique' => ':attribute is already registered.'
        ];

        $v = Validator::make(Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);

        if($v->fails()){
            return redirect()->back()->withErrors($v->errors())->withInput();
        }else{

            $Data = DB::table('customers')->where('Email', $GetEmail)->first();

            if($Data == "" || $Data == null){
                 return redirect('cus_forgot_password')->with('warning_msg', 'Invalid email, please try again');
             }else{

             $forgotpwdCode = sha1(md5($Data->CustomerName)) . $Data->CustomerID;
             DB::table('customers')->where('CustomerID', $Data->CustomerID)->where('Email', $Data->Email)->update(['ResetCode' => $forgotpwdCode]);

                  $mailFrom = 'technical-team@logoartz.com';
                  \Mail::send('includes.emails.forgotpwd', [
                  "CustomerName" => $Data->CustomerName, 
                  "forgotpwdCode" => url('forgotpwd-user/' . $forgotpwdCode)
                    ]
                    , function($message) use ($mailFrom) {
                $message->to(Input::get('Email'))->from($mailFrom, 'Logo Artz')->subject('Logo Artz - Forgot Password');
            });



             }
                   return redirect('login')->with('success', 'Confirmation email has been sent, please check your email.');

        }
    
    

        
}

public function validate_reset($resetCode) 
{
    
    $Customer = DB::table('customers')->where('ResetCode', $resetCode)->first();
    
    if(!empty($Customer)) {
        
        $this->data['resetCode'] = $resetCode;
        return view('reset-pwd', $this->data);
         } else 
         {
        return redirect('login')->with('errors', ['Invalid Code, please try again']);
         }
}



    public function submit_validate_reset($resetCode) 
    {
          $Customer = DB::table('customers')->where('ResetCode', $resetCode)->first();
        
        if(empty($resetCode)){
            return redirect('login')->with('errors', ['Invalid User Information, please contact logoartz team']);
        }elseif($Customer != ""){
            
             $pwd = Input::get('Password');
             $confirmpwd = Input::get('ConfirmPassword');
            
                 
              if($pwd != $confirmpwd){
              return redirect('forgotpwd-user/'.$resetCode)->with('warning_msg', 'Password not match, please try again');
                }else{
                      
                     DB::table('customers')->where('CustomerID', $Customer->CustomerID)->update(['Password' => Hash::make($pwd), 'ResetCode' => '']);
                     return redirect('login')->with('success', 'Password updated, please login here...');
                   }
               
                 return redirect('forgot_password')->with('errors', ['Invalid Code']);
                
                
            
        }
        

}

    public function activate_user($ActivationCode) {


        $CusTbData = DB::table('customers');


        $CusData = DB::table('customers')->where('ActivationCode', $ActivationCode)->first();




        if ($CusData == '') {

            // echo "Activation Link Invalid Contact LogoArtz Support Center"; die;
            return redirect('register')->with('errors', ['Your Activation Link Is Invalid', 'Resend Email Again', 'Or Contact LogoArtz Support Center']);
        } else {


            DB::table('customers')
                    ->where('ActivationCode', $ActivationCode)
                    ->update(['ActivationCode' => '', 'isActivated' => 1, 'Status' => 1]);



            return redirect('login')->with('success', 'Your account is activated successfully, please login and get experienced with the best quality of artwork');
        }







        //     if($CusTbData['ActivationCode'] != $ActivationCode)
        //     {
        //       return redirect('register')->with('object', 'Activation Link Invalid Contact LogoArtz Support Center');
        //     }
        //      else if($CusTbData->ActivationCode == $ActivationCode)
        //     {
        //         $CusData[] = DB::table('customers')->where('ActivationCode', $ActivationCode)->first();
        //         DB::table('Customers')
        //         ->where('ActivationCode', $CusData->CustomerID)
        //         ->update(['ActivationCode' => '' , 'isActivated' => 1];
        //     //          ->where('id', 1)
        //     // ->update(['votes' => 1]);
        //     return redirect('register')->with('success', 'You Account Is Activated Login And Place Order');
        //     }
        //     if($CusData->ActivationCode !== $ActivationCode)
        //     {
        //       return redirect('register')->with('success', 'Activation Link Invalid Contact LogoArtz Support Center');
        //     }
        // $CMD = sha1(md5($ActivationCode));
        // echo $CMD; die;
        // $ActivateCode = $ActivationCode;
        //  $IsCheckCus = DB::table('customers')->whereRaw((" '' = $ActivationCode"))->first();
        // echo "Successfully".$ActivationCode; die;
        // query -> select where activationcode = variable
        // update customers isactivated
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
