<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DesignerController extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    public $data = [];

    function __construct() {
        if (!\Session::has('DesignerLogin')) {
            \Redirect::to('/designer')->send();
            exit();
        }
        
        $this->data['configuration'] = \DB::table('configuration')->first();

        $this->data['vectorneworders'] = \DB::table('vector_order')
                                        ->where('DesignerID',\Session::get('DesignerID'))
                                        ->where('IsRead',1)
                                        ->count();




        $this->data['vectornewordersonly'] = \DB::table('vector_order')
                                             ->where('DesignerID',\Session::get('DesignerID'))
                                             ->where('IsRead',1)
                                             ->whereIn('OrderType', [0, 3])
                                             ->count();


        $this->data['vectororderrev'] = \DB::table('vector_order')
                                             ->where('DesignerID',\Session::get('DesignerID'))
                                             ->where('IsRead',1)
                                             ->whereIn('OrderType', [1, 9])
                                             ->count();  

        $this->data['vectornewquotesonly'] = \DB::table('vector_order')
                                             ->where('DesignerID',\Session::get('DesignerID'))
                                            ->where('IsRead',1)
                                            ->where('OrderType', 2)
                                            ->count();



        $this->data['vectorquoterev'] = \DB::table('vector_order')
                                            ->where('DesignerID',\Session::get('DesignerID'))
                                            ->where('IsRead',1)
                                            ->where('OrderType', 4)
                                            ->count();







        
        $this->data['digineworders'] = \DB::table('digitizing_orders')
                                        ->where('DesignerID',\Session::get('DesignerID'))
                                        ->where('IsRead',1)
                                        ->count();


        $this->data['diginewordersonly'] = \DB::table('digitizing_orders')
                                             ->where('DesignerID',\Session::get('DesignerID'))
                                             ->where('IsRead',1) 
                                             ->whereIn('OrderType', [0, 3])
                                             ->count();

          $this->data['digiordersrevs'] = \DB::table('digitizing_orders')
                                             ->where('DesignerID',\Session::get('DesignerID'))
                                             ->where('IsRead',1)
                                             ->whereIn('OrderType', [1, 9])
                                             ->count();                                    

        $this->data['diginewquotesonly'] = \DB::table('digitizing_orders')
                                            ->where('DesignerID',\Session::get('DesignerID'))
                                            ->where('IsRead',1)
                                            ->where('OrderType', 2)
                                            ->count();

         $this->data['digiquotesrev'] = \DB::table('digitizing_orders')
                                            ->where('DesignerID',\Session::get('DesignerID'))
                                            ->where('IsRead',1)
                                            ->where('OrderType', 4)
                                            ->count();

                $this->data['diginewordersonly '] = '';
    }

}
