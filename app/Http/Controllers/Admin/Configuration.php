<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Input;
use Validator;
use DB;

class Configuration extends AdminController {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $query = DB::table('configuration');
        $this->data['mConfiguration'] = $query->first();
        return view('admin.configuration', $this->data);
    }

    public function update() {
        $v = Validator::make(Input::all(), [
                    'WebsiteTitle' => 'required|max:100',
                    'Contact1' => 'max:20',
                    'Contact2' => 'max:20',
                    'Email1' => 'max:50',
                    'Email2' => 'max:50',
                    'Facebook' => 'max:50',
                    'Twitter' => 'max:50',
                    'Instagram' => 'max:50'
        ]);
        $v->setAttributeNames([
            'WebsiteTitle' => 'Website Title',
            'Contact1' => 'Contact 1',
            'Contact2' => 'Contact 2',
            'Email1' => 'Email 1',
            'Email2' => 'Email 2',
            'Facebook' => 'Facebook',
            'Twitter' => 'Twitter',
            'Instagram' => 'Instagram'
        ]);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {
            $UserData["WebsiteTitle"] = Input::get('WebsiteTitle');
            $UserData["Contact1"] = Input::get('Contact1');
            $UserData["Contact2"] = Input::get('Contact2');
            $UserData["Email1"] = Input::get('Email1');
            $UserData["Email2"] = Input::get('Email2');
            $UserData["Address"] = Input::get('Address');
            $UserData["Facebook"] = Input::get('Facebook');
            $UserData["Twitter"] = Input::get('Twitter');
            $UserData["Instagram"] = Input::get('Instagram');
            $UserData["DateModified"] = new \DateTime;

            \DB::table('configuration')->update($UserData);
            if (Input::hasFile('Logo')) {
                $Conf = \DB::table('configuration')->select('Logo')->First();
                if (\File::exists(public_path('uploads/website') . '/' . $Conf->Logo)) {
                    \File::delete(public_path('uploads/website') . '/' . $Conf->Logo);
                }

                $logoimage = Input::file('Logo');
                $MainLogo = 'Logo_' . time() . '.' . $logoimage->getClientOriginalExtension();
                $path = public_path('uploads/website') . '/' . $MainLogo;

                \Image::make($logoimage->getRealPath())->save($path);
                DB::table('configuration')->update(['Logo' => $MainLogo]);
            }
            return redirect('admin/configuration')->with('success', "Configuration Updated Successfully");
        }
    }

    

}
