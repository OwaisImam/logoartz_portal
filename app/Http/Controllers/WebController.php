<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class WebController extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    public $data = [];

  

    function __construct() {
        

        $this->data['newvectororders'] = '';
        $this->data['newvectororders'] = '';
        $this->data['newdigiorders'] = '';
        $this->data['myvectors'] = '';
        $this->data['mydigis'] = '';
        $this->data['totalvectors'] = '';
        $this->data['totaldigis'] = '';

        $this->data['configuration'] = \DB::table('configuration')->first();


            $this->data['totalvectors'] = \DB::table('vector_order')->where('CustomerID',\Session::get('CustomerID'))->where('IsRead',2)->count();
            $this->data['totaldigis'] = \DB::table('digitizing_orders')->where('CustomerID',\Session::get('CustomerID'))->where('IsRead',2)->count();
            
            $this->data['newdigiorders'] = \DB::table('digitizing_orders')->where('CustomerID',\Session::get('CustomerID'))->where('Status',3)->where('IsRead',2)->count();
            $this->data['newvectororders'] = \DB::table('vector_order')->where('CustomerID',\Session::get('CustomerID'))->where('Status',3)->where('IsRead',2)->count();
            
            $this->data['myvectors'] = \DB::table('vector_order')->where('CustomerID',\Session::get('CustomerID'))->where('Status',7)->where('IsRead',2)->count();
            $this->data['mydigis'] = \DB::table('digitizing_orders')->where('CustomerID',\Session::get('CustomerID'))->where('Status',7)->where('IsRead',2)->count();

        
    }

}
