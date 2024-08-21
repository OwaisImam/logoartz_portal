<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;
use Hash;
use DB;

class Login extends Controller {

    function __construct() {
        if (\Session::has('SuperAdminLogin')) {
            \Redirect::to('admin/dashboard')->send();
            exit();
        }
    }

    public function index() {
        return view('admin.login');
    }

    public function validatelogin() {
        $v = Validator::make(Input::all(), [
                    'Username' => 'required',
                    'Password' => 'required'
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {
            $user = DB::table('admin')
                    ->select("AdminID", "FirstName", "LastName", "Email", "ProfilePicture", "Contact", "Password")
                    ->where('Username', Input::get('Username'))
                    ->first();
                    
            if ($user) {
                if (Hash::check(Input::get('Password'), $user->Password)) {
                    \Session::put('SuperAdminLogin', true);
                    \Session::put("AdminID", $user->AdminID);
                    \Session::put('AdminFirstName', $user->FirstName);
                    \Session::put('AdminLastName', $user->LastName);
                    \Session::put('AdminFullName', $user->FirstName . ' ' . $user->LastName);
                    \Session::put('AdminEmail', $user->Email);
                    \Session::put('AdminContact', $user->Contact);
                    \Session::put('AdminProfilePicture', $user->ProfilePicture);
                    return redirect('admin/dashboard');
                } else {
                    return redirect()->back()->withErrors("Invalid Username OR Password");
                }
            } else {
                return redirect()->back()->withErrors("Invalid Username OR Password");
            }
        }
    }

}
