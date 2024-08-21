<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;
use Hash;
use DB;

class Login extends Controller {

    function __construct() {
        if (\Session::has('DesignerLogin')) {
            
         \Redirect::to('designer/dashboard')->send();
            exit();
        }
    }

    public function index() {      
        return view('designer.login');
    }

    public function Chk_this() {
        return view('designer.login');
    }



    public function validatelogin() {
        $v = Validator::make(Input::all(), [
                    'Username' => 'required',
                    'Password' => 'required'
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {

           
            $user = DB::table('designers')
                    ->select("DesignerID", "DesignerName", "Email", "DP", "Cell", "Password", "Category")
                    ->where('Username', Input::get('Username'))
                    ->first();

                    
            if ($user) {

         
                if (Hash::check(Input::get('Password'), $user->Password)) {
                    \Session::put('DesignerLogin', true);
                    \Session::put("DesignerID", $user->DesignerID);
                    \Session::put('DesignerName', $user->DesignerName);
                    \Session::put('DesignerEmail', $user->Email);
                    \Session::put('DesignerCell', $user->Cell);
                    \Session::put('DesignerPicture', $user->DP);
                    \Session::put('Dcatagory', $user->Category);
                    
                    
                    
                    

                    return redirect('designer/dashboard');
                } else {
                    return redirect()->back()->withErrors("Invalid Username OR Password");
                }
            } else {
                return redirect()->back()->withErrors("Invalid Username OR Password");
            }
        }
    }

}
