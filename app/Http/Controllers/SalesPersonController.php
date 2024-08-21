<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SalesPersonController extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    public $data = [];
   

    function __construct() {
        if (!\Session::has('SalesPersonID')) {
            \Redirect::to('/salesperson')->send();
            exit();
        }

  

        $this->data['configuration'] = \DB::table('configuration')->first();

        $this->data['totalnewvectors'] = '';
        $this->data['totalnewdigi'] = '';

        $this->data['vectorneworders'] = '';
        $this->data['digineworders'] = '';
        
        $this->data['vectornewquotes']= '';
        $this->data['diginewquotes']= '';
        
        $this->data['vectororder_rev']= '';
        $this->data['digiorder_rev']= '';
        
        $this->data['vectorquote_rev']= '';
        $this->data['digiquote_rev']= '';
        
        $this->data['new_vector_designer_quote']= '';
        $this->data['new_digi_designer_quote']= '';
        $this->data['new_vector_done_designer']= '';
        $this->data['new_digi_done_designer']= '';
        $this->data['new_vector_free_orders']= '';
        $this->data['new_vector_free_rivision']= '';

        $this->data['new_vector_customer_quote']= '';
        $this->data['new_digi_customer_quote']= '';
        $this->data['new_vector_done_customer']= '';
        $this->data['new_digi_done_customer']= '';
        $this->data['new_digi_free_orders']= '';
        $this->data['new_digi_free_rivision']= '';
        
        $this->data['order_statuses'] = \Config::get('order_statuses');
        // $this->data['vectorneworders'] = \DB::table('vector_order')->where('DesignerID',\Session::get('DesignerID'))->where('IsRead',1)->count();
        // $this->data['vectornewordersonly'] = \DB::table('vector_order')
        //                                      ->where('DesignerID',\Session::get('DesignerID'))
        //                                      ->where('IsRead',1)
        //                                      ->where('OrderType','!=', 4)
        //                                      ->where('OrderType','!=', 2)
        //                                      ->count();
        // $this->data['vectornewquotesonly'] = \DB::table('vector_order')->where('DesignerID',\Session::get('DesignerID'))->where('IsRead',1)->where('OrderType', 2)->orwhere('OrderType', 4)->count();
        
        // $this->data['digineworders'] = \DB::table('digitizing_orders')->where('DesignerID',\Session::get('DesignerID'))->where('IsRead',1)->count();
        // $this->data['diginewordersonly'] = \DB::table('digitizing_orders')
        //                                      ->where('DesignerID',\Session::get('DesignerID'))
        //                                      ->where('IsRead',1)
        //                                      ->where('OrderType','!=', 4)
        //                                      ->where('OrderType','!=', 2)
        //                                      ->count();
        // $this->data['diginewquotesonly'] = \DB::table('digitizing_orders')->where('DesignerID',\Session::get('DesignerID'))->where('IsRead',1)->where('OrderType', 2)->orwhere('OrderType', 4)->count();

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
