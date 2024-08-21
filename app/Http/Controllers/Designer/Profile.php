<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\DesignerController;
use Illuminate\Support\Facades\Input;
use Validator;
use Hash;
use DB;
use App\Designers;

class Profile extends DesignerController {

    function __construct() {
        parent::__construct();
    }

    public function index() {

    
        $query =  Designers::where('DesignerID', \Session::get('DesignerID'));
        
  
        $this->data['designer'] = $query->first();

        if (empty($this->data['designer'])) {
            return redirect('designer/dashboard')->with('warning_msg', "No Designer Found");
        } else {
            return view('designer.profile', $this->data);
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
            $UserData["DesignerName"] = Input::get('Name');
            $UserData["Email"] = Input::get('Email');
            $UserData["Cell"] = Input::get('Cell');
            $UserData["Username"] = Input::get('Username');
            $UserData["DateModified"] = new \DateTime;

            if (Input::get('Password') != "") {
                $UserData["Password"] = Hash::make(Input::get('Password'));
            }



            Designers::where('DesignerID', \Session::get('DesignerID'))->update($UserData);
            if (Input::hasFile('ProfilePicture')) {
                if (\File::exists(public_path('uploads/designer') . '/' . Input::get('ImgName'))) {
                    \File::delete(public_path('uploads/administrators') . '/' . Input::get('ImgName'));
                }


                $image = Input::file('ProfilePicture');
                $filename = \Session::get('DesignerID') . '_' . time() . '.' . $image->getClientOriginalExtension();
                $path = public_path('uploads/designer') . '/' . $filename;

                \Image::make($image->getRealPath())->save($path);
                
                Designers::where('DesignerID', \Session::get('DesignerID'))
                        ->update(array('ProfilePicture' => $filename));
                \Session::put('DesignerProfilePicture', $filename);
            }

            \Session::put('DesignerFullName', Input::get('FirstName'));
            \Session::put('DesignerEmail', Input::get('Email'));
            \Session::put('DesignerCell', Input::get('Cell'));

            return redirect('designer/profile')->with('success', "Profile Updated Successfully");
        }
    }

}
