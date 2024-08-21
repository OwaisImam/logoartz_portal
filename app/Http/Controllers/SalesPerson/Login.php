<?php

namespace App\Http\Controllers\SalesPerson;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;
use Hash;
use DB;

class Login extends Controller {

    function __construct() {
        if (\Session::has('SalesPersonLogin')) {
            
         \Redirect::to('salesperson/dashboard')->send();
            exit();
        }
    }

    public function index() {      
        return view('salesperson.login');
    }

    public function Chk_this() {
        return view('salesperson.login');
    }



    public function validatelogin() {


        $v = Validator::make(Input::all(), [
                    'Username' => 'required',
                    'Password' => 'required'
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {

           
            $user =  \App\SalesPerson::select("SalesPersonID", "SalesPersonName", "Email", "Category", "DP", "Cell", "Password")
                    ->where('Username', Input::get('Username'))
                    ->first();

                    
            if ($user) {
                if (Hash::check(Input::get('Password'), $user->Password)) {
                    \Session::put('SalesPersonLogin', true);
                    \Session::put('SalesPersonID', $user->SalesPersonID);
                    \Session::put('SalesPersonName', $user->SalesPersonName);
                    \Session::put('SalesPersonEmail', $user->Email);
                    \Session::put('SalesCategory', $user->Category);
                    \Session::put('SalesPersonCell', $user->Cell);
                    \Session::put('SalesPersonPicture', $user->DP);

                    return redirect('salesperson/dashboard');
                } else {
                    return redirect()->back()->withErrors("Invalid Username OR Password");
                }
            } else {
                return redirect()->back()->withErrors("Invalid Username OR Password");
            }
        }
    }



}
