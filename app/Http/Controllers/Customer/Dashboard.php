<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\CustomerController;

class Dashboard extends CustomerController {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        return view('customer_das', $this->data);
    }

    public function logout() {
        \Session::forget("CustomerLogin");
        \Session::forget('CustomerLogin');
        \Session::forget("CustomerID");
        \Session::forget('CustomerNahme');
        \Session::forget('Cell');
        \Session::forget('Email');
        return view('login');
    }

}
