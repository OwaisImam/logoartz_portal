<?php

namespace App\Http\Controllers\SalesPerson;

use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Input;
use Validator;
use Hash;
use DB;

class CofigCon {

   

    public function index() {

        echo "Succfully"; die;
        // $this->data['hear_about_dd'] = \Config::get('hear_about');
        // return view('home', $this->data);
    }

    public function logout_sales_user()
{
   
        \Session::forget("SalesPersonLogin");
        \Session::forget('SalesPersonID');
        \Session::forget('SalesPersonName');
        \Session::forget('SalesPersonEmail');
        \Session::forget('SalesPersonCell');
        \Session::forget('SalesPersonPicture');

        return redirect('salesperson/login');
}



}

    