<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Input;
use Validator;
use Hash;
use DB;

class Profile extends AdminController {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $query = DB::table('admin')
                ->where('AdminID', \Session::get('AdminID'));
        $this->data['admin'] = $query->first();
        if (empty($this->data['admin'])) {
            return redirect('admin/dashboard')->with('warning_msg', "No Admin Found");
        } else {
            return view('admin.profile', $this->data);
        }
    }

    public function update() {

        $valid["FirstName"] = 'required|max:50';
        $valid["LastName"] = 'required|max:50';
        $valid["Email"] = 'required|email|max:50';
        $valid["Contact"] = 'required|max:20';
        $valid["Username"] = 'required|max:100';

        if (Input::has('Password') && Input::get('Password') != "") {
            $valid["Password"] = 'min:8|max:20';
            $valid_name["Password"] = "Password";
        }

        $valid_name["FirstName"] = "First Name";
        $valid_name["LastName"] = "Last Name";
        $valid_name["Email"] = "Email";
        $valid_name["Contact"] = "Contact";
        $valid_name["Username"] = "Username";

        $messages = [
            'required' => 'Please enter :attribute.'
        ];

        $v = Validator::make(Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {
            $UserData["FirstName"] = Input::get('FirstName');
            $UserData["LastName"] = Input::get('LastName');
            $UserData["Email"] = Input::get('Email');
            $UserData["Contact"] = Input::get('Contact');
            $UserData["Username"] = Input::get('Username');
            $UserData["DateModified"] = new \DateTime;

            if (Input::get('Password') != "") {
                $UserData["Password"] = Hash::make(Input::get('Password'));
            }

            DB::table('admin')->where('AdminID', \Session::get('AdminID'))->update($UserData);
            if (Input::hasFile('ProfilePicture')) {
                if (\File::exists(public_path('uploads/administrators') . '/' . Input::get('ImgName'))) {
                    \File::delete(public_path('uploads/administrators') . '/' . Input::get('ImgName'));
                }

                $image = Input::file('ProfilePicture');
                $filename = \Session::get('AdminID') . '_' . time() . '.' . $image->getClientOriginalExtension();
                $path = public_path('uploads/administrators') . '/' . $filename;

                \Image::make($image->getRealPath())->save($path);
                DB::table('admin')
                        ->where('AdminID', \Session::get('AdminID'))
                        ->update(array('ProfilePicture' => $filename));
                \Session::put('AdminProfilePicture', $filename);
            }

            \Session::put('AdminFirstName', Input::get('FirstName'));
            \Session::put('AdminLastName', Input::get('FirstName'));
            \Session::put('AdminFullName', Input::get('FirstName') . ' ' . Input::get('LastName'));
            \Session::put('AdminEmail', Input::get('FirstName'));
            \Session::put('AdminContact', Input::get('FirstName'));

            return redirect('admin/profile')->with('success', "Profile Updated Successfully");
        }
    }

}
