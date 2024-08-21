<?php

namespace App\Http\Controllers\SalesPerson;

use App\Http\Controllers\SalesPersonController;
use Illuminate\Support\Facades\Input;
use Validator;
use Hash;
use DB;

class Profile extends SalesPersonController {

    function __construct() {
        parent::__construct();
    }

    public function index() {

        
        // $SlaesName = \Session::get('SalesPersonName');

        // echo $SlaesName; die;

        $query = DB::table('salesperson')
                ->where('SalesPersonID', \Session::get('SalesPersonID'));

        $this->data['salesperson'] = $query->first();

        if (empty($this->data['salesperson'])) {
            return redirect('salesperson/dashboard')->with('warning_msg', "No Sales Rep Found");
        } else {
            return view('salesperson.profile', $this->data);
        }
    }

    public function update() {


        $valid["Name"] = 'required|max:50';
        $valid["Email"] = 'required|email|max:50';
        $valid["Cell"] = 'required|max:20';
        $valid["Username"] = 'required|max:100';

        if (Input::has('Password') && Input::get('Password') != "") {
            $valid["Password"] = 'min:8|max:20';
            $valid_name["Password"] = "Password";
        }

        $valid_name["Name"] = "Name";
        $valid_name["Email"] = "Email";
        $valid_name["Cell"] = "Contact";
        $valid_name["Username"] = "Username";

        $messages = [
            'required' => 'Please enter :attribute.'
        ];

        $v = Validator::make(Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {
            $UserData["SalesPersonName"] = Input::get('Name');
            $UserData["Email"] = Input::get('Email');
            $UserData["Cell"] = Input::get('Cell');
            $UserData["Username"] = Input::get('Username');
            $UserData["DateModified"] = new \DateTime;

            if (Input::get('Password') != "") {
                $UserData["Password"] = Hash::make(Input::get('Password'));
            }



            DB::table('salesperson')->where('SalesPersonID', \Session::get('SalesPersonID'))->update($UserData);
            if (Input::hasFile('ProfilePicture')) {
                if (\File::exists(public_path('uploads/salesperson') . '/' . Input::get('ImgName'))) {
                    \File::delete(public_path('uploads/administrators') . '/' . Input::get('ImgName'));
                }


                $image = Input::file('ProfilePicture');
                $filename = \Session::get('SalesPersonID') . '_' . time() . '.' . $image->getClientOriginalExtension();
                $path = public_path('uploads/salesperson') . '/' . $filename;

                \Image::make($image->getRealPath())->save($path);
                DB::table('salesperson')
                        ->where('SalesPersonID', \Session::get('SalesPersonID'))
                        ->update(array('ProfilePicture' => $filename));
                \Session::put('SalesPersonPicture', $filename);
            }

            


            \Session::put('SalesPersonName', Input::get('Name'));
            \Session::put('SalesPersonEmail', Input::get('Email'));
            \Session::put('SalesPersonCell', Input::get('Cell'));

            return redirect('salesperson/profile')->with('success', "Profile Updated Successfully");
        }
    }




}
